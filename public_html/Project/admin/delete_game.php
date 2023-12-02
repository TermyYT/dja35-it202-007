<?php
require(__DIR__ . "/../../../lib/functions.php");
// DJA35 - 11/27/2023 - The delete page takes an ID and uses it to identify and delete a record from the db.
$id = (int)se($_GET, "id", 0, false); // Used to acquire the id value for the record.

if (session_status() != PHP_SESSION_ACTIVE) { // If the PHP session isn't active, then start it.
    session_start();
}

$_SESSION["previous"] = $_SERVER["REQUEST_URI"]; // Setting a value for the "previous" session.

if (!is_logged_in()) { // Must be logged in.
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

if (!has_role("Admin")) { // Must have the admin role.
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

if ($id <= 0) { // A check for an invalid game ID being passed.
    flash("Invalid game ID", "danger");
    redirect("admin/game_list.php"); 
} else {
    $db = getDB();
    $query = "DELETE FROM Games WHERE id = :id"; // The query for deleting the record.
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":id" => $id]);
        flash("Game deleted successfully", "success");
    } catch (PDOException $e) {
        flash("Error deleting game", "danger");
        error_log("Error deleting game: " . var_export($e, true));
    }
}

if (isset($_SESSION["previous"]) && strpos($_SESSION["previous"], "admin") !== false) { // Decides return point for user after deletion.
    $url = "admin/game_list.php"; // ADMIN game list.
} else {
    $url = "game_browse.php"; // USER game list.
}

$url .= "?" . http_build_query($_GET);
error_log("Redirecting to " . var_export($url, true));
redirect(get_url($url)); // Redirects user to chosen page.