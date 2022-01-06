<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$Type="";
	$Reason="";
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["Type"]))
		$Type=trim($_POST["Type"]);
	if(isset($_POST["Reason"]))
		$Reason=trim($_POST["Reason"]);

	if($Reason == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Please type reason.</b>
		</div>';
	}
		

	if($msg=="")
	{
		if($Type == "SpecialLeave")
		{
			if(isset($_SESSION["GrantLeave"]) && is_array($_SESSION["GrantLeave"]))
			{
				foreach($_SESSION["GrantLeave"] as $GL)
				{
				$query = "SELECT Status FROM roster_login_history WHERE ID IN (" . $GL . ")";
				$result = mysql_query($query) or die (mysql_error());
				$num = mysql_num_rows($result);
				
				if($num > 0)
				{
					$row = mysql_fetch_array($result);
					if($row['Status'] == "Absent")
					{
						$query2="UPDATE roster_login_history SET Status = 'Leave', MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
						mysql_query($query2) or die (mysql_error());
					}
				}
				
				}
			}
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Grant All selected Special Leaves.</b>
			</div>';
			redirect("AttendanceLedger.php");
		}
		else if($Type == "Auto")
		{
			if(isset($_SESSION["GrantLeave"]) && is_array($_SESSION["GrantLeave"]))
			{
				foreach($_SESSION["GrantLeave"] as $GL)
				{
				$query = "SELECT UserID,HalfDay,Status,LoginDate FROM roster_login_history WHERE ID IN (" . $GL . ")";
				$result = mysql_query($query) or die (mysql_error());
				$num = mysql_num_rows($result);
				
				if($num > 0)
				{
					$row = mysql_fetch_array($result);
					if($row['Status'] == "Absent")
					{
						$query3 = "SELECT AnualLeaves,SickLeaves,CasualLeaves FROM current_leaves_quota WHERE EmpID = " . $row['UserID'] . "";
						$result3 = mysql_query($query3) or die (mysql_error());
						$num3 = mysql_num_rows($result3);
						
						if($num3 > 0)
						{
							$row3 = mysql_fetch_array($result3);
							
							if($row3['CasualLeaves'] > 0.9)
							{
								$query2="UPDATE roster_login_history SET Status = 'Leave', MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'CasualLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET CasualLeaves = (CasualLeaves - 1) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else if($row3['SickLeaves'] > 0.9)
							{
								$query2="UPDATE roster_login_history SET Status = 'Leave', MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'SickLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET SickLeaves = (SickLeaves - 1) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else if($row3['AnualLeaves'] > 0.9)
							{
								$query2="UPDATE roster_login_history SET Status = 'Leave', MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'AnualLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET AnualLeaves = (AnualLeaves - 1) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else
							{
								$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Not Granted All selected Leaves.</b>
								</div>';
							}
						}
						else
						{
							$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<b>Not Granted All selected Leaves.</b>
							</div>';
						}
						
					}
					else if($row['HalfDay'] == 1)
					{
						$query3 = "SELECT AnualLeaves,SickLeaves,CasualLeaves FROM current_leaves_quota WHERE EmpID = " . $row['UserID'] . "";
						$result3 = mysql_query($query3) or die (mysql_error());
						$num3 = mysql_num_rows($result3);
						
						if($num3 > 0)
						{
							$row3 = mysql_fetch_array($result3);
							
							if($row3['CasualLeaves'] > 0.4)
							{
								$query2="UPDATE roster_login_history SET  HalfDay = 0, MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'CasualLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET CasualLeaves = (CasualLeaves - 0.5) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else if($row3['SickLeaves'] > 0.4)
							{
								$query2="UPDATE roster_login_history SET HalfDay = 0, MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'SickLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET SickLeaves = (SickLeaves - 0.5) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else if($row3['AnualLeaves'] > 0.4)
							{
								$query2="UPDATE roster_login_history SET HalfDay = 0, MStatus='".$Reason."' WHERE ID='" . (int)$GL . "'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="INSERT INTO minus_leaves_quota SET EmpID = " . $row['UserID'] . ", LeaveDate='".$row['LoginDate']."',
								LeaveType = 'AnualLeaves'";
								mysql_query($query2) or die (mysql_error());
								
								$query2="UPDATE current_leaves_quota SET AnualLeaves = (AnualLeaves - 0.5) WHERE EmpID = " . $row['UserID'] . "";
								mysql_query($query2) or die (mysql_error());
								
								$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Grant All selected Leaves.</b>
								</div>';
							}
							else
							{
								$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Not Granted All selected Leaves.</b>
								</div>';
							}
							
						}
						else
						{
							$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<b>Not Granted All selected Leaves.</b>
							</div>';
						}
					}
					else
					{
						$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>Not Granted All selected Leaves.</b>
						</div>';
					}
				}
				
				}
			}
			redirect("AttendanceLedger.php");
		}	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Grant Leave</title>
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
      <h1> Grant Leave</h1>
      <ol class="breadcrumb">
        <li><a href="AttendanceLedger.php"><i class="fa fa-dashboard"></i>Attendance Ledger</a></li>
        <li class="active">Grant Leave</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='AttendanceLedger.php'">Cancel</button>
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
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="Type">Leave Type: </label>
				<select name="Type" class="form-control">
				<option <?php echo ($Type == "Auto" ? 'selected' : ''); ?> value="Auto">Auto Adjust</option>
				<option <?php echo ($Type == "SpecialLeave" ? 'selected' : ''); ?> value="SpecialLeave">Special Leave</option>
				</select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Reason">Reason:<span class="requiredStar">*</span> </label>
                  <?php 
					echo '<textarea rows="5" maxlength="500" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
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
</body>
</html>
