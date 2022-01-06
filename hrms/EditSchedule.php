<?php
include_once("Common.php");
include("CheckAdminLogin.php");

if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
{}else{redirect("Dashboard.php");}	

	
	$msg="";
	$Name="";
	$Status=1;
	$DayNight=0;
	$ArrivalTime="";
	$DepartTime="";
	$LateArrival="";
	$EarlyDepart="";
	$ArrivalHalfDay="";
	$DepartHalfDay="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);
	if(isset($_POST["Status"]) && ((int)$_POST["Status"] == 0 || (int)$_POST["Status"] == 1))
		$Status=trim($_POST["Status"]);	
	if(isset($_POST["DayNight"]) && ((int)$_POST["DayNight"] == 0 || (int)$_POST["DayNight"] == 1))
		$DayNight=trim($_POST["DayNight"]);	
	if(isset($_POST["ArrivalTime"]))
		$ArrivalTime=trim($_POST["ArrivalTime"]);
	if(isset($_POST["DepartTime"]))
		$DepartTime=trim($_POST["DepartTime"]);
	if(isset($_POST["LateArrival"]))
		$LateArrival=trim($_POST["LateArrival"]);
	if(isset($_POST["EarlyDepart"]))
		$EarlyDepart=trim($_POST["EarlyDepart"]);
	if(isset($_POST["ArrivalHalfDay"]))
		$ArrivalHalfDay=trim($_POST["ArrivalHalfDay"]);
	if(isset($_POST["DepartHalfDay"]))
		$DepartHalfDay=trim($_POST["DepartHalfDay"]);
	
	if($Name == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Schedule Name.</b>
		</div>';
	}
		
	
	if($msg=="")
	{
		
			$query="UPDATE schedules SET DateModified=NOW(),
			Name = '" . dbinput($Name) . "',
			Status='".(int)$Status . "',
			DayNight='".(int)$DayNight . "',
			ArrivalTime = '" . time_format_gracetime($ArrivalTime) . "',
			DepartTime = '" . time_format_gracetime($DepartTime) . "',
			LateArrival = '" . time_format_gracetime($LateArrival) . "',
			EarlyDepart = '" . time_format_gracetime($EarlyDepart) . "',
			ArrivalHalfDay = '" . time_format_gracetime($ArrivalHalfDay) . "',
			DepartHalfDay = '" . time_format_gracetime($DepartHalfDay) . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Schedule has been Updated.</b>
			</div>';
		
		
			
		
			
	}

}
else
{
	$query="SELECT ID,Status,DayNight,Name,ArrivalTime,DepartTime,LateArrival,EarlyDepart,ArrivalHalfDay,DepartHalfDay FROM schedules WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Schedule ID.</b>
		</div>';
		redirect("Schedules.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Name=$row["Name"];
		$Status=$row["Status"];
		$DayNight=$row["DayNight"];
		$ArrivalTime=$row["ArrivalTime"];
		$DepartTime=$row["DepartTime"];
		$LateArrival=$row["LateArrival"];
		$EarlyDepart=$row["EarlyDepart"];
		$ArrivalHalfDay=$row["ArrivalHalfDay"];
		$DepartHalfDay=$row["DepartHalfDay"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Schedule</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="internetfiles/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="internetfiles/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="internetfiles/ionicons.min.css" rel="stylesheet" type="text/css" />
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
          <script src="internetfiles/html5shiv.js"></script>
          <script src="internetfiles/respond.min.js"></script>
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
      <h1>Edit Schedule</h1>
      <ol class="breadcrumb">
        <li><a href="Schedules.php"><i class="fa fa-dashboard"></i>Schedules</a></li>
        <li class="active">Edit Schedule</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Schedules.php'">Cancel</button>
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Schedule Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Name">Schedule Name: </label>
				  <?php 
				echo '<input type="text" maxlength="100" id="Name" name="Name" class="form-control"  value="'.$Name.'" />';
				?>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" >Day Night: </label>
				  <label>
				  <input type="radio" name="DayNight" value="0"<?php echo ($DayNight == 0 ? ' checked="checked"' : ''); ?>>
				  Day</label>
				  <label>
				  <input type="radio" name="DayNight" value="1"<?php echo ($DayNight == 1 ? ' checked="checked"' : ''); ?>>
				  Night</label>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" >Status: </label>
				  <label>
				  <input type="radio" name="Status" value="1"<?php echo ($Status == 1 ? ' checked="checked"' : ''); ?>>
				  Active</label>
				  <label>
				  <input type="radio" name="Status" value="0"<?php echo ($Status == 0 ? ' checked="checked"' : ''); ?>>
				  Deactive</label>
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Arrival Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="ArrivalTime">Time To Arrive:</label>
							<input type="text" name="ArrivalTime" id="ArrivalTime" <?php echo 'value="'.revert_time_format_gracetime($ArrivalTime).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="LateArrival">Grace Time To Late Arrive:</label>
							<input type="text" name="LateArrival" id="LateArrival" <?php echo 'value="'.revert_time_format_gracetime($LateArrival).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="ArrivalHalfDay">Arrive Half Day:</label>
							<input type="text" name="ArrivalHalfDay" id="ArrivalHalfDay" <?php echo 'value="'.revert_time_format_gracetime($ArrivalHalfDay).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Depart Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="DepartHalfDay">Depart Half Day:</label>
							<input type="text" name="DepartHalfDay" id="DepartHalfDay" <?php echo 'value="'.revert_time_format_gracetime($DepartHalfDay).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
			  
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="EarlyDepart">Grace Time To Early Depart:</label>
							<input type="text" name="EarlyDepart" id="EarlyDepart" <?php echo 'value="'.revert_time_format_gracetime($EarlyDepart).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="DepartTime">Time To Depart:</label>
							<input type="text" name="DepartTime" id="DepartTime" <?php echo 'value="'.revert_time_format_gracetime($DepartTime).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
                $('#reservation').daterangepicker();
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
