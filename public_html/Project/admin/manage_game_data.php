<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}
//TODO need to update insert_games... to use the $mappings array and not go based on is_int for value
function insert_games_into_db($db, $games, $mappings)
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

        $query .= " ON DUPLICATE KEY UPDATE " . implode(",", $updates);

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

function process_single_game($game, $columns, $mappings)
{
    // Prepare record
    $record = [];
    $record["api_id"] = se($game, "id", "", false);
    $record["title"] = se($game, "title", "", false);
    $record["publisherName"] = se($game, "publisherName", "", false);
    $record["description"] = se($game, "description", "", false);

    //Parse date from API in the format of MySQL's DATETIME
    $effectiveDate = se($game, "effectiveDate", "", false);
    $dateTime = new DateTime($effectiveDate);
    $record["effectiveDate"] = $dateTime->format("Y-m-d H:i:s");

    $record["url"] = se($game, "url", "", false);
    $record["originalPrice"] = (int)se($game["price"]["totalPrice"], "originalPrice", 0, false);
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
    error_log("Record: " . var_export($record, true));
    return $record;
}

function process_games($result)
{
    $status = se($result, "status", 400, false);
    if ($status != 200) {
        return;
    }

    // Extract data from result
    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        return;
    }
    $data = $data["data"];
    error_log("data: " . var_export($data, true));
    // Get columns from Games table
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
    $ignored = ["id", "created", "modified"];
    $columns = array_diff($columns, $ignored);

    // Process each game
    $games = [];
    foreach ($data as $game) {
        $record = process_single_game($game, $columns, $mappings);
        array_push($games, $record);
    }
    // Insert games into database
    insert_games_into_db($db, $games, $mappings);
}

$action = se($_POST, "action", "", false);
if ($action) {
    switch ($action) {
        case "games":
            $result = get("https://epic-store-games.p.rapidapi.com/onSale", "GAME_API_KEY", ["limit" => 75, "page" => 0], true);
            process_games($result);
            break;
    }
}
?>

<div class="container-fluid">
    <h1>Game Data Management</h1>
    <div class="row">
        <div class="col">
            <!-- Game refresh button -->
            <form method="POST">
                <input type="hidden" name="action" value="games" />
                <input type="submit" class="btn btn-primary" value="Refresh Games" />
            </form>
        </div>
    </div>
</div>
