<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	
	if(!isset($_SESSION["DeleteRecord"]) || !is_array($_SESSION["DeleteRecord"]))
	{
		$msg="Error";
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Something Error! Attendance Record Not Deleted.</b>
		</div>';
		redirect("AttendanceLedger.php");
	}

	if($msg=="")
	{
		if(isset($_SESSION["DeleteRecord"]) && is_array($_SESSION["DeleteRecord"]))
		{
			foreach($_SESSION["DeleteRecord"] as $TA)
			{
				
				$query="SELECT lo.ID FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$TA."";
				$result = mysql_query($query) or die (mysql_error());
				$num = mysql_num_rows($result);
			
				if($num > 0)
				{
					$row = mysql_fetch_array($result);
					
					$query3="DELETE FROM roster_logout_history WHERE ID='" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
						
				}
				
				$query3="DELETE FROM roster_login_history WHERE ID='" . (int)$TA . "'";
				mysql_query($query3) or die (mysql_error());
			
			}
		}
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Record Deleted of all selected Attendance.</b>
		</div>';
		redirect("AttendanceLedger.php");	
	}
?>