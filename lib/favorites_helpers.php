<?php
function get_favorite_games($user_id)
{
    $query = "SELECT g.id, g.title, g.publisherName, g.description, g.releaseDate, g.url, g.originalPrice, g.discountPrice, g.currencyCode
              FROM UserFavorites uf
              JOIN Games g ON uf.game_id = g.id
              WHERE uf.user_id = :user_id";
    
    $db = getDB();
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":user_id" => $user_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
    } catch (PDOException $e) {
        error_log("Error getting favorite games: " . var_export($e, true));
    }

    return [];
}

function add_favorite_game($user_id, $game_id)
{
    $query = "INSERT INTO UserFavorites (user_id, game_id) VALUES (:user_id, :game_id)";
    $db = getDB();
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":user_id" => $user_id, ":game_id" => $game_id]);
        return true;
    } catch (PDOException $e) {
        error_log("Error adding favorite game: " . var_export($e, true));
    }

    return false;
}

function remove_favorite_game($user_id, $game_id)
{
    $query = "DELETE FROM UserFavorites WHERE user_id = :user_id AND game_id = :game_id";
    $db = getDB();
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([":user_id" => $user_id, ":game_id" => $game_id]);
        return true;
    } catch (PDOException $e) {
        error_log("Error removing favorite game: " . var_export($e, true));
    }

    return false;
}