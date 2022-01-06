<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$OpeningLeave=0;
	$GrantLeave=0;
	$UtilizeLeave=0;
	$WriteOffLeave=0;
	$BalanceLeave=0;
	$AfterBalance=0;
	
	$msg="";
	$PayID = 0;
	
	$TotalLateEarlies = 0;
	$TotalLateEarliesDedDays = 0;
	$TotalLateDedDays = 0;
	$TotalEarliesDedDays = 0;
	
	$BasicSalary = 0;
	$AllowanceBreakup = 0;
	
	$Allowance_WithoutTax = 0;
	$Inc_Adjustments = 0;
	$OtherAllowances = 0;
	$AttAllowance = 0;
	
	$FixDeductions = 0;
	$Dec_Adjustments = 0;
	$OtherDeductions = 0;
	
	$IncomeTax = 0;
	
	$TotalDays = 0;
	$TotalPresent = 0;
	$TotalAbsent = 0;
	$TotalOffDays = 0;
	$TotalLeaves = 0;
	$TotalHalfdays = 0;
	$TotalLates = 0;
	$TotalEarlyDepart = 0;
	$TotalHours = 0;
	$TotalMinutes = 0;
	$TotalWorkingHours = 0;
	$TotalWorkingMinutes = 0;
	$TotalOvertimeHoursW = 0;
	$TotalOvertimeMinutesW = 0;
	$OvertimeAmountW = 0;
	$TotalOvertimeHoursL = 0;
	$TotalOvertimeMinutesL = 0;
	$OvertimeAmountL = 0;
	
	$OvertimeHolidayDays = 0;
	
	$PayFullSalary = "";
	$StopSalary = "";
	$Resignation = "";
	$BankorCash = "";
	$AccountNum = "";
	
	$EmployeeContribution = 0;
	$EmployerContribution = 0;
	
	
	$e="";
	$f=array();
	$MonthPayroll="";
	$ToDate=date("Y-m-25");
	$d=strtotime("-1 Months");		
	$FromDate=date("Y-m-26", $d);
	
	
	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$Remarks="";
	$SpecialRemarks="";
	$PayrollMonth="";
	
	$EmployeeID=0;
	$compid=0;
	
	$PreviousSalary=0;
	$RemainingLoan=0;
	
	$Title1="";
	$Title1check=0;
	$Title1amount=0;
	$Title2="";
	$Title2check=0;
	$Title2amount=0;
	$Title3="";
	$Title3check=0;
	$Title3amount=0;
	$Title4="";
	$Title4check=0;
	$Title4amount=0;
	$Title5="";
	$Title5check=0;
	$Title5amount=0;
	$Title6="";
	$Title6check=0;
	$Title6amount=0;
	
	$monthdays=0;
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{		
	if(isset($_POST["FromDate"]) && isset($_POST["ToDate"]))
	{
		$FromDate = trim($_POST["FromDate"]);
		$ToDate = trim($_POST["ToDate"]);

		
		$date1=date_create($FromDate);
		$date2=date_create($ToDate);
		$diff=date_diff($date1,$date2);
		$num_of_days = $diff->format("%a");
		$num_of_days = $num_of_days + 1;
		
		$e=strtotime($FromDate);		
		$MonthPayroll=date("M Y", $e);
		
		$g=strtotime($MonthPayroll);
		$monthdays = cal_days_in_month(CAL_GREGORIAN, date("m", $g), date("Y", $g));
	
	}
	
	if(isset($_POST["EmployeeID"]))
		$EmployeeID=trim($_POST["EmployeeID"]);

	
	if(isset($_POST["Remarks"]))
		$Remarks=trim($_POST["Remarks"]);
	if(isset($_POST["SpecialRemarks"]))
		$SpecialRemarks=trim($_POST["SpecialRemarks"]);
	
	if(isset($_POST["Title1"]))
		$Title1=trim($_POST["Title1"]);
	if(isset($_POST["Title1amount"]))
		$Title1amount=trim($_POST["Title1amount"]);
	if(isset($_POST["Title1check"]))
		$Title1check=trim($_POST["Title1check"]);
	if(isset($_POST["Title2"]))
		$Title2=trim($_POST["Title2"]);
	if(isset($_POST["Title2amount"]))
		$Title2amount=trim($_POST["Title2amount"]);
	if(isset($_POST["Title2check"]))
		$Title2check=trim($_POST["Title2check"]);
	if(isset($_POST["Title3"]))
		$Title3=trim($_POST["Title3"]);
	if(isset($_POST["Title3amount"]))
		$Title3amount=trim($_POST["Title3amount"]);
	if(isset($_POST["Title3check"]))
		$Title3check=trim($_POST["Title3check"]);
	if(isset($_POST["Title4"]))
		$Title4=trim($_POST["Title4"]);
	if(isset($_POST["Title4amount"]))
		$Title4amount=trim($_POST["Title4amount"]);
	if(isset($_POST["Title4check"]))
		$Title4check=trim($_POST["Title4check"]);
	if(isset($_POST["Title5"]))
		$Title5=trim($_POST["Title5"]);
	if(isset($_POST["Title5amount"]))
		$Title5amount=trim($_POST["Title5amount"]);
	if(isset($_POST["Title5check"]))
		$Title5check=trim($_POST["Title5check"]);
	if(isset($_POST["Title6"]))
		$Title6=trim($_POST["Title6"]);
	if(isset($_POST["Title6amount"]))
		$Title6amount=trim($_POST["Title6amount"]);
	if(isset($_POST["Title6check"]))
		$Title6check=trim($_POST["Title6check"]);
	
	if($ToDate < $FromDate)
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Dates are not valid.</b>
		</div>';
	}
	else if($EmployeeID == 0)
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Employee.</b>
		</div>';
	}
	
	if($msg=="")
	{
		
		
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("START TRANSACTION");
		
		$query = "SELECT CompanyID FROM employees where ID = ".$EmployeeID."";
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$compid = $row['CompanyID'];
		
		
		
		$query="INSERT INTO fullnfinal SET DateAdded=NOW(),
				MonthPayroll = '" . dbinput($MonthPayroll) . "',
				NumOfDays = '" . (int)$num_of_days . "',
				FromDate = '" . dbinput($FromDate) . "',
				ToDate = '" . dbinput($ToDate) . "',
				Remarks = '" . dbinput($Remarks) . "',
				SpecialRemarks = '" . dbinput($SpecialRemarks) . "',
				PerformedBy = '" . $_SESSION["UserID"] . "'";
		mysql_query($query) or die (mysql_error());
		$PayID = mysql_insert_id();
		
		//echo $PayID;exit();
			
			$query = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				
				$query3 = "SELECT ID,Salary,AttendanceAllowance,AttAllAmount,ResignationAccepted,PayFullSalary,StopSalary,Bank,AccountNumber,EmployeeContribution,EmployerContribution FROM employees where ID <> 0 AND Status = 'Deactive' AND ResignationAccepted = 'Yes' AND CompanyID = ".$compid." AND ID = ".(int)$EmployeeID." ORDER BY ID ASC";
				$res3 = mysql_query($query3) or die(mysql_error());
				$num3 = mysql_num_rows($res3);
				if($num3 == 1)
				{
					$row3 = mysql_fetch_array($res3);
						
						//echo $row3['ID'];exit();
						
						$query2="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.ID AS EmployeeID,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,e.Salary,li.LateArrival,li.EarlyDepart,li.ScheduleDepart AS Depart,sh.Name AS ScheduleName,li.ScheduleArrival AS ScheduleArrivalTime,li.ScheduleDepart AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Deactive' AND e.ResignationAccepted = 'Yes' AND (li.DateAdded BETWEEN '".$FromDate."' AND '".$ToDate."')  AND e.CompanyID = ".$compid." AND e.ID = ".$row3['ID']." ORDER BY e.EmpID ASC";
						
						//echo $query2;exit();
						
						$result = mysql_query ($query2) or die(mysql_error()); 
						$maxRow = mysql_num_rows($result);
						
						//echo $maxRow;exit();
						
						if($maxRow==0)
						{
						}
						else
						{
							while($row2 = mysql_fetch_array($result,MYSQL_ASSOC))
							{
								$PayFullSalary = $row3['PayFullSalary'];
								$StopSalary = $row3['StopSalary'];
								$Resignation = $row3['ResignationAccepted'];
								if($row3['Bank'] != "")
								{
									$BankorCash = 'Bank';
								}
								else
								{
									$BankorCash = 'Cash';
								}
								$AccountNum = $row3['AccountNumber'];
								
								$TotalDays = $TotalDays + 1;
								if($row2["Status"] == 'Present')
								{
									$TotalPresent = $TotalPresent + 1;
								}
								if($row2["Status"] == 'Absent')
								{
									$TotalAbsent = $TotalAbsent + 1;
								}
								if($row2["Status"] == 'Off Day')
								{
									$TotalOffDays = $TotalOffDays + 1;
								}
								if($row2["Status"] == 'Leave')
								{
									$TotalLeaves = $TotalLeaves + 1;
								}
								if($row2["HalfDay"] == 1)
								{
									$TotalHalfdays = $TotalHalfdays + 1;
								}
								if($row2["Late"] == 1)
								{
									$TotalLates = $TotalLates + 1;
								}
								if($row2["EarlyDep"] == 1)
								{
									$TotalEarlyDepart = $TotalEarlyDepart + 1;
								}
								if($row2['Status'] != 'Off Day')
								{
									list($hours, $minutes) = explode(':', $row2["ScheduleArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);
									list($hours, $minutes) = explode(':', $row2["ScheduleDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);
									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalHours = $TotalHours + $hours;
									$TotalMinutes = $TotalMinutes + $minutes;
								} 
								  
								  
								  if(dboutput($row2["Late"]) == 1)
									{
								   list($hours, $minutes) = explode(':', $row2["LateArrival"]);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));

									}
								 
								  if(dboutput($row2["EarlyDep"]) == 1)
									{
								   list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row2["EarlyDepart"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));

									}
									
								  if($row2["TArrivalTime"] == Null || $row2["TDepartTime"] == Null)
								  {
								  }
								  else
								  {
										list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));
										
										$TotalWorkingHours = $TotalWorkingHours + $hours;
										$TotalWorkingMinutes = $TotalWorkingMinutes + $minutes;
								  } 
								  if($row2['LeavesDays'] != "")
									{
									$LeaveDays = explode(',',$row2['LeavesDays']);
									}
									$OffDay=strtotime($row2["LoginDate"]);
									if (in_array(''.date("N", $OffDay).'', $LeaveDays))
									{
										if($row2["OvertimePolicy"] != 0)
										{
										  if($row2["TArrivalTime"] == Null || $row2["TDepartTime"] == Null)
										  {
												
										  }
										  else
										  {
										   list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
												$startTimestamp = mktime($hours, $minutes);

												list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
												$endTimestamp = mktime($hours, $minutes);

												$seconds = $endTimestamp - $startTimestamp;
												$minutes = ($seconds / 60) % 60;
												$hours = floor($seconds / (60 * 60));
												
												$TotalOvertimeHoursL = $TotalOvertimeHoursL + $hours;
												$TotalOvertimeMinutesL = $TotalOvertimeMinutesL + $minutes;
												
												if($hours > 0 || $minutes > 0 || $seconds > 0)
												{
													$OvertimeHolidayDays += 1;
												}
										  }
										}
									}
									else
									{
										if($row2["OvertimePolicy"] != 0)
										{
											
										$query4="SELECT ApplyAfter FROM overtime_policies WHERE ID <> 0 AND ID = ".$row2["OvertimePolicy"]." AND Status = 1";
										$result4 = mysql_query ($query4) or die(mysql_error()); 
										$num4 = mysql_num_rows($result4);
										if($num4 == 1)
										{
											$row4 = mysql_fetch_array($result4,MYSQL_ASSOC);
											
											 if($row2["TArrivalTime"] == Null || $row2["TDepartTime"] == Null)
											  {
												
											  }
											  else
											  {
												$ApplyAfter = strtotime($row2['Depart']);
												$ApplyAfter = date("H:i:s", strtotime('+'.$row4['ApplyAfter'].' minutes', $ApplyAfter));  
												
												if($row2["TDepartTime"] > $ApplyAfter)
												{  
													list($hours, $minutes) = explode(':', $ApplyAfter);
													$startTimestamp = mktime($hours, $minutes);

													list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
													$endTimestamp = mktime($hours, $minutes);

													$seconds = $endTimestamp - $startTimestamp;
													$minutes = ($seconds / 60) % 60;
													$hours = floor($seconds / (60 * 60));

													
													$TotalOvertimeHoursW = $TotalOvertimeHoursW + $hours;
													$TotalOvertimeMinutesW = $TotalOvertimeMinutesW + $minutes;
												}
											  }
										}
										
										}
									}
								
								$TotalMinutes = round(($TotalMinutes / 60));
								$TotalHours = $TotalHours + $TotalMinutes;
								  
								$TotalWorkingMinutes = round(($TotalWorkingMinutes / 60));
								$TotalWorkingHours = $TotalWorkingHours + $TotalWorkingMinutes;
								  
								$TotalOvertimeMinutesL = round(($TotalOvertimeMinutesL / 60));
								$TotalOvertimeHoursL = $TotalOvertimeHoursL + $TotalOvertimeMinutesL;
								
								$TotalOvertimeMinutesW = round(($TotalOvertimeMinutesW / 60));
								$TotalOvertimeHoursW = $TotalOvertimeHoursW + $TotalOvertimeMinutesW;
							
								$query = "SELECT Amount AS BasicSalary FROM basicsalary where ID <> 0 AND EmpID = ".$row2["EmployeeID"]." AND Approved = 1";
								$res = mysql_query($query) or die(mysql_error());
								$num_basic = mysql_num_rows($res);
								if($num_basic == 1)
								{
								$row1 = mysql_fetch_array($res);
								$BasicSalary = $row1['BasicSalary'];
								}
								
								$AllowanceBreakup = round(($BasicSalary / 2) + 300);
								
								$query = "SELECT OTHourType,OTHourBase,OTHourValue,OTHolidayType,OTHolidayBase,OTHolidayValue FROM overtime_policies where ID <> 0 AND Status = 1 AND ID = ".$row2["OvertimePolicy"]."";
								$res = mysql_query($query) or die(mysql_error());
								$num_overtimes = mysql_num_rows($res);
								if($num_overtimes == 1)
								{
									$row7 = mysql_fetch_array($res);
									
									$OvertimeAmountL = overtime_amount($TotalOvertimeHoursL,$num_of_days,$row7['OTHolidayType'],$row7['OTHolidayBase'],$row7['OTHolidayValue'],$BasicSalary,$row2['Salary'],$compid,$OvertimeHolidayDays);
									
									$OvertimeAmountW = overtime_amount($TotalOvertimeHoursW,$num_of_days,$row7['OTHourType'],$row7['OTHourBase'],$row7['OTHourValue'],$BasicSalary,$row2['Salary'],$compid);
								}
								
								
								$query7 = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
								$res = mysql_query($query7) or die(mysql_error());
								$num_companydetails = mysql_num_rows($res);
								if($num_companydetails == 1)
								{
									$row7 = mysql_fetch_array($res);
									
									if($row7['DeductionOnLates'] == "Yes")
									{
										if($row7['DeductionOnLatesTypes'] == "Included")
										{
											$TotalLateEarlies = ($TotalLates + $TotalEarlyDepart);
											
											if($TotalLateEarlies > 0)
											{
											
											if($TotalLateEarlies > 31)
											{
												$TotalLateEarliesDedDays = $row7['Days31'];
												if($row7['HalfDays31'] == 1)
												{
													$TotalLateEarliesDedDays = $TotalLateEarliesDedDays + 0.5;
												}
												
											}
											else
											{
												$TotalLateEarliesDedDays = $row7['Days'.$TotalLateEarlies];
												if($row7['HalfDays'.$TotalLateEarlies] == 1)
												{
													$TotalLateEarliesDedDays = $TotalLateEarliesDedDays + 0.5;
												}
											}
											
											}
											
										}
										if($row7['DeductionOnLatesTypes'] == "Individual")
										{
											//$TotalLateEarlies = ($TotalLates + $TotalEarlyDepart);
											
											if($TotalLates > 0)
											{
											
											if($TotalLates > 31)
											{
												$TotalLateDedDays = $row7['Days31'];
												if($row7['HalfDays31'] == 1)
												{
													$TotalLateDedDays = $TotalLateDedDays + 0.5;
												}
												
											}
											else
											{
												$TotalLateDedDays = $row7['Days'.$TotalLates];
												if($row7['HalfDays'.$TotalLates] == 1)
												{
													$TotalLateDedDays = $TotalLateDedDays + 0.5;
												}
											}
											
											}
											
											if($TotalEarlyDepart > 0)
											{
											
											if($TotalEarlyDepart > 31)
											{
												$TotalEarliesDedDays = $row7['EDays31'];
												if($row7['EHalfDays31'] == 1)
												{
													$TotalEarliesDedDays = $TotalEarliesDedDays + 0.5;
												}
												
											}
											else
											{
												$TotalEarliesDedDays = $row7['EDays'.$TotalEarlyDepart];
												if($row7['EHalfDays'.$TotalEarlyDepart] == 1)
												{
													$TotalEarliesDedDays = $TotalEarliesDedDays + 0.5;
												}
											}
											
											}
											
											$TotalLateEarliesDedDays = ($TotalLateDedDays + $TotalEarliesDedDays);
										}
									}
								}
							
							}
							
							if($row['DeductionOnLatesAdjustment'] == "Yes")
							{
								$query7 = "SELECT AnualLeaves,CasualLeaves FROM current_leaves_quota WHERE EmpID = " . $row3["ID"] . "";
								$result7 = mysql_query($query7) or die (mysql_error());
								$num7_quota = mysql_num_rows($result7);
								
								if($num7_quota > 0)
								{
									$row7 = mysql_fetch_array($result7);
									$j = $TotalLateEarliesDedDays;
									for($l = 0.5; $l <= $j; $l += 0.5)
									{
									if($row7['CasualLeaves'] > 0.4)
									{
										// $query2="INSERT INTO minus_leaves_quota_payroll SET EmpID = " . $row3["ID"] . ", LeaveQty=0.5,
										// LeaveType = 'CasualLeaves',PayID = " . $PayID . "";
										// mysql_query($query2) or die (mysql_error());
										
										$query2="UPDATE current_leaves_quota SET CasualLeaves = (CasualLeaves - 0.5) WHERE EmpID = " . $row3["ID"] . "";
										mysql_query($query2) or die (mysql_error());
										
										$TotalLateEarliesDedDays -= 0.5;
									}
									else if($row7['AnualLeaves'] > 0.4)
									{	
										// $query2="INSERT INTO minus_leaves_quota_payroll SET EmpID = " . $row3["ID"] . ", LeaveQty=0.5,
										// LeaveType = 'AnualLeaves',PayID = " . $PayID . "";
										// mysql_query($query2) or die (mysql_error());
										
										$query2="UPDATE current_leaves_quota SET AnualLeaves = (AnualLeaves - 0.5) WHERE EmpID = " . $row3["ID"] . "";
										mysql_query($query2) or die (mysql_error());
										
										$TotalLateEarliesDedDays -= 0.5;
									}
									}
								}
							}
							
							$query = "SELECT Title,Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title <> 'House Rent' AND Title <> 'Utility' AND Title <> 'Conveyance'";
							
							//$query = "AND Taxable = 'No'";
								
							$res = mysql_query($query) or die(mysql_error());
							$num_withouttax_allowance = mysql_num_rows($res);
							if($num_withouttax_allowance > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$Type = $row7['Type'];
									if($Type == "FixedAmount")
									{
										$Allowance_WithoutTax += $row7['Amount'];
										
										// $query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Title']."',Type = 'Fixed Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
										// mysql_query($query) or die(mysql_error());
									}
									else if($Type == "Percentage")
									{
										$Allowance_WithoutTax += ($row7['Percentage'] / 100) * $BasicSalary;
										
										// $query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".(($row7['Percentage'] / 100) * $BasicSalary).",Name = '".$row7['Title']."',Type = 'Fixed Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
										// mysql_query($query) or die(mysql_error());
									}
								}
							}
							
							$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 1 AND (ad.Date BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query; exit();
							$res = mysql_query($query) or die(mysql_error());
							$num_inc_adjustment = mysql_num_rows($res);
							if($num_inc_adjustment > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$Inc_Adjustments += $row7['Amount'];
									
									// $query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Name']."',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
								}
							}
							
							$OtherAllowances = $Allowance_WithoutTax + $Inc_Adjustments;
							
							if(($TotalPresent ==  ($num_of_days - $TotalOffDays)) && $TotalHalfdays == 0)
							{
								if($row3["AttendanceAllowance"] == 'FixedAmount')
								{
									// $query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row3['AttAllAmount'].",Name = 'Attendance Allowance',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
									
									$OtherAllowances = $OtherAllowances + $row3['AttAllAmount'];
								}
								if($row3["AttendanceAllowance"] == 'GrossSalary')
								{
									$AttAllowance = $row3["Salary"] / $num_of_days;
									$AttAllowance = round($AttAllowance,2);
									
									// $query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$AttAllowance.",Name = 'Attendance Allowance',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
									
									$OtherAllowances = $OtherAllowances + $AttAllowance;
								}
								
							}
							
							$query = "SELECT Title,Type,Amount,Percentage FROM deductions where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title <> 'Income Tax'";
								
							$res = mysql_query($query) or die(mysql_error());
							$num_deductions = mysql_num_rows($res);
							if($num_deductions > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$Type = $row7['Type'];
									if($Type == "FixedAmount")
									{
										$FixDeductions += $row7['Amount'];
										
										// $query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Title']."',Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
										// mysql_query($query) or die(mysql_error());
									}
									else if($Type == "Percentage")
									{
										$FixDeductions += ($row7['Percentage'] / 100) * $BasicSalary;
										
										// $query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".(($row7['Percentage'] / 100) * $BasicSalary).",Name = '".$row7['Title']."',Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
										// mysql_query($query) or die(mysql_error());
									}
								}
							}
							
							$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 0 AND (ad.Date BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query; exit();
							$res = mysql_query($query) or die(mysql_error());
							$num_inc_adjustment = mysql_num_rows($res);
							if($num_inc_adjustment > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$Dec_Adjustments += $row7['Amount'];
									
									// $query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Name']."',Type = 'One Time Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
								}
							}
							
							$OtherDeductions = $FixDeductions + $Dec_Adjustments;
							
							// $query = "INSERT INTO payrollcontributiondetails SET PayID = ".$PayID.", EmpID = ".$row3["ID"].",Name = 'Contribution Investment',Amount = ".($row3['EmployeeContribution'] + $row3['EmployerContribution']).",EmployeeContribution = ".$row3['EmployeeContribution'].",EmployerContribution = ".$row3['EmployerContribution'].",Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
							// mysql_query($query) or die(mysql_error());
							
							// $OtherDeductions = $OtherDeductions + $row3['EmployeeContribution'];
							
							$query = "SELECT ID,Amount FROM advances where ID <> 0 AND Status = 0 AND IsCompleted = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query; exit();
							$res = mysql_query($query) or die(mysql_error());
							$num_adv = mysql_num_rows($res);
							if($num_adv > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$OtherDeductions += $row7['Amount'];
									
									// $query = "INSERT INTO payrolladvancedetails SET PayID = ".$PayID.", AdvID = ".$row7['ID'].",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].", PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
								}
							}
							
							$query = "UPDATE advances SET Status = 1, IsCompleted = 1 where ID <> 0 AND Status = 0 AND IsCompleted = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							mysql_query($query) or die(mysql_error());
							
							$query = "SELECT ls.ID,l.ID AS LID,ls.Amount,l.LoanType FROM loans_schedule ls LEFT JOIN loans l ON ls.LoanID = l.ID where l.ID <> 0 AND l.Status = 0 AND ls.Status = 0 AND l.EmpID = ".$row3["ID"]." AND ls.EmpID = ".$row3["ID"]." AND (ls.RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query; exit();
							$res = mysql_query($query) or die(mysql_error());
							$num_loan = mysql_num_rows($res);
							if($num_loan > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$OtherDeductions += $row7['Amount'];
									
									// $query = "INSERT INTO payrollloandetails SET PayID = ".$PayID.", LoanID = ".$row7['LID'].",LoanScheduleID = ".$row7['ID'].",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Type = '".$row7['LoanType']."', PerformedBy = '" . $_SESSION["UserID"] . "'";
									// mysql_query($query) or die(mysql_error());
									
									$query = "UPDATE loans SET RemainingAmount = (RemainingAmount - ".$row7['Amount'].") where ID = ".$row7['LID']."";
									mysql_query($query) or die(mysql_error());
								}
							}
							
							$query = "UPDATE loans_schedule SET Status = 1 where ID <> 0 AND Status = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							mysql_query($query) or die(mysql_error());
							
							$query = "SELECT Type,Amount,Percentage FROM deductions where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title = 'Income Tax'";
								
							$res = mysql_query($query) or die(mysql_error());
							$num_incometax = mysql_num_rows($res);
							if($num_incometax > 0)
							{
								while($row7 = mysql_fetch_array($res))
								{
									$Type = $row7['Type'];
									if($Type == "FixedAmount")
									{
										$IncomeTax += $row7['Amount'];
									}
									else if($Type == "Percentage")
									{
										$IncomeTax += ($row7['Percentage'] / 100) * $BasicSalary;
									}
								}
							}
							
							$query5 = "SELECT SUM(Qty) AS Qty FROM minus_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "' AND (LeaveDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								if($row5['Qty'] != null)
								{
									$UtilizeLeave += $row5['Qty'];
								}
							}
							
							$query5 = "SELECT SUM(NumOfDays) AS Qty FROM grant_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "' AND (LeaveDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								if($row5['Qty'] != null)
								{
									$GrantLeave += $row5['Qty'];
								}
							}
							
							$query5 = "SELECT SUM(Qty) AS Qty FROM minus_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "' AND (LeaveDate BETWEEN '".$FromDate."' AND '".$ToDate."') AND LeaveType = 'SpecialLeave'";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								if($row5['Qty'] != null)
								{
									$GrantLeave += $row5['Qty'];
								}
							}
							
							
							$query5 = "SELECT SUM(NumOfDays) AS Qty FROM writeoff_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "' AND (LeaveDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								if($row5['Qty'] != null)
								{
									$WriteOffLeave += $row5['Qty'];
								}
							}
							
							$query5 = "SELECT AnualLeaves,SickLeaves,CasualLeaves FROM current_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "'";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								
								$BalanceLeave += ($row5['AnualLeaves'] + $row5['SickLeaves'] + $row5['CasualLeaves']);
							}
							
							$query5 = "SELECT SUM(Qty) AS Qty FROM minus_leaves_quota where ID <> 0 AND EmpID='" . (int)$row3["ID"] . "' AND (LeaveDate BETWEEN '".$ToDate."' AND '".date('Y-m-d')."') AND LeaveType <> 'SpecialLeave'";
							//echo $query5;
							$res5 = mysql_query($query5);
							$num5 = mysql_num_rows($res5);
							if($num5 > 0)
							{
								$row5 = mysql_fetch_array($res5);
								if($row5['Qty'] != null)
								{
									$AfterBalance += $row5['Qty'];
								}
							}
							
							$BalanceLeave = $BalanceLeave + $AfterBalance;
							$OpeningLeave = $BalanceLeave + $WriteOffLeave + $UtilizeLeave - $GrantLeave;
							
							if($PayFullSalary == 'No')
							{
								$query="UPDATE fullnfinal SET 
								EmpID = '" . (int)$row3["ID"] . "',
								Basic = '" . dbinput($BasicSalary) . "',
								AllowanceBreakup = '" . dbinput($AllowanceBreakup) . "',
								Gross = '" . dbinput($row3["Salary"]) . "',
								Present = '" . (int)$TotalPresent . "',
								Lates = '" . (int)$TotalLates . "',
								Earlies = '" . (int)$TotalEarlyDepart . "',
								LEDeductions = '" . $TotalLateEarliesDedDays . "',
								HalfDays = '" . (int)$TotalHalfdays . "',
								OffDays = '" . (int)$TotalOffDays . "',
								Leaves = '" . (int)$TotalLeaves . "',
								Absent = '" . (int)$TotalAbsent . "',
								TotalDays = '" . ($TotalPresent + $TotalOffDays + $TotalLeaves - ($TotalLateEarliesDedDays + ($TotalHalfdays * 0.5))) . "',
								GrossOfDays = '" . round(($row3['Salary'] / $monthdays) * ($TotalPresent + $TotalOffDays + $TotalLeaves - ($TotalLateEarliesDedDays + ($TotalHalfdays * 0.5))),2) . "',
								WOvertimeH = '" . (int)$TotalOvertimeHoursW . "',
								WOvertimeA = '" . dbinput($OvertimeAmountW) . "',
								LOvertimeH = '" . (int)$TotalOvertimeHoursL . "',
								LOvertimeA = '" . dbinput($OvertimeAmountL) . "',
								OvertimeHolidayDays = '" . dbinput($OvertimeHolidayDays) . "',
								OtherAllowances = '" . $OtherAllowances . "',
								OtherDeductions = '" . $OtherDeductions . "',
								IncomeTax = '" . $IncomeTax . "',
								PayFullSalary = '" . dbinput($PayFullSalary) . "',
								StopSalary = '" . dbinput($StopSalary) . "',
								Resignation = '" . dbinput($Resignation) . "',
								BankorCash = '" . dbinput($BankorCash) . "',
								AccountNum = '" . dbinput($AccountNum) . "',
								LeaveOpening = '" . $OpeningLeave . "',
								LeaveGrant = '" . $GrantLeave . "',
								LeaveUtilize = '" . $UtilizeLeave . "',
								LeaveWriteoff = '" . $WriteOffLeave . "',
								LeaveBalance = '" . $BalanceLeave . "',
								Title1 = '" . dbinput($Title1) . "',
								Title1check = '".(int)$Title1check . "',
								Title1amount = '" . $Title1amount . "',
								Title2 = '" . dbinput($Title2) . "',
								Title2check = '".(int)$Title2check . "',
								Title2amount = '" . $Title2amount . "',
								Title3 = '" . dbinput($Title3) . "',
								Title3check = '".(int)$Title3check . "',
								Title3amount = '" . $Title3amount . "',
								Title4 = '" . dbinput($Title4) . "',
								Title4check = '".(int)$Title4check . "',
								Title4amount = '" . $Title4amount . "',
								Title5 = '" . dbinput($Title5) . "',
								Title5check = '".(int)$Title5check . "',
								Title5amount = '" . $Title5amount . "',
								Title6 = '" . dbinput($Title6) . "',
								Title6check = '".(int)$Title6check . "',
								Title6amount = '" . $Title6amount . "' WHERE ID = ".$PayID." ";
								mysql_query($query) or die (mysql_error());
							}
							else
							{
								$query="UPDATE fullnfinal SET 
								EmpID = '" . (int)$row3["ID"] . "',
								Basic = '" . dbinput($BasicSalary) . "',
								AllowanceBreakup = '" . dbinput($AllowanceBreakup) . "',
								Gross = '" . dbinput($row3["Salary"]) . "',
								Present = '" . (int)($TotalPresent + $TotalAbsent) . "',
								Lates = '0',
								Earlies = '0',
								LEDeductions = '0',
								HalfDays = '0',
								OffDays = '" . (int)$TotalOffDays . "',
								Leaves = '" . (int)$TotalLeaves . "',
								Absent = '0',
								TotalDays = '" . ($TotalPresent + $TotalOffDays + $TotalLeaves + $TotalAbsent) . "',
								GrossOfDays = '" . dbinput($row3["Salary"]) . "',
								WOvertimeH = '" . (int)$TotalOvertimeHoursW . "',
								WOvertimeA = '" . dbinput($OvertimeAmountW) . "',
								LOvertimeH = '" . (int)$TotalOvertimeHoursL . "',
								LOvertimeA = '" . dbinput($OvertimeAmountL) . "',
								OvertimeHolidayDays = '" . dbinput($OvertimeHolidayDays) . "',
								OtherAllowances = '" . $OtherAllowances . "',
								OtherDeductions = '" . $OtherDeductions . "',
								IncomeTax = '" . $IncomeTax . "',
								PayFullSalary = '" . dbinput($PayFullSalary) . "',
								StopSalary = '" . dbinput($StopSalary) . "',
								Resignation = '" . dbinput($Resignation) . "',
								BankorCash = '" . dbinput($BankorCash) . "',
								AccountNum = '" . dbinput($AccountNum) . "',
								LeaveOpening = '" . $OpeningLeave . "',
								LeaveGrant = '" . $GrantLeave . "',
								LeaveUtilize = '" . $UtilizeLeave . "',
								LeaveWriteoff = '" . $WriteOffLeave . "',
								LeaveBalance = '" . $BalanceLeave . "',
								Title1 = '" . dbinput($Title1) . "',
								Title1check = '".(int)$Title1check . "',
								Title1amount = '" . $Title1amount . "',
								Title2 = '" . dbinput($Title2) . "',
								Title2check = '".(int)$Title2check . "',
								Title2amount = '" . $Title2amount . "',
								Title3 = '" . dbinput($Title3) . "',
								Title3check = '".(int)$Title3check . "',
								Title3amount = '" . $Title3amount . "',
								Title4 = '" . dbinput($Title4) . "',
								Title4check = '".(int)$Title4check . "',
								Title4amount = '" . $Title4amount . "',
								Title5 = '" . dbinput($Title5) . "',
								Title5check = '".(int)$Title5check . "',
								Title5amount = '" . $Title5amount . "',
								Title6 = '" . dbinput($Title6) . "',
								Title6check = '".(int)$Title6check . "',
								Title6amount = '" . $Title6amount . "' WHERE ID = ".$PayID." ";
								mysql_query($query) or die (mysql_error());
							}
								
						} 
				}
			}	
		
		
		// $startdate=strtotime($FromDate);
		// for($i=0; $i<$num_of_days;$i++)
		// {
			//here execution code

			// $startdate = strtotime("+1 day", $startdate);
		// }
		
			$query="Update fullnfinal SET GrossOfDays = ROUND(GrossOfDays) Where ID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
		
			$query="Update fullnfinal SET NetPay = ROUND(GrossOfDays + WOvertimeA + LOvertimeA + OtherAllowances - OtherDeductions - IncomeTax) Where ID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
			
			$query = "SELECT SUM(NetPay) AS PreviousSalary FROM payrolldetails WHERE EmpID = ".(int)$EmployeeID." AND (StopSalary = 'Yes' OR Resignation = 'Yes') AND ID <> 0";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num > 0)
			{
				$row = mysql_fetch_array($res);
				$PreviousSalary = $row['PreviousSalary'];
				$PreviousSalary = round($PreviousSalary);
			}
			
			$query="SELECT SUM(RemainingAmount) AS RemainingLoan FROM loans WHERE EmpID=".(int)$EmployeeID." AND ID <> 0";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num > 0)
			{
				$row = mysql_fetch_array($res);
				$RemainingLoan = $row['RemainingLoan'];
				$RemainingLoan = round($RemainingLoan);
			}
			
			$query="Update fullnfinal SET PreviousSalary = ".$PreviousSalary.",RemainingLoan = ".$RemainingLoan." Where ID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
			
			
			$ExtraAmount = 0;
			$ExtraAmount += $PreviousSalary;
			$ExtraAmount -= $RemainingLoan;
			
			if($Title1check > 0)
			{
				if($Title1check == 1)
				{
					$ExtraAmount += $Title1amount;
				}
				else if($Title1check == 2)
				{
					$ExtraAmount -= $Title1amount;
				}
			}
			
			if($Title2check > 0)
			{
				if($Title2check == 1)
				{
					$ExtraAmount += $Title2amount;
				}
				else if($Title2check == 2)
				{
					$ExtraAmount -= $Title2amount;
				}
			}
			
			if($Title3check > 0)
			{
				if($Title3check == 1)
				{
					$ExtraAmount += $Title3amount;
				}
				else if($Title3check == 2)
				{
					$ExtraAmount -= $Title3amount;
				}
			}
			
			if($Title4check > 0)
			{
				if($Title4check == 1)
				{
					$ExtraAmount += $Title4amount;
				}
				else if($Title4check == 2)
				{
					$ExtraAmount -= $Title4amount;
				}
			}
			
			if($Title5check > 0)
			{
				if($Title5check == 1)
				{
					$ExtraAmount += $Title5amount;
				}
				else if($Title5check == 2)
				{
					$ExtraAmount -= $Title5amount;
				}
			}
			
			if($Title6check > 0)
			{
				if($Title6check == 1)
				{
					$ExtraAmount += $Title6amount;
				}
				else if($Title6check == 2)
				{
					$ExtraAmount -= $Title6amount;
				}
			}
			
			$ExtraAmount = round($ExtraAmount);
			
			$query="Update fullnfinal SET GrandNetPay = (NetPay + ".$ExtraAmount.") Where ID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
			
			$query="Update fullnfinal SET GrandNetPay = ROUND(GrandNetPay) Where ID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
			
			mysql_query("COMMIT");
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Full n Final has been Generated.</b>
			</div>';
			
			redirect("AddNewFullnFinal.php");
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Full n Final</title>
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
      <h1>Add Full n Final</h1>
      <ol class="breadcrumb">
        <li><a href="FullnFinal.php"><i class="fa fa-dashboard"></i>Full n Final</a></li>
        <li class="active">Add Full n Final</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Generate</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='FullnFinal.php'">Cancel</button>
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Full n Final Date</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="FromDate">From Date:</label>
				  <input autofocus type="date" name="FromDate" value="<?php echo $FromDate; ?>" class="form-control" />
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="ToDate">Till Date:</label>
				  <input type="date" name="ToDate" value="<?php echo $ToDate; ?>" class="form-control" />
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Full n Final Remarks</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Remarks">Remarks (Print at Slip):</label>
				  <?php 
				echo '<textarea rows="5" maxlength="500" id="Remarks" name="Remarks" class="form-control">'.$Remarks.'</textarea>';
				?>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="SpecialRemarks">Special Remarks (Only for Record):</label>
				  <?php 
				echo '<textarea rows="5" maxlength="500" id="SpecialRemarks" name="SpecialRemarks" class="form-control">'.$SpecialRemarks.'</textarea>';
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Full n Final Applicable</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
					<label id="labelimp" for="EmployeeID" >Employee: <span class="requiredStar">*</span></label>
					<select style="width:100%" name="EmployeeID" id="EmployeeID" class="form-control">
					<option value="" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Deactive' AND ResignationAccepted = 'Yes' AND ID NOT IN (Select EmpID from fullnfinal where ID <> 0) ORDER BY ID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($EmployeeID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
					</select>
				</div>
				

			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
         </div>
		 
		 
		<div class="col-md-12">
		<div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Adjustment Heads</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <h4>Head Title </h4>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					   <h4>Title Type </h4>
					</div>
				  </div>
				  <div class="col-md-4">
					<h4>Amount </h4>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title1" value="<?php echo $Title1; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title1check" class="form-control">
					 <option value="0" <?php echo ($Title1check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title1check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title1check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title1amount" value="<?php echo $Title1amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title2" value="<?php echo $Title2; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title2check" class="form-control">
					 <option value="0" <?php echo ($Title2check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title2check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title2check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title2amount" value="<?php echo $Title2amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title3" value="<?php echo $Title3; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title3check" class="form-control">
					 <option value="0" <?php echo ($Title3check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title3check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title3check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title3amount" value="<?php echo $Title3amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title4" value="<?php echo $Title4; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title4check" class="form-control">
					 <option value="0" <?php echo ($Title4check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title4check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title4check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title4amount" value="<?php echo $Title4amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title5" value="<?php echo $Title5; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title5check" class="form-control">
					 <option value="0" <?php echo ($Title5check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title5check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title5check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title5amount" value="<?php echo $Title5amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title6" value="<?php echo $Title6; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title6check" class="form-control">
					 <option value="0" <?php echo ($Title6check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title6check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title6check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title6amount" value="<?php echo $Title6amount; ?>">
					</div>
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
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#EmployeeID').select2();
</script>
</body>
</html>