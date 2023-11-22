<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    //die(header("Location: " . get_url("home.php")));
    redirect("home.php");
}

$id = (int)se($_GET, "id", 0, false);
$game = [];

if (count($_POST) > 0) {
    $game = $_POST;
    // Perform validation and other necessary checks

    if (empty($game['title']) || strlen($game['title']) < 2) {
        flash("Invalid input. Please make sure your title is longer than 2 characters.", "danger");
    } else {
        // Additional validation and processing can be added

        if (validate_game($game)) {
            if ($id > 0) {
                // Update existing game entry
                if (update_data("Games", $id, $game, ["id"])) {
                    flash("Game entry updated successfully", "success");
                    redirect("admin/game_profile.php?id=$id");
                }
            } else {
                // Create a new game entry
                $newGameId = save_data("Games", $game);
                if ($newGameId) {
                    flash("Game entry created successfully", "success");
                    redirect("admin/game_profile.php?id=$newGameId");
                }
            }
        } else {
            flash("Invalid input. Please check your data and try again.", "danger");
        }
    }
}

if ($id > 0) {
    $db = getDB();

    $query = "SELECT title, publisherName, description, releaseDate, url, currentPrice, discountPrice, currencyCode FROM Games WHERE id = :id";
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        if ($result) {
            $game = $result;
        } else {
            flash("There was a problem finding this game", "danger");
            //redirect("admin/game_list.php");
        }
    } catch (PDOException $e) {
        error_log("Error fetching game by id: " . var_export($e, true));
        flash("An unhandled error occurred", "danger");
        //redirect("admin/game_list.php");
    }
}
?>

<div class="container-fluid">
    <h1>Game Profile</h1>
    <a class="btn btn-secondary" href="<?php get_url($back, true); ?>">Back</a>
    <form method="POST">
        <?php render_input(["type" => "text", "id" => "title", "name" => "title", "label" => "Title", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "title", "", false)]); ?>
        <?php render_input(["type" => "text", "id" => "publisherName", "name" => "publisherName", "label" => "Publisher", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "publisherName", "", false)]); ?>
        <?php render_input(["type" => "textarea", "id" => "description", "name" => "description", "label" => "Description", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "description", "", false)]); ?>
        <?php render_input(["type" => "date", "id" => "releaseDate", "name" => "releaseDate", "label" => "Release Date", "rules" => ["required" => true], "value" => se($game, "releaseDate", date("Y-m-d"), false)]); ?>
        <?php render_input(["type" => "text", "id" => "url", "name" => "url", "label" => "URL", "value" => se($game, "url", "", false)]); ?>
        <?php render_input(["type" => "number", "id" => "currentPrice", "name" => "currentPrice", "label" => "Current Price", "rules" => ["min" => 0, "required" => true], "value" => se($game, "currentPrice", "0", false)]); ?>
        <?php render_input(["type" => "number", "id" => "discountPrice", "name" => "discountPrice", "label" => "Discount Price", "rules" => ["min" => 0, "required" => true], "value" => se($game, "discountPrice", "0", false)]); ?>
        <?php render_input(["type" => "text", "id" => "currencyCode", "name" => "currencyCode", "label" => "Currency Code", "rules" => ["minlength" => 3, "maxlength" => 3, "required" => true], "value" => se($game, "currencyCode", "", false)]); ?>
        <?php render_button(["text" => "Save", "type" => "submit"]); ?>
    </form>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>