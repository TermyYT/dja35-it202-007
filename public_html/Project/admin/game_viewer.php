<?php
require(__DIR__ . "/../../../partials/nav.php");

//$canDelete = true;
$id = (int)se($_GET, "id", 0, false);
$game = [];

if ($id > 0) {
    $db = getDB();

    $query = "SELECT title, publisherName, description, releaseDate, url, currentPrice, discountPrice, currencyCode, modified FROM Games WHERE id = :id";
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        if ($result) {
            $game = $result;
        } else {
            flash("There was a problem finding this game", "danger");
            // redirect or handle accordingly
        }
    } catch (PDOException $e) {
        error_log("Error fetching game by id: " . var_export($e, true));
        flash("An unhandled error occurred", "danger");
        // redirect or handle accordingly
    }
}
if (isset($_POST["delete"])) {
    /*$query = "DELETE FROM Games WHERE id = :id";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute([":id" => $id]);
        flash("Game deleted successfully", "success");
        redirect(get_url($back, true));
    } catch (PDOException $e) {
        error_log("Error deleting game by id: " . var_export($e, true));
        flash("An error occurred while deleting the game", "danger");
    }
    delete_game($db, $id, $back);*/
}
?>
<div class="container-fluid">
    <h1 class="mb-3">Game Viewer (Update/Delete)</h1>
    <div class="card text-center mb-3">
        <h1 class="card-header">
            <?php echo se($game, "title", "", true); ?>
        </h1>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><b>Description:</b> <?php echo se($game, "description", "", true); ?></li>
                <li class="list-group-item"><b>Publisher:</b> <?php echo se($game, "publisherName", "", true); ?></li>
                <li class="list-group-item"><b>Release Date:</b> <?php echo se($game, "releaseDate", "", true); ?></li>
                <li class="list-group-item"><b>URL:</b> <?php echo se($game, "url", "", true); ?></li>
                <li class="list-group-item"><b>Current Price:</b> <?php echo se($game, "currentPrice", "", true); ?></li>
                <li class="list-group-item"><b>Discount Price:</b> <?php echo se($game, "discountPrice", "", true); ?></li>
                <li class="list-group-item"><b>Currency Code:</b> <?php echo se($game, "currencyCode", "", true); ?></li>
            </ul>
            <div class="mt-3">
                <a href="<?php echo get_url("admin/game_profile.php?id=$id"); ?>" class="btn btn-primary mr-2">Edit</a>
                <!-- Delete button (Will only be shown for admins; users will have Delete button removed) -->

                    <form method="post" style="display: inline;">
                        <input type="hidden" name="delete" value="true">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('WARNING: Are you sure you want to delete this game permanently?')">Delete</button>
                    </form>

            </div>
        </div>
        <div class="card-footer text-muted">
        <?php // Formats modification date for each record's card.
        try {
            if (isset($game['modified'])) {
                $modifiedDate = new DateTime($game['modified']);
                echo "Last modified: " . $modifiedDate->format('Y-m-d H:i:s');
            } else {
                throw new Exception("Modified date not available.");
            }
        }
        catch (Exception $e) {
            error_log("Error fetching modification date: " . var_export($e, true));
        }
        ?>
        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="<?php get_url($back, true); ?>">Back</a>
</div>
<?php
// note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>