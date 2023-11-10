<?php
require(__DIR__."/../../partials/nav.php");
?>
<h1>Home</h1>
<?php
if(is_logged_in()){
    flash("Welcome, " . get_user_email());
}
else{
    flash("You're not logged in");
}
/*if(isset($_SESSION["user"]) && isset($_SESSION["user"]["email"])){
 echo "Welcome, " . $_SESSION["user"]["email"]; 
}
else{
  echo "You're not logged in";
}*/

require(__DIR__."/../../partials/flash.php");
?>