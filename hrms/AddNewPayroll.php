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
	
	
	
	$e="";
	$f=array();
	$MonthPayroll="";
	$ToDate=date("Y-m-25");
	$d=strtotime("-1 Months");		
	$FromDate=date("Y-m-26", $d);
	
	
	$Payrollstartdate = "";
	$Payroll = array();
	$PayrollCompaniesArray = array();
	// $RosterString = "";
	
	$query="SELECT FromDate,NumOfDays,CompanyID FROM payroll WHERE ID <> 0 ORDER BY FromDate ASC";
	$result = mysql_query ($query) or die(mysql_error()); 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
		$Payrollstartdate=strtotime($row['FromDate']);
		for($i=0;$i<$row['NumOfDays'];$i++)
		{
			//$PayrollCompaniesArray[] = 
			$PayrollCompaniesArray[$Payrollstartdate][] = $row['CompanyID'];
			$Payroll[] = $Payrollstartdate;
			$Payrollstartdate = strtotime("+1 day", $Payrollstartdate);
		}
	}
	sort($Payroll);
	
	
	// $RosterString = implode(',',$Payroll);
	// echo '<pre>';
	// print_r($PayrollCompaniesArray);
	// echo '</pre>';
	// exit();
	
	// $FromDate="";
	// $ToDate="";
	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$CompanyID="";
	$CompID=array();
	$Remarks="";
	$PayrollMonth="";
	
		
	
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
		
		$e=strtotime($ToDate);		
		$MonthPayroll=date("M Y", $e);
	}

	
	if(isset($_POST["Remarks"]))
		$Remarks=trim($_POST["Remarks"]);
	if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}
	
	
	if($ToDate < $FromDate)
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Dates are not valid.</b>
		</div>';
	}
	else if($CompanyID == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Company.</b>
		</div>';
	}
	
	// $startdate=strtotime($FromDate);
	// for($i=0; $i<$num_of_days;$i++)
	// {
		// if(in_array(''.$startdate.'',$Payroll))
		// {
			// foreach($PayrollCompaniesArray as $x => $x_value) 
			// {	
				// if(in_array(''.$x.'',$Payroll))
				// {	
					// foreach($x_value as $xv) 
					// {	
						// $f = explode(',',$xv);
						// foreach($CompID as $cid) 
						// {
							// if(in_array(''.$cid.'',$f))
							// {
								// $msg='<div class="alert alert-danger alert-dismissable">
								// <i class="fa fa-ban"></i>
								// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								// <b>Date Already Generated.</b>
								// </div>';
							// }
						// }
						// $f=array();
					// }
				// }
			// }
		// }
	// $startdate = strtotime("+1 day", $startdate);
	// }
	
	
	if($msg=="")
	{
		
		$query="INSERT INTO payroll SET DateAdded=NOW(),
				MonthPayroll = '" . dbinput($MonthPayroll) . "',
				NumOfDays = '" . (int)$num_of_days . "',
				FromDate = '" . dbinput($FromDate) . "',
				ToDate = '" . dbinput($ToDate) . "',
				Remarks = '" . dbinput($Remarks) . "',
				CompanyID = '" . dbinput($CompanyID) . "',
				PerformedBy = '" . $_SESSION["UserID"] . "'";
		mysql_query($query) or die (mysql_error());
		$PayID = mysql_insert_id();
		
		foreach($CompID as $compid) 
		{
			
			$query = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				
				$query3 = "SELECT ID,Salary,AttendanceAllowance,AttAllAmount,ResignationAccepted,PayFullSalary,StopSalary,Bank,AccountNumber,EmployeeContribution,EmployerContribution,Designation,Department,CompanyID,Location FROM employees where ID <> 0 AND Status = 'Active' AND GetSalary = 'Yes' AND CompanyID = ".$compid." ORDER BY ID ASC";
				$res3 = mysql_query($query3) or die(mysql_error());
				$num3 = mysql_num_rows($res3);
				if($num3 > 0)
				{
					while($row3 = mysql_fetch_array($res3))
					{
						// $query4 = "SELECT ID,AnualLeaves,SickLeaves,CasualLeaves FROM current_leaves_quota where ID <> 0 AND EmpID = ".$row3['ID']."";
						// $res4 = mysql_query($query4) or die(mysql_error());
						// $num4 = mysql_num_rows($res4);
						// if($num4 == 1)
						// {
							// $row4 = mysql_fetch_array($res4);
							
							// $query5 = "SELECT ID FROM minus_leaves_quota where ID <> 0 AND (LeaveDate BETWEEN '".$FromDate."' AND '".date('Y-m-d')."') AND EmpID = ".$row3['ID']."";
							// $res5 = mysql_query($query5) or die(mysql_error());
							// $numnormal1 = mysql_num_rows($res5);
							
						// }
						
						$query2="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.ID AS EmployeeID,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,e.Salary,li.LateArrival,li.EarlyDepart,li.ScheduleDepart AS Depart,sh.Name AS ScheduleName,li.ScheduleArrival AS ScheduleArrivalTime,li.ScheduleDepart AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND e.GetSalary = 'Yes' AND (li.DateAdded BETWEEN '".$FromDate."' AND '".$ToDate."')  AND e.CompanyID = ".$compid." AND e.ID = ".$row3['ID']." ORDER BY e.EmpID ASC";
						
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
							
							$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 1 AND (ad.Date BETWEEN '".$FromDate."' AND '".$ToDate."')";
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
							
							$query = "SELECT ad.Amount,adt.Name FROM adjustments ad LEFT JOIN adjustmenttypes adt ON adt.ID = ad.Title where ad.ID <> 0 AND ad.Approved = 1 AND ad.EmpID = ".$row3["ID"]." AND adt.Type = 0 AND (ad.Date BETWEEN '".$FromDate."' AND '".$ToDate."')";
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
							
							$query = "SELECT ID,Amount FROM advances where ID <> 0 AND Status = 0 AND IsCompleted = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
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
									
									$query = "INSERT INTO payrollloandetails SET PayID = ".$PayID.", LoanID = ".$row7['LID'].",LoanScheduleID = ".$row7['ID'].",EmpID = ".$row3["ID"].",Amount = ".$row7['Amount'].",Type = '".$row7['LoanType']."', PerformedBy = '" . $_SESSION["UserID"] . "'";
									mysql_query($query) or die(mysql_error());
									
									$query = "UPDATE loans SET RemainingAmount = (RemainingAmount - ".$row7['Amount'].") where ID = ".$row7['LID']."";
									mysql_query($query) or die(mysql_error());
								}
							}
							
							$query = "UPDATE loans_schedule SET Status = 1 where ID <> 0 AND Status = 0 AND EmpID = ".$row3["ID"]." AND (RepaymentDate BETWEEN '".$FromDate."' AND '".$ToDate."')";
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
								$query="INSERT INTO payrolldetails SET 
								PayID = '" . (int)$PayID . "',
								EmpID = '" . (int)$row3["ID"] . "',
								CompanyID = '" . (int)$row3["CompanyID"] . "',
								Location = '" . (int)$row3["Location"] . "',
								Department = '" . dbinput($row3["Department"]) . "',
								Designation = '" . dbinput($row3["Designation"]) . "',
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
								Remarks = ''";
								mysql_query($query) or die (mysql_error());
							}
							else
							{
								$query="INSERT INTO payrolldetails SET 
								PayID = '" . (int)$PayID . "',
								EmpID = '" . (int)$row3["ID"] . "',
								CompanyID = '" . (int)$row3["CompanyID"] . "',
								Location = '" . (int)$row3["Location"] . "',
								Department = '" . dbinput($row3["Department"]) . "',
								Designation = '" . dbinput($row3["Designation"]) . "',
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
								Remarks = ''";
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
		}
		
		
		// $startdate=strtotime($FromDate);
		// for($i=0; $i<$num_of_days;$i++)
		// {
			//here execution code

			// $startdate = strtotime("+1 day", $startdate);
		// }
		
			$query="Update payrolldetails SET GrossOfDays = ROUND(GrossOfDays) Where PayID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
		
			$query="Update payrolldetails SET NetPay = ROUND(GrossOfDays + WOvertimeA + LOvertimeA + OtherAllowances - OtherDeductions - IncomeTax) Where PayID = ".$PayID."";
			mysql_query($query) or die (mysql_error());
			
			
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Payroll has been Generated.</b>
			</div>';
			
			redirect("AddNewPayroll.php");
	}

}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Add Payroll</title>
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
      <h1>Add Payroll</h1>
      <ol class="breadcrumb">
        <li><a href="Payrolls.php"><i class="fa fa-dashboard"></i>Payrolls</a></li>
        <li class="active">Add Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Generate</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Payrolls.php'">Cancel</button>
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
                <h3 class="box-title">Payroll Date</h3>
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
                <h3 class="box-title">Payroll Remarks</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Remarks">Remarks:</label>
				  <?php 
				echo '<textarea rows="5" maxlength="500" id="Remarks" name="Remarks" class="form-control">'.$Remarks.'</textarea>';
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
                <h3 class="box-title">Payroll Applicable</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
                  <label id="labelimp" for="CompanyID" >Company:<span class="requiredStar">*</span></label>
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