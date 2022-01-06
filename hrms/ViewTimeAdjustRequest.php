<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$Reason="";
	$RosterID=0;
	$Photo="";
	$EmpID="";
	$FirstName="";
	$LastName="";
	$DisapproveReason="";
	$Approved=1;
	$ArrivalTime="";
	$DepartTime="";
	$AdjustDate="";
	$RArrivalTime="";
	$RDepartTime="";
	
	$LeaveDays = array();
	$HalfDays = array();

	$ArrivalTime="";
	$DepartTime="";
	$LateArrival="";
	$EarlyDepart="";
	$ArrivalHalfDay="";
	$DepartHalfDay="";

	$startdate = '';

	$LastID=0;
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
		if(isset($_POST["RosterID"]))
			$RosterID=trim($_POST["RosterID"]);
		if(isset($_POST["ArrivalTime"]))
			$ArrivalTime=trim($_POST["ArrivalTime"]);
		if(isset($_POST["DepartTime"]))
			$DepartTime=trim($_POST["DepartTime"]);
		if(isset($_POST["Approved"]))
			$Approved=trim($_POST["Approved"]);
		if(isset($_POST["DisapproveReason"]))
			$DisapproveReason=trim($_POST["DisapproveReason"]);
		if(isset($_POST["Reason"]))
			$Reason=trim($_POST["Reason"]);
		
		
		
		if($Approved == 2)
		{
			if($DisapproveReason == "")
			{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please enter Disapprove Reason.</b>
				</div>';
			}
		}
		
		
		
		


	if($msg=="")
	{
		
		if($Approved == 2)
		{
		
			$query="UPDATE timeadjust_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = '".(int)$Approved."',
				DisapproveReason = '" . dbinput($DisapproveReason) . "',
				DateModified = NOW() WHERE ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
			$ID = mysql_insert_id();
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Time Adjust request has been updated.</b>
			</div>';		
			
			redirect("TimeAdjustRequests.php");
		
		}
		else
		{
			$query2="UPDATE timeadjust_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = '".(int)$Approved."',
				DisapproveReason = '" . dbinput($DisapproveReason) . "',
				DateModified = NOW() WHERE ID = ".$ID."";
				mysql_query($query2) or die (mysql_error());
				
				$query5="SELECT e.ID AS EmpID,e.LeavesDays,lo.ID,li.LoginTime,li.DateAdded,lo.LogoutTime,li.Status
					 FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.ActualDate = lo.ActualDate WHERE li.ID = ".$RosterID."";
					 //echo $query5; exit();
				$result5 = mysql_query($query5) or die (mysql_error());
				$num5 = mysql_num_rows($result5);
			
				if($num5 > 0)
				{
					$row5 = mysql_fetch_array($result5);
					//$startdate=$row5['DateAdded'];	
					$startdate = date('Y-m-d', strtotime($row5['DateAdded']));
					//echo $startdate; exit();
					$nextdate = date('Y-m-d', strtotime($startdate . ' +1 day'));
				
					
					$T = explode(' ',$DepartTime);
		            $AMPM = $T[1];
					
					if($row5['Status'] == 'Off Day')
					{
						$query2="UPDATE roster_login_history SET MLoginTime='".$row5['LoginTime']."',LoginTime='". time_format_gracetime($ArrivalTime) ."', HalfDay = 0,Late = 0,EarlyDep = 0, MStatus=CONCAT(IFNULL(MStatus,''), ' <br>".$DisapproveReason."') WHERE ID='" . (int)$RosterID . "'";
						mysql_query($query2) or die (mysql_error());
						
						if($AMPM == "AM")
		                {
						$query2="UPDATE roster_logout_history SET MLogoutTime='".$row5['LogoutTime']."',LogoutTime='". time_format_gracetime($DepartTime) ."',LogoutDate='".$nextdate."',DateAdded='".$nextdate."'  WHERE ID='" . (int)$row5['ID'] . "'";
						//echo $query2; exit();
						mysql_query($query2) or die (mysql_error());
		                }
		                else
		                {
		                $query2="UPDATE roster_logout_history SET MLogoutTime='".$row5['LogoutTime']."',LogoutTime='". time_format_gracetime($DepartTime) ."' WHERE ID='" . (int)$row5['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
		                }
					}
					else
					{
						$query2="UPDATE roster_login_history SET MLoginTime='".$row5['LoginTime']."',LoginTime='". time_format_gracetime($ArrivalTime) ."', Status = 'Present',HalfDay = 0,Late = 0,EarlyDep = 0, MStatus=CONCAT(IFNULL(MStatus,''), ' <br>".$DisapproveReason."') WHERE ID='" . (int)$RosterID . "'";
						mysql_query($query2) or die (mysql_error());
						
						
						
						if($AMPM == "AM")
		                {
		                $query2="UPDATE roster_logout_history SET MLogoutTime='".$row5['LogoutTime']."',LogoutTime='". time_format_gracetime($DepartTime) ."',LogoutDate='".$nextdate."',DateAdded='".$nextdate."'  WHERE ID='" . (int)$row5['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
		                }
		                else
		                {
		                $query2="UPDATE roster_logout_history SET MLogoutTime='".$row5['LogoutTime']."',LogoutTime='". time_format_gracetime($DepartTime) ."' WHERE ID='" . (int)$row5['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
		                }
					}
					
					$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart,s.DayNight FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = '".$row5['EmpID']."'";
					
					$result = mysql_query ($query) or die(mysql_error());
					$num = mysql_num_rows($result);
					if($num == 1)
					{
						$row = mysql_fetch_array($result);
						
						$DayNight = $row['DayNight'];
						
						$query="INSERT INTO temp_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded, ActualDate) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded, ActualDate FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."' AND Status <> 'Absent'";
						mysql_query ($query) or die(mysql_error());
						
						$query="INSERT INTO temp_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded, ActualDate)
							SELECT lo.UserID, lo.LogoutTime, lo.MLogoutTime, lo.LogoutDate, lo.DateAdded, lo.ActualDate FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.ActualDate = li.ActualDate AND lo.UserID = li.UserID)
							WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.ActualDate = '".$startdate."' AND li.Status <> 'Absent'";
						mysql_query ($query) or die(mysql_error());
						
						$query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						
						$query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						
						$query="INSERT INTO roster_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded, ActualDate) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded, ActualDate FROM temp_login_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						mysql_query ($query) or die(mysql_error());
						
						$query="INSERT INTO roster_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded, ActualDate) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded, ActualDate FROM temp_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						mysql_query ($query) or die(mysql_error());
						
						$query="TRUNCATE TABLE temp_login_history";
						mysql_query ($query) or die(mysql_error());
						
						$query="TRUNCATE TABLE temp_logout_history";
						mysql_query ($query) or die(mysql_error());
						
						
						
						$query2="SELECT ID,LoginTime FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						//echo $query2; exit();
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						$num2 = mysql_num_rows($result2);
						$row2 = mysql_fetch_array($result2);
						
						if($num2 == 0)
						{
							
							if($row['LeavesDays'] != "")
							{
							$LeaveDays = explode(',',$row['LeavesDays']);
							}
							
							$query3="SELECT ID FROM minus_leaves_quota WHERE EmpID='" . (int)$row['ID'] . "' AND LeaveDate = '".$startdate."'";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							
							if ($num3 != 0)
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".$startdate."' , DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Leave'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Full day On" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".$startdate."' , DateAdded='".$startdate."', ActualDate='".$startdate."',
							UserID = '" . (int)$row['ID'] . "',
							Status = 'Absent',MStatus = '".$DisapproveReason."'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if (in_array(''.date("N", $startdate).'', $LeaveDays))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".$startdate."' , DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Off Day'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Full day Off" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".$startdate."' , DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Off Day',MStatus = '".$DisapproveReason."'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".$startdate."' , DateAdded='".$startdate."', ActualDate='".$startdate."',
							UserID = '" . (int)$row['ID'] . "',
							Status = 'Absent'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
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
							
							if($DayNight == 1){
							//echo 'first work '.$DayNight; exit();
							
								if ($HalfDay == 1)
								{
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								else
								{
									$query3="UPDATE roster_login_history SET HalfDay = 0 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								
								if ($Late == 1)
								{
									$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								else
								{
									$query3="UPDATE roster_login_history SET Late = 0 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								
								if ($EarlyDep == 1)
								{
									$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								else
								{
									$query3="UPDATE roster_login_history SET EarlyDep = 0 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
								}
								
							}
							else{
							//echo 'second work '.$DayNight; exit();
							
							if (!in_array(''.date("N", $startdate).'', $HalfDays))
							{
								
								if ($What == "Allow Arrival Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$DisapproveReason."' WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
									mysql_query($query3) or die (mysql_error());
								}
								else if ($What == "Allow Late Arrival" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$DisapproveReason."' WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
									mysql_query($query3) or die (mysql_error());
									
									if ($row2['LoginTime'] != null)
									{
										if ($row2['LoginTime'] > $ArrivalHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
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
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										}
										else if ($row2['LoginTime'] > $LateArrival)
										{
										$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
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
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
							}
							
							}
							
						}
						// Arrival End
						$query2="SELECT ID,LogoutTime FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						$num2 = mysql_num_rows($result2);
						$row2 = mysql_fetch_array($result2);
						
						if($num2 == 0)
						{
							
							if($DayNight == 1){
							
							}
							else{
							
							$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
							mysql_query($query3) or die (mysql_error());
							
							}
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".$startdate."', ActualDate='".$startdate."',
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
							
							if($DayNight == 1){
							
							}
							else{
								
							if (!in_array(''.date("N", $startdate).'', $HalfDays))
							{						
								if ($What == "Allow Departure Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$DisapproveReason."' WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
									mysql_query($query3) or die (mysql_error());
								}
								else if ($What == "Allow Early Departure" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$DisapproveReason."' WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
									mysql_query($query3) or die (mysql_error());
									
									if ($row2['LogoutTime'] != null)
									{
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										// if($Night == 0){
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										// }
										}
									}
								}
								else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Not Allowed")
								{
									
									if ($row2['LogoutTime'] != null)
									{
										// if($Night == 0){
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										}
										else if ($row2['LogoutTime'] < $EarlyDepart)
										{
										$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										}
										// }
									}
								}
								else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Allowed")
								{
									if ($row2['LogoutTime'] != null)
									{
										// if($Night == 0){
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
										mysql_query($query3) or die (mysql_error());
										}
										// }
									}
								}
								//this is new code from
								
								$querytemp="SELECT li.LoginTime,lo.LogoutTime FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.ActualDate = li.ActualDate AND lo.UserID = li.UserID)
								WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.ActualDate = '".$startdate."' AND li.Status = 'Present'";
								$resulttemp = mysql_query($querytemp) or die (mysql_error());
								$numtemp = mysql_num_rows($resulttemp);
								$rowtemp = mysql_fetch_array($resulttemp);
								
								if ($rowtemp['LoginTime'] != null AND $rowtemp['LogoutTime'] == null)
								{
									// if($Night == 0){
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
									mysql_query($query3) or die (mysql_error());
									// }
								}
								
								//this is new code till
							}
							
							}
							
						}
						
						if($row['LeavesDays'] != "")
							{
							$LeaveDays = explode(',',$row['LeavesDays']);
							}
							
							if (in_array(''.date("N", $startdate).'', $LeaveDays))
							{
							$query3="UPDATE roster_login_history SET 
							Status = 'Off Day', EarlyDep = 0, Late = 0, HalfDay = 0 WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
							mysql_query($query3) or die (mysql_error());
							}
						
						$query3="UPDATE roster_login_history SET ScheduleArrival = '".$row['ArrivalTime']."',ScheduleDepart = '".$row['DepartTime']."',LateArrival = '".$row['LateArrival']."',EarlyDepart = '".$row['EarlyDepart']."',LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE UserID='" . (int)$row['ID'] . "' AND ActualDate = '".$startdate."'";
						mysql_query($query3) or die (mysql_error());
					
					}
						
				}
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Time Adjust request has been updated.</b>
			</div>';		
			
			redirect("TimeAdjustRequests.php");
		}
	}
		

}
else
{
	$query="SELECT l.ID,r.LoginTime AS RLoginTime,ro.LogoutTime AS RLogoutTime,l.RosterID,l.Reason,l.DisapproveReason,DATE_FORMAT(r.ActualDate, '%D %b %Y') AS AdjustDate,l.Approved,l.LoginTime,l.LogoutTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Added,DATE_FORMAT(l.DateModified, '%D %b %Y') AS Updated FROM timeadjust_requests l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN employees a ON l.ApprovedBy = a.ID LEFT JOIN roster_login_history r ON l.RosterID = r.ID LEFT JOIN roster_logout_history ro ON r.UserID = ro.UserID AND r.ActualDate = ro.ActualDate WHERE l.ID='" . (int)$ID . "' AND l.NotificationTO = ".$_SESSION['UserID']."";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Time Adjust Request ID.</b>
		</div>';
		redirect("TimeAdjustRequests.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$RosterID=$rows['RosterID'];
		$AdjustDate=dboutput($rows['AdjustDate']);
		$ArrivalTime=dboutput($rows['LoginTime']);
		$DepartTime=dboutput($rows['LogoutTime']);
		$RArrivalTime=dboutput($rows['RLoginTime']);
		$RDepartTime=dboutput($rows['RLogoutTime']);
		$Approved=dboutput($rows['Approved']);
		$EmpID=dboutput($rows['EmpID']);
		$FirstName=dboutput($rows['FirstName']);
		$LastName=dboutput($rows['LastName']);
		$Reason=dboutput($rows['Reason']);
		$DisapproveReason=dboutput($rows['DisapproveReason']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Time Adjust Request</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
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
      <h1> View Time Adjust Request</h1>
      <ol class="breadcrumb">
        <li><a href="TimeAdjustRequests.php"><i class="fa fa-dashboard"></i>Time Adjust Requests</a></li>
        <li class="active">View Time Adjust Request</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='TimeAdjustRequests.php'">Cancel</button>
            </div>
              <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
        <div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
                  <label id="labelimp" >Date of Adjust Time: </label>
                  <?php 
				echo '<input type="text" disabled class="form-control" disabled value="'.$AdjustDate.'" />';
				?>
                </div>
				
				<input type="hidden" name="RosterID" value="<?php echo $RosterID ?>" />
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" >Default Time To Arrive:</label>
							<input type="text" disabled <?php echo 'value="'.($RArrivalTime != Null ? revert_time_format_gracetime($RArrivalTime) : 'No Time').'"' ?> class="form-control" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="ArrivalTime">Time To Arrive:</label>
							<input type="text" name="ArrivalTime" id="ArrivalTime" <?php echo 'value="'.revert_time_format_gracetime($ArrivalTime).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp">Default Time To Depart:</label>
							<input type="text" disabled <?php echo 'value="'.($RDepartTime != Null ?revert_time_format_gracetime($RDepartTime) : 'No Time').'"' ?> class="form-control" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="DepartTime">Time To Depart:</label>
							<input type="text" name="DepartTime" id="DepartTime" <?php echo 'value="'.revert_time_format_gracetime($DepartTime).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
                  <label id="labelimp" >Employee: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$EmpID.' | '.$FirstName.' '.$LastName.'" />';
				?>
                </div>
				
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Reason">Reason: </label>
                  <?php 
					echo '<textarea rows="9" maxlength="50" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
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
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" >Approval: </label>
				  <label>
				  <input type="radio" name="Approved" value="1"<?php echo ($Approved == 1 ? ' checked="checked"' : ''); ?>>
				  Approve</label>
				  <label>
				  <input <?php if($Approved == 1){echo 'disabled';} ?> type="radio" name="Approved" value="2"<?php echo ($Approved == 2 ? ' checked="checked"' : ''); ?>>
				  DisApprove</label>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="DisapproveReason">Disapprove Reason / Remarks: </label>
                  <?php 
					echo '<textarea rows="9" maxlength="50" id="DisapproveReason" name="DisapproveReason" class="form-control">'.($DisapproveReason == '' ? $Reason : $DisapproveReason ).'</textarea>';
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
<!-- jQuery UI 1.10.3 -->
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
                $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});
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
		
		<script>
	$(function(){
	var sidebar = $('.sidebar-menu');  // cache sidebar to a variable for performance

	sidebar.delegate('.treeview','click',function(){ 
	  if($(this).hasClass('active')){
		$(this).removeClass('active');
		sidebar.find('.inactive > .treeview-menu').hide(200);
		sidebar.find('.inactive').removeClass('inactive');
	   $(this).addClass('inactive');
	   $(this).find('.treeview-menu').show(200);
	 }else{
	  sidebar.find('.active').addClass('inactive');          
	  sidebar.find('.active').removeClass('active'); 
	   $(this).Class('treeview-menu').hide(200);
	 }
	});

	});
	
	$(document).click(function (event) {   
    $('.treeview-menu:visible').hide();
	});

	</script>
</body>
</html>
