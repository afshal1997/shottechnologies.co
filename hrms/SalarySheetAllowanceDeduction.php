<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	
$num_of_days=0;
$CompanyID="";
$CompID=array();
$PayrollMonth="";
$CreatedDate="";
$Steps=0;

$_SESSION['state'] = "";


$TTBasic = 0;
$TTAllowance = 0;
$TTGross = 0;
$TTDaysGross = 0;
$TTOTH = 0;
$TTOTA = 0;
$TTOtherAllowance = 0;
$TTBonusAmount = 0;
$TTGrossPay = 0;
$TTOtherDeduction = 0;
$TTLoanAmount = 0;
$TTLoanAmountCar = 0;
$TTAdvanceAmount = 0;
$TTIOUAmount = 0;
$TTEmployeeContribution = 0;
$TTIncomeTax = 0;
$TTNetPay = 0;

$GTTBasic = 0;
$GTTAllowance = 0;
$GTTGross = 0;
$GTTDaysGross = 0;
$GTTOTH = 0;
$GTTOTA = 0;
$GTTOtherAllowance = 0;
$GTTBonusAmount = 0;
$GTTGrossPay = 0;
$GTTOtherDeduction = 0;
$GTTLoanAmount = 0;
$GTTLoanAmountCar = 0;
$GTTAdvanceAmount = 0;
$GTTIOUAmount = 0;
$GTTEmployeeContribution = 0;
$GTTIncomeTax = 0;
$GTTNetPay = 0;

$Step1ID=0;
$Step2ID=0;
$Step3ID=0;

$Step1Date="";
$Step2Date="";
$Step3Date="";


if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT Step1ID,Step2ID,Step3ID,DATE_FORMAT(Step1Date, '%D %b %Y') AS Step1Date,DATE_FORMAT(Step2Date, '%D %b %Y') AS Step2Date,DATE_FORMAT(Step3Date, '%D %b %Y') AS Step3Date,Steps,MonthPayroll,CompanyID,FromDate,ToDate,NumOfDays,DATE_FORMAT(DateAdded, '%D %b %Y') AS Created FROM payroll WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Salery Sheet.</b>
		</div>';
		redirect("Payrolls.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$num_of_days=$row["NumOfDays"];
		$CompanyID=$row["CompanyID"];
		$CompID=explode(',',$row["CompanyID"]);
		$PayrollMonth=$row["MonthPayroll"];
		$CreatedDate=$row["Created"];
		$Steps=$row["Steps"];
		$Step1ID=$row["Step1ID"];
		$Step2ID=$row["Step2ID"];
		$Step3ID=$row["Step3ID"];
		$Step1Date=$row["Step1Date"];
		$Step2Date=$row["Step2Date"];
		$Step3Date=$row["Step3Date"];
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Salary Report</title>
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
<style>
thead.table-fixed {
  width: 91%;
  position: fixed;
  top: 0px;
  z-index: 30;
  background: #fff;
  display: none;
}
</style>
<script>
$(window).scroll(function() {
	if ($(this).scrollTop()>300)
	{
		$('thead.table-fixed').fadeIn();
	}
	else
	{
		$('thead.table-fixed').fadeOut();
	}
});
$(window).load(function() {
	$("thead.table-fixed").width($("thead.table-alig").width());
	$("thead.table-fixed tr th").each(function (i){
       $(this).width($($("thead.table-alig tr th")[i]).width());
});
});
</script>
<script type="text/javascript" async="async" id="true" src="excel/views2.json"></script>
<script type="text/javascript" src="excel/300lo.json"></script>
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
      <h1> Salary Report<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Payrolls.php' : ''); ?>"><i class="fa fa-dashboard"></i> Payrolls</a></li>
        <li class="active">Salary Report</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
	<div class="box-footer no-print" style="text-align:right;">
				 <button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-download"></i> Download Excel</button>
            </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
			
					
                  
            
            <div class="box-body table-responsive">
              <?php
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
			
              <form id="frmPages"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>">
                <input type="hidden" id="ID" name="ID" value="<?php echo $ID; ?>" />
				<input type="hidden" id="action2" name="action2" value="" />
				<input type="hidden" id="action" name="action" value="" />
				<input type="hidden" id="AllnDed" name="AllnDed" value="" />
              
              <div id="tblExport">
				<h4 class="alig">Salary Report for the Month of <?php echo $PayrollMonth; ?></h4><hr>
              
                <table style="font-size:8px;" id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr>
                      <th rowspan="2">S#</th>
					  <th rowspan="2">Emp ID</th>
                      <th rowspan="2">Employee Name</th>
                      
                      <th colspan="4" style="text-align:center;font-size:17px;font-family:verdana;">Salary</th>
                    
                     <th colspan="4" style="text-align:center;font-size:17px;font-family:verdana;">Attendance</th>
                       <th rowspan="2">Gross Salary</th>
                     <th colspan="2" style="text-align:center;font-size:17px;font-family:verdana;">OverTime</th>
                   
                    
                             <th rowspan="2">Other Allowances</th>
							 
							 <th rowspan="2">Staff Bonus</th>
							 <th rowspan="2">Other Deductions</th>
                              <th rowspan="2">Salaries & Allowances</th>
                               
							   
							    <th rowspan="2">Vehicle Loan</th>
								<th rowspan="2">Staff Loan</th>
								<th rowspan="2">Advance Salary</th>
								<th rowspan="2">IOUS</th>
								<th rowspan="2">Employee Benefit Fund</th>
                                <th rowspan="2">Income Tax</th>
                                 <th rowspan="2">Net Pay</th>
                      </tr>
                     <tr>
                        <th rowspan="">Basic Salary</th>
                      <th rowspan="">Breakup Allowances</th>
                      <th rowspan="">Gross Salary</th>
                      <th rowspan="">Attd Days</th>
                      
                      
					  <th>Offdays / Holidays</th>
                      <th>Leaves</th>
					  <th>Leaves <br>WithOut <br>Pay</th>
                       <th>Total Days</th>
                       
                       
                     <th>OverTime Hours</th>
                       <th>OverTime Amount</th>
					   
					   
                       
					</tr>
                    
                    
                  </thead>
                  <thead class="alig table-fixed">
                    <tr>
                      <th rowspan="2">S#</th>
					  <th rowspan="2">Emp ID</th>
                      <th rowspan="2">Employee Name</th>
                      
                      <th colspan="4" style="text-align:center;font-size:17px;font-family:verdana;">Salary</th>
                    
                     <th colspan="4" style="text-align:center;font-size:17px;font-family:verdana;">Attendance</th>
                       <th rowspan="2">Gross Salary</th>
                     <th colspan="2" style="text-align:center;font-size:17px;font-family:verdana;">OverTime</th>
                   
                    
                             <th rowspan="2">Other Allowances</th>
							 
							 <th rowspan="2">Staff Bonus</th>
							 <th rowspan="2">Other Deductions</th>
                              <th rowspan="2">Salaries & Allowances</th>
                               
							   
							    <th rowspan="2">Vehicle Loan</th>
								<th rowspan="2">Staff Loan</th>
								<th rowspan="2">Advance Salary</th>
								<th rowspan="2">IOUS</th>
								<th rowspan="2">Employee Benefit Fund</th>
                                <th rowspan="2">Income Tax</th>
                                 <th rowspan="2">Net Pay</th>
                      </tr>
                     <tr>
                        <th rowspan="">Basic Salary</th>
                      <th rowspan="">Breakup Allowances</th>
                      <th rowspan="">Gross Salary</th>
                      <th rowspan="">Attd Days</th>
                      
                      
					  <th>Offdays / Holidays</th>
                      <th>Leaves</th>
					  <th>Leaves <br>WithOut <br>Pay</th>
                       <th>Total Days</th>
                       
                       
                     <th>OverTime Hours</th>
                       <th>OverTime Amount</th>
					   
					   
                       
					</tr>
                    
                    
                  </thead>
				  
                  <tbody>
                   
                    <tr>
               
                    <?php 
					foreach($CompID as $compid) 
					{
						$query = "SELECT Name FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
						$res = mysql_query($query) or die(mysql_error());
						$num = mysql_num_rows($res);
						if($num == 1)
						{
							$row = mysql_fetch_array($res);
					?>
                     <tr>
                      
					  <th colspan="25"><h4><?php echo $row['Name']; ?></h4></th>
                    </tr>
					 <?php 
					$query2 = "SELECT ID,Name FROM locations where ID <> 0 AND Status = 1 AND CompanyID = ".$compid." ORDER BY Name ASC";
					$res2 = mysql_query($query2) or die(mysql_error());
					$num2 = mysql_num_rows($res2);
					if($num2 > 0)
					{
						while($row2 = mysql_fetch_array($res2))
						{
					?>
                    <tr>
					  <th colspan="25"><h6><?php echo $row2['Name']; ?><h6></th>
                    </tr>
					<?php 
					$query3 = "SELECT ad.Amount AS AdvanceAmount,pral.Amount AS BonusAmount,SUM(prdl.Amount) AS IOUAmount,ec.EmployeeContribution AS EmployeeContribution,pl.Amount AS LoanAmount,plv.Amount AS LoanAmountCar,pr.FromDate,pr.ToDate,e.ID,p.ID AS PayrollID,e.EmpID,e.Designation,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.LEDeductions,p.GrossOfDays,p.AllowanceBreakup,p.BankorCash,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OvertimeHolidayDays,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID LEFT JOIN payrolladvancedetails ad ON pr.ID = ad.PayID AND ad.EmpID = e.ID LEFT JOIN payrollloandetails pl ON pr.ID = pl.PayID AND pl.EmpID = e.ID AND pl.Type='Staff Loan' LEFT JOIN payrollloandetails plv ON pr.ID = plv.PayID AND plv.EmpID = e.ID AND plv.Type='Vehicle Loan' LEFT JOIN payrollcontributiondetails ec ON pr.ID = ec.PayID AND ec.EmpID = e.ID LEFT JOIN payrollallowancedetails pral ON pr.ID = pral.PayID AND pral.EmpID = e.ID AND pral.Name = 'Annual Bonus Fix Allowance' LEFT JOIN payrolldeductiondetails prdl ON pr.ID = prdl.PayID AND prdl.EmpID = e.ID AND prdl.Name = 'IOUS' WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Location = ".$row2['ID']." AND p.PayID = ".$ID." GROUP BY e.ID ORDER BY e.FirstName ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$c = 1;
						while($row3 = mysql_fetch_array($res3))
						{
					?>
					<tr>
                    <th colspan=""><?php echo $c; ?></th>
                      <th><?php echo $row3['EmpID']; ?> - <?php echo $row3['BankorCash']; ?></th>
					  <th><?php echo $row3['FirstName'].' '.$row3['LastName']; ?> - <?php echo $row3['Designation']; ?> - <?php echo $row3['CNICNumber']; ?></th>
                       <th><?php echo number_format($row3['Basic']);$TTBasic += $row3['Basic'];  ?></th>
                      <th><?php echo number_format($row3['AllowanceBreakup']);$TTAllowance += $row3['AllowanceBreakup']; ?></th>
					  <th><?php echo number_format($row3['Gross']);$TTGross += $row3['Gross']; ?></th>
                      <th > D: <?php echo $row3['Present']; ?> - L/E: <?php echo $row3['Lates'] + $row3['Earlies']; ?> - H: <?php echo $row3['HalfDays']; ?>   </th>
                     <th><?php echo $row3['OffDays']; ?></th>
                      <th><?php echo $row3['Leaves']; ?></th>
					  <th><?php echo $row3['Absent']; ?> - L/E: <?php echo $row3['LEDeductions']; ?> - H: <?php echo $row3['HalfDays'] * 0.5; ?></th>
                       <th><?php echo $row3['TotalDays']; ?></th>
                     <th><?php echo number_format($row3['GrossOfDays']);$TTDaysGross += $row3['GrossOfDays']; ?></th>
                       <th><?php $TTOTH += $row3['WOvertimeH'] + $row3['LOvertimeH']; ?>
					   <?php //echo $row3['WOvertimeH'] + $row3['LOvertimeH'];$TTOTH += $row3['WOvertimeH'] + $row3['LOvertimeH']; ?>
					   W H: <?php echo $row3['WOvertimeH'];?>
					   -
					   H D: <?php echo $row3['OvertimeHolidayDays'];?>
					   -
					   H H: <?php echo $row3['LOvertimeH'];?>
					   </th>
                      <th>
					   W H: <?php echo $row3['WOvertimeA'];?>
					   -
					   H D: <?php echo $row3['LOvertimeA'];?>
					   -
					   Total: <?php echo number_format($row3['WOvertimeA'] + $row3['LOvertimeA']);$TTOTA += round($row3['WOvertimeA'] + $row3['LOvertimeA']); ?>
					  </th>
					  <th><?php echo number_format($row3['OtherAllowances'] - $row3['BonusAmount']);$TTOtherAllowance += ($row3['OtherAllowances'] - $row3['BonusAmount']); ?></th>
					  <th>
						<?php echo number_format($row3['BonusAmount']);$TTBonusAmount += $row3['BonusAmount'];?>
					  </th>
                    <th><?php echo number_format($row3['OtherDeductions'] - $row3['LoanAmount'] - $row3['LoanAmountCar'] - $row3['AdvanceAmount'] - $row3['IOUAmount'] - $row3['EmployeeContribution']);$TTOtherDeduction += ($row3['OtherDeductions'] - $row3['LoanAmount'] - $row3['LoanAmountCar'] - $row3['AdvanceAmount'] - $row3['IOUAmount'] - $row3['EmployeeContribution']); ?></th>
					<th><?php echo number_format($row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays'] - $row3['BonusAmount'] - ($row3['OtherDeductions'] - $row3['LoanAmount'] - $row3['LoanAmountCar'] - $row3['AdvanceAmount'] - $row3['IOUAmount'] - $row3['EmployeeContribution']));$TTGrossPay += ($row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays']- $row3['BonusAmount'] - ($row3['OtherDeductions'] - $row3['LoanAmount'] - $row3['LoanAmountCar'] - $row3['AdvanceAmount'] - $row3['IOUAmount'] - $row3['EmployeeContribution'])); ?></th>
					<th><?php echo number_format($row3['LoanAmountCar']);$TTLoanAmountCar += $row3['LoanAmountCar'];?></th>
					<th><?php echo number_format($row3['LoanAmount']);$TTLoanAmount += $row3['LoanAmount'];?></th>
					<th><?php echo number_format($row3['AdvanceAmount']);$TTAdvanceAmount += $row3['AdvanceAmount'];?></th>
					<th><?php echo number_format($row3['IOUAmount']);$TTIOUAmount += $row3['IOUAmount'];?></th>
					<th><?php echo number_format($row3['EmployeeContribution']);$TTEmployeeContribution += $row3['EmployeeContribution'];?></th>
                      <th><?php echo number_format($row3['IncomeTax']);$TTIncomeTax += $row3['IncomeTax']; ?></th>
                     <th><?php echo number_format($row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays'] - $row3['OtherDeductions'] - $row3['IncomeTax']);$TTNetPay += $row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays'] - $row3['OtherDeductions'] - $row3['IncomeTax']; ?></th>
                    </tr>
					
                     <?php
						$c++;
						}
					}
						if($num3 > 0)
						{
						?>
						<tr>
							<th colspan="2">Subtotal</th> 
							<th>Total ( <?php echo $c-1; ?> ) Employees</th>
							<th><?php echo number_format($TTBasic); $GTTBasic = $GTTBasic + $TTBasic;  ?></th>
							<th><?php echo number_format($TTAllowance); $GTTAllowance = $GTTAllowance + $TTAllowance;; ?></th>
							<th><?php echo number_format($TTGross); $GTTGross = $GTTGross + $TTGross; ?></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo number_format($TTDaysGross); $GTTDaysGross = $GTTDaysGross + $TTDaysGross; ?></th>
							<th><?php echo number_format($TTOTH); $GTTOTH = $GTTOTH + $TTOTH; ?></th>
							<th><?php echo number_format($TTOTA); $GTTOTA = $GTTOTA + $TTOTA; ?></th>
							<th><?php echo number_format($TTOtherAllowance); $GTTOtherAllowance = $GTTOtherAllowance + $TTOtherAllowance; ?></th>
							<th><?php echo number_format($TTBonusAmount); $GTTBonusAmount = $GTTBonusAmount + $TTBonusAmount; ?></th>
							<th><?php echo number_format($TTOtherDeduction); $GTTOtherDeduction = $GTTOtherDeduction + $TTOtherDeduction; ?></th>
							<th><?php echo number_format($TTGrossPay); $GTTGrossPay = $GTTGrossPay + $TTGrossPay; ?></th>
							<th><?php echo number_format($TTLoanAmountCar); $GTTLoanAmountCar = $GTTLoanAmountCar + $TTLoanAmountCar; ?></th>
							<th><?php echo number_format($TTLoanAmount); $GTTLoanAmount = $GTTLoanAmount + $TTLoanAmount; ?></th>
							<th><?php echo number_format($TTAdvanceAmount); $GTTAdvanceAmount = $GTTAdvanceAmount + $TTAdvanceAmount; ?></th>
							<th><?php echo number_format($TTIOUAmount); $GTTIOUAmount = $GTTIOUAmount + $TTIOUAmount; ?></th>
							<th><?php echo number_format($TTEmployeeContribution); $GTTEmployeeContribution = $GTTEmployeeContribution + $TTEmployeeContribution; ?></th>
							<th><?php echo number_format($TTIncomeTax); $GTTIncomeTax = $GTTIncomeTax + $TTIncomeTax; ?></th>
							<th><?php echo number_format($TTNetPay); $GTTNetPay =  $GTTNetPay + $TTNetPay; ?></th>
						</tr>  
						<?php
						}
						
						$TTBasic = 0;
						$TTAllowance = 0;
						$TTGross = 0;
						$TTDaysGross = 0;
						$TTOTH = 0;
						$TTOTA = 0;
						$TTOtherAllowance = 0;
						$TTBonusAmount = 0;
						$TTGrossPay = 0;
						$TTOtherDeduction = 0;
						$TTLoanAmountCar = 0;
						$TTLoanAmount = 0;
						$TTAdvanceAmount = 0;
						$TTIOUAmount = 0;
						$TTEmployeeContribution = 0;
						$TTIncomeTax = 0;
						$TTNetPay = 0;
						
						}
						}
						}
					}
					?>   
                   <tr>
							<th colspan="3">Grant Total</th> 
							<th><?php echo number_format($GTTBasic); ?></th>
							<th><?php echo number_format($GTTAllowance); ?></th>
							<th><?php echo number_format($GTTGross); ?></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo number_format($GTTDaysGross); ?></th>
							<th><?php echo number_format($GTTOTH); ?></th>
							<th><?php echo number_format($GTTOTA); ?></th>
							<th><?php echo number_format($GTTOtherAllowance); ?></th>
							<th><?php echo number_format($GTTBonusAmount); ?></th>
							<th><?php echo number_format($GTTOtherDeduction); ?></th>
							<th><?php echo number_format($GTTGrossPay); ?></th>
							<th><?php echo number_format($GTTLoanAmountCar); ?></th>
							<th><?php echo number_format($GTTLoanAmount); ?></th>
							<th><?php echo number_format($GTTAdvanceAmount); ?></th>
							<th><?php echo number_format($GTTIOUAmount); ?></th>
							<th><?php echo number_format($GTTEmployeeContribution); ?></th>
							<th><?php echo number_format($GTTIncomeTax); ?></th>
							<th><?php echo number_format($GTTNetPay); ?></th> 
						</tr>  
                    </tr>
                   
				
				
                  </tbody>
                </table>
                </br></br></br>
        <div class="row">        
        <div class="col-md-4 col-xs-4" style="text-align:center"><?php if($Steps > 0) { ?><img src="images/Step1.jpg" width="200" /><br><?php echo Payroll_Employee($Step1ID) ; ?><br><?php echo $Step1Date ; ?><?php } ?><hr><h4>H.R. Manager's Sign.</h4></div>
		<div class="col-md-4 col-xs-4" style="text-align:center"><?php if($Steps > 1) { ?><img src="images/Step2.png" width="200" /><br><?php echo Payroll_Employee($Step2ID) ; ?><br><?php echo $Step2Date ; ?><?php } ?><hr><h4>Accounts Manager's Sign.</h4></div>
		<div class="col-md-4 col-xs-4" style="text-align:center"><?php if($Steps > 2) { ?><img src="images/Step3.png" width="200" /><br><?php echo Payroll_Employee($Step3ID) ; ?><br><?php echo $Step3Date ; ?><?php } ?><hr><h4>Audit Manager's Sign.</h4></div>
        </div>
				</div>
              </form>
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
<script src="excel/jquery.min.js"></script>
<script src="excel/jquery.btechco.excelexport.js"></script>
<script src="excel/jquery.base64.js"></script>
<script src="excel/secure_download.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
            });
        });
    });
</script>
<!-- COMPOSE MESSAGE MODAL -->
        

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
