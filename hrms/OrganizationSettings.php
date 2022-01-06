<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$CompanyName="";
	$Tax="";
	$ProvidentFund="";
	$BonusType="";
	$PerDayHours=0;
	$GraceTime="";
	$DeductionOnLates="";
	$NumOfLates=0;
	$LateDeductAmount="";
	$WorkingDays=array();
	$WorkingDaysString="";
	$RefreshQuota="";
	$CurrencySymbol="";
	$PassingPercentage=0;
	$NumOfAttempts=0;
	$InterviewPercentage=0;
	$YearStartFrom=0;
	$SandwitchDeductions="";
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_POST["CompanyName"]))
		$CompanyName=trim($_POST["CompanyName"]);
	if(isset($_POST["Tax"]))
		$Tax=trim($_POST["Tax"]);
	if(isset($_POST["ProvidentFund"]))
		$ProvidentFund=trim($_POST["ProvidentFund"]);
	if(isset($_POST["BonusType"]))
		$BonusType=trim($_POST["BonusType"]);
	if(isset($_REQUEST["PerDayHours"]) && ctype_digit(trim($_REQUEST["PerDayHours"])))
		$PerDayHours=trim($_REQUEST["PerDayHours"]);
	if(isset($_POST["GraceTime"]))
		$GraceTime=trim($_POST["GraceTime"]);
	if(isset($_POST["DeductionOnLates"]))
		$DeductionOnLates=trim($_POST["DeductionOnLates"]);
	if(isset($_REQUEST["NumOfLates"]) && ctype_digit(trim($_REQUEST["NumOfLates"])))
		$NumOfLates=trim($_REQUEST["NumOfLates"]);
	if(isset($_POST["LateDeductAmount"]))
		$LateDeductAmount=trim($_POST["LateDeductAmount"]);
	if(isset($_POST["WorkingDays"]))
	{
		$WorkingDaysString=implode(',', $_POST['WorkingDays']);
		$WorkingDays=$_POST['WorkingDays'];
	}
	if(isset($_POST["RefreshQuota"]))
		$RefreshQuota=trim($_POST["RefreshQuota"]);
	if(isset($_POST["CurrencySymbol"]))
		$CurrencySymbol=trim($_POST["CurrencySymbol"]);
	if(isset($_REQUEST["PassingPercentage"]) && ctype_digit(trim($_REQUEST["PassingPercentage"])))
		$PassingPercentage=trim($_REQUEST["PassingPercentage"]);
	if(isset($_REQUEST["NumOfAttempts"]) && ctype_digit(trim($_REQUEST["NumOfAttempts"])))
		$NumOfAttempts=trim($_REQUEST["NumOfAttempts"]);
	if(isset($_REQUEST["InterviewPercentage"]) && ctype_digit(trim($_REQUEST["InterviewPercentage"])))
		$InterviewPercentage=trim($_REQUEST["InterviewPercentage"]);
	if(isset($_REQUEST["YearStartFrom"]) && ctype_digit(trim($_REQUEST["YearStartFrom"])))
		$YearStartFrom=trim($_REQUEST["YearStartFrom"]);
	
	if($CompanyName == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Organization Name.</b>
		</div>';
	}
	if(empty($WorkingDays))
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Working Days.</b>
		</div>';
	}
	if($CurrencySymbol == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Currency Symbol.</b>
		</div>';
	}
		
		
	
	if($msg=="")
	{
			$query="UPDATE organization_settings SET UpdatedTime=NOW(), UpdatedBy='".$_SESSION['UserID']."',
				CompanyName = '" . dbinput($CompanyName) . "',
				Tax = '" . dbinput($Tax) . "',
				ProvidentFund = '" . dbinput($ProvidentFund) . "',
				PerDayHours = '" . dbinput((int)$PerDayHours) . "',
				GraceTime = '" . time_format_gracetime($GraceTime) . "',
				BonusType = '" . dbinput($BonusType) . "',
				DeductionOnLates = '" . dbinput($DeductionOnLates) . "',
				NumOfLates = '" . dbinput((int)$NumOfLates) . "',
				LateDeductAmount = '" . dbinput($LateDeductAmount) . "',
				WorkingDays = '" . dbinput($WorkingDaysString) . "',
				RefreshQuota = '" . dbinput($RefreshQuota) . "',
				CurrencySymbol = '" . dbinput($CurrencySymbol) . "',
				PassingPercentage = '" . dbinput((int)$PassingPercentage) . "',
				NumOfAttempts = '" . dbinput((int)$NumOfAttempts) . "',
				InterviewPercentage = '" . dbinput((int)$InterviewPercentage) . "',
				YearStartFrom = '" . dbinput((int)$YearStartFrom) . "'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Oraganization Settings has been Updated.</b>
			</div>';
				
	}

}
else
{
	$query="SELECT * FROM organization_settings";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		redirect("Dashboard.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$CompanyName=$row["CompanyName"];
		$Tax=$row["Tax"];
		$ProvidentFund=$row["ProvidentFund"];
		$BonusType=$row["BonusType"];
		$PerDayHours=$row["PerDayHours"];
		$GraceTime=$row["GraceTime"];
		$DeductionOnLates=$row["DeductionOnLates"];
		$NumOfLates=$row["NumOfLates"];
		$LateDeductAmount=$row["LateDeductAmount"];
		$WorkingDays=explode(',', $row['WorkingDays']);
		$RefreshQuota=$row["RefreshQuota"];
		$CurrencySymbol=$row["CurrencySymbol"];
		$PassingPercentage=$row["PassingPercentage"];
		$NumOfAttempts=$row["NumOfAttempts"];
		$InterviewPercentage=$row["InterviewPercentage"];
		$YearStartFrom=$row["YearStartFrom"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Organization Settings</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />

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
      <h1>Organization Settings</h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Organization Settings</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Dashboard.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>

        <div class="col-md-6">
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Organization Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="CompanyName">Organization Name: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="CompanyName" name="CompanyName" class="form-control"  value="'.$CompanyName.'" />';
				?>
                </div>
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Attendance Management</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="GraceTime">Grace Time To Arrive Office:</label>
							<input type="text" name="GraceTime" id="GraceTime" <?php echo 'value="'.revert_time_format_gracetime($GraceTime).'"' ?> class="form-control timepicker" />
					</div><!-- /.form group -->
				</div>
				
				<div class="form-group">
                  <label id="labelimp" >Salary Deduction On Lates: </label>
                  <select name="DeductionOnLates" class="form-control">
				  <option value="Yes" <?php echo ($DeductionOnLates == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($DeductionOnLates == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Number of Lates Applied for Per Deduction: </label>
                  <select name="NumOfLates" class="form-control">
				  <?php 
				  for($i = 1; $i <= 5; $i++)
				  {
				  ?>
					   <option value="<?php echo $i; ?>" <?php echo ($NumOfLates == $i ? ' selected' : ''); ?>><?php echo $i.' Lates'; ?></option>
				  <?php
				  }
				  ?>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Salary Deduction Amount On <?php echo $NumOfLates ; ?> Lates: </label>
                  <select name="LateDeductAmount" class="form-control">
				  <option value="Deduct From Oneday Salary" <?php echo ($LateDeductAmount == "Deduct From Oneday Salary" ? ' selected' : ''); ?>>Deduct From Oneday Salary</option>
				  <option value="Half Day Leave" <?php echo ($LateDeductAmount == "Half Day Leave" ? ' selected' : ''); ?>>Half Day Leave</option>
				  <option value="Adjust Leave" <?php echo ($LateDeductAmount == "Adjust Leave" ? ' selected' : ''); ?>>Adjust Leave</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Sandwitch Deductions</label>
                  <select name="SandwitchDeductions" class="form-control">
				  <option value="AND" <?php echo ($SandwitchDeductions == "AND" ? ' selected' : ''); ?>>AND</option>
				  <option value="OR" <?php echo ($SandwitchDeductions == "OR" ? ' selected' : ''); ?>>OR</option>
				  </select>
                </div>
				
				
			  
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
        </div>
        
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Payroll Management</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" class="labelimp" for="CurrencySymbol">Currency Symbol: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="CurrencySymbol" name="CurrencySymbol" class="form-control"  value="'.$CurrencySymbol.'" />';
				?>
                </div>
			  
			  <div class="form-group">
                  <label id="labelimp" >Tax: </label>
                  <select name="Tax" class="form-control">
				  <option value="Yes" <?php echo ($Tax == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($Tax == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Provident Fund: </label>
                  <select name="ProvidentFund" class="form-control">
				  <option value="Yes" <?php echo ($ProvidentFund == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($ProvidentFund == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Bonus Type: </label>
                  <select name="BonusType" class="form-control">
				  <option value="Fixed" <?php echo ($BonusType == "Fixed" ? ' selected' : ''); ?>>Fixed Bonus For All Employees</option>
				  <option value="Individual" <?php echo ($BonusType == "Individual" ? ' selected' : ''); ?>>Individual Bonuses For Selected Employees</option>
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
		

        <div class="col-md-6">
          <div class="box box-solid">
		  <div class="box-header bg-box-blue">
                <h3 class="box-title">Leaves Management</h3>
            </div>
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" >Organization's Year Start From: </label>
                  <select name="YearStartFrom" class="form-control">
				  <option value="1" <?php echo ($YearStartFrom == "1" ? ' selected' : ''); ?>>January</option>
				  <option value="2" <?php echo ($YearStartFrom == "2" ? ' selected' : ''); ?>>February</option>
				  <option value="3" <?php echo ($YearStartFrom == "3" ? ' selected' : ''); ?>>March</option>
				  <option value="4" <?php echo ($YearStartFrom == "4" ? ' selected' : ''); ?>>April</option>
				  <option value="5" <?php echo ($YearStartFrom == "5" ? ' selected' : ''); ?>>May</option>
				  <option value="6" <?php echo ($YearStartFrom == "6" ? ' selected' : ''); ?>>June</option>
				  <option value="7" <?php echo ($YearStartFrom == "7" ? ' selected' : ''); ?>>July</option>
				  <option value="8" <?php echo ($YearStartFrom == "8" ? ' selected' : ''); ?>>August</option>
				  <option value="9" <?php echo ($YearStartFrom == "9" ? ' selected' : ''); ?>>September</option>
				  <option value="10" <?php echo ($YearStartFrom == "10" ? ' selected' : ''); ?>>October</option>
				  <option value="11" <?php echo ($YearStartFrom == "11" ? ' selected' : ''); ?>>November</option>
				  <option value="12" <?php echo ($YearStartFrom == "12" ? ' selected' : ''); ?>>December</option>
				  </select>
                </div>
			  
			  <div class="form-group">
                  <label id="labelimp" >Per Day Working Hours: </label>
                  <select name="PerDayHours" class="form-control">
				  <?php 
				  for($i = 3; $i <= 15; $i++)
				  {
				  ?>
					   <option value="<?php echo $i; ?>" <?php echo ($PerDayHours == $i ? ' selected' : ''); ?>><?php echo $i.' Hours'; ?></option>
				  <?php
				  }
				  ?>
				  </select>
                </div>
				
				 <div class="form-group">
                  <label id="labelimp" >Working Days: </label>
                  <label>
                  <input type="checkbox" name="WorkingDays[]" value="1"<?php echo (in_array(1, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Monday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="2"<?php echo (in_array(2, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Tuesday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="3"<?php echo (in_array(3, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Wednesday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="4"<?php echo (in_array(4, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Thursday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="5"<?php echo (in_array(5, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Friday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="6"<?php echo (in_array(6, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Saturday</label>&nbsp;
				  <label>
                  <input type="checkbox" name="WorkingDays[]" value="7"<?php echo (in_array(7, $WorkingDays) ? "checked = checked" : ""); ?>>
                  Sunday</label>&nbsp;
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Refresh Leaves Quota Type: </label>
                  <select name="RefreshQuota" class="form-control">
				  <option value="Clear Previous" <?php echo ($RefreshQuota == "Clear Previous" ? ' selected' : ''); ?>>Remove All Ramaining Leaves of Previous Year Quota</option>
				  <option value="Include Previous" <?php echo ($RefreshQuota == "Include Previous" ? ' selected' : ''); ?>>Include All Remaining Leaves to Current Year Quota</option>
				  <option value="Paid Previous" <?php echo ($RefreshQuota == "Paid Previous" ? ' selected' : ''); ?>>Include Amount of All Remainig Leaves to this Month's Payroll</option>
				  </select>
                </div>
			  
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
        </div>
        
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Trainings Management</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" >Minimum Percentage to Pass the Training Test: </label>
                  <select name="PassingPercentage" class="form-control">
				  <?php 
				  for($i = 5; $i <= 100; $i=$i+5)
				  {
				  ?>
					   <option value="<?php echo $i; ?>" <?php echo ($PassingPercentage == $i ? ' selected' : ''); ?>><?php echo $i.'%'; ?></option>
				  <?php
				  }
				  ?>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Maximum Number Attempts to Pass the Training Test: </label>
                  <select name="NumOfAttempts" class="form-control">
				  <?php 
				  for($i = 1; $i <= 5; $i++)
				  {
				  ?>
					   <option value="<?php echo $i; ?>" <?php echo ($NumOfAttempts == $i ? ' selected' : ''); ?>><?php echo $i.' Attempts'; ?></option>
				  <?php
				  }
				  ?>
				  </select>
                </div>
			  
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
        </div>
     
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Jobs Management</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" >Minimum Percentage for Qualify to Job: </label>
                  <select name="InterviewPercentage" class="form-control">
				  <?php 
				  for($i = 5; $i <= 100; $i=$i+5)
				  {
				  ?>
					   <option value="<?php echo $i; ?>" <?php echo ($InterviewPercentage == $i ? ' selected' : ''); ?>><?php echo $i.'%'; ?></option>
				  <?php
				  }
				  ?>
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