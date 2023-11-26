<?php
// The columns to order the table by.
$VALID_ORDER_COLUMNS = ["title", "releaseDate", "originalPrice", "discountPrice", "id"];
function search_games()
{
    // Initialize variables
    global $search; // make search available outside of this function
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
// Used to build the search query for the multi-view table.
function _build_search_query(&$params, $search)
{
    $query = "SELECT 
            g.id, -- Can't rename because it messes with rendering.
            TRIM(g.title) AS 'Title', -- Getting rid of excess whitespace.
            TRIM(g.publisherName) AS 'Publisher', -- Getting rid of excess whitespace.
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
            $col = "c.$col";
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
        } else if (is_numeric($v)) {
            $type = PDO::PARAM_INT;
        }
        $stmt->bindValue($k, $v, $type);
    }
}

// Is used to validate the posted game details on game_edit.php and admin/game_profile.php.
function validate_game($game) {
    error_log("game: " . var_export($game, true));
    $title = se($game, "title", "", false);
    $publisherName = se($game, "publisherName", "", false);
    $description = se($game, "description", "", false);
    $releaseDate = se($game, "releaseDate", "", false);
    $url = se($game, "url", "", false);
    $originalPrice = (int)se($game, "originalPrice", -1, false);
    $discountPrice = (int)se($game, "discountPrice", -1, false);
    $currencyCode = se($game, "currencyCode", "", false);

    $has_error = false;
    // DJA35 - 11/27/2023 - Backend Game Validation
    // Title rules
    if (empty($title) || strlen($title) < 2) {
        flash("Title must be at least 2 characters long", "warning");
        $has_error = true;
    }
    // Publisher Name
    if (empty($publisherName) || strlen($publisherName) < 2) {
        flash("Publisher name must be at least 2 characters long", "warning");
        $has_error = true;
    }
    // Description
    if (empty($description)) {
        flash("Description cannot be empty", "warning");
        $has_error = true;
    }
    // Release Date
    if (!empty($releaseDate) && !validate_date($releaseDate)) {
        flash("Invalid Release Date format", "warning");
        $has_error = true;
    }
    // URL
    if (empty($url) || strpos($url, "https://store.epicgames.com/") !== 0) {
        flash("URL must start with 'https://store.epicgames.com/'", "warning");
        $has_error = true;
    }
    // Original Price
    if ($originalPrice == -1) {
        flash("Original Price must be entered", "warning");
        $has_error = true;
    } else if ($originalPrice < 0) {
        flash("Original Price must be a non-negative value", "warning");
        $has_error = true;
    }
    // Discount Price
    if ($discountPrice == -1) {
        flash("Discount Price must be entered", "warning");
        $has_error = true;
    } else if ($discountPrice < 0) {
        flash("Discount Price must be a non-negative value", "warning");
        $has_error = true;
    }
    // Currency Code
    if (strlen($currencyCode) != 3) {
        flash("Invalid currency code", "warning");
        $has_error = true;
    }
    return !$has_error;
}

// Additional function for validating date format in validate_game().
function validate_date($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}
/*function get_images_from_api_by_breed($api_breed_id)
{
    $data = [
        "has_breeds" => "true", "order" => "RANDOM", "include_breeds" => "true",
        "limit" => 25
    ];
    if (isset($api_breed_id) && !empty($api_breed_id)) {
        $data["breed_ids"] = $api_breed_id;
    }
    $results = get("https://api.thecatapi.com/v1/images/search", "CAT_API_KEY",  $data, false);
    if(isset($results) && isset($results["status"]) && $results["status"] == 200){
        return json_decode($results["response"], true);
    }
    return [];
}

function _store_images($images){
    $data = [];
    error_log("incoming images: " . var_export($images,true));
    foreach($images as $img){
        if(isset($img["breeds"])){
            foreach($img["breeds"] as $breed){
                array_push($data, ["api_id"=>$img["id"], "url"=>$img["url"], "api_breed_id"=> $breed["id"]]);
            }
        }
    }
    $query = "INSERT INTO CA_Images(breed_id,api_breed_id, api_id, url) VALUES ";
    $values = [];
    $placeholders = [];
    $i = 0;
    foreach($data as $record){
        $placeholders[] = "((SELECT id from CA_Breeds WHERE api_id = :b$i),:api_breed_id$i, :api_id$i, :url$i)";
        $values[] = [":b$i"=>$record["api_breed_id"], ":api_breed_id$i"=>$record["api_breed_id"], ":api_id$i"=>$record["api_id"], ":url$i"=>$record["url"]];
        $i++;
        
    }
    $query .= implode(',', $placeholders);
    $query .= " ON DUPLICATE KEY UPDATE modified = CURRENT_TIMESTAMP()";
    error_log("store images query: " . var_export($query, true));
    $db = getDB();
    $stmt = $db->prepare($query);
    foreach($values as $index=>$val){
        foreach($val as $key=>$v){
            $stmt->bindValue($key, $v);
        }
    }
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error inserting image data: " . var_export($e, true));
    }
}

function get_breeds()
{
    $db = getDB();
    $query = "SELECT id, api_id, name FROM CA_Breeds";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        //error_log("Breed results: " . var_export($result, true));
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching breeds from db: " . var_export($e, true));
    }
    return [];
}

function get_images_by_breed_id($breed_id, $random = false, $retries=3)
{
    if($retries <= 0){
        return [];
    }
    $db = getDB();

    $query = "SELECT id, url, max(modified) as 'last_modified' FROM CA_Images ";
    $params = [];
    if($breed_id > 0){
        $query .= " WHERE breed_id = :id";
        $params[":id"] = $breed_id;
    }
    $query .= " GROUP BY id, url";
    if($random){
        $query .= " ORDER BY RAND()";
    }
    $query .= " LIMIT 10";
    error_log("get images by breed query: " . var_export($query, true));
    $stmt = $db->prepare($query);
    $images = [];
    try {
        $stmt->execute($params);
        $result = $stmt->fetchAll();
        if ($result) {
            $images = $result;
        }
    } catch (PDOException $e) {
        error_log("Error fetching images by internal breed id: " . var_export($e, true));
    }
    
    //check cache expirey
    $fetchFromAPI = false;
    $cache_life_in_hours = 6;
    if (count($images) > 0) {
        $date = strtotime($images[0]["last_modified"]);
        // Convert MySQL timestamp to PHP DateTime object
        error_log("mysql date $date");
        if(is_numeric($date)){
            $date1 = DateTime::createFromFormat("U", $date);
        }
        else{
            $date1 = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        }
        

        // Current date
        $now = new DateTime();

        // Calculate difference
        $interval = $date1->diff($now);

        // Get number of hours
        // The 'h' property of the DateInterval object gives the number of hours, 
        // but this only includes the hours that are not part of the full days. 
        // To get the total number of hours, we need to add the hours that are part of the full days, 
        // which is calculated as 'days * 24'.
        $hours = $interval->h + ($interval->days * 24);
        if ($hours >= $cache_life_in_hours) {
            $fetchFromAPI = true;
        }
    } else if (count($images) == 0) {
        $fetchFromAPI = true;
    }
    if ($fetchFromAPI) {
        $query = "SELECT api_id FROM CA_Breeds WHERE id = :id";
        $stmt = $db->prepare($query);
        $api_breed_id = "";
        try {
            $stmt->execute([":id" => $breed_id]);
            $result = $stmt->fetch();
            if ($result && isset($result["api_id"])) {
                $api_breed_id = $result["api_id"];
            }
        } catch (PDOException $e) {
            error_log("Error looking up breed id: " . var_export($e, true));
        }
        if(!empty($api_breed_id)){
            $refresh = count($images) === 0;
            $images = get_images_from_api_by_breed($api_breed_id);
            _store_images($images);
            if($refresh && count($images) > 0){
                $retries--;
                return get_images_by_breed_id($breed_id, $random, $retries);
            }
        }
    }
    return $images;
}

function validate_cat($cat){
    error_log("cat: " . var_export($cat, true));
    $name = se($cat, "name", "", false);
    $has_error = false;
    // name rules
    if(empty($name)){
        flash("Name is required", "warning");
        $has_error = true;
    }
    if(strlen($name) < 2){
        flash("Name must be at least 2 characters", "warning");
        $has_error = false;
    }
    //breed_id
    $breed = (int)se($cat, "breed_id", 0, false);
    if($breed === 0){
        flash("Must select a valid breed", "warning");
        $has_error = false;
    }
    //breed_extra is optional
    //sex
    $sex = se($cat, "sex", "", false);
    if(empty($sex)){
        flash("A sex must be selected", "warning");
        $has_error = true;
    }
    if(!in_array($sex, ["f","m"])){
        flash("Must select a valid sex option", "warning");
        $has_error = true;
    }
    //fixed is a boolean so we can likely ignore
    //born I'm not concerned with this value, but you may need to validate your dates (like min/max)
    //weight
    $weight = (float)se($cat, "weight", -1, false);
    if($weight == -1){
        flash("Weight must be entered", "warning");
        $has_error = true;
    }
    else if($weight < 0){
        flash("Weight must be a positive value", "warning");
        $has_error = true;
    }
    //description
    $desc = se($cat, "description", "", false);
    if(empty($desc)){
        flash("Description is required", "warning");
        $has_error = false;
    }
    else if(strlen($desc) < 2){
        flash("Description needs to be at least 2 characters", "warning");
        $has_error = true;
    }
    return !$has_error;
}
function get_breed_by_id($id)
{
    error_log("Checking breed: " . var_export($id, true));
    $db = getDB();
    // In this case I do want all the data
    $query = "SELECT * FROM CA_Breeds WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id);
    try {
        $stmt->execute();
        $result = $stmt->fetch();
        //error_log("Breed results: " . var_export($result, true));
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching breeds from db: " . var_export($e, true));
    }
    return [];
}

function get_temperaments()
{
    $db = getDB();
    $query = "SELECT id, name FROM CA_Temperaments;";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching temperaments from db: " . var_export($e, true));
    }
    return [];
}*/
// Note: & tells php to pass by reference so any changes made to $params are reflected outside of the function
/*function _build_search_query_old(&$params, $search)
{
    $query = "SELECT 
            c.id, 
            c.breed_id,
            c.name, 
            c.description, 
            b.name as breed, 
            CASE 
                WHEN c.sex = 'm' THEN 'Male'
                WHEN c.sex = 'f' THEN 'Female'
                ELSE 'N/A'
            END as sex, 
            c.fixed, 
            TIMESTAMPDIFF(YEAR, c.born, CURDATE()) AS age, 
            c.status,
            (SELECT GROUP_CONCAT(url SEPARATOR ', ') FROM CA_CatImages as CI JOIN CA_Images I on I.id = CI.image_id WHERE CI.cat_id = c.id LIMIT :image_limit) as urls,
            (SELECT GROUP_CONCAT(t.name SEPARATOR ', ') FROM CA_Temperaments t JOIN CA_BreedTemperaments bt on t.id = bt.temperament_id WHERE bt.breed_id = c.breed_id LIMIT 1) as temperament
            FROM 
            CA_Cats as c JOIN CA_Breeds as b on c.breed_id = b.id
            WHERE 1=1";
    $params[":image_limit"] = 1;
    // Add conditions to the query based on the search parameters
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                case 'breed_id':
                    $params[":breed_id"] = $value;
                    $query .= " AND c.breed_id = :breed_id";
                    break;
                case 'status':
                    $params[":status"] = $value;
                    $query .= " AND c.status = :status";
                    break;
                case 'sex':
                    $params[":sex"] = $value;
                    $query .= " AND sex = :sex";
                    break;
                case 'fixed':
                    $params[":fixed"] = $value;
                    $query .= " AND fixed = :fixed";
                    break;
                case 'age_min':
                case 'age_max':
                    $min = se($search, "age_min", "0", false);
                    $max = se($search, "age_max", "999", false);
                    if (empty($min)) {
                        $min = "0";
                    }
                    if (empty($max)) {
                        $max = "999";
                    }
                    $params[":age_min"] = $min;
                    $params[":age_max"] = $max;
                    $query .= " AND TIMESTAMPDIFF(YEAR, c.born, CURDATE()) BETWEEN :age_min AND :age_max ";
                    break;
                case 'name':
                    $params[":name"] = "%$value%"; //partial match
                    $query .= " AND c.name like :name";
                    break;
                case 'temperament':
                    $i = 0;
                    $keys = [];
                    foreach ($value as $t) {
                        if (empty($t)) { //ignore "any"
                            continue;
                        }
                        $params[":t$i"] = $t;
                        array_push($keys, ":t$i");
                        $i++;
                    }
                    if (count($keys) > 0) {
                        $keys = join(",", $keys);
                        $query .= " AND c.breed_id in (SELECT bt.breed_id FROM CA_Temperaments t JOIN CA_BreedTemperaments bt on t.id = bt.temperament_id WHERE t.id in ($keys))";
                    }
                    break;
                case "id":
                    $params[":id"] = $value;
                    $query .= " AND c.id = :id";
                    break;
                case "image_limit":
                    $params[":image_limit"] = (int)$value;
                    break;
            }
        }
    }

    if (!has_role("Admin")) {
        $query .= " AND status != 'unavailable'";
    }
    // order by
    if (isset($search["column"]) && !empty($search["column"]) && isset($search["order"]) && !empty($search["order"])) {
        global $VALID_ORDER_COLUMNS;
        $col = $search["column"];
        $order = $search["order"];
        // prevent SQL injection by checking it against a hard coded list
        if (!in_array($col, $VALID_ORDER_COLUMNS)) {
            $col = "name";
        }
        if (!in_array($order, ["asc", "desc"])) {
            $order = "asc";
        }
        // special mapping to use table name prefix to resolve ambiguity error
        if (in_array($col, ["created", "modified"])) {
            $col = "c.$col";
        }
        $query .= " ORDER BY $col $order"; //<-- be absolutely sure you trust these values; we can't bind certain parts of the query due to how the parameter mapping works
    }
    // limit last
    $query .= " LIMIT 10";


    return $query;
}*/