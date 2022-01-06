<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT p.ID AS PayID,p.MonthPayroll,p.FromDate,p.ToDate,p.NumOfDays,DATE_FORMAT(p.FromDate, '%D %b %Y') AS FromDateT,DATE_FORMAT(p.ToDate, '%D %b %Y') AS ToDateT,e.FirstName,e.LastName,e.ID AS Employee,e.EmpID,e.Designation,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,c.Name AS Company,c.Logo,pd.Present,pd.Lates,pd.Earlies,pd.LEDeductions,pd.HalfDays,pd.OffDays,pd.Leaves,pd.Absent,pd.TotalDays,pd.WOvertimeH,pd.LOvertimeH,pd.WOvertimeA,pd.LOvertimeA,pd.OvertimeHolidayDays,pd.Basic,pd.Gross,pd.OtherAllowances,pd.OtherDeductions,pd.IncomeTax,pd.BankorCash,pd.GrossOfDays,pd.LeaveOpening,pd.LeaveGrant,pd.LeaveUtilize,pd.LeaveWriteoff,pd.LeaveBalance,pc.EmployerContribution FROM payrolldetails pd LEFT JOIN payroll p ON pd.PayID = p.ID LEFT JOIN employees e ON pd.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN payrollcontributiondetails pc ON p.ID = pc.PayID AND e.ID = pc.EmpID WHERE pd.ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Salery Slip.</b>
		</div>';
		redirect("MyPaySlips.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$PayID=$row["PayID"];
		$NumOfDays=$row["NumOfDays"];
		$MonthPayroll=$row["MonthPayroll"];
		$FromDate=$row["FromDate"];
		$ToDate=$row["ToDate"];
		$FromDateT=$row["FromDateT"];
		$ToDateT=$row["ToDateT"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$Employee=$row["Employee"];
		$EmpID=$row["EmpID"];
		$Designation=$row["Designation"];
		$Department=$row["Department"];
		$JoiningDate=$row["JoiningDate"];
		$Company=$row["Company"];
		$Present=$row["Present"];
		$Lates=$row["Lates"];
		$Earlies=$row["Earlies"];
		$LEDeductions=$row["LEDeductions"];
		$HalfDays=$row["HalfDays"];
		$OffDays=$row["OffDays"];
		$Leaves=$row["Leaves"];
		$Absent=$row["Absent"];
		$TotalDays=$row["TotalDays"];
		$WOvertimeH=$row["WOvertimeH"];
		$LOvertimeH=$row["LOvertimeH"];
		$WOvertimeA=$row["WOvertimeA"];
		$LOvertimeA=$row["LOvertimeA"];
		$OvertimeHolidayDays=$row["OvertimeHolidayDays"];
		$Basic=$row["Basic"];
		$Gross=$row["Gross"];
		$OtherAllowances=$row["OtherAllowances"];
		$OtherDeductions=$row["OtherDeductions"];
		$IncomeTax=$row["IncomeTax"];
		$BankorCash=$row["BankorCash"];
		$GrossOfDays=$row["GrossOfDays"];
		$EmployerContribution=$row["EmployerContribution"];
		$LeaveOpening=$row["LeaveOpening"];
		$LeaveGrant=$row["LeaveGrant"];
		$LeaveUtilize=$row["LeaveUtilize"];
		$LeaveWriteoff=$row["LeaveWriteoff"];
		$LeaveBalance=$row["LeaveBalance"];
		$Logo=$row["Logo"];
	}

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Pay Slip</title>
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
		.abcd {text-align:left;}
		.flo {float:right;}
</style>
</head>
<body class="skin-blue" style="font-size:11px">
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
      <h1> Pay Slip<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="MyPaySlips.php"><i class="fa fa-dashboard"></i> My Pay Slips</a></li>
        <li class="active">Pay Slip</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box-footer no-print" style="text-align:right;">
	  <button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button><br><br>
	  </div>
	  <div class="box box">
      <div class="row">
		
		<div class="col-lg-12 col-xs-12">
          <br>
		  <form id="frmPages"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>">
          <input type="hidden" id="ID" name="ID" value="<?php echo $ID; ?>" />
			
			<div class="col-lg-12 col-xs-12" style="margin-bottom:-15px">
				<?php 
					if(isset($Logo) && $Logo !="")
					{
					echo '<img class="thumbnail" src="'.DIR_COMPANY_LOGO.$Logo.'" height="50">';
					}
				?>
			</div> 
			
			<div class="col-lg-5 col-xs-5">
				<h4><?php echo $Company; ?></h4> 
				<h6>Pay Slip for the month of <?php echo $MonthPayroll; ?></h6>
				<h6>Salary From <?php echo $FromDateT; ?> Till <?php echo $ToDateT; ?> (<?php echo $NumOfDays; ?> Days)</h6>
				<h6>Employee: <?php echo $FirstName.' '.$LastName.' ('.$EmpID.')'; ?></h6> 
				<h6>Joining Date: <?php echo $JoiningDate; ?></h6>
				<h6>Department: <?php echo $Department; ?></</h6>
				<h6>Designation: <?php echo $Designation; ?></</h6>  
			</div> 

			<div class="col-lg-7 col-xs-7">         
				<table id="" class="table table-bordered invoice">
					<tr>
						<th>Attendance <span class="flo"><?php echo $Present + $OffDays; ?></span></th>
						<th>OT Hours <span class="flo"><?php echo $WOvertimeH; ?></span></th>
                    </tr>
                    <tr>
						<th>Absent / LWOP<span class="flo"><?php echo $Absent; ?></span></th>
						<th>Holidays OT Hours <span class="flo">(H: <?php echo $LOvertimeH; ?> / D: <?php echo $OvertimeHolidayDays; ?>)</span> </th>
                    </tr>   
                    <tr>
						<th>Late / Early (L:<?php echo $Lates; ?> / E:<?php echo $Earlies; ?>)<span class="flo"><?php echo $LEDeductions; ?></span></th>
						<th>Leaves<span class="flo"><?php echo $Leaves; ?></span></th>
                    </tr>
                    <tr>
						<th>Half Days<span class="flo"><?php echo $HalfDays; ?></span></th>
						<th>Pay Days <span class="flo"><?php echo $TotalDays; ?></span></th>
                    </tr>
				</table>
			</div>
                      
			<div class="col-lg-12 col-xs-12">
					<table id="dataTable" class="table table-bordered invoice">
                    <tr>
                      <th>Leave Type</th>
					  <th>Opening Leave</th>
                      <th>Grant This Period</th>
                      <th>Utilized This Period</th>
                      <th>Write Off / Adjust</th>
                      <th>Balance</th>
                    </tr>
					<tr>
                     <th >Annual / Casual / Medical</th>
                      <th ><span class="flo"><?php echo $LeaveOpening; ?></span></th>
					  <th ><span class="flo"><?php echo $LeaveGrant; ?></span></th>
                      <th ><span class="flo"><?php echo $LeaveUtilize; ?></span></th>
                      <th ><span class="flo"><?php echo $LeaveWriteoff; ?></span></th>
                      <th ><span class="flo"><?php echo $LeaveBalance; ?></span></th>
					</tr>
                  </table>
			</div>
			
			<div class="col-lg-6 col-xs-6">
                  <table id="dataTable" class="table table-bordered invoice" style="background-color:white;">
                 
                    <tr >
                      <th width="80%" >Description of Pay and Allowances</th>
					  <th align="right">Salary Structure</th>
                       </tr>
                   <tr >
                     <td style="text-align:left">Basic Salary</td>
                      <td ><span class="flo"><?php echo $Basic; ?></span></td>
					  
                   </tr>
				   <tr >
                     <td style="text-align:left">House Rent</td>
                      <td ><span class="flo"><?php echo round((30/100) * $Basic,2); ?></span></td>
					  
                   </tr>
                    <tr >
                     <td style="text-align:left">Medical</td>
                      <td ><span class="flo"><?php echo round((10/100) * $Basic,2); ?></span></td>
					  
                   </tr>   
                    <tr >
                     <td style="text-align:left">Utility Allowance</td>
                      <td ><span class="flo"><?php echo round((10/100) * $Basic,2); ?></span></td>
					  
                   </tr> 
                
                  </tbody>
                  
                </table>
			</div>
			
			<div class="col-lg-6 col-xs-6">
                  <table id="dataTable" class="table table-bordered invoice" style="background-color:white">
                    <tr >
                      <th width="80%">Other Allowances And Deductions <span class="no-print"><?php if($OtherAllowances > 0 || $OtherDeductions > 0){ ?><a data-toggle="modal" data-target="#compose-modal" href="" class="btn btn-warning" title="Allowances and Deductions"><i class="fa fa-eye"></i></a><?php } ?></span></th>
					  <th align="right">Salary Structure</th>
                    </tr>
                   <tr >
                     <td style="text-align:left">Income Tax</td>
                      <td ><span class="flo"><?php echo $IncomeTax; ?></span></td>
                   </tr>
                   <tr >
                     <td style="text-align:left">Overtime</td>
                      <td ><span class="flo"><?php echo $WOvertimeA + $LOvertimeA; ?></span></td>
                   </tr>
                   <tr >
                     <td style="text-align:left">Other Allowances</td>
                      <td ><span class="flo"><?php echo $OtherAllowances; ?></span></td>
                   </tr>   
                   <tr >
                     <td style="text-align:left">Other Deductions</td>
                     <td ><span class="flo"><?php echo $OtherDeductions; ?></span></td>
                   </tr>
				   
                  </tbody>
                </table>
			</div>
                <!-----  ---- -->
            <div class="col-lg-6 col-xs-6">
			<b>Actual Gross Salary</b>
			</div>
			<div class="col-lg-6 col-xs-6">
			<b style="float:right">Rs. <?php echo $Gross; ?>/=</b>
			</div>

			<div class="col-lg-6 col-xs-6">
			<b>Gross of Attendance</b>
			</div>
			<div class="col-lg-6 col-xs-6">
			<b style="float:right">Rs. <?php echo $GrossOfDays; ?>/=</b>
			</div>
			
			<div class="col-lg-6 col-xs-6">
			<b>Gross of Allowances</b>
			</div>
			<div class="col-lg-6 col-xs-6">
			<b style="float:right">Rs. <?php echo round($OtherAllowances + round($WOvertimeA + $LOvertimeA),2);?>/=</b>
			</div>
			
			<div class="col-lg-6 col-xs-6">
			<b>Gross of Deductions</b>
			</div>
			<div class="col-lg-6 col-xs-6">
			<b style="float:right">Rs. <?php echo round($OtherDeductions + $IncomeTax,2);?>/=</b>
			</div>
			
			<div class="col-lg-6 col-xs-6">
			<b>Net Salary For Current Month</b>
			</div>
			<div class="col-lg-6 col-xs-6">
			<b style="float:right"><b>Rs. <?php echo round($OtherAllowances + round($WOvertimeA + $LOvertimeA) + $GrossOfDays - $OtherDeductions - $IncomeTax);?>/=</b></b>
			</div>
			
			<div class="col-lg-6 col-xs-6">
			<b>Mode of Payment:  <?php echo ($BankorCash == 'Bank' ? 'Letter' : 'Cash'); ?></b>
			</div>
			<div class="col-lg-6 col-xs-6">
			</div>
			
			<div class="col-lg-12 col-xs-12">
			<h5>* Employer Contributed Rs.<?php echo round($EmployerContribution); ?>/= for the account of your Investment Savings at this month's payroll</h5>
			</div>	
			
			<div class="col-lg-6 col-xs-6">
			<br><br><br>
			<hr>
			<h4 style="text-align:center;">Authorized Signature</h4>
			</div>
			<div class="col-lg-6 col-xs-6">
			<br><br><br>
			<hr>
			<h4 style="text-align:center;">Employee Signature</h4>
			</div>                  
                
              
			  </form>
			</div>
		   </div>
          <!-- /.box-body -->
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
	
	<?php 
	$query3 = "SELECT e.ID,e.EmpID,e.FirstName,e.LastName,p.Basic,p.LEDeductions,p.GrossOfDays,p.AllowanceBreakup,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID WHERE e.ID <> 0 AND p.ID = ".$ID."";
	$res3 = mysql_query($query3) or die(mysql_error());
	$num3 = mysql_num_rows($res3);
	if($num3 == 1)
	{
		$row3 = mysql_fetch_array($res3)
	?>
	<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="fa fa-money"></i> Allowances and Deductions Detail</h4>
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
						$query4 = "SELECT Name,Type,Amount FROM payrollallowancedetails where ID <> 0 AND PayID = ".$PayID." AND EmpID = ".$row3['ID']." ORDER BY Name ASC";
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
						$query4 = "SELECT Amount FROM payrolladvancedetails where ID <> 0 AND PayID = ".$PayID." AND EmpID = ".$row3['ID']."";
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
						$query4 = "SELECT Amount,Type FROM payrollloandetails where ID <> 0 AND PayID = ".$PayID." AND EmpID = ".$row3['ID']."";
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
						$query4 = "SELECT Name,Type,Amount FROM payrolldeductiondetails where ID <> 0 AND PayID = ".$PayID." AND EmpID = ".$row3['ID']." ORDER BY Name ASC";
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
						$query4 = "SELECT Name,Type,EmployeeContribution FROM payrollcontributiondetails where ID <> 0 AND PayID = ".$PayID." AND EmpID = ".$row3['ID']." AND Amount > 0 ORDER BY Name ASC";
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
	}
?> 
</body>
</html>
