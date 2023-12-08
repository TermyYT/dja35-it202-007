<?php
require(__DIR__ . "/../../../lib/functions.php");

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["previous"] = $_SERVER["REQUEST_URI"];

if (!is_logged_in()) {
    flash("You must be logged in to perform this action", "warning");
    redirect("login.php");
}

$user_id = get_user_id();
$game_id = (int)se($_GET, "id", 0, false);

if ($game_id <= 0) {
    flash("Invalid game ID", "danger");
    // Redirect based on the user's role
    if (has_role("Admin")) {
        redirect("admin/game_list.php");
    } else {
        redirect("game_browse.php");
    }
}

try {
    $db = getDB();

    // Check if the association record exists
    $isFavorited = is_game_favorited($user_id, $game_id);

    if ($isFavorited) {
        // If the association record exists, remove it
        remove_favorite_game($user_id, $game_id);
        flash("Association deleted successfully", "success");
    } else {
        flash("Association record not found", "danger");
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
    flash("An error occurred while processing the disassociation action", "danger");
    error_log("Single Disassociation Error: " . var_export($e, true));
}

// Redirect the user based on their role
redirect("game_browse.php");
?>
