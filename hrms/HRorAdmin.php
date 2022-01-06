<?php
	if($_SESSION["RoleID"]=='Administrator' || $_SESSION["RoleID"]=='HR')
	$self = $_SERVER['PHP_SELF'];
	else
	redirect("Logout.php");
?>