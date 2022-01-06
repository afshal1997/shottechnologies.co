<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$BonusID = 0;

	$BasicSalary = 0;
	
	$BonusAllowances = 0;
	$OtherDeductions = 0;
	
	$BankorCash = "";
	$AccountNum = "";
	
	$MonthBonus="";
	$BonusDate=date("Y-m-d");
	
	$BonusAmount = 0;
	$BonusAdjustAmount=0;
	$LoanBalance = 0;

	$JoiningDate = "";

	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$CompanyID="";
	$CompID=array();
	$Heading="";
	$Remarks="";
	
	$e="";
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{		
	
	if(isset($_POST["BonusDate"]))
	{
		$BonusDate=trim($_POST["BonusDate"]);
		$e=strtotime($BonusDate);		
		$MonthBonus=date("M Y", $e);
	}
	if(isset($_POST["Heading"]))
		$Heading=trim($_POST["Heading"]);
	if(isset($_POST["Remarks"]))
		$Remarks=trim($_POST["Remarks"]);
	if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}
	
	
	if($CompanyID == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Company.</b>
		</div>';
	}
	
	
	if($msg=="")
	{
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("START TRANSACTION");
		
		$query="INSERT INTO bonus SET DateAdded=NOW(),
				MonthBonus = '" . dbinput($MonthBonus) . "',
				BonusDate = '" . dbinput($BonusDate) . "',
				Heading = '" . dbinput($Heading) . "',
				Remarks = '" . dbinput($Remarks) . "',
				CompanyID = '" . dbinput($CompanyID) . "',
				PerformedBy = '" . $_SESSION["UserID"] . "'";
		mysql_query($query) or die (mysql_error());
		$BonusID = mysql_insert_id();
		
		foreach($CompID as $compid) 
		{
			
			$query = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				// echo $row['ID'];
				// exit();
				$query3 = "SELECT ID,Salary,ResignationAccepted,Bank,AccountNumber,JoiningDate FROM employees where ID <> 0 AND Status = 'Active' AND Bonus = 'Yes' AND ResignationAccepted = 'No' AND CompanyID = ".$compid." ORDER BY ID ASC";
				$res3 = mysql_query($query3) or die(mysql_error());
				$num3 = mysql_num_rows($res3);
				if($num3 > 0)
				{
					while($row3 = mysql_fetch_array($res3))
					{						

							
							$date1=date_create($row3['JoiningDate']);
							$date2=date_create($BonusDate);
							$diff=date_diff($date1,$date2);
							$num_of_days = $diff->format("%a");
							$num_of_days = $num_of_days + 1;
							
							
							if($row3['Bank'] != "")
							{
								$BankorCash = 'Bank';
							}
							else
							{
								$BankorCash = 'Cash';
							}
							
							$AccountNum = $row3['AccountNumber'];
						
							$query = "SELECT Amount AS BasicSalary FROM basicsalary where ID <> 0 AND EmpID = ".$row3["ID"]." AND Approved = 1";
							$res = mysql_query($query) or die(mysql_error());
							$num_basic = mysql_num_rows($res);
							if($num_basic == 1)
							{
							$row1 = mysql_fetch_array($res);
							$BasicSalary = $row1['BasicSalary'];
							}
							
							
							$query = "SELECT Title,Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title = 'Annual Bonus Fix Allowance'";
								
							$res = mysql_query($query) or die(mysql_error());
							$num_withouttax_allowance = mysql_num_rows($res);
							if($num_withouttax_allowance > 0)
							{
								$row7 = mysql_fetch_array($res);
								$Type = $row7['Type'];
								if($Type == "FixedAmount")
								{
									$BonusAllowances += $row7['Amount'];
								}
								else if($Type == "Percentage")
								{
									$BonusAllowances += ($row7['Percentage'] / 100) * $BasicSalary;
								}
							}
							
							
							if($num_of_days > 0 && $num_of_days <= 30)
							{
								if($row['BonusPloicy1'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy1'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer1'];
								}
								else if($row['BonusPloicy1'] == 'Gross')
								{
									if($row['BonusBaseOn1'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer1']);
									}
									else if($row['BonusBaseOn1'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  1);
									}
								}
								else if($row['BonusPloicy1'] == 'Basic')
								{
									if($row['BonusBaseOn1'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer1']);
									}
									else if($row['BonusBaseOn1'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  1);
									}
								}
								else if($row['BonusPloicy1'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn1'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer1']);
									}
									else if($row['BonusBaseOn1'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  1);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 31 && $num_of_days <= 60)
							{
								if($row['BonusPloicy2'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy2'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer2'];
								}
								else if($row['BonusPloicy2'] == 'Gross')
								{
									if($row['BonusBaseOn2'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer2']);
									}
									else if($row['BonusBaseOn2'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  2);
									}
								}
								else if($row['BonusPloicy2'] == 'Basic')
								{
									if($row['BonusBaseOn2'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer2']);
									}
									else if($row['BonusBaseOn2'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  2);
									}
								}
								else if($row['BonusPloicy2'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn2'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer2']);
									}
									else if($row['BonusBaseOn2'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  2);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 61 && $num_of_days <= 90)
							{
								if($row['BonusPloicy3'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy3'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer3'];
								}
								else if($row['BonusPloicy3'] == 'Gross')
								{
									if($row['BonusBaseOn3'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer3']);
									}
									else if($row['BonusBaseOn3'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  3);
									}
								}
								else if($row['BonusPloicy3'] == 'Basic')
								{
									if($row['BonusBaseOn3'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer3']);
									}
									else if($row['BonusBaseOn3'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  3);
									}
								}
								else if($row['BonusPloicy3'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn3'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer3']);
									}
									else if($row['BonusBaseOn3'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  3);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 91 && $num_of_days <= 120)
							{
								if($row['BonusPloicy4'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy4'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer4'];
								}
								else if($row['BonusPloicy4'] == 'Gross')
								{
									if($row['BonusBaseOn4'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer4']);
									}
									else if($row['BonusBaseOn4'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  4);
									}
								}
								else if($row['BonusPloicy4'] == 'Basic')
								{
									if($row['BonusBaseOn4'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer4']);
									}
									else if($row['BonusBaseOn4'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  4);
									}
								}
								else if($row['BonusPloicy4'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn4'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer4']);
									}
									else if($row['BonusBaseOn4'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  4);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 121 && $num_of_days <= 150)
							{
								if($row['BonusPloicy5'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy5'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer5'];
								}
								else if($row['BonusPloicy5'] == 'Gross')
								{
									if($row['BonusBaseOn5'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer5']);
									}
									else if($row['BonusBaseOn5'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  5);
									}
								}
								else if($row['BonusPloicy5'] == 'Basic')
								{
									if($row['BonusBaseOn5'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer5']);
									}
									else if($row['BonusBaseOn5'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  5);
									}
								}
								else if($row['BonusPloicy5'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn5'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer5']);
									}
									else if($row['BonusBaseOn5'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  5);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 151 && $num_of_days <= 180)
							{
								if($row['BonusPloicy6'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy6'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer6'];
								}
								else if($row['BonusPloicy6'] == 'Gross')
								{
									if($row['BonusBaseOn6'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer6']);
									}
									else if($row['BonusBaseOn6'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  6);
									}
								}
								else if($row['BonusPloicy6'] == 'Basic')
								{
									if($row['BonusBaseOn6'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer6']);
									}
									else if($row['BonusBaseOn6'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  6);
									}
								}
								else if($row['BonusPloicy6'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn6'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer6']);
									}
									else if($row['BonusBaseOn6'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  6);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 181 && $num_of_days <= 210)
							{
								if($row['BonusPloicy7'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy7'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer7'];
								}
								else if($row['BonusPloicy7'] == 'Gross')
								{
									if($row['BonusBaseOn7'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer7']);
									}
									else if($row['BonusBaseOn7'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  7);
									}
								}
								else if($row['BonusPloicy7'] == 'Basic')
								{
									if($row['BonusBaseOn7'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer7']);
									}
									else if($row['BonusBaseOn7'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  7);
									}
								}
								else if($row['BonusPloicy7'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn7'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer7']);
									}
									else if($row['BonusBaseOn7'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  7);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 211 && $num_of_days <= 240)
							{
								if($row['BonusPloicy8'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy8'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer8'];
								}
								else if($row['BonusPloicy8'] == 'Gross')
								{
									if($row['BonusBaseOn8'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer8']);
									}
									else if($row['BonusBaseOn8'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  8);
									}
								}
								else if($row['BonusPloicy8'] == 'Basic')
								{
									if($row['BonusBaseOn8'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer8']);
									}
									else if($row['BonusBaseOn8'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  8);
									}
								}
								else if($row['BonusPloicy8'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn8'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer8']);
									}
									else if($row['BonusBaseOn8'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  8);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 241 && $num_of_days <= 270)
							{
								if($row['BonusPloicy9'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy9'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer9'];
								}
								else if($row['BonusPloicy9'] == 'Gross')
								{
									if($row['BonusBaseOn9'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer9']);
									}
									else if($row['BonusBaseOn9'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  9);
									}
								}
								else if($row['BonusPloicy9'] == 'Basic')
								{
									if($row['BonusBaseOn9'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer9']);
									}
									else if($row['BonusBaseOn9'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  9);
									}
								}
								else if($row['BonusPloicy9'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn9'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer9']);
									}
									else if($row['BonusBaseOn9'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  9);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 271 && $num_of_days <= 300)
							{
								if($row['BonusPloicy10'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy10'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer10'];
								}
								else if($row['BonusPloicy10'] == 'Gross')
								{
									if($row['BonusBaseOn10'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer10']);
									}
									else if($row['BonusBaseOn10'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  10);
									}
								}
								else if($row['BonusPloicy10'] == 'Basic')
								{
									if($row['BonusBaseOn10'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer10']);
									}
									else if($row['BonusBaseOn10'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  10);
									}
								}
								else if($row['BonusPloicy10'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn10'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer10']);
									}
									else if($row['BonusBaseOn10'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  10);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 301 && $num_of_days <= 330)
							{
								if($row['BonusPloicy11'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy11'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer11'];
								}
								else if($row['BonusPloicy11'] == 'Gross')
								{
									if($row['BonusBaseOn11'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer11']);
									}
									else if($row['BonusBaseOn11'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  11);
									}
								}
								else if($row['BonusPloicy11'] == 'Basic')
								{
									if($row['BonusBaseOn11'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer11']);
									}
									else if($row['BonusBaseOn11'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  11);
									}
								}
								else if($row['BonusPloicy11'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn11'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer11']);
									}
									else if($row['BonusBaseOn11'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  11);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 331 && $num_of_days <= 365)
							{
								if($row['BonusPloicy12'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy12'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer1'];
								}
								else if($row['BonusPloicy12'] == 'Gross')
								{
									if($row['BonusBaseOn12'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer12']);
									}
									else if($row['BonusBaseOn12'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  12);
									}
								}
								else if($row['BonusPloicy12'] == 'Basic')
								{
									if($row['BonusBaseOn12'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer12']);
									}
									else if($row['BonusBaseOn12'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  12);
									}
								}
								else if($row['BonusPloicy12'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn12'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer12']);
									}
									else if($row['BonusBaseOn12'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  12);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							else if($num_of_days >= 366)
							{
								if($row['BonusPloicy13'] == 'None')
								{
									$BonusAmount = 0;
								}
								else if($row['BonusPloicy13'] == 'Fixed')
								{
									$BonusAmount = $row['BonusAmntPer13'];
								}
								else if($row['BonusPloicy13'] == 'Gross')
								{
									if($row['BonusBaseOn13'] == 'Percentage')
									{
										$BonusAmount = (($row3["Salary"] / 100) *  $row['BonusAmntPer13']);
									}
									else if($row['BonusBaseOn13'] == 'Monthly')
									{
										$BonusAmount = (($row3["Salary"] / 12) *  12);
									}
								}
								else if($row['BonusPloicy13'] == 'Basic')
								{
									if($row['BonusBaseOn13'] == 'Percentage')
									{
										$BonusAmount = (($BasicSalary / 100) *  $row['BonusAmntPer13']);
									}
									else if($row['BonusBaseOn13'] == 'Monthly')
									{
										$BonusAmount = (($BasicSalary / 12) *  12);
									}
								}
								else if($row['BonusPloicy13'] == 'GrossAnnual')
								{
									if($row['BonusBaseOn13'] == 'Percentage')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 100) *  $row['BonusAmntPer13']);
									}
									else if($row['BonusBaseOn13'] == 'Monthly')
									{
										$BonusAmount = ((($BonusAllowances + $row3["Salary"]) / 12) *  12);
									}
								}
								else
								{
									$BonusAmount = 0;
								}
							}
							
							$BonusAmount = round($BonusAmount); //extra line
							
							$BonusAdjustAmount = (($BonusAmount / 100) * $row['LoanDeductionPercent']);
							
							$BonusAdjustAmount = round($BonusAdjustAmount); //extra line

							$query4="SELECT SUM(RemainingAmount) AS LoanBalance FROM loans WHERE ID <>0 AND EmpID='" . (int)$row3['ID'] . "' AND Status = 0";
							$res4 = mysql_query($query4) or die(mysql_error());
							$num4 = mysql_num_rows($res4);
							if($num4 > 0)
							{
								$row4 = mysql_fetch_array($res4);
								$LoanBalance = $row4['LoanBalance'];
							}
							
							$LoanBalance = round($LoanBalance); // extra line
							
							if($LoanBalance == 0)
							{
								$OtherDeductions = 0;
							}
							else if($LoanBalance >= $BonusAdjustAmount)
							{
								$OtherDeductions = $BonusAdjustAmount;
							}
							else if($LoanBalance <= $BonusAdjustAmount)
							{
								$OtherDeductions = $LoanBalance;
							}
							
							$query="INSERT INTO bonusdetails SET 
							BonusID = '" . (int)$BonusID . "',
							EmpID = '" . (int)$row3["ID"] . "',
							Basic = '" . dbinput($BasicSalary) . "',
							Gross = '" . dbinput($row3["Salary"]) . "',
							TotalDays = '" . (int)$num_of_days . "',
							JoiningDate = '" . dbinput($row3["JoiningDate"]) . "',
							OtherAllowances = '" . $BonusAllowances . "',
							OtherDeductions = '" . $OtherDeductions . "',
							LoanBalance = '" . $LoanBalance . "',
							BonusAmount = '" . $BonusAmount . "',
							BankorCash = '" . dbinput($BankorCash) . "',
							AccountNum = '" . dbinput($AccountNum) . "',
							NetPay = '" . ($BonusAmount - $OtherDeductions) . "',
							PerformedBy='".$_SESSION['UserID'] . "',
							DateModified=NOW(),
							Remarks = ''";
							mysql_query($query) or die (mysql_error());
							
							
								$BasicSalary = 0;
								$BonusAllowances = 0;
								$OtherDeductions = 0;
								$BankorCash = "";
								$AccountNum = "";
								$num_of_days=0;
								$BonusAmount = 0;
								$LoanBalance = 0;
								$BonusAdjustAmount = 0;
					}
				}
			}			
		}
		
		mysql_query("COMMIT");
			
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Bonus has been Generated.</b>
		</div>';
		
		redirect("AddNewBonus.php");
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Bonus</title>
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
      <h1>Add Bonus</h1>
      <ol class="breadcrumb">
        <li><a href="Bonus.php"><i class="fa fa-dashboard"></i>Bonus</a></li>
        <li class="active">Add Bonus</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Generate</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Bonus.php'">Cancel</button>
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
                <h3 class="box-title">Bonus Date</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="BonusDate">Bonus Date:</label>
				  <input autofocus type="date" name="BonusDate" value="<?php echo $BonusDate; ?>" class="form-control" />
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
                <h3 class="box-title">Bonus Remarks</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Heading">Heading:</label>
				  <?php 
				echo '<input type="text" maxlength="500" id="Heading" name="Heading" class="form-control" value="'.$Heading.'">';
				?>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Remarks">Remarks:</label>
				  <?php 
				echo '<textarea rows="2" maxlength="500" id="Remarks" name="Remarks" class="form-control">'.$Remarks.'</textarea>';
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
                <h3 class="box-title">Bonus Applicable</h3>
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