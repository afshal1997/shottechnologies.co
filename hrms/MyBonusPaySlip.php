<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT p.ID AS BonusID,p.MonthBonus,p.Heading,p.BonusDate,DATE_FORMAT(p.BonusDate, '%D %b %Y') AS BonusDateT,e.FirstName,e.LastName,e.ID AS Employee,e.EmpID,e.Designation,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,c.Name AS Company,pd.TotalDays,pd.Basic,pd.Gross,pd.OtherAllowances,pd.OtherDeductions,pd.BankorCash,pd.BonusAmount,pd.NetPay FROM bonusdetails pd LEFT JOIN bonus p ON pd.BonusID = p.ID LEFT JOIN employees e ON pd.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID WHERE pd.ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Bonus Slip.</b>
		</div>';
		redirect("Bonus.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$BonusID=$row["BonusID"];
		$MonthBonus=$row["MonthBonus"];
		$BonusDate=$row["BonusDate"];
		$BonusDateT=$row["BonusDateT"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$Employee=$row["Employee"];
		$EmpID=$row["EmpID"];
		$Designation=$row["Designation"];
		$Department=$row["Department"];
		$JoiningDate=$row["JoiningDate"];
		$Company=$row["Company"];
		$TotalDays=$row["TotalDays"];
		$Basic=$row["Basic"];
		$Gross=$row["Gross"];
		$OtherAllowances=($row["OtherAllowances"] + $row["Gross"]);
		$OtherDeductions=$row["OtherDeductions"];
		$BonusAmount=$row["BonusAmount"];
		$BankorCash=$row["BankorCash"];
		$Heading=$row["Heading"];
		$NetPay=$row["NetPay"];
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bonus Slip</title>
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
      <h1> Bonus Slip<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="MyBonusPaySlips.php"><i class="fa fa-dashboard"></i> My Bonus Pay Slips</a></li>
        <li class="active">Bonus Pay Slip</li>
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
			
			<div class="col-lg-12 col-xs-12">
				<h4><?php echo $Company; ?></h4> 
				<h4><?php echo $Heading; ?></h4>
				<h6>Bonus From <?php echo $JoiningDate; ?> Till <?php echo $BonusDateT; ?> (<?php echo $TotalDays; ?> Days)</h6>
				<h6>Employee: <?php echo $FirstName.' '.$LastName.' ('.$EmpID.')'; ?></h6> 
				<h6>Department: <?php echo $Department; ?></</h6>
				<h6>Designation: <?php echo $Designation; ?></</h6>  
			</div> 

              
			
			<div class="col-lg-12 col-xs-12">
                  <table id="dataTable" class="table table-bordered invoice" style="background-color:white;">
                 
                    <tr >
                      <th width="80%">Description of Salary and Allowances</th>
					  <th align="right">Salary Structure</th>
                       </tr>
                   <tr >
                     <th >Basic Salary</th>
                      <th ><span class="flo"><?php echo $Basic; ?></span></th>
					  
                   </tr>
				   <tr >
                     <th >Gross Salary</th>
                      <th ><span class="flo"><?php echo $Gross; ?></span></th>
					  
                   </tr>
				   <tr >
                     <th >Gross + Annual Bonus</th>
                      <th ><span class="flo"><?php echo $OtherAllowances; ?></span></th>
					  
                   </tr>
                
                  </tbody>
                  
                </table>
			</div>
                <!-----  ---- -->
            <div class="col-lg-6 col-xs-6">
			<h4>Actual Bonus Amount</h4>
			</div>
			<div class="col-lg-6 col-xs-6">
			<h4 style="float:right">Rs. <?php echo $BonusAmount; ?>/=</h4>
			</div>

			<div class="col-lg-6 col-xs-6">
			<h4>Loan Deduction from Bonus</h4>
			</div>
			<div class="col-lg-6 col-xs-6">
			<h4 style="float:right">Rs. <?php echo $OtherDeductions; ?>/=</h4>
			</div>
			
			<br>
			<div class="col-lg-6 col-xs-6">
			<h4>Net Bonus Amount</h4>
			</div>
			<div class="col-lg-6 col-xs-6">
			<h4 style="float:right"><b>Rs. <?php echo round($NetPay);?>/=</b></h4>
			</div>
			
			<div class="col-lg-6 col-xs-6">
			<h4>Mode of Payment:  <?php echo ($BankorCash == 'Bank' ? 'Letter' : 'Cash'); ?></h4>
			</div>
			<div class="col-lg-6 col-xs-6">
			<h4 style="float:right">&emsp;</h4>
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
