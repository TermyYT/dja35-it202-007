<?php
function render_input($data = array())
{
    include(__dir__ . "/../partials/input_field.php");
}
function render_button($data = array())
{
    include(__DIR__ . "/../partials/button.php");
}
function render_table($data = array()) // This is for the ADMIN table.
{
    include(__DIR__ . "/../partials/table.php");
}
/*function render_user_table($data = array()) // This is for the USER table. OUTDATED!
{
    include(__DIR__ . "/../partials/user_table.php");
}*/