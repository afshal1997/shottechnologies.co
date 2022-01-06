<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$ID=0;
$Month=0;
$Year=0;
$Employee=0;
$CreatedBy = $_SESSION["UserID"];
$BasicSalary = 0;
$BasicSalaryWithTaxableAllowances = 0;
$TaxApply="";
$Tax = 0;
$PFApply="";
$PF = 0;
$Bonus = 0;
$BonusPercent = 0;
$Allowance_Taxable = 0;
$Allowance_WithoutTax = 0;
$Allowance_Total = 0;
$Commissions = 0;
$Reimbursements = 0;
$Rewards = 0;
$Deductions = 0;
$OvertimesHours = 0;
$OvertimesPerHour = 0;
$Overtimes = 0;
$Loans = 0;
$Amount = 0;
$TotalAmount = 0;
$TotalInitialAmount = 0;
$CreatedDate = "";
$EmployeeFirstname = "";
$EmployeeLastname = "";
$Designation = "";
$Department = "";
$Salutation = "";
$EmpCode = "";
$CompanyName = "";
$BonusType = "";

$GazettedHolidays = "";
$ApprovedLeaves = "";
$WeekendsFound = "";
$Lates = 0;
$LeavesWithoutPay = 0;
$LateDeduction = 0;
$LeaveDeduction = 0;
$DeductionOnLates = "";
$NumOfLates = 0;
$LateDeductAmount = "";

$PaidLeaves = 0;
$LeaveEarning = 0;

if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);

	$query="SELECT EmpID,Month,Year,BasicSalary,TotalAmount,DATE_FORMAT(CreatedTime, '%D %b %Y') AS Created,Loans FROM payroll WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Salery Slip.</b>
		</div>';
		redirect("GeneratePayroll.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$Employee=$row["EmpID"];
		$Month=$row["Month"];
		$Year=$row["Year"];
		$BasicSalary=$row["BasicSalary"];
		$TotalInitialAmount=$row["TotalAmount"];
		$Loans=$row["Loans"];
		$CreatedDate=$row["Created"];
	}
	
	$query="SELECT EmpID,Salutation,FirstName,LastName,Designation,Department FROM employees WHERE  ID='" . (int)$Employee . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Employee or Employee Deleted.</b>
		</div>';
		redirect("GeneratePayroll.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$Salutation=$row["Salutation"];
		$EmployeeFirstname=$row["FirstName"];
		$EmployeeLastname=$row["LastName"];
		$Designation=$row["Designation"];
		$Department=$row["Department"];
		$EmpCode=$row["EmpID"];
	}

		
		$query = "SELECT Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND Taxable = 'Yes' AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_taxable_allowance = mysql_num_rows($res);
		if($num_taxable_allowance > 0)
		{
			while($row6 = mysql_fetch_array($res))
			{
				$Type = $row6['Type'];
				if($Type == "FixedAmount")
				{
					$Allowance_Taxable += $row6['Amount'];
				}
				else if($Type == "Percentage")
				{
					$Allowance_Taxable += ($row6['Percentage'] / 100) * $BasicSalary;
				}
			}
		}

		
		$BasicSalaryWithTaxableAllowances = $Allowance_Taxable + $BasicSalary;
		
		$query = "SELECT Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND Taxable = 'No' AND EmpID = ".$Employee."";
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
				}
				else if($Type == "Percentage")
				{
					$Allowance_WithoutTax += ($row7['Percentage'] / 100) * $BasicSalary;
				}
			}
		}
		
		$Allowance_Total = $Allowance_Taxable + $Allowance_WithoutTax;
		
		$query = "SELECT Tax,ProvidentFund,BonusType,CompanyName FROM organization_settings where ID <> 0";
		$res = mysql_query($query) or die(mysql_error());
		$num_organization = mysql_num_rows($res);
		if($num_organization == 1)
		{
			$row2 = mysql_fetch_array($res);
			$CompanyName = $row2['CompanyName'];
			$TaxApply = $row2['Tax'];
			$PFApply = $row2['ProvidentFund'];
			$BonusType = $row2['BonusType'];
		}
		
		if($TaxApply == "Yes")
		{
			$query = "SELECT Percentage FROM taxes where ID <> 0 AND Approved = 1";
			$res = mysql_query($query) or die(mysql_error());
			$num_tax = mysql_num_rows($res);
			if($num_tax == 1)
			{
				$row3 = mysql_fetch_array($res);
				$Tax = $row3['Percentage'];
				$Tax = ($Tax / 100) * $BasicSalaryWithTaxableAllowances;
			}
		}
		
		if($PFApply == "Yes")
		{
			$query = "SELECT Type,Amount,Percentage FROM provident_funds where ID <> 0 AND Approved = 1";
			$res = mysql_query($query) or die(mysql_error());
			$num_pf = mysql_num_rows($res);
			if($num_pf == 1)
			{
				$row4 = mysql_fetch_array($res);
				$Type = $row4['Type'];
				if($Type == "FixedAmount")
				{
					$PF = $row4['Amount'];
				}
				else if($Type == "Percentage")
				{
					$PF = ($row4['Percentage'] / 100) * $BasicSalary;
				}
			}
		}
		
		if($BonusType == "Fixed")
		{
			$query = "SELECT Percentage FROM anual_bonuses where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year."";
			$res = mysql_query($query) or die(mysql_error());
			$num_bonus = mysql_num_rows($res);
			if($num_bonus == 1)
			{
				$row5 = mysql_fetch_array($res);
				$BonusPercent = $row5['Percentage'];
				$Bonus = $row5['Percentage'];
				$Bonus = ($Bonus / 100) * $BasicSalary;
			}
		}
		else
		{
			$query = "SELECT Percentage FROM individual_bonuses where ID <> 0 AND EmpID = '".empCodeByID($Employee)."' AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year."";
			$res = mysql_query($query) or die(mysql_error());
			$num_bonus = mysql_num_rows($res);
			if($num_bonus == 1)
			{
				$row5 = mysql_fetch_array($res);
				$BonusPercent = $row5['Percentage'];
				$Bonus = $row5['Percentage'];
				$Bonus = ($Bonus / 100) * $BasicSalary;
			}
		}
		
		$query = "SELECT Amount FROM commissions where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_commissions = mysql_num_rows($res);
		if($num_commissions > 0)
		{
			while($row8 = mysql_fetch_array($res))
			{
				$Commissions += $row8['Amount'];
			}
		}
		
		$query = "SELECT Amount FROM reimbursements where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_reimbursements = mysql_num_rows($res);
		if($num_reimbursements > 0)
		{
			while($row9 = mysql_fetch_array($res))
			{
				$Reimbursements += $row9['Amount'];
			}
		}
		
		$query = "SELECT Amount FROM rewards where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_rewards = mysql_num_rows($res);
		if($num_rewards > 0)
		{
			while($row10 = mysql_fetch_array($res))
			{
				$Rewards += $row10['Amount'];
			}
		}
		
		$query = "SELECT Amount FROM deductions where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_deductions = mysql_num_rows($res);
		if($num_deductions > 0)
		{
			while($row11 = mysql_fetch_array($res))
			{
				$Deductions += $row11['Amount'];
			}
		}
		
		$query = "SELECT Hours FROM overtimes where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
		$res = mysql_query($query) or die(mysql_error());
		$num_overtimes = mysql_num_rows($res);
		if($num_overtimes > 0)
		{
			while($row12 = mysql_fetch_array($res))
			{
				$OvertimesHours += $row12['Hours'];
			}
			$OvertimesPerHour = overtime_amount_per_hour($OvertimesHours,$Month,$Year,$BasicSalary);
			$Overtimes = $OvertimesHours * $OvertimesPerHour;
		}
		
		$query = "SELECT Date FROM gazetted_holidays WHERE Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month."  AND DATE_FORMAT(Date, '%Y') = ".$Year."";
		$res = mysql_query($query) or die(mysql_error());
		$num_holidays = mysql_num_rows($res);
		if($num_holidays > 0)
		{
			while($row13 = mysql_fetch_array($res))
			{
				$GazettedHolidays .= ' AND LoginDate <> \''.$row13['Date'].'\'';
			}
		}
		
		$query = "SELECT LeaveDate FROM minus_leaves_quota WHERE EmpID = ".$Employee." AND DATE_FORMAT(LeaveDate, '%m') = ".$Month."  AND DATE_FORMAT(LeaveDate, '%Y') = ".$Year."";
		$res = mysql_query($query) or die(mysql_error());
		$num_approvedLeaves = mysql_num_rows($res);
		if($num_approvedLeaves > 0)
		{
			while($row14 = mysql_fetch_array($res))
			{
				$ApprovedLeaves .= ' AND LoginDate <> \''.$row14['LeaveDate'].'\'';
			}
		}
		
		$query = "SELECT WorkingDays FROM organization_settings where ID <> 0";
		$res = mysql_query($query) or die(mysql_error());
		$num_workingDays = mysql_num_rows($res);
		if($num_workingDays == 1)
		{
			$row15 = mysql_fetch_array($res);
			$WorkingDays = $row15['WorkingDays'];
			$WorkingDays2 = explode(',',$WorkingDays);
			
			$WeekDays = array('1', '2', '3', '4', '5', '6', '7');
			$Weekends = array_diff($WeekDays, $WorkingDays2);
			
			
			foreach ($Weekends as $wd) {
				$WeekendsFound .= ' AND DATE_FORMAT(LoginDate, \'%W\') <> \''.get_day_name($wd).'\'';
			}
		}
		
		
		$query = "SELECT DeductionOnLates,NumOfLates,LateDeductAmount FROM organization_settings where ID <> 0";
		$res = mysql_query($query) or die(mysql_error());
		$num_lateDeduct = mysql_num_rows($res);
		if($num_lateDeduct == 1)
		{
			$row16 = mysql_fetch_array($res);
			$DeductionOnLates = $row16['DeductionOnLates'];
			$NumOfLates = $row16['NumOfLates'];
			$LateDeductAmount = $row16['LateDeductAmount'];
		}
		
		$Gross_Salary = $Allowance_Total + $BasicSalary;
		
		if($DeductionOnLates == "Yes")
		{
			$query = "SELECT ID FROM user_login_history WHERE UserID = ".$Employee." AND DATE_FORMAT(LoginDate, '%m') = ".$Month."  AND DATE_FORMAT(LoginDate, '%Y') = ".$Year." ".$WeekendsFound." ".$GazettedHolidays." ".$ApprovedLeaves." AND Status='Late'";
			// echo $query;
				// exit();
			$res = mysql_query($query) or die(mysql_error());
			$num_lates = mysql_num_rows($res);
			if($num_lates > 0)
			{
				$Lates = $num_lates;
				$Leaves = 0;
				for($l=1;$l<=$Lates;$l++)
				{
					if($l%$NumOfLates == 0)
					{
						$Leaves += ($LateDeductAmount == 'Full Day Leave' ? 1 : 0.5);
					}
				}
				$Num_Of_Days_In_Month = days_in_month($Month, $Year);
				$PerDayAmount = $Gross_Salary / $Num_Of_Days_In_Month;
				$LateDeduction = $PerDayAmount * $Leaves;
				// echo $LateDeduction;
				// exit();
			}
		}
		

		$first_day_this_month = date(''.$Year.'-'.$Month.'-01'); 
		$last_day_this_month = date('Y-m-t', strtotime(''.get_month_name($Month).' 01, '.$Year.''));
		$TotalWorkingDaysThisMonth = number_of_working_days($first_day_this_month,$last_day_this_month,$Month,$Year,$Employee);
		$TotalWorkingDaysThisMonthWithoutWeekends = number_of_working_days_without_weekends($first_day_this_month,$last_day_this_month,$Month,$Year,$Employee);
		
		$query = "SELECT ID FROM user_login_history WHERE UserID = ".$Employee." AND DATE_FORMAT(LoginDate, '%m') = ".$Month."  AND DATE_FORMAT(LoginDate, '%Y') = ".$Year." ".$WeekendsFound." ".$GazettedHolidays." ".$ApprovedLeaves."";

			$res = mysql_query($query) or die(mysql_error());
			$num_officeCome = mysql_num_rows($res);
			if($num_officeCome > 0)
			{
				$OfficeCome = $num_officeCome;
				$LeavesWithoutPay = $TotalWorkingDaysThisMonth - $OfficeCome;
				// echo $LeavesWithoutPay;
				// exit();
				$Num_Of_Days_In_Month = days_in_month($Month, $Year);
				$PerDayAmount = $Gross_Salary / $Num_Of_Days_In_Month;
				$LeaveDeduction = $PerDayAmount * $LeavesWithoutPay;
				// echo $LeaveDeduction;
				// exit();
			}
			else
			{
				if($ApprovedLeaves == "")
				{
					$Num_Of_Days_In_Month = days_in_month($Month, $Year);
					$PerDayAmount = $Gross_Salary / $Num_Of_Days_In_Month;
					$LeaveDeduction = $PerDayAmount * $Num_Of_Days_In_Month;
				}
				else
				{
					$OfficeCome = $num_officeCome;
					$LeavesWithoutPay = $TotalWorkingDaysThisMonthWithoutWeekends - $OfficeCome;
					// echo $LeavesWithoutPay;
					// exit();
					$Num_Of_Days_In_Month = days_in_month($Month, $Year);
					$PerDayAmount = $Gross_Salary / $Num_Of_Days_In_Month;
					$LeaveDeduction = $PerDayAmount * $LeavesWithoutPay;
				}
				
			}
			
		
		$query = "SELECT Leaves FROM paid_leaves_quota WHERE EmpID = ".$Employee." AND DATE_FORMAT(MonthYear, '%m') = ".$Month."  AND DATE_FORMAT(MonthYear, '%Y') = ".$Year."";

			$res = mysql_query($query) or die(mysql_error());
			$num_PaidLeaves = mysql_num_rows($res);
			if($num_PaidLeaves == 1)
			{
				$row17 = mysql_fetch_array($res);
				$PaidLeaves = $row17['Leaves'];
				$Num_Of_Days_In_Month = days_in_month($Month, $Year);
				$PerDayAmount = $Gross_Salary / $Num_Of_Days_In_Month;
				$LeaveEarning = $PerDayAmount * $PaidLeaves;
			}
			
			
		
		//Formula Start//
		$Amount = $BasicSalary - ($Tax + $PF);
		$Amount = $Amount + $Bonus;
		$Amount = $Amount + ($Allowance_Total + $Overtimes + $Commissions + $Reimbursements + $Rewards + $LeaveEarning);
		$Amount = $Amount - $Deductions;
		$Amount = $Amount - $LateDeduction;
		$Amount = $Amount - $LeaveDeduction;
		$Amount = $Amount - $Loans;
		
		$TotalAmount = round($Amount);
		//Formula End//
		
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Salary Slip</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, AnualBonus-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
	
</script>
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
   <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Salary Slip
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="GeneratePayroll.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Salary Slip</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section style="overflow:hidden;" class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-money"></i> <?php echo $CompanyName; ?> (Salary Slip)
                                <small class="pull-right">Created Date: <?php echo $CreatedDate; ?></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><?php echo $Salutation.' '.$EmployeeFirstname.' '.$EmployeeLastname; ?></strong> (ID: <?php echo $EmpCode; ?>)<br>
                                <?php echo $Designation.' | '.$Department; ?><br>
                            </address>
                        </div><!-- /.col -->
						<div class="pull-right col-sm-4 invoice-col">
                            <address style="text-align:right">
								<h4><strong>Month: </strong><?php echo get_month_name($Month); ?> <strong>Year: </strong><?php echo $Year; ?></h4>
                            </address>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-6 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2"><h4>Earnings</h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="line-height:0.628571">Basic Salary</td>
                                        <td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.$BasicSalary; ?></td>
                                    </tr>
                                    
									<?php
									$query = "SELECT Title,Type,Amount,Percentage,Taxable FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$Employee."";
									$res = mysql_query($query) or die(mysql_error());
									$num = mysql_num_rows($res);
									if($num > 0)
									{
										while($row = mysql_fetch_array($res))
										{
											?>
												<tr>
												<td style="line-height:0.628571"><?php echo $row['Title'].($row['Taxable'] == "Yes" ? ' (Taxable)' : '') ?></td>
												<td style="line-height:0.628571"><?php echo ($row["Type"] == "FixedAmount" ? CURRENCY_SYMBOL.' '.dboutput($row["Amount"]) : dboutput($row["Percentage"]) . '% ('.CURRENCY_SYMBOL.' '.round(($row['Percentage'] / 100) * $BasicSalary,2).')') ; ?></td>
												</tr>
											<?php
										}
									}
									else
									{
										?>
												<tr>
												<td style="line-height:0.628571">Allowances</td>
												<td style="line-height:0.628571">-</td>
												</tr>
										<?php
									}
									?>
									
									<tr>
                                        <td style="line-height:0.628571">Overtimes</td>
                                        <td style="line-height:0.628571"><?php echo ($Overtimes != 0 ? CURRENCY_SYMBOL.' '.round($Overtimes).' ('.$OvertimesHours.' Hours this Month / '.CURRENCY_SYMBOL.' '.round($OvertimesPerHour,2).' per Hour)' : '-') ; ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Rewards</td>
                                        <td style="line-height:0.628571"><?php echo ($Rewards != 0 ? CURRENCY_SYMBOL.' '.$Rewards : '-') ; ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Commissions</td>
                                        <td style="line-height:0.628571"><?php echo ($Commissions != 0 ? CURRENCY_SYMBOL.' '.$Commissions : '-') ; ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Reimbursements</td>
                                        <td style="line-height:0.628571"><?php echo ($Reimbursements != 0 ? CURRENCY_SYMBOL.' '.$Reimbursements : '-') ; ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Bonus</td>
                                        <td style="line-height:0.628571"><?php echo ($BonusPercent != 0 ? $BonusPercent . '% ('.CURRENCY_SYMBOL.' '.($BonusPercent / 100) * $BasicSalary.')' : '-') ; ?></td>
                                    </tr>
									
									<?php
									if($PaidLeaves != 0)
									{
									?>
									<tr>
                                        <td style="line-height:0.628571">Paid Leaves</td>
                                        <td style="line-height:0.628571"><?php echo $PaidLeaves;?> Leaves (<?php echo ($LeaveEarning != 0 ? CURRENCY_SYMBOL.' '.round($LeaveEarning,2) : '-') ; ?>)</td>
                                    </tr>
									<?php
									}
									?>
										
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                   
                        <div class="col-xs-6 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2"><h4>Deductions</h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if($PFApply == "Yes")
									{
										$query = "SELECT Type,Amount,Percentage FROM provident_funds where ID <> 0 AND Approved = 1";
										$res = mysql_query($query) or die(mysql_error());
										$num = mysql_num_rows($res);
										if($num == 1)
										{
											$row = mysql_fetch_array($res);
											?>
												<tr>
												<td style="line-height:0.628571">Provident Fund</td>
												<td style="line-height:0.628571"><?php echo ($row["Type"] == "FixedAmount" ? CURRENCY_SYMBOL.' '.dboutput($row["Amount"]) : dboutput($row["Percentage"]) . '% ('.CURRENCY_SYMBOL.' '.round(($row['Percentage'] / 100) * $BasicSalary,2).')') ; ?></td>
												</tr>
											<?php
										}
										else
										{
											?>
												<tr>
												<td style="line-height:0.628571">Provident Fund</td>
												<td style="line-height:0.628571">-</td>
												</tr>
											<?php
										}
									}
									else
									{
										?>
											<tr>
											<td style="line-height:0.628571">Provident Fund</td>
											<td style="line-height:0.628571">-</td>
											</tr>
										<?php
									}
									?>
                                    <?php
									if($TaxApply == "Yes")
									{
										$query = "SELECT Percentage FROM taxes where ID <> 0 AND Approved = 1";
										$res = mysql_query($query) or die(mysql_error());
										$num = mysql_num_rows($res);
										if($num == 1)
										{
											$row = mysql_fetch_array($res);
											?>
												<tr>
												<td style="line-height:0.628571">Tax</td>
												<td style="line-height:0.628571"><?php echo dboutput($row["Percentage"]) . '%' ?> (<?php echo CURRENCY_SYMBOL.' '.$Tax; ?>) </td>
												</tr>
											<?php
										}
										else
										{
											?>
												<tr>
												<td style="line-height:0.628571">Tax</td>
												<td style="line-height:0.628571">-</td>
												</tr>
											<?php
										}
									}
									else
									{
										?>
											<tr>
											<td style="line-height:0.628571">Tax</td>
											<td style="line-height:0.628571">-</td>
											</tr>
										<?php
									}
									?>
									
									<tr>
                                        <td style="line-height:0.628571">Loans</td>
                                        <td style="line-height:0.628571"><?php echo ($Loans != 0 ? CURRENCY_SYMBOL.' '.$Loans : '-') ; ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Lates</td>
                                        <td style="line-height:0.628571"><?php echo ($Lates != 0 ? $Lates . ' Lates (' : '') ?><?php echo ($LateDeduction != 0 ? CURRENCY_SYMBOL.' '.round($LateDeduction,2) : '-') ; ?><?php echo ($Lates != 0 ? ')' : '') ?></td>
                                    </tr>
									
									<tr>
                                        <td style="line-height:0.628571">Leaves</td>
                                        <td style="line-height:0.628571"><?php echo ($LeavesWithoutPay != 0 ? $LeavesWithoutPay . ' Leaves (' : '') ?><?php echo ($LeaveDeduction != 0 ? CURRENCY_SYMBOL.' '.round($LeaveDeduction,2) : '-') ; ?><?php echo ($LeavesWithoutPay != 0 ? ')' : '') ?></td>
                                    </tr>
									
									
									<?php
									$query = "SELECT Amount,Title FROM deductions where ID <> 0 AND Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month." AND DATE_FORMAT(Date, '%Y') = ".$Year." AND EmpID = ".$Employee."";
									$res = mysql_query($query) or die(mysql_error());
									$num = mysql_num_rows($res);
									if($num > 0)
									{
										while($row = mysql_fetch_array($res))
										{
											?>
												<tr>
												<td style="line-height:0.628571"><?php echo $row['Title'];?></td>
												<td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.dboutput($row["Amount"]) ; ?></td>
												</tr>
											<?php
										}
									}
									else
									{
										?>
												<tr>
													<td style="line-height:0.628571">Other Deductions</td>
													<td style="line-height:0.628571">-</td>
												</tr>
										<?php
									}
									?>
									
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Payroll Summary:</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%;line-height:0.628571">Basic Salary:</th>
                                        <td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.$BasicSalary; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="line-height:0.628571">Total Earnings:</th>
                                        <td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.round(($BasicSalary + $Overtimes + $Commissions + $Allowance_Total + $Rewards + $Bonus + $Reimbursements + $LeaveEarning),2); ?></td>
                                    </tr>
                                    <tr>
                                        <th style="line-height:0.628571">Total Deductions:</th>
                                        <td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.round(($PF + $Tax + $Loans + $Deductions + $LateDeduction + $LeaveDeduction),2); ?></td>
                                    </tr>
                                    <tr>
                                        <th style="line-height:0.628571">Net Salary:</th>
                                        <td style="line-height:0.628571"><?php echo CURRENCY_SYMBOL.' '.round($TotalAmount).'.00'; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
					<div class="row">
                        <div style="text-align:center" class="col-xs-12">
						
                            <i>Auto Generated Report | Not Required Signature<?php
						if($TotalAmount != $TotalInitialAmount)
						{
							echo '<br>The Calculation is not Currect due to the data is changed or deleted | The Actual Net Salary is '.$TotalInitialAmount;
						}
						?></i>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- ./wrapper -->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->

</body>
</html>
