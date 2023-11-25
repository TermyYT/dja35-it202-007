<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");

$search = $_GET;

/* No admin check needed for user side.
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}*/

$games = search_games();
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