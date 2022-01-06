<?php
include_once("Common.php");
include("CheckAdminLogin.php");




	$msg="";	
	
	$JoiningDate="";
	$ResignationDate="";
	$LeavingDate="";
	$PreviousSalary=0;
	$RemainingLoan=0;
	$GrandNetPay=0;
	$MonthPayroll="";
	$FromDate="";
	$ToDate="";
	$NumOfDays=0;
	$Gross=0;
	$NetPay=0;
	$Remarks="";
	$Title1="";
	$Title1check=0;
	$Title1amount=0;
	$Title2="";
	$Title2check=0;
	$Title2amount=0;
	$Title3="";
	$Title3check=0;
	$Title3amount=0;
	$Title4="";
	$Title4check=0;
	$Title4amount=0;
	$Title5="";
	$Title5check=0;
	$Title5amount=0;
	$Title6="";
	$Title6check=0;
	$Title6amount=0;
	$Added="";
	$EmployeeID=0;
	$EmpCode="";
	$FirstName="";
	$LastName="";
	$Company="";
	$Designation="";
	$Department="";
	$Location="";
	
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	

	$query="SELECT e.EmpID AS EmpCode,e.FirstName,e.LastName,e.Designation,e.Department,l.Name AS Location,DATE_FORMAT(e.JoiningDate, '%d-%b-%Y') as JoiningDate,DATE_FORMAT(e.ResignationDate, '%d-%b-%Y') as ResignationDate,DATE_FORMAT(e.LeavingDate, '%d-%b-%Y') as LeavingDate,f.ID,f.EmpID,f.Remarks,f.PreviousSalary,f.RemainingLoan,f.GrandNetPay,f.MonthPayroll,f.FromDate,f.ToDate,f.NumOfDays,f.Gross,f.NetPay,f.Title1,f.Title1check,f.Title1amount,f.Title2,f.Title2check,f.Title2amount,f.Title3,f.Title3check,f.Title3amount,f.Title4,f.Title4check,f.Title4amount,f.Title5,f.Title5check,f.Title5amount,f.Title6,f.Title6check,f.Title6amount,DATE_FORMAT(f.DateAdded, '%d-%b-%Y') as Added,c.Name AS Company FROM fullnfinal f LEFT JOIN employees e ON f.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE f.ID='" .(int)$ID . "'";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid FullnFinal ID.</b>
		</div>';
		redirect("FullnFinal.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$JoiningDate=dboutput($rows['JoiningDate']);
		$ResignationDate=dboutput($rows['ResignationDate']);
		$LeavingDate=dboutput($rows['LeavingDate']);
		$PreviousSalary=dboutput($rows['PreviousSalary']);
		$RemainingLoan=dboutput($rows['RemainingLoan']);
		$GrandNetPay=dboutput($rows['GrandNetPay']);
		$MonthPayroll=dboutput($rows['MonthPayroll']);
		$FromDate=dboutput($rows['FromDate']);
		$ToDate=dboutput($rows['ToDate']);
		$NumOfDays=dboutput($rows['NumOfDays']);
		$Gross=dboutput($rows['Gross']);
		$NetPay=dboutput($rows['NetPay']);
		$Remarks=dboutput($rows['Remarks']);
		$Title1=dboutput($rows['Title1']);
		$Title1check=dboutput($rows['Title1check']);
		$Title1amount=dboutput($rows['Title1amount']);
		$Title2=dboutput($rows['Title2']);
		$Title2check=dboutput($rows['Title2check']);
		$Title2amount=dboutput($rows['Title2amount']);
		$Title3=dboutput($rows['Title3']);
		$Title3check=dboutput($rows['Title3check']);
		$Title3amount=dboutput($rows['Title3amount']);
		$Title4=dboutput($rows['Title4']);
		$Title4check=dboutput($rows['Title4check']);
		$Title4amount=dboutput($rows['Title4amount']);
		$Title5=dboutput($rows['Title5']);
		$Title5check=dboutput($rows['Title5check']);
		$Title5amount=dboutput($rows['Title5amount']);
		$Title6=dboutput($rows['Title6']);
		$Title6check=dboutput($rows['Title6check']);
		$Title6amount=dboutput($rows['Title6amount']);
		$Added=dboutput($rows['Added']);
		$EmpCode=dboutput($rows['EmpCode']);
		$FirstName=dboutput($rows['FirstName']);
		$LastName=dboutput($rows['LastName']);
		$Company=dboutput($rows['Company']);
		$Designation=dboutput($rows['Designation']);
		$Department=dboutput($rows['Department']);
		$Location=dboutput($rows['Location']);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>FullnFinal Slip</title>
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
      <h1> FullnFinal Slip</h1>
      <ol class="breadcrumb">
        <li><a href="FullnFinal.php"><i class="fa fa-dashboard"></i>FullnFinal</a></li>
        <li class="active">FullnFinal Slip</li>
      </ol>
    </section>
    <!-- Main content -->
      <section class="content">
       <div class="box-footer no-print" style="text-align:right;">
                <a class="btn btn-primary margin" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                <button class="btn btn-primary margin" type="button" onClick="location.href='FullnFinal.php'">Cancel</button>
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
				
				<div class="col-md-10 col-xs-10 col-md-offset-1 col-xs-offset-1" style="text-align:center; border:2px solid black">
				<span style="font-size:15px; font-weight:bold;">Full & Final Settlement<br><?php echo $FirstName.' '.$LastName.' ('.$EmpCode.')'; ?><br>Designation: <?php echo $Designation; ?> - <?php echo $Department; ?> Department<br>Location: <?php echo $Location; ?></span>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				
				<div class="col-md-3 col-xs-3">
				Date of Voucher:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php
						echo $Added;
				?>
				</div>
				<div class="col-md-3 col-xs-3" style="text-align:center">
				Date of Joining:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%">
				<?php
						echo $JoiningDate;
				?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Business Unit:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php echo $Company; ?>
				</div>
				<div class="col-md-3 col-xs-3" style="text-align:center">
				Date of Resignation:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%">
				<?php
						echo $ResignationDate;
				?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Gross:
				</div>
				<div class="col-md-3 col-xs-3" style="border-bottom:1px solid black">
				<?php echo number_format($Gross,2); ?>
				</div>
				<div class="col-md-3 col-xs-3" style="text-align:center">
				Last Working Date:
				</div>
				<div class="col-md-2 col-xs-2" style="border-bottom:1px solid black; width:20%">
				<?php echo $LeavingDate; ?>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br><br>
				</div>
				
				<div class="col-md-6 col-xs-6">
				<b>Add Particulars</b>
				</div>
				<div class="col-md-3 col-xs-3">
				<b>Month</b>
				</div>
				<div class="col-md-3 col-xs-3">
				<b>Amount</b>
				</div>
				
				<div class="col-md-6 col-xs-6">
				Previous Salaries
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($PreviousSalary,2); ?>
				</div>
				
				<div class="col-md-6 col-xs-6">
				Salary from <?php echo $FromDate; ?> till <?php echo $ToDate; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo $MonthPayroll; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($NetPay,2); ?>
				</div>
				
				<?php if($Title1check == 1 && $Title1amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title1; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title1amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title2check == 1 && $Title2amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title2; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title2amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title3check == 1 && $Title3amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title3; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title3amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title4check == 1 && $Title4amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title4; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title4amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title5check == 1 && $Title5amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title5; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title5amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title6check == 1 && $Title6amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title6; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title6amount,2); ?>
				</div>
				<?php } ?>
				
				<div class="col-md-12 col-xs-12">
				<br><br>
				</div>
				
				<div class="col-md-6 col-xs-6">
				<b>Less Particulars</b>
				</div>
				<div class="col-md-3 col-xs-3">
				<b>Month</b>
				</div>
				<div class="col-md-3 col-xs-3">
				<b>Amount</b>
				</div>
				
				<div class="col-md-6 col-xs-6">
				Remaining Loan
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($RemainingLoan,2); ?>
				</div>
				
				<?php if($Title1check == 2 && $Title1amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title1; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title1amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title2check == 2 && $Title2amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title2; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title2amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title3check == 2 && $Title3amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title3; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title3amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title4check == 2 && $Title4amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title4; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title4amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title5check == 2 && $Title5amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title5; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title5amount,2); ?>
				</div>
				<?php } ?>
				
				<?php if($Title6check == 2 && $Title6amount > 0){ ?>
				<div class="col-md-6 col-xs-6">
				<?php echo $Title6; ?>
				</div>
				<div class="col-md-3 col-xs-3">
				-
				</div>
				<div class="col-md-3 col-xs-3">
				<?php echo number_format($Title6amount,2); ?>
				</div>
				<?php } ?>
				
				<div class="col-md-12 col-xs-12">
				<br><br>
				</div>
				
				<div class="col-md-6 col-xs-6">
				</div>
				<div class="col-md-3 col-xs-3">
				<b>Net Payable</b>
				</div>
				<div class="col-md-3 col-xs-3">
				<b><?php echo number_format($GrandNetPay,2); ?></b>
				</div>
				
				<div class="col-md-12 col-xs-12">
				<br><br>
				</div>
				
				<div class="col-md-3 col-xs-3">
				Remarks:
				</div>
				<div class="col-md-8 col-xs-8" style="border-bottom:1px solid black; width:70%">
				<?php echo $Remarks; ?>
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
