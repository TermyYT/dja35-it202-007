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

$id = (int)se($_GET, "id", 0, false); // Used to acquire the id value for the record.
$game = [];
// DJA35 - 11/27/2023 - After validation, update or save data accordingly.
if (count($_POST) > 0) {
    if (isset($_POST["search"])) { // If there's a search happening...
        $searchedId = (int)$_POST["searchedId"];
        redirect(get_url("admin/game_profile.php?id=$searchedId")); // Redirect to the same page with the specified game ID.
    } else {
        $game = $_POST;
        if (validate_game($game)) { // Calls the validate_game() function in game_helpers.php.
            if ($id > 0) {
                // Update existing game entry.
                if (update_data("Games", $id, $game, ["id"])) { // Calls the update_data.php file in lib folder.
                    flash("Game entry updated successfully.", "success");
                    redirect("admin/game_profile.php?id=$id");
                }
            } else {
                // Create a new game entry.
                $newGameId = save_data("Games", $game); // Calls the save_data.php file in lib folder.
                if ($newGameId) {
                    flash("Game entry created successfully.", "success");
                    redirect("admin/game_profile.php?id=$newGameId");
                }
            }
        } else {
            flash("Invalid input. Please check your data and try again.", "danger");
        }
    }
}
$back = "admin/game_list.php"; // Set for the Back button.
// DJA35 - 11/27/2023 - Fetching the record details.
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
<div class="container-fluid"> <!-- DJA35 - 11/27/2023 - The form itself. -->
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