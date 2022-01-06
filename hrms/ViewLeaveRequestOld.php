<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$Type="";
	$NumOfDays=0;
	$FromDate=0;
	$ToDate="";
	$Reason="";
	$EmployeeID="";
	$EmpID="";
	$FirstName="";
	$LastName="";
	$DisapprovedRemarks="";
	$Approval=1;
	$LeaveType="";
	$LeaveNOD=0;
	$LeaveSender=0;
	$LeaveStartFrom="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
		if(isset($_POST["Approval"]))
			$Approval=trim($_POST["Approval"]);
		if(isset($_POST["DisapprovedRemarks"]))
			$DisapprovedRemarks=trim($_POST["DisapprovedRemarks"]);
		if(isset($_POST["LeaveType"]))
			$LeaveType=trim($_POST["LeaveType"]);
		if(isset($_POST["LeaveNOD"]))
			$LeaveNOD=trim($_POST["LeaveNOD"]);
		if(isset($_POST["LeaveSender"]))
			$LeaveSender=trim($_POST["LeaveSender"]);
		if(isset($_POST["LeaveStartFrom"]))
			$LeaveStartFrom=trim($_POST["LeaveStartFrom"]);
		
		
		
		
		if($Approval == 2)
		{
			if($DisapprovedRemarks == "")
			{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please enter Disapprove Remarks.</b>
				</div>';
			}
		}
		
		
		


	if($msg=="")
	{
		
		if($Approval == 2)
		{
		
			$query="UPDATE leave_approvals SET 
				Approval = '".(int)$Approval."',
				DisapprovedRemarks = '" . dbinput($DisapprovedRemarks) . "' WHERE ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
			$ID = mysql_insert_id();
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Leave request has been updated.</b>
			</div>';		
			
			redirect("LeaveRequests.php");
		
		}
		else
		{
			$query="UPDATE leave_approvals SET Approval = '".(int)$Approval."', DisapprovedRemarks = '" . dbinput($DisapprovedRemarks) . "' WHERE ID='" . (int)$ID . "'";
			mysql_query($query) or die (mysql_error());
			
			$query="UPDATE current_leaves_quota SET ".$LeaveType." = ".$LeaveType." - ".$LeaveNOD." WHERE EmpID='" . (int)$LeaveSender . "'";
			mysql_query($query) or die (mysql_error());
			
			$query="DELETE from leave_approvals WHERE Approval = 0 AND Sender='" . (int)$LeaveSender . "'";
			mysql_query($query) or die (mysql_error());
				
				$d = $LeaveStartFrom;
				for($i=1; $i<=$LeaveNOD; $i++)
				{
					$query="INSERT INTO minus_leaves_quota SET 
						EmpID = '" . (int)$LeaveSender . "',
						LeaveType = '" . dbinput($LeaveType) . "',
						LeaveDate = '" . dbinput($d) . "'";
						mysql_query($query) or die (mysql_error());
					
					$d=strtotime("+1 Day", strtotime($d));
					$d=date("Y-m-d", $d);
				}
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Leave request has been updated.</b>
			</div>';		
			
			redirect("LeaveRequests.php");
		}
	}
		

}
else
{
	$query="SELECT l.ID,l.Sender,l.Reason,l.Approval,l.DisapprovedRemarks,l.NumOfDays,l.Type,l.FromDate AS LeaveStartFrom,DATE_FORMAT(l.FromDate, '%D %b %Y') AS FromDate,DATE_FORMAT(l.ToDate, '%D %b %Y') AS ToDate,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Added
	FROM leave_approvals l LEFT JOIN employees e ON l.Sender = e.ID WHERE  l.ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Leave Request ID.</b>
		</div>';
		redirect("LeaveRequests.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$Approval=dboutput($rows['Approval']);
		$EmpID=dboutput($rows['EmpID']);
		$FirstName=dboutput($rows['FirstName']);
		$LastName=dboutput($rows['LastName']);
		$Type=dboutput($rows['Type']);
		$NumOfDays=dboutput($rows['NumOfDays']);
		$FromDate=dboutput($rows['FromDate']);
		$ToDate=dboutput($rows['ToDate']);
		$Reason=dboutput($rows['Reason']);
		$DisapprovedRemarks=dboutput($rows['DisapprovedRemarks']);
		$LeaveSender=dboutput($rows['Sender']);
		$LeaveStartFrom=dboutput($rows['LeaveStartFrom']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Leave Request</title>
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
      <h1> View Leave Request</h1>
      <ol class="breadcrumb">
        <li><a href="LeaveRequests.php"><i class="fa fa-dashboard"></i>Leave Requests</a></li>
        <li class="active">View Leave Request</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='LeaveRequests.php'">Cancel</button>
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
                  <label id="labelimp" >Leave Type: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$Type.'" />';
				echo '<input type="hidden" class="form-control" name="LeaveType" value="'.$Type.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Num Of Days: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$NumOfDays.'" />';
				echo '<input type="hidden" class="form-control" name="LeaveNOD" value="'.$NumOfDays.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >From Date: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$FromDate.'" />';
				echo '<input type="hidden" class="form-control" name="LeaveStartFrom" value="'.$LeaveStartFrom.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >To Date: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$ToDate.'" />';
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
                  <label id="labelimp" >Employee: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$EmpID.' | '.$FirstName.' '.$LastName.'" />';
				?>
				<input type="hidden" name="EmployeeID" value="<?php echo $EmployeeID; ?>" />
				<input type="hidden" name="LeaveSender" value="<?php echo $LeaveSender; ?>" />
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
				  <input type="radio" name="Approval" value="1"<?php echo ($Approval == "1" ? ' checked="checked"' : ''); ?>>
				  Approve</label>
				  <label>
				  <input <?php if($Approval == 1){echo 'disabled';} ?> type="radio" name="Approval" value="2"<?php echo ($Approval == "2" ? ' checked="checked"' : ''); ?>>
				  DisApprove</label>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="DisapprovedRemarks">Disapprove Reason / Remarks: </label>
                  <?php 
					echo '<textarea rows="9" maxlength="1000" id="DisapprovedRemarks" name="DisapprovedRemarks" class="form-control">'.$DisapprovedRemarks.'</textarea>';
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
