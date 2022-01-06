<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$msg="";
	$Role="";
	$EmpType="";
	$Designation="";
	$Department="";
	$Grade="";
	$Supervisor="";
	$AllowEmpLogin="Yes";
	$UserName="";
	$Password="";
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
	$LeavingDate="";
	$EmpID="";
	$Status="Active";
	$CNICNumber="";
	$CNICPlace="";
	$CNICExpiration="";
	$PassportNumber="";
	$PassportPlace="";
	$PassportExpiration="";
	$DrivingLicenseNumber="";
	$DrivingLicensePlace="";
	$DrivingLicenseExpiration="";
	$NOY=0;
	$NOM=0;
	$LastCompany="";
	$LastDesignation="";
	$LastSalary="";
	$LastWorkingDay="";
	$IsFirstJob="No";
	$Address="";
	$CompanyID=0;
	$MachineID="";
	$EmploymentType="";	
	$Location="";	
	$SalaryDisbursmintPeriod="";
	$SESSINo="";
	$EOBINo="";
	$IncomeTax="Yes";	
	$Bonus="Yes";	
	$ProvidentFund="Yes";	
	$SESSI="No";	
	$EOBI="No";	
	$CanTakeLoan="Yes";	
	$CanTakeAdvance="Yes";	
	$PayFullSalary="No";	
	$SalePersonOutdoorPerson="No";
	$StopSalary="No";	
	$ScheduleID=0;
	$OvertimePolicy="";	
	$LateArrivalPolicy="";	
	$EarlyDeparturePolicy="";	
	$LeaveAdjustPolicy="";	
	$AverageWorkingHours=0;	
	$WorkingType="Shift Base";	
	$LeavesDays="";
	$LeavesDaysArray=array('6','7');	
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
	
	$BasicSalary=0;
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{				
	if(isset($_POST["Role"]))
		$Role=trim($_POST["Role"]);
	if(isset($_POST["EmpType"]))
		$EmpType=trim($_POST["EmpType"]);
	if(isset($_POST["Designation"]))
		$Designation=trim($_POST["Designation"]);
	if(isset($_POST["Department"]))
		$Department=trim($_POST["Department"]);
	if(isset($_POST["Grade"]))
		$Grade=trim($_POST["Grade"]);
	if(isset($_POST["Supervisor"]))
		$Supervisor=trim($_POST["Supervisor"]);
	if(isset($_POST["AllowEmpLogin"]))
		$AllowEmpLogin=trim($_POST["AllowEmpLogin"]);
	if(isset($_POST["UserName"]))
		$UserName=trim($_POST["UserName"]);
	if(isset($_POST["Password"]))
		$Password=trim($_POST["Password"]);
	if(isset($_POST["EmailAddress"]))
		$EmailAddress=trim($_POST["EmailAddress"]);
	if(isset($_POST["Notifications"]))
		$Notifications=trim($_POST["Notifications"]);
	if(isset($_POST["Salutation"]))
		$Salutation=trim($_POST["Salutation"]);
	if(isset($_POST["FirstName"]))
		$FirstName=trim($_POST["FirstName"]);
	if(isset($_POST["LastName"]))
		$LastName=trim($_POST["LastName"]);
	if(isset($_POST["FatherName"]))
		$FatherName=trim($_POST["FatherName"]);
	if(isset($_POST["DOB"]))
		$DOB=trim($_POST["DOB"]);
	if(isset($_POST["MaritalStatus"]))
		$MaritalStatus=trim($_POST["MaritalStatus"]);
	if(isset($_POST["Gender"]))
		$Gender=trim($_POST["Gender"]);
	if(isset($_POST["BloodGroup"]))
		$BloodGroup=trim($_POST["BloodGroup"]);
	if(isset($_POST["Nationality"]))
		$Nationality=trim($_POST["Nationality"]);
	if(isset($_POST["JoiningDate"]))
		$JoiningDate=trim($_POST["JoiningDate"]);
	if(isset($_POST["LeavingDate"]))
		$LeavingDate=trim($_POST["LeavingDate"]);
	if(isset($_POST["EmpID"]))
		$EmpID=trim($_POST["EmpID"]);
	if(isset($_POST["Status"]))
		$Status=trim($_POST["Status"]);
	if(isset($_POST["CNICNumber"]))
		$CNICNumber=trim($_POST["CNICNumber"]);
	if(isset($_POST["CNICPlace"]))
		$CNICPlace=trim($_POST["CNICPlace"]);
	if(isset($_POST["CNICExpiration"]))
		$CNICExpiration=trim($_POST["CNICExpiration"]);
	if(isset($_POST["PassportNumber"]))
		$PassportNumber=trim($_POST["PassportNumber"]);
	if(isset($_POST["PassportPlace"]))
		$PassportPlace=trim($_POST["PassportPlace"]);
	if(isset($_POST["PassportExpiration"]))
		$PassportExpiration=trim($_POST["PassportExpiration"]);
	if(isset($_POST["DrivingLicenseNumber"]))
		$DrivingLicenseNumber=trim($_POST["DrivingLicenseNumber"]);
	if(isset($_POST["DrivingLicensePlace"]))
		$DrivingLicensePlace=trim($_POST["DrivingLicensePlace"]);
	if(isset($_POST["DrivingLicenseExpiration"]))
		$DrivingLicenseExpiration=trim($_POST["DrivingLicenseExpiration"]);
	if(isset($_POST["NOY"]) && ctype_digit($_POST['NOY']))
		$NOY=trim($_POST["NOY"]);
	if(isset($_POST["NOM"]) && ctype_digit($_POST['NOM']))
		$NOM=trim($_POST["NOM"]);
	if(isset($_POST["LastCompany"]))
		$LastCompany=trim($_POST["LastCompany"]);
	if(isset($_POST["LastDesignation"]))
		$LastDesignation=trim($_POST["LastDesignation"]);
	if(isset($_POST["LastSalary"]))
		$LastSalary=trim($_POST["LastSalary"]);
	if(isset($_POST["LastWorkingDay"]))
		$LastWorkingDay=trim($_POST["LastWorkingDay"]);
	if(isset($_POST["IsFirstJob"]))
		$IsFirstJob=trim($_POST["IsFirstJob"]);
	if(isset($_POST["Address"]))
		$Address=trim($_POST["Address"]);
	if(isset($_POST["CompanyID"]) && ctype_digit($_POST['CompanyID']))
		$CompanyID=trim($_POST["CompanyID"]);
	if(isset($_POST["MachineID"]))
		$MachineID=trim($_POST["MachineID"]);
	if(isset($_POST["EmploymentType"]))
		$EmploymentType=trim($_POST["EmploymentType"]);
	if(isset($_POST["Location"]))
		$Location=trim($_POST["Location"]);
	if(isset($_POST["SalaryDisbursmintPeriod"]))
		$SalaryDisbursmintPeriod=trim($_POST["SalaryDisbursmintPeriod"]);
	if(isset($_POST["SESSINo"]))
		$SESSINo=trim($_POST["SESSINo"]);
	if(isset($_POST["EOBINo"]))
		$EOBINo=trim($_POST["EOBINo"]);
	if(isset($_POST["IncomeTax"]))
		$IncomeTax=trim($_POST["IncomeTax"]);
	if(isset($_POST["Bonus"]))
		$Bonus=trim($_POST["Bonus"]);
	if(isset($_POST["ProvidentFund"]))
		$ProvidentFund=trim($_POST["ProvidentFund"]);
	if(isset($_POST["SESSI"]))
		$SESSI=trim($_POST["SESSI"]);
	if(isset($_POST["EOBI"]))
		$EOBI=trim($_POST["EOBI"]);
	if(isset($_POST["CanTakeLoan"]))
		$CanTakeLoan=trim($_POST["CanTakeLoan"]);
	if(isset($_POST["CanTakeAdvance"]))
		$CanTakeAdvance=trim($_POST["CanTakeAdvance"]);
	if(isset($_POST["PayFullSalary"]))
		$PayFullSalary=trim($_POST["PayFullSalary"]);
	if(isset($_POST["SalePersonOutdoorPerson"]))
		$SalePersonOutdoorPerson=trim($_POST["SalePersonOutdoorPerson"]);
	if(isset($_POST["StopSalary"]))
		$StopSalary=trim($_POST["StopSalary"]);
	if(isset($_POST["ScheduleID"]) && ctype_digit($_POST['ScheduleID']))
		$ScheduleID=trim($_POST["ScheduleID"]);
	if(isset($_POST["OvertimePolicy"]))
		$OvertimePolicy=trim($_POST["OvertimePolicy"]);
	if(isset($_POST["LateArrivalPolicy"]))
		$LateArrivalPolicy=trim($_POST["LateArrivalPolicy"]);
	if(isset($_POST["EarlyDeparturePolicy"]))
		$EarlyDeparturePolicy=trim($_POST["EarlyDeparturePolicy"]);
	if(isset($_POST["LeaveAdjustPolicy"]))
		$LeaveAdjustPolicy=trim($_POST["LeaveAdjustPolicy"]);
	if(isset($_POST["AverageWorkingHours"]) && ctype_digit($_POST['AverageWorkingHours']))
		$AverageWorkingHours=trim($_POST["AverageWorkingHours"]);
	if(isset($_POST["WorkingType"]))
		$WorkingType=trim($_POST["WorkingType"]);
	if(isset($_POST["LeavesDays"]))
	{
		$LeavesDays=implode(',', $_POST['LeavesDays']);
		$LeavesDaysArray=$_POST['LeavesDays'];
	}
	if(isset($_POST["HalfDays"]))
	{
		$HalfDays=implode(',', $_POST['HalfDays']);
		$HalfDaysArray=$_POST['HalfDays'];
	}
	if(isset($_POST["Religion"]))
		$Religion=trim($_POST["Religion"]);
	if(isset($_POST["Bank"]))
		$Bank=trim($_POST["Bank"]);
	if(isset($_POST["AccountTitle"]))
		$AccountTitle=trim($_POST["AccountTitle"]);
	if(isset($_POST["AccountNumber"]))
		$AccountNumber=trim($_POST["AccountNumber"]);
	if(isset($_POST["LastEducationDegree"]))
		$LastEducationDegree=trim($_POST["LastEducationDegree"]);
	if(isset($_POST["UniversityCollege"]))
		$UniversityCollege=trim($_POST["UniversityCollege"]);
	if(isset($_POST["EducationCompletionYear"]) && ctype_digit($_POST['EducationCompletionYear']))
		$EducationCompletionYear=trim($_POST["EducationCompletionYear"]);
	if(isset($_POST["GradeMarksPercentage"]))
		$GradeMarksPercentage=trim($_POST["GradeMarksPercentage"]);
	if(isset($_POST["LastTechnicalEducationCertificate"]))
		$LastTechnicalEducationCertificate=trim($_POST["LastTechnicalEducationCertificate"]);
	if(isset($_POST["TechnicalEducationCompletionYear"]) && ctype_digit($_POST['TechnicalEducationCompletionYear']))
		$TechnicalEducationCompletionYear=trim($_POST["TechnicalEducationCompletionYear"]);
	if(isset($_POST["GradePercentageMarks"]))
		$GradePercentageMarks=trim($_POST["GradePercentageMarks"]);
	if(isset($_POST["HomeNumber"]))
		$HomeNumber=trim($_POST["HomeNumber"]);
	if(isset($_POST["OfficeNumber"]))
		$OfficeNumber=trim($_POST["OfficeNumber"]);
	if(isset($_POST["MobileNumber"]))
		$MobileNumber=trim($_POST["MobileNumber"]);
	if(isset($_POST["EmergencyPerson"]))
		$EmergencyPerson=trim($_POST["EmergencyPerson"]);
	if(isset($_POST["Relationship"]))
		$Relationship=trim($_POST["Relationship"]);
	if(isset($_POST["EmergencyNumber"]))
		$EmergencyNumber=trim($_POST["EmergencyNumber"]);
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_IMAGE_ALLOWED_TYPES))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Only '.implode(", ", $_IMAGE_ALLOWED_TYPES) . ' files can be uploaded.
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_IMAGE_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Image size must be ' . MAX_IMAGE_SIZE . ' KB or less.
			</div>';
		}
	}
		
		
	

		if($CompanyID == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Company.</b>
			</div>';
		}
		else if($EmpID == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Employee ID / Code.</b>
			</div>';
		}
		else if($Role == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Role.</b>
			</div>';
		}
		else if($UserName == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter User Name.</b>
			</div>';
		}
		else if($Password == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Password.</b>
			</div>';
		}
		else if($FirstName == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter FirstName.</b>
			</div>';
		}
		else if($DOB == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Date of Birth.</b>
			</div>';
		}
		else if($Gender == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Gender.</b>
			</div>';
		}
		else if($Nationality == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Nationality.</b>
			</div>';
		}
		else if($EmpType == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Employment Status.</b>
			</div>';
		}
		else if($JoiningDate == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Joining Date.</b>
			</div>';
		}
		else if($Designation == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Designation.</b>
			</div>';
		}
		else if($Department == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Department.</b>
			</div>';
		}
		else if($SalaryDisbursmintPeriod == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Salary Disbursmint Period.</b>
			</div>';
		}
		else if($ScheduleID == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Time Schedule.</b>
			</div>';
		}
		else if($OvertimePolicy == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Overtime Policy.</b>
			</div>';
		}
		else if($LateArrivalPolicy == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Late Arrival Policy.</b>
			</div>';
		}
		else if($EarlyDeparturePolicy == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Early Departure Policy.</b>
			</div>';
		}
		else if($LeaveAdjustPolicy == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Leave Adjust Policy.</b>
			</div>';
		}
		else if($EmailAddress == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter EmailAddress.</b>
			</div>';
		}
		else if(!validEmailAddress($EmailAddress))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter valid EmailAddress.</b>
			</div>';
		}
		else if($Address == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Address.</b>
			</div>';
		}
		else if($Bank == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Bank.</b>
			</div>';
		}
		else if($AccountTitle == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Account Title.</b>
			</div>';
		}
		else if($AccountNumber == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Account Number.</b>
			</div>';
		}
		else if($CNICNumber == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter CNIC Number.</b>
			</div>';
		}
		else if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please Upload Photo.</b>
			</div>';
		}
		

		


	if($msg=="")
	{

		$query="INSERT INTO employees SET DateAdded=NOW(),
				Role = '" . dbinput($Role) . "',
				EmpType = '" . dbinput($EmpType) . "',
				Designation = '" . dbinput($Designation) . "',
				Department = '" . dbinput($Department) . "',
				Grade = '" . dbinput($Grade) . "',
				Supervisor = '" . dbinput($Supervisor) . "',
				AllowEmpLogin = '" . dbinput($AllowEmpLogin) . "',
				UserName = '" . dbinput($UserName) . "',
				Password = '" . dbinput($Password) . "',
				EmailAddress = '" . dbinput($EmailAddress) . "',
				Notifications = '" . dbinput($Notifications) . "',
				Salutation = '" . dbinput($Salutation) . "',
				FirstName = '" . dbinput($FirstName) . "',
				LastName = '" . dbinput($LastName) . "',
				FatherName = '" . dbinput($FatherName) . "',
				DOB = '" . dbinput($DOB) . "',
				MaritalStatus = '" . dbinput($MaritalStatus) . "',
				Gender = '" . dbinput($Gender) . "',
				BloodGroup = '" . dbinput($BloodGroup) . "',
				Nationality = '" . dbinput($Nationality) . "',
				JoiningDate = '" . dbinput($JoiningDate) . "',
				LeavingDate = '" . dbinput($LeavingDate) . "',
				EmpID = '" . dbinput($EmpID) . "',
				Status = '" . dbinput($Status) . "',
				CNICNumber = '" . dbinput($CNICNumber) . "',
				CNICPlace = '" . dbinput($CNICPlace) . "',
				CNICExpiration = '" . dbinput($CNICExpiration) . "',
				PassportNumber = '" . dbinput($PassportNumber) . "',
				PassportPlace = '" . dbinput($PassportPlace) . "',
				PassportExpiration = '" . dbinput($PassportExpiration) . "',
				DrivingLicenseNumber = '" . dbinput($DrivingLicenseNumber) . "',
				DrivingLicensePlace = '" . dbinput($DrivingLicensePlace) . "',
				DrivingLicenseExpiration = '" . dbinput($DrivingLicenseExpiration) . "',
				NOY = '" . (int)$NOY . "',
				NOM = '" . (int)$NOM . "',
				LastCompany = '" . dbinput($LastCompany) . "',
				LastDesignation = '" . dbinput($LastDesignation) . "',
				LastSalary = '" . dbinput($LastSalary) . "',
				LastWorkingDay = '" . dbinput($LastWorkingDay) . "',
				IsFirstJob = '" . dbinput($IsFirstJob) . "',
				Address = '" . dbinput($Address) . "',
				CompanyID = '" . (int)$CompanyID . "',
				MachineID = '" . dbinput($MachineID) . "',
				EmploymentType = '" . dbinput($EmploymentType) . "',
				Location = '" . dbinput($Location) . "',
				SalaryDisbursmintPeriod = '" . dbinput($SalaryDisbursmintPeriod) . "',
				SESSINo = '" . dbinput($SESSINo) . "',
				EOBINo = '" . dbinput($EOBINo) . "',
				IncomeTax = '" . dbinput($IncomeTax) . "',
				Bonus = '" . dbinput($Bonus) . "',
				ProvidentFund = '" . dbinput($ProvidentFund) . "',
				SESSI = '" . dbinput($SESSI) . "',
				EOBI = '" . dbinput($EOBI) . "',
				CanTakeLoan = '" . dbinput($CanTakeLoan) . "',
				CanTakeAdvance = '" . dbinput($CanTakeAdvance) . "',
				PayFullSalary = '" . dbinput($PayFullSalary) . "',
				SalePersonOutdoorPerson = '" . dbinput($SalePersonOutdoorPerson) . "',
				StopSalary = '" . dbinput($StopSalary) . "',
				ScheduleID = '" . (int)$ScheduleID . "',
				OvertimePolicy = '" . dbinput($OvertimePolicy) . "',
				LateArrivalPolicy = '" . dbinput($LateArrivalPolicy) . "',
				EarlyDeparturePolicy = '" . dbinput($EarlyDeparturePolicy) . "',
				LeaveAdjustPolicy = '" . dbinput($LeaveAdjustPolicy) . "',
				AverageWorkingHours = '" . dbinput($AverageWorkingHours) . "',
				WorkingType = '" . dbinput($WorkingType) . "',
				LeavesDays = '" . dbinput($LeavesDays) . "',
				HalfDays = '" . dbinput($HalfDays) . "',
				Religion = '" . dbinput($Religion) . "',
				Bank = '" . dbinput($Bank) . "',
				AccountTitle = '" . dbinput($AccountTitle) . "',
				AccountNumber = '" . dbinput($AccountNumber) . "',
				LastEducationDegree = '" . dbinput($LastEducationDegree) . "',
				UniversityCollege = '" . dbinput($UniversityCollege) . "',
				EducationCompletionYear = '" . (int)$EducationCompletionYear . "',
				GradeMarksPercentage = '" . dbinput($GradeMarksPercentage) . "',
				LastTechnicalEducationCertificate = '" . dbinput($LastTechnicalEducationCertificate) . "',
				UniversityInstitute = '" . dbinput($UniversityInstitute) . "',
				TechnicalEducationCompletionYear = '" . (int)$TechnicalEducationCompletionYear . "',
				GradePercentageMarks = '" . dbinput($GradePercentageMarks) . "',
				HomeNumber = '" . dbinput($HomeNumber) . "',
				OfficeNumber = '" . dbinput($OfficeNumber) . "',
				MobileNumber = '" . dbinput($MobileNumber) . "',
				EmergencyPerson = '" . dbinput($EmergencyPerson) . "',
				Relationship = '" . dbinput($Relationship) . "',
				EmergencyNumber = '" . dbinput($EmergencyNumber) . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Employee has been added.</b>
		</div>';

		if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
		{
			
		
			ini_set('memory_limit', '-1');
			
			$tempName = $_FILES["flPage"]['tmp_name'];
			$realName = "EMP".$ID . "." . $ext;
			$StoreImage = $realName; 
			$target = DIR_EMPLOYEEPHOTOES . $realName;
			if(is_file(DIR_EMPLOYEEPHOTOES . $StoreImage))
				unlink(DIR_EMPLOYEEPHOTOES . $StoreImage);
			$moved=move_uploaded_file($tempName, $target);
		
			if($moved)
			{			
			
				$query="UPDATE employees SET Photo='" . dbinput($realName) . "' WHERE  ID=" . (int)$ID;
				mysql_query($query) or die(mysql_error());
			}
			else
			{
				$_SESSION["msg"]='<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<b>Employee has been saved but Photo can not be uploaded.</b>
					</div>';
			}
		}
		
		redirect("AddNewEmployee.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Employee</title>
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



</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php
		include_once("Header.php");
		?>
		
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
		
		$("#EmpID").keyup(function () {
			
			$.ajax({			
					url: 'get_empid_availablity.php?ID='+$("#EmpID").val(),
					success: function(data) {
						$("#Availablity").html(data);
					},
					error: function (xhr, textStatus, errorThrown) {
						alert(xhr.responseText);
						$("#Availablity").removeAttr("disabled");
					}
			});

		});		
		
		
	}); 
</script>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
	include_once("Sidebar.php");
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Add Employee</h1>
      <ol class="breadcrumb">
        <li><a href="Employees.php"><i class="fa fa-dashboard"></i>Employees</a></li>
        <li class="active">Add Employee</li>
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
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Main</a></li>
				<li><a href="#tab_2" data-toggle="tab">Official</a></li>
				<li><a href="#tab_3" data-toggle="tab">Personal Info</a></li>
				<li><a href="#tab_4" data-toggle="tab">Facilities</a></li>
				<li><a href="#tab_5" data-toggle="tab">Pay Structure</a></li>
				<li><a href="#tab_6" data-toggle="tab">Qualifications</a></li>
			</ul>
			<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				<div class="col-md-4">
				
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Employee Identification</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						<div class="form-group">
						  <label id="labelimp" for="CompanyID" >Company:<span class="requiredStar">*</span> </label>
						  
						  <select required name="CompanyID" id="CompanyID" class="form-control">
							<option value="">Select Company</option>
							<?php
							 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($CompanyID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmpID">Employee ID/Code:<span class="requiredStar">*</span> </label> <span id="Availablity"></span>
						  <?php 
						echo '<input type="text" required maxlength="100" id="EmpID" name="EmpID" class="form-control"  value="'.$EmpID.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="MachineID">Machine ID/Code: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="MachineID" name="MachineID" class="form-control"  value="'.$MachineID.'" />';
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
						<h3 class="box-title">User Authentications</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
						
						<div class="form-group">
						  <label id="labelimp" for="Role" >Role:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Role" id="Role" class="form-control">
							<option value="" >Select Role</option>
							<?php
							foreach($_ROLES as $roles)
							{
							echo '<option '.($Role == $roles ? 'selected' : '').' value="'.$roles.'">'.$roles.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="UserName">User Name:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input type="text" required maxlength="100" id="UserName" name="UserName" class="form-control"  value="'.$UserName.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Password">Password:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="password" maxlength="100" id="Password" name="Password" class="form-control"  value="'.$Password.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Allow Employee Login: </label>
						  <label>
						  <input type="radio" name="AllowEmpLogin" value="Yes"<?php echo ($AllowEmpLogin == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="AllowEmpLogin" value="No"<?php echo ($AllowEmpLogin == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
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
						<h3 class="box-title">Basic Personal Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						<div class="form-group">
						  <label id="labelimp" for="Salutation" >Salutation: </label>
						  
						  <select name="Salutation" id="Salutation" class="form-control">
							<option value="" >Select Salutation</option>
							<?php
							foreach($_SALUTATION as $salutations)
							{
							echo '<option '.($Salutation == $salutations ? 'selected' : '').' value="'.$salutations.'">'.$salutations.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="FirstName">First Name:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="text" maxlength="100" id="FirstName" name="FirstName" class="form-control"  value="'.$FirstName.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastName">Last Name: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastName" name="LastName" class="form-control"  value="'.$LastName.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="FatherName">Father Name: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="FatherName" name="FatherName" class="form-control"  value="'.$FatherName.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DOB">Date of Birth:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input type="date" required maxlength="100" id="DOB" name="DOB" class="form-control"  value="'.$DOB.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Gender" >Gender:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Gender" id="Gender" class="form-control">
							<option value="" >Select Gender</option>
							<?php
							foreach($_GENDER as $genders)
							{
							echo '<option '.($Gender == $genders ? 'selected' : '').' value="'.$genders.'">'.$genders.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Nationality" >Nationality:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Nationality" id="Nationality" class="form-control">
							<option value="" >Select Nationality</option>
							<option <?php echo ($Nationality == 'AFG' ? 'selected' : ''); ?> value="AFG">Afghanistan</option>
							<option <?php echo ($Nationality == 'ALA' ? 'selected' : ''); ?> value="ALA">Aland Islands</option>
							<option <?php echo ($Nationality == 'ALB' ? 'selected' : ''); ?> value="ALB">Albania</option>
							<option <?php echo ($Nationality == 'DZA' ? 'selected' : ''); ?> value="DZA">Algeria</option>
							<option <?php echo ($Nationality == 'ASM' ? 'selected' : ''); ?> value="ASM">American Samoa</option>
							<option <?php echo ($Nationality == 'AND' ? 'selected' : ''); ?> value="AND">Andorra</option>
							<option <?php echo ($Nationality == 'AGO' ? 'selected' : ''); ?> value="AGO">Angola</option>
							<option <?php echo ($Nationality == 'AIA' ? 'selected' : ''); ?> value="AIA">Anguilla</option>
							<option <?php echo ($Nationality == 'ATA' ? 'selected' : ''); ?> value="ATA">Antarctica</option>
							<option <?php echo ($Nationality == 'ATG' ? 'selected' : ''); ?> value="ATG">Antigua and Barbuda</option>
							<option <?php echo ($Nationality == 'ARG' ? 'selected' : ''); ?> value="ARG">Argentina</option>
							<option <?php echo ($Nationality == 'ARM' ? 'selected' : ''); ?> value="ARM">Armenia</option>
							<option <?php echo ($Nationality == 'ABW' ? 'selected' : ''); ?> value="ABW">Aruba</option>
							<option <?php echo ($Nationality == 'AUS' ? 'selected' : ''); ?> value="AUS">Australia</option>
							<option <?php echo ($Nationality == 'AUT' ? 'selected' : ''); ?> value="AUT">Austria</option>
							<option <?php echo ($Nationality == 'AZE' ? 'selected' : ''); ?> value="AZE">Azerbaijan</option>
							<option <?php echo ($Nationality == 'BHS' ? 'selected' : ''); ?> value="BHS">Bahamas</option>
							<option <?php echo ($Nationality == 'BHR' ? 'selected' : ''); ?> value="BHR">Bahrain</option>
							<option <?php echo ($Nationality == 'BGD' ? 'selected' : ''); ?> value="BGD">Bangladesh</option>
							<option <?php echo ($Nationality == 'BRB' ? 'selected' : ''); ?> value="BRB">Barbados</option>
							<option <?php echo ($Nationality == 'BLR' ? 'selected' : ''); ?> value="BLR">Belarus</option>
							<option <?php echo ($Nationality == 'BEL' ? 'selected' : ''); ?> value="BEL">Belgium</option>
							<option <?php echo ($Nationality == 'BLZ' ? 'selected' : ''); ?> value="BLZ">Belize</option>
							<option <?php echo ($Nationality == 'BEN' ? 'selected' : ''); ?> value="BEN">Benin</option>
							<option <?php echo ($Nationality == 'BMU' ? 'selected' : ''); ?> value="BMU">Bermuda</option>
							<option <?php echo ($Nationality == 'BTN' ? 'selected' : ''); ?> value="BTN">Bhutan</option>
							<option <?php echo ($Nationality == 'BOL' ? 'selected' : ''); ?> value="BOL">Bolivia, Plurinational State of</option>
							<option <?php echo ($Nationality == 'BES' ? 'selected' : ''); ?> value="BES">Bonaire, Sint Eustatius and Saba</option>
							<option <?php echo ($Nationality == 'BIH' ? 'selected' : ''); ?> value="BIH">Bosnia and Herzegovina</option>
							<option <?php echo ($Nationality == 'BWA' ? 'selected' : ''); ?> value="BWA">Botswana</option>
							<option <?php echo ($Nationality == 'BVT' ? 'selected' : ''); ?> value="BVT">Bouvet Island</option>
							<option <?php echo ($Nationality == 'BRA' ? 'selected' : ''); ?> value="BRA">Brazil</option>
							<option <?php echo ($Nationality == 'IOT' ? 'selected' : ''); ?> value="IOT">British Indian Ocean Territory</option>
							<option <?php echo ($Nationality == 'BRN' ? 'selected' : ''); ?> value="BRN">Brunei Darussalam</option>
							<option <?php echo ($Nationality == 'BGR' ? 'selected' : ''); ?> value="BGR">Bulgaria</option>
							<option <?php echo ($Nationality == 'BFA' ? 'selected' : ''); ?> value="BFA">Burkina Faso</option>
							<option <?php echo ($Nationality == 'BDI' ? 'selected' : ''); ?> value="BDI">Burundi</option>
							<option <?php echo ($Nationality == 'KHM' ? 'selected' : ''); ?> value="KHM">Cambodia</option>
							<option <?php echo ($Nationality == 'CMR' ? 'selected' : ''); ?> value="CMR">Cameroon</option>
							<option <?php echo ($Nationality == 'CAN' ? 'selected' : ''); ?> value="CAN">Canada</option>
							<option <?php echo ($Nationality == 'CPV' ? 'selected' : ''); ?> value="CPV">Cape Verde</option>
							<option <?php echo ($Nationality == 'CYM' ? 'selected' : ''); ?> value="CYM">Cayman Islands</option>
							<option <?php echo ($Nationality == 'CAF' ? 'selected' : ''); ?> value="CAF">Central African Republic</option>
							<option <?php echo ($Nationality == 'TCD' ? 'selected' : ''); ?> value="TCD">Chad</option>
							<option <?php echo ($Nationality == 'CHL' ? 'selected' : ''); ?> value="CHL">Chile</option>
							<option <?php echo ($Nationality == 'CHN' ? 'selected' : ''); ?> value="CHN">China</option>
							<option <?php echo ($Nationality == 'CXR' ? 'selected' : ''); ?> value="CXR">Christmas Island</option>
							<option <?php echo ($Nationality == 'CCK' ? 'selected' : ''); ?> value="CCK">Cocos (Keeling) Islands</option>
							<option <?php echo ($Nationality == 'COL' ? 'selected' : ''); ?> value="COL">Colombia</option>
							<option <?php echo ($Nationality == 'COM' ? 'selected' : ''); ?> value="COM">Comoros</option>
							<option <?php echo ($Nationality == 'COG' ? 'selected' : ''); ?> value="COG">Congo</option>
							<option <?php echo ($Nationality == 'COD' ? 'selected' : ''); ?> value="COD">Congo, the Democratic Republic of the</option>
							<option <?php echo ($Nationality == 'COK' ? 'selected' : ''); ?> value="COK">Cook Islands</option>
							<option <?php echo ($Nationality == 'CRI' ? 'selected' : ''); ?> value="CRI">Costa Rica</option>
							<option <?php echo ($Nationality == 'CIV' ? 'selected' : ''); ?> value="CIV">Côte d'Ivoire</option>
							<option <?php echo ($Nationality == 'HRV' ? 'selected' : ''); ?> value="HRV">Croatia</option>
							<option <?php echo ($Nationality == 'CUB' ? 'selected' : ''); ?> value="CUB">Cuba</option>
							<option <?php echo ($Nationality == 'CUW' ? 'selected' : ''); ?> value="CUW">Curaçao</option>
							<option <?php echo ($Nationality == 'CYP' ? 'selected' : ''); ?> value="CYP">Cyprus</option>
							<option <?php echo ($Nationality == 'CZE' ? 'selected' : ''); ?> value="CZE">Czech Republic</option>
							<option <?php echo ($Nationality == 'DNK' ? 'selected' : ''); ?> value="DNK">Denmark</option>
							<option <?php echo ($Nationality == 'DJI' ? 'selected' : ''); ?> value="DJI">Djibouti</option>
							<option <?php echo ($Nationality == 'DMA' ? 'selected' : ''); ?> value="DMA">Dominica</option>
							<option <?php echo ($Nationality == 'DOM' ? 'selected' : ''); ?> value="DOM">Dominican Republic</option>
							<option <?php echo ($Nationality == 'ECU' ? 'selected' : ''); ?> value="ECU">Ecuador</option>
							<option <?php echo ($Nationality == 'EGY' ? 'selected' : ''); ?> value="EGY">Egypt</option>
							<option <?php echo ($Nationality == 'SLV' ? 'selected' : ''); ?> value="SLV">El Salvador</option>
							<option <?php echo ($Nationality == 'GNQ' ? 'selected' : ''); ?> value="GNQ">Equatorial Guinea</option>
							<option <?php echo ($Nationality == 'ERI' ? 'selected' : ''); ?> value="ERI">Eritrea</option>
							<option <?php echo ($Nationality == 'EST' ? 'selected' : ''); ?> value="EST">Estonia</option>
							<option <?php echo ($Nationality == 'ETH' ? 'selected' : ''); ?> value="ETH">Ethiopia</option>
							<option <?php echo ($Nationality == 'FLK' ? 'selected' : ''); ?> value="FLK">Falkland Islands (Malvinas)</option>
							<option <?php echo ($Nationality == 'FRO' ? 'selected' : ''); ?> value="FRO">Faroe Islands</option>
							<option <?php echo ($Nationality == 'FJI' ? 'selected' : ''); ?> value="FJI">Fiji</option>
							<option <?php echo ($Nationality == 'FIN' ? 'selected' : ''); ?> value="FIN">Finland</option>
							<option <?php echo ($Nationality == 'FRA' ? 'selected' : ''); ?> value="FRA">France</option>
							<option <?php echo ($Nationality == 'GUF' ? 'selected' : ''); ?> value="GUF">French Guiana</option>
							<option <?php echo ($Nationality == 'PYF' ? 'selected' : ''); ?> value="PYF">French Polynesia</option>
							<option <?php echo ($Nationality == 'ATF' ? 'selected' : ''); ?> value="ATF">French Southern Territories</option>
							<option <?php echo ($Nationality == 'GAB' ? 'selected' : ''); ?> value="GAB">Gabon</option>
							<option <?php echo ($Nationality == 'GMB' ? 'selected' : ''); ?> value="GMB">Gambia</option>
							<option <?php echo ($Nationality == 'GEO' ? 'selected' : ''); ?> value="GEO">Georgia</option>
							<option <?php echo ($Nationality == 'DEU' ? 'selected' : ''); ?> value="DEU">Germany</option>
							<option <?php echo ($Nationality == 'GHA' ? 'selected' : ''); ?> value="GHA">Ghana</option>
							<option <?php echo ($Nationality == 'GIB' ? 'selected' : ''); ?> value="GIB">Gibraltar</option>
							<option <?php echo ($Nationality == 'GRC' ? 'selected' : ''); ?> value="GRC">Greece</option>
							<option <?php echo ($Nationality == 'GRL' ? 'selected' : ''); ?> value="GRL">Greenland</option>
							<option <?php echo ($Nationality == 'GRD' ? 'selected' : ''); ?> value="GRD">Grenada</option>
							<option <?php echo ($Nationality == 'GLP' ? 'selected' : ''); ?> value="GLP">Guadeloupe</option>
							<option <?php echo ($Nationality == 'GUM' ? 'selected' : ''); ?> value="GUM">Guam</option>
							<option <?php echo ($Nationality == 'GTM' ? 'selected' : ''); ?> value="GTM">Guatemala</option>
							<option <?php echo ($Nationality == 'GGY' ? 'selected' : ''); ?> value="GGY">Guernsey</option>
							<option <?php echo ($Nationality == 'GIN' ? 'selected' : ''); ?> value="GIN">Guinea</option>
							<option <?php echo ($Nationality == 'GNB' ? 'selected' : ''); ?> value="GNB">Guinea-Bissau</option>
							<option <?php echo ($Nationality == 'GUY' ? 'selected' : ''); ?> value="GUY">Guyana</option>
							<option <?php echo ($Nationality == 'HTI' ? 'selected' : ''); ?> value="HTI">Haiti</option>
							<option <?php echo ($Nationality == 'HMD' ? 'selected' : ''); ?> value="HMD">Heard Island and McDonald Islands</option>
							<option <?php echo ($Nationality == 'VAT' ? 'selected' : ''); ?> value="VAT">Holy See (Vatican City State)</option>
							<option <?php echo ($Nationality == 'HND' ? 'selected' : ''); ?> value="HND">Honduras</option>
							<option <?php echo ($Nationality == 'HKG' ? 'selected' : ''); ?> value="HKG">Hong Kong</option>
							<option <?php echo ($Nationality == 'HUN' ? 'selected' : ''); ?> value="HUN">Hungary</option>
							<option <?php echo ($Nationality == 'ISL' ? 'selected' : ''); ?> value="ISL">Iceland</option>
							<option <?php echo ($Nationality == 'IND' ? 'selected' : ''); ?> value="IND">India</option>
							<option <?php echo ($Nationality == 'IDN' ? 'selected' : ''); ?> value="IDN">Indonesia</option>
							<option <?php echo ($Nationality == 'IRN' ? 'selected' : ''); ?> value="IRN">Iran, Islamic Republic of</option>
							<option <?php echo ($Nationality == 'IRQ' ? 'selected' : ''); ?> value="IRQ">Iraq</option>
							<option <?php echo ($Nationality == 'IRL' ? 'selected' : ''); ?> value="IRL">Ireland</option>
							<option <?php echo ($Nationality == 'IMN' ? 'selected' : ''); ?> value="IMN">Isle of Man</option>
							<option <?php echo ($Nationality == 'ISR' ? 'selected' : ''); ?> value="ISR">Israel</option>
							<option <?php echo ($Nationality == 'ITA' ? 'selected' : ''); ?> value="ITA">Italy</option>
							<option <?php echo ($Nationality == 'JAM' ? 'selected' : ''); ?> value="JAM">Jamaica</option>
							<option <?php echo ($Nationality == 'JPN' ? 'selected' : ''); ?> value="JPN">Japan</option>
							<option <?php echo ($Nationality == 'JEY' ? 'selected' : ''); ?> value="JEY">Jersey</option>
							<option <?php echo ($Nationality == 'JOR' ? 'selected' : ''); ?> value="JOR">Jordan</option>
							<option <?php echo ($Nationality == 'KAZ' ? 'selected' : ''); ?> value="KAZ">Kazakhstan</option>
							<option <?php echo ($Nationality == 'KEN' ? 'selected' : ''); ?> value="KEN">Kenya</option>
							<option <?php echo ($Nationality == 'KIR' ? 'selected' : ''); ?> value="KIR">Kiribati</option>
							<option <?php echo ($Nationality == 'PRK' ? 'selected' : ''); ?> value="PRK">Korea, Democratic People's Republic of</option>
							<option <?php echo ($Nationality == 'KOR' ? 'selected' : ''); ?> value="KOR">Korea, Republic of</option>
							<option <?php echo ($Nationality == 'KWT' ? 'selected' : ''); ?> value="KWT">Kuwait</option>
							<option <?php echo ($Nationality == 'KGZ' ? 'selected' : ''); ?> value="KGZ">Kyrgyzstan</option>
							<option <?php echo ($Nationality == 'LAO' ? 'selected' : ''); ?> value="LAO">Lao People's Democratic Republic</option>
							<option <?php echo ($Nationality == 'LVA' ? 'selected' : ''); ?> value="LVA">Latvia</option>
							<option <?php echo ($Nationality == 'LBN' ? 'selected' : ''); ?> value="LBN">Lebanon</option>
							<option <?php echo ($Nationality == 'LSO' ? 'selected' : ''); ?> value="LSO">Lesotho</option>
							<option <?php echo ($Nationality == 'LBR' ? 'selected' : ''); ?> value="LBR">Liberia</option>
							<option <?php echo ($Nationality == 'LBY' ? 'selected' : ''); ?> value="LBY">Libya</option>
							<option <?php echo ($Nationality == 'LIE' ? 'selected' : ''); ?> value="LIE">Liechtenstein</option>
							<option <?php echo ($Nationality == 'LTU' ? 'selected' : ''); ?> value="LTU">Lithuania</option>
							<option <?php echo ($Nationality == 'LUX' ? 'selected' : ''); ?> value="LUX">Luxembourg</option>
							<option <?php echo ($Nationality == 'MAC' ? 'selected' : ''); ?> value="MAC">Macao</option>
							<option <?php echo ($Nationality == 'MKD' ? 'selected' : ''); ?> value="MKD">Macedonia, the former Yugoslav Republic of</option>
							<option <?php echo ($Nationality == 'MDG' ? 'selected' : ''); ?> value="MDG">Madagascar</option>
							<option <?php echo ($Nationality == 'MWI' ? 'selected' : ''); ?> value="MWI">Malawi</option>
							<option <?php echo ($Nationality == 'MYS' ? 'selected' : ''); ?> value="MYS">Malaysia</option>
							<option <?php echo ($Nationality == 'MDV' ? 'selected' : ''); ?> value="MDV">Maldives</option>
							<option <?php echo ($Nationality == 'MLI' ? 'selected' : ''); ?> value="MLI">Mali</option>
							<option <?php echo ($Nationality == 'MLT' ? 'selected' : ''); ?> value="MLT">Malta</option>
							<option <?php echo ($Nationality == 'MHL' ? 'selected' : ''); ?> value="MHL">Marshall Islands</option>
							<option <?php echo ($Nationality == 'MTQ' ? 'selected' : ''); ?> value="MTQ">Martinique</option>
							<option <?php echo ($Nationality == 'MRT' ? 'selected' : ''); ?> value="MRT">Mauritania</option>
							<option <?php echo ($Nationality == 'MUS' ? 'selected' : ''); ?> value="MUS">Mauritius</option>
							<option <?php echo ($Nationality == 'MYT' ? 'selected' : ''); ?> value="MYT">Mayotte</option>
							<option <?php echo ($Nationality == 'MEX' ? 'selected' : ''); ?> value="MEX">Mexico</option>
							<option <?php echo ($Nationality == 'FSM' ? 'selected' : ''); ?> value="FSM">Micronesia, Federated States of</option>
							<option <?php echo ($Nationality == 'MDA' ? 'selected' : ''); ?> value="MDA">Moldova, Republic of</option>
							<option <?php echo ($Nationality == 'MCO' ? 'selected' : ''); ?> value="MCO">Monaco</option>
							<option <?php echo ($Nationality == 'MNG' ? 'selected' : ''); ?> value="MNG">Mongolia</option>
							<option <?php echo ($Nationality == 'MNE' ? 'selected' : ''); ?> value="MNE">Montenegro</option>
							<option <?php echo ($Nationality == 'MSR' ? 'selected' : ''); ?> value="MSR">Montserrat</option>
							<option <?php echo ($Nationality == 'MAR' ? 'selected' : ''); ?> value="MAR">Morocco</option>
							<option <?php echo ($Nationality == 'MOZ' ? 'selected' : ''); ?> value="MOZ">Mozambique</option>
							<option <?php echo ($Nationality == 'MMR' ? 'selected' : ''); ?> value="MMR">Myanmar</option>
							<option <?php echo ($Nationality == 'NAM' ? 'selected' : ''); ?> value="NAM">Namibia</option>
							<option <?php echo ($Nationality == 'NRU' ? 'selected' : ''); ?> value="NRU">Nauru</option>
							<option <?php echo ($Nationality == 'NPL' ? 'selected' : ''); ?> value="NPL">Nepal</option>
							<option <?php echo ($Nationality == 'NLD' ? 'selected' : ''); ?> value="NLD">Netherlands</option>
							<option <?php echo ($Nationality == 'NCL' ? 'selected' : ''); ?> value="NCL">New Caledonia</option>
							<option <?php echo ($Nationality == 'NZL' ? 'selected' : ''); ?> value="NZL">New Zealand</option>
							<option <?php echo ($Nationality == 'NIC' ? 'selected' : ''); ?> value="NIC">Nicaragua</option>
							<option <?php echo ($Nationality == 'NER' ? 'selected' : ''); ?> value="NER">Niger</option>
							<option <?php echo ($Nationality == 'NGA' ? 'selected' : ''); ?> value="NGA">Nigeria</option>
							<option <?php echo ($Nationality == 'NIU' ? 'selected' : ''); ?> value="NIU">Niue</option>
							<option <?php echo ($Nationality == 'NFK' ? 'selected' : ''); ?> value="NFK">Norfolk Island</option>
							<option <?php echo ($Nationality == 'MNP' ? 'selected' : ''); ?> value="MNP">Northern Mariana Islands</option>
							<option <?php echo ($Nationality == 'NOR' ? 'selected' : ''); ?> value="NOR">Norway</option>
							<option <?php echo ($Nationality == 'OMN' ? 'selected' : ''); ?> value="OMN">Oman</option>
							<option <?php echo ($Nationality == 'PAK' ? 'selected' : ''); ?> value="PAK">Pakistan</option>
							<option <?php echo ($Nationality == 'PLW' ? 'selected' : ''); ?> value="PLW">Palau</option>
							<option <?php echo ($Nationality == 'PSE' ? 'selected' : ''); ?> value="PSE">Palestinian Territory, Occupied</option>
							<option <?php echo ($Nationality == 'PAN' ? 'selected' : ''); ?> value="PAN">Panama</option>
							<option <?php echo ($Nationality == 'PNG' ? 'selected' : ''); ?> value="PNG">Papua New Guinea</option>
							<option <?php echo ($Nationality == 'PRY' ? 'selected' : ''); ?> value="PRY">Paraguay</option>
							<option <?php echo ($Nationality == 'PER' ? 'selected' : ''); ?> value="PER">Peru</option>
							<option <?php echo ($Nationality == 'PHL' ? 'selected' : ''); ?> value="PHL">Philippines</option>
							<option <?php echo ($Nationality == 'PCN' ? 'selected' : ''); ?> value="PCN">Pitcairn</option>
							<option <?php echo ($Nationality == 'POL' ? 'selected' : ''); ?> value="POL">Poland</option>
							<option <?php echo ($Nationality == 'PRT' ? 'selected' : ''); ?> value="PRT">Portugal</option>
							<option <?php echo ($Nationality == 'PRI' ? 'selected' : ''); ?> value="PRI">Puerto Rico</option>
							<option <?php echo ($Nationality == 'QAT' ? 'selected' : ''); ?> value="QAT">Qatar</option>
							<option <?php echo ($Nationality == 'REU' ? 'selected' : ''); ?> value="REU">Réunion</option>
							<option <?php echo ($Nationality == 'ROU' ? 'selected' : ''); ?> value="ROU">Romania</option>
							<option <?php echo ($Nationality == 'RUS' ? 'selected' : ''); ?> value="RUS">Russian Federation</option>
							<option <?php echo ($Nationality == 'RWA' ? 'selected' : ''); ?> value="RWA">Rwanda</option>
							<option <?php echo ($Nationality == 'BLM' ? 'selected' : ''); ?> value="BLM">Saint Barthélemy</option>
							<option <?php echo ($Nationality == 'SHN' ? 'selected' : ''); ?> value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
							<option <?php echo ($Nationality == 'KNA' ? 'selected' : ''); ?> value="KNA">Saint Kitts and Nevis</option>
							<option <?php echo ($Nationality == 'LCA' ? 'selected' : ''); ?> value="LCA">Saint Lucia</option>
							<option <?php echo ($Nationality == 'MAF' ? 'selected' : ''); ?> value="MAF">Saint Martin (French part)</option>
							<option <?php echo ($Nationality == 'SPM' ? 'selected' : ''); ?> value="SPM">Saint Pierre and Miquelon</option>
							<option <?php echo ($Nationality == 'VCT' ? 'selected' : ''); ?> value="VCT">Saint Vincent and the Grenadines</option>
							<option <?php echo ($Nationality == 'WSM' ? 'selected' : ''); ?> value="WSM">Samoa</option>
							<option <?php echo ($Nationality == 'SMR' ? 'selected' : ''); ?> value="SMR">San Marino</option>
							<option <?php echo ($Nationality == 'STP' ? 'selected' : ''); ?> value="STP">Sao Tome and Principe</option>
							<option <?php echo ($Nationality == 'SAU' ? 'selected' : ''); ?> value="SAU">Saudi Arabia</option>
							<option <?php echo ($Nationality == 'SEN' ? 'selected' : ''); ?> value="SEN">Senegal</option>
							<option <?php echo ($Nationality == 'SRB' ? 'selected' : ''); ?> value="SRB">Serbia</option>
							<option <?php echo ($Nationality == 'SYC' ? 'selected' : ''); ?> value="SYC">Seychelles</option>
							<option <?php echo ($Nationality == 'SLE' ? 'selected' : ''); ?> value="SLE">Sierra Leone</option>
							<option <?php echo ($Nationality == 'SGP' ? 'selected' : ''); ?> value="SGP">Singapore</option>
							<option <?php echo ($Nationality == 'SXM' ? 'selected' : ''); ?> value="SXM">Sint Maarten (Dutch part)</option>
							<option <?php echo ($Nationality == 'SVK' ? 'selected' : ''); ?> value="SVK">Slovakia</option>
							<option <?php echo ($Nationality == 'SVN' ? 'selected' : ''); ?> value="SVN">Slovenia</option>
							<option <?php echo ($Nationality == 'SLB' ? 'selected' : ''); ?> value="SLB">Solomon Islands</option>
							<option <?php echo ($Nationality == 'SOM' ? 'selected' : ''); ?> value="SOM">Somalia</option>
							<option <?php echo ($Nationality == 'ZAF' ? 'selected' : ''); ?> value="ZAF">South Africa</option>
							<option <?php echo ($Nationality == 'SGS' ? 'selected' : ''); ?> value="SGS">South Georgia and the South Sandwich Islands</option>
							<option <?php echo ($Nationality == 'SSD' ? 'selected' : ''); ?> value="SSD">South Sudan</option>
							<option <?php echo ($Nationality == 'ESP' ? 'selected' : ''); ?> value="ESP">Spain</option>
							<option <?php echo ($Nationality == 'LKA' ? 'selected' : ''); ?> value="LKA">Sri Lanka</option>
							<option <?php echo ($Nationality == 'SDN' ? 'selected' : ''); ?> value="SDN">Sudan</option>
							<option <?php echo ($Nationality == 'SUR' ? 'selected' : ''); ?> value="SUR">Suriname</option>
							<option <?php echo ($Nationality == 'SJM' ? 'selected' : ''); ?> value="SJM">Svalbard and Jan Mayen</option>
							<option <?php echo ($Nationality == 'SWZ' ? 'selected' : ''); ?> value="SWZ">Swaziland</option>
							<option <?php echo ($Nationality == 'SWE' ? 'selected' : ''); ?> value="SWE">Sweden</option>
							<option <?php echo ($Nationality == 'CHE' ? 'selected' : ''); ?> value="CHE">Switzerland</option>
							<option <?php echo ($Nationality == 'SYR' ? 'selected' : ''); ?> value="SYR">Syrian Arab Republic</option>
							<option <?php echo ($Nationality == 'TWN' ? 'selected' : ''); ?> value="TWN">Taiwan, Province of China</option>
							<option <?php echo ($Nationality == 'TJK' ? 'selected' : ''); ?> value="TJK">Tajikistan</option>
							<option <?php echo ($Nationality == 'TZA' ? 'selected' : ''); ?> value="TZA">Tanzania, United Republic of</option>
							<option <?php echo ($Nationality == 'THA' ? 'selected' : ''); ?> value="THA">Thailand</option>
							<option <?php echo ($Nationality == 'TLS' ? 'selected' : ''); ?> value="TLS">Timor-Leste</option>
							<option <?php echo ($Nationality == 'TGO' ? 'selected' : ''); ?> value="TGO">Togo</option>
							<option <?php echo ($Nationality == 'TKL' ? 'selected' : ''); ?> value="TKL">Tokelau</option>
							<option <?php echo ($Nationality == 'TON' ? 'selected' : ''); ?> value="TON">Tonga</option>
							<option <?php echo ($Nationality == 'TTO' ? 'selected' : ''); ?> value="TTO">Trinidad and Tobago</option>
							<option <?php echo ($Nationality == 'TUN' ? 'selected' : ''); ?> value="TUN">Tunisia</option>
							<option <?php echo ($Nationality == 'TUR' ? 'selected' : ''); ?> value="TUR">Turkey</option>
							<option <?php echo ($Nationality == 'TKM' ? 'selected' : ''); ?> value="TKM">Turkmenistan</option>
							<option <?php echo ($Nationality == 'TCA' ? 'selected' : ''); ?> value="TCA">Turks and Caicos Islands</option>
							<option <?php echo ($Nationality == 'TUV' ? 'selected' : ''); ?> value="TUV">Tuvalu</option>
							<option <?php echo ($Nationality == 'UGA' ? 'selected' : ''); ?> value="UGA">Uganda</option>
							<option <?php echo ($Nationality == 'UKR' ? 'selected' : ''); ?> value="UKR">Ukraine</option>
							<option <?php echo ($Nationality == 'ARE' ? 'selected' : ''); ?> value="ARE">United Arab Emirates</option>
							<option <?php echo ($Nationality == 'GBR' ? 'selected' : ''); ?> value="GBR">United Kingdom</option>
							<option <?php echo ($Nationality == 'USA' ? 'selected' : ''); ?> value="USA">United States</option>
							<option <?php echo ($Nationality == 'UMI' ? 'selected' : ''); ?> value="UMI">United States Minor Outlying Islands</option>
							<option <?php echo ($Nationality == 'URY' ? 'selected' : ''); ?> value="URY">Uruguay</option>
							<option <?php echo ($Nationality == 'UZB' ? 'selected' : ''); ?> value="UZB">Uzbekistan</option>
							<option <?php echo ($Nationality == 'VUT' ? 'selected' : ''); ?> value="VUT">Vanuatu</option>
							<option <?php echo ($Nationality == 'VEN' ? 'selected' : ''); ?> value="VEN">Venezuela, Bolivarian Republic of</option>
							<option <?php echo ($Nationality == 'VNM' ? 'selected' : ''); ?> value="VNM">Viet Nam</option>
							<option <?php echo ($Nationality == 'VGB' ? 'selected' : ''); ?> value="VGB">Virgin Islands, British</option>
							<option <?php echo ($Nationality == 'VIR' ? 'selected' : ''); ?> value="VIR">Virgin Islands, U.S.</option>
							<option <?php echo ($Nationality == 'WLF' ? 'selected' : ''); ?> value="WLF">Wallis and Futuna</option>
							<option <?php echo ($Nationality == 'ESH' ? 'selected' : ''); ?> value="ESH">Western Sahara</option>
							<option <?php echo ($Nationality == 'YEM' ? 'selected' : ''); ?> value="YEM">Yemen</option>
							<option <?php echo ($Nationality == 'ZMB' ? 'selected' : ''); ?> value="ZMB">Zambia</option>
							<option <?php echo ($Nationality == 'ZWE' ? 'selected' : ''); ?> value="ZWE">Zimbabwe</option>
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
				  
				  
				  <div class="box box-solid">
					<div class="box-header bg-box-blue">
						<h3 class="box-title">Employee Photo</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" for="flPage" class="labelimp" >Upload Photo:<span class="requiredStar">*</span> </label>
						  <input required type="file" name="flPage" />
						  <p class="help-block">Image types allowed: jpg, jpeg, gif, png.</p>
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
						<h3 class="box-title">Employment Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						
						<div class="form-group">
						  <label id="labelimp" for="EmpType" >Employee Type / Employment Status:<span class="requiredStar">*</span> </label>
						  
						  <select required name="EmpType" id="EmpType" class="form-control">
							<option value="" >Select Employee Type</option>
							<?php
							foreach($_EMPLOYEETYPES as $empTypes)
							{
							echo '<option '.($EmpType == $empTypes ? 'selected' : '').' value="'.$empTypes.'">'.$empTypes.'</option>';
							} 
							?>
							</select>
						</div>
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="BasicSalary">Basic Salary: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="BasicSalary" name="BasicSalary" class="form-control"  value="'.$BasicSalary.'" />';
						?>
						</div>
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="JoiningDate">Joining Date:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="date" maxlength="100" id="JoiningDate" name="JoiningDate" class="form-control"  value="'.$JoiningDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LeavingDate">Leaving Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="LeavingDate" name="LeavingDate" class="form-control"  value="'.$LeavingDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Status: </label>
						  <label>
						  <input type="radio" name="Status" value="Active"<?php echo ($Status == "Active" ? ' checked="checked"' : ''); ?>>
						  Active</label>
						  <label>
						  <input type="radio" name="Status" value="Deactive"<?php echo ($Status == "Deactive" ? ' checked="checked"' : ''); ?>>
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
				</div>
		<div class="tab-pane" id="tab_2">
				<div class="col-md-4">
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Employee Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
						
						
						<div class="form-group">
						  <label id="labelimp" for="Designation" >Designation:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Designation" id="Designation" class="form-control">
							<option value="" >Select Designation</option>
							<?php
							foreach($_DESIGNATION as $designations)
							{
							echo '<option '.($Designation == $designations ? 'selected' : '').' value="'.$designations.'">'.$designations.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Department" >Department:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Department" id="Department" class="form-control">
							<option value="" >Select Department</option>
							<?php
							foreach($_DEPARTMENT as $departments)
							{
							echo '<option '.($Department == $departments ? 'selected' : '').' value="'.$departments.'">'.$departments.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="EmploymentType" >Employment Type: </label>
						  
						  <select name="EmploymentType" id="EmploymentType" class="form-control">
							<option value="" >Select Employment Type</option>
							<option <?php echo ($EmploymentType == 'Management Staff' ? 'selected' : ''); ?> value="Management Staff">Management Staff</option>
							<option <?php echo ($EmploymentType == 'Non Management Staff' ? 'selected' : ''); ?> value="Non Management Staff">Non Management Staff</option>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Grade" >Grade: </label>
						  
						  <select name="Grade" id="Grade" class="form-control">
							<option value="" >Select Grade</option>
							<?php
							foreach($_GRADE as $grades)
							{
							echo '<option '.($Grade == $grades ? 'selected' : '').' value="'.$grades.'">'.$grades.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Supervisor" >Supervisor: </label>
						  <select name="Supervisor" id="Supervisor" class="form-control">
							<option value="" >Select Supervisor</option>
							<?php
							 $query = "SELECT EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY Department,Designation ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Supervisor == $row['EmpID'] ? 'selected' : '').' value="'.$row['EmpID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
							</select>
						</div>	

						<div class="form-group">
						  <label id="labelimp" for="Location" >Location: </label>
						  
						  <select name="Location" id="Location" class="form-control">
							<option value="" >Select Location</option>
							<?php
							 $query = "SELECT Name FROM locations where Status = 1 ORDER BY CompanyID,Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Location == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="SalaryDisbursmintPeriod" >Salary Disbursmint Period:<span class="requiredStar">*</span> </label>
						  
						  <select required name="SalaryDisbursmintPeriod" id="SalaryDisbursmintPeriod" class="form-control">
							<option value="" >Select Salary Disbursmint Period</option>
							<option <?php echo ($SalaryDisbursmintPeriod == 'Weekly' ? 'selected' : ''); ?> value="Weekly">Weekly</option>
							<option <?php echo ($SalaryDisbursmintPeriod == 'Twice in a Month' ? 'selected' : ''); ?> value="Twice in a Month">Twice in a Month</option>
							<option <?php echo ($SalaryDisbursmintPeriod == 'Monthly' ? 'selected' : ''); ?> value="Monthly">Monthly</option>
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
						<h3 class="box-title">Employee Notifications</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" >Notifications By Email: </label>
						  <label>
						  <input type="radio" name="Notifications" value="Yes"<?php echo ($Notifications == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="Notifications" value="No"<?php echo ($Notifications == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
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
						<h3 class="box-title">Payroll Policies</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="SESSINo">SESSI No: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="SESSINo" name="SESSINo" class="form-control"  value="'.$SESSINo.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EOBINo">EOBI No: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="EOBINo" name="EOBINo" class="form-control"  value="'.$EOBINo.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Income Tax: </label>
						  <label>
						  <input type="radio" name="IncomeTax" value="Yes"<?php echo ($IncomeTax == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="IncomeTax" value="No"<?php echo ($IncomeTax == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Bonus: </label>
						  <label>
						  <input type="radio" name="Bonus" value="Yes"<?php echo ($Bonus == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="Bonus" value="No"<?php echo ($Bonus == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Provident Fund: </label>
						  <label>
						  <input type="radio" name="ProvidentFund" value="Yes"<?php echo ($ProvidentFund == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="ProvidentFund" value="No"<?php echo ($ProvidentFund == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >SESSI: </label>
						  <label>
						  <input type="radio" name="SESSI" value="Yes"<?php echo ($SESSI == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="SESSI" value="No"<?php echo ($SESSI == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >EOBI: </label>
						  <label>
						  <input type="radio" name="EOBI" value="Yes"<?php echo ($EOBI == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="EOBI" value="No"<?php echo ($EOBI == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Can Take Loan: </label>
						  <label>
						  <input type="radio" name="CanTakeLoan" value="Yes"<?php echo ($CanTakeLoan == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="CanTakeLoan" value="No"<?php echo ($CanTakeLoan == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Can Take Advance: </label>
						  <label>
						  <input type="radio" name="CanTakeAdvance" value="Yes"<?php echo ($CanTakeAdvance == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="CanTakeAdvance" value="No"<?php echo ($CanTakeAdvance == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Pay Full Salary: </label>
						  <label>
						  <input type="radio" name="PayFullSalary" value="Yes"<?php echo ($PayFullSalary == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="PayFullSalary" value="No"<?php echo ($PayFullSalary == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Sale Person / Outdoor Person: </label>
						  <label>
						  <input type="radio" name="SalePersonOutdoorPerson" value="Yes"<?php echo ($SalePersonOutdoorPerson == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="SalePersonOutdoorPerson" value="No"<?php echo ($SalePersonOutdoorPerson == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Stop Salary: </label>
						  <label>
						  <input type="radio" name="StopSalary" value="Yes"<?php echo ($StopSalary == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="StopSalary" value="No"<?php echo ($StopSalary == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
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
						<h3 class="box-title">Attendance Policies</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" for="ScheduleID" >Schedule Name:<span class="requiredStar">*</span> </label>
						  
						  <select required name="ScheduleID" id="ScheduleID" class="form-control">
							<option value="" >Select Schedule</option>
							<?php
							 $query = "SELECT s.ID,s.Name AS Schedule,c.Name FROM schedules s LEFT JOIN companies c ON s.CompanyID = c.ID where s.Status = 1 ORDER BY c.Name,s.ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($ScheduleID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">('.$row['ID'].') '.$row['Schedule'].' | '.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>
						
						
						<div class="form-group">
						  <label id="labelimp" for="OvertimePolicy" >Overtime Policy:<span class="requiredStar">*</span> </label>
						  
						  <select required name="OvertimePolicy" id="OvertimePolicy" class="form-control">
							<option value="" >Select Overtime Policy</option>
							<option <?php echo ($OvertimePolicy == 'Overtime Policy 1' ? 'selected' : ''); ?> value="Overtime Policy 1">Overtime Policy 1</option>
							<option <?php echo ($OvertimePolicy == 'Overtime Policy 2' ? 'selected' : ''); ?> value="Overtime Policy 2">Overtime Policy 2</option>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="LateArrivalPolicy" >Late Arrival Policy:<span class="requiredStar">*</span> </label>
						  
						  <select required name="LateArrivalPolicy" id="LateArrivalPolicy" class="form-control">
							<option value="" >Select Late Arrival Policy</option>
							<option <?php echo ($LateArrivalPolicy == 'Late Arrival Policy 1' ? 'selected' : ''); ?> value="Late Arrival Policy 1">Late Arrival Policy 1</option>
							<option <?php echo ($LateArrivalPolicy == 'Late Arrival Policy 2' ? 'selected' : ''); ?> value="Late Arrival Policy 2">Late Arrival Policy 2</option>
							</select>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="EarlyDeparturePolicy" >Early Departure Policy:<span class="requiredStar">*</span> </label>
						  
						  <select required name="EarlyDeparturePolicy" id="EarlyDeparturePolicy" class="form-control">
							<option value="" >Select Early Departure Policy</option>
							<option <?php echo ($EarlyDeparturePolicy == 'Early Departure Policy 1' ? 'selected' : ''); ?> value="Early Departure Policy 1">Early Departure Policy 1</option>
							<option <?php echo ($EarlyDeparturePolicy == 'Early Departure Policy 2' ? 'selected' : ''); ?> value="Early Departure Policy 2">Early Departure Policy 2</option>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="LeaveAdjustPolicy" >Leave Adjust Policy:<span class="requiredStar">*</span> </label>
						  
						  <select required name="LeaveAdjustPolicy" id="LeaveAdjustPolicy" class="form-control">
							<option value="" >Select Leave Adjust Policy</option>
							<option <?php echo ($LeaveAdjustPolicy == 'Leave Adjust Policy 1' ? 'selected' : ''); ?> value="Leave Adjust Policy 1">Leave Adjust Policy 1</option>
							<option <?php echo ($LeaveAdjustPolicy == 'Leave Adjust Policy 2' ? 'selected' : ''); ?> value="Leave Adjust Policy 2">Leave Adjust Policy 2</option>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AverageWorkingHours">Average Working Hours: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="AverageWorkingHours" name="AverageWorkingHours" class="form-control"  value="'.$AverageWorkingHours.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Working Type: </label>
						  <label>
						  <input type="radio" name="WorkingType" value="Shift Base"<?php echo ($WorkingType == "Shift Base" ? ' checked="checked"' : ''); ?>>
						  Shift Base</label>
						  <label>
						  <input type="radio" name="WorkingType" value="Hourly Base"<?php echo ($WorkingType == "Hourly Base" ? ' checked="checked"' : ''); ?>>
						  Hourly Base</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Leaves Days: </label>
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="1"<?php echo (in_array(1, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Mon</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="2"<?php echo (in_array(2, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Tue</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="3"<?php echo (in_array(3, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Wed</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="4"<?php echo (in_array(4, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Thu</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="5"<?php echo (in_array(5, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Fri</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="6"<?php echo (in_array(6, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Sat</label>&nbsp;
						  <label>
						  <input type="checkbox" name="LeavesDays[]" value="7"<?php echo (in_array(7, $LeavesDaysArray) ? "checked = checked" : ""); ?>>
						  Sun</label>&nbsp;
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Half Days: </label>
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="1"<?php echo (in_array(1, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Mon</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="2"<?php echo (in_array(2, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Tue</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="3"<?php echo (in_array(3, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Wed</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="4"<?php echo (in_array(4, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Thu</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="5"<?php echo (in_array(5, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Fri</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="6"<?php echo (in_array(6, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Sat</label>&nbsp;
						  <label>
						  <input type="checkbox" name="HalfDays[]" value="7"<?php echo (in_array(7, $HalfDaysArray) ? "checked = checked" : ""); ?>>
						  Sun</label>&nbsp;
						</div>
						
						<input type="hidden" name="action" value="submit_form" />
					  </div>
					  <!-- /.box-body -->
					
					</div>
					<!-- /.box -->
					<!-- Form Element sizes -->
				  </div>
			   
				 </div>
			</div>
		<div class="tab-pane" id="tab_3">
				<div class="col-md-4">
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Employee Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
						
						<div class="form-group">
						  <label id="labelimp" for="MaritalStatus" >Marital Status: </label>
						  
						  <select name="MaritalStatus" id="MaritalStatus" class="form-control">
							<option value="" >Select Marital Status</option>
							<?php
							foreach($_MARITALSTATUS as $maritalstatuses)
							{
							echo '<option '.($MaritalStatus == $maritalstatuses ? 'selected' : '').' value="'.$maritalstatuses.'">'.$maritalstatuses.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Religion" >Religion: </label>
						  
						  <select name="Religion" id="Religion" class="form-control">
							<option value="" >Select Religion</option>
							<?php
							foreach($_RELIGION as $religion)
							{
							echo '<option '.($Religion == $religion ? 'selected' : '').' value="'.$religion.'">'.$religion.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="BloodGroup" >Blood Group: </label>
						  
						  <select name="BloodGroup" id="BloodGroup" class="form-control">
							<option value="" >Select Blood Group</option>
							<?php
							foreach($_BLOODGROUP as $bloodgroups)
							{
							echo '<option '.($BloodGroup == $bloodgroups ? 'selected' : '').' value="'.$bloodgroups.'">'.$bloodgroups.'</option>';
							} 
							?>
							</select>
						</div>

						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmailAddress">Email Address:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="email" maxlength="100" id="EmailAddress" name="EmailAddress" class="form-control"  value="'.$EmailAddress.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Address">Address:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<textarea required maxlength="300" id="Address" name="Address" class="form-control">'.$Address.'</textarea>';
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
						<h3 class="box-title">Emergency Contact</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmergencyPerson">Emergency Contact Person: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="EmergencyPerson" name="EmergencyPerson" class="form-control"  value="'.$EmergencyPerson.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Relationship">Relationship: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="Relationship" name="Relationship" class="form-control"  value="'.$Relationship.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmergencyNumber">Phone Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="EmergencyNumber" name="EmergencyNumber" class="form-control"  value="'.$EmergencyNumber.'" />';
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
					
				<div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Phone Numbers</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="HomeNumber">Home Phone Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="HomeNumber" name="HomeNumber" class="form-control"  value="'.$HomeNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="OfficeNumber">Office Phone Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="OfficeNumber" name="OfficeNumber" class="form-control"  value="'.$OfficeNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="MobileNumber">Mobile Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="MobileNumber" name="MobileNumber" class="form-control"  value="'.$MobileNumber.'" />';
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
						<h3 class="box-title">Bank Details</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" for="Bank" >Bank:<span class="requiredStar">*</span> </label>
						  
						  <select required name="Bank" id="Bank" class="form-control">
							<option value="" >Select Bank</option>
							<?php
							 $query = "SELECT b.ID,b.Name AS Bank,c.Name FROM banks b LEFT JOIN companies c ON b.CompanyID = c.ID where b.Status = 1 ORDER BY c.Name,b.ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Bank == $row['Bank'] ? 'selected' : '').' value="'.$row['Bank'].'">'.$row['Bank'].' | '.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>

						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AccountTitle">Account Title:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="text" maxlength="100" id="AccountTitle" name="AccountTitle" class="form-control"  value="'.$AccountTitle.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AccountNumber">Account Number:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="text" maxlength="100" id="AccountNumber" name="AccountNumber" class="form-control"  value="'.$AccountNumber.'" />';
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
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Employee Additional Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="CNICNumber">CNIC Number:<span class="requiredStar">*</span> </label>
						  <?php 
						echo '<input required type="number" maxlength="100" id="CNICNumber" name="CNICNumber" class="form-control"  value="'.$CNICNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="CNICPlace">Place of Issue: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="CNICPlace" name="CNICPlace" class="form-control"  value="'.$CNICPlace.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="CNICExpiration">CNIC Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="CNICExpiration" name="CNICExpiration" class="form-control"  value="'.$CNICExpiration.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DrivingLicenseNumber">Driving License Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="DrivingLicenseNumber" name="DrivingLicenseNumber" class="form-control"  value="'.$DrivingLicenseNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DrivingLicensePlace">Place of Issue: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="DrivingLicensePlace" name="DrivingLicensePlace" class="form-control"  value="'.$DrivingLicensePlace.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DrivingLicenseExpiration">Driving License Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="DrivingLicenseExpiration" name="DrivingLicenseExpiration" class="form-control"  value="'.$DrivingLicenseExpiration.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="PassportNumber">Passport Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="PassportNumber" name="PassportNumber" class="form-control"  value="'.$PassportNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="PassportPlace">Place of Issue: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="PassportPlace" name="PassportPlace" class="form-control"  value="'.$PassportPlace.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="PassportExpiration">Passport Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="PassportExpiration" name="PassportExpiration" class="form-control"  value="'.$PassportExpiration.'" />';
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
			</div>
		<div class="tab-pane" id="tab_4">
		</div>
		<div class="tab-pane" id="tab_5">
		</div>
		<div class="tab-pane" id="tab_6">
				<div class="col-md-4">
					
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Academic Qualification</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastEducationDegree">Last Education Degree: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastEducationDegree" name="LastEducationDegree" class="form-control"  value="'.$LastEducationDegree.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="UniversityCollege">University / College: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="UniversityCollege" name="UniversityCollege" class="form-control"  value="'.$UniversityCollege.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EducationCompletionYear">Completion Year: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="EducationCompletionYear" name="EducationCompletionYear" class="form-control"  value="'.$EducationCompletionYear.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="GradeMarksPercentage">Grade / Marks: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="GradeMarksPercentage" name="GradeMarksPercentage" class="form-control"  value="'.$GradeMarksPercentage.'" />';
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
				  	
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Previous Employment</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="NOY">Number of Years: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="NOY" name="NOY" class="form-control"  value="'.$NOY.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="NOM">Number of Months: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="NOM" name="NOM" class="form-control"  value="'.$NOM.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastCompany">Last Company: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastCompany" name="LastCompany" class="form-control"  value="'.$LastCompany.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastDesignation">Last Designation: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastDesignation" name="LastDesignation" class="form-control"  value="'.$LastDesignation.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastSalary">Last Salary: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastSalary" name="LastSalary" class="form-control"  value="'.$LastSalary.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastWorkingDay">Last Working Day: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="LastWorkingDay" name="LastWorkingDay" class="form-control"  value="'.$LastWorkingDay.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Is First Job: </label>
						  <label>
						  <input type="radio" name="IsFirstJob" value="Yes"<?php echo ($IsFirstJob == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="IsFirstJob" value="No"<?php echo ($IsFirstJob == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
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
						<h3 class="box-title">Technical Qualification</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastTechnicalEducationCertificate">Last Technical Education Certificate: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastTechnicalEducationCertificate" name="LastTechnicalEducationCertificate" class="form-control"  value="'.$LastTechnicalEducationCertificate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="UniversityInstitute">University / Institute: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="UniversityInstitute" name="UniversityInstitute" class="form-control"  value="'.$UniversityInstitute.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="TechnicalEducationCompletionYear">Completion Year: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="TechnicalEducationCompletionYear" name="TechnicalEducationCompletionYear" class="form-control"  value="'.$TechnicalEducationCompletionYear.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="GradePercentageMarks">Grade / Marks: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="GradePercentageMarks" name="GradePercentageMarks" class="form-control"  value="'.$GradePercentageMarks.'" />';
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
			</div>
		</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
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
