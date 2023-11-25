<?php
require(__DIR__ . "/../../../lib/functions.php");
$id = (int)se($_GET, "id", 0, false);

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["previous"] = $_SERVER["REQUEST_URI"];

if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

if ($id <= 0) {
    flash("Invalid game ID", "danger");
} else {
    $db = getDB();
    $query = "DELETE FROM Games WHERE id = :id";
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":id" => $id]);
        flash("Game deleted successfully", "success");
    } catch (PDOException $e) {
        flash("Error deleting game", "danger");
        error_log("Error deleting game: " . var_export($e, true));
    }
}

if (isset($_SESSION["previous"]) && strpos($_SESSION["previous"], "admin") !== false) {
    $url = "admin/game_list.php";
} else {
    $url = "browse.php";
}

$url .= "?" . http_build_query($_GET);
error_log("redirecting to " . var_export($url, true));
redirect(get_url($url));