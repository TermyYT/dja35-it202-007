<?php
$search = $_GET;
$columns = ["title", "publisherName", "releaseDate", "originalPrice", "discountPrice", "currencyCode"];
$VALID_FAVORITE_COLUMNS = ["title", "publisherName", "releaseDate", "originalPrice", "discountPrice", "currencyCode"];

$columns = array_map(function ($v) {
    return ["label" => str_replace("_", " ", $v), "value" => strtolower($v)];
}, $VALID_FAVORITE_COLUMNS);
array_unshift($columns, ["label" => "Any", "value" => ""]);

$orders = ["asc", "desc"];
$orders = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $orders);
array_unshift($orders, ["label" => "Any", "value" => ""]);
?>

<form method="GET">
    <div class="row">
        <div class="col-auto">
            <?php render_input(["type" => "select", "id" => "column", "name" => "column", "label" => "Columns", "options" => $columns, "value" => se($search, "column", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "order", "name" => "order", "label" => "Order", "options" => $orders, "value" => se($search, "order", "", false)]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <?php render_button(["type" => "submit", "text" => "Search"]); ?>
        </div>
        <div class="col-1">
            <a class="btn btn-secondary" href="?">Reset</a>
        </div>
    </div>
</form>
<style>
    option {
        text-transform: capitalize;
    }
</style>
