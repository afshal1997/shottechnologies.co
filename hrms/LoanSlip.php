<?php
include_once("Common.php");
include("CheckAdminLogin.php");




	$msg="";
	$Code='';
	$Amount=0;
	$RepaymentDate="";
	$Status=0;
	$EmployeeID=0;
	$LoanRequestID=0;
	$LoanType="";
	$RemainingAmount=0;
	$RepaymentAmount=0;
	$Company="";
	$Month="";
	$Added="";
	$EmpCode="";
	$FirstName="";
	$LastName="";
	$JoiningDate="";
	$EmpType="";
	$Reason="";
	$Salary=0;
	$AnnualBonus=0;
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	

	$query="SELECT e.EmpID AS EmpCode,e.Salary,e.FirstName,e.LastName,DATE_FORMAT(e.JoiningDate, '%d-%b-%Y') as JoiningDate,e.EmpType,a.ID,a.EmpID,a.Reason,a.Code,a.Status,a.LoanReqID,a.LoanType,a.Amount,a.RepaymentAmount,DATE_FORMAT(a.DisbursementDate, '%M %Y') as Month,DATE_FORMAT(a.DisbursementDate, '%d-%b-%Y') as Added,DATE_FORMAT(a.RepaymentDate, '%d-%b-%Y') as RepaymentDate,a.RemainingAmount,c.Name AS Company FROM loans a LEFT JOIN employees e ON a.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID WHERE a.ID='" .(int)$ID . "'";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Loan ID.</b>
		</div>';
		redirect("Loans.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$Code=dboutput($rows['Code']);
		$EmployeeID=dboutput($rows['EmpID']);
		$Amount=dboutput($rows['Amount']);
		$RepaymentDate=dboutput($rows['RepaymentDate']);
		$Status=dboutput($rows['Status']);
		$LoanRequestID=dboutput($rows['LoanReqID']);
		$LoanType=dboutput($rows['LoanType']);
		$RemainingAmount=dboutput($rows['RemainingAmount']);
		$RepaymentAmount=dboutput($rows['RepaymentAmount']);
		$Company=dboutput($rows['Company']);
		$Month=dboutput($rows['Month']);
		$Added=dboutput($rows['Added']);
		$EmpCode=dboutput($rows['EmpCode']);
		$FirstName=dboutput($rows['FirstName']);
		$LastName=dboutput($rows['LastName']);
		$JoiningDate=dboutput($rows['JoiningDate']);
		$EmpType=dboutput($rows['EmpType']);
		$Reason=dboutput($rows['Reason']);
		$Salary=dboutput($rows['Salary']);
	}
	
	$query = "SELECT Amount FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$EmployeeID." AND Title = 'Annual Bonus Fix Allowance'";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		$rows = mysql_fetch_assoc($result);
		$AnnualBonus = dboutput($rows['Amount']);
	}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Loan Slip</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Color Picker -->
<link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<!-- Bootstrap time Picker -->
<link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<style>
#footer {
	width:100%;
	height:50px;
	background-color:#3c8dbc;
	text-align:center;
	vertical-align:center;
	padding-top:15px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


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
      <h1> Loan Slip</h1>
      <ol class="breadcrumb">
        <li><a href="Loans.php"><i class="fa fa-dashboard"></i>Loans</a></li>
        <li class="active">Loan Slip</li>
      </ol>
    </section>
    <!-- Main content -->
      <section class="content">
       <div class="box-footer no-print" style="text-align:right;">
                <a class="btn btn-primary margin" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Loans.php'">Cancel</button>
            </div>
              <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
		<div class="col-md-12">
          <div class="box box-solid" style="border:1px solid black">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="row">
				
				<div class="col-md-12 col-xs-12" style="text-align:center">
				<h4 style="text-decoration:underline">
				<?php echo $Company; ?>
				</h4>
				<span style="font-size:10px">Suit no. 10 & 11, Ground Floor, Business Avenue, Main Shahra-e-Faisal, Karachi, Pakistan</span>
				<br><br>
				</div>
				
				<div class="col-md-10 col-xs-10 col-md-offset-1 col-xs-offset-1" style="text-align:center; border:2px solid black">
				<span style="font-size:15px; font-weight:bold;">LOAN VOUCHER</span>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				
				
				<div class="col-md-3 col-xs-3">
				Date of Voucher:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php
						echo $Added; //date('d-M-Y');
				?>
				</div>
				<div class="col-md-3 col-xs-3">
				Employee Joining:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%">
				<?php
						echo $JoiningDate.' ('.$EmpType.')';
				?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Voucher No:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php
						echo $ID;
				?>
				</div>
				<div class="col-md-3 col-xs-3">
				Deduction Type:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%">
				Monthly
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				
				<div class="col-md-3 col-xs-3">
				Loan Type:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php echo $LoanType; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				Installment Amount:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%;">
				<?php echo number_format($RepaymentAmount,2); ?>
				</div>
				
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Loan No:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php echo $Code; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				Deduction Start:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%;">
				<?php echo ($RepaymentDate == "" ? 'Not Available' : $RepaymentDate); ?>
				</div>
				
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Employee Code:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php echo $EmpCode; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				Grant Date:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%;">
				<?php echo ($Added == "" ? 'Not Available' : $Added); ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Employee Name:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%;">
				<?php echo $FirstName.' '.$LastName; ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Gross Salary:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%;">
				<?php echo number_format($Salary+$AnnualBonus,2) .' (<span style="font-size:13px;">'.convertNumber(round($Salary+$AnnualBonus )).' Only</span>)'; ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Loan Amount:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%;">
				<?php echo number_format($Amount,2) .' (<span style="font-size:13px;">'.convertNumber(round($Amount )).' Only</span>)'; ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Remarks:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%;">
				<?php echo ($Reason == "" ? 'Not Available' : $Reason); ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Special Remarks:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%;">
				
				<?php
				$queryCompleted = "SELECT DateCompleted FROM loans where EmpID = ".$EmployeeID." AND LoanType = '".$LoanType."' AND Status = 1 ORDER BY ID DESC Limit 1";
				$resCompleted = mysql_query($queryCompleted) or die(mysql_error());
				$CompletedLoans = mysql_num_rows($resCompleted);
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
					
					$date1=date_create($CompletedDate);
					echo 'Last completed '.$LoanType.' date is '.date_format($date1,"d-M-Y");
				}
				else
				{
					echo 'Information not found about completed '.$LoanType;
				}
				?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br><br><br><br><br>
				</div>
				
				<div class="col-md-4 col-xs-4" style="text-align:center">
				<span style="border-top:1px solid black">&emsp;&emsp;H.R. Manager.&emsp;&emsp;</span>
				</div>
				<div class="col-md-4 col-xs-4" style="text-align:center">
				<span style="border-top:1px solid black">&emsp;&ensp;Accounts Manager.&emsp;&ensp;</span>
				</div>
				<div class="col-md-4 col-xs-4" style="text-align:center">
				<span style="border-top:1px solid black">&emsp;&ensp;Audit Manager.&emsp;&ensp;</span>
				</div>
				
				
              <!-- /.box-body -->
            
			  </div>
			</div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
      </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php include_once("Footer.php"); ?>
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<!-- jQuery UI 1.10.3 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app2.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/AdminLTE/demo.js" type="text/javascript"></script>

<script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                });
            });
        </script>
		
		<script>
	$(function(){
	var sidebar = $('.sidebar-menu');  // cache sidebar to a variable for performance

	sidebar.delegate('.treeview','click',function(){ 
	  if($(this).hasClass('active')){
		$(this).removeClass('active');
		sidebar.find('.inactive > .treeview-menu').hide(200);
		sidebar.find('.inactive').removeClass('inactive');
	   $(this).addClass('inactive');
	   $(this).find('.treeview-menu').show(200);
	 }else{
	  sidebar.find('.active').addClass('inactive');          
	  sidebar.find('.active').removeClass('active'); 
	   $(this).Class('treeview-menu').hide(200);
	 }
	});

	});
	
	$(document).click(function (event) {   
    $('.treeview-menu:visible').hide();
	});

	</script>
</body>
</html>
