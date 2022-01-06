<?php
include_once("Common.php");
include("CheckAdminLogin.php");

	$LeaveNOD=0;
	$LeaveSender=0;
	$LeaveType="";
	$LeaveStartFrom="";
	$msg="";
	$ID=0;

	if(isset($_REQUEST["LeaveNOD"]) && ctype_digit(trim($_REQUEST["LeaveNOD"])))
	$LeaveNOD=$_REQUEST["LeaveNOD"];

	if(isset($_REQUEST["LeaveSender"]) && ctype_digit(trim($_REQUEST["LeaveSender"])))
	$LeaveSender=$_REQUEST["LeaveSender"];

	if(isset($_REQUEST["LeaveType"]))
	$LeaveType=trim($_REQUEST["LeaveType"]);

	if(isset($_REQUEST["LeaveStartFrom"]))
	$LeaveStartFrom=trim($_REQUEST["LeaveStartFrom"]);
	
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
	$ID=$_REQUEST["ID"];

	if(isset($_REQUEST["msg"]))
	$msg=trim($_REQUEST["msg"]);

	if($ID != 0 && $msg == "BasicSalary")
	{
	$query="UPDATE basicsalary SET Approved = 1 , ApprovedBy = ".$_SESSION['UserID']." WHERE ID='" . (int)$ID . "'";
	mysql_query($query) or die (mysql_error());
	}
	else if($ID != 0 && $msg == "Leave")
	{
	$query="UPDATE leave_approvals SET Approval = 1 WHERE ID='" . (int)$ID . "'";
	mysql_query($query) or die (mysql_error());
	
	$query="UPDATE current_leaves_quota SET ".$LeaveType." = ".$LeaveType." - ".$LeaveNOD." WHERE EmpID='" . (int)$LeaveSender . "'";
	mysql_query($query) or die (mysql_error());
	
	$query="DELETE from leave_approvals WHERE Approval = 0 AND Sender='" . (int)$LeaveSender . "'";
	mysql_query($query) or die (mysql_error());
		
		$d = $LeaveStartFrom;
		for($i=1; $i<=$LeaveNOD; $i++)
		{
			$query="INSERT INTO minus_leaves_quota SET 
				EmpID = '" . (int)$LeaveSender . "',
				LeaveType = '" . dbinput($LeaveType) . "',
				LeaveDate = '" . dbinput($d) . "'";
				mysql_query($query) or die (mysql_error());
			
			$d=strtotime("+1 Day", strtotime($d));
			$d=date("Y-m-d", $d);
		}
	}
		redirect('Dashboard.php');

?>