<?php
include_once("Common.php");
include("CheckAdminLogin.php");

    $MyTotalGross = round(gross_plus_anual($_SESSION['UserID']));
	$PolicyDays = 0;
	$PolicyDaysEnglish = "";
	If($MyTotalGross > 30000)
	{
		$PolicyDays = 365;
		$PolicyDaysEnglish = "one year";
	}
	else
	{
		$PolicyDays = 180;
		$PolicyDaysEnglish = "six months";
	}

	$msg="";
	$Code='';
	$LoanType="";
	$DuductionType="";
	$Amount=0;
	$ActualAmount=0;
	$RepaymentAmount=0;
	$RepaymentDate="";
	$Reason="";
	$CanTakeLoan="";
	$Salary="";
	
	$SupervisorEmail="";
	$FirstName="";
	$LastName="";
	$EmpID="";
	
	$Heade='HR Software <do-not-reply@hr-software>';
	$Header='';
	$Subject='Loan Request Information';
	$Content='';
	$ContentType='';
	
	$query = "SELECT e.CanTakeLoan,e.Salary,e.FirstName,e.LastName,e.EmpID,s.EmailAddress FROM employees e LEFT JOIN employees s ON e.Supervisor = s.EmpID where e.ID = ".$_SESSION['UserID']."";
	$res = mysql_query($query);
	$num = mysql_num_rows($res);
	if($num == 1)
	{
		$row = mysql_fetch_array($res);
		
		$CanTakeLoan=$row["CanTakeLoan"];
		$Salary=$row["Salary"];
		$Amount = $Salary*3;
		
		$SupervisorEmail=$row["EmailAddress"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$EmpID=$row["EmpID"];
	}
	else
	{
		$CanTakeLoan="No";
	}
	
	$get_max_details = mysql_query("SELECT * FROM loan_requests ORDER BY ID DESC LIMIT 1")
	or die(mysql_error());
	$row = mysql_fetch_array($get_max_details);
	$last_query = $row['ID'];
	if ($last_query ==  0) {$last_query1 = 0;} else {$last_query1 = $last_query;}
	$i = $last_query1;
	$i++;
	$Code = "LR-".str_pad($i,5,"0",STR_PAD_LEFT);
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
		if(isset($_POST["LoanType"]))
			$LoanType=trim($_POST["LoanType"]);
		if(isset($_POST["DuductionType"]))
			$DuductionType=trim($_POST["DuductionType"]);
		if(isset($_POST["Amount"]))
			$Amount=trim($_POST["Amount"]);
		if(isset($_POST["ActualAmount"]))
			$ActualAmount=trim($_POST["ActualAmount"]);
		if(isset($_POST["RepaymentAmount"]))
			$RepaymentAmount=trim($_POST["RepaymentAmount"]);
		if(isset($_POST["RepaymentDate"]))
			$RepaymentDate=trim($_POST["RepaymentDate"]);
		if(isset($_POST["Reason"]))
			$Reason=trim($_POST["Reason"]);
		
		$query = "SELECT ID FROM loans where EmpID = ".$_SESSION['UserID']." AND LoanType = '".$LoanType."' AND Status <> 1";
		$res = mysql_query($query) or die(mysql_error());
		$AllowThisLoan = mysql_num_rows($res);
		
		$queryCompleted = "SELECT DateCompleted FROM loans where EmpID = ".$_SESSION['UserID']." AND LoanType = '".$LoanType."' AND Status = 1 ORDER BY ID DESC Limit 1";
		$resCompleted = mysql_query($queryCompleted) or die(mysql_error());
		$CompletedLoans = mysql_num_rows($resCompleted);
		$num_of_days = $PolicyDays;
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
			
			$TodaysDate = date("Y-m-d");
			
			$date1=date_create($CompletedDate);
			$date2=date_create($TodaysDate);
			$diff=date_diff($date1,$date2);
			$num_of_days = $diff->format("%a");
			$num_of_days = $num_of_days + 1;
			
		}
		
		
		if($CanTakeLoan != "Yes")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>You dont have rights to proceed this request.</b>
			</div>';
		}
		else if($AllowThisLoan > 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>You already take a '.$LoanType.'.</b>
			</div>';
		}
		else if($num_of_days < $PolicyDays)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>The eligibility criteria for '.$LoanType.' is '.$PolicyDaysEnglish.' which has not been completed. Last Completed Date is ('.date_format($date1,"d-M-Y").')</b>
			</div>';
		}
		else if($Amount == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please enter Loan Amount.</b>
			</div>';
		}
		else if(($Amount*$Salary) == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please Check Your Salary.</b>
			</div>';
		}
		else if($Amount > (3*$Salary))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Your loan limit is exceeded. Maximum allowed to you '.(3*$Salary).'</b>
			</div>';
		}
		else if($RepaymentAmount == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please enter Installment Amount.</b>
			</div>';
		}
		else if($RepaymentAmount > $Amount)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Your Installment Amount is greater then loan amount.</b>
			</div>';
		}
		else if($RepaymentDate == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please select Disbursement Date.</b>
			</div>';
		}
		else if($Reason == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please enter loan reason.</b>
			</div>';
		}
		
		


	if($msg=="")
	{

		$query="INSERT INTO loan_requests SET 
				EmpID = '" . dbinput($_SESSION['UserID']) . "',
				Code = '".dbinput($Code)."',
				NotificationTo = 'HR',
				LoanType = '" . dbinput($LoanType) . "',
				DuductionType = '" . dbinput($DuductionType) . "',
				Amount = '" . $Amount . "',
				ActualAmount = '" . $ActualAmount . "',
				RepaymentAmount = '" . $RepaymentAmount . "',
				RepaymentDate = '" . dbinput($RepaymentDate) . "',
				Reason = '" . dbinput($Reason) . "',
				DateAdded = NOW()";
		mysql_query($query) or die (mysql_error());
		$ID = mysql_insert_id();
		
		if($SupervisorEmail != "")
		{
		//EMAIL TO SUPERVISOR
		$Header = "From: " . strip_tags($Heade) . "\r\n";
		$Header .= "Reply-To: ". strip_tags($Heade) . "\r\n";
		$Header .= "MIME-Version: 1.0\r\n";
		$Header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$Content = '<h1>Loan Request Details:</h1><br><b>Request Code:</b> '.$Code.'<br><b>Name:</b> '.$FirstName.' '.$LastName.' ('.$EmpID.')<br><b>Loan Type:</b> '.$LoanType.'<br><b>Amount:</b> '.number_format($Amount,2).' ('.convertNumber(round($Amount)).')<br>'.($ActualAmount > 0 ? '<b>Actual Amount:</b> '.number_format($ActualAmount,2).' ('.convertNumber(round($ActualAmount)).')<br>' : '').'<b>Reason:</b> '.$Reason.'<br><b>Date:</b> '.date('d M Y');
		
		//echo $Content; exit();
		
		$mail = @mail($SupervisorEmail,$Subject,$Content,$Header);
		}
		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Loan request has been proceed.</b>
		</div>';		
		
		redirect("GetLoan.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Get Loan</title>
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
      <h1> Get Loan</h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Get Loan</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Apply</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='MyLoanRequests.php'">Cancel</button>
            </div>
              <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
        <div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
                  <label id="labelimp" >Tran #: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$Code.'" />';
				?>
                </div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="LoanType">Loan Type:<span class="requiredStar">*</span> </label>
				<select name="LoanType" class="form-control">
				<?php
				$query = "SELECT Name FROM loantypes where Status = 1 ORDER BY Name ASC";
				$res = mysql_query($query);
				while($row = mysql_fetch_array($res))
				{
				echo '<option '.($LoanType == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
				} 
				?>
				</select>
                </div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="DuductionType">Duduction Period:<span class="requiredStar">*</span> </label>
				<select name="DuductionType" class="form-control">
				<option <?php echo ($DuductionType == "Monthly" ? 'selected' : ''); ?> value="Monthly">Monthly</option>
				</select>
                </div>
				
				
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
					<label id="labelimp" for="Amount">Loan Amount:<span class="requiredStar">*</span></label>
						<input type="number" name="Amount" autocomplete="off" value="<?php echo $Amount; ?>" class="form-control" id="Amount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="ActualAmount">Actual Loan Amount:</label>
						<input type="number" name="ActualAmount" autocomplete="off" value="<?php echo $ActualAmount; ?>" class="form-control" id="ActualAmount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="RepaymentAmount">Installment Amount:<span class="requiredStar">*</span></label>
						<input type="number" name="RepaymentAmount" autocomplete="off" value="<?php echo $RepaymentAmount; ?>" class="form-control" id="RepaymentAmount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="RepaymentDate">Disbursement Date:<span class="requiredStar">*</span></label>
						<input type="date" name="RepaymentDate" autocomplete="off" value="<?php echo $RepaymentDate; ?>" class="form-control" id="RepaymentDate"/>
				</div><!-- /.form group -->
				
				
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Reason">Reason:<span class="requiredStar">*</span> </label>
                  <?php 
					echo '<textarea rows="9" maxlength="1000" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
				  ?>
                </div>
				
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		
      </section>
    </form>
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
