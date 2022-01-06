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
$TTGrossPay = 0;
$TTOtherDeduction = 0;
$TTIncomeTax = 0;
$TTNetPay = 0;

$GTTBasic = 0;
$GTTAllowance = 0;
$GTTGross = 0;
$GTTDaysGross = 0;
$GTTOTH = 0;
$GTTOTA = 0;
$GTTOtherAllowance = 0;
$GTTGrossPay = 0;
$GTTOtherDeduction = 0;
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
<title>Salary Sheet</title>
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
.alig {
	text-align:center;
	color:#303;
	font-family:Georgia, "Times New Roman", Times, serif;
	}
	.abc{
		size:58px;
		
		}
		floa {padding-left:100px;}
		pre1 {padding-left:30px;}
		.flo {margin-left:100px}
		
		.flo1 {margin-left:100px}

.frontForced
{
	z-index:999999;
	margin-top:0px;
}
		
</style>
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
      <h1> Salary Sheet<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Payrolls.php' : ''); ?>"><i class="fa fa-dashboard"></i> Payrolls</a></li>
        <li class="active">Salary Sheet</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
	<div class="box-footer no-print" style="text-align:right;">
				 <a href="SalarySheetAllowanceDeduction.php?ID=<?php echo $ID; ?>" class="btn btn-primary margin no-print">Allowances and Deductions</a>
				 <button class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
				 <a href="SalarySheetExcel.php?ID=<?php echo $ID; ?>" class="btn btn-primary margin no-print">Excel Sheet</a>
				 <?php 
				 if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){
				 if($Steps == 0){ 
				 ?>
				 <a class="btn btn-success margin" href="HROkay.php?ID=<?php echo $ID; ?>">Submit to Accounts <i class="fa fa-arrow-right"></i></a>
				 <?php }
				 }				 
				 if($_SESSION['RoleID'] == 'Accounts'){
				 if($Steps == 1){
				 ?>
				 <a class="btn btn-danger margin" href="HRBack.php?ID=<?php echo $ID; ?>"><i class="fa fa-arrow-left"></i> Back to HR</a>
				 <a class="btn btn-success margin" href="AccountsOkay.php?ID=<?php echo $ID; ?>">Submit to Audit <i class="fa fa-arrow-right"></i></a>
				 <?php } 
				 }
				 if($_SESSION['RoleID'] == 'Audit'){
				 if($Steps == 2){
				 ?>
				 <a class="btn btn-danger margin" href="HRBack.php?ID=<?php echo $ID; ?>"><i class="fa fa-arrow-left"></i> Back to HR</a>
				 <a class="btn btn-success margin" href="AuditOkay.php?ID=<?php echo $ID; ?>">Successfully Audit <i class="fa fa-arrow-right"></i></a>
				 <?php 
				 } 
				 }
				 ?>
            </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
			
					
                  
            
            <div class="box-body table-responsive" style="padding: 5px;">
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
				<h4 class="alig">Salary Sheet for the Month of <?php echo $PayrollMonth; ?> (<?php echo $num_of_days; ?> Days Salary)</h4><hr>
              
                <table style="font-size:8px;" id="dataTable" class="table table-bordered invoice table-fix" style="background-color:white">
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
                              <th rowspan="2">Gross Payment</th>
                               <th rowspan="2">Other Deductions</th>
                                <th rowspan="2">Income Tax</th>
                                 <th rowspan="2">Net Pay</th>
								 <th class="no-print" rowspan="2"></th>
								 <th class="no-print" rowspan="2"></th>
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
					$query3 = "SELECT pr.FromDate,pr.ToDate,e.ID,p.ID AS PayrollID,e.EmpID,e.Designation,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.LEDeductions,p.NetPay,p.GrossOfDays,p.AllowanceBreakup,p.BankorCash,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OvertimeHolidayDays,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Location = ".$row2['ID']." AND p.PayID = ".$ID." ORDER BY e.ID ASC";
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
                      <th><?php echo $row3['EmpID']; ?><br><?php echo $row3['BankorCash']; ?></th>
					  <th><?php echo $row3['FirstName'].' '.$row3['LastName']; ?><br><?php echo $row3['Designation']; ?><br><br><?php echo $row3['CNICNumber']; ?></th>
                       <th><?php echo $row3['Basic'];$TTBasic += $row3['Basic'];  ?></th>
                      <th><?php echo $row3['AllowanceBreakup'];$TTAllowance += $row3['AllowanceBreakup']; ?></th>
					  <th><?php echo $row3['Gross'];$TTGross += $row3['Gross']; ?></th>
                      <th > D: <?php echo $row3['Present']; ?> <br>L/E: <?php echo $row3['Lates'] + $row3['Earlies']; ?> <br>H: <?php echo $row3['HalfDays']; ?>   </th>
                     <th><?php echo $row3['OffDays']; ?></th>
                      <th><?php echo $row3['Leaves']; ?></th>
					  <th><?php echo $row3['Absent']; ?><br>L/E: <?php echo $row3['LEDeductions']; ?> <br>H: <?php echo $row3['HalfDays'] * 0.5; ?></th>
                       <th><?php echo $row3['TotalDays']; ?><br><span class="no-print"><a <?php echo ($Steps != 0 ? 'disabled' : ''); ?> <?php echo (($_SESSION['RoleID'] == 'Accounts' OR $_SESSION['RoleID'] == 'Audit') ? 'disabled' : ''); ?> href="PayrollDaysAdjustment.php?ID=<?php echo $ID; ?>&PayrollEmpID=<?php echo $row3['ID']; ?>&PayrollFromDate=<?php echo $row3['FromDate']; ?>&PerDayGross=<?php echo round($row3['Gross']/$num_of_days); ?>" class="btn btn-info no-print"><i class="fa fa-money no-print"></i></a></span></th>
                     <th><?php echo $row3['GrossOfDays'];$TTDaysGross += $row3['GrossOfDays']; ?></th>
                       <th><?php $TTOTH += $row3['WOvertimeH'] + $row3['LOvertimeH']; ?>
					   <?php //echo $row3['WOvertimeH'] + $row3['LOvertimeH'];$TTOTH += $row3['WOvertimeH'] + $row3['LOvertimeH']; ?>
					   W H: <?php echo $row3['WOvertimeH'];?>
					   <br>
					   H D: <?php echo $row3['OvertimeHolidayDays'];?>
					   <br>
					   H H: <?php echo $row3['LOvertimeH'];?>
					   </th>
                      <th>
					   W H: <?php echo $row3['WOvertimeA'];?>
					   <br>
					   H D: <?php echo $row3['LOvertimeA'];?>
					   <br>____________
					   Total: <?php echo round($row3['WOvertimeA'] + $row3['LOvertimeA']);$TTOTA += round($row3['WOvertimeA'] + $row3['LOvertimeA']); ?>
					  </th>
					  <th><?php echo $row3['OtherAllowances'];$TTOtherAllowance += $row3['OtherAllowances']; ?></th>
                      <th><?php echo $row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays'];$TTGrossPay += $row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays']; ?></th>
                    <th><?php echo $row3['OtherDeductions'];$TTOtherDeduction += $row3['OtherDeductions']; ?></th>
                      <th><?php echo $row3['IncomeTax'];$TTIncomeTax += $row3['IncomeTax']; ?></th>
                     <th><?php echo number_format($row3['NetPay']);$TTNetPay += $row3['NetPay']; ?></th>
					<th class="no-print"><?php if($row3['OtherAllowances'] > 0 || $row3['OtherDeductions'] > 0){ ?><a data-toggle="modal" data-target="#compose-modal<?php echo $row3['ID'] ?>" href="" class="btn btn-warning" title="Allowances and Deductions"><i class="fa fa-eye"></i></a><?php } ?></th>
					 <th class="no-print"><a <?php echo ($Steps != 0 ? 'disabled' : ''); ?> <?php echo (($_SESSION['RoleID'] == 'Accounts' OR $_SESSION['RoleID'] == 'Audit') ? 'disabled' : ''); ?> href="UpdateSalarySheet.php?ID=<?php echo $ID; ?>&PayrollID=<?php echo $row3['PayrollID']; ?>&PayrollCompanyID=<?php echo $row3['CompanyID']; ?>&PayrollEmpID=<?php echo $row3['ID']; ?>&PayrollFromDate=<?php echo $row3['FromDate']; ?>&PayrollToDate=<?php echo $row3['ToDate']; ?>&NumOfDays=<?php echo $num_of_days; ?>" class="btn btn-success"><i class="fa fa-refresh"></i></a></th>
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
							<th><?php echo $TTBasic; $GTTBasic = $GTTBasic + $TTBasic;  ?></th>
							<th><?php echo $TTAllowance; $GTTAllowance = $GTTAllowance + $TTAllowance;; ?></th>
							<th><?php echo $TTGross; $GTTGross = $GTTGross + $TTGross; ?></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $TTDaysGross; $GTTDaysGross = $GTTDaysGross + $TTDaysGross; ?></th>
							<th><?php echo $TTOTH; $GTTOTH = $GTTOTH + $TTOTH; ?></th>
							<th><?php echo $TTOTA; $GTTOTA = $GTTOTA + $TTOTA; ?></th>
							<th><?php echo $TTOtherAllowance; $GTTOtherAllowance = $GTTOtherAllowance + $TTOtherAllowance; ?></th>
							<th><?php echo $TTGrossPay; $GTTGrossPay = $GTTGrossPay + $TTGrossPay; ?></th>
							<th><?php echo $TTOtherDeduction; $GTTOtherDeduction = $GTTOtherDeduction + $TTOtherDeduction; ?></th>
							<th><?php echo $TTIncomeTax; $GTTIncomeTax = $GTTIncomeTax + $TTIncomeTax; ?></th>
							<th><?php echo number_format($TTNetPay); $GTTNetPay =  $GTTNetPay + $TTNetPay; ?></th> 
							<th></th>
							<th></th>
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
						$TTGrossPay = 0;
						$TTOtherDeduction = 0;
						$TTIncomeTax = 0;
						$TTNetPay = 0;
						
						}
						}
						}
					}
					?>   
                   <tr>
							<th colspan="3">Grant Total</th> 
							<th><?php echo $GTTBasic; ?></th>
							<th><?php echo $GTTAllowance; ?></th>
							<th><?php echo $GTTGross; ?></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $GTTDaysGross; ?></th>
							<th><?php echo $GTTOTH; ?></th>
							<th><?php echo $GTTOTA; ?></th>
							<th><?php echo $GTTOtherAllowance; ?></th>
							<th><?php echo $GTTGrossPay; ?></th>
							<th><?php echo $GTTOtherDeduction; ?></th>
							<th><?php echo $GTTIncomeTax; ?></th>
							<th><?php echo number_format($GTTNetPay); ?></th> 
							<th></th>
							<th></th>
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
                    
					 <?php 
					$query2 = "SELECT ID,Name FROM locations where ID <> 0 AND Status = 1 AND CompanyID = ".$compid." ORDER BY Name ASC";
					$res2 = mysql_query($query2) or die(mysql_error());
					$num2 = mysql_num_rows($res2);
					if($num2 > 0)
					{
						while($row2 = mysql_fetch_array($res2))
						{
					?>
                    
					<?php 
					$query3 = "SELECT e.ID,e.EmpID,e.FirstName,e.LastName,p.Basic,p.LEDeductions,p.GrossOfDays,p.AllowanceBreakup,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Location = ".$row2['ID']." AND p.PayID = ".$ID." ORDER BY e.ID ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$c = 1;
						while($row3 = mysql_fetch_array($res3))
						{
					?>
					<div class="modal fade" id="compose-modal<?php echo $row3['ID'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title"><i class="fa fa-money"></i> Allowances and Deductions Detail | <?php echo $row3['FirstName'].' '.$row3['LastName']; ?></h4>
								</div>
								<div class="modal-body">
									<table id="dataTable" class="table table-bordered" style="color:black">
										
										<tr>
										  <td><b>Allowances</b></th>
										  <td><b>Type</b></th>
										  <td><b>Amount</b></th>
										</tr>
										
										<tbody>
										<?php 
										$query4 = "SELECT Name,Type,Amount FROM payrollallowancedetails where ID <> 0 AND PayID = ".$ID." AND EmpID = ".$row3['ID']." ORDER BY Name ASC";
										$res4 = mysql_query($query4) or die(mysql_error());
										$num4 = mysql_num_rows($res4);
										if($num4 > 0)
										{
											while($row4 = mysql_fetch_array($res4))
											{
										?>
										<tr>
										  <td><?php echo $row4['Name']; ?></td>
										  <td><?php echo $row4['Type']; ?></td>
										  <td><?php echo $row4['Amount']; ?></td>
										</tr>
										<?php
											}
										}
										?>
										</tbody>
										<tr>
										  <td colspan="2"><b>Allowances Total</b></td>
										  <td><b><?php echo $row3['OtherAllowances']; ?></b></td>
										</tr>
									</table>
									<hr>
									<table id="dataTable" class="table table-bordered" style="color:black">
									  
										<tr>
										  <td><b>Deductions</b></th>
										  <td><b>Type</b></th>
										  <td><b>Amount</b></th>
										</tr>
									  <tbody>
										<?php 
										$query4 = "SELECT Amount FROM payrolladvancedetails where ID <> 0 AND PayID = ".$ID." AND EmpID = ".$row3['ID']."";
										$res4 = mysql_query($query4) or die(mysql_error());
										$num4 = mysql_num_rows($res4);
										if($num4 > 0)
										{
											while($row4 = mysql_fetch_array($res4))
											{
										?>
										<tr>
										  <td>Advance</td>
										  <td>Advance Deduction</td>
										  <td><?php echo $row4['Amount']; ?></td>
										</tr>
										<?php
											}
										}
										?>
										<?php 
										$query4 = "SELECT Amount,Type FROM payrollloandetails where ID <> 0 AND PayID = ".$ID." AND EmpID = ".$row3['ID']."";
										$res4 = mysql_query($query4) or die(mysql_error());
										$num4 = mysql_num_rows($res4);
										if($num4 > 0)
										{
											while($row4 = mysql_fetch_array($res4))
											{
										?>
										<tr>
										  <td><?php echo $row4['Type']; ?></td>
										  <td>Loan Deduction</td>
										  <td><?php echo $row4['Amount']; ?></td>
										</tr>
										<?php
											}
										}
										?>
										<?php 
										$query4 = "SELECT Name,Type,Amount FROM payrolldeductiondetails where ID <> 0 AND PayID = ".$ID." AND EmpID = ".$row3['ID']." ORDER BY Name ASC";
										$res4 = mysql_query($query4) or die(mysql_error());
										$num4 = mysql_num_rows($res4);
										if($num4 > 0)
										{
											while($row4 = mysql_fetch_array($res4))
											{
										?>
										<tr>
										  <td><?php echo $row4['Name']; ?></td>
										  <td><?php echo $row4['Type']; ?></td>
										  <td><?php echo $row4['Amount']; ?></td>
										</tr>
										<?php
											}
										}
										?>
										<?php 
										$query4 = "SELECT Name,Type,EmployeeContribution FROM payrollcontributiondetails where ID <> 0 AND PayID = ".$ID." AND EmpID = ".$row3['ID']." AND Amount > 0 ORDER BY Name ASC";
										$res4 = mysql_query($query4) or die(mysql_error());
										$num4 = mysql_num_rows($res4);
										if($num4 == 1)
										{
											$row4 = mysql_fetch_array($res4);
										?>
										<tr>
										  <td><?php echo $row4['Name']; ?></td>
										  <td><?php echo $row4['Type']; ?></td>
										  <td><?php echo $row4['EmployeeContribution']; ?></td>
										</tr>
										<?php
										}
										?>
									  </tbody>
									  <tr>
										  <td colspan="2"><b>Deductions Total</b></td>
										  <td><b><?php echo $row3['OtherDeductions']; ?></b></td>
										</tr>
									</table>
								</div>
								<div class="modal-footer clearfix">

									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

									<!--<button onclick="window.print();" class="btn btn-primary pull-left"><i class="fa fa-print"></i> Print</button>-->
								</div>
							</div>
						</div>
					</div>
					
                     <?php
						$c++;
						}
					}
						if($num3 > 0)
						{
						?>
						  
						<?php
						}
						
						$TTBasic = 0;
						$TTAllowance = 0;
						$TTGross = 0;
						$TTDaysGross = 0;
						$TTOTH = 0;
						$TTOTA = 0;
						$TTOtherAllowance = 0;
						$TTGrossPay = 0;
						$TTOtherDeduction = 0;
						$TTIncomeTax = 0;
						$TTNetPay = 0;
						
						}
						}
						}
					}
					?>   
        

<!-- ./wrapper -->
<!-- Bootstrap -->
<script>
// ;(function($) {
   // $.fn.fixMe = function() {
      // return this.each(function() {
         // var $this = $(this),
            // $t_fixed;
         // function init() {
            // $this.wrap('<div class="containerss" />');
            // $t_fixed = $this.clone();
            // $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            // resizeFixed();
         // }
         // function resizeFixed() {
            // $t_fixed.find("th").each(function(index) {
               // $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            // });
         // }
         // function scrollFixed() {
            // var offset = $(this).scrollTop(),
            // tableOffsetTop = $this.offset().top,
            // tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            // if(offset < tableOffsetTop || offset > tableOffsetBottom)
               // $t_fixed.hide();
            // else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               // $t_fixed.show();
			   // $t_fixed.addClass("frontForced");
         // }
         // $(window).resize(resizeFixed);
         // $(window).scroll(scrollFixed);
         // init();
      // });
   // };
// })(jQuery);

// $(document).ready(function(){
   // $("table").fixMe();
   // $(".up").click(function() {
      // $('html, body').animate({
      // scrollTop: 0
   // }, 2000);
 // });
// });
</script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->

<script>
;(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="containerss" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };
})(jQuery);

$(document).ready(function(){
   $(".table-fix").fixMe();
   $(".up").click(function() {
      $('html, body').animate({
      scrollTop: 0
   }, 2000);
 });
});
</script>

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
	</style>
	
</body>
</html>
