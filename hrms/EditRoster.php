<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
{}else{redirect("Dashboard.php");}	
	
	$msg="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
	$FromDate="";
	$ToDate="";
	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$CompanyID="";
	$CompID=array();
	$LocationID="";
	$LocID=array();
	$What="";
	$Reason="";
	
	
	$LeaveDays = array();
	$HalfDays = array();
	
	$ArrivalTime="";
	$DepartTime="";
	$LateArrival="";
	$EarlyDepart="";
	$ArrivalHalfDay="";
	$DepartHalfDay="";
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{		
	
	if(isset($_POST["Dates"]))
		$FromDate=trim($_POST["Dates"]);
	if(isset($_POST["NumOfDays"]))
		$num_of_days=trim($_POST["NumOfDays"]);
	if(isset($_POST["What"]))
		$What=trim($_POST["What"]);
	if(isset($_POST["Reason"]))
		$Reason=trim($_POST["Reason"]);
	if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}
	if(isset($_POST["LocationID"]))
	{
		$LocationID=implode(',', $_POST['LocationID']);
		$LocID=$_POST['LocationID'];
	}
	
	if($CompanyID == "" && $LocationID == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Company or Location.</b>
		</div>';
	}
	else if($What != "")
	{
		if($Reason == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter reason.</b>
			</div>';
		}
	}
	
	
	if($msg=="")
	{		
		$startdate=strtotime($FromDate);
		for($i=0; $i<$num_of_days;$i++)
		{
			
			// $query="DELETE att1 FROM user_login_history att1, user_login_history att2 WHERE att1.UserID = att2.UserID AND att1.DateAdded = att2.DateAdded AND att1.LoginTime > att2.LoginTime AND att1.DateAdded = '".date("Y-m-d", $startdate)."'";
			// mysql_query ($query) or die(mysql_error());
			
			// $query="DELETE att1 FROM user_logout_history att1, user_logout_history att2 WHERE att1.UserID = att2.UserID AND att1.DateAdded = att2.DateAdded AND att1.LogoutTime < att2.LogoutTime AND att1.DateAdded = '".date("Y-m-d", $startdate)."'";
			// mysql_query ($query) or die(mysql_error());
			
			// $query="INSERT INTO roster_login_history (UserID, LoginTime, LoginDate, Status, DateAdded)
					// SELECT UserID, LoginTime, LoginDate, Status, DateAdded FROM user_login_history
					// WHERE DateAdded = '".date("Y-m-d", $startdate)."'";
			// mysql_query ($query) or die(mysql_error());
			
			// $query="INSERT INTO roster_logout_history (UserID, LogoutTime, LogoutDate, DateAdded)
					// SELECT UserID, LogoutTime, LogoutDate, DateAdded FROM user_logout_history
					// WHERE DateAdded = '".date("Y-m-d", $startdate)."'";
			// mysql_query ($query) or die(mysql_error());
			
			foreach($CompID AS $cid)
			{
			$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.CompanyID = '".$cid."'";
			$result = mysql_query ($query) or die(mysql_error());
			$num = mysql_num_rows($result);
			while($row = mysql_fetch_array($result,MYSQL_ASSOC))
			{
				$query="INSERT INTO temp_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."' AND Status <> 'Off Day' AND Status <> 'Absent'";
				mysql_query ($query) or die(mysql_error());
				
				$query="INSERT INTO temp_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded)
					SELECT lo.UserID, lo.LogoutTime, lo.MLogoutTime, lo.LogoutDate, lo.DateAdded FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
					WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status <> 'Off Day' AND li.Status <> 'Absent'";
				mysql_query ($query) or die(mysql_error());
				
				$query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				
				$query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				
				$query="INSERT INTO roster_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM temp_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query ($query) or die(mysql_error());
				
				$query="INSERT INTO roster_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded FROM temp_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query ($query) or die(mysql_error());
				
				$query="TRUNCATE TABLE temp_login_history";
				mysql_query ($query) or die(mysql_error());
				
				$query="TRUNCATE TABLE temp_logout_history";
				mysql_query ($query) or die(mysql_error());
				
				
				
				$query2="SELECT ID,LoginTime FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2);
				
				if($num2 == 0)
				{
					if($row['LeavesDays'] != "")
					{
					$LeaveDays = explode(',',$row['LeavesDays']);
					}
					
					$query3="SELECT ID FROM minus_leaves_quota WHERE EmpID='" . (int)$row['ID'] . "' AND LeaveDate = '".date("Y-m-d", $startdate)."'";
					$result3 = mysql_query ($query3) or die(mysql_error()); 
					$num3 = mysql_num_rows($result3);
					
					if ($num3 != 0)
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Leave'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if ($What == "Full day On" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
					UserID = '" . (int)$row['ID'] . "',
					Status = 'Absent',MStatus = '".$Reason."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if (in_array(''.date("N", $startdate).'', $LeaveDays))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Off Day'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if ($What == "Full day Off" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Off Day',MStatus = '".$Reason."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
					UserID = '" . (int)$row['ID'] . "',
					Status = 'Absent'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
				}
				else
				{
					
					if($row['HalfDays'] != "")
					{
					$HalfDays = explode(',',$row['HalfDays']);
					}
					
					$query4="SELECT ArrivalTime,LateArrival,ArrivalHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
					$result4 = mysql_query ($query4) or die(mysql_error()); 
					$num4 = mysql_num_rows($result4);
					if($num4 == 1)
					{
						$row4 = mysql_fetch_array($result4);
						//strtotime($Variable);
						$ArrivalTime=$row4['ArrivalTime'];
						$LateArrival=$row4['LateArrival'];
						$ArrivalHalfDay=$row4['ArrivalHalfDay'];
					}
					
					if (!in_array(''.date("N", $startdate).'', $HalfDays))
					{
						
						if ($What == "Allow Arrival Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Allow Late Arrival" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Not Allowed")
						{
							
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
								else if ($row2['LoginTime'] > $LateArrival)
								{
								$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Allowed")
						{
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
					}
					
				}
				// Arrival End
				$query2="SELECT ID,LogoutTime FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2);
				
				if($num2 == 0)
				{
					
					$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
				}
				else
				{
					if($row['HalfDays'] != "")
					{
					$HalfDays = explode(',',$row['HalfDays']);
					}
					
					$query4="SELECT DepartTime,EarlyDepart,DepartHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
					$result4 = mysql_query ($query4) or die(mysql_error()); 
					$num4 = mysql_num_rows($result4);
					if($num4 == 1)
					{
						$row4 = mysql_fetch_array($result4);
						$DepartTime=$row4['DepartTime'];
						$EarlyDepart=$row4['EarlyDepart'];
						$DepartHalfDay=$row4['DepartHalfDay'];
					}
					
					
					if (!in_array(''.date("N", $startdate).'', $HalfDays))
					{						
						if ($What == "Allow Departure Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Allow Early Departure" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Not Allowed")
						{
							
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
								else if ($row2['LogoutTime'] < $EarlyDepart)
								{
								$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Allowed")
						{
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						//this is new code from
						
						$querytemp="SELECT li.LoginTime,lo.LogoutTime FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
						WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status = 'Present'";
						$resulttemp = mysql_query($querytemp) or die (mysql_error());
						$numtemp = mysql_num_rows($resulttemp);
						$rowtemp = mysql_fetch_array($resulttemp);
						
						if ($rowtemp['LoginTime'] != null AND $rowtemp['LogoutTime'] == null)
						{
							$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						
						//this is new code till
					}
					
				}
				
				if($row['LeavesDays'] != "")
					{
					$LeaveDays = explode(',',$row['LeavesDays']);
					}
					
					if (in_array(''.date("N", $startdate).'', $LeaveDays))
					{
					$query3="UPDATE roster_login_history SET 
					Status = 'Off Day', EarlyDep = 0, Late = 0, HalfDay = 0 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query($query3) or die (mysql_error());
					}
					
				$query3="UPDATE roster_login_history SET ScheduleArrival = '".$row['ArrivalTime']."',ScheduleDepart = '".$row['DepartTime']."',LateArrival = '".$row['LateArrival']."',EarlyDepart = '".$row['EarlyDepart']."',LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query($query3) or die (mysql_error());
			
			}
			}
			foreach($LocID AS $lid)
			{
			$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.Location = '".$lid."'";
			$result = mysql_query ($query) or die(mysql_error());
			$num = mysql_num_rows($result);
			while($row = mysql_fetch_array($result,MYSQL_ASSOC))
			{
				$query="INSERT INTO temp_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."' AND Status <> 'Off Day' AND Status <> 'Absent'";
				mysql_query ($query) or die(mysql_error());
				
				$query="INSERT INTO temp_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded)
					SELECT lo.UserID, lo.LogoutTime, lo.MLogoutTime, lo.LogoutDate, lo.DateAdded FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
					WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status <> 'Off Day' AND li.Status <> 'Absent'";
				mysql_query ($query) or die(mysql_error());
				
				$query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				
				$query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				
				$query="INSERT INTO roster_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM temp_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query ($query) or die(mysql_error());
				
				$query="INSERT INTO roster_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded FROM temp_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query ($query) or die(mysql_error());
				
				$query="TRUNCATE TABLE temp_login_history";
				mysql_query ($query) or die(mysql_error());
				
				$query="TRUNCATE TABLE temp_logout_history";
				mysql_query ($query) or die(mysql_error());
				
				
				
				$query2="SELECT ID,LoginTime FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2);
				
				if($num2 == 0)
				{
					if($row['LeavesDays'] != "")
					{
					$LeaveDays = explode(',',$row['LeavesDays']);
					}
					
					$query3="SELECT ID FROM minus_leaves_quota WHERE EmpID='" . (int)$row['ID'] . "' AND LeaveDate = '".date("Y-m-d", $startdate)."'";
					$result3 = mysql_query ($query3) or die(mysql_error()); 
					$num3 = mysql_num_rows($result3);
					
					if ($num3 != 0)
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Leave'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if ($What == "Full day On" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
					UserID = '" . (int)$row['ID'] . "',
					Status = 'Absent',MStatus = '".$Reason."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if (in_array(''.date("N", $startdate).'', $LeaveDays))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Off Day'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else if ($What == "Full day Off" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "',
						Status = 'Off Day',MStatus = '".$Reason."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
					else
					{
					$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
					UserID = '" . (int)$row['ID'] . "',
					Status = 'Absent'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
					}
				}
				else
				{
					
					if($row['HalfDays'] != "")
					{
					$HalfDays = explode(',',$row['HalfDays']);
					}
					
					$query4="SELECT ArrivalTime,LateArrival,ArrivalHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
					$result4 = mysql_query ($query4) or die(mysql_error()); 
					$num4 = mysql_num_rows($result4);
					if($num4 == 1)
					{
						$row4 = mysql_fetch_array($result4);
						//strtotime($Variable);
						$ArrivalTime=$row4['ArrivalTime'];
						$LateArrival=$row4['LateArrival'];
						$ArrivalHalfDay=$row4['ArrivalHalfDay'];
					}
					
					if (!in_array(''.date("N", $startdate).'', $HalfDays))
					{
						
						if ($What == "Allow Arrival Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Allow Late Arrival" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Not Allowed")
						{
							
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
								else if ($row2['LoginTime'] > $LateArrival)
								{
								$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Allowed")
						{
							if ($row2['LoginTime'] != null)
							{
								if ($row2['LoginTime'] > $ArrivalHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
					}
					
				}
				// Arrival End
				$query2="SELECT ID,LogoutTime FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2);
				
				if($num2 == 0)
				{
					
					$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query($query3) or die (mysql_error());
					
					$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$row['ID'] . "'";
					mysql_query($query3) or die (mysql_error());
				}
				else
				{
					if($row['HalfDays'] != "")
					{
					$HalfDays = explode(',',$row['HalfDays']);
					}
					
					$query4="SELECT DepartTime,EarlyDepart,DepartHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
					$result4 = mysql_query ($query4) or die(mysql_error()); 
					$num4 = mysql_num_rows($result4);
					if($num4 == 1)
					{
						$row4 = mysql_fetch_array($result4);
						$DepartTime=$row4['DepartTime'];
						$EarlyDepart=$row4['EarlyDepart'];
						$DepartHalfDay=$row4['DepartHalfDay'];
					}
					
					
					if (!in_array(''.date("N", $startdate).'', $HalfDays))
					{						
						if ($What == "Allow Departure Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Allow Early Departure" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
							$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Not Allowed")
						{
							
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
								else if ($row2['LogoutTime'] < $EarlyDepart)
								{
								$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Allowed")
						{
							if ($row2['LogoutTime'] != null)
							{
								if ($row2['LogoutTime'] < $DepartHalfDay)
								{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								}
							}
						}
						//this is new code from
						
						$querytemp="SELECT li.LoginTime,lo.LogoutTime FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
						WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status = 'Present'";
						$resulttemp = mysql_query($querytemp) or die (mysql_error());
						$numtemp = mysql_num_rows($resulttemp);
						$rowtemp = mysql_fetch_array($resulttemp);
						
						if ($rowtemp['LoginTime'] != null AND $rowtemp['LogoutTime'] == null)
						{
							$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
						}
						
						//this is new code till
					}
					
				}
				
				if($row['LeavesDays'] != "")
					{
					$LeaveDays = explode(',',$row['LeavesDays']);
					}
					
					if (in_array(''.date("N", $startdate).'', $LeaveDays))
					{
					$query3="UPDATE roster_login_history SET 
					Status = 'Off Day', EarlyDep = 0, Late = 0, HalfDay = 0 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query($query3) or die (mysql_error());
					}
					
				$query3="UPDATE roster_login_history SET ScheduleArrival = '".$row['ArrivalTime']."',ScheduleDepart = '".$row['DepartTime']."',LateArrival = '".$row['LateArrival']."',EarlyDepart = '".$row['EarlyDepart']."',LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
				mysql_query($query3) or die (mysql_error());
			
			}
			}
			$startdate = strtotime("+1 day", $startdate);
		}
		
		
			// $query="INSERT INTO roster SET DateAdded=NOW(),
				// NumOfDays = '" . (int)$num_of_days . "',
				// FromDate = '" . dbinput($FromDate) . "',
				// ToDate = '" . dbinput($ToDate) . "',
				// What = '" . dbinput($What) . "',
				// Reason = '" . dbinput($Reason) . "',
				// CompanyID = '" . dbinput($CompanyID) . "',
				// LocationID = '" . dbinput($LocationID) . "',
				// PerformedBy = '" . $_SESSION["UserID"] . "'";
			// mysql_query($query) or die (mysql_error());
			
			
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Roster has been Updated.</b>
			</div>';
			
			redirect("Roster.php");
	}

}
else
{
	$query="SELECT ID,FromDate,NumOfDays FROM roster WHERE ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Roster ID.</b>
		</div>';
		redirect("Roster.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$FromDate=$row["FromDate"];
		$num_of_days=$row["NumOfDays"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Roster</title>
<style>
    .multiselect {
        width: auto;
    }
    .selectBox {
        position: relative;
    }
    .selectBox select {
        width: 100%;
    }
    .overSelect {
        position: absolute;
        left: 0; right: 0; top: 0; bottom: 0;
    }
    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes label {
        display: block;
    }
    #checkboxes label:hover {
        background-color: #1e90ff;
    }
	#checkboxes2 {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes2 label {
        display: block;
    }
    #checkboxes2 label:hover {
        background-color: #1e90ff;
    }
	</style>
	<script>
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	</script>
	<script>
    var expanded = false;
    function showCheckboxes2() {
        var checkboxes = document.getElementById("checkboxes2");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	</script>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />

<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Color Picker -->
<link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<!-- Bootstrap time Picker -->
<link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<style>
#footer {
	width:100%;
	height:50px;
	background-color:#3c8dbc;
	text-align:center;
	vertical-align:center;
	padding-top:15px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php
	include_once("Header.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
	include_once("Sidebar.php");
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Roster</h1>
      <ol class="breadcrumb">
        <li><a href="Roster.php"><i class="fa fa-dashboard"></i>Roster</a></li>
        <li class="active">Edit Roster</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Update</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Roster.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>

		 <input type="hidden" name="Dates" value="<?php echo $FromDate; ?>" />
		 <input type="hidden" name="NumOfDays" value="<?php echo $num_of_days; ?>" />
		 
		 <div class="col-md-6">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Roster Conditions</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
				  <label id="labelimp" for="What" >What You Want:</label>
				  <select name="What" id="What" class="form-control">
					<option value="" >Select What You Want</option>
					<option <?php echo ($What == 'Allow Late Arrival' ? 'selected' : ''); ?> value="Allow Late Arrival">Allow Late Arrival</option>
					<option <?php echo ($What == 'Allow Arrival Half day' ? 'selected' : ''); ?> value="Allow Arrival Half day">Allow Arrival Half day</option>
					<option <?php echo ($What == 'Allow Departure Half day' ? 'selected' : ''); ?> value="Allow Departure Half day">Allow Departure Half day</option>
					<option <?php echo ($What == 'Allow Early Departure' ? 'selected' : ''); ?> value="Allow Early Departure">Allow Early Departure</option>
					<option <?php echo ($What == 'Full day Off' ? 'selected' : ''); ?> value="Full day Off">Full day Off (Holiday)</option>
					<option <?php echo ($What == 'Full day On' ? 'selected' : ''); ?> value="Full day On">Full day On (Working Day)</option>
					</select>
				</div>
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Reason">Reason / Remarks:</label>
				  <?php 
				echo '<textarea rows="2" maxlength="300" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
				?>
				</div>

			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
         </div>
		 
		 <div class="col-md-6">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Roster Application</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
                  <label id="labelimp" for="CompanyID" >Company: </label>
                 <div class="selectBox" onclick="showCheckboxes()">
						<select class="form-control">
							<option>Select Company</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes" style="height:250px; overflow:scroll;">						
						<?php
						$query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
						$res = mysql_query($query);
						while($row = mysql_fetch_array($res))
						{
						echo '<label><input '.(in_array($row['ID'], $CompID) ? "checked = checked" : "").' type="checkbox" name="CompanyID[]" value="'.$row['ID'].'"/> '.$row['Name'].'</label>';
						}
						?>
				  </div>
                </div>
				
				
				<div class="form-group">
                  <label id="labelimp" for="LocationID" >Location: </label>
                 <div class="selectBox" onclick="showCheckboxes2()">
						<select class="form-control">
							<option>Select Location</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes2" style="height:250px; overflow:scroll;">						
						<?php
						$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
						$res = mysql_query($query);
						while($row = mysql_fetch_array($res))
						{
						echo '<label><input '.(in_array($row['ID'], $LocID) ? "checked = checked" : "").' type="checkbox" name="LocationID[]" value="'.$row['ID'].'"/> '.$row['Name'].' | '.$row['Abr'].'</label>';
						}
						?>
				  </div>
                </div>
				

			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
         </div>
		

        </section>
    </form>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php include_once("Footer.php"); ?>
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app2.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/AdminLTE/demo.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                });
            });
        </script>
</body>
</html>