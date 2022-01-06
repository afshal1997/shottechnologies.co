<?php
	include('Common.php');
	
	$EmployeeID=0;
	$AllowThisAdvance = 0;
	$num_of_advances = 0;
	
	if(isset($_REQUEST["EmployeeID"]) && ctype_digit($_REQUEST["EmployeeID"]))
		$EmployeeID = trim($_REQUEST["EmployeeID"]);

	$query = "SELECT ID FROM advances where EmpID = ".$EmployeeID." AND Status = 0";
	$res = mysql_query($query) or die(mysql_error());
	$AllowThisAdvance = mysql_num_rows($res);
		
	$currentMonthYear = date("M Y");
	$num_of_advances = 0;
	for($a=1; $a<7; $a++)
	{
		
		$m=strtotime("-".$a." Months");		
		$currentMonthYear=date("M Y", $m);
		
		//echo $currentMonthYear.'---';
		
		$queryCompleted = "SELECT pd.ID FROM payroll p LEFT JOIN payrolladvancedetails pd ON p.ID = pd.PayID WHERE p.CompanyID = ".CompanyByEmployeeID($EmployeeID)." AND p.MonthPayroll = '".$currentMonthYear."' AND pd.EmpID = ".$EmployeeID." AND pd.Amount > 0";
		$resCompleted = mysql_query($queryCompleted) or die(mysql_error());
		$CompletedAdvances = mysql_num_rows($resCompleted);

		if($CompletedAdvances > 0)
		{
			$num_of_advances++;
		}
	}
	
	if($AllowThisAdvance > 0)
	{
		echo '<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Employee already take an advance.</b>
		</div>';
	}
	else if($num_of_advances > 2)
	{
		echo '<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>The eligibility criteria for apply an advance is less then six consecutive advances which has been completed.</b>
		</div>';
	}
	
	
?>