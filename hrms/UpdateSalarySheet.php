<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php

$OpeningLeave=0;
$GrantLeave=0;
$UtilizeLeave=0;
$WriteOffLeave=0;
$BalanceLeave=0;
$AfterBalance=0;

$msg="";
$ID=0;	
$num_of_days=0;
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

$Tax_Step1=0;
$Tax_Step2=0;
$Tax_Step3=0;
$Tax_Step4=0;
$Tax_Step5=0;
$Tax_Step6=0;
$Tax_Step7=0;
$Tax_Step8=0;
$Tax_Step9=0;
$Tax_Step10=0;
$Tax_Step11=0;
$Tax_Step12=0;
$Tax_Step13=0;
$Tax_Step14=0;
$Tax_Step15=0;
$Tax_Step16=0;
$Tax_Step17=0;
$Tax_Step18=0;
$Tax_Step19=0;
$Tax_Step20=0;

$MonthPayroll="";

if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	

if(isset($_REQUEST["PayrollID"]))
{
	$PayID = $_REQUEST["ID"];
	$num_of_days = $_REQUEST["NumOfDays"];
	
	$query="SELECT MonthPayroll FROM payroll WHERE ID = ".$PayID."";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	if($num == 1)
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$MonthPayroll = $row['MonthPayroll'];
	}
	else
	{
		$ToDate = $_REQUEST["PayrollToDate"];
		$e=strtotime($ToDate);		
		$MonthPayroll=date("M Y", $e);
	}
	
	$query="SELECT LeaveType,EmpID FROM minus_leaves_quota_payroll WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			$query2="UPDATE current_leaves_quota SET ".$row["LeaveType"]." = (".$row["LeaveType"]." + 0.5) WHERE EmpID = " . $row["EmpID"] . "";
			mysql_query($query2) or die (mysql_error());
		}
	}
	
	$query="SELECT AdvID FROM payrolladvancedetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			$query2="UPDATE advances SET Status = 0, IsCompleted = 0 WHERE ID = " . $row["AdvID"] . "";
			mysql_query($query2) or die (mysql_error());
		}
	}
	
	$query="SELECT LoanID,LoanScheduleID,Amount FROM payrollloandetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			$query2="UPDATE loans_schedule SET Status = 0 WHERE ID = " . $row["LoanScheduleID"] . "";
			mysql_query($query2) or die (mysql_error());
			
			$query2="UPDATE loans SET RemainingAmount = (RemainingAmount + ".$row["Amount"].") WHERE ID = " . $row["LoanID"] . "";
			mysql_query($query2) or die (mysql_error());
		}
	}
	
	mysql_query("DELETE FROM minus_leaves_quota_payroll WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrolladvancedetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrollloandetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrollallowancedetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrolldeductiondetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrollcontributiondetails WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());
	mysql_query("DELETE FROM payrolltaxes WHERE PayID = ".$PayID." AND EmpID = ".$_REQUEST["PayrollEmpID"]."") or die (mysql_error());

	$query = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$_REQUEST["PayrollCompanyID"]."";
	$res = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($res);
	if($num == 1)
	{
		$row = mysql_fetch_array($res);
		
		$query3 = "SELECT ID,Salary,AttendanceAllowance,AttAllAmount,ResignationAccepted,PayFullSalary,StopSalary,Bank,AccountNumber,EmployeeContribution,EmployerContribution FROM employees where ID = ".$_REQUEST["PayrollEmpID"]." ORDER BY ID ASC";
		$res3 = mysql_query($query3) or die(mysql_error());
		$num3 = mysql_num_rows($res3);
		if($num3 > 0)
		{
			while($row3 = mysql_fetch_array($res3))
			{
				$query2="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.ID AS EmployeeID,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,e.Salary,li.LateArrival,li.EarlyDepart,li.ScheduleDepart AS Depart,sh.Name AS ScheduleName,li.ScheduleArrival AS ScheduleArrivalTime,li.ScheduleDepart AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND e.GetSalary = 'Yes' AND (li.DateAdded BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')  AND e.CompanyID = ".$_REQUEST["PayrollCompanyID"]." AND e.ID = ".$row3['ID']." ORDER BY e.EmpID ASC";
				
				$result = mysql_query ($query2) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				
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
						
						$AllowanceBreakup = round(($BasicSalary / 2));
						
						$query = "SELECT OTHourType,OTHourBase,OTHourValue,OTHolidayType,OTHolidayBase,OTHolidayValue FROM overtime_policies where ID <> 0 AND Status = 1 AND ID = ".$row2["OvertimePolicy"]."";
						$res = mysql_query($query) or die(mysql_error());
						$num_overtimes = mysql_num_rows($res);
						if($num_overtimes == 1)
						{
							$row7 = mysql_fetch_array($res);
							
							$OvertimeAmountL = overtime_amount($TotalOvertimeHoursL,$num_of_days,$row7['OTHolidayType'],$row7['OTHolidayBase'],$row7['OTHolidayValue'],$BasicSalary,$row2['Salary'],$_REQUEST["PayrollCompanyID"],$OvertimeHolidayDays);
							
							$OvertimeAmountW = overtime_amount($TotalOvertimeHoursW,$num_of_days,$row7['OTHourType'],$row7['OTHourBase'],$row7['OTHourValue'],$BasicSalary,$row2['Salary'],$_REQUEST["PayrollCompanyID"]);
						}
						
						
						$query7 = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$_REQUEST["PayrollCompanyID"]."";
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
								$query2="INSERT INTO minus_leaves_quota_payroll SET EmpID = " . $row3["ID"] . ", LeaveQty=0.5,
								LeaveType = 'CasualLeaves',PayID = " . $PayID . "";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET CasualLeaves = (CasualLeaves - 0.5) WHERE EmpID = " . $row3["ID"] . "";
								mysql_query($query2) or die (mysql_error());
								
								$TotalLateEarliesDedDays -= 0.5;
							}
							else if($row7['AnualLeaves'] > 0.4)
							{	
								$query2="INSERT INTO minus_leaves_quota_payroll SET EmpID = " . $row3["ID"] . ", LeaveQty=0.5,
								LeaveType = 'AnualLeaves',PayID = " . $PayID . "";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET AnualLeaves = (AnualLeaves - 0.5) WHERE EmpID = " . $row3["ID"] . "";
								mysql_query($query2) or die (mysql_error());
								
								$TotalLateEarliesDedDays -= 0.5;
							}
							}
						}
					}
					
					$query = "SELECT Title,Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title <> 'House Rent' AND Title <> 'Utility' AND Title <> 'Medical'";
					
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
								
								$query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Title']."',Type = 'Fixed Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
								mysql_query($query) or die(mysql_error());
							}
							else if($Type == "Percentage")
							{
								$Allowance_WithoutTax += ($row7['Percentage'] / 100) * $BasicSalary;
								
								$query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".(($row7['Percentage'] / 100) * $BasicSalary).",Name = '".$row7['Title']."',Type = 'Fixed Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
								mysql_query($query) or die(mysql_error());
							}
						}
					}
					
					$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 1 AND (ad.Date BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					//echo $query; exit();
					$res = mysql_query($query) or die(mysql_error());
					$num_inc_adjustment = mysql_num_rows($res);
					if($num_inc_adjustment > 0)
					{
						while($row7 = mysql_fetch_array($res))
						{
							$Inc_Adjustments += $row7['Amount'];
							
							$query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Name']."',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
						}
					}
					
					$OtherAllowances = $Allowance_WithoutTax + $Inc_Adjustments;
					
					if(($TotalPresent ==  ($num_of_days - $TotalOffDays)) && $TotalHalfdays == 0)
					{
						if($row3["AttendanceAllowance"] == 'FixedAmount')
						{
							$query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row3['AttAllAmount'].",Name = 'Attendance Allowance',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
							
							$OtherAllowances = $OtherAllowances + $row3['AttAllAmount'];
						}
						if($row3["AttendanceAllowance"] == 'GrossSalary')
						{
							$AttAllowance = $row3["Salary"] / $num_of_days;
							$AttAllowance = round($AttAllowance,2);
							
							$query = "INSERT INTO payrollallowancedetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$AttAllowance.",Name = 'Attendance Allowance',Type = 'One Time Allowance', PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
							
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
								
								$query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Title']."',Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
								mysql_query($query) or die(mysql_error());
							}
							else if($Type == "Percentage")
							{
								$FixDeductions += ($row7['Percentage'] / 100) * $BasicSalary;
								
								$query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".(($row7['Percentage'] / 100) * $BasicSalary).",Name = '".$row7['Title']."',Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
								mysql_query($query) or die(mysql_error());
							}
						}
					}
					
					$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 0 AND (ad.Date BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					//echo $query; exit();
					$res = mysql_query($query) or die(mysql_error());
					$num_inc_adjustment = mysql_num_rows($res);
					if($num_inc_adjustment > 0)
					{
						while($row7 = mysql_fetch_array($res))
						{
							$Dec_Adjustments += $row7['Amount'];
							
							$query = "INSERT INTO payrolldeductiondetails SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Name = '".$row7['Name']."',Type = 'One Time Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
						}
					}
					
					$OtherDeductions = $FixDeductions + $Dec_Adjustments;
					
					$query = "INSERT INTO payrollcontributiondetails SET PayID = ".$PayID.", EmpID = ".$row3["ID"].",Name = 'Contribution Investment',Amount = ".($row3['EmployeeContribution'] + $row3['EmployerContribution']).",EmployeeContribution = ".$row3['EmployeeContribution'].",EmployerContribution = ".$row3['EmployerContribution'].",Type = 'Fixed Deduction', PerformedBy = '" . $_SESSION["UserID"] . "'";
					mysql_query($query) or die(mysql_error());
					
					$OtherDeductions = $OtherDeductions + $row3['EmployeeContribution'];
					
					$query = "SELECT ID,Amount FROM advances where ID <> 0 AND Status = 0 AND IsCompleted = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					//echo $query; exit();
					$res = mysql_query($query) or die(mysql_error());
					$num_adv = mysql_num_rows($res);
					if($num_adv > 0)
					{
						while($row7 = mysql_fetch_array($res))
						{
							$OtherDeductions += $row7['Amount'];
							
							$query = "INSERT INTO payrolladvancedetails SET PayID = ".$PayID.", AdvID = ".$row7['ID'].",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].", PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
						}
					}
					
					$query = "UPDATE advances SET Status = 1, IsCompleted = 1 where ID <> 0 AND Status = 0 AND IsCompleted = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					mysql_query($query) or die(mysql_error());
					
					$query = "SELECT ls.ID,l.ID AS LID,ls.Amount,l.LoanType FROM loans_schedule ls LEFT JOIN loans l ON ls.LoanID = l.ID where l.ID <> 0 AND l.Status = 0 AND ls.Status = 0 AND l.EmpID = ".$row3["ID"]." AND ls.EmpID = ".$row3["ID"]." AND (ls.RepaymentDate BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					//echo $query; exit();
					$res = mysql_query($query) or die(mysql_error());
					$num_loan = mysql_num_rows($res);
					if($num_loan > 0)
					{
						while($row7 = mysql_fetch_array($res))
						{
							$OtherDeductions += $row7['Amount'];
							
							$query = "INSERT INTO payrollloandetails SET PayID = ".$PayID.", LoanID = ".$row7['LID'].",LoanScheduleID = ".$row7['ID'].",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Type = '".$row7['LoanType']."', PerformedBy = '" . $_SESSION["UserID"] . "'";
							mysql_query($query) or die(mysql_error());
							
							$query = "UPDATE loans SET RemainingAmount = (RemainingAmount - ".$row7['Amount'].") where ID = ".$row7['LID']."";
							mysql_query($query) or die(mysql_error());
						}
					}
					
					$query = "UPDATE loans_schedule SET Status = 1 where ID <> 0 AND Status = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$_REQUEST["PayrollFromDate"]."' AND '".$_REQUEST["PayrollToDate"]."')";
					mysql_query($query) or die(mysql_error());
					
					//-------------------------income tax working start-------------------------
					//------------------------------------------------------------------------
					//----------------------------------------------------------------------
					// INCOME TAX FORMULA
					//----------------------------------------------------------------------
					// 1) employeer contribution x 12
					// 2) employee contribution x 12
					// 3) annual bonus fix allowance
					// 4) gross salary
					// 5) gross + annual bonus fix allowance
					// 6) annual salary (5 X 12 in jul) (5 X 11 in aug (+ point 5 of jul))
					// 7) Bonus1 = (Gross)
					// 8) Bonus2 = (Gross)
					// 9) Encashment = (Gross/2)
					// 10) taxable salary for the year = 1+6+7+8+9
					// 11) exceed text amount formula (10)
					// 12) exceed text amount = 10 - 11
					// 13) text rate percentage formula (10)
					// 14) text rate amount formula (10)
					// 15) tax payable for the year = ((12 * 13) + 14)
					// 16) Exemption on Employer Contribution = (15/10)*(1+2)
					// 17) Net Tax (after relief) = 15 - 16
					// 18) Total Deducted tax of this year
					// 19) Remaining Tax = (17 - 18)
					// 20) Per Month Tax = (19 / 12 in jul) (19 / 11 in aug)
					//----------------------------------------------------------------------
					$Tax_Step1 = ($row3['EmployerContribution'] * 12);
					//-----------------
					$Tax_Step2 = ($row3['EmployeeContribution'] * 12);
					//-----------------
					$query = "SELECT Title,Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title = 'Annual Bonus Fix Allowance'";
					$res = mysql_query($query) or die(mysql_error());
					$num_withouttax_allowance = mysql_num_rows($res);
					if($num_withouttax_allowance > 0)
					{
						$row7 = mysql_fetch_array($res);
						$Type = $row7['Type'];
						if($Type == "FixedAmount")
						{
							$Tax_Step3 = $row7['Amount'];
						}
						else if($Type == "Percentage")
						{
							$Tax_Step3 = ($row7['Percentage'] / 100) * $BasicSalary;
						}
					}
					//-----------------
					$Tax_Step4 = $row3['Salary'];
					//-----------------
					$Tax_Step5 = ($Tax_Step3 + $Tax_Step4);
					//-----------------
					$m=strtotime($MonthPayroll);		
					$SalaryMonth=date("m", $m);
					$SalaryYear=date("Y", $m);
					$SalaryYear2 = ($SalaryYear - 1);
					
					if($SalaryMonth == 7)
					{
						$Tax_Step6 = ($Tax_Step5 * 12);
					}
					else if($SalaryMonth == 8)
					{
						$Tax_Step6 = ($Tax_Step5 * 11);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 9)
					{
						$Tax_Step6 = ($Tax_Step5 * 10);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 10)
					{
						$Tax_Step6 = ($Tax_Step5 * 9);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 11)
					{
						$Tax_Step6 = ($Tax_Step5 * 8);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."' OR p.MonthPayroll = 'Oct ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 12)
					{
						$Tax_Step6 = ($Tax_Step5 * 7);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."' OR p.MonthPayroll = 'Oct ".$SalaryYear."' OR p.MonthPayroll = 'Nov ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 1)
					{
						$Tax_Step6 = ($Tax_Step5 * 6);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 2)
					{
						$Tax_Step6 = ($Tax_Step5 * 5);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 3)
					{
						$Tax_Step6 = ($Tax_Step5 * 4);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 4)
					{
						$Tax_Step6 = ($Tax_Step5 * 3);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 5)
					{
						$Tax_Step6 = ($Tax_Step5 * 2);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."' OR p.MonthPayroll = 'Apr ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					else if($SalaryMonth == 6)
					{
						$Tax_Step6 = ($Tax_Step5 * 1);
						
						$query = "SELECT SUM(pd.Gross+pd.OtherAllowances) AS PreviousGross FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."' OR p.MonthPayroll = 'Apr ".$SalaryYear."' OR p.MonthPayroll = 'May ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_gross = mysql_num_rows($res);
						if($previous_gross > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step6 += $row7['PreviousGross'];
						}
					}
					//-----------------
					$Tax_Step7 = $Tax_Step4;
					//-----------------
					$Tax_Step8 = $Tax_Step4;
					//-----------------
					$Tax_Step9 = ($Tax_Step4 / 2);
					//-----------------
					$Tax_Step10 = ($Tax_Step1 + $Tax_Step6 + $Tax_Step7 + $Tax_Step8 + $Tax_Step9);
					//-----------------
					$Tax_Step11 = tax_exceed_amount($Tax_Step10);
					//-----------------
					$Tax_Step12 = ($Tax_Step10 - $Tax_Step11);
					//-----------------
					$Tax_Step13 = tax_rate_percentage($Tax_Step10);
					//-----------------
					$Tax_Step14 = tax_rate_amount($Tax_Step10);
					//-----------------
					$Tax_Step15 = (($Tax_Step12 * $Tax_Step13) + $Tax_Step14);
					//-----------------
					$Tax_Step16 = (($Tax_Step15/$Tax_Step10)*($Tax_Step1+$Tax_Step2));
					//-----------------
					$Tax_Step17 = ($Tax_Step15 - $Tax_Step16);
					//-----------------							
					$m=strtotime($MonthPayroll);		
					$SalaryMonth=date("m", $m);
					$SalaryYear=date("Y", $m);
					$SalaryYear2 = ($SalaryYear - 1);
					
					if($SalaryMonth == 7)
					{
						$Tax_Step18 = 0;
					}
					else if($SalaryMonth == 8)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 9)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 10)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 11)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."' OR p.MonthPayroll = 'Oct ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 12)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear."' OR p.MonthPayroll = 'Aug ".$SalaryYear."' OR p.MonthPayroll = 'Sep ".$SalaryYear."' OR p.MonthPayroll = 'Oct ".$SalaryYear."' OR p.MonthPayroll = 'Nov ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 1)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 2)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 3)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 4)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 5)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."' OR p.MonthPayroll = 'Apr ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					else if($SalaryMonth == 6)
					{
						$query = "SELECT SUM(pd.IncomeTax) AS PreviousTax FROM payroll p LEFT JOIN payrolldetails pd ON p.ID = pd.PayID where p.ID <> 0 AND pd.EmpID = ".$row3["ID"]." AND (p.MonthPayroll = 'Jul ".$SalaryYear2."' OR p.MonthPayroll = 'Aug ".$SalaryYear2."' OR p.MonthPayroll = 'Sep ".$SalaryYear2."' OR p.MonthPayroll = 'Oct ".$SalaryYear2."' OR p.MonthPayroll = 'Nov ".$SalaryYear2."' OR p.MonthPayroll = 'Dec ".$SalaryYear2."' OR p.MonthPayroll = 'Jan ".$SalaryYear."' OR p.MonthPayroll = 'Feb ".$SalaryYear."' OR p.MonthPayroll = 'Mar ".$SalaryYear."' OR p.MonthPayroll = 'Apr ".$SalaryYear."' OR p.MonthPayroll = 'May ".$SalaryYear."')";
						$res = mysql_query($query) or die(mysql_error());
						$previous_tax = mysql_num_rows($res);
						if($previous_tax > 0)
						{
							$row7 = mysql_fetch_array($res);
							$Tax_Step18 += $row7['PreviousTax'];
						}
					}
					//-----------------
					$Tax_Step19 = ($Tax_Step17 - $Tax_Step18);
					//-----------------
					$m=strtotime($MonthPayroll);		
					$SalaryMonth=date("m", $m);
					
					if($SalaryMonth == 7)
					{
						$Tax_Step20 = ($Tax_Step19 / 12);
					}
					else if($SalaryMonth == 8)
					{
						$Tax_Step20 = ($Tax_Step19 * 11);
					}
					else if($SalaryMonth == 9)
					{
						$Tax_Step20 = ($Tax_Step19 * 10);
					}
					else if($SalaryMonth == 10)
					{
						$Tax_Step20 = ($Tax_Step19 * 9);
					}
					else if($SalaryMonth == 11)
					{
						$Tax_Step20 = ($Tax_Step19 * 8);
					}
					else if($SalaryMonth == 12)
					{
						$Tax_Step20 = ($Tax_Step19 * 7);
					}
					else if($SalaryMonth == 1)
					{
						$Tax_Step20 = ($Tax_Step19 * 6);
					}
					else if($SalaryMonth == 2)
					{
						$Tax_Step20 = ($Tax_Step19 * 5);
					}
					else if($SalaryMonth == 3)
					{
						$Tax_Step20 = ($Tax_Step19 * 4);
					}
					else if($SalaryMonth == 4)
					{
						$Tax_Step20 = ($Tax_Step19 * 3);
					}
					else if($SalaryMonth == 5)
					{
						$Tax_Step20 = ($Tax_Step19 * 2);
					}
					else if($SalaryMonth == 6)
					{
						$Tax_Step20 = ($Tax_Step19 * 1);
					}
					
					$Tax_Step20 = round($Tax_Step20);
					
					if($Tax_Step13 > 0)
					{
						$query = "INSERT INTO payrolltaxes SET PayID = ".$PayID.",EmpID = ".$row3["ID"].",Amount = ".$Tax_Step20.", PerformedBy = '" . $_SESSION["UserID"] . "'";
						mysql_query($query) or die(mysql_error());
					}
					//----------------------------------------------------------------------
					//------------------------------------------------------------------------
					//--------------------------income tax working end-------------------------
					
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
						$query="UPDATE payrolldetails SET 
						PayID = '" . (int)$PayID . "',
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
						GrossOfDays = '" . round(($row3['Salary'] / $num_of_days) * ($TotalPresent + $TotalOffDays + $TotalLeaves - ($TotalLateEarliesDedDays + ($TotalHalfdays * 0.5))),2) . "',
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
						PerformedBy='".$_SESSION['UserID'] . "',
						DateModified=NOW(),
						Remarks = '' WHERE ID = ".$_REQUEST["PayrollID"]."";
						mysql_query($query) or die (mysql_error());
					}
					else
					{
						$query="UPDATE payrolldetails SET 
						PayID = '" . (int)$PayID . "',
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
						PerformedBy='".$_SESSION['UserID'] . "',
						DateModified=NOW(),
						Remarks = '' WHERE ID = ".$_REQUEST["PayrollID"]."";
						mysql_query($query) or die (mysql_error());
					}
					
						$OpeningLeave=0;
						$GrantLeave=0;
						$UtilizeLeave=0;
						$WriteOffLeave=0;
						$BalanceLeave=0;
						$AfterBalance=0;
						
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
						
						$Tax_Step1=0;
						$Tax_Step2=0;
						$Tax_Step3=0;
						$Tax_Step4=0;
						$Tax_Step5=0;
						$Tax_Step6=0;
						$Tax_Step7=0;
						$Tax_Step8=0;
						$Tax_Step9=0;
						$Tax_Step10=0;
						$Tax_Step11=0;
						$Tax_Step12=0;
						$Tax_Step13=0;
						$Tax_Step14=0;
						$Tax_Step15=0;
						$Tax_Step16=0;
						$Tax_Step17=0;
						$Tax_Step18=0;
						$Tax_Step19=0;
						$Tax_Step20=0;
				} 
			}
		}
	}

	$query="Update payrolldetails SET GrossOfDays = ROUND(GrossOfDays) Where ID = ".$_REQUEST["PayrollID"]."";
	mysql_query($query) or die (mysql_error());
	
	$query="Update payrolldetails SET NetPay = ROUND(GrossOfDays + WOvertimeA + LOvertimeA + OtherAllowances - OtherDeductions - IncomeTax) Where ID = ".$_REQUEST["PayrollID"]."";
	mysql_query($query) or die (mysql_error());
				
	$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b>Salary Successfully Updated.</b>
	</div>';
	redirect("SalarySheet.php?ID=".$ID);
}	
?>