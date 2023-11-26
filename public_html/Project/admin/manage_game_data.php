<?php
/*
This is the main page where the ADMIN user can perform a search for
API data and populate the database 'Games' table with data. While
process_games() can be mended to take in very specific titles, the
current state takes in those titles and then some extras. It helps
to populate the database such that the database can more easily be
the first point of access for retrieving game information as opposed
to the API itself. If a user wishes to alter the function, however,
they can.
*/
require(__DIR__ . "/../../../partials/nav.php");
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}
//TODO need to update insert_games... to use the $mappings array and not go based on is_int for value
function insert_games_into_db($db, $games, $mappings) // Inserts games into the database and handles duplicate data.
{
    // Prepare SQL query
    $query = "INSERT INTO `Games` ";
    if (count($games) > 0) {
        $cols = array_keys($games[0]);
        $query .= "(" . implode(",", array_map(function ($col) {
            return "`$col`";
        }, $cols)) . ") VALUES ";

        // Generate the VALUES clause for each game
        $values = [];
        foreach ($games as $i => $game) {
            $gamePlaceholders = array_map(function ($v) use ($i) {
                return ":" . $v . $i;
            }, $cols);
            $values[] = "(" . implode(",", $gamePlaceholders) . ")";
        }

        $query .= implode(",", $values);
        
        // Generate the ON DUPLICATE KEY UPDATE clause
        $updates = array_reduce($cols, function ($carry, $col) {
            $carry[] = "`$col` = VALUES(`$col`)";
            return $carry;
        }, []);

        $query .= " ON DUPLICATE KEY UPDATE " . implode(",", $updates); // How duplicate records are handled.

        // Prepare the statement
        $stmt = $db->prepare($query);

        // Bind the parameters for each game
        foreach ($games as $i => $game) {
            foreach ($cols as $col) {
                $placeholder = ":$col$i";
                $val = isset($game[$col]) ? $game[$col] : "";
                $param = PDO::PARAM_STR;
                if (str_contains($mappings[$col], "int")) {
                    $param = PDO::PARAM_INT;
                }
                $stmt->bindValue($placeholder, $val, $param);
            }
        }

        // Execute the statement
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log(var_export($e, true));
        }
    }
}

function process_single_game($game, $columns, $mappings) // Maps a single game's data from the API to the database columns.
{
    // Prepare record
    $record = [];
    $record["api_id"] = se($game, "id", "", false);
    $record["title"] = se($game, "title", "", false);
    $record["publisherName"] = se($game, "publisherName", "", false);
    $record["description"] = se($game, "description", "", false);

    // Parse the releaseDate from API in the format of MySQL's DATE.
    $releaseDate = se($game, "releaseDate", "", false);
    $dateTime = new DateTime($releaseDate);
    $record["releaseDate"] = $dateTime->format("Y-m-d");

    $record["url"] = se($game, "url", "", false);
    $record["originalPrice"] = (int)se($game, "currentPrice", 0, false); // The actual "originalPrice" field in the API was not desirable, but for the sake of this site, we note it down as originalPrice, anyway.
    $record["discountPrice"] = (int)se($game["price"]["totalPrice"], "discountPrice", 0, false);
    $record["currencyCode"] = se($game["price"]["totalPrice"], "currencyCode", "", false);

    // Map game data to columns - for things with duplicate names
    /*    foreach ($columns as $column) {        
        if (array_key_exists($column, $game)) {
            $record[$column] = $game[$column];
            if (empty($record[$column])) {
                if (str_contains($mappings[$column], "int")) {
                    $record[$column] = "0";
                }
            }
        }
    }*/
    // Decode HTML entities for certain columns
    $htmlDecodedColumns = ["title", "publisherName", "description", "currencyCode"]; // The fields that return strings must be decoded.
    foreach ($htmlDecodedColumns as $column) {
        if (isset($record[$column])) {
            $record[$column] = htmlspecialchars_decode($record[$column], ENT_QUOTES);
        }
    }
    error_log("Record: " . var_export($record, true));
    return $record;
}

function process_games($result/*, $searchTerm = null*/) // Processes the API response, extracts data, and triggers the insertion into the database.
{
    $status = se($result, "status", 400, false);
    if ($status != 200) { // Status 200 is a success.
        return;
    }

    // Extract data from result
    $data_string = html_entity_decode(se($result, "response", "{}", false)); // We decode the result from the API here.
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        return;
    }
    $data = $data["data"];
    error_log("data: " . var_export($data, true));
    $status = se($data, "status", "", false);
    error_log("Status: " . var_export($status, true));
    if ($status == "No games found") {
        flash("No games were found. Please try again.", "warning");
        return;
    }
    // Get columns from Games table
    if (!empty($data)) {
        $db = getDB();
        $stmt = $db->prepare("SHOW COLUMNS FROM Games");
        $stmt->execute();
        $columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Prepare columns and mappings
        $columns = array_column($columnsData, 'Field');
        $mappings = [];
        foreach ($columnsData as $column) {
            $mappings[$column['Field']] = $column['Type'];
        }
        $ignored = ["id", "created", "modified"]; // These columns will be automatically populated in the db.
        $columns = array_diff($columns, $ignored);

        // Process each game
        $games = [];
        foreach ($data as $game) {
            // Check if the game title contains the search term - Can be uncommented for more specific searches.
            /*if ($searchTerm !== null && stripos($game['title'], $searchTerm) === false) {
                continue; // Skip this game if the title doesn't match the search term.
            }*/
            $record = process_single_game($game, $columns, $mappings); // Processes a single game's data and maps it.
            array_push($games, $record);
        }
        // Insert games into database
        insert_games_into_db($db, $games, $mappings); // The call to push all the data into the database.
        flash ("Games added to database", "success");
    } else {
        flash("No games were found. Please try again.", "warning");
    }
}
function process_search($searchTerm) // We begin the process of fetching API data through this search. This page is only available to the ADMIN role.
{
    $encodedSearchTerm = urlencode($searchTerm);
    $result = get("https://epic-store-games.p.rapidapi.com/onSale", "GAME_API_KEY", ["searchWords" => $encodedSearchTerm, "limit" => 75, "page" => 0], true);
process_games($result/*, $searchTerm*/);
}
$action = se($_POST, "action", "", false);
if ($action) {
    switch ($action) {
        case "games":
            $result = get("https://epic-store-games.p.rapidapi.com/onSale", "GAME_API_KEY", ["limit" => 75, "page" => 0], true);
            process_games($result);
            break;
        case "search":
            $searchTerm = se($_POST, "searchTerm", "", false);
            process_search($searchTerm);
            break;
    }
}
?>
<div class="container-fluid">
    <h1>Game Database Management</h1>
    <!-- Search form -->
    <div class="row mt-3">
        <div class="col">
            <form method="POST">
                <input type="hidden" name="action" value="search" />
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for games..." name="searchTerm" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button> <!-- The button that is clicked to initiate the API search. -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once(__DIR__ . "/../../../partials/flash.php");