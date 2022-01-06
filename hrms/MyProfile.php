<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$msg2="";
	$Password="";
	$Password2="";
	$Role="";
	$EmpType="";
	$EmpTypeDate="";
	$Designation="";
	$Department="";
	$Grade="";
	$GetSalary="";
	$Supervisor="";
	$AllowEmpLogin="Yes";
	$UserName="";
	$Pswd="";
	$PersonalEmailAddress = "";
	$EmailAddress="";
	$Notifications="Yes";
	$Salutation="";
	$FirstName="";
	$LastName="";
	$FatherName="";
	$DOB="";
	$MaritalStatus="";
	$Gender="";
	$BloodGroup="";
	$Nationality="";
	$JoiningDate="";
	$ResignationDate="";
	$LeavingDate="";
	$ResignationAccepted="No";
	$ResignationRemarks="";
	$EmpID="";
	$Status="Active";
	$CNICNumber="";
	$CNICIssueDate="";
	$CNICExpiration="";
	$IqamaNumber="";
	$PassportNumber="";
	$PassportIssueDate="";
	$PassportExpiration="";
	$DrivingLicenseNumber="";
	$DrivingLicenseIssueDate="";
	$DrivingLicenseExpiration="";
	$NOY=0;
	$NOM=0;
	$LastCompany="";
	$LastDesignation="";
	$LastSalary="";
	$LastWorkingDay="";
	$IsFirstJob="No";
	$Address="";
	$Company=0;
	$MachineID="";
	$EmploymentType="";	
	$Location=0;	
	$SalaryDisbursmintPeriod="";
	$SESSINo="";
	$EOBINo="";
	$Bonus="Yes";	
	$CanTakeLoan="Yes";	
	$CanTakeAdvance="Yes";	
	$PayFullSalary="No";	
	$SalePersonOutdoorPerson="No";
	$StopSalary="No";	
	$ScheduleID=0;
	$OvertimePolicy=0;	
	$LateArrivalPolicy="Not Allowed";
	$ArrivalHalfDay="Not Allowed";
	$DepartHalfDay="Not Allowed";
	$EarlyDeparturePolicy="Not Allowed";	
	$AverageWorkingHours=0;	
	$WorkingType="Shift Base";	
	$LeavesDays="";
	$LeavesDaysArray=array('6','7');	
	$SandwichLeaves="";
	$SandwichLeavesArray=array();	
	$HalfDays="";
	$HalfDaysArray=array();
	$Religion="";	
	$Bank="";	
	$AccountTitle="";	
	$AccountNumber="";	
	$LastEducationDegree="";	
	$UniversityCollege="";	
	$EducationCompletionYear=0;	
	$GradeMarksPercentage="";	
	$LastTechnicalEducationCertificate="";	
	$UniversityInstitute="";	
	$TechnicalEducationCompletionYear=0;	
	$GradePercentageMarks="";
	$HomeNumber="";
	$OfficeNumber="";
	$MobileNumber="";
	$EmergencyPerson="";
	$Relationship="";
	$EmergencyNumber="";
	$Photo="";
	$GrossSalary=0;
	
	$ID=0;
	if(isset($_SESSION["UserID"]) && ctype_digit(trim($_SESSION["UserID"])))
		$ID=trim($_SESSION["UserID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_POST["Password"]))
		$Password=trim($_POST["Password"]);
	if(isset($_POST["Password2"]))
		$Password2=trim($_POST["Password2"]);
	
		if($Password == "") {
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter Password</b>
			</div>';
		}
		// else if( strlen($Password) < 4 ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password too short!</b>
			// </div>';
		// }

		// else if( strlen($Password) > 20 ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password too long!</b>
			// </div>';
		// }

		// else if( !preg_match("#[0-9]+#", $Password) ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password must include at least one number! one letter! one CAPS! & one symbol!</b>
			// </div>';
		// }

		// else if( !preg_match("#[a-z]+#", $Password) ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password must include at least one number! one letter! one CAPS! & one symbol!</b>
			// </div>';
		// }

		// else if( !preg_match("#[A-Z]+#", $Password) ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password must include at least one number! one letter! one CAPS! & one symbol!</b>
			// </div>';
		// }

		// else if( !preg_match("#\W+#", $Password) ) {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Password must include at least one number! one letter! one CAPS! & one symbol!</b>
			// </div>';
		// }
		
		else if($Password != $Password2) {
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Passwords Not Matching with each other.</b>
			</div>';
		}

		if($msg=="")
	{
			$query="UPDATE employees SET DateModified=NOW(),
				Password = '" . dbinput($Password) . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Password has been Changed.</b>
			</div>';
				
			
	}

}

	if(isset($_POST["action"]) && $_POST["action"] == "submit_form2")
{	
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_IMAGE_ALLOWED_TYPES))
		{
			$msg2='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Only '.implode(", ", $_IMAGE_ALLOWED_TYPES) . ' files can be uploaded.</b>
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_IMAGE_SIZE*1024))
		{
			$msg2='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Image size must be ' . MAX_IMAGE_SIZE . ' KB or less.</b>
			</div>';
		}
	}
	
	if($msg2=="")
	{		
		if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
			{
				if(is_file(DIR_EMPLOYEEPHOTOES . $Photo))
					unlink(DIR_EMPLOYEEPHOTOES . $Photo);
			
				flush();
				ini_set('memory_limit', '-1');
				
				$tempName = $_FILES["flPage"]['tmp_name'];
				$realName = $ID . "." . $ext;
				$Photo = $realName; 
				$target = DIR_EMPLOYEEPHOTOES . $realName;

				flush();
			
				$moved=move_uploaded_file($tempName, $target);
			
				if($moved)
				{			
				
					$query="UPDATE employees SET Photo='" . dbinput($realName) . "' WHERE  ID=" . (int)$ID;
					mysql_query($query) or die(mysql_error());

					$msg2='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Photo has been Changed. Please clear your cache.</b>
			</div>';
				}
				else
				{
					$msg2='<div class="alert alert-warning alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>Photo can not be uploaded successfully.</b>
						</div>';
				}
			}		
	}

}

	$query="SELECT * FROM employees WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		redirect("Dashboard.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$ID=$row["ID"];
		$Role=$row["Role"];
		$EmpType=$row["EmpType"];
		$EmpTypeDate=$row["EmpTypeDate"];
		$Designation=$row["Designation"];
		$Department=$row["Department"];
		$Grade=$row["Grade"];
		$Supervisor=$row["Supervisor"];
		$AllowEmpLogin=$row["AllowEmpLogin"];
		$UserName=$row["UserName"];
		$Pswd=$row["Password"];
		$EmailAddress=$row["EmailAddress"];
		$Notifications=$row["Notifications"];
		$Salutation=$row["Salutation"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$FatherName=$row["FatherName"];
		$DOB=$row["DOB"];
		$MaritalStatus=$row["MaritalStatus"];
		$Gender=$row["Gender"];
		$BloodGroup=$row["BloodGroup"];
		$Nationality=$row["Nationality"];
		$JoiningDate=$row["JoiningDate"];
		$ResignationDate=$row["ResignationDate"];
		$LeavingDate=$row["LeavingDate"];
		$EmpID=$row["EmpID"];
		$Status=$row["Status"];
		$CNICNumber=$row["CNICNumber"];
		$CNICIssueDate=$row["CNICIssueDate"];
		$CNICExpiration=$row["CNICExpiration"];
		$PassportNumber=$row["PassportNumber"];
		$PassportIssueDate=$row["PassportIssueDate"];
		$PassportExpiration=$row["PassportExpiration"];
		$DrivingLicenseNumber=$row["DrivingLicenseNumber"];
		$DrivingLicenseIssueDate=$row["DrivingLicenseIssueDate"];
		$DrivingLicenseExpiration=$row["DrivingLicenseExpiration"];
		$NOY=$row["NOY"];
		$NOM=$row["NOM"];
		$LastCompany=$row["LastCompany"];
		$LastDesignation=$row["LastDesignation"];
		$LastSalary=$row["LastSalary"];
		$LastWorkingDay=$row["LastWorkingDay"];
		$IsFirstJob=$row["IsFirstJob"];
		$Address=$row["Address"];
		$Company=$row["CompanyID"];
		$MachineID=$row["MachineID"];
		$EmploymentType=$row["EmploymentType"];	
		$Location=$row["Location"];	
		$SalaryDisbursmintPeriod=$row["SalaryDisbursmintPeriod"];
		$SESSINo=$row["SESSINo"];
		$EOBINo=$row["EOBINo"];	
		$Bonus=$row["Bonus"];	
		$CanTakeLoan=$row["CanTakeLoan"];	
		$CanTakeAdvance=$row["CanTakeAdvance"];	
		$PayFullSalary=$row["PayFullSalary"];	
		$SalePersonOutdoorPerson=$row["SalePersonOutdoorPerson"];
		$StopSalary=$row["StopSalary"];
		$ScheduleID=$row["ScheduleID"];
		$OvertimePolicy=$row["OvertimePolicy"];	
		$LateArrivalPolicy=$row["LateArrivalPolicy"];	
		$EarlyDeparturePolicy=$row["EarlyDeparturePolicy"];	
		$ArrivalHalfDay=$row["ArrivalHalfDay"];	
		$DepartHalfDay=$row["DepartHalfDay"];	
		$AverageWorkingHours=$row["AverageWorkingHours"];	
		$WorkingType=$row["WorkingType"];	
		$LeavesDays=$row["LeavesDays"];
		$LeavesDaysArray=explode(',',$LeavesDays);	
		$SandwichLeaves=$row["SandwichLeaves"];
		$SandwichLeavesArray=explode(',',$SandwichLeaves);	
		$HalfDays=$row["HalfDays"];
		$HalfDaysArray=explode(',',$HalfDays);
		$Religion=$row["Religion"];	
		$Bank=$row["Bank"];	
		$AccountTitle=$row["AccountTitle"];	
		$AccountNumber=$row["AccountNumber"];
		$LastEducationDegree=$row["LastEducationDegree"];	
		$UniversityCollege=$row["UniversityCollege"];	
		$EducationCompletionYear=$row["EducationCompletionYear"];
		$GradeMarksPercentage=$row["GradeMarksPercentage"];	
		$LastTechnicalEducationCertificate=$row["LastTechnicalEducationCertificate"];	
		$UniversityInstitute=$row["UniversityInstitute"];	
		$TechnicalEducationCompletionYear=$row["TechnicalEducationCompletionYear"];	
		$GradePercentageMarks=$row["GradePercentageMarks"];
		$HomeNumber=$row["HomeNumber"];
		$OfficeNumber=$row["OfficeNumber"];
		$MobileNumber=$row["MobileNumber"];
		$EmergencyPerson=$row["EmergencyPerson"];
		$Relationship=$row["Relationship"];
		$EmergencyNumber=$row["EmergencyNumber"];
		$Photo=$row["Photo"];
		$GrossSalary=$row["Salary"];
		$GetSalary=$row["GetSalary"];
	}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>My Profile</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
<body class="skin-blue my-profile-pg-wrap">
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
      <h1>My Profile</h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">My Profile</li>
      </ol>
    </section>
    <!-- Main content -->
    
      <section class="content">
        <div class="box-footer no-print" style="text-align:right;">
		  <a class="btn btn-primary margin" onclick="window.print();"><i class="fa fa-print"></i> Print</a>
          
          <button class="btn btn-primary margin" type="button" onClick="location.href='Dashboard.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
			  	echo $msg2;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
		
        <div class="col-md-9">
        
          <div class="box box-solid" style="border:1px solid #f3f3f3;">
          <div class="box-header bg-box-blue">
                <h3 class="box-title"><?php echo $FirstName.' '.$LastName; ?></h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="row">
			    <div class="col-md-4 col-xs-4">
			    	<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form2" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
					<hr><h4>Basic Information</h4><hr>
					<img class="thumbnail" src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $Photo) ? DIR_EMPLOYEEPHOTOES.dboutput($Photo) : 'images/avatar.png'); ?>"  style="width:80px;" />
					<div class="form-group">
						  <input type="file" name="flPage" />
						  
						</div>
						<button type="submit" class="btn btn-success margin">Update</button>
					</form>
					<?php //if(dboutput($Status)=='Active'){echo '<span style="background-color:green;color:white;font-size:25px;">&nbsp;Active&nbsp;</span>';}else{echo '<span style="background-color:red;color:white;font-size:25px;">&nbsp;Deactive&nbsp;</span>';} ?><br><br>
					<b>Name:</b> <?php echo $Salutation.' '.$FirstName.' '.$LastName; ?><br>
					<?php echo ($Gender == 'Male' ? '<b>S/O:</b>' : '<b>D/O:</b>'); ?> <?php echo $FatherName; ?><br>
					<b>Date of Birth:</b> <?php echo $DOB; ?><br>
					<b>Nationality:</b> <?php echo $Nationality; ?><br>
					<b>Employee ID / Code:</b> <?php echo $EmpID; ?><br>
					<b>Machine ID / Code:</b> <?php echo $MachineID; ?><br>
					
					<div class="profile-box">
    					<hr><h4>User Authentications</h4><hr>
    					<b>Role:</b> <?php echo $Role; ?><br><br>
    					<b>Username:</b> <?php echo $UserName; ?><br><br>
    					<b>AllowEmpLogin:</b> <?php echo $AllowEmpLogin; ?><br><br>
    					<b>Get Notifications By Email:</b> <?php echo $Notifications; ?><br>
					</div>
					
					
				</div>
				<div class="col-md-4 col-xs-4">
					<hr><h4>Official Information</h4><hr>
					
					<div class="profile-box">
    					<b>Company:</b> <?php echo CompanyNameByID($Company); ?><br>
    					<b>Location:</b> <?php echo LocationNameByID($Location); ?><br>
    					<b>Grade:</b> <?php echo $Grade; ?><br>
    					<b>Department:</b> <?php echo $Department; ?><br>
    					<b>Designation:</b> <?php echo $Designation; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Date of Joining:</b> <?php echo $JoiningDate; ?><br>
    					<b>Resignation Date:</b> <?php echo $ResignationDate; ?><br>
    					<b>Last Working Date:</b> <?php echo $LeavingDate; ?><br><br>
    				</div>	
					
					<div class="profile-box">
    					<b>Employment Status:</b> <?php echo $EmpType; ?><br>
    					<b>Probation End Date:</b> <?php echo $EmpTypeDate; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Official Phone Number:</b> <?php echo $OfficeNumber; ?><br>
    					<b>Official Email Address:</b> <?php echo $EmailAddress; ?><br><br>
					</div>
					<hr><h4>Payroll Policies</h4><hr>
					
					<div class="profile-box">
    					<b>Get Salary:</b> <?php echo $GetSalary; ?><br>
    					<b>Salary Disbursmint Period:</b> <?php echo $SalaryDisbursmintPeriod; ?><br>
    					<b>Can Take Bonus:</b> <?php echo $Bonus; ?><br>
    					<b>Can Take Loan:</b> <?php echo $CanTakeLoan; ?><br>
    					<b>Can Take Advance:</b> <?php echo $CanTakeAdvance; ?><br>
    					<b>Pay Full Salary:</b> <?php echo $PayFullSalary; ?><br>
    					<b>Sale Person / Outdoor Person:</b> <?php echo $SalePersonOutdoorPerson; ?><br>
    					<b>StopSalary:</b> <?php echo $StopSalary; ?><br><br>
					</div>
					
					<hr><h4>Attendance Policies</h4><hr>
					
					<div class="profile-box">
					<b>Schedule:</b> <?php echo ScheduleNameByID($ScheduleID); ?><br>
					<b>Overtime Policy:</b> <?php echo OvertimePolicyNameByID($OvertimePolicy); ?><br>
					<b>Late Arrival:</b> <?php echo $LateArrivalPolicy; ?><br>
					<b>Arrival Half Day:</b> <?php echo $ArrivalHalfDay; ?><br>
					<b>Depart Half Day:</b> <?php echo $DepartHalfDay; ?><br>
					<b>Early Departure:</b> <?php echo $EarlyDeparturePolicy; ?><br>
					<b>Working Type:</b> <?php echo $WorkingType; ?><br><br>
					<b>Holidays:</b> 
					<label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="1"<?php echo (in_array(1, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  M</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="2"<?php echo (in_array(2, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="3"<?php echo (in_array(3, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  W</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="4"<?php echo (in_array(4, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="5"<?php echo (in_array(5, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  F</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="6"<?php echo (in_array(6, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="LeavesDays[]" value="7"<?php echo (in_array(7, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
					<br>
					<b>Sandwich Leaves:</b> 
					<label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="1"<?php echo (in_array(1, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  M</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="2"<?php echo (in_array(2, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="3"<?php echo (in_array(3, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  W</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="4"<?php echo (in_array(4, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="5"<?php echo (in_array(5, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  F</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="6"<?php echo (in_array(6, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="SandwichLeaves[]" value="7"<?php echo (in_array(7, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
					<br>
					<b>HalfDays:</b> 
					<label>
						  <input disabled type="checkbox" name="HalfDays[]" value="1"<?php echo (in_array(1, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  M</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="2"<?php echo (in_array(2, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="3"<?php echo (in_array(3, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  W</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="4"<?php echo (in_array(4, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  T</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="5"<?php echo (in_array(5, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  F</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="6"<?php echo (in_array(6, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
						  <label>
						  <input disabled type="checkbox" name="HalfDays[]" value="7"<?php echo (in_array(7, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  S</label>&nbsp;
					<br><br>
					</div>
					
					
					
					
				</div>
				<div class="col-md-4 col-xs-4">
					<hr><h4>Personal Information</h4><hr>
					
					<div class="profile-box">
    					<b>Marital Status:</b> <?php echo $MaritalStatus; ?><br>
    					<b>Religion:</b> <?php echo $Religion; ?><br>
    					<b>BloodGroup:</b> <?php echo $BloodGroup; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Personal Email Address:</b> <?php echo $PersonalEmailAddress; ?><br>
    					<b>Address:</b> <?php echo $Address; ?><br>
    					<b>Personal Mobile Number:</b> <?php echo $MobileNumber; ?><br>
    					<b>Home Number:</b> <?php echo $HomeNumber; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Emergency Contact Person:</b> <?php echo $EmergencyPerson; ?><br>
    					<b>Relationship:</b> <?php echo $Relationship; ?><br>
    					<b>Emergency Number:</b> <?php echo $EmergencyNumber; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Iqama Number:</b> <?php echo $IqamaNumber; ?><br><br>
    					<b>CNIC Number:</b> <?php echo $CNICNumber; ?><br>
    					<b>CNIC Issue Date:</b> <?php echo $CNICIssueDate; ?><br>
    					<b>CNIC Expiration:</b> <?php echo $CNICExpiration; ?><br><br>
    					<b>Passport Number:</b> <?php echo $PassportNumber; ?><br>
    					<b>Passport Issue Date:</b> <?php echo $PassportIssueDate; ?><br>
    					<b>Passport Expiration:</b> <?php echo $PassportExpiration; ?><br><br>
    					<b>Driving License Number:</b> <?php echo $DrivingLicenseNumber; ?><br>
    					<b>Driving License Issue Date:</b> <?php echo $DrivingLicenseIssueDate; ?><br>
    					<b>Driving License Expiration:</b> <?php echo $DrivingLicenseExpiration; ?><br><br>
    				</div>	
					
					<div class="profile-box">
    					<b>Bank:</b> <?php echo $Bank; ?><br>
    					<b>Account Title:</b> <?php echo $AccountTitle; ?><br>
    					<b>Account Number:</b> <?php echo $AccountNumber; ?><br><br>
    				</div>	
					
					<div class="profile-box">
    					<b>Academic Qualification:</b> <?php echo $LastEducationDegree; ?><br>
    					<b>University / College:</b> <?php echo $UniversityCollege; ?><br>
    					<b>Completion Year:</b> <?php echo $EducationCompletionYear; ?><br>
    					<b>Grade / Marks:</b> <?php echo $GradeMarksPercentage; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Technical Qualification:</b> <?php echo $LastTechnicalEducationCertificate; ?><br>
    					<b>University / College:</b> <?php echo $UniversityInstitute; ?><br>
    					<b>Completion Year:</b> <?php echo $TechnicalEducationCompletionYear; ?><br>
    					<b>Grade / Marks:</b> <?php echo $GradePercentageMarks; ?><br><br>
					</div>
					
					<div class="profile-box">
    					<b>Experience:</b> <?php echo $NOY.' Years and '.$NOM.' Months'; ?><br>
    					<b>Last Company:</b> <?php echo $LastCompany; ?><br>
    					<b>Last Designation:</b> <?php echo $LastDesignation; ?><br>
    					<b>Last Salary:</b> <?php echo $LastSalary; ?><br>
    					<b>Last Working Day:</b> <?php echo $LastWorkingDay; ?><br>
    					<b>Is First Job:</b> <?php echo $IsFirstJob; ?><br><br>
					</div>
				
				</div>
				<div class="col-md-12 col-xs-12">
					<hr><h4>Gross Salary: <?php echo round(gross_plus_anual($ID)); ?></h4><hr>
					<?php
					// $query="SELECT Amount FROM basicsalary WHERE EmpID='" . $_SESSION['UserID'] . "'";
					// $result = mysql_query ($query) or die(mysql_error()); 
					// $num = mysql_num_rows($result);
					// $BasicSalary=0;
					// if($num==1)
					// {
						// $row = mysql_fetch_array($result,MYSQL_ASSOC);
						// $BasicSalary = $row['Amount'];
					// }
					?>
					
					<!--<table id="dataTable" class="table table-bordered table-striped">
					  <thead>
						<tr>
						  <th>Payment Allowance</th>
						  <th>Payment</th>
						  <th>Base On</th>
						  <th>Value</th>
						</tr>
					  </thead>
					  
					  <tbody>
					
					
						<tr>
						  <td>Basic Salary</td>
						  <td>Percentage</td>
						  <td>Gross Salary</td>
						  <td><?php //echo CURRENCY_SYMBOL.' '.$BasicSalary; ?></td>
						</tr>
						
						<?php
						// $query = "SELECT Title,Type,Amount,Percentage,Taxable FROM allowances where ID <> 0 AND Approved = 1 AND EmpID='" . $_SESSION['UserID'] . "'";
						// $res = mysql_query($query) or die(mysql_error());
						// $num = mysql_num_rows($res);
						// if($num > 0)
						// {
							// while($row = mysql_fetch_array($res))
							// {
								?>
									<tr>
									<td><?php //echo $row['Title']; ?> Allowance</td>
									<td><?php //echo $row['Type']; ?></td>
									<td><?php //echo ($row["Type"] == "FixedAmount" ? '' : "Basic Salary"); ?></td>
									<td><?php //echo ($row["Type"] == "FixedAmount" ? CURRENCY_SYMBOL.' '.round($row['Amount'],2) : CURRENCY_SYMBOL.' '.round(($row['Percentage'] / 100) * $BasicSalary,2)) ; ?></td>
									</tr>
								<?php
							// }
						// }
						?>
					
					  </tbody>
					</table>-->
				
				</div>
				</div>
			  
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		<div class="col-md-3 no-print">
		<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Change Password</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Password">Password: </label>
                  <?php 
				echo '<input type="password" maxlength="100" id="Password" name="Password" class="form-control"  value="" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Password2">Confirm Password: </label>
                  <?php 
				echo '<input type="password" maxlength="100" id="Password2" name="Password2" class="form-control"  value="" />';
				?>
                </div>
				
				<button type="submit" class="btn btn-success margin">Save New Password</button>
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
          </form>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
</body>
</html>