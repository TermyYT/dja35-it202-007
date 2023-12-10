<?php
$search = $_GET;
$columns = ["title", "publisherName", "releaseDate", "originalPrice", "discountPrice", "currencyCode"];
$VALID_FAVORITE_COLUMNS = ["title", "releaseDate", "originalPrice", "discountPrice"];

$columns = array_map(function ($v) {
    return ["label" => $v, "value" => ($v)];
}, $VALID_FAVORITE_COLUMNS);
array_unshift($columns, ["label" => "(Select a column...)", "value" => ""]);

$orders = ["asc", "desc"];
$orders = array_map(function ($v) {
    return ["label" => $v, "value" => ($v)];
}, $orders);
array_unshift($orders, ["label" => "(Order by...)", "value" => ""]);
?>
<form method="GET">
    <div class="row">
        <div class="col-auto">
            <?php render_input(["type" => "text", "id" => "username", "name" => "username", "label" => "Username", "value" => se($search, "username", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "text", "id" => "title", "name" => "title", "label" => "Title", "value" => se($search, "title", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "date", "id" => "releaseDate", "name" => "releaseDate", "label" => "Release Date", "value" => se($search, "releaseDate", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "number", "id" => "originalPrice", "name" => "originalPrice", "label" => "Original Price", "value" => se($search, "originalPrice", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "number", "id" => "discountPrice", "name" => "discountPrice", "label" => "Discount Price", "value" => se($search, "discountPrice", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "column", "name" => "column", "label" => "Columns", "options" => $columns, "value" => se($search, "column", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "order", "name" => "order", "label" => "Order", "options" => $orders, "value" => se($search, "order", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "number", "id" => "limit", "name" => "limit", "label" => "Record Limit (1-100)", "min" => 1, "max" => 100, "value" => se($search, "limit", "10", false)]); ?>
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