<?php
require(__DIR__ . "/../../lib/functions.php");
/**
 * Need to make sure that isFavorite is updated accordingly!
 */

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["previous"] = $_SERVER["REQUEST_URI"];

if (!is_logged_in()) {
    flash("You must be logged in to perform this action", "warning");
    redirect("login.php");
}

if (!has_role("Admin")) { // Must have the admin role.
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$user_id = get_user_id();
$game_id = (int)se($_GET, "id", 0, false);

if ($game_id <= 0) {
    flash("Invalid game ID", "danger");
    if (isset($_SESSION["previous"]) && strpos($_SESSION["previous"], "admin") !== false) { // Decides return point for user after deletion.
        redirect("admin/game_list.php"); // ADMIN game list.
    } else {
        redirect("game_browse.php"); // USER game list.
    }
}

try {
    $db = getDB();
    $isFavorited = is_game_favorited($user_id, $game_id);

    if (!$isFavorited) {
        // If the game is not favorited, add the favorite association
        add_favorite_game($user_id, $game_id);
        flash("Game favorited successfully", "success");
    } else {
        // If the game is already favorited, remove the association
        remove_favorite_game($user_id, $game_id);
        flash("Game unfavorited successfully", "success");
    }

    // Check if there are still users who have the game favorited
    $query = "SELECT COUNT(1) as count FROM UserFavorites WHERE game_id = :game_id";
    $stmt = $db->prepare($query);
    $stmt->execute([':game_id' => $game_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Update isFavorite in Games table based on the count
    $updateQuery = "UPDATE Games SET isFavorite = :isFavorite WHERE id = :game_id";
    $updateStmt = $db->prepare($updateQuery);

    if ($result && $result['count'] > 0) {
        $updateStmt->execute([':isFavorite' => 1, ':game_id' => $game_id]);
    } else {
        $updateStmt->execute([':isFavorite' => 0, ':game_id' => $game_id]);
    }

} catch (PDOException $e) {
    flash("An error occurred while processing the favorite action", "danger");
    error_log("Favorite Game Error: " . var_export($e, true));
}

if (isset($_SESSION["previous"]) && strpos($_SESSION["previous"], "admin") !== false) { // Decides return point for user after deletion.
    $url = "admin/game_list.php"; // ADMIN game list.
} else {
    $url = "game_browse.php"; // USER game list.
}

// Remove the 'id' parameter from the $_GET array
if (isset($_GET['id'])) {
    unset($_GET['id']);
}

$url .= "?" . http_build_query($_GET);
error_log("Redirecting to " . var_export($url, true));
redirect(get_url($url)); // Redirects user to chosen page.