<?php
require(__DIR__ . "/../../partials/nav.php");

// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

// Retrieve favorited games for the logged-in user
$user_id = se($_GET, "user_id", get_user_id(), false);
$favorited_games = search_favorites();

// Format prices before rendering the table
foreach ($favorited_games as &$game) {
    $game['originalPrice'] = format_price($game['originalPrice']);
    $game['discountPrice'] = format_price($game['discountPrice']);
}
unset($game); // Unset reference to the last element

if (has_role("Admin")) { // DJA35 - 12/13/2023 - The user's favorites page.
    $table = [
        "data" => $favorited_games,
        "favorite_url" => "favorite_game.php", // Counts as "deleting" the relationship.
        "view_url" => "admin/game_viewer.php",
    ];
} else {
    $table = [
        "data" => $favorited_games,
        "favorite_url" => "favorite_game.php", // Counts as "deleting" the relationship.
        "view_url" => "game_view.php",
    ];
}
$table["ignored_columns"] = ["user_id", "username", "publisherName", "url", "created", "modified"];
?>
<div class="container-fluid">
    <h1>Favorites List</h1>
    <?php
    // Display the total and visible records associated with the user.
    echo "<h4>Total: $shown_records | Shown: " . count($favorited_games) . "</h4>";
    ?>
    <?php if (has_role("Admin")) : ?>
        <!-- Add Unfavorite All button for Admin -->
        <form method="POST" action="admin/unfavorite_all_id.php">
            <!-- Add a hidden input field for "unfavorite_all" -->
            <input type="hidden" name="unfavorite_all" value="1">
            <button type="submit" class="btn btn-danger">Unfavorite All</button>
        </form>
    <?php endif; ?>
    <div>
        <?php include(__DIR__ . "/../../partials/favorite_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file. -->
    </div>
    <div class="row">
        <?php include(__DIR__ . "/../../partials/pagination_nav.php"); ?> <!-- Adds pagination. -->
    </div>
</div>
<style>
    thead { text-transform: capitalize;}
    a { text-decoration: none;}
</style>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>