<?php
require(__DIR__ . "/../../../partials/nav.php");

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
} else {
    flash("Invalid game ID", "danger");
    // redirect or handle accordingly
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
            <a href="<?php echo get_url("admin/game_profile.php?id=$id"); ?>" class="btn btn-primary mt-3">Edit</a>
        </div>
        <div class="card-footer text-muted">
        <?php
            $modifiedDate = new DateTime($game['modified']);
            echo "Last modified: " . $modifiedDate->format('Y-m-d H:i:s');
        ?>
        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="<?php get_url($back, true); ?>">Back</a>
</div>
<?php
// note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>