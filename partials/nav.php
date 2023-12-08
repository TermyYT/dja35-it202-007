<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include bootstrap css and js references -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- include css and js files -->
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-3 mb-3">
    <a class="navbar-brand ms-3" href="#">Epic Favorites</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (is_logged_in()) : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('home.php'); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('user_favorites.php'); ?>">Favorites</a></li>

                <?php if (!has_role("Admin")) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="gamesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Games</a>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="gamesDropdown">
                            <a class="dropdown-item" href="<?php echo get_url('game_edit.php'); ?>">Game Editor</a>
                            <a class="dropdown-item" href="<?php echo get_url('game_view.php'); ?>">Game View</a>
                            <a class="dropdown-item" href="<?php echo get_url('game_browse.php'); ?>">Game List</a>
                        </div>
                    </li>
                <?php endif; ?>

            <?php elseif (!is_logged_in()) : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('login.php'); ?>">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('register.php'); ?>">Register</a></li>
            <?php endif; ?>

            <?php if (is_logged_in() && has_role("Admin")) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="adminDropdown">
                        <a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/manage_game_data.php'); ?>">Manage Data</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/game_profile.php'); ?>">Game Profile</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/game_viewer.php'); ?>">Game Viewer</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/game_list.php'); ?>">Game List</a>
                        <a class="dropdown-item" href="<?php echo get_url('admin/unfavorited_games.php'); ?>">Unfavorited Games</a>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (is_logged_in()) : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>