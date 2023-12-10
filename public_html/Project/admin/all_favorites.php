<?php
require(__DIR__ . "/../../../partials/nav.php");

// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

// Retrieve favorited games for the logged-in user
$user_id = se($_GET, "user_id", get_user_id(), false);
$all_favorited_games = search_all_favorites();

// Format prices before rendering the table
foreach ($all_favorited_games as &$game) {
    $game['originalPrice'] = format_price($game['originalPrice']);
    $game['discountPrice'] = format_price($game['discountPrice']);
}
unset($game); // Unset reference to the last element

// Get the total count of records in UserFavorites table.
$total_records_query = "SELECT COUNT(*) AS totalRecords FROM UserFavorites";
$db = getDB();
$stmt = $db->query($total_records_query);
$total_records_result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_record_count = isset($total_records_result['totalRecords']) ? (int)$total_records_result['totalRecords'] : 0;

if (has_role("Admin")) { // DJA35 - 12/13/2023 - The All Users Association page.
    $table = [
        "data" => $all_favorited_games,
        "favorite_url" => "/../Project/favorite_game.php", // Counts as "deleting" the relationship.
        "view_url" => "admin/game_viewer.php",
    ];
} else {
    $table = [
        "data" => $all_favorited_games,
        "favorite_url" => "/../favorite_game.php", // Counts as "deleting" the relationship.
        "view_url" => "game_view.php",
    ];
}
$table["ignored_columns"] = ["user_id", "publisherName", "url", "created", "modified"];
?>
<div class="container-fluid">
    <h1>All Favorited Games</h1>
    <?php
    // Display the total and visible records associated with the users.
    echo "<h4>Total: $total_record_count | Shown: " . count($all_favorited_games) . "</h4>";
    ?>
    <?php if (has_role("Admin") && isset($search["username"]) && !empty($search["username"])) : ?>
        <!-- Add Unfavorite All button for Admin after performing a Username search -->
        <form method="POST" action="unfavorite_all_user.php">
            <input type="hidden" name="unfavorite_all" value="1">
            <input type="hidden" name="username" value="<?php echo $search["username"]; ?>">
            <button type="submit" class="btn btn-danger">Unfavorite All for "<?php echo $search["username"] . "\""; ?></button>
        </form>
    <?php endif; ?>
    <div>
        <?php include(__DIR__ . "/../../../partials/all_favorites_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file. -->
    </div>
    <div class="row">
        <?php include(__DIR__ . "/../../../partials/pagination_nav.php"); ?> <!-- Adds pagination. -->
    </div>
</div>
<style>
    thead { text-transform: capitalize;}
    a { text-decoration: none;}
</style>
<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>