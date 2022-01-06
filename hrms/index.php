<?php
include_once("Common.php");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
redirect("Dashboard.php");
else
redirect("Login.php");
?>

