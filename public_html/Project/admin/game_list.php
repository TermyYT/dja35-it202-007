<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

$search = $_GET;
// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}
// Checks if the user has the Admin role.
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}
// search_games() function is in game_helpers.php
$games = search_games();
// Format prices before rendering the table
foreach ($games as &$game) {
    $game['originalPrice'] = format_price($game['originalPrice']);
    $game['discountPrice'] = format_price($game['discountPrice']);
}
unset($game); // Unset reference to the last element

/*// Defines the columns to be displayed.
$columnsToShow = [
    'id',
    'title',
    'description',
    'releaseDate',
    'originalPrice',
    'discountPrice',
    'currencyCode'
];

// Extracts only the required columns from the games data.
$gamesToShow = array_map(function ($game) use ($columnsToShow) {
    return array_intersect_key($game, array_flip($columnsToShow));
}, $games);*/

// Creates table with corresponding values. ADMIN version has a delete function.
$table = ["data" => $games,
"favorite_url" => "/../Project/favorite_game.php", 
"view_url" => "admin/game_viewer.php",
"edit_url" => "admin/game_profile.php",
"delete_url" => "admin/delete_game.php" 
];
$table["ignored_columns"] = [/*"id",*/ "publisherName", "url", "created", "modified"];
?>

<div class="container-fluid">
    <h1>Game List</h1>
    <div>
        <?php include(__DIR__ . "/../../../partials/game_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
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
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>