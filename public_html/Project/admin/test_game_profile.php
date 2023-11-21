<?php
// Note: You may need to adjust the code further based on your specific requirements and table structure

require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$genres = [];

$result = get_genres(); // Assuming you have a function like get_genres() to fetch game genres
$genres = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $result);

$id = (int)se($_GET, "id", 0, false);
$game = [];

if (count($_POST) > 0) {
    $game = $_POST;
    $id = (int)se($_POST, "id", 0, false);

    // Perform validation and other necessary checks

    // Example validation (customize based on your needs)
    if (empty($game['title']) || strlen($game['title']) < 2) {
        flash("Invalid input. Please check your data and try again.", "danger");
    } else {
        // Additional validation and processing can be added

        // Assuming you have a function like validate_game() to perform validation
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

    $query = "SELECT * FROM Games WHERE id = :id";
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
        flash("An unhandled error occurred", "danger");
        redirect("admin/game_list.php");
    }
}
?>

<div class="container-fluid">
    <h1>Game Profile</h1>
    <form method="POST">
        <?php render_input(["type" => "hidden", "id" => "id", "name" => "id", "value" => se($game, "id", "", false)]); ?>
        <?php render_input(["type" => "text", "id" => "title", "name" => "title", "label" => "Title", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "title", "", false)]); ?>
        <?php render_input(["type" => "select", "id" => "genre", "name" => "genre_id", "label" => "Genre", "options" => $genres, "rules" => ["required" => true], "value" => se($game, "genre_id", "", false)]); ?>
        <?php render_input(["type" => "text", "id" => "publisher", "name" => "publisher", "label" => "Publisher", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "publisher", "", false)]); ?>
        <?php render_input(["type" => "textarea", "id" => "description", "name" => "description", "label" => "Description", "rules" => ["minlength" => 2, "required" => true], "value" => se($game, "description", "", false)]); ?>
        <?php render_input(["type" => "date", "id" => "release_date", "name" => "release_date", "label" => "Release Date", "rules" => ["required" => true], "value" => se($game, "release_date", date("Y-m-d"), false)]); ?>
        <?php render_input(["type" => "number", "id" => "price", "name" => "price", "label" => "Price", "rules" => ["min" => 0, "required" => true], "value" => se($game, "price", "0", false)]); ?>
        <?php render_button(["text" => "Save", "type" => "submit"]); ?>
    </form>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>