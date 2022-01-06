<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	
$num_of_days=0;
$CompanyID="";
$CompID=array();
$BonusMonth="";
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

$BonusDate="";
$Heading="";

$Voucher="";

$EnglishCurrency=0;


if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);			
	
$query="SELECT Step1ID,Step2ID,Step3ID,DATE_FORMAT(Step1Date, '%D %b %Y') AS Step1Date,DATE_FORMAT(Step2Date, '%D %b %Y') AS Step2Date,DATE_FORMAT(Step3Date, '%D %b %Y') AS Step3Date,DATE_FORMAT(Step1Date, '%Y%m') AS Voucher,Steps,MonthBonus,CompanyID,BonusDate,Heading,DATE_FORMAT(DateAdded, '%D %b %Y') AS Created FROM bonus WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Bonus Sheet.</b>
		</div>';
		redirect("Bonus.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$CompanyID=$row["CompanyID"];
		$CompID=explode(',',$row["CompanyID"]);
		$BonusMonth=$row["MonthBonus"];
		$CreatedDate=$row["Created"];
		$Steps=$row["Steps"];
		$Step1ID=$row["Step1ID"];
		$Step2ID=$row["Step2ID"];
		$Step3ID=$row["Step3ID"];
		$Step1Date=$row["Step1Date"];
		$Step2Date=$row["Step2Date"];
		$Step3Date=$row["Step3Date"];
		$BonusDate=$row["BonusDate"];
		$Heading=$row["Heading"];
		$Voucher=$row["Voucher"];
	}
	

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Journal Voucher</title>
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
      <h1> Journal Voucher<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Bonus.php' : ''); ?>"><i class="fa fa-dashboard"></i> Bonus</a></li>
        <li class="active">Journal Voucher</li>
      </ol>
      
    </section>
    
    <!-- Main content -->
    <section class="content">
	<div class="box-footer no-print" style="text-align:right;">
                 <button class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
            </div>
	<div class="box box-solid">
      <div class="row">
        <div class="col-xs-12">
          
          <br>
			
              
              <div class="col-lg-12 col-xs-12">
				<?php
				foreach($CompID as $compid) 
					{
						$query = "SELECT Name,Abr FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
						$res = mysql_query($query) or die(mysql_error());
						$num = mysql_num_rows($res);
						if($num == 1)
						{
							$row = mysql_fetch_array($res);
							
				?>
				<div class="row">
					<div class="col-xs-8">
					 <b><?php echo $row['Name']; ?></b><br>
					 Suit no. 10 & 11, Ground Floor, Business Avenue, Main Shahra-e-Faisal, Karachi, Pakistan
					</div>
					<div class="col-xs-4" style="text-align:right;">
					<b>JOURNAL VOUCHER</b>
					</div>
					<br><br><br>
					<div class="col-xs-4">
					<b>Entry No.</b> &emsp;&emsp;&emsp;<?php echo $ID; ?>
					</div>
					<div class="col-xs-4">
					<b>Voucher #</b> &emsp;&emsp;&emsp;<?php echo $row['Abr'].$Voucher.$ID; ?>
					</div>
					<div class="col-xs-4" style="text-align:right;">
					<b>Date:&emsp;&emsp;</b> <?php echo $Step1Date; ?>
					</div>
					<div class="col-xs-12">
					<b>Reference:</b> &emsp;&emsp;BONUS POSTING
					</div>
					<div class="col-xs-12">
					<b>Company:</b> &emsp;&emsp;&thinsp;<?php echo $row['Name']; ?>
					</div>
					<div class="col-xs-12">
					<b>Narration:</b> &emsp;&emsp;&nbsp;<?php echo $Heading; ?>
					</div>
				</div><br>
				<table style="font-size:12px;" id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr style="font-size:15px;">
                      <th>HEAD OF ACCOUNT</th>
                      <th>CODE</th>
					  <th>Cost Center</th>
					  <th>DEBIT</th>
					  <th>CREDIT</th>
                    </tr>
                    
                    
                  </thead>
				  
                  <tbody>
               
                   
					<?php 
					$query3 = "SELECT SUM(p.NetPay) AS NetPayAmount,SUM(p.BonusAmount) AS BonusAmount,SUM(p.OtherDeductions) AS LoanAmount FROM bonusdetails p LEFT JOIN bonus pr ON pr.ID = p.BonusID LEFT JOIN employees e ON e.ID = p.EmpID WHERE pr.ID <> 0 AND e.CompanyID = ".$compid." AND pr.ID = ".$ID."";
					// echo $query3;
					// exit();
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$row3 = mysql_fetch_array($res3);
					?>
					<?php if($row3['BonusAmount'] > 0){ ?>
					<tr>
					  <th>STAFF BONUS</th>
					  <th></th>
					  <th>NO COST CENTRE</th>
					  <th><?php echo number_format($row3['BonusAmount'],2); ?></th>
						<th></th>
                    </tr>
					<?php } ?>
					<?php if($row3['LoanAmount'] > 0){ ?>
					<tr>
					  <th>STAFF LOAN</th>
					  <th></th>
					  <th>NO COST CENTRE</th>
					  <th></th>
					  <th><?php echo number_format($row3['LoanAmount'],2); ?></th>
                    </tr>
					<?php } ?>
					<tr>
					  <th>SALARY PAYABLE</th>
					  <th></th>
					  <th>NO COST CENTRE</th>
					  <th></th>
					  <th><?php echo number_format($row3['NetPayAmount'],2); ?></th>
                    </tr>
					
						<tr>
							<th>TOTAL:</th> 
							<th></th>
							<th></th>
							<th><?php echo $row3['BonusAmount']; ?></th> 
							<th><?php echo number_format($row3['NetPayAmount'] + $row3['LoanAmount'],2); ?></th>
						</tr>  
					<?php
					}
						
					?>   
                  </tbody>
                </table>
				<div class="row">
					<div class="col-xs-4" style="text-align:center">
					<br><br><b>________________</b><br>
					Prepared By
					</div>
					<div class="col-xs-4" style="text-align:center">
					<br><br><b>________________</b><br>
					Checked By
					</div>
					<div class="col-xs-4" style="text-align:center">
					<br><br><b>________________</b><br>
					Manager Finance
					</div>
					
				</div>
				<br><br><br>
				<?php	
					
				}
										
				}
				?>
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
