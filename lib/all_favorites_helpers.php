<?php
require_once("game_helpers.php");
require_once("favorite_helpers.php");

function search_all_favorites() // Initializing the search for favorites.
{
    global $search;
    if (isset($search) && !empty($search)) {
        $search = array_merge($search, $_GET);
    } else {
        $search = $_GET;
    }
    $games = [];
    $params = [];

    error_log("Search prior to query: " . var_export($search, true));
    $query = _build_all_favorites_search_query($params, $search);

    $db = getDB();
    $stmt = $db->prepare($query);

    bind_params($stmt, $params);
    error_log("all favorites search query: " . var_export($query, true));
    error_log("params: " . var_export($params, true));

    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $game) {
                $game['originalPrice'] = format_price($game['originalPrice']);
                $game['discountPrice'] = format_price($game['discountPrice']);
            }
            unset($game);
            $games = $result;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for favorites: " . $e->getMessage(), "warning");
        error_log("All Favorites Search Error: " . var_export($e, true));
    }

    return $games;
}

function _build_all_favorites_where_clause(&$query, &$params, $search) // WHERE clause is split off into its own function for modularity.
{
    // Add conditions to the query based on the search parameters
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                case 'username':
                    $params[":username"] = "%$value%";
                    $query .= " AND u.username LIKE :username";
                    break;
                case 'title':
                    $params[":title"] = "%$value%";
                    $query .= " AND g.title LIKE :title";
                    break;
                case 'publisherName':
                    $params[":publisherName"] = "%$value%";
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
            $col = "username";
        }
        if (!in_array($order, ["asc", "desc"])) {
            $order = "asc";
        }
        // Special mapping to use table name prefix to resolve ambiguity error
        if (in_array($col, ["created", "modified"])) {
            $col = "uf.$col";
        }
        $query .= " ORDER BY $col $order";
    }
}

function _build_all_favorites_search_query(&$params, $search) // Assembling the search query.
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
            g.modified,
            (SELECT COUNT(1) FROM UserFavorites uf2 WHERE uf2.game_id = uf.game_id) as totalUsers
            FROM 
            UserFavorites uf
            JOIN Users u ON uf.user_id = u.id
            JOIN Games g ON uf.game_id = g.id
            WHERE 1=1";
    $total_query = "SELECT COUNT(DISTINCT uf.game_id) AS total
                    FROM UserFavorites uf
                    JOIN Games g ON uf.game_id = g.id
                    JOIN Users u ON uf.user_id = u.id";

    _build_all_favorites_where_clause($filter_query, $params, $search);

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
    $page = (int)se($search, "page", "1", false);
    // Calculate offset based on limit and page
    $offset = ($page - 1) * $limit;
    $search_query .= $filter_query;
    if ($limit > 0 && $limit <= 100 && $page > 0) {
        $search_query .= " LIMIT $offset, $limit";
    }

    return $search_query;
}