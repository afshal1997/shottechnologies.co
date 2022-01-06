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

$EnglishCurrency=0;


if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);			
	
$query="SELECT Step1ID,Step2ID,Step3ID,DATE_FORMAT(Step1Date, '%D %b %Y') AS Step1Date,DATE_FORMAT(Step2Date, '%D %b %Y') AS Step2Date,DATE_FORMAT(Step3Date, '%D %b %Y') AS Step3Date,Steps,MonthBonus,CompanyID,BonusDate,DATE_FORMAT(DateAdded, '%D %b %Y') AS Created FROM bonus WHERE  ID='" . (int)$ID . "'";
	
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
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Bonus.php' : ''); ?>"><i class="fa fa-dashboard"></i> Bonus</a></li>
        <li class="active">Bank Transfer Letter</li>
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
						$query = "SELECT Name FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
						$res = mysql_query($query) or die(mysql_error());
						$num = mysql_num_rows($res);
						if($num == 1)
						{
							$row = mysql_fetch_array($res);
							
							
				$query="SELECT DISTINCT c.Name AS CompanyName,b.ID,b.Name,b.LetterHead,b.AccountNo FROM bonus p LEFT JOIN bonusdetails pd ON pd.BonusID = p.ID LEFT JOIN employees e ON pd.EmpID = e.ID LEFT JOIN banks b ON e.Bank = b.Name LEFT JOIN companies c ON e.CompanyID = c.ID WHERE pd.ID <> 0 AND b.Name <> '' AND pd.BankorCash = 'Bank' AND p.ID='" . (int)$ID . "' AND e.CompanyID = ".$compid."";
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
					$EnglishCurrency = round(bank_transfer_amount_bonus($ID,$compid,$rowB['Name']),2);
					echo 'Dated: '.$Step1Date.'<br><br>';
					echo '<br>The Manager<br>';
					echo $rowB['LetterHead'];
					echo '<br><br>Subject : FUND TRANSFER<br><br>';
					echo 'You are requested to transferred the funds of ';
					echo 'Rs:'.bank_transfer_amount_bonus($ID,$compid,$rowB['Name']).'/= ';
					echo '(Pakistani Rupees '.convertNumber($EnglishCurrency).' Only) from '.$rowB['CompanyName'].' account # '.$rowB['AccountNo'].' to our staff account through excel sheet attached, which is already email.';
					echo '<br><br>Further details are attached;<br><br>';
					echo '<br><br>Kindly note these are salaries account and require transfer in the same day.<br><br>';
					echo '<br><br>Best regards,<br><br>';
					echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
					
					
					?>
					<?php 
					$query3 = "SELECT pr.BonusDate,e.ID,p.ID AS BonusID,e.EmpID,e.Designation,e.Department,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.NetPay,p.BankorCash,p.AccountNum,p.Gross,p.TotalDays,p.OtherAllowances,p.OtherDeductions FROM employees e LEFT JOIN bonusdetails p ON e.ID = p.EmpID LEFT JOIN bonus pr ON pr.ID = p.BonusID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$rowB['Name']."' AND p.BankorCash = 'Bank' AND p.BonusID = ".$ID." ORDER BY e.FirstName ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$c = 1;
						while($row3 = mysql_fetch_array($res3))
						{
						if($row3['NetPay'] > 0.4)
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
