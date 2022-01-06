<?php
	if(!isset($_SESSION['Login']) || $_SESSION["Login"] == false)
		redirect("Login.php");
	if($_SESSION["LockScreen"]==true)
		redirect("Lockscreen.php");
	$self = $_SERVER['PHP_SELF'];
?>