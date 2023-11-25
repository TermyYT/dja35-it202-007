<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");

$search = $_GET;
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

$games = search_games();
// Format prices before rendering the table
foreach ($games as &$game) {
    $game['Original Price'] = format_price($game['Original Price']);
    $game['Discount Price'] = format_price($game['Discount Price']);
}
unset($game); // Unset reference to the last element
$table = ["data" => $games, "view_url" => "game_view.php", "edit_url" => "game_edit.php"];
?>

<div class="container-fluid">
    <h1>List Games</h1>
    <div>
        <?php include(__DIR__ . "/../../partials/search_form.php"); ?>
    </div>
    <div>
        <?php render_user_table($table); ?>
    </div>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../partials/flash.php");
?>