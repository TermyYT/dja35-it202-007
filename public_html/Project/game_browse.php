<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");

$search = $_GET;
// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

// search_games() function is in game_helpers.php
$games = search_games();
// Format prices before rendering the table
foreach ($games as &$game) {
    $game['Original Price'] = format_price($game['Original Price']);
    $game['Discount Price'] = format_price($game['Discount Price']);
}
unset($game); // Unset reference to the last element

// Defines the columns to be displayed.
$columnsToShow = [
    'id',
    'Title',
    'Description',
    'Release Date',
    'Original Price',
    'Discount Price',
    'Currency Code'
];

// Extracts only the required columns from the games data.
$gamesToShow = array_map(function ($game) use ($columnsToShow) {
    return array_intersect_key($game, array_flip($columnsToShow));
}, $games);

// Creates table with corresponding values. USER version doesn't have a delete function.
if (has_role("Admin")) {
    $table = ["data" => $gamesToShow,
    "favorite_url" => "favorite_game.php", 
    "view_url" => "admin/game_viewer.php",
    "edit_url" => "admin/game_profile.php",
    "delete_url" => "admin/delete_game.php"];
} else {
    $table = ["data" => $gamesToShow,
    "favorite_url" => "favorite_game.php", 
    "view_url" => "game_view.php",
    "edit_url" => "game_edit.php"];
}
?>

<div class="container-fluid">
    <h1>List Games</h1>
    <div>
        <?php include(__DIR__ . "/../../partials/game_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file which has ADMIN delete function in it. -->
    </div>
    <div class="row">
        <?php include(__DIR__ . "/../../partials/pagination_nav.php"); ?>
    </div>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../partials/flash.php");
?>