<?php
// The columns to order the table by.
$VALID_ORDER_COLUMNS = ["title", "releaseDate", "originalPrice", "discountPrice", "id"];
function search_games()
{
    // Initialize variables
    global $search; // Make search available outside of this function
    $search = $_GET;
    $games = [];
    $params = [];

    // Build the SQL query
    $query = _build_search_query($params, $search);

    // Prepare the SQL statement
    $db = getDB();
    $stmt = $db->prepare($query);

    // Bind parameters to the SQL statement
    bind_params($stmt, $params);
    error_log("search query: " . var_export($query, true));
    error_log("params: " . var_export($params, true));

    // Execute the SQL statement and fetch results
    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            // Format prices before returning
            foreach ($result as $game) {
                $game['Original Price'] = format_price($game['Original Price']);
                $game['Discount Price'] = format_price($game['Discount Price']);
            }
            unset($game); // Unset reference to the last element
            $games = $result;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for games: " . $e->getMessage(), "warning");
        error_log("Game Search Error: " . var_export($e, true));
    }

    return $games;
}
// Convert cents to dollars and format as currency.
function format_price($price) {
    if (is_numeric($price)) {
        // Convert the price to a formatted string.
        return number_format($price / 100, 2);
    } else {
        // Handle non-numeric or empty values by returning a placeholder string.
        return 'xx.xx';
    }
}
function get_potential_total_records($query, $params)
{
    if (!str_contains($query, "total")) {
        throw new Exception(("This query expects a 'total' column to be fetched"));
    }
    $db = getDB();
    $stmt = $db->prepare($query);
    
    // Temporarily remove mappings that don't exist for the total query
    // Note: This is okay as $params is passed by value in this case, not by reference
    $params = array_filter($params, function ($key) use ($query) {
        return str_contains($query, $key);
    }, ARRAY_FILTER_USE_KEY);
    
    bind_params($stmt, $params);
    $total = 0;
    
    try {
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result && isset($result["total"])) {
            $total = (int)$result["total"];
            error_log("Total potential records: $total");
        }
    } catch (PDOException $e) {
        error_log("Error fetching total count for query: " . var_export($e, true));
    }
    
    return $total;
}
function _build_where_clause(&$query, &$params, $search)
{
    // Add conditions to the query based on the search parameters
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
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
                    $query .= " AND g.originalPrice = :originalPrice";
                    break;
                case 'discountPrice':
                    $params[":discountPrice"] = $value;
                    $query .= " AND g.discountPrice = :discountPrice";
                    break;
                case 'currencyCode':
                    $params[":currencyCode"] = $value;
                    $query .= " AND g.currencyCode LIKE :currencyCode";
                    break;
                case "id":
                    $params[":id"] = $value;
                    $query .= " AND g.id = :id";
                    break;
            }
        }
    }

    // Order by
    if (isset($search["column"]) && !empty($search["column"]) && isset($search["order"]) && !empty($search["order"])) {
        global $VALID_ORDER_COLUMNS; // Defined at the top of this page.
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
            $col = "g.$col";
        }
        $query .= " ORDER BY $col $order"; //<-- Be absolutely sure you trust these values; we can't bind certain parts of the query due to how the parameter mapping works
    }
        // DJA35 - 11/27/2023
    // Limit condition - Takes value. Limits it from 1 to 100. Appends it to query. Default is 10.
    if (isset($search["limit"]) && !empty($search["limit"])) {
        $limit = (int)$search["limit"];
        $limit = max(1, min(100, $limit)); // Ensures the limit is between 1 and 100.
        $query .= " LIMIT $limit";
    } else {
        // Use the default limit of 10.
        $query .= " LIMIT 10";
    }
    return $query;
}
function _build_search_query(&$params, $search)
{
    $search_query = "SELECT 
            g.id, 
            TRIM(g.title) AS 'Title', 
            TRIM(g.publisherName) AS 'Publisher', 
            g.description AS 'Description', 
            g.releaseDate AS 'Release Date', 
            g.url AS 'URL', 
            g.originalPrice AS 'Original Price',
            g.discountPrice AS 'Discount Price', 
            g.currencyCode AS 'Currency Code',
            g.created AS 'Created',
            g.modified AS 'Modified'
            FROM 
            Games AS g
            WHERE 1=1";
    $total_query = "SELECT count(1) as total FROM Games AS g WHERE 1=1";
    
    _build_where_clause($filter_query, $params, $search);

    // Added pagination (need limit and page to be in $search)
    // Produces a $total value for use in UI
    global $total;
    $total = (int)get_potential_total_records($total_query . $filter_query, $params);
    $limit = (int)se($search, "limit", 10, false);
    error_log("total records: $total");
    $page = (int)se($search, "page", "1", false);
    if ($limit > 0 && $limit <= 100 && $page > 0) {
        $offset = ($page - 1) * $limit;
        if (is_numeric($offset) && is_numeric($limit)) {
            $filter_query .= " LIMIT $offset, $limit"; // Offset is how many records to skip, limit is up to how many records to return for the page.
        }
    }

    return $search_query . $filter_query;
}
/**
 * Dynamically binds parameters based on value data type
 */
function bind_params($stmt, $params)
{
    // Bind parameters to the SQL statement
    foreach ($params as $k => $v) {
        $type = PDO::PARAM_STR;
        if (is_null($v)) {
            $type = PDO::PARAM_NULL;
        } elseif (is_numeric($v)) {
            $type = PDO::PARAM_INT;
        }
        $stmt->bindValue($k, $v, $type);
    }
}