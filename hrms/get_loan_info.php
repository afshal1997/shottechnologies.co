<?php
	include('Common.php');
	
	$EmployeeID=0;
	$LoanType="";
	$AllowThisLoan = 0;
	$num_of_days = 365;
	
	if(isset($_REQUEST["EmployeeID"]) && ctype_digit($_REQUEST["EmployeeID"]))
		$EmployeeID = trim($_REQUEST["EmployeeID"]);
	
	if(isset($_REQUEST["LoanType"]))
		$LoanType = trim($_REQUEST["LoanType"]);
	
	$query = "SELECT ID FROM loans where EmpID = ".$EmployeeID." AND LoanType = '".$LoanType."' AND Status <> 1";
	$res = mysql_query($query) or die(mysql_error());
	$AllowThisLoan = mysql_num_rows($res);
		
	$queryCompleted = "SELECT DateCompleted FROM loans where EmpID = ".$EmployeeID." AND LoanType = '".$LoanType."' AND Status = 1 ORDER BY ID DESC Limit 1";
	$resCompleted = mysql_query($queryCompleted) or die(mysql_error());
	$CompletedLoans = mysql_num_rows($resCompleted);
	$num_of_days = 365;
	if($CompletedLoans == 1)
	{
		$rowCompleted = mysql_fetch_array($resCompleted);
		
		if($rowCompleted['DateCompleted'] == '0000-00-00')
		{
			$CompletedDate = date("Y-m-d");
		}
		else
		{
			$CompletedDate = $rowCompleted['DateCompleted'];
		}
		
		$TodaysDate = date("Y-m-d");
		
		$date1=date_create($CompletedDate);
		$date2=date_create($TodaysDate);
		$diff=date_diff($date1,$date2);
		$num_of_days = $diff->format("%a");
		$num_of_days = $num_of_days + 1;
		
	}
	
	if($AllowThisLoan > 0)
	{
		echo '<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Employee already take a '.$LoanType.'.</b>
		</div>';
	}
	else if($num_of_days < 365)
	{
		echo '<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>The eligibility criteria for '.$LoanType.' is one year which has not been completed. Last Completed Date is ('.date_format($date1,"d-M-Y").')</b>
		</div>';
	}
	
	
?>