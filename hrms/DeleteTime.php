<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	
	if(!isset($_SESSION["DeleteTime"]) || !is_array($_SESSION["DeleteTime"]))
	{
		$msg="Error";
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Something Error! Attendance Time Not Deleted.</b>
		</div>';
		redirect("AttendanceLedger.php");
	}

	if($msg=="")
	{
		if(isset($_SESSION["DeleteTime"]) && is_array($_SESSION["DeleteTime"]))
		{
			foreach($_SESSION["DeleteTime"] as $TA)
			{
				
				$query="SELECT lo.ID,li.ID AS LoginID,li.LoginTime,lo.LogoutTime,li.Status
					 FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$TA." AND li.Status <> 'Absent'";
				$result = mysql_query($query) or die (mysql_error());
				$num = mysql_num_rows($result);
			
				if($num > 0)
				{
					$row = mysql_fetch_array($result);
					
					if($row['Status'] == 'Present')
					{
						$query2="UPDATE roster_login_history SET MLoginTime=NULL,LoginTime=NULL, HalfDay = 0,Late = 0,EarlyDep = 0, MStatus=NULL, Status = 'Absent' WHERE ID='" . (int)$TA . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query2="UPDATE roster_logout_history SET MLogoutTime=NULL,LogoutTime=NULL WHERE ID='" . (int)$row['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
					}
					else
					{
						$query2="UPDATE roster_login_history SET MLoginTime=NULL,LoginTime=NULL, HalfDay = 0,Late = 0,EarlyDep = 0, MStatus=NULL WHERE ID='" . (int)$TA . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query2="UPDATE roster_logout_history SET MLogoutTime=NULL,LogoutTime=NULL WHERE ID='" . (int)$row['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
					}
					
					$query3="UPDATE roster_login_history SET LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE ID='" . (int)$row['LoginID'] . "'";
					mysql_query($query3) or die (mysql_error());
						
				}
			
			}
		}
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Time Deleted of all selected Attendance.</b>
		</div>';
		redirect("AttendanceLedger.php");	
	}
?>