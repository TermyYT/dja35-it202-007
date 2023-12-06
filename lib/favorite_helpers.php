<?php
require_once("game_helpers.php");
function get_favorite_games($user_id)
{
    $query = "SELECT g.id, g.title, g.publisherName, g.description, g.releaseDate, g.url, g.originalPrice, g.discountPrice, g.currencyCode
              FROM UserFavorites uf
              JOIN Games g ON uf.game_id = g.id
              WHERE uf.user_id = :user_id";

    $db = getDB();
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([':user_id' => $user_id]);
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
        $stmt->execute([':user_id' => $user_id, ':game_id' => $game_id]);
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
        $stmt->execute([':user_id' => $user_id, ':game_id' => $game_id]);
        return true;
    } catch (PDOException $e) {
        error_log("Error removing favorite game: " . var_export($e, true));
    }
    return false;
}

function is_game_favorited($user_id, $game_id)
{
    $query = "SELECT COUNT(1) as count
              FROM UserFavorites
              WHERE user_id = :user_id
              AND game_id = :game_id";

    $db = getDB();
    $stmt = $db->prepare($query);

    try {
        $stmt->execute([':user_id' => $user_id, ':game_id' => $game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result && $result['count'] > 0;
    } catch (PDOException $e) {
        error_log("Error checking if game is favorited: " . var_export($e, true));
    }

    return false;
}

function search_favorites($user_id = -1)
{
    $db = getDB();
    $search = $_GET;
    $total_query = "SELECT count(1) as total 
                    FROM UserFavorites uf
                    JOIN Games g ON uf.game_id = g.id
                    WHERE uf.user_id = :user_id";

    $query = "SELECT g.id, g.title, g.publisherName, g.description, g.releaseDate, g.url, g.originalPrice, g.discountPrice, g.currencyCode
              FROM UserFavorites uf
              JOIN Games g ON uf.game_id = g.id
              WHERE uf.user_id = :user_id";

    // Checking if user_id exists and setting it.
    if ($user_id > 0) {
        $search["user_id"] = $user_id;
    }
    _build_favorites_where_clause($filter_query, $params, $search);

    // Pagination logic.
    global $total;
    $total = (int)get_potential_total_records($total_query . $filter_query, $params);
    $limit = (int)se($search, "limit", 10, false);
    error_log("total records: $total");
    $page = (int)se($search, "page", "1", false);

    if ($limit > 0 && $limit <= 100 && $page > 0) {
        $offset = ($page - 1) * $limit;
        if (is_numeric($offset) && is_numeric($limit)) {
            $filter_query .= " LIMIT $offset, $limit";
        }
    }

    // Prepare the SQL statement
    $stmt = $db->prepare($query . $filter_query);

    // Bind parameters to the SQL statement
    bind_params($stmt, $params);
    error_log("favorites search query: " . var_export($query, true));
    error_log("params: " . var_export($params, true));

    // Execute the SQL statement and fetch results
    try {
        $stmt->execute([':user_id' => $user_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for favorites: " . $e->getMessage(), "warning");
        error_log("Favorites Search Error: " . var_export($e, true));
    }

    return [];
}


function _build_favorites_where_clause(&$query, &$params, $search)
{
    // Add conditions to the query based on the search parameters
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                /*case "id": // Could keep around for lazy-loading.
                    $params[":id"] = $value;
                    $query .= " AND uf.id = :id"; 
                    break;*/
                case 'user_id':
                    $params[":user_id"] = $value;
                    $query .= " AND uf.user_id = :user_id";
                    break;
                case 'game_id':
                    $params[":game_id"] = $value;
                    $query .= " AND uf.game_id = :game_id";
                    break;
            }
        }
    }

    // Order by
    if (isset($search["column"]) && !empty($search["column"]) && isset($search["order"]) && !empty($search["order"])) {
        global $VALID_ORDER_COLUMNS;
        $col = $search["column"];
        $order = $search["order"];
        // Prevent SQL injection by checking against a hard-coded list

        if (!in_array($col, $VALID_ORDER_COLUMNS)) {
            $col = "user_id";
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "asc";
        }

        // Special mapping to use table name prefix to resolve ambiguity error

        if (in_array($col, ["created", "modified"])) {
            $col = "uf.$col";
        }

        $query .= " ORDER BY $col $order"; //<-- Be absolutely sure you trust these values; we can't bind certain parts of the query due to how the parameter mapping works
    }
}