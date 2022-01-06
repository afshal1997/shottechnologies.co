<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$msg="";
	$msg1="";
	$msg2="";
	$msg3="";
	$msg4="";
	$msg5="";
	$msg6="";
	$msg7="";
	$msg8="";
	$msg9="";
	$msg10="";
	$msg11="";
	$msg12="";
	$msg13="";
	$msg14="";
	$msg15="";
	$msg16="";
	$msg17="";
	$msg18="";
	$msg19="";
	$msg20="";
	$msg21="";
	$msg22="";
	$msg23="";
	$msg24="";
	$msg25="";
	$msg26="";
	$msg27="";
	$msg28="";
	$msg29="";
	
	$Role="Employee";
	$EmpType="Probationary";
	$EmpTypeDate="";
	$Designation="";
	$Department="";
	$Grade="";
	$Supervisor="";
	$AllowEmpLogin="Yes";
	$UserName="";
	$Password="";
	$PersonalEmailAddress = "";
	$EmailAddress="";
	$Notifications="Yes";
	$Salutation="Mr";
	$FirstName="";
	$LastName="";
	$FatherName="";
	$DOB="";
	$MaritalStatus="Single";
	$Gender="Male";
	$BloodGroup="";
	$Nationality="PAK";
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
	$VisaIssueDate="";
	$VisaExpiration="";
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
	$Location=0;	
	$SalaryDisbursmintPeriod="Monthly";
	$SESSINo="";
	$EOBINo="";
	$Bonus="No";	
	$CanTakeLoan="Yes";	
	$CanTakeAdvance="Yes";	
	$PayFullSalary="No";	
	$SalePersonOutdoorPerson="No";
	$StopSalary="No";
	$EmployeeContribution=0;
	$EmployerContribution=0;
	$ScheduleID=1;
	$OvertimePolicy=0;
	$AttendanceAllowance="None";
	$AttAllAmount=0;	
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
	$Religion="ISLAM";	
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
	$GetSalary="Yes";
	$BasicSalary=0;
	$NetSalary=0;
	$SubDepartment=0;
	$BusinessUnit=0;
	
	$get_max_details = mysql_query("SELECT * FROM employees ORDER BY ID DESC LIMIT 1")
	or die(mysql_error());
	$row = mysql_fetch_array($get_max_details);
	$last_query = $row['ID'];
	if ($last_query ==  0) {$last_query1 = 0;} else {$last_query1 = $last_query;}
	$i = $last_query1;
	$i++;
	$EmpID = str_pad($i,5,"0",STR_PAD_LEFT);
	
	
	$get_max_details = mysql_query("SELECT * FROM employees ORDER BY ID DESC LIMIT 1")
	or die(mysql_error());
	$row = mysql_fetch_array($get_max_details);
	$last_query = $row['ID'];
	if ($last_query ==  0) {$last_query1 = 0;} else {$last_query1 = $last_query;}
	$i = $last_query1;
	$i++;
	$MachineID = $i;
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{
	if(isset($_POST["Role"]))
		$Role=trim($_POST["Role"]);
	if(isset($_POST["EmpType"]))
		$EmpType=trim($_POST["EmpType"]);
	if(isset($_POST["EmpTypeDate"]))
		$EmpTypeDate=trim($_POST["EmpTypeDate"]);
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
	if(isset($_POST["PersonalEmailAddress"]))
		$PersonalEmailAddress=trim($_POST["PersonalEmailAddress"]);
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
	if(isset($_POST["ResignationDate"]))
		$ResignationDate=trim($_POST["ResignationDate"]);
	if(isset($_POST["LeavingDate"]))
		$LeavingDate=trim($_POST["LeavingDate"]);
	if(isset($_POST["ResignationAccepted"]))
		$ResignationAccepted=trim($_POST["ResignationAccepted"]);
	if(isset($_POST["ResignationRemarks"]))
		$ResignationRemarks=trim($_POST["ResignationRemarks"]);
	if(isset($_POST["EmpID"]))
		$EmpID=trim($_POST["EmpID"]);
	if(isset($_POST["Status"]))
		$Status=trim($_POST["Status"]);
	if(isset($_POST["CNICNumber"]))
		$CNICNumber=trim($_POST["CNICNumber"]);
	if(isset($_POST["CNICIssueDate"]))
		$CNICIssueDate=trim($_POST["CNICIssueDate"]);
	if(isset($_POST["CNICExpiration"]))
		$CNICExpiration=trim($_POST["CNICExpiration"]);
	if(isset($_POST["IqamaNumber"]))
		$IqamaNumber=trim($_POST["IqamaNumber"]);
	if(isset($_POST["PassportNumber"]))
		$PassportNumber=trim($_POST["PassportNumber"]);
	if(isset($_POST["PassportIssueDate"]))
		$PassportIssueDate=trim($_POST["PassportIssueDate"]);
	if(isset($_POST["PassportExpiration"]))
		$PassportExpiration=trim($_POST["PassportExpiration"]);
	if(isset($_POST["DrivingLicenseNumber"]))
		$DrivingLicenseNumber=trim($_POST["DrivingLicenseNumber"]);
	if(isset($_POST["DrivingLicenseIssueDate"]))
		$DrivingLicenseIssueDate=trim($_POST["DrivingLicenseIssueDate"]);
	if(isset($_POST["DrivingLicenseExpiration"]))
		$DrivingLicenseExpiration=trim($_POST["DrivingLicenseExpiration"]);
	if(isset($_POST["VisaIssueDate"]))
		$VisaIssueDate=trim($_POST["VisaIssueDate"]);
	if(isset($_POST["VisaExpiration"]))
		$VisaExpiration=trim($_POST["VisaExpiration"]);
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
	if(isset($_POST["Location"]) && ctype_digit($_POST['Location']))
		$Location=trim($_POST["Location"]);
	if(isset($_POST["SalaryDisbursmintPeriod"]))
		$SalaryDisbursmintPeriod=trim($_POST["SalaryDisbursmintPeriod"]);
	if(isset($_POST["SESSINo"]))
		$SESSINo=trim($_POST["SESSINo"]);
	if(isset($_POST["EOBINo"]))
		$EOBINo=trim($_POST["EOBINo"]);
	if(isset($_POST["Bonus"]))
		$Bonus=trim($_POST["Bonus"]);
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
	if(isset($_POST["EmployeeContribution"]) && ctype_digit($_POST['EmployeeContribution']))
		$EmployeeContribution=trim($_POST["EmployeeContribution"]);
	if(isset($_POST["EmployerContribution"]) && ctype_digit($_POST['EmployerContribution']))
		$EmployerContribution=trim($_POST["EmployerContribution"]);
	if(isset($_POST["ScheduleID"]) && ctype_digit($_POST['ScheduleID']))
		$ScheduleID=trim($_POST["ScheduleID"]);
	if(isset($_POST["OvertimePolicy"]) && ctype_digit($_POST['OvertimePolicy']))
		$OvertimePolicy=trim($_POST["OvertimePolicy"]);
	if(isset($_POST["AttendanceAllowance"]))
		$AttendanceAllowance=trim($_POST["AttendanceAllowance"]);
	if(isset($_POST["AttAllAmount"]))
		$AttAllAmount=trim($_POST["AttAllAmount"]);
	if(isset($_POST["LateArrivalPolicy"]))
		$LateArrivalPolicy=trim($_POST["LateArrivalPolicy"]);
	if(isset($_POST["EarlyDeparturePolicy"]))
		$EarlyDeparturePolicy=trim($_POST["EarlyDeparturePolicy"]);
	if(isset($_POST["ArrivalHalfDay"]))
		$ArrivalHalfDay=trim($_POST["ArrivalHalfDay"]);
	if(isset($_POST["DepartHalfDay"]))
		$DepartHalfDay=trim($_POST["DepartHalfDay"]);
	if(isset($_POST["AverageWorkingHours"]) && ctype_digit($_POST['AverageWorkingHours']))
		$AverageWorkingHours=trim($_POST["AverageWorkingHours"]);
	if(isset($_POST["WorkingType"]))
		$WorkingType=trim($_POST["WorkingType"]);
	if(isset($_POST["LeavesDays"]))
	{
		$LeavesDays=implode(',', $_POST['LeavesDays']);
		$LeavesDaysArray=$_POST['LeavesDays'];
	}
	if(isset($_POST["SandwichLeaves"]))
	{
		$SandwichLeaves=implode(',', $_POST['SandwichLeaves']);
		$SandwichLeavesArray=$_POST['SandwichLeaves'];
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
	if(isset($_POST["UniversityInstitute"]))
		$UniversityInstitute=trim($_POST["UniversityInstitute"]);
	if(isset($_POST["TechnicalEducationCompletionYear"]) && ctype_digit($_POST['TechnicalEducationCompletionYear']))
		$TechnicalEducationCompletionYear=trim($_POST["TechnicalEducationCompletionYear"]);
	if(isset($_POST["GradePercentageMarks"]))
		$GradePercentageMarks=trim($_POST["GradePercentageMarks"]);
	if(isset($_POST["UniversityInstitute"]))
		$UniversityInstitute=trim($_POST["UniversityInstitute"]);
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
	if(isset($_POST["GrossSalary"]))
		$GrossSalary=trim($_POST["GrossSalary"]);
	if(isset($_POST["GetSalary"]))
		$GetSalary=trim($_POST["GetSalary"]);
	if(isset($_POST["SubDepartment"]) && ctype_digit($_POST['SubDepartment']))
		$SubDepartment=trim($_POST["SubDepartment"]);
	if(isset($_POST["BusinessUnit"]) && ctype_digit($_POST['BusinessUnit']))
		$BusinessUnit=trim($_POST["BusinessUnit"]);
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_IMAGE_ALLOWED_TYPES))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Only '.implode(", ", $_IMAGE_ALLOWED_TYPES) . ' files can be uploaded.</b>
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_IMAGE_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Image size must be ' . MAX_IMAGE_SIZE . ' KB or less.</b>
			</div>';
		}
	}
		
		
	

		if($CompanyID == 0)
		{
			$msg1 = "<div class=\"error\">Please Select Company.</div>";
		}
		if($EmpID == "")
		{
			$msg2 = "<div class=\"error\">Please enter Employee ID / Code.</div>";
		}
		if($Role == "")
		{
			$msg3 = "<div class=\"error\">Please Select Role.</div>";
		}
		if($UserName == "")
		{
			$msg4 = "<div class=\"error\">Please enter User Name.</div>";
		}
		if($UserName != "")
		{
			$sql = "SELECT ID from employees WHERE UserName = '".$UserName."'";
			$res = mysql_query($sql) or die(mysql_error());
			$unum = mysql_num_rows($res);
			if($unum > 0)
			{
				$msg4 = "<div class=\"error\">UserName is already exists.</div>";
			}
		}
		if($Password == "")
		{
			$msg5 = "<div class=\"error\">Please enter Password.</div>";
		}
		if($FirstName == "")
		{
			$msg6 = "<div class=\"error\">Please enter FirstName.</div>";
		}
		// if($DOB == "")
		// {
			// $msg7 = "<div class=\"error\">Please enter Date of Birth.</div>";
		// }
		if($Gender == "")
		{
			$msg8 = "<div class=\"error\">Please Select Gender.</div>";
		}
		if($Nationality == "")
		{
			$msg9 = "<div class=\"error\">Please Select Nationality.</div>";
		}
		if($EmpType == "")
		{
			$msg10 = "<div class=\"error\">Please Select Employment Status.</div>";
		}
		if($JoiningDate == "")
		{
			$msg11 = "<div class=\"error\">Please enter Joining Date.</div>";
		}
		if($Designation == "")
		{
			$msg12 = "<div class=\"error\">Please Select Designation.</div>";
		}
		if($Department == "")
		{
			$msg13 = "<div class=\"error\">Please Select Department.</div>";
		}
		if($SalaryDisbursmintPeriod == "")
		{
			$msg14 = "<div class=\"error\">Please Select Salary Disbursmint Period.</div>";
		}
		if($ScheduleID == 0)
		{
			$msg15 = "<div class=\"error\">Please Select Time Schedule.</div>";
		}
		// if($EmailAddress == "")
		// {
			// $msg20 = "<div class=\"error\">Please Enter EmailAddress.</div>";
		// }
		// else if(!validEmailAddress($EmailAddress))
		// {
			// $msg20 = "<div class=\"error\">Please Enter valid EmailAddress.</div>";
		// }
		// if($Address == "")
		// {
			// $msg21 = "<div class=\"error\">Please enter Address.</div>";
		// }
		// if($Bank == "")
		// {
			// $msg22 = "<div class=\"error\">Please select Bank.</div>";
		// }
		// if($AccountTitle == "")
		// {
			// $msg23 = "<div class=\"error\">Please enter Account Title.</div>";
		// }
		// if($AccountNumber == "")
		// {
			// $msg24 = "<div class=\"error\">Please enter Account Number.</div>";
		// }
		// if($CNICNumber == "")
		// {
			// $msg25 = "<div class=\"error\">Please enter CNIC Number.</div>";
		// }
		if($GrossSalary == 0)
		{
			$msg27 = "<div class=\"error\">Please enter Gross Salary.</div>";
		}
		if($GrossSalary > 0 && $GrossSalary < 500)
		{
			$msg27 = "<div class=\"error\">Please Enter Minimum 500 in Gross Salary</div>";
		}
		// if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		// {
			// $msg26 = "<div class=\"error\">Please Upload Photo.</div>";
		// }
// 		if($SubDepartment == 0)
// 		{
// 			$msg29 = "<div class=\"error\">Please Select Sub Department.</div>";
// 		}
		

		


	if($msg=="" && $msg1=="" && $msg2=="" && $msg3=="" && $msg4=="" && $msg5=="" && $msg6=="" && $msg7=="" && $msg8=="" && $msg9=="" && $msg10=="" && $msg11=="" && $msg12=="" && $msg13=="" && $msg14=="" && $msg15=="" && $msg16=="" && $msg17=="" && $msg18=="" && $msg19=="" && $msg20=="" && $msg21=="" && $msg22=="" && $msg23=="" && $msg24=="" && $msg25=="" && $msg26=="" && $msg27=="" && $msg29=="")
	{
// 	 var_dump($_POST["LeavingDate"]);die;   
		$query="INSERT INTO employees SET DateAdded=NOW(),
		        ID = " . (int)$EmpID . ",
				Role = '" . dbinput($Role) . "',
				EmpType = '" . dbinput($EmpType) . "',
				EmpTypeDate = '" . dbinput($EmpTypeDate) . "',
				Designation = '" . dbinput($Designation) . "',
				Department = '" . dbinput($Department) . "',
				Grade = '" . dbinput($Grade) . "',
				Salary = '" . $GrossSalary . "',
				GetSalary = '" . dbinput($GetSalary) . "',
				Supervisor = '" . dbinput($Supervisor) . "',
				AllowEmpLogin = '" . dbinput($AllowEmpLogin) . "',
				UserName = '" . dbinput($UserName) . "',
				Password = '" . dbinput($Password) . "',
				PersonalEmailAddress = '" . dbinput($PersonalEmailAddress) . "',
				EmailAddress = '" . dbinput($EmailAddress) . "',
				Notifications = '" . dbinput($Notifications) . "',
				Salutation = '" . dbinput($Salutation) . "',
				FirstName = '" . dbinput($FirstName) . "',
				LastName = '" . dbinput($LastName) . "',
				FatherName = '" . dbinput($FatherName) . "',
				DOB = '" . dbinput($DOB). "',
				MaritalStatus = '" . dbinput($MaritalStatus) . "',
				Gender = '" . dbinput($Gender) . "',
				BloodGroup = '" . dbinput($BloodGroup) . "',
				Nationality = '" . dbinput($Nationality) . "',
				JoiningDate = '" . dbinput($JoiningDate) . "',
				ResignationDate = '" . dbinput($ResignationDate) . "',
				LeavingDate = '" . $_POST["LeavingDate"] . "',
				ResignationAccepted = '" . dbinput($ResignationAccepted) . "',
				ResignationRemarks = '" . dbinput($ResignationRemarks) . "',
				EmpID = '" . dbinput($EmpID) . "',
				Status = '" . dbinput($Status) . "',
				CNICNumber = '" . dbinput($CNICNumber) . "',
				CNICIssueDate = '" . dbinput($CNICIssueDate) . "',
				CNICExpiration = '" . dbinput($CNICExpiration) . "',
				IqamaNumber = '" . dbinput($IqamaNumber) . "',
				PassportNumber = '" . dbinput($PassportNumber) . "',
				PassportIssueDate = '" . dbinput($PassportIssueDate) . "',
				PassportExpiration = '" . dbinput($PassportExpiration) . "',
				DrivingLicenseNumber = '" . dbinput($DrivingLicenseNumber) . "',
				DrivingLicenseIssueDate = '" . dbinput($DrivingLicenseIssueDate) . "',
				DrivingLicenseExpiration = '" . dbinput($DrivingLicenseExpiration) . "',
				VisaIssueDate = '" . dbinput($VisaIssueDate) . "',
				VisaExpiration = '" . dbinput($VisaExpiration) . "',
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
				Location = '" . (int)$Location . "',
				SalaryDisbursmintPeriod = '" . dbinput($SalaryDisbursmintPeriod) . "',
				SESSINo = '" . dbinput($SESSINo) . "',
				EOBINo = '" . dbinput($EOBINo) . "',
				Bonus = '" . dbinput($Bonus) . "',
				CanTakeLoan = '" . dbinput($CanTakeLoan) . "',
				CanTakeAdvance = '" . dbinput($CanTakeAdvance) . "',
				PayFullSalary = '" . dbinput($PayFullSalary) . "',
				SalePersonOutdoorPerson = '" . dbinput($SalePersonOutdoorPerson) . "',
				StopSalary = '" . dbinput($StopSalary) . "',
				EmployeeContribution = '" . (int)$EmployeeContribution . "',
				EmployerContribution = '" . (int)$EmployerContribution . "',
				ScheduleID = '" . (int)$ScheduleID . "',
				OvertimePolicy = '" . (int)$OvertimePolicy . "',
				AttendanceAllowance = '" . dbinput($AttendanceAllowance) . "',
				AttAllAmount = '" . dbinput($AttAllAmount) . "',
				LateArrivalPolicy = '" . dbinput($LateArrivalPolicy) . "',
				EarlyDeparturePolicy = '" . dbinput($EarlyDeparturePolicy) . "',
				ArrivalHalfDay = '" . dbinput($ArrivalHalfDay) . "',
				DepartHalfDay = '" . dbinput($DepartHalfDay) . "',
				AverageWorkingHours = '" . dbinput($AverageWorkingHours) . "',
				WorkingType = '" . dbinput($WorkingType) . "',
				LeavesDays = '" . dbinput($LeavesDays) . "',
				SandwichLeaves = '" . dbinput($SandwichLeaves) . "',
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
				EmergencyNumber = '" . dbinput($EmergencyNumber) . "',
				SubDepartment = '" . (int)$SubDepartment . "',
				BusinessUnit = '" . (int)$BusinessUnit . "'";
				
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		
		echo "<pre>";
print_r($ID);die;
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Employee has been added.</b>
		</div>';
		
		$NetSalary = ($GrossSalary / 3);
		$BasicSalary = ($NetSalary * 2);
		// $HouseAllowance = (40/100) * $BasicSalary;
		// $UtilityAllowance = (10/100) * $BasicSalary;
		// $CovAllowance = 300;
		
		$query="INSERT INTO basicsalary SET Date=NOW(),
			EmpID = '" . (int)$ID . "',
			Approved = 1,
			ApprovedBy = '" . $_SESSION['UserID'] . "',
			Amount = '" . $BasicSalary . "'";	
		mysql_query($query) or die (mysql_error());
		
		$query="INSERT INTO allowances SET Date=NOW(),
			EmpID = '" . (int)$ID . "',
			Approved = 1,
			ApprovedBy = '" . $_SESSION['UserID'] . "',
			Amount = 30,
			Percentage = 30,
			Title = 'House Rent',
			Type = 'Percentage',
			Taxable = 'No'";	
		mysql_query($query) or die (mysql_error());
		
		$query="INSERT INTO allowances SET Date=NOW(),
			EmpID = '" . (int)$ID . "',
			Approved = 1,
			ApprovedBy = '" . $_SESSION['UserID'] . "',
			Amount = 10,
			Percentage = 10,
			Title = 'Utility',
			Type = 'Percentage',
			Taxable = 'No'";	
		mysql_query($query) or die (mysql_error());
		
		$query="INSERT INTO allowances SET Date=NOW(),
			EmpID = '" . (int)$ID . "',
			Approved = 1,
			ApprovedBy = '" . $_SESSION['UserID'] . "',
			Amount = 10,
			Percentage = 10,
			Title = 'Medical',
			Type = 'Percentage',
			Taxable = 'No'";	
		mysql_query($query) or die (mysql_error());
			
	

		if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
		{
			
		
			ini_set('memory_limit', '-1');
			
			$tempName = $_FILES["flPage"]['tmp_name'];
			$realName = $ID . "." . $ext;
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
	else
	{
		$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please fill all mandatory fields.</b>
			'.(isset($msg1) ? '<b>'.$msg1.'</b>' : '').'
			'.(isset($msg2) ? '<b>'.$msg2.'</b>' : '').'
			'.(isset($msg3) ? '<b>'.$msg3.'</b>' : '').'
			'.(isset($msg4) ? '<b>'.$msg4.'</b>' : '').'
			'.(isset($msg5) ? '<b>'.$msg5.'</b>' : '').'
			'.(isset($msg6) ? '<b>'.$msg6.'</b>' : '').'
			'.(isset($msg7) ? '<b>'.$msg7.'</b>' : '').'
			'.(isset($msg8) ? '<b>'.$msg8.'</b>' : '').'
			'.(isset($msg9) ? '<b>'.$msg9.'</b>' : '').'
			'.(isset($msg10) ? '<b>'.$msg10.'</b>' : '').'
			'.(isset($msg11) ? '<b>'.$msg11.'</b>' : '').'
			'.(isset($msg12) ? '<b>'.$msg12.'</b>' : '').'
			'.(isset($msg13) ? '<b>'.$msg13.'</b>' : '').'
			'.(isset($msg14) ? '<b>'.$msg14.'</b>' : '').'
			'.(isset($msg15) ? '<b>'.$msg15.'</b>' : '').'
			'.(isset($msg16) ? '<b>'.$msg16.'</b>' : '').'
			'.(isset($msg17) ? '<b>'.$msg17.'</b>' : '').'
			'.(isset($msg18) ? '<b>'.$msg18.'</b>' : '').'
			'.(isset($msg19) ? '<b>'.$msg19.'</b>' : '').'
			'.(isset($msg20) ? '<b>'.$msg20.'</b>' : '').'
			'.(isset($msg21) ? '<b>'.$msg21.'</b>' : '').'
			'.(isset($msg22) ? '<b>'.$msg22.'</b>' : '').'
			'.(isset($msg23) ? '<b>'.$msg23.'</b>' : '').'
			'.(isset($msg24) ? '<b>'.$msg24.'</b>' : '').'
			'.(isset($msg25) ? '<b>'.$msg25.'</b>' : '').'
			'.(isset($msg26) ? '<b>'.$msg26.'</b>' : '').'
			'.(isset($msg27) ? '<b>'.$msg27.'</b>' : '').'
			'.(isset($msg29) ? '<b>'.$msg29.'</b>' : '').'
			</div>';
	}
		

}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Add Employee</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
				<li><a href="#tab_2" data-toggle="tab">User Authentications</a></li>
				<li><a href="#tab_3" data-toggle="tab">Official</a></li>
				<li><a href="#tab_4" data-toggle="tab">Personal Info</a></li>
				<li><a href="#tab_5" data-toggle="tab">Qualifications</a></li>
			</ul>
			<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
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
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg26)){echo $msg26;}?>
						</span>
						  <input type="file" name="flPage" />
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
						<h3 class="box-title">Employee Identification</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						<div class="form-group">
						
						  <label id="labelimp" for="CompanyID" >Company:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
							<?php if(isset($msg1)){echo $msg1;}?>
						  </span>
						  <select name="CompanyID" id="CompanyID" class="form-control">
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
						  <label id="labelimp" class="labelimp" for="EmpID">Employee ID/Code:<span class="requiredStar">*</span> </label>
						<span style="color:red;font-size:12px;">
						<?php if(isset($msg2)){echo $msg2;}?>
						</span>
						  <span id="Availablity"></span>
						  <?php 
						echo '<input type="text" maxlength="100" id="EmpID" name="EmpID" class="form-control"  value="'.$EmpID.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="MachineID">Machine ID/Code: </label>
						  <?php 
						echo '<input type="number" maxlength="5" id="MachineID" name="MachineID" class="form-control"  value="'.$MachineID.'" />';
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
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg6)){echo $msg6;}?>
						</span>
						  <?php 
						echo '<input type="text" maxlength="100" id="FirstName" name="FirstName" class="form-control"  value="'.$FirstName.'" />';
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
						  <label id="labelimp" class="labelimp" for="DOB">Date of Birth: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="DOB" name="DOB" class="form-control"  value="'.$DOB.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Gender" >Gender:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg8)){echo $msg8;}?>
						</span>
						  <select name="Gender" id="Gender" class="form-control">
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
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg9)){echo $msg9;}?>
						</span>
						  <select name="Nationality" id="Nationality" class="form-control">
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
						<h3 class="box-title">Employment Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						
						<div class="form-group">
						  <label id="labelimp" for="EmpType" >Employee Type / Employment Status:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg10)){echo $msg10;}?>
						</span>
						  <select name="EmpType" id="EmpType" class="form-control">
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
						  <label id="labelimp" class="labelimp" for="EmpTypeDate">Permanent Date: </label>
						  <?php 
						echo '<input type="date"  id="EmpTypeDate" name="EmpTypeDate" class="form-control"  value="'.$EmpTypeDate.'" />';
						?>
						</div>
					   
					   <div class="form-group">
						  <label id="labelimp" >Get Salary: </label>
						  <label>
						  <input type="radio" name="GetSalary" value="Yes"<?php echo ($GetSalary == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="GetSalary" value="No"<?php echo ($GetSalary == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="GrossSalary">Gross Salary:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg27)){echo $msg27;}?>
						</span>
						  <?php 
						echo '<input type="number" maxlength="100" id="GrossSalary" name="GrossSalary" class="form-control"  value="'.$GrossSalary.'" />';
						?>
						</div>
					   
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="JoiningDate">Date of Joining:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg11)){echo $msg11;}?>
						</span>
						  <?php 
						echo '<input type="date" maxlength="100" id="JoiningDate" name="JoiningDate" class="form-control"  value="'.$JoiningDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="ResignationDate">Resignation Date: </label>
						  <?php 
						echo '<input type="date"  id="ResignationDate" name="ResignationDate" class="form-control"  value="'.$ResignationDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LeavingDate">Last Working Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="LeavingDate" name="LeavingDate" class="form-control"  value="'.$LeavingDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" >Resignation Accepted: </label>
						  <label>
						  <input type="radio" name="ResignationAccepted" value="Yes"<?php echo ($ResignationAccepted == "Yes" ? ' checked="checked"' : ''); ?>>
						  Yes</label>
						  <label>
						  <input type="radio" name="ResignationAccepted" value="No"<?php echo ($ResignationAccepted == "No" ? ' checked="checked"' : ''); ?>>
						  No</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="ResignationRemarks">Resignation Remarks:</label>
						  <?php 
						echo '<textarea maxlength="300" id="ResignationRemarks" name="ResignationRemarks" class="form-control">'.$ResignationRemarks.'</textarea>';
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
						<h3 class="box-title">User Role</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
						
						<div class="form-group">
						  <label id="labelimp" for="Role" >Role:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg3)){echo $msg3;}?>
						</span>
						  <select style="width:100%" name="Role" id="Role" class="form-control">
							<option value="" >Select Role</option>
							<?php
							foreach($_ROLES as $roles)
							{
							echo '<option '.(($_SESSION['RoleID'] != 'Administrator' AND $roles != 'Employee') ? 'disabled' : '').' '.($Role == $roles ? 'selected' : '').' value="'.$roles.'">'.$roles.'</option>';
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
				
				<div class="col-md-4">
					  
				  <div class="box box-solid">
				  <div class="box-header bg-box-blue">
						<h3 class="box-title">Login Information</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					  
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="UserName">User Name:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg4)){echo $msg4;}?>
						</span>
						  <?php 
						echo '<input type="text" maxlength="100" id="UserName" name="UserName" class="form-control"  value="'.$UserName.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Password">Password:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg5)){echo $msg5;}?>
						</span>
						  <?php 
						echo '<input type="password" maxlength="100" id="Password" name="Password" class="form-control"  value="'.$Password.'" />';
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
						<h3 class="box-title">Restrictions</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
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
						  <label id="labelimp" for="Designation" >Designation:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg12)){echo $msg12;}?>
						</span>
						  <select style="width:100%" name="Designation" id="Designation" class="form-control">
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
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg13)){echo $msg13;}?>
						</span>
						  <select style="width:100%" name="Department" id="Department" class="form-control">
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
						  <label id="labelimp" for="SubDepartment" >Sub Department: </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg29)){echo $msg29;}?>
						</span>
						  <select style="width:100%" name="SubDepartment" id="SubDepartment" class="form-control">
							<option value="" >Select Sub Department</option>
							<?php
							$query = 'SELECT s.ID,s.SubDepartment,d.Department FROM subdepartments s LEFT JOIN departments d ON s.DepartmentID = d.ID WHERE s.Status = 1 ORDER BY d.Department,s.SubDepartment ASC';
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($SubDepartment == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['SubDepartment'].' ('.$row['Department'].')</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="BusinessUnit" >Business Unit: </label>
						  <select style="width:100%" name="BusinessUnit" id="BusinessUnit" class="form-control">
							<option value="" >Select Business Unit</option>
							<?php
							 $query = "SELECT ID,BusinessUnit FROM businessunits where Status = 1 ORDER BY BusinessUnit ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($BusinessUnit == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['BusinessUnit'].'</option>';
							} 
							?>
							</select>
						</div>	
						
						<div class="form-group">
						  <label id="labelimp" for="EmploymentType" >Employment Type: </label>
						  
						  <select style="width:100%" name="EmploymentType" id="EmploymentType" class="form-control">
							<option value="" >Select Employment Type</option>
							<option <?php echo ($EmploymentType == 'Management Staff' ? 'selected' : ''); ?> value="Management Staff">Management Staff</option>
							<option <?php echo ($EmploymentType == 'Non Management Staff' ? 'selected' : ''); ?> value="Non Management Staff">Non Management Staff</option>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="Grade" >Grade: </label>
						  
						  <select style="width:100%" name="Grade" id="Grade" class="form-control">
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
						  <select style="width:100%" name="Supervisor" id="Supervisor" class="form-control">
							<option value="" >Select Supervisor</option>
							<?php
							 $query = "SELECT EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
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
						  
						  <select style="width:100%" name="Location" id="Location" class="form-control">
							<option value="" >Select Location</option>
							<?php
							$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Location == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
							} 
							?>
							</select>
						</div>
						
						<!--<div class="form-group">-->
						<!--  <label id="labelimp" for="SalaryDisbursmintPeriod" >Salary Disbursmint Period:<span class="requiredStar">*</span> </label>-->
						<!--  <span style="color:red;font-size:12px;">-->
						<!--<?php if(isset($msg14)){echo $msg14;}?>-->
						<!--</span>-->
						<!--  <select style="width:100%" name="SalaryDisbursmintPeriod" id="SalaryDisbursmintPeriod" class="form-control">-->
						<!--	<option value="" >Select Salary Disbursmint Period</option>-->
						<!--	<option <?php echo ($SalaryDisbursmintPeriod == 'Weekly' ? 'selected' : ''); ?> value="Weekly">Weekly</option>-->
						<!--	<option <?php echo ($SalaryDisbursmintPeriod == 'Twice in a Month' ? 'selected' : ''); ?> value="Twice in a Month">Twice in a Month</option>-->
						<!--	<option <?php echo ($SalaryDisbursmintPeriod == 'Monthly' ? 'selected' : ''); ?> value="Monthly">Monthly</option>-->
						<!--	</select>-->
						<!--</div>-->
						
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
						echo '<input type="number" maxlength="100" id="SESSINo" name="SESSINo" class="form-control"  value="'.$SESSINo.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EOBINo">EOBI No: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="EOBINo" name="EOBINo" class="form-control"  value="'.$EOBINo.'" />';
						?>
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
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmployeeContribution">Employee Contribution: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="EmployeeContribution" name="EmployeeContribution" class="form-control"  value="'.$EmployeeContribution.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmployerContribution">Employer Contribution: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="EmployerContribution" name="EmployerContribution" class="form-control"  value="'.$EmployerContribution.'" />';
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
						<h3 class="box-title">Attendance Policies</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
					   
						
						<div class="form-group">
						  <label id="labelimp" for="ScheduleID" >Schedule Name:<span class="requiredStar">*</span> </label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg15)){echo $msg15;}?>
						</span>
						  <select style="width:100%" name="ScheduleID" id="ScheduleID" class="form-control">
							<option value="" >Select Schedule</option>
							<?php
							 $query = "SELECT ID,Name AS Schedule FROM schedules where Status = 1 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($ScheduleID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">('.$row['ID'].') '.$row['Schedule'].'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="OvertimePolicy" >Overtime Policy:</label>
						  <select style="width:100%" name="OvertimePolicy" id="OvertimePolicy" class="form-control">
							<option value="" >No Policy</option>
							<?php
							 $query = "SELECT ID,Name FROM overtime_policies where Status = 1 ORDER BY Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($OvertimePolicy == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">('.$row['ID'].') '.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="AttendanceAllowance" >Attendance Allowance: </label>
						  <select name="AttendanceAllowance" id="AttendanceAllowance" class="form-control">
							<?php
							foreach($_AttendanceAllowance as $AttAllow)
							{
							echo '<option '.($AttendanceAllowance == $AttAllow ? 'selected' : '').' value="'.$AttAllow.'">'.$AttAllow.'</option>';
							} 
							?>
							</select>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AttAllAmount">Attendance Allowance Amount: </label>
						  <?php 
						echo '<input type="number" maxlength="100" id="AttAllAmount" name="AttAllAmount" class="form-control"  value="'.$AttAllAmount.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="LateArrivalPolicy">Late Arrival: </label>
						  <label>
						  <input type="radio" name="LateArrivalPolicy" value="Allowed"<?php echo ($LateArrivalPolicy == "Allowed" ? ' checked="checked"' : ''); ?>>
						  Allowed</label>
						  <label>
						  <input type="radio" name="LateArrivalPolicy" value="Not Allowed"<?php echo ($LateArrivalPolicy == "Not Allowed" ? ' checked="checked"' : ''); ?>>
						  Not Allowed</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="ArrivalHalfDay">Arrival Half Day: </label>
						  <label>
						  <input type="radio" name="ArrivalHalfDay" value="Allowed"<?php echo ($ArrivalHalfDay == "Allowed" ? ' checked="checked"' : ''); ?>>
						  Allowed</label>
						  <label>
						  <input type="radio" name="ArrivalHalfDay" value="Not Allowed"<?php echo ($ArrivalHalfDay == "Not Allowed" ? ' checked="checked"' : ''); ?>>
						  Not Allowed</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="DepartHalfDay">Depart Half Day: </label>
						  <label>
						  <input type="radio" name="DepartHalfDay" value="Allowed"<?php echo ($DepartHalfDay == "Allowed" ? ' checked="checked"' : ''); ?>>
						  Allowed</label>
						  <label>
						  <input type="radio" name="DepartHalfDay" value="Not Allowed"<?php echo ($DepartHalfDay == "Not Allowed" ? ' checked="checked"' : ''); ?>>
						  Not Allowed</label>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" for="EarlyDeparturePolicy">Early Departure: </label>
						  <label>
						  <input type="radio" name="EarlyDeparturePolicy" value="Allowed"<?php echo ($EarlyDeparturePolicy == "Allowed" ? ' checked="checked"' : ''); ?>>
						  Allowed</label>
						  <label>
						  <input type="radio" name="EarlyDeparturePolicy" value="Not Allowed"<?php echo ($EarlyDeparturePolicy == "Not Allowed" ? ' checked="checked"' : ''); ?>>
						  Not Allowed</label>
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
						  <label id="labelimp" >Holidays: </label>
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
						  <label id="labelimp" >Sandwich Leaves: </label>
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="1"<?php echo (in_array(1, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Mon</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="2"<?php echo (in_array(2, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Tue</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="3"<?php echo (in_array(3, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Wed</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="4"<?php echo (in_array(4, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Thu</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="5"<?php echo (in_array(5, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Fri</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="6"<?php echo (in_array(6, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
						  Sat</label>&nbsp;
						  <label>
						  <input type="checkbox" name="SandwichLeaves[]" value="7"<?php echo (in_array(7, $SandwichLeavesArray) ? "checked = checked" : ""); ?>>
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
		<div class="tab-pane" id="tab_4">
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
						  
						  <select style="width:100%" name="MaritalStatus" id="MaritalStatus" class="form-control">
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
						  
						  <select style="width:100%" name="Religion" id="Religion" class="form-control">
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
						  
						  <select style="width:100%" name="BloodGroup" id="BloodGroup" class="form-control">
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
						  <label id="labelimp" class="labelimp" for="PersonalEmailAddress">Personal Email Address:</label>
						  <?php 
						echo '<input type="text" maxlength="100" id="PersonalEmailAddress" name="PersonalEmailAddress" class="form-control"  value="'.$PersonalEmailAddress.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="EmailAddress">Email Address:</label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg20)){echo $msg20;}?>
						</span>
						  <?php 
						echo '<input type="text" maxlength="100" id="EmailAddress" name="EmailAddress" class="form-control"  value="'.$EmailAddress.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Address">Address: </label>
						  <?php 
						echo '<textarea maxlength="300" id="Address" name="Address" class="form-control">'.$Address.'</textarea>';
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
						  <label id="labelimp" for="Bank" >Bank:</label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg22)){echo $msg22;}?>
						</span>
						  <select style="width:100%" name="Bank" id="Bank" class="form-control">
							<option value="" >Select Bank</option>
							<?php
							 $query = "SELECT ID,Name AS Bank FROM banks where Status = 1 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Bank == $row['Bank'] ? 'selected' : '').' value="'.$row['Bank'].'">'.$row['Bank'].'</option>';
							} 
							?>
							</select>
						</div>

						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AccountTitle">Account Title:</label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg23)){echo $msg23;}?>
						</span>
						  <?php 
						echo '<input type="text" maxlength="100" id="AccountTitle" name="AccountTitle" class="form-control"  value="'.$AccountTitle.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="AccountNumber">Account Number:</label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg24)){echo $msg24;}?>
						</span>
						  <?php 
						echo '<input type="text" maxlength="100" id="AccountNumber" name="AccountNumber" class="form-control"  value="'.$AccountNumber.'" />';
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
						  <label id="labelimp" class="labelimp" for="CNICNumber">CNIC Number:</label>
						  <span style="color:red;font-size:12px;">
						<?php if(isset($msg25)){echo $msg25;}?>
						</span>
						<input type="text" id="CNICNumber" name="CNICNumber" class="form-control" value="<?php echo $CNICNumber; ?>" data-inputmask="'mask': '99999-9999999-9'" data-mask/>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="CNICIssueDate">CNIC Issue Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="CNICIssueDate" name="CNICIssueDate" class="form-control"  value="'.$CNICIssueDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="CNICExpiration">CNIC Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="CNICExpiration" name="CNICExpiration" class="form-control"  value="'.$CNICExpiration.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="IqamaNumber">Iqama Number:</label>
						<input type="text" id="IqamaNumber" name="IqamaNumber" class="form-control" value="<?php echo $IqamaNumber; ?>" data-inputmask="'mask': '999-9999-9999999-9'" data-mask/>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DrivingLicenseNumber">Driving License Number: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="DrivingLicenseNumber" name="DrivingLicenseNumber" class="form-control"  value="'.$DrivingLicenseNumber.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="DrivingLicenseIssueDate">Driving License Issue Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="DrivingLicenseIssueDate" name="DrivingLicenseIssueDate" class="form-control"  value="'.$DrivingLicenseIssueDate.'" />';
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
						  <label id="labelimp" class="labelimp" for="PassportIssueDate">Passport Issue Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="PassportIssueDate" name="PassportIssueDate" class="form-control"  value="'.$PassportIssueDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="PassportExpiration">Passport Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="PassportExpiration" name="PassportExpiration" class="form-control"  value="'.$PassportExpiration.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="VisaIssueDate">Visa Issue Date: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="VisaIssueDate" name="VisaIssueDate" class="form-control"  value="'.$VisaIssueDate.'" />';
						?>
						</div>
						
						<div class="form-group">
						  <label id="labelimp" class="labelimp" for="VisaExpiration">Visa Expiration: </label>
						  <?php 
						echo '<input type="date" maxlength="100" id="VisaExpiration" name="VisaExpiration" class="form-control"  value="'.$VisaExpiration.'" />';
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
		<div class="tab-pane" id="tab_5">
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
						  <label id="labelimp" for="UniversityCollege" >University / College: </label>
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
						  <label id="labelimp" for="UniversityInstitute" >University / Institute: </label>
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
        <script src="js/AdminLTE/demo5.js" type="text/javascript"></script>
        <!-- Page script -->
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
                    showInputs: false
                });
            });
        </script>
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#Supervisor').select2();
</script>
</body>
</html>
