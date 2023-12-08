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
function search_favorites($user_id)
{
    // Initialize variables
    global $search;
    if (isset($search) && !empty($search)) { // NEW merging of search and get!
        $search = array_merge($search, $_GET);
    } else {
        $search = $_GET;
    }
    $games = [];
    $params = [];
    $search["user_id"]  = get_user_id();
    // Build the SQL query
    error_log("Search prior to query: " . var_export($search, true));
    $query = _build_favorite_search_query($params, $search);

    // Prepare the SQL statement
    $db = getDB();
    $stmt = $db->prepare($query);

    // Bind parameters to the SQL statement
    bind_params($stmt, $params);
    error_log("favorites search query: " . var_export($query, true));
    error_log("params: " . var_export($params, true));

    // Execute the SQL statement and fetch results
    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            // Format prices before returning
            foreach ($result as $game) {
                $game['originalPrice'] = format_price($game['originalPrice']);
                $game['discountPrice'] = format_price($game['discountPrice']);
            }
            unset($game); // Unset reference to the last element
            $games = $result;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for favorites: " . $e->getMessage(), "warning");
        error_log("Favorites Search Error: " . var_export($e, true));
    }

    return $games;
}

function _build_favorites_where_clause(&$query, &$params, $search)
{
    // Add conditions to the query based on the search parameters
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                case 'username':
                    $params[":username"] = "%$value%"; // Looking for any matching strings.
                    $query .= " AND u.username LIKE :username";
                    break;
                case 'title':
                    $params[":title"] = "%$value%"; // Looking for any matching strings.
                    $query .= " AND g.title LIKE :title";
                    break;
                case 'publisherName':
                    $params[":publisherName"] = "%$value%"; // Looking for any matching strings.
                    $query .= " AND g.publisherName LIKE :publisherName";
                    break;
                case 'description':
                    $params[":description"] = $value;
                    $query .= " AND g.description LIKE :description";
                    break;
                case 'releaseDate':
                    $params[":releaseDate"] = $value;
                    $query .= " AND g.releaseDate = :releaseDate";
                    break;
                case 'url':
                    $params[":url"] = $value;
                    $query .= " AND g.url LIKE :url";
                    break;
                case 'originalPrice':
                    $params[":originalPrice"] = $value;
                    $query .= " AND g.originalPrice <= :originalPrice";
                    break;
                case 'discountPrice':
                    $params[":discountPrice"] = $value;
                    $query .= " AND g.discountPrice <= :discountPrice";
                    break;
                case 'currencyCode':
                    $params[":currencyCode"] = $value;
                    $query .= " AND g.currencyCode LIKE :currencyCode";
                    break;
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
            $col = "title";
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

function _build_favorite_search_query(&$params, $search)
{
    $search_query = "SELECT 
            u.username,
            uf.user_id,
            g.id, 
            g.title, 
            g.publisherName, 
            g.description, 
            g.releaseDate, 
            g.url, 
            g.originalPrice,
            g.discountPrice, 
            g.currencyCode,
            g.created,
            g.modified
            FROM 
            UserFavorites uf
            JOIN Users u ON uf.user_id = u.id
            JOIN Games g ON uf.game_id = g.id
            WHERE 1=1";
    $total_query = "SELECT count(1) as total 
                    FROM UserFavorites uf
                    JOIN Games g ON uf.game_id = g.id
                    WHERE uf.user_id = :user_id";

    _build_favorites_where_clause($filter_query, $params, $search);

    // Added pagination (need limit and page to be in $search)
    // Produces a $total value for use in UI
    global $total;
    $total = (int)get_potential_total_records($total_query . $filter_query, $params);

    global $shown_records;
    $shown_records = (int)get_potential_total_records($total_query, $params);

    $limit = (int)se($search, "limit", 10, false);
    if (empty($limit) || $limit === 0) {
        $limit = 10;
    }
    // error_log("total records: $total");
    $page = (int)se($search, "page", "1", false);
    // Calculate offset based on limit and page
    $offset = ($page - 1) * $limit;
    $search_query .= $filter_query;
    if ($limit > 0 && $limit <= 100 && $page > 0) {
        $search_query .= " LIMIT $offset, $limit";
    }

    return $search_query;
}