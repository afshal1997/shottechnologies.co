<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$ID=0;

	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
	$ID=$_REQUEST["ID"];

	if(isset($_REQUEST["msg"]))
	$msg=trim($_REQUEST["msg"]);
	
	if($ID != 0 && $msg == "BasicSalary")
	{
	$query="DELETE from basicsalary WHERE ID='" . (int)$ID . "'";
	mysql_query($query) or die (mysql_error());
	}
	else if($ID != 0 && $msg == "Leave")
	{
	$query="DELETE from leave_approvals WHERE ID='" . (int)$ID . "'";
	mysql_query($query) or die (mysql_error());
	}
		redirect('Dashboard.php');

?>