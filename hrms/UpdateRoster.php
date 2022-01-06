<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
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
	
	$startdate = '';
	
	if(!isset($_SESSION["UpdateRoster"]) || !is_array($_SESSION["UpdateRoster"]))
	{
		$msg="Error";
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Something Error! Roster Not Updated.</b>
		</div>';
		redirect("AttendanceLedger.php");
	}

	if($msg=="")
	{
		if(isset($_SESSION["UpdateRoster"]) && is_array($_SESSION["UpdateRoster"]))
		{
			foreach($_SESSION["UpdateRoster"] as $TA)
			{
				
				$query5="SELECT e.ID AS EmpID,e.LeavesDays,lo.ID,li.LoginTime,li.DateAdded,lo.LogoutTime,li.Status
					 FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$TA."";
				$result5 = mysql_query($query5) or die (mysql_error());
				$num5 = mysql_num_rows($result5);
			
				if($num5 > 0)
				{
					$row5 = mysql_fetch_array($result5);			
					$startdate=strtotime($row5['DateAdded']);
					
					$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = '".$row5['EmpID']."'";
					$result = mysql_query ($query) or die(mysql_error());
					$num = mysql_num_rows($result);
					if($num == 1)
					{
						$row = mysql_fetch_array($result);
						
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
			
			}
		}
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Roster Updated of all selected Attendance.</b>
		</div>';
		redirect("AttendanceLedger.php");	
	}
?>