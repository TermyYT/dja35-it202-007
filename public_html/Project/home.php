<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<?php
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}
if (is_logged_in(true)) {
    //echo "Welcome home, " . get_username();
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>
<div class="container-fluid">
    <div class="h-30 p-5 text-bg-dark rounded-3">
        <h1>Welcome to the Epic Games Wishlister!</h1>
        <p>Do you want to have a personal wishlist for games sold on Epic Games?</p>
        <p>Do you want up-to-date information on sales going on?</p>
        <p>Use our service today!</p>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="<?php get_url("game_browse.php", true); ?>" role="button">Explore Games</a></p>
    </div>
</div>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>