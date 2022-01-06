<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	
$num_of_days=0;
$CompanyID="";
$CompID=array();
$BonusMonth="";
$Heading="";
$Remarks="";
$CreatedDate="";
$Steps=0;

$_SESSION['state'] = "";

$TTBasic = 0;
$TTGross = 0;
$TTGrossAnnual = 0;
$TTGrossPay = 0;
$TTOtherDeduction = 0;
$TTNetPay = 0;

$GTTBasic = 0;
$GTTGrossAnnual = 0;
$GTTGross = 0;
$GTTGrossPay = 0;
$GTTOtherDeduction = 0;
$GTTNetPay = 0;

$Step1ID=0;
$Step2ID=0;
$Step3ID=0;

$Step1Date="";
$Step2Date="";
$Step3Date="";


if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT Step1ID,Step2ID,Step3ID,DATE_FORMAT(Step1Date, '%D %b %Y') AS Step1Date,DATE_FORMAT(Step2Date, '%D %b %Y') AS Step2Date,DATE_FORMAT(Step3Date, '%D %b %Y') AS Step3Date,Steps,MonthBonus,CompanyID,BonusDate,Heading,Remarks,DATE_FORMAT(DateAdded, '%D %b %Y') AS Created FROM bonus WHERE ID='" . (int)$ID . "'";
	
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
		$Heading=$row["Heading"];
		$Remarks=$row["Remarks"];
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
<title>Bonus Sheet</title>
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
      <h1> Bonus Sheet<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo (($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator') ? 'Bonus.php' : ''); ?>"><i class="fa fa-dashboard"></i> Bonus</a></li>
        <li class="active">Bonus Sheet</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
	<div class="box-footer no-print" style="text-align:right;">
				 <button class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
				 <a href="BonusSheetBankExcel.php?ID=<?php echo $ID; ?>" class="btn btn-primary margin no-print">Excel Sheet</a>
				 <?php 
				 if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){
				 if($Steps == 0){ 
				 ?>
				 <a class="btn btn-success margin" href="HRBonusOkay.php?ID=<?php echo $ID; ?>">Submit to Accounts <i class="fa fa-arrow-right"></i></a>
				 <?php }
				 }				 
				 if($_SESSION['RoleID'] == 'Accounts'){
				 if($Steps == 1){
				 ?>
				 <a class="btn btn-danger margin" href="HRBonusBack.php?ID=<?php echo $ID; ?>"><i class="fa fa-arrow-left"></i> Back to HR</a>
				 <a class="btn btn-success margin" href="AccountsBonusOkay.php?ID=<?php echo $ID; ?>">Submit to Audit <i class="fa fa-arrow-right"></i></a>
				 <?php } 
				 }
				 if($_SESSION['RoleID'] == 'Audit'){
				 if($Steps == 2){
				 ?>
				 <a class="btn btn-danger margin" href="HRBonusBack.php?ID=<?php echo $ID; ?>"><i class="fa fa-arrow-left"></i> Back to HR</a>
				 <a class="btn btn-success margin" href="AuditBonusOkay.php?ID=<?php echo $ID; ?>">Successfully Audit <i class="fa fa-arrow-right"></i></a>
				 <?php 
				 } 
				 }
				 ?>
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
				<h4 class="alig"><?php echo $Heading; ?></h4><h5 class="alig"><?php echo $Remarks; ?></h5><hr>
              
                <table style="font-size:8px;" id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr>
                      <th rowspan="2">S#</th>
					  <th rowspan="2">Emp ID</th>
                      <th rowspan="2">Employee Name</th>
                      <th rowspan="2">Account #</th>
                     
                    
                     <th colspan="3" style="text-align:center;font-size:17px;font-family:verdana;">Employment History</th>
					  <th colspan="3" style="text-align:center;font-size:17px;font-family:verdana;">Salary</th>
                       <th rowspan="2">Bonus Amount</th>
                   
                    
                               <th rowspan="2">Loan Deductions</th>
                                 <th rowspan="2">Net Pay</th>
								 <!--<th class="no-print" rowspan="2"></th>-->
								 <!--<th class="no-print" rowspan="2"></th>-->
                      </tr>
                     <tr>
					 
					 <th>Joining Date</th>
					  <th>Total Days</th>
                      <th>Months</th>
                        <th rowspan="">Basic Salary</th>
                      <th rowspan="">Gross Salary</th>
                      <th rowspan="">Gross + Annual Bonus</th>
                      
                     
                       
                       
                       
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
                      
					  <th colspan="13"><h4><?php echo $row['Name']; ?></h4></th>
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
					  <th colspan="13"><h6><?php echo $row2['Name']; ?><h6></th>
                    </tr>
					<?php 
					$query3 = "SELECT b.BonusDate,e.ID,e.AccountNumber,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,bd.BonusAmount,bd.ID AS PayrollID,e.EmpID,e.Designation,e.CNICNumber,e.CompanyID,e.FirstName,e.LastName,bd.Basic,bd.NetPay,bd.BankorCash,bd.Gross,bd.TotalDays,bd.OtherAllowances,bd.OtherDeductions FROM employees e LEFT JOIN bonusdetails bd ON e.ID = bd.EmpID LEFT JOIN bonus b ON b.ID = bd.BonusID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Location = ".$row2['ID']." AND bd.BonusID = ".$ID." AND bd.BankorCash = 'Bank' ORDER BY e.ID ASC";
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
					  <th><?php echo $row3['AccountNumber']; ?></th>
                      <th><?php echo $row3['JoiningDate'];?></th>
					  <th><?php echo $row3['TotalDays'];?></th>
					  <th><?php echo ceil($row3['TotalDays']/30);?></th>
                       <th><?php echo $row3['Basic'];$TTBasic += $row3['Basic'];  ?></th>
					  <th><?php echo $row3['Gross'];$TTGross += $row3['Gross']; ?></th>
					  <th><?php echo ($row3['Gross'] + $row3['OtherAllowances']);$TTGrossAnnual += ($row3['Gross'] + $row3['OtherAllowances']); ?></th>
					  <th><?php echo $row3['BonusAmount'];$TTGrossPay += $row3['BonusAmount']; ?></th>
					  <th><?php echo $row3['OtherDeductions'];$TTOtherDeduction += $row3['OtherDeductions']; ?></th>
                     <th><?php echo round($row3['NetPay']);$TTNetPay += $row3['NetPay']; ?></th>
					<!--<th class="no-print"><?php //if($row3['OtherAllowances'] > 0 || $row3['OtherDeductions'] > 0){ ?><a data-toggle="modal" data-target="#compose-modal<?php //echo $row3['ID'] ?>" href="" class="btn btn-warning" title="Allowances and Deductions"><i class="fa fa-eye"></i></a><?php //} ?></th>-->
					 <!--<th class="no-print"><a <?php //echo ($Steps != 0 ? 'disabled' : ''); ?> <?php //echo (($_SESSION['RoleID'] == 'Accounts' OR $_SESSION['RoleID'] == 'Audit') ? 'disabled' : ''); ?> href="UpdateSalarySheet.php?ID=<?php //echo $ID; ?>&PayrollID=<?php //echo $row3['PayrollID']; ?>&PayrollCompanyID=<?php //echo $row3['CompanyID']; ?>&PayrollEmpID=<?php //echo $row3['ID']; ?>&PayrollFromDate=<?php //echo $row3['FromDate']; ?>&PayrollToDate=<?php //echo $row3['ToDate']; ?>&NumOfDays=<?php //echo $num_of_days; ?>" class="btn btn-success"><i class="fa fa-refresh"></i></a></th>-->
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
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $TTBasic; $GTTBasic = $GTTBasic + $TTBasic;  ?></th>
							<th><?php echo $TTGross; $GTTGross = $GTTGross + $TTGross; ?></th>
							<th><?php echo $TTGrossAnnual; $GTTGrossAnnual = $GTTGrossAnnual + $TTGrossAnnual;; ?></th>
							<th><?php echo $TTGrossPay; $GTTGrossPay = $GTTGrossPay + $TTGrossPay; ?></th>
							<th><?php echo $TTOtherDeduction; $GTTOtherDeduction = $GTTOtherDeduction + $TTOtherDeduction; ?></th>
							<th><?php echo $TTNetPay; $GTTNetPay =  $GTTNetPay + $TTNetPay; ?></th> 
							<!--<th></th>-->
							<!--<th></th>-->
						</tr>  
						<?php
						}
						
						$TTBasic = 0;
						$TTGross = 0;
						$TTGrossAnnual = 0;
						$TTGrossPay = 0;
						$TTOtherDeduction = 0;
						$TTNetPay = 0;
						
						}
						}
						}
					}
					?>   
                   <tr>
							<th colspan="3">Grant Total</th> 
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $GTTBasic; ?></th>
							<th><?php echo $GTTGross; ?></th>
							<th><?php echo $GTTGrossAnnual; ?></th>
							<th><?php echo $GTTGrossPay; ?></th>
							<th><?php echo $GTTOtherDeduction; ?></th>
							<th><?php echo $GTTNetPay; ?></th> 
							<!--<th></th>-->
							<!--<th></th>-->
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

</body>
</html>
