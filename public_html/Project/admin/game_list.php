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
    $game['Original Price'] = format_price($game['Original Price']);
    $game['Discount Price'] = format_price($game['Discount Price']);
}
unset($game); // Unset reference to the last element
// Creates table with corresponding values. ADMIN version has a delete function.
$table = ["data" => $games, "delete_url" => "admin/delete_game.php", "view_url" => "admin/game_viewer.php", "edit_url" => "admin/game_profile.php"];
?>

<div class="container-fluid">
    <h1>List Games</h1>
    <div>
        <?php include(__DIR__ . "/../../../partials/search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file which has the ADMIN delete function included. -->
    </div>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>