<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

$search = $_GET;

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$games = search_games();
$table = ["data" => $games, "delete_url" => "admin/delete_game.php", "view_url" => "admin/game_viewer.php", "edit_url" => "admin/game_profile.php"];
?>

<div class="container-fluid">
    <h1>List Games</h1>
    <div>
        <?php include(__DIR__ . "/../../../partials/search_form.php"); ?>
    </div>
    <div>
        <?php render_table($table); ?>
    </div>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>