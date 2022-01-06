<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$msg2="";
$Month=0;
$Year=0;
$Employee=0;
$CreatedBy = $_SESSION["UserID"];
$BasicSalary = 0;
$BasicSalaryWithTaxableAllowances = 0;
$TaxApply="";
$Tax = 0;
$PFApply="";
$BonusType = "";
$PF = 0;
$Bonus = 0;
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
$LoansUpdate = 0;
$RemainingMonth = 0;
$Amount = 0;
$TotalAmount = 0;

$GazettedHolidays="";
$ApprovedLeaves="";
$WeekendsFound="";
$Lates = 0;
$LeavesWithoutPay = 0;
$LateDeduction = 0;
$LeaveDeduction = 0;
$DeductionOnLates = "";
$NumOfLates = 0;
$LateDeductAmount = "";

$PaidLeaves = 0;
$LeaveEarning = 0;

if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["Employee"]) && ctype_digit($_POST['Employee']))
		$Employee=trim($_POST["Employee"]);
	if(isset($_POST["Month"]) && ctype_digit($_POST['Month']))
		$Month=trim($_POST["Month"]);
	if(isset($_POST["Year"]) && ctype_digit($_POST['Year']))
		$Year=trim($_POST["Year"]);

			
		if($Employee == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please Select Employee.</b>
				</div>';
		}
		else if($Month == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please Select Month.</b>
				</div>';
		}
		else if($Year == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please Select Year.</b>
				</div>';
		}
		

	if($msg=="")
	{
		
		$query = "SELECT Amount AS BasicSalary FROM basicsalary where ID <> 0 AND EmpID = ".$Employee." AND Approved = 1";
		$res = mysql_query($query) or die(mysql_error());
		$num_basic = mysql_num_rows($res);
		if($num_basic == 1)
		{
		$row1 = mysql_fetch_array($res);
		$BasicSalary = $row1['BasicSalary'];
		}
		else
		{
			$msg2='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Basic Salary Not Found or Multiple Listed.</b>
				</div>';
		}
		
		$query = "SELECT ID FROM payroll where ID <> 0 AND EmpID = ".$Employee." AND Month = ".$Month." AND Year = ".$Year."";
		$res = mysql_query($query) or die(mysql_error());
		$num_payroll = mysql_num_rows($res);
		if($num_payroll != 0)
		{
			$msg2='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Payroll is already Generated of this Month.</b>
				</div>';
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
		
		$query = "SELECT Tax,ProvidentFund,BonusType FROM organization_settings where ID <> 0";
		$res = mysql_query($query) or die(mysql_error());
		$num_organization = mysql_num_rows($res);
		if($num_organization == 1)
		{
			$row2 = mysql_fetch_array($res);
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
		
		$query = "SELECT Amount,RepaymentMonths FROM loans where ID <> 0 AND Approved = 1 AND EmpID = ".$Employee." AND DATE_FORMAT(RepaymentDate, '%m') <= ".$Month." AND DATE_FORMAT(RepaymentDate, '%Y') <= ".$Year." AND RemainingMonths > 0";
		$res = mysql_query($query) or die(mysql_error());
		$num_loans = mysql_num_rows($res);
		if($num_loans > 0)
		{
			while($row18 = mysql_fetch_array($res))
			{
				$Loans += $row18['Amount'] / $row18['RepaymentMonths'];
			}
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
		
		
		
		if($msg2 == "")
		{
			if($Loans > 0)
			{
				$query = "SELECT ID,Amount,RepaymentMonths,RemainingMonths,RemainingAmount FROM loans where ID <> 0 AND Approved = 1 AND EmpID = ".$Employee." AND DATE_FORMAT(RepaymentDate, '%m') <= ".$Month." AND DATE_FORMAT(RepaymentDate, '%Y') <= ".$Year." AND RemainingMonths > 0";
				$res = mysql_query($query) or die(mysql_error());
				$num_loanss = mysql_num_rows($res);
				if($num_loanss > 0)
				{
					while($row18 = mysql_fetch_array($res))
					{
						$LoansUpdate = $row18['Amount'] / $row18['RepaymentMonths'];
						$RemainingMonth = $row18['RemainingMonths']-1;
						$RemainingAmount = $row18['RemainingAmount']-$LoansUpdate;
						
						$query="UPDATE loans SET 
								RemainingMonths = '" . (int)$RemainingMonth . "',
								RemainingAmount = '" . dbinput($RemainingAmount) . "'
								Where ID=".$row18['ID']."";
						mysql_query($query) or die (mysql_error());
					}
				}
			}
		
		$query="INSERT INTO payroll SET CreatedTime=NOW(),
				EmpID = '" . (int)$Employee . "',
				Month = '" . (int)$Month . "',
				Year = '" . (int)$Year . "',
				CreatedBy = '" . (int)$CreatedBy . "',
				BasicSalary = '" . dbinput($BasicSalary) . "',
				Loans = '" . dbinput($Loans) . "',
				TotalAmount = '" . dbinput($TotalAmount) . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Payroll has been Generated.</b>
		</div>';		
		
		redirect("GeneratePayroll.php");	
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Generate Payroll</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
<style>
#labelimp {
	background-color: #428BCA;
	padding: 4px;
	color:white;
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

				$prev="";
				$next="";
				$nav="";
				$rowsPerPage=31;
				$pageNum=1;
				
				$DFrom="";
				$DTo="";
				$DateFrom="";
				$DateTo="";
				
				$Keywords="";
				
				$SortField=2;
				$SortType="ASC";
					
				$_SORT_FIELDS = array("DateAdded");
				
				if(isset($_REQUEST["Keywords"]))
					$Keywords = trim($_REQUEST["Keywords"]);

				if(isset($_REQUEST["PageIndex"]) && ctype_digit(trim($_REQUEST["PageIndex"])))
					$pageNum=trim($_REQUEST["PageIndex"]);

				$offset = ($pageNum - 1) * $rowsPerPage;
				$limit=" Limit ".$offset.", ".$rowsPerPage;
				
				$query="SELECT d.ID,d.Month,d.Year,d.BasicSalary,d.TotalAmount,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(d.CreatedTime, '%D %b %Y <br> %r') AS Added
				FROM payroll d LEFT JOIN employees e ON d.EmpID = e.ID LEFT JOIN employees a ON d.CreatedBy = a.ID WHERE d.ID <>0 AND d.Year = YEAR(NOW()) ORDER BY d.Month DESC,e.Department ASC,e.Designation ASC,e.FirstName ASC,e.LastName ASC";
				
				
				$result = mysql_query ($query.$limit) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die("Could not select because: ".mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				if($maxRow > 0)
				{ 
					$maxPage = ceil($maxRow/$rowsPerPage);
					$nav  = '';
					if($maxPage>1)
					for($page = 1; $page <= $maxPage; $page++)
					{
						
					   if ($page == $pageNum)
						  $nav .= "&nbsp;<li class=\"active\"><a href='#'>$page</a></li >"; 
					   else
						  $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">$page</a> </li>";
					}
					
					if ($pageNum > 1)
					{
						$page  = $pageNum - 1;
						$prev  = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Previous</a> ";
						$first = "&nbsp;<a href=\"$self?PageIndex=1&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">First</a> ";
					} 
					else
					{
					   $prev  = ''; // we're on page one, don't print previous link
					   $first = '&nbsp;First'; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Next</a> ";
						$last = "&nbsp;<a href=\"$self?PageIndex=$maxPage&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Last Page</a> ";
					} 
					else
					{
					   $next = "";
					   $last = '&nbsp;Last'; // nor the last page link
					}
				}
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Generate Payroll <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Generate Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
			<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-2 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Payroll Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-4 col-xs-12">
							<div class="form-group">
							  <select name="Employee" id="Employee" class="form-control">
								<option value="0" >Select Employee</option>
								<?php
								 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY Department,Designation ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-2 col-xs-12">
                            <div class="form-group">
							  <select name="Month" id="Month" class="form-control">
								<option <?php echo ($Month == "" ? 'selected' : ''); ?> value="" >Select Month</option>
								<?php
								$i=1;
								foreach($_MONTHS as $months)
								{
								echo '<option '.($Month == $i ? 'selected' : '').' value="'.$i.'">'.$months.'</option>';
								$i++;
								} 
								?>
								</select>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-2 col-xs-12">
                           <div class="form-group">
							  <select name="Year" id="Year" class="form-control">
								<option <?php echo ($Year == 0 ? 'selected' : ''); ?> value="" >Select Year</option>
								<?php
								for($i = date('Y'); $i >= 2010; $i--)
								{
								echo '<option '.($i == $Year ? 'selected' : '').' value="'.$i.'">'.$i.'</option>';
								} 
								?>
								</select>
							</div> 
                        </div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Generate</button>
							  <input type="hidden" name="action" value="submit_form" />
							</div> 
                        </div><!-- ./col -->
					</form>
            </div><!-- /.row -->
            <div class="box-body table-responsive">
              <?php
			  	echo $msg;
				echo $msg2;
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
			
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Employee</th>
					  <th>ID / Code</th>
                      <th>Month</th>
					  <th>Year</th>
                      <th>Basic Salary</th>
					  <th>Net Salary</th>
					  <th>Created By</th>
					  <th>Time</th>
                      <th>Salary Slip</th>
					  <!--<th>Refresh Salary</th>-->
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
			?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Payroll listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
				?>
                    <tr>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo get_month_name(dboutput($row["Month"])); ?></td>
					  <td><?php echo dboutput($row["Year"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["BasicSalary"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["TotalAmount"]); ?></td>
					  <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td><a class="btn btn-success margin" href="SalarySlip.php?ID=<?php echo $row['ID']; ?>">View</a></td>
					 <!-- <td><button class="btn btn-info margin" type="button" onClick="">Refresh</button></td>-->
                    </tr>
                    <?php				
				}
			} 
		?>
                  </tbody>
                </table>
              </form>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <!--<div class="dataTables_info" id="example2_info"> Total <?php //echo $maxRow;?> entries </div>-->
              </div>
              <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php echo $prev;?> </li>
                    <?php
					echo $nav;
					?>
                    <li class="next"> <?php echo $next;?> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
  </aside>
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
