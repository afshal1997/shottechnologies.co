<?php
	session_start();
	$_SESSION["LockScreen"]=true;
	header("Location: Lockscreen.php");
?>