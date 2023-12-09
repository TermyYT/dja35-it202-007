<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

$search["isFavorite"] = 0; // Only displays games with isFavorite set to 0.
$totalSearch["isFavorite"] = 0;

// Checks if the user is logged in.
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}

// Checks if the user has the Admin role.
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

// search_games() function is in game_helpers.php
$games = search_games();

// Format prices before rendering the table
foreach ($games as &$game) {
    $game['originalPrice'] = format_price($game['originalPrice']);
    $game['discountPrice'] = format_price($game['discountPrice']);
}
unset($game); // Unset reference to the last element

// Creates table with corresponding values. ADMIN version has a delete function.
$table = ["data" => $games,
"view_url" => "admin/game_viewer.php",
];
$table["ignored_columns"] = [/*"id",*/ "publisherName", "url", "created", "modified"];
?>

<div class="container-fluid">
    <h1>All Unfavorited Games</h1>
    <?php
    // Display the total and visible records associated with the user;
    echo "<h4>Total: $total_records | Shown: " . count($games) . "</h4>";
    ?>
    <div>
        <?php include(__DIR__ . "/../../../partials/game_search_form.php"); ?> <!-- Uses the search_form partial file to construct search form fields. -->
    </div>
    <div>
        <?php render_table($table); ?> <!-- Calls table.php partial file. -->
    </div>
    <div class="row">
        <?php include(__DIR__ . "/../../../partials/pagination_nav.php"); ?> <!-- Adds pagination. -->
    </div>
</div>
<style>
    thead { text-transform: capitalize;}
    a { text-decoration: none;}
</style>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>