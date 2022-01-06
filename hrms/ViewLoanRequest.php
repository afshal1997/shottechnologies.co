<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$Code='';
	$LoanType="";
	$DuductionType="";
	$Amount=0;
	$ActualAmount=0;
	$RepaymentAmount=0;
	$RepaymentDate="";
	$DeductionDate="";
	$Reason="";
	$Photo="";
	$EmployeeID="";
	$EmpID="";
	$FirstName="";
	$LastName="";
	$DisapproveReason="";
	$Approved=1;
	$LoanGranted = 0;
	$CanTakeLoan="";
	$Salary="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
		if(isset($_POST["Approved"]))
			$Approved=trim($_POST["Approved"]);
		if(isset($_POST["DisapproveReason"]))
			$DisapproveReason=trim($_POST["DisapproveReason"]);
		if(isset($_POST["EmployeeID"]))
			$EmployeeID=trim($_POST["EmployeeID"]);
		if(isset($_POST["LoanType"]))
			$LoanType=trim($_POST["LoanType"]);
		if(isset($_POST["DuductionType"]))
			$DuductionType=trim($_POST["DuductionType"]);
		if(isset($_POST["Amount"]))
			$Amount=trim($_POST["Amount"]);
		if(isset($_POST["RepaymentAmount"]))
			$RepaymentAmount=trim($_POST["RepaymentAmount"]);
		if(isset($_POST["RepaymentDate"]))
			$RepaymentDate=trim($_POST["RepaymentDate"]);
		if(isset($_POST["DeductionDate"]))
			$DeductionDate=trim($_POST["DeductionDate"]);
		
		$query = "SELECT CanTakeLoan,Salary FROM employees where ID = ".$EmployeeID."";
		$res = mysql_query($query);
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$row = mysql_fetch_array($res);
			
			$CanTakeLoan=$row["CanTakeLoan"];
			$Salary=$row["Salary"];
			
		}
		else
		{
			$CanTakeLoan="No";
		}
		
		$query = "SELECT ID FROM loans where EmpID = ".$EmployeeID." AND LoanType = '".$LoanType."' AND IsCompleted = 0";
		$res = mysql_query($query) or die(mysql_error());
		$AllowThisLoan = mysql_num_rows($res);
		
		
		if($Approved == 2)
		{
			if($DisapproveReason == "")
			{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please enter Disapprove Reason.</b>
				</div>';
			}
		}
		else
		{
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
			else if($DeductionDate == "")
			{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please select Deduction Start Date.</b>
				</div>';
			}
		}
		
		
		


	if($msg=="")
	{
		
		if($Approved == 2)
		{
		
			$query="UPDATE loan_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = '".(int)$Approved."',
				DisapproveReason = '" . dbinput($DisapproveReason) . "',
				DateModified = NOW() WHERE ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
			$ID = mysql_insert_id();
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Loan request has been updated.</b>
			</div>';		
			
			redirect("LoanRequests.php");
		
		}
		else
		{
			$query="UPDATE loan_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = '".(int)$Approved."',
				LoanGranted = 1,
				DisapproveReason = '" . dbinput($DisapproveReason) . "',
				DateModified = NOW() WHERE ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
			
			$get_max_details = mysql_query("SELECT * FROM loans ORDER BY ID DESC LIMIT 1")
			or die(mysql_error());
			$row = mysql_fetch_array($get_max_details);
			$last_query = $row['ID'];
			if ($last_query ==  0) {$last_query1 = 0;} else {$last_query1 = $last_query;}
			$i = $last_query1;
			$i++;
			$Code = "L-".str_pad($i,5,"0",STR_PAD_LEFT);
			
			$query="INSERT INTO loans SET 
				EmpID = '" . dbinput($EmployeeID) . "',
				LoanReqID = '" . dbinput($ID) . "',
				Code = '".dbinput($Code)."',
				Status = 0,
				LoanType = '" . dbinput($LoanType) . "',
				DuductionType = '" . dbinput($DuductionType) . "',
				Amount = '" . $Amount . "',
				RepaymentAmount = '" . $RepaymentAmount . "',
				RemainingAmount = '" . $Amount . "',
				RepaymentDate = '" . dbinput($DeductionDate) . "',
				DisbursementDate = '" . dbinput($RepaymentDate) . "',
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				DateAdded = NOW()";
			mysql_query($query) or die (mysql_error());
			$ID = mysql_insert_id();

			$startdate=strtotime($DeductionDate);
			
			for($i = $Amount ; $i > 0 ; $i = $i - $RepaymentAmount)
			{				
				
				$query="INSERT INTO loans_schedule SET 
					EmpID = '" . dbinput($EmployeeID) . "',
					LoanID = '" . dbinput($ID) . "',
					Amount = '" . ($i >= $RepaymentAmount ? $RepaymentAmount : $i) . "',
					RepaymentDate = '" . date("Y-m-d", $startdate) . "',
					ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
					DateAdded = NOW()";
				mysql_query($query) or die (mysql_error());
				
				$startdate = strtotime("+1 month", $startdate);
			}
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Loan request has been updated.</b>
			</div>';		
			
			redirect("LoanRequests.php");
		}
	}
		

}
else
{
	$query="SELECT l.ID,l.Code,l.Approved,l.EmpID AS EmployeeID,l.DisapproveReason,l.LoanGranted,e.EmpID,e.FirstName,e.LastName,l.DuductionType,l.LoanType,l.Amount,l.ActualAmount,l.RepaymentAmount,l.RepaymentDate,l.Reason FROM loan_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE  l.ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Loan Request ID.</b>
		</div>';
		redirect("LoanRequests.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$Code=dboutput($rows['Code']);
		$Approved=dboutput($rows['Approved']);
		$EmployeeID=dboutput($rows['EmployeeID']);
		$EmpID=dboutput($rows['EmpID']);
		$FirstName=dboutput($rows['FirstName']);
		$LastName=dboutput($rows['LastName']);
		$LoanType=dboutput($rows['LoanType']);
		$DuductionType=dboutput($rows['DuductionType']);
		$Amount=dboutput($rows['Amount']);
		$ActualAmount=dboutput($rows['ActualAmount']);
		$RepaymentAmount=dboutput($rows['RepaymentAmount']);
		$RepaymentDate=dboutput($rows['RepaymentDate']);
		$Reason=dboutput($rows['Reason']);
		$LoanGranted=dboutput($rows['LoanGranted']);
		$DisapproveReason=dboutput($rows['DisapproveReason']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Loan Request</title>
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
      <h1> View Loan Request</h1>
      <ol class="breadcrumb">
        <li><a href="LoanRequests.php"><i class="fa fa-dashboard"></i>Loan Requests</a></li>
        <li class="active">View Loan Request</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='LoanRequests.php'">Cancel</button>
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
                <label id="labelimp" class="labelimp" for="LoanType">Loan Type: </label>
				<select disabled name="LoanType" class="form-control">
				<option <?php echo ($LoanType == "Company Loan" ? 'selected' : ''); ?> value="Company Loan">Company Loan</option>
				<option <?php echo ($LoanType == "Car Loan" ? 'selected' : ''); ?> value="Car Loan">Car Loan</option>
				</select>
				<input type="hidden" name="LoanType" value="<?php echo $LoanType; ?>" />
                </div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="DuductionType">Duduction Period: </label>
				<select disabled name="DuductionType" class="form-control">
				<option <?php echo ($DuductionType == "Monthly" ? 'selected' : ''); ?> value="Monthly">Monthly</option>
				</select>
				<input type="hidden" name="DuductionType" value="<?php echo $DuductionType; ?>" />
                </div>
				
				<div class="form-group">
					<label id="labelimp" for="Amount">Loan Amount:</label>
						<input type="number" name="Amount" autocomplete="off" value="<?php echo $Amount; ?>" class="form-control" id="Amount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="ActualAmount">Actual Loan Amount:</label>
						<input disabled type="number" name="ActualAmount" autocomplete="off" value="<?php echo $ActualAmount; ?>" class="form-control" id="ActualAmount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="RepaymentAmount">Installment Amount:</label>
						<input type="number" name="RepaymentAmount" autocomplete="off" value="<?php echo $RepaymentAmount; ?>" class="form-control" id="RepaymentAmount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="RepaymentDate">Disbursement Date:</label>
						<input type="date" name="RepaymentDate" autocomplete="off" value="<?php echo $RepaymentDate; ?>" class="form-control" id="RepaymentDate"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp"  for="DeductionDate">Deduction Start Date:</label>
						<input <?php if($LoanGranted == 1){echo 'disabled';} ?> type="date" name="DeductionDate" autocomplete="off" value="<?php echo $DeductionDate; ?>" class="form-control" id="DeductionDate"/>
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
                  <label id="labelimp" >Employee: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$EmpID.' | '.$FirstName.' '.$LastName.'" />';
				?>
				<input type="hidden" name="EmployeeID" value="<?php echo $EmployeeID; ?>" />
                </div>
				
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Reason">Reason: </label>
                  <?php 
					echo '<textarea disabled rows="9" maxlength="1000" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
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
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" >Approval: </label>
				  <label>
				  <input type="radio" name="Approved" value="1"<?php echo ($Approved == "1" ? ' checked="checked"' : ''); ?>>
				  Approve</label>
				  <label>
				  <input <?php if($LoanGranted == 1){echo 'disabled';} ?> type="radio" name="Approved" value="2"<?php echo ($Approved == "2" ? ' checked="checked"' : ''); ?>>
				  DisApprove</label>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="DisapproveReason">Disapprove Reason / Remarks: </label>
                  <?php 
					echo '<textarea rows="9" maxlength="1000" id="DisapproveReason" name="DisapproveReason" class="form-control">'.$DisapproveReason.'</textarea>';
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
