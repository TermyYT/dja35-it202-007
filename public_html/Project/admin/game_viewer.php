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

if ($id > 0) {
    $db = getDB();

    $query = "SELECT title, publisherName, description, releaseDate, url, originalPrice, discountPrice, currencyCode, modified FROM Games WHERE id = :id";
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
$back = "admin/game_list.php";
if (isset($_POST["search"])) {
    $searchedId = (int)$_POST["searchedId"];
    // Redirect to the same page with the specified game ID
    redirect(get_url("admin/game_viewer.php?id=$searchedId"));
}
// Perform the delete operation
if (isset($_POST["delete"])) {
    if ($id > 0) {
        // Proceed with delete
        $query = "DELETE FROM Games WHERE id = :id";
        $stmt = $db->prepare($query);

        try {
            $stmt->execute([":id" => $id]);
            flash("Game deleted successfully", "success");
        } catch (PDOException $e) {
            flash("Error deleting game", "danger");
            error_log("Error deleting game: " . var_export($e, true));
        }
    } else {
        flash("Invalid game ID for deletion", "danger");
    }

    // Redirect back to the previous URL
    redirect("admin/game_list.php");
}
?>
<div class="container-fluid">
    <h1 class="mb-3">Game Viewer (Update/Delete)</h1>
    <form method="post" class="mb-3">
        <label for="searchedId">Jump to Game ID:</label>
        <input type="number" id="searchedId" name="searchedId" required min="1">
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>
    <a class="btn btn-secondary mb-3" href="<?php get_url($back, true); ?>">Back to List</a>
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
                <li class="list-group-item"><b>Original Price:</b> <?php echo "$" . format_price(se($game, "originalPrice", "", false)); ?></li>
                <li class="list-group-item"><b>Discount Price:</b> <?php echo "$" . format_price(se($game, "discountPrice", "", false)); ?></li>
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
    
</div>
<?php
// note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>