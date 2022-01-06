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

$Step1ID=0;
$Step2ID=0;
$Step3ID=0;

$Step1Date="";
$Step2Date="";
$Step3Date="";

$EnglishCurrency=0;

$PrintMode=0;
$Rows=10;

if(isset($_REQUEST["PrintMode"]))
	$PrintMode=trim($_REQUEST["PrintMode"]);
if(isset($_REQUEST["Rows"]))
	$Rows=(int)$_REQUEST["Rows"];

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
<title>Bank Transfer Letter</title>
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

<style type="text/css">
    table{
        border:none;
    }
	
	#printable table
	{
		table-layout: auto;
		width:100%;
	}
	
	#printable tr
	{
		display:flex;
		width:100%;
	}
	
	#printable th
	{	
		overflow: hidden;
		width: 100px;
		color:black;
		text-align:left;
		margin-top:170px;
	}
	
	#printable td
	{
		overflow: hidden;
		width: 100px;
		text-align:left;
	}	
	
	@media screen {
		#printable table tbody .head{
			display: none;
		}
		#printable
		{
			font-size:25px;
		}
	} 
	
	@media print {
		.head {
			page-break-before: always;
			
		}
		#printable
		{
			font-size:25px;
		}
	} 
</style>

<script>
    	$(document).ready(function(){
		var head = $('#printable table thead tr');
		$( "#printable table tbody tr:nth-child(<?php echo $Rows; ?>n+<?php echo $Rows; ?>)" ).after(head.clone());

	});
</script>

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
      <h1> Bank Transfer Letter<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Payrolls.php' : ''); ?>"><i class="fa fa-dashboard"></i> Payrolls</a></li>
        <li class="active">Bank Transfer Letter</li>
      </ol>
      
    </section>
    <div class="box-footer no-print" style="text-align:right;">
				<br>
				
				 <form action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="POST">				
						<div class="row margin">
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Headings" >Print Mode: </label>
								<input type="radio" <?php echo ($PrintMode == 1 ? ' checked="checked"' : ''); ?> value="1" name="PrintMode" id="On"><label for="On">On</label>
								<input type="radio" <?php echo ($PrintMode == 0 ? ' checked="checked"' : ''); ?> value="0" name="PrintMode" id="Off"><label for="Off">Off</label><br>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-1 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Rows" >Rows: </label>
								<input class="form-control" type="number"  value="<?php echo $Rows; ?>" name="Rows" id="Rows">
							</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
                           <div class="form-group">	
							<br>
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
                           <div class="form-group">	
						   <a class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</a>
							</div> 
                        </div><!-- ./col -->
						
						</div>	
					</form>
					
                 
            </div>
    <!-- Main content -->
    <section class="content <?php echo ($PrintMode == 1 ? 'no-print' : '') ?>">
	
	<div class="box box-solid">
      <div class="row">
        <div class="col-xs-12">
          
          <br>
			
              <?php if($PrintMode == 0){ ?>  
              <div class="col-lg-12 col-xs-12">
				 
				<?php
				foreach($CompID as $compid) 
					{
						$query = "SELECT Name FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
						$res = mysql_query($query) or die(mysql_error());
						$num = mysql_num_rows($res);
						if($num == 1)
						{
							$row = mysql_fetch_array($res);
							
							
				$query="SELECT DISTINCT c.Name AS CompanyName,b.ID,b.Name,b.LetterHead,b.AccountNo FROM payroll p LEFT JOIN payrolldetails pd ON pd.PayID = p.ID LEFT JOIN employees e ON pd.EmpID = e.ID LEFT JOIN banks b ON e.Bank = b.Name LEFT JOIN companies c ON e.CompanyID = c.ID WHERE pd.ID <> 0 AND b.Name <> '' AND pd.BankorCash = 'Bank' AND pd.StopSalary = 'No' AND pd.Resignation = 'No' AND p.ID='" . (int)$ID . "' AND e.CompanyID = ".$compid."";
				$result = mysql_query ($query) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				if($num!=0)
				{
					while($rowB=mysql_fetch_array($result))
					{
				?>
				<table style="font-size:12px;" id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr style="font-size:15px;">
                      <th>S#</th>
                      <th>Employees Name</th>
					  <th>Account No.</th>
					  <th>Amount (Rs)</th>
                    </tr>
                    
                    
                  </thead>
				  
                  <tbody>
               
                    <?php 
					echo '<br><br><br><br><br><br>';
					$EnglishCurrency = round(bank_transfer_amount($ID,$compid,$rowB['Name']),2);
					echo 'Dated: '.$Step1Date.'<br><br>';
					echo '<br>The Manager<br>';
					echo $rowB['LetterHead'];
					echo '<br><br>Subject : FUND TRANSFER<br><br>';
					echo 'You are requested to transferred the funds of ';
					echo 'Rs:'.bank_transfer_amount($ID,$compid,$rowB['Name']).'/= ';
					echo '(Pakistani Rupees '.convertNumber($EnglishCurrency).' Only) from '.$rowB['CompanyName'].' account # '.$rowB['AccountNo'].' to our staff account through excel sheet attached, which is already email.';
					echo '<br><br>Further details are attached;<br><br>';
					echo '<br><br>Kindly note these are salaries account and require transfer in the same day.<br><br>';
					echo '<br><br>Best regards,<br><br>';
					echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
					
					
					?>
					<?php 
					$query3 = "SELECT pr.FromDate,pr.ToDate,e.ID,p.ID AS PayrollID,e.EmpID,e.Designation,e.Department,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.NetPay,p.LEDeductions,p.GrossOfDays,p.AllowanceBreakup,p.BankorCash,p.AccountNum,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OvertimeHolidayDays,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID WHERE p.NetPay > 0 AND e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$rowB['Name']."' AND p.BankorCash = 'Bank' AND p.StopSalary = 'No' AND p.Resignation = 'No' AND p.PayID = ".$ID." ORDER BY e.FirstName ASC";
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
					  <th><?php echo $row3['FirstName']; ?></th>
					  <th><?php echo $row3['AccountNum']; ?></th>
					  <th><?php echo number_format($row3['NetPay']);
						$TTNetPay += $row3['NetPay'];
						?></th>
                    </tr>
					
                     <?php
						$c++;
						}
					
					?>
						<tr>
							<th></th> 
							<th>Total</th>
							<th></th>
							<th><?php echo number_format($TTNetPay); ?></th> 
						</tr>  
						<?php
						$TTNetPay = 0;
						//echo '<br><br>Best regards,<br><br>';
						}
						
					echo '</tbody></table>';
					echo '<br><br>';
					echo '<br>Best regards<br>';
					}
					?>   
                   
                   
				<?php	
					}
				}
										
				}
				?>
			</div>	
			<?php } ?>
           </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
	<?php if($PrintMode == 1){ ?>
			<div id="printable">
				 
				<?php
				foreach($CompID as $compid) 
					{
						$query = "SELECT Name FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
						$res = mysql_query($query) or die(mysql_error());
						$num = mysql_num_rows($res);
						if($num == 1)
						{
							$row = mysql_fetch_array($res);
							
							
				$query="SELECT DISTINCT c.Name AS CompanyName,b.ID,b.Name,b.LetterHead,b.AccountNo FROM payroll p LEFT JOIN payrolldetails pd ON pd.PayID = p.ID LEFT JOIN employees e ON pd.EmpID = e.ID LEFT JOIN banks b ON e.Bank = b.Name LEFT JOIN companies c ON e.CompanyID = c.ID WHERE pd.ID <> 0 AND b.Name <> '' AND pd.BankorCash = 'Bank' AND pd.StopSalary = 'No' AND pd.Resignation = 'No' AND p.ID='" . (int)$ID . "' AND e.CompanyID = ".$compid."";
				$result = mysql_query ($query) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				if($num!=0)
				{
					while($rowB=mysql_fetch_array($result))
					{
				?>
				<table style="border:none" id="dataTable" class="table table-bordered">
                  <thead>
                    <tr class="head">
                      <th style="width:60px">S#</th>
                      <th style="width:500px">Employees Name</th>
					  <th style="width:290px">Account No.</th>
					  <th style="width:260px">Amount (Rs)</th>
                    </tr>
                    
                    
                  </thead>
				  
                  <tbody>
               
                    <?php 
					echo '<br><br><br><br><br><br>';
					$EnglishCurrency = round(bank_transfer_amount($ID,$compid,$rowB['Name']),2);
					echo 'Dated: '.$Step1Date.'<br><br>';
					echo '<br>The Manager<br>';
					echo $rowB['LetterHead'];
					echo '<br><br>Subject : FUND TRANSFER<br><br>';
					echo 'You are requested to transferred the funds of ';
					echo 'Rs:'.bank_transfer_amount($ID,$compid,$rowB['Name']).'/= ';
					echo '(Pakistani Rupees '.convertNumber($EnglishCurrency).' Only) from '.$rowB['CompanyName'].' account # '.$rowB['AccountNo'].' to our staff account through excel sheet attached, which is already email.';
					echo '<br><br>Further details are attached;<br><br>';
					echo '<br><br>Kindly note these are salaries account and require transfer in the same day.<br><br>';
					echo '<br><br>Best regards,<br><br>';
					echo '<br><br><br><br><br><br><br><br><br><br>';
					
					
					?>
					<?php 
					$query3 = "SELECT pr.FromDate,pr.ToDate,e.ID,p.ID AS PayrollID,e.EmpID,e.Designation,e.Department,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.NetPay,p.LEDeductions,p.GrossOfDays,p.AllowanceBreakup,p.BankorCash,p.AccountNum,p.Gross,p.Present,p.Lates,p.Earlies,p.HalfDays,p.OffDays,p.Leaves,p.Absent,p.TotalDays,p.WOvertimeH,p.WOvertimeA,p.LOvertimeH,p.LOvertimeA,p.OvertimeHolidayDays,p.OtherAllowances,p.OtherDeductions,p.IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$rowB['Name']."' AND p.BankorCash = 'Bank' AND p.StopSalary = 'No' AND p.Resignation = 'No' AND p.PayID = ".$ID." ORDER BY e.FirstName ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$c = 1;
						while($row3 = mysql_fetch_array($res3))
						{
					?>
					<tr>
                    <td colspan="" style="width:60px"><?php echo $c; ?></td>
					  <td style="width:500px"><?php echo $row3['FirstName']; ?></td>
					  <td style="width:290px"><?php echo $row3['AccountNum']; ?></td>
					  <td style="width:260px"><?php echo number_format($row3['NetPay']);
						$TTNetPay += $row3['NetPay'];
						?></td>
                    </tr>
					
                     <?php
						$c++;
						}
					
					?>
						<tr>
							<td style="width:60px"></td> 
							<td style="width:500px">Total</td>
							<td style="width:290px"></td>
							<td style="width:260px"><?php echo number_format($TTNetPay); ?></td> 
						</tr>  
						<?php
						$TTNetPay = 0;
						//echo '<br><br>Best regards,<br><br>';
						}
						
					echo '</tbody></table>';
					echo '<br><br>';
					echo '<br>Best regards<br>';
					}
					?>   
                   
                   
				<?php	
					}
				}
										
				}
				?>
			</div>	
	<?php } ?>
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
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
