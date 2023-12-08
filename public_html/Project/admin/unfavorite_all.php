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

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$user_id = se($_GET, "user_id", get_user_id(), false);

// Check if the "Unfavorite All" button is clicked
if (isset($_POST['unfavorite_all'])) {
    try {
        $db = getDB();

        // Fetch all game IDs favorited by the user
        $query = "SELECT game_id FROM UserFavorites WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $game_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Remove all UserFavorite associations for the logged-in user
        $deleteQuery = "DELETE FROM UserFavorites WHERE user_id = :user_id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->execute([':user_id' => $user_id]);

        // Update isFavorite in Games table based on the remaining associations
        $updateQuery = "UPDATE Games SET isFavorite = :isFavorite WHERE id = :game_id";
        $updateStmt = $db->prepare($updateQuery);

        foreach ($game_ids as $game_id) {
            // Check if the game still exists in the UserFavorites table
            $checkQuery = "SELECT COUNT(1) as count FROM UserFavorites WHERE game_id = :game_id";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->execute([':game_id' => $game_id]);
            $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

            // Update isFavorite in Games table based on the count
            if ($result && $result['count'] > 0) {
                $updateStmt->execute([':isFavorite' => 1, ':game_id' => $game_id]);
            } else {
                $updateStmt->execute([':isFavorite' => 0, ':game_id' => $game_id]);
            }
        }

        flash("All favorites removed successfully", "success");
    } catch (PDOException $e) {
        flash("An error occurred while removing favorites", "danger");
        error_log("Unfavorite All Error: " . var_export($e, true));
    }

    // Redirect to the appropriate page
    redirect("user_favorites.php");
} else {
    flash("Invalid request when unfavoriting all", "danger");
    redirect("user_favorites.php");
}
?>