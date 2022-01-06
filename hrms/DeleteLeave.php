<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$LeaveDays = array();
	$startdate = '';
	
	if(!isset($_SESSION["DeleteLeave"]) || !is_array($_SESSION["DeleteLeave"]))
	{
		$msg="Error";
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Something Error! Leave Not Deleted.</b>
		</div>';
		redirect("AttendanceLedger.php");
	}

	if($msg=="")
	{
		if(isset($_SESSION["DeleteLeave"]) && is_array($_SESSION["DeleteLeave"]))
		{
			foreach($_SESSION["DeleteLeave"] as $TA)
			{
				
				$query="SELECT e.ID AS EmpID,e.LeavesDays,lo.ID,li.ID AS LoginID,li.LoginTime,li.DateAdded,lo.LogoutTime,li.Status
					 FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$TA." AND li.Status = 'Leave'";
				$result = mysql_query($query) or die (mysql_error());
				$num = mysql_num_rows($result);
			
				if($num > 0)
				{
					$row = mysql_fetch_array($result);
					
					if($row['LeavesDays'] != "")
					{
					$LeaveDays = explode(',',$row['LeavesDays']);
					}
					
					
					
					$startdate=strtotime($row['DateAdded']);
					
					if (in_array(''.date("N", $startdate).'', $LeaveDays))
					{
						$query2="UPDATE roster_login_history SET Status = 'Off Day' WHERE ID='" . (int)$TA . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query3 = "SELECT ID,EmpID,LeaveType,Qty FROM minus_leaves_quota where EmpID = '".$row['EmpID']."' AND LeaveDate = '".$row['DateAdded']."'";
						$res3 = mysql_query($query3) or die(mysql_error());
						$num3 = mysql_num_rows($res3);
						if($num3 > 0)
						{
							$row3 = mysql_fetch_array($res3);
							
							if($row3['LeaveType'] != "SpecialLeave")
							{
								mysql_query("UPDATE current_leaves_quota SET ".$row3['LeaveType']." = (".$row3['LeaveType']." + ".$row3['Qty'].") WHERE EmpID = ".$row3['EmpID']."") or die (mysql_error());
							}
							
							mysql_query("DELETE FROM minus_leaves_quota WHERE ID = '".$row3['ID']."'") or die (mysql_error());
						}
					}
					else if($row['LoginTime'] != Null)
					{
						$query2="UPDATE roster_login_history SET Status = 'Present' WHERE ID='" . (int)$TA . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query3 = "SELECT ID,EmpID,LeaveType,Qty FROM minus_leaves_quota where EmpID = '".$row['EmpID']."' AND LeaveDate = '".$row['DateAdded']."'";
						$res3 = mysql_query($query3) or die(mysql_error());
						$num3 = mysql_num_rows($res3);
						if($num3 > 0)
						{
							$row3 = mysql_fetch_array($res3);
							
							if($row3['LeaveType'] != "SpecialLeave")
							{
								mysql_query("UPDATE current_leaves_quota SET ".$row3['LeaveType']." = (".$row3['LeaveType']." + ".$row3['Qty'].") WHERE EmpID = ".$row3['EmpID']."") or die (mysql_error());
							}
							
							mysql_query("DELETE FROM minus_leaves_quota WHERE ID = '".$row3['ID']."'") or die (mysql_error());
						}
					}
					else
					{
						$query2="UPDATE roster_login_history SET Status = 'Absent' WHERE ID='" . (int)$TA . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query3 = "SELECT ID,EmpID,LeaveType,Qty FROM minus_leaves_quota where EmpID = '".$row['EmpID']."' AND LeaveDate = '".$row['DateAdded']."'";
						$res3 = mysql_query($query3) or die(mysql_error());
						$num3 = mysql_num_rows($res3);
						if($num3 > 0)
						{
							$row3 = mysql_fetch_array($res3);
							
							if($row3['LeaveType'] != "SpecialLeave")
							{
								mysql_query("UPDATE current_leaves_quota SET ".$row3['LeaveType']." = (".$row3['LeaveType']." + ".$row3['Qty'].") WHERE EmpID = ".$row3['EmpID']."") or die (mysql_error());
							}
							
							mysql_query("DELETE FROM minus_leaves_quota WHERE ID = '".$row3['ID']."'") or die (mysql_error());
						}
					}
					
				$query3="UPDATE roster_login_history SET LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE ID='" . (int)$row['LoginID'] . "'";
				mysql_query($query3) or die (mysql_error());
						
				}
			
			}
		}
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Leave Deleted of all selected Attendance.</b>
		</div>';
		redirect("AttendanceLedger.php");	
	}
?>