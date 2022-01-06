<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	
$num_of_days=0;
$CompanyID="";
$CompID=array();
$EncashmentMonth="";
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


if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT Step1ID,Step2ID,Step3ID,DATE_FORMAT(Step1Date, '%D %b %Y') AS Step1Date,DATE_FORMAT(Step2Date, '%D %b %Y') AS Step2Date,DATE_FORMAT(Step3Date, '%D %b %Y') AS Step3Date,Steps,MonthEncashment,CompanyID,EncashmentDate,DATE_FORMAT(DateAdded, '%D %b %Y') AS Created FROM encashment WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Encashment Sheet.</b>
		</div>';
		redirect("LeaveEncashments.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);

		$CompanyID=$row["CompanyID"];
		$CompID=explode(',',$row["CompanyID"]);
		$EncashmentMonth=$row["MonthEncashment"];
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
<title>Encashment Slips</title>
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
      <h1> Encashment Slips<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'LeaveEncashments.php' : ''); ?>"><i class="fa fa-dashboard"></i> Encashment</a></li>
        <li class="active">Encashment Slips</li>
      </ol>
      
    </section>
    
    <!-- Main content -->
    <section class="content">
	<div class="box-footer no-print" style="text-align:right;">
                 <button class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
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
              
              
				<h4 class="alig">Encashment Slips for the Month of <?php echo $EncashmentMonth; ?></h4><hr>
              
                <table style="font-size:12px;" id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr style="font-size:15px;">
                      <th>S#</th>
					  <th>Emp ID</th>
					  <th>Payment Mode</th>
                      <th>Employee Name</th>
					  <th>Designation</th>
					  <th>Department</th>              
					  <th class="no-print" rowspan="2"></th>
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
					<?php 
					$query3 = "SELECT pr.EncashmentDate,e.ID,p.ID AS EncashmentID,e.EmpID,e.Designation,e.Department,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,p.Basic,p.BankorCash,p.Gross,p.TotalDays,p.OtherAllowances FROM employees e LEFT JOIN encashmentdetails p ON e.ID = p.EmpID LEFT JOIN encashment pr ON pr.ID = p.EncashmentID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND p.EncashmentID = ".$ID." ORDER BY e.ID ASC";
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
                      <th><?php echo $row3['EmpID']; ?></th>
					  <th><?php echo $row3['BankorCash']; ?></th>
					  <th><?php echo $row3['FirstName'].' '.$row3['LastName']; ?></th>
					  <th><?php echo $row3['Designation']; ?></th>
					  <th><?php echo $row3['Department']; ?></th>
					 <th class="no-print"><a <?php echo ($Steps != 3 ? 'disabled' : ''); ?> <?php echo (($_SESSION['RoleID'] == 'Accounts' OR $_SESSION['RoleID'] == 'Audit') ? 'disabled' : ''); ?> href="EncashmentSlip.php?ID=<?php echo $row3['EncashmentID']; ?>" class="btn btn-success"><i class="fa fa-file-text-o"></i></a></th>
                    </tr>
					
                     <?php
						$c++;
						}
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
					?>   
                   
                    </tr>
                   
				
				
                  </tbody>
                </table>

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
