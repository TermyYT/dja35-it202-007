<?php
// make columns options for order by
// map order columns
$cols = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $VALID_ORDER_COLUMNS); //$VALID_ORDER_COLUMNS is defined in cat_helpers.php
array_unshift($cols, ["label" => "Any", "value" => ""]);

$orders = ["asc", "desc"];
$orders = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $orders);
array_unshift($orders, ["label" => "Any", "value" => ""]);
?>

<form method="GET">
    <div class="row">
        <div class="col-auto">
            <?php render_input(["type" => "text", "id" => "title", "name" => "title", "label" => "Title", "value" => se($search, "title", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "text", "id" => "publisherName", "name" => "publisherName", "label" => "Publisher", "value" => se($search, "publisherName", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "date", "id" => "releaseDate", "name" => "releaseDate", "label" => "Release Date", "value" => se($search, "releaseDate", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "number", "id" => "currentPrice", "name" => "currentPrice", "label" => "Current Price", "value" => se($search, "currentPrice", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "number", "id" => "discountPrice", "name" => "discountPrice", "label" => "Discount Price", "value" => se($search, "discountPrice", "", false)]); ?>
        </div>
        <!-- Add other fields as needed -->
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "column", "name" => "column", "label" => "Columns", "options" => $cols, "value" => se($search, "column", "", false)]); ?>
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