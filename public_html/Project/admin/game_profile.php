<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$id = (int)se($_GET, "id", 0, false);
$game = [];

if (count($_POST) > 0) {
    if (isset($_POST["search"])) {
        $searchedId = (int)$_POST["searchedId"];
        // Redirect to the same page with the specified game ID
        redirect(get_url("admin/game_profile.php?id=$searchedId"));
    } else {
        $game = $_POST;
        if (!dupeTitleCheck($game, $id)) {
            if (validate_game($game)) {
                if ($id > 0) {
                    // Update existing game entry
                    if (update_data("Games", $id, $game, ["id"])) {
                        flash("Game entry updated successfully", "success");
                        redirect("game_edit.php?id=$id");
                    }
                } else {
                    // Create a new game entry
                    $newGameId = save_data("Games", $game);
                    if ($newGameId) {
                        flash("Game entry created successfully", "success");
                        redirect("game_edit.php?id=$newGameId");
                    }
                }
            } else {
                flash("Invalid input. Please check your data and try again.", "danger");
            }
        } else {
            flash("A game with the same title already exists.", "danger");
        }
    }
}
function dupeTitleCheck($game, $id)
{
    $db = getDB();
    $query = "SELECT id FROM Games WHERE title = :title AND id != :id";
    $stmt = $db->prepare($query);
    $stmt->execute([":title" => $game["title"], ":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($result !== false);
}
$back = "admin/game_list.php";
if ($id > 0) {
    $db = getDB();

    $query = "SELECT title, publisherName, description, releaseDate, url, originalPrice, discountPrice, currencyCode FROM Games WHERE id = :id";
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        if ($result) {
            $game = $result;
        } else {
            flash("There was a problem finding this game", "danger");
            redirect("admin/game_list.php");
        }
    } catch (PDOException $e) {
        error_log("Error fetching game by id: " . var_export($e, true));
        flash("An error fetching game by id has occured", "danger");
        redirect("admin/game_list.php");
    }
}
?>

<div class="container-fluid">
    <h1>Game Profile (Create/Update)</h1>
    <form method="post" class="mb-3">
        <label for="searchedId">Jump to Game ID:</label>
        <input type="number" id="searchedId" name="searchedId" required min="1">
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>
    <a class="btn btn-secondary" href="<?php get_url($back, true); ?>">Back to List</a>
    <form method="POST">
        <?php render_input(["type" => "text", "id" => "title", "name" => "title", "label" => "Title", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "title", "", false)]); ?>
        <?php render_input(["type" => "text", "id" => "publisherName", "name" => "publisherName", "label" => "Publisher", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "publisherName", "", false)]); ?>
        <?php render_input(["type" => "textarea", "id" => "description", "name" => "description", "label" => "Description", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "description", "", false)]); ?>
        <?php render_input(["type" => "date", "id" => "releaseDate", "name" => "releaseDate", "label" => "Release Date", "rules" => ["required" => true], "value" => se($game, "releaseDate", date("Y-m-d"), false)]); ?>
        <?php render_input(["type" => "text", "id" => "url", "name" => "url", "label" => "URL (https://store.epicgames.com/GameLinkHere)", "rules" => ["minlength" => 28, "required" => true], "value" => se($game, "url", "", false)]); ?>
        <?php render_input(["type" => "number", "id" => "originalPrice", "name" => "originalPrice", "label" => "Original Price (\$1.00 = 100)", "rules" => ["min" => 0, "required" => true], "value" => se($game, "originalPrice", "0", false)]); ?>
        <?php render_input(["type" => "number", "id" => "discountPrice", "name" => "discountPrice", "label" => "Discount Price (\$1.00 = 100)", "rules" => ["min" => 0, "required" => true], "value" => se($game, "discountPrice", "0", false)]); ?>
        <?php render_input(["type" => "text", "id" => "currencyCode", "name" => "currencyCode", "label" => "Currency Code (XYZ)", "rules" => ["minlength" => 3, "maxlength" => 3, "required" => true], "value" => se($game, "currencyCode", "", false)]); ?>
        <?php render_button(["text" => "Save", "type" => "submit"]); ?>
    </form>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>