<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	
if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
{}else{redirect("Dashboard.php");}		
	
	$msg="";
	$Name="";
	$ApplyAfter=0;
	$Status=1;
	$OTHourType="";
	$OTHourBase="";
	$OTHourValue=0;
	$OTHolidayType="";
	$OTHolidayBase="";
	$OTHolidayValue=0;
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);
	if(isset($_POST["ApplyAfter"]))
		$ApplyAfter=trim($_POST["ApplyAfter"]);
	if(isset($_POST["Status"]) && ((int)$_POST["Status"] == 0 || (int)$_POST["Status"] == 1))
		$Status=trim($_POST["Status"]);	
	if(isset($_POST["OTHourType"]))
		$OTHourType=trim($_POST["OTHourType"]);
	if(isset($_POST["OTHourBase"]))
		$OTHourBase=trim($_POST["OTHourBase"]);
	if(isset($_POST["OTHourValue"]) && ctype_digit($_POST['OTHourValue']))
		$OTHourValue=trim($_POST["OTHourValue"]);
	if(isset($_POST["OTHolidayType"]))
		$OTHolidayType=trim($_POST["OTHolidayType"]);
	if(isset($_POST["OTHolidayBase"]))
		$OTHolidayBase=trim($_POST["OTHolidayBase"]);
	if(isset($_POST["OTHolidayValue"]) && ctype_digit($_POST['OTHolidayValue']))
		$OTHolidayValue=trim($_POST["OTHolidayValue"]);
	
	if($Name == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Overtime Policy Name.</b>
		</div>';
	}
	else if($OTHourType == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please select Overtime Hour Type.</b>
		</div>';
	}
	else if($OTHourBase == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please select Overtime Hour Base On.</b>
		</div>';
	}
	else if($OTHourValue == 0)
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Overtime Hour Value.</b>
		</div>';
	}
	else if($OTHolidayType == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please select Overtime Holiday Type.</b>
		</div>';
	}
	else if($OTHolidayBase == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please select Overtime Holiday Base On.</b>
		</div>';
	}
	else if($OTHolidayValue == 0)
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Overtime Holiday Value.</b>
		</div>';
	}
		
	
	if($msg=="")
	{
		
			$query="UPDATE overtime_policies SET DateModified=NOW(),
			Name = '" . dbinput($Name) . "',
			ApplyAfter='".(int)$ApplyAfter . "',
			Status='".(int)$Status . "',
			OTHourType = '" . dbinput($OTHourType) . "',
			OTHourBase = '" . dbinput($OTHourBase) . "',
			OTHourValue = '" . (int)$OTHourValue . "',
			OTHolidayType = '" . dbinput($OTHolidayType) . "',
			OTHolidayBase = '" . dbinput($OTHolidayBase) . "',
			OTHolidayValue = '" . (int)$OTHolidayValue . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Overtime Policy has been Updated.</b>
			</div>';
		
		
			
		
			
	}

}
else
{
	$query="SELECT ID,Status,Name,ApplyAfter,OTHourType,OTHourBase,OTHourValue,OTHolidayType,OTHolidayBase,OTHolidayValue FROM overtime_policies WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Overtime Policy ID.</b>
		</div>';
		redirect("OvertimePolicies.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Name=$row["Name"];
		$ApplyAfter=$row["ApplyAfter"];
		$Status=$row["Status"];
		$OTHourType=$row["OTHourType"];
		$OTHourBase=$row["OTHourBase"];
		$OTHourValue=$row["OTHourValue"];
		$OTHolidayType=$row["OTHolidayType"];
		$OTHolidayBase=$row["OTHolidayBase"];
		$OTHolidayValue=$row["OTHolidayValue"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Overtime Policy</title>
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
      <h1>Edit Overtime Policy</h1>
      <ol class="breadcrumb">
        <li><a href="OvertimePolicies.php"><i class="fa fa-dashboard"></i>Overtime Policies</a></li>
        <li class="active">Edit Overtime Policy</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='OvertimePolicies.php'">Cancel</button>
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
                <h3 class="box-title">Overtime Policy Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Name">Overtime Policy Name: </label>
				  <?php 
				echo '<input type="text" maxlength="100" id="Name" name="Name" class="form-control"  value="'.$Name.'" />';
				?>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" for="ApplyAfter" >Overtime Apply After: </label>
				  <select name="ApplyAfter" id="ApplyAfter" class="form-control">
					<option <?php echo ($ApplyAfter == '0' ? 'selected' : '');?> value="0" >Just After Depart Time</option>
					<option <?php echo ($ApplyAfter == '15' ? 'selected' : '');?> value="15" >15 Minutes</option>
					<option <?php echo ($ApplyAfter == '20' ? 'selected' : '');?> value="20" >20 Minutes</option>
					<option <?php echo ($ApplyAfter == '30' ? 'selected' : '');?> value="30" >30 Minutes</option>
					<option <?php echo ($ApplyAfter == '40' ? 'selected' : '');?> value="40" >40 Minutes</option>
					<option <?php echo ($ApplyAfter == '45' ? 'selected' : '');?> value="45" >45 Minutes</option>
					<option <?php echo ($ApplyAfter == '50' ? 'selected' : '');?> value="50" >50 Minutes</option>
					<option <?php echo ($ApplyAfter == '60' ? 'selected' : '');?> value="60" >60 Minutes</option>
					<option <?php echo ($ApplyAfter == '100' ? 'selected' : '');?> value="100" >100 Minutes</option>
				  </select>
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
                <h3 class="box-title">Overtime Hour Details</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  

				<div class="form-group">
                  <label id="labelimp" for="OTHourType" >Overtime Hour Type: </label>
				  <select name="OTHourType" id="OTHourType" class="form-control">
					<option value="" >Select Hour Type</option>
					<option <?php echo ($OTHourType == 'FixedAmount' ? 'selected' : '');?> value="FixedAmount" >FixedAmount</option>
					<option <?php echo ($OTHourType == 'Percentage' ? 'selected' : '');?> value="Percentage" >Percentage</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="OTHourBase" >Overtime Hour Base On: </label>
				  <select name="OTHourBase" id="OTHourBase" class="form-control">
					<option value="" >Select Hour Base On</option>
					<option <?php echo ($OTHourBase == 'Gross Per Hour' ? 'selected' : '');?> value="Gross Per Hour" >Gross Per Hour</option>
					<option <?php echo ($OTHourBase == 'Basic Per Hour' ? 'selected' : '');?> value="Basic Per Hour" >Basic Per Hour</option>
				  </select>
                </div>
				
				
				<div class="form-group">
					<label id="labelimp" id="OTHourValue">Overtime Hour Value:</label>
						<input type="num" name="OTHourValue" id="OTHourValue" <?php echo 'value="'.$OTHourValue.'"' ?> class="form-control" />
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
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Overtime Holiday Details</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  

				<div class="form-group">
                  <label id="labelimp" for="OTHolidayType" >Overtime Holiday Type: </label>
				  <select name="OTHolidayType" id="OTHolidayType" class="form-control">
					<option value="" >Select Holiday Type</option>
					<option <?php echo ($OTHolidayType == 'FixedAmount' ? 'selected' : '');?> value="FixedAmount" >FixedAmount</option>
					<option <?php echo ($OTHolidayType == 'Percentage' ? 'selected' : '');?> value="Percentage" >Percentage</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="OTHolidayBase" >Overtime Holiday Base On: </label>
				  <select name="OTHolidayBase" id="OTHolidayBase" class="form-control">
					<option value="" >Select Holiday Base On</option>
					<option <?php echo ($OTHolidayBase == 'Gross Per Hour' ? 'selected' : '');?> value="Gross Per Hour" >Gross Per Hour</option>
					<option <?php echo ($OTHolidayBase == 'Basic Per Hour' ? 'selected' : '');?> value="Basic Per Hour" >Basic Per Hour</option>
					<option <?php echo ($OTHolidayBase == 'Gross Per Day' ? 'selected' : '');?> value="Gross Per Day" >Gross Per Day</option>
					<option <?php echo ($OTHolidayBase == 'Basic Per Day' ? 'selected' : '');?> value="Basic Per Day" >Basic Per Day</option>
				  </select>
                </div>
				
				<div class="form-group">
					<label id="labelimp" id="OTHolidayValue">Overtime Holiday Value:</label>
						<input type="num" name="OTHolidayValue" id="OTHolidayValue" <?php echo 'value="'.$OTHolidayValue.'"' ?> class="form-control" />
				</div><!-- /.form group -->
		
				

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
