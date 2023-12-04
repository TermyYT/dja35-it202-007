<?php
/**
 * This page is a partial file that renders a page navigation interface.
 * It contains the Previous button, the page number buttons, and the Next buttons.
 */
if (!isset($total)) {
    flash("Note to Dev: The total variable is undefined", "danger");
    error_log("Note to Dev: The total variable is undefined");
    $total = 1;
}

$per_page = (int)se($_GET, "limit", "10", false); // The default limit set per page is 10 records.
$page = se($_GET, "page", 1, false); // Starting with page 1.
$total_pages = ceil($total / $per_page); // Math to determine how many pages should be displayed in the interface.
error_log("Total value: " . var_export($total, true));
//updates or inserts page into query string while persisting anything already present
function persistQueryString($page)
{
    //set the query param for easily building
    $_GET["page"] = $page;
    //https://www.php.net/manual/en/function.http-build-query.php
    return http_build_query($_GET);
}
function disable_prev($page)
{
    echo $page < 1 ? "disabled" : "";
}
function set_active($page, $i)
{
    echo ($page - 1) == $i ? "active" : "";
}
function disable_next($page)
{
    global $total_pages;
    echo ($page) >= $total_pages ? "disabled" : "";
}
?>

<nav aria-label="Page Navigation"> <!-- Label changed as wished! -->
    <ul class="pagination justify-content-center">
        <li class="page-item <?php disable_prev(($page - 1)) ?>">
            <a class="page-link" href="?<?php se(persistQueryString($page - 1)); ?>" tabindex="-1">Previous</a> <!-- The Previous button. -->
        </li>
        <?php for ($i = 0; $i < $total_pages; $i++) : ?>
            <!-- Creating all the page number buttons inbetween. -->
            <li class="page-item <?php set_active($page, $i); ?>"><a class="page-link" href="?<?php se(persistQueryString($i + 1)); ?>"><?php echo ($i + 1); ?></a></li>
        <?php endfor; ?>
        <li class="page-item <?php disable_next($page); ?>">
            <a class="page-link" href="?<?php se(persistQueryString($page + 1)); ?>">Next</a> <!-- The Next button. -->
        </li>
    </ul>
</nav>