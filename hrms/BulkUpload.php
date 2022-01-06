<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$ID=0;

		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_ONLY_CSV_ALLOWED))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			Only '.implode(", ", $_ONLY_CSV_ALLOWED) . ' extention file can be uploaded.
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_CSV_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			CSV size must be ' . (MAX_CSV_SIZE/1024) . ' MB or less.
			</div>';
		}
	}
		

	
		if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please Upload File.</b>
			</div>';
		}



	if($msg=="")
	{


    if (is_uploaded_file($_FILES['flPage']['tmp_name'])) {
    
	$deleterecords = "TRUNCATE TABLE employees"; //empty the table of its current records
	mysql_query($deleterecords) or die(mysql_error());

    //Import uploaded file to Database
    $handle = fopen($_FILES['flPage']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into employees(ID,Role,EmpType,EmpTypeDate,Designation,Department,Grade,Salary,GetSalary,Supervisor,AllowEmpLogin,UserName,Password,EmailAddress,PersonalEmailAddress,Notifications,Salutation,FirstName,LastName,FatherName,DOB,MaritalStatus,Gender,BloodGroup,Nationality,JoiningDate,ResignationDate,LeavingDate,ResignationAccepted,ResignationRemarks,EmpID,Status,CNICNumber,CNICIssueDate,CNICExpiration,IqamaNumber,PassportNumber,PassportIssueDate,PassportExpiration,DrivingLicenseNumber,DrivingLicenseIssueDate,DrivingLicenseExpiration,NOY,NOM,LastCompany,LastDesignation,LastSalary,LastWorkingDay,IsFirstJob,Address,CompanyID,MachineID,EmploymentType,Location,SalaryDisbursmintPeriod,SESSINo,EOBINo,Bonus,CanTakeLoan,CanTakeAdvance,PayFullSalary,SalePersonOutdoorPerson,StopSalary,ScheduleID,OvertimePolicy,LateArrivalPolicy,EarlyDeparturePolicy,ArrivalHalfDay,DepartHalfDay,AverageWorkingHours,WorkingType,LeavesDays,SandwichLeaves,HalfDays,Religion,Bank,AccountTitle,AccountNumber,LastEducationDegree,UniversityCollege,EducationCompletionYear,GradeMarksPercentage,LastTechnicalEducationCertificate,UniversityInstitute,TechnicalEducationCompletionYear,GradePercentageMarks,HomeNumber,OfficeNumber,MobileNumber,EmergencyPerson,Relationship,EmergencyNumber,Photo,DateAdded) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]','$data[31]','$data[32]','$data[33]','$data[34]','$data[35]','$data[36]','$data[37]','$data[38]','$data[39]','$data[40]','$data[41]','$data[42]','$data[43]','$data[44]','$data[45]','$data[46]','$data[47]','$data[48]','$data[49]','$data[50]','$data[51]','$data[52]','$data[53]','$data[54]','$data[55]','$data[56]','$data[57]','$data[58]','$data[59]','$data[60]','$data[61]','$data[62]','$data[63]','$data[64]','$data[65]','$data[66]','$data[67]','$data[68]','$data[69]','$data[70]','$data[71]','$data[72]','$data[73]','$data[74]','$data[75]','$data[76]','$data[77]','$data[78]','$data[79]','$data[80]','$data[81]','$data[82]','$data[83]','$data[84]','$data[85]','$data[86]','$data[87]','$data[88]','$data[89]','$data[90]','$data[91]','$data[92]','$data[93]')";
        mysql_query($import) or die(mysql_error());
    }
    fclose($handle);
	
    $_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Employees has been Uploaded.</b>
		</div>';
	}
	else
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Employees Not Uploaded.</b>
		</div>';
	}

		redirect("BulkUpload.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bulk Upload Employees</title>
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
      <h1> Bulk Upload Employees</h1>
      <ol class="breadcrumb">
        <li><a href="Employees.php"><i class="fa fa-dashboard"></i>Employees</a></li>
        <li class="active">Bulk Upload Employees</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Employees.php'">Cancel</button>
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
				<input type="hidden" name="action" value="submit_form" />
				
				<div class="form-group">
                  <label id="labelimp" for="Employees" class="labelimp" >Upload (CSV): </label>
                  <input type="file" id="Employees" name="flPage" />
                </div>
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
             
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
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
