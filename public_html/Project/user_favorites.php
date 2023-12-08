<?php
require(__DIR__ . "/../../partials/nav.php");

// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

// Retrieve favorited games for the logged-in user
// get_favorite_games() function is in favorite_helpers.php
$user_id = get_user_id();
$favorited_games = search_favorites($user_id);

// Format prices before rendering the table
foreach ($favorited_games as &$game) {
    $game['originalPrice'] = format_price($game['originalPrice']);
    $game['discountPrice'] = format_price($game['discountPrice']);
}
unset($game); // Unset reference to the last element

// Defines the columns to be displayed.
/*$columnsToShow = [
    'username',
    'id',
    'title',
    'description',
    'releaseDate',
    'originalPrice',
    'discountPrice',
    'currencyCode'
];*/

// Extract required columns
/*$gamesToShow = array_map(function ($game) use ($columnsToShow) {
    return array_intersect_key($game, array_flip($columnsToShow));
}, $favorited_games);*/

// Table configuration
if (has_role("Admin")) {
    $table = [
        "data" => $favorited_games,
        "favorite_url" => "favorite_game.php",
        "view_url" => "admin/game_viewer.php",
        "edit_url" => "admin/game_profile.php",
        "delete_url" => "admin/unfavorite_single.php"
    ];
} else {
    $table = [
        "data" => $favorited_games,
        "favorite_url" => "favorite_game.php",
        "view_url" => "game_view.php",
        "edit_url" => "game_edit.php"
    ];
}
$table["ignored_columns"] = ["user_id", /*"id",*/ "publisherName", "url", "created", "modified"];
?>
<div class="container-fluid">
    <h1>User Favorites</h1>
    <?php
    // Display the total and visible records associated with the user;
    echo "<h4>Total: $shown_records | Shown: " . count($favorited_games) . "</h4>";
    ?>
    <?php if (has_role("Admin")) : ?>
        <!-- Add Unfavorite All button for Admin -->
        <form method="POST" action="admin/unfavorite_all.php">
            <!-- Add a hidden input field for "unfavorite_all" -->
            <input type="hidden" name="unfavorite_all" value="1">
            <button type="submit" class="btn btn-danger">Unfavorite All</button>
        </form>
    <?php endif; ?>
    <div>
        <?php include(__DIR__ . "/../../partials/favorite_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file which has ADMIN delete function in it. -->
    </div>
    <div class="row">
        <?php include(__DIR__ . "/../../partials/pagination_nav.php"); ?>
    </div>
</div>
<style>
    thead { text-transform: capitalize;}
    a { text-decoration: none;}
</style>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>