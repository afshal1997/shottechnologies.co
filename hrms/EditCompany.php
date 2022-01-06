<?php
include_once("Common.php");
include("CheckAdminLogin.php");

if($_SESSION['RoleID'] == 'Administrator' OR user_authentication($_SESSION['UserID'],'SecureUpdCopmany') OR external_user_authentication($_SESSION['UserID'],'SecureUpdCopmany'))
{}else{redirect("Companies.php");}
	
	$msg="";
	$Name="";
	$Abr="";
	$Status=1;
	$Tax="No";
	$ProvidentFund="No";
	$BonusType="Individual";
	$PerDayHours=0;
	$DeductionOnLates="";
	$DeductionOnLatesTypes="";
	$DeductionOnLatesAdjustment="";
	$RefreshQuota="";
	$CurrencySymbol="";
	$PassingPercentage=0;
	$NumOfAttempts=0;
	$InterviewPercentage=0;
	$YearStartFrom=0;
	$SandwitchDeductions="";
	$LoanDeductionPercent=0;
	$Logo="";
	
	$BonusPloicy1="None";
	$BonusPloicy2="None";
	$BonusPloicy3="None";
	$BonusPloicy4="None";
	$BonusPloicy5="None";
	$BonusPloicy6="None";
	$BonusPloicy7="None";
	$BonusPloicy8="None";
	$BonusPloicy9="None";
	$BonusPloicy10="None";
	$BonusPloicy11="None";
	$BonusPloicy12="None";
	$BonusPloicy13="None";
	$BonusBaseOn1="Monthly";
	$BonusBaseOn2="Monthly";
	$BonusBaseOn3="Monthly";
	$BonusBaseOn4="Monthly";
	$BonusBaseOn5="Monthly";
	$BonusBaseOn6="Monthly";
	$BonusBaseOn7="Monthly";
	$BonusBaseOn8="Monthly";
	$BonusBaseOn9="Monthly";
	$BonusBaseOn10="Monthly";
	$BonusBaseOn11="Monthly";
	$BonusBaseOn12="Monthly";
	$BonusBaseOn13="Monthly";
	$BonusAmntPer1=0;
	$BonusAmntPer2=0;
	$BonusAmntPer3=0;
	$BonusAmntPer4=0;
	$BonusAmntPer5=0;
	$BonusAmntPer6=0;
	$BonusAmntPer7=0;
	$BonusAmntPer8=0;
	$BonusAmntPer9=0;
	$BonusAmntPer10=0;
	$BonusAmntPer11=0;
	$BonusAmntPer12=0;
	$BonusAmntPer13=0;
	
	$Days1=0;
	$HalfDays1=0;
	$Days2=0;
	$HalfDays2=0;
	$Days3=0;
	$HalfDays3=0;
	$Days4=0;
	$HalfDays4=0;
	$Days5=0;
	$HalfDays5=0;
	$Days6=0;
	$HalfDays6=0;
	$Days7=0;
	$HalfDays7=0;
	$Days8=0;
	$HalfDays8=0;
	$Days9=0;
	$HalfDays9=0;
	$Days10=0;
	$HalfDays10=0;
	$Days11=0;
	$HalfDays11=0;
	$Days12=0;
	$HalfDays12=0;
	$Days13=0;
	$HalfDays13=0;
	$Days14=0;
	$HalfDays14=0;
	$Days15=0;
	$HalfDays15=0;
	$Days16=0;
	$HalfDays16=0;
	$Days17=0;
	$HalfDays17=0;
	$Days18=0;
	$HalfDays18=0;
	$Days19=0;
	$HalfDays19=0;
	$Days20=0;
	$HalfDays20=0;
	$Days21=0;
	$HalfDays21=0;
	$Days22=0;
	$HalfDays22=0;
	$Days23=0;
	$HalfDays23=0;
	$Days24=0;
	$HalfDays24=0;
	$Days25=0;
	$HalfDays25=0;
	$Days26=0;
	$HalfDays26=0;
	$Days27=0;
	$HalfDays27=0;
	$Days28=0;
	$HalfDays28=0;
	$Days29=0;
	$HalfDays29=0;
	$Days30=0;
	$HalfDays30=0;
	$Days31=0;
	$HalfDays31=0;
	

	$EDays1=0;
	$EHalfDays1=0;
	$EDays2=0;
	$EHalfDays2=0;
	$EDays3=0;
	$EHalfDays3=0;
	$EDays4=0;
	$EHalfDays4=0;
	$EDays5=0;
	$EHalfDays5=0;
	$EDays6=0;
	$EHalfDays6=0;
	$EDays7=0;
	$EHalfDays7=0;
	$EDays8=0;
	$EHalfDays8=0;
	$EDays9=0;
	$EHalfDays9=0;
	$EDays10=0;
	$EHalfDays10=0;
	$EDays11=0;
	$EHalfDays11=0;
	$EDays12=0;
	$EHalfDays12=0;
	$EDays13=0;
	$EHalfDays13=0;
	$EDays14=0;
	$EHalfDays14=0;
	$EDays15=0;
	$EHalfDays15=0;
	$EDays16=0;
	$EHalfDays16=0;
	$EDays17=0;
	$EHalfDays17=0;
	$EDays18=0;
	$EHalfDays18=0;
	$EDays19=0;
	$EHalfDays19=0;
	$EDays20=0;
	$EHalfDays20=0;
	$EDays21=0;
	$EHalfDays21=0;
	$EDays22=0;
	$EHalfDays22=0;
	$EDays23=0;
	$EHalfDays23=0;
	$EDays24=0;
	$EHalfDays24=0;
	$EDays25=0;
	$EHalfDays25=0;
	$EDays26=0;
	$EHalfDays26=0;
	$EDays27=0;
	$EHalfDays27=0;
	$EDays28=0;
	$EHalfDays28=0;
	$EDays29=0;
	$EHalfDays29=0;
	$EDays30=0;
	$EHalfDays30=0;
	$EDays31=0;
	$EHalfDays31=0;
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	if($_SESSION['RoleID'] == 'Administrator' OR user_authentication_with_company($_SESSION['UserID'],'SecureUpdCopmany',''.$ID.'') OR external_user_authentication_with_company($_SESSION['UserID'],'SecureUpdCopmany',''.$ID.'')){}else{redirect("Companies.php");}	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);
	if(isset($_POST["Abr"]))
		$Abr=trim($_POST["Abr"]);
	if(isset($_POST["Status"]) && ((int)$_POST["Status"] == 0 || (int)$_POST["Status"] == 1))
		$Status=trim($_POST["Status"]);	
	if(isset($_POST["Tax"]))
		$Tax=trim($_POST["Tax"]);
	if(isset($_POST["ProvidentFund"]))
		$ProvidentFund=trim($_POST["ProvidentFund"]);
	if(isset($_POST["BonusType"]))
		$BonusType=trim($_POST["BonusType"]);
	if(isset($_REQUEST["PerDayHours"]) && ctype_digit(trim($_REQUEST["PerDayHours"])))
		$PerDayHours=trim($_REQUEST["PerDayHours"]);
	if(isset($_POST["DeductionOnLates"]))
		$DeductionOnLates=trim($_POST["DeductionOnLates"]);
	if(isset($_POST["DeductionOnLatesTypes"]))
		$DeductionOnLatesTypes=trim($_POST["DeductionOnLatesTypes"]);
	if(isset($_POST["DeductionOnLatesAdjustment"]))
		$DeductionOnLatesAdjustment=trim($_POST["DeductionOnLatesAdjustment"]);
	if(isset($_POST["SandwitchDeductions"]))
		$SandwitchDeductions=trim($_POST["SandwitchDeductions"]);
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
	if(isset($_REQUEST["LoanDeductionPercent"]) && ctype_digit(trim($_REQUEST["LoanDeductionPercent"])))
		$LoanDeductionPercent=trim($_REQUEST["LoanDeductionPercent"]);
	
	if(isset($_POST["BonusPloicy1"]))
		$BonusPloicy1=trim($_POST["BonusPloicy1"]);
	if(isset($_POST["BonusPloicy2"]))
		$BonusPloicy2=trim($_POST["BonusPloicy2"]);
	if(isset($_POST["BonusPloicy3"]))
		$BonusPloicy3=trim($_POST["BonusPloicy3"]);
	if(isset($_POST["BonusPloicy4"]))
		$BonusPloicy4=trim($_POST["BonusPloicy4"]);
	if(isset($_POST["BonusPloicy5"]))
		$BonusPloicy5=trim($_POST["BonusPloicy5"]);
	if(isset($_POST["BonusPloicy6"]))
		$BonusPloicy6=trim($_POST["BonusPloicy6"]);
	if(isset($_POST["BonusPloicy7"]))
		$BonusPloicy7=trim($_POST["BonusPloicy7"]);
	if(isset($_POST["BonusPloicy8"]))
		$BonusPloicy8=trim($_POST["BonusPloicy8"]);
	if(isset($_POST["BonusPloicy9"]))
		$BonusPloicy9=trim($_POST["BonusPloicy9"]);
	if(isset($_POST["BonusPloicy10"]))
		$BonusPloicy10=trim($_POST["BonusPloicy10"]);
	if(isset($_POST["BonusPloicy11"]))
		$BonusPloicy11=trim($_POST["BonusPloicy11"]);
	if(isset($_POST["BonusPloicy12"]))
		$BonusPloicy12=trim($_POST["BonusPloicy12"]);
	if(isset($_POST["BonusPloicy13"]))
		$BonusPloicy13=trim($_POST["BonusPloicy13"]);
	
	if(isset($_POST["BonusBaseOn1"]))
		$BonusBaseOn1=trim($_POST["BonusBaseOn1"]);
	if(isset($_POST["BonusBaseOn2"]))
		$BonusBaseOn2=trim($_POST["BonusBaseOn2"]);
	if(isset($_POST["BonusBaseOn3"]))
		$BonusBaseOn3=trim($_POST["BonusBaseOn3"]);
	if(isset($_POST["BonusBaseOn4"]))
		$BonusBaseOn4=trim($_POST["BonusBaseOn4"]);
	if(isset($_POST["BonusBaseOn5"]))
		$BonusBaseOn5=trim($_POST["BonusBaseOn5"]);
	if(isset($_POST["BonusBaseOn6"]))
		$BonusBaseOn6=trim($_POST["BonusBaseOn6"]);
	if(isset($_POST["BonusBaseOn7"]))
		$BonusBaseOn7=trim($_POST["BonusBaseOn7"]);
	if(isset($_POST["BonusBaseOn8"]))
		$BonusBaseOn8=trim($_POST["BonusBaseOn8"]);
	if(isset($_POST["BonusBaseOn9"]))
		$BonusBaseOn9=trim($_POST["BonusBaseOn9"]);
	if(isset($_POST["BonusBaseOn10"]))
		$BonusBaseOn10=trim($_POST["BonusBaseOn10"]);
	if(isset($_POST["BonusBaseOn11"]))
		$BonusBaseOn11=trim($_POST["BonusBaseOn11"]);
	if(isset($_POST["BonusBaseOn12"]))
		$BonusBaseOn12=trim($_POST["BonusBaseOn12"]);
	if(isset($_POST["BonusBaseOn13"]))
		$BonusBaseOn13=trim($_POST["BonusBaseOn13"]);
	
	if(isset($_REQUEST["BonusAmntPer1"]) && ctype_digit(trim($_REQUEST["BonusAmntPer1"])))
		$BonusAmntPer1=trim($_REQUEST["BonusAmntPer1"]);
	if(isset($_REQUEST["BonusAmntPer2"]) && ctype_digit(trim($_REQUEST["BonusAmntPer2"])))
		$BonusAmntPer2=trim($_REQUEST["BonusAmntPer2"]);
	if(isset($_REQUEST["BonusAmntPer3"]) && ctype_digit(trim($_REQUEST["BonusAmntPer3"])))
		$BonusAmntPer3=trim($_REQUEST["BonusAmntPer3"]);
	if(isset($_REQUEST["BonusAmntPer4"]) && ctype_digit(trim($_REQUEST["BonusAmntPer4"])))
		$BonusAmntPer4=trim($_REQUEST["BonusAmntPer4"]);
	if(isset($_REQUEST["BonusAmntPer5"]) && ctype_digit(trim($_REQUEST["BonusAmntPer5"])))
		$BonusAmntPer5=trim($_REQUEST["BonusAmntPer5"]);
	if(isset($_REQUEST["BonusAmntPer6"]) && ctype_digit(trim($_REQUEST["BonusAmntPer6"])))
		$BonusAmntPer6=trim($_REQUEST["BonusAmntPer6"]);
	if(isset($_REQUEST["BonusAmntPer7"]) && ctype_digit(trim($_REQUEST["BonusAmntPer7"])))
		$BonusAmntPer7=trim($_REQUEST["BonusAmntPer7"]);
	if(isset($_REQUEST["BonusAmntPer8"]) && ctype_digit(trim($_REQUEST["BonusAmntPer8"])))
		$BonusAmntPer8=trim($_REQUEST["BonusAmntPer8"]);
	if(isset($_REQUEST["BonusAmntPer9"]) && ctype_digit(trim($_REQUEST["BonusAmntPer9"])))
		$BonusAmntPer9=trim($_REQUEST["BonusAmntPer9"]);
	if(isset($_REQUEST["BonusAmntPer10"]) && ctype_digit(trim($_REQUEST["BonusAmntPer10"])))
		$BonusAmntPer10=trim($_REQUEST["BonusAmntPer10"]);
	if(isset($_REQUEST["BonusAmntPer11"]) && ctype_digit(trim($_REQUEST["BonusAmntPer11"])))
		$BonusAmntPer11=trim($_REQUEST["BonusAmntPer11"]);
	if(isset($_REQUEST["BonusAmntPer12"]) && ctype_digit(trim($_REQUEST["BonusAmntPer12"])))
		$BonusAmntPer12=trim($_REQUEST["BonusAmntPer12"]);
	if(isset($_REQUEST["BonusAmntPer13"]) && ctype_digit(trim($_REQUEST["BonusAmntPer13"])))
		$BonusAmntPer13=trim($_REQUEST["BonusAmntPer13"]);
	
	if(isset($_POST["Days1"]))
		$Days1=trim($_POST["Days1"]);
	if(isset($_POST["HalfDays1"]))
		$HalfDays1=trim($_POST["HalfDays1"]);
	if(isset($_POST["Days2"]))
		$Days2=trim($_POST["Days2"]);
	if(isset($_POST["HalfDays2"]))
		$HalfDays2=trim($_POST["HalfDays2"]);
	if(isset($_POST["Days3"]))
		$Days3=trim($_POST["Days3"]);
	if(isset($_POST["HalfDays3"]))
		$HalfDays3=trim($_POST["HalfDays3"]);
	if(isset($_POST["Days4"]))
		$Days4=trim($_POST["Days4"]);
	if(isset($_POST["HalfDays4"]))
		$HalfDays4=trim($_POST["HalfDays4"]);
	if(isset($_POST["Days5"]))
		$Days5=trim($_POST["Days5"]);
	if(isset($_POST["HalfDays5"]))
		$HalfDays5=trim($_POST["HalfDays5"]);
	if(isset($_POST["Days6"]))
		$Days6=trim($_POST["Days6"]);
	if(isset($_POST["HalfDays6"]))
		$HalfDays6=trim($_POST["HalfDays6"]);
	if(isset($_POST["Days7"]))
		$Days7=trim($_POST["Days7"]);
	if(isset($_POST["HalfDays7"]))
		$HalfDays7=trim($_POST["HalfDays7"]);
	if(isset($_POST["Days8"]))
		$Days8=trim($_POST["Days8"]);
	if(isset($_POST["HalfDays8"]))
		$HalfDays8=trim($_POST["HalfDays8"]);
	if(isset($_POST["Days9"]))
		$Days9=trim($_POST["Days9"]);
	if(isset($_POST["HalfDays9"]))
		$HalfDays9=trim($_POST["HalfDays9"]);
	if(isset($_POST["Days10"]))
		$Days10=trim($_POST["Days10"]);
	if(isset($_POST["HalfDays10"]))
		$HalfDays10=trim($_POST["HalfDays10"]);
	if(isset($_POST["Days11"]))
		$Days11=trim($_POST["Days11"]);
	if(isset($_POST["HalfDays11"]))
		$HalfDays11=trim($_POST["HalfDays11"]);
	if(isset($_POST["Days12"]))
		$Days12=trim($_POST["Days12"]);
	if(isset($_POST["HalfDays12"]))
		$HalfDays12=trim($_POST["HalfDays12"]);
	if(isset($_POST["Days13"]))
		$Days13=trim($_POST["Days13"]);
	if(isset($_POST["HalfDays13"]))
		$HalfDays13=trim($_POST["HalfDays13"]);
	if(isset($_POST["Days14"]))
		$Days14=trim($_POST["Days14"]);
	if(isset($_POST["HalfDays14"]))
		$HalfDays14=trim($_POST["HalfDays14"]);
	if(isset($_POST["Days15"]))
		$Days15=trim($_POST["Days15"]);
	if(isset($_POST["HalfDays15"]))
		$HalfDays15=trim($_POST["HalfDays15"]);
	if(isset($_POST["Days16"]))
		$Days16=trim($_POST["Days16"]);
	if(isset($_POST["HalfDays16"]))
		$HalfDays16=trim($_POST["HalfDays16"]);
	if(isset($_POST["Days17"]))
		$Days17=trim($_POST["Days17"]);
	if(isset($_POST["HalfDays17"]))
		$HalfDays17=trim($_POST["HalfDays17"]);
	if(isset($_POST["Days18"]))
		$Days18=trim($_POST["Days18"]);
	if(isset($_POST["HalfDays18"]))
		$HalfDays18=trim($_POST["HalfDays18"]);
	if(isset($_POST["Days19"]))
		$Days19=trim($_POST["Days19"]);
	if(isset($_POST["HalfDays19"]))
		$HalfDays19=trim($_POST["HalfDays19"]);
	if(isset($_POST["Days20"]))
		$Days20=trim($_POST["Days20"]);
	if(isset($_POST["HalfDays20"]))
		$HalfDays20=trim($_POST["HalfDays20"]);
	if(isset($_POST["Days21"]))
		$Days21=trim($_POST["Days21"]);
	if(isset($_POST["HalfDays21"]))
		$HalfDays21=trim($_POST["HalfDays21"]);
	if(isset($_POST["Days22"]))
		$Days22=trim($_POST["Days22"]);
	if(isset($_POST["HalfDays22"]))
		$HalfDays22=trim($_POST["HalfDays22"]);
	if(isset($_POST["Days23"]))
		$Days23=trim($_POST["Days23"]);
	if(isset($_POST["HalfDays23"]))
		$HalfDays23=trim($_POST["HalfDays23"]);
	if(isset($_POST["Days24"]))
		$Days24=trim($_POST["Days24"]);
	if(isset($_POST["HalfDays24"]))
		$HalfDays24=trim($_POST["HalfDays24"]);
	if(isset($_POST["Days25"]))
		$Days25=trim($_POST["Days25"]);
	if(isset($_POST["HalfDays25"]))
		$HalfDays25=trim($_POST["HalfDays25"]);
	if(isset($_POST["Days26"]))
		$Days26=trim($_POST["Days26"]);
	if(isset($_POST["HalfDays26"]))
		$HalfDays26=trim($_POST["HalfDays26"]);
	if(isset($_POST["Days27"]))
		$Days27=trim($_POST["Days27"]);
	if(isset($_POST["HalfDays27"]))
		$HalfDays27=trim($_POST["HalfDays27"]);
	if(isset($_POST["Days28"]))
		$Days28=trim($_POST["Days28"]);
	if(isset($_POST["HalfDays28"]))
		$HalfDays28=trim($_POST["HalfDays28"]);
	if(isset($_POST["Days29"]))
		$Days29=trim($_POST["Days29"]);
	if(isset($_POST["HalfDays29"]))
		$HalfDays29=trim($_POST["HalfDays29"]);
	if(isset($_POST["Days30"]))
		$Days30=trim($_POST["Days30"]);
	if(isset($_POST["HalfDays30"]))
		$HalfDays30=trim($_POST["HalfDays30"]);
	if(isset($_POST["Days31"]))
		$Days31=trim($_POST["Days31"]);
	if(isset($_POST["HalfDays31"]))
		$HalfDays31=trim($_POST["HalfDays31"]);
	
	if(isset($_POST["EDays1"]))
		$EDays1=trim($_POST["EDays1"]);
	if(isset($_POST["EHalfDays1"]))
		$EHalfDays1=trim($_POST["EHalfDays1"]);
	if(isset($_POST["EDays2"]))
		$EDays2=trim($_POST["EDays2"]);
	if(isset($_POST["EHalfDays2"]))
		$EHalfDays2=trim($_POST["EHalfDays2"]);
	if(isset($_POST["EDays3"]))
		$EDays3=trim($_POST["EDays3"]);
	if(isset($_POST["EHalfDays3"]))
		$EHalfDays3=trim($_POST["EHalfDays3"]);
	if(isset($_POST["EDays4"]))
		$EDays4=trim($_POST["EDays4"]);
	if(isset($_POST["EHalfDays4"]))
		$EHalfDays4=trim($_POST["EHalfDays4"]);
	if(isset($_POST["EDays5"]))
		$EDays5=trim($_POST["EDays5"]);
	if(isset($_POST["EHalfDays5"]))
		$EHalfDays5=trim($_POST["EHalfDays5"]);
	if(isset($_POST["EDays6"]))
		$EDays6=trim($_POST["EDays6"]);
	if(isset($_POST["EHalfDays6"]))
		$EHalfDays6=trim($_POST["EHalfDays6"]);
	if(isset($_POST["EDays7"]))
		$EDays7=trim($_POST["EDays7"]);
	if(isset($_POST["EHalfDays7"]))
		$EHalfDays7=trim($_POST["EHalfDays7"]);
	if(isset($_POST["EDays8"]))
		$EDays8=trim($_POST["EDays8"]);
	if(isset($_POST["EHalfDays8"]))
		$EHalfDays8=trim($_POST["EHalfDays8"]);
	if(isset($_POST["EDays9"]))
		$EDays9=trim($_POST["EDays9"]);
	if(isset($_POST["EHalfDays9"]))
		$EHalfDays9=trim($_POST["EHalfDays9"]);
	if(isset($_POST["EDays10"]))
		$EDays10=trim($_POST["EDays10"]);
	if(isset($_POST["EHalfDays10"]))
		$EHalfDays10=trim($_POST["EHalfDays10"]);
	if(isset($_POST["EDays11"]))
		$EDays11=trim($_POST["EDays11"]);
	if(isset($_POST["EHalfDays11"]))
		$EHalfDays11=trim($_POST["EHalfDays11"]);
	if(isset($_POST["EDays12"]))
		$EDays12=trim($_POST["EDays12"]);
	if(isset($_POST["EHalfDays12"]))
		$EHalfDays12=trim($_POST["EHalfDays12"]);
	if(isset($_POST["EDays13"]))
		$EDays13=trim($_POST["EDays13"]);
	if(isset($_POST["EHalfDays13"]))
		$EHalfDays13=trim($_POST["EHalfDays13"]);
	if(isset($_POST["EDays14"]))
		$EDays14=trim($_POST["EDays14"]);
	if(isset($_POST["EHalfDays14"]))
		$EHalfDays14=trim($_POST["EHalfDays14"]);
	if(isset($_POST["EDays15"]))
		$EDays15=trim($_POST["EDays15"]);
	if(isset($_POST["EHalfDays15"]))
		$EHalfDays15=trim($_POST["EHalfDays15"]);
	if(isset($_POST["EDays16"]))
		$EDays16=trim($_POST["EDays16"]);
	if(isset($_POST["EHalfDays16"]))
		$EHalfDays16=trim($_POST["EHalfDays16"]);
	if(isset($_POST["EDays17"]))
		$EDays17=trim($_POST["EDays17"]);
	if(isset($_POST["EHalfDays17"]))
		$EHalfDays17=trim($_POST["EHalfDays17"]);
	if(isset($_POST["EDays18"]))
		$EDays18=trim($_POST["EDays18"]);
	if(isset($_POST["EHalfDays18"]))
		$EHalfDays18=trim($_POST["EHalfDays18"]);
	if(isset($_POST["EDays19"]))
		$EDays19=trim($_POST["EDays19"]);
	if(isset($_POST["EHalfDays19"]))
		$EHalfDays19=trim($_POST["EHalfDays19"]);
	if(isset($_POST["EDays20"]))
		$EDays20=trim($_POST["EDays20"]);
	if(isset($_POST["EHalfDays20"]))
		$EHalfDays20=trim($_POST["EHalfDays20"]);
	if(isset($_POST["EDays21"]))
		$EDays21=trim($_POST["EDays21"]);
	if(isset($_POST["EHalfDays21"]))
		$EHalfDays21=trim($_POST["EHalfDays21"]);
	if(isset($_POST["EDays22"]))
		$EDays22=trim($_POST["EDays22"]);
	if(isset($_POST["EHalfDays22"]))
		$EHalfDays22=trim($_POST["EHalfDays22"]);
	if(isset($_POST["EDays23"]))
		$EDays23=trim($_POST["EDays23"]);
	if(isset($_POST["EHalfDays23"]))
		$EHalfDays23=trim($_POST["EHalfDays23"]);
	if(isset($_POST["EDays24"]))
		$EDays24=trim($_POST["EDays24"]);
	if(isset($_POST["EHalfDays24"]))
		$EHalfDays24=trim($_POST["EHalfDays24"]);
	if(isset($_POST["EDays25"]))
		$EDays25=trim($_POST["EDays25"]);
	if(isset($_POST["EHalfDays25"]))
		$EHalfDays25=trim($_POST["EHalfDays25"]);
	if(isset($_POST["EDays26"]))
		$EDays26=trim($_POST["EDays26"]);
	if(isset($_POST["EHalfDays26"]))
		$EHalfDays26=trim($_POST["EHalfDays26"]);
	if(isset($_POST["EDays27"]))
		$EDays27=trim($_POST["EDays27"]);
	if(isset($_POST["EHalfDays27"]))
		$EHalfDays27=trim($_POST["EHalfDays27"]);
	if(isset($_POST["EDays28"]))
		$EDays28=trim($_POST["EDays28"]);
	if(isset($_POST["EHalfDays28"]))
		$EHalfDays28=trim($_POST["EHalfDays28"]);
	if(isset($_POST["EDays29"]))
		$EDays29=trim($_POST["EDays29"]);
	if(isset($_POST["EHalfDays29"]))
		$EHalfDays29=trim($_POST["EHalfDays29"]);
	if(isset($_POST["EDays30"]))
		$EDays30=trim($_POST["EDays30"]);
	if(isset($_POST["EHalfDays30"]))
		$EHalfDays30=trim($_POST["EHalfDays30"]);
	if(isset($_POST["EDays31"]))
		$EDays31=trim($_POST["EDays31"]);
	if(isset($_POST["EHalfDays31"]))
		$EHalfDays31=trim($_POST["EHalfDays31"]);
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
			<b>Logo size must be ' . MAX_IMAGE_SIZE . ' KB or less.</b>
			</div>';
		}
	}
	
	if($Name == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Company Name.</b>
		</div>';
	}
	else if($Abr == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Company Code.</b>
		</div>';
	}
	else if($CurrencySymbol == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Currency Symbol.</b>
		</div>';
	}
		
		
	
	if($msg=="")
	{
			$query="UPDATE companies SET DateModified=NOW(), UpdatedBy='".$_SESSION['UserID']."',
				Name = '" . dbinput($Name) . "',
				Abr = '" . dbinput($Abr) . "',
				Status='".(int)$Status . "',
				Tax = '" . dbinput($Tax) . "',
				ProvidentFund = '" . dbinput($ProvidentFund) . "',
				PerDayHours = '" . dbinput((int)$PerDayHours) . "',
				BonusType = '" . dbinput($BonusType) . "',
				DeductionOnLates = '" . dbinput($DeductionOnLates) . "',
				DeductionOnLatesTypes = '" . dbinput($DeductionOnLatesTypes) . "',
				DeductionOnLatesAdjustment = '" . dbinput($DeductionOnLatesAdjustment) . "',
				SandwitchDeductions = '" . dbinput($SandwitchDeductions) . "',
				RefreshQuota = '" . dbinput($RefreshQuota) . "',
				CurrencySymbol = '" . dbinput($CurrencySymbol) . "',
				PassingPercentage = '" . dbinput((int)$PassingPercentage) . "',
				NumOfAttempts = '" . dbinput((int)$NumOfAttempts) . "',
				InterviewPercentage = '" . dbinput((int)$InterviewPercentage) . "',
				YearStartFrom = '" . dbinput((int)$YearStartFrom) . "',
				LoanDeductionPercent = '" . dbinput((int)$LoanDeductionPercent) . "',
				Days1 = '" . (int)$Days1 . "',
				HalfDays1 = '" . (int)$HalfDays1 . "',
				Days2 = '" . (int)$Days2 . "',
				HalfDays2 = '" . (int)$HalfDays2 . "',
				Days3 = '" . (int)$Days3 . "',
				HalfDays3 = '" . (int)$HalfDays3 . "',
				Days4 = '" . (int)$Days4 . "',
				HalfDays4 = '" . (int)$HalfDays4 . "',
				Days5 = '" . (int)$Days5 . "',
				HalfDays5 = '" . (int)$HalfDays5 . "',
				Days6 = '" . (int)$Days6 . "',
				HalfDays6 = '" . (int)$HalfDays6 . "',
				Days7 = '" . (int)$Days7 . "',
				HalfDays7 = '" . (int)$HalfDays7 . "',
				Days8 = '" . (int)$Days8 . "',
				HalfDays8 = '" . (int)$HalfDays8 . "',
				Days9 = '" . (int)$Days9 . "',
				HalfDays9 = '" . (int)$HalfDays9 . "',
				Days10 = '" . (int)$Days10 . "',
				HalfDays10 = '" . (int)$HalfDays10 . "',
				Days11 = '" . (int)$Days11 . "',
				HalfDays11 = '" . (int)$HalfDays11 . "',
				Days12 = '" . (int)$Days12 . "',
				HalfDays12 = '" . (int)$HalfDays12 . "',
				Days13 = '" . (int)$Days13 . "',
				HalfDays13 = '" . (int)$HalfDays13 . "',
				Days14 = '" . (int)$Days14 . "',
				HalfDays14 = '" . (int)$HalfDays14 . "',
				Days15 = '" . (int)$Days15 . "',
				HalfDays15 = '" . (int)$HalfDays15 . "',
				Days16 = '" . (int)$Days16 . "',
				HalfDays16 = '" . (int)$HalfDays16 . "',
				Days17 = '" . (int)$Days17 . "',
				HalfDays17 = '" . (int)$HalfDays17 . "',
				Days18 = '" . (int)$Days18 . "',
				HalfDays18 = '" . (int)$HalfDays18 . "',
				Days19 = '" . (int)$Days19 . "',
				HalfDays19 = '" . (int)$HalfDays19 . "',
				Days20 = '" . (int)$Days20 . "',
				HalfDays20 = '" . (int)$HalfDays20 . "',
				Days21 = '" . (int)$Days21 . "',
				HalfDays21 = '" . (int)$HalfDays21 . "',
				Days22 = '" . (int)$Days22 . "',
				HalfDays22 = '" . (int)$HalfDays22 . "',
				Days23 = '" . (int)$Days23 . "',
				HalfDays23 = '" . (int)$HalfDays23 . "',
				Days24 = '" . (int)$Days24 . "',
				HalfDays24 = '" . (int)$HalfDays24 . "',
				Days25 = '" . (int)$Days25 . "',
				HalfDays25 = '" . (int)$HalfDays25 . "',
				Days26 = '" . (int)$Days26 . "',
				HalfDays26 = '" . (int)$HalfDays26 . "',
				Days27 = '" . (int)$Days27 . "',
				HalfDays27 = '" . (int)$HalfDays27 . "',
				Days28 = '" . (int)$Days28 . "',
				HalfDays28 = '" . (int)$HalfDays28 . "',
				Days29 = '" . (int)$Days29 . "',
				HalfDays29 = '" . (int)$HalfDays29 . "',
				Days30 = '" . (int)$Days30 . "',
				HalfDays30 = '" . (int)$HalfDays30 . "',
				Days31 = '" . (int)$Days31 . "',
				HalfDays31 = '" . (int)$HalfDays31 . "',
				EDays1 = '" . (int)$EDays1 . "',
				EHalfDays1 = '" . (int)$EHalfDays1 . "',
				EDays2 = '" . (int)$EDays2 . "',
				EHalfDays2 = '" . (int)$EHalfDays2 . "',
				EDays3 = '" . (int)$EDays3 . "',
				EHalfDays3 = '" . (int)$EHalfDays3 . "',
				EDays4 = '" . (int)$EDays4 . "',
				EHalfDays4 = '" . (int)$EHalfDays4 . "',
				EDays5 = '" . (int)$EDays5 . "',
				EHalfDays5 = '" . (int)$EHalfDays5 . "',
				EDays6 = '" . (int)$EDays6 . "',
				EHalfDays6 = '" . (int)$EHalfDays6 . "',
				EDays7 = '" . (int)$EDays7 . "',
				EHalfDays7 = '" . (int)$EHalfDays7 . "',
				EDays8 = '" . (int)$EDays8 . "',
				EHalfDays8 = '" . (int)$EHalfDays8 . "',
				EDays9 = '" . (int)$EDays9 . "',
				EHalfDays9 = '" . (int)$EHalfDays9 . "',
				EDays10 = '" . (int)$EDays10 . "',
				EHalfDays10 = '" . (int)$EHalfDays10 . "',
				EDays11 = '" . (int)$EDays11 . "',
				EHalfDays11 = '" . (int)$EHalfDays11 . "',
				EDays12 = '" . (int)$EDays12 . "',
				EHalfDays12 = '" . (int)$EHalfDays12 . "',
				EDays13 = '" . (int)$EDays13 . "',
				EHalfDays13 = '" . (int)$EHalfDays13 . "',
				EDays14 = '" . (int)$EDays14 . "',
				EHalfDays14 = '" . (int)$EHalfDays14 . "',
				EDays15 = '" . (int)$EDays15 . "',
				EHalfDays15 = '" . (int)$EHalfDays15 . "',
				EDays16 = '" . (int)$EDays16 . "',
				EHalfDays16 = '" . (int)$EHalfDays16 . "',
				EDays17 = '" . (int)$EDays17 . "',
				EHalfDays17 = '" . (int)$EHalfDays17 . "',
				EDays18 = '" . (int)$EDays18 . "',
				EHalfDays18 = '" . (int)$EHalfDays18 . "',
				EDays19 = '" . (int)$EDays19 . "',
				EHalfDays19 = '" . (int)$EHalfDays19 . "',
				EDays20 = '" . (int)$EDays20 . "',
				EHalfDays20 = '" . (int)$EHalfDays20 . "',
				EDays21 = '" . (int)$EDays21 . "',
				EHalfDays21 = '" . (int)$EHalfDays21 . "',
				EDays22 = '" . (int)$EDays22 . "',
				EHalfDays22 = '" . (int)$EHalfDays22 . "',
				EDays23 = '" . (int)$EDays23 . "',
				EHalfDays23 = '" . (int)$EHalfDays23 . "',
				EDays24 = '" . (int)$EDays24 . "',
				EHalfDays24 = '" . (int)$EHalfDays24 . "',
				EDays25 = '" . (int)$EDays25 . "',
				EHalfDays25 = '" . (int)$EHalfDays25 . "',
				EDays26 = '" . (int)$EDays26 . "',
				EHalfDays26 = '" . (int)$EHalfDays26 . "',
				EDays27 = '" . (int)$EDays27 . "',
				EHalfDays27 = '" . (int)$EHalfDays27 . "',
				EDays28 = '" . (int)$EDays28 . "',
				EHalfDays28 = '" . (int)$EHalfDays28 . "',
				EDays29 = '" . (int)$EDays29 . "',
				EHalfDays29 = '" . (int)$EHalfDays29 . "',
				EDays30 = '" . (int)$EDays30 . "',
				EHalfDays30 = '" . (int)$EHalfDays30 . "',
				EDays31 = '" . (int)$EDays31 . "',
				EHalfDays31 = '" . (int)$EHalfDays31 . "',
				BonusPloicy1 = '" . dbinput($BonusPloicy1) . "',
				BonusPloicy2 = '" . dbinput($BonusPloicy2) . "',
				BonusPloicy3 = '" . dbinput($BonusPloicy3) . "',
				BonusPloicy4 = '" . dbinput($BonusPloicy4) . "',
				BonusPloicy5 = '" . dbinput($BonusPloicy5) . "',
				BonusPloicy6 = '" . dbinput($BonusPloicy6) . "',
				BonusPloicy7 = '" . dbinput($BonusPloicy7) . "',
				BonusPloicy8 = '" . dbinput($BonusPloicy8) . "',
				BonusPloicy9 = '" . dbinput($BonusPloicy9) . "',
				BonusPloicy10 = '" . dbinput($BonusPloicy10) . "',
				BonusPloicy11 = '" . dbinput($BonusPloicy11) . "',
				BonusPloicy12 = '" . dbinput($BonusPloicy12) . "',
				BonusPloicy13 = '" . dbinput($BonusPloicy13) . "',
				BonusBaseOn1 = '" . dbinput($BonusBaseOn1) . "',
				BonusBaseOn2 = '" . dbinput($BonusBaseOn2) . "',
				BonusBaseOn3 = '" . dbinput($BonusBaseOn3) . "',
				BonusBaseOn4 = '" . dbinput($BonusBaseOn4) . "',
				BonusBaseOn5 = '" . dbinput($BonusBaseOn5) . "',
				BonusBaseOn6 = '" . dbinput($BonusBaseOn6) . "',
				BonusBaseOn7 = '" . dbinput($BonusBaseOn7) . "',
				BonusBaseOn8 = '" . dbinput($BonusBaseOn8) . "',
				BonusBaseOn9 = '" . dbinput($BonusBaseOn9) . "',
				BonusBaseOn10 = '" . dbinput($BonusBaseOn10) . "',
				BonusBaseOn11 = '" . dbinput($BonusBaseOn11) . "',
				BonusBaseOn12 = '" . dbinput($BonusBaseOn12) . "',
				BonusBaseOn13 = '" . dbinput($BonusBaseOn13) . "',
				BonusAmntPer1 = '" . (int)$BonusAmntPer1 . "',
				BonusAmntPer2 = '" . (int)$BonusAmntPer2 . "',
				BonusAmntPer3 = '" . (int)$BonusAmntPer3 . "',
				BonusAmntPer4 = '" . (int)$BonusAmntPer4 . "',
				BonusAmntPer5 = '" . (int)$BonusAmntPer5 . "',
				BonusAmntPer6 = '" . (int)$BonusAmntPer6 . "',
				BonusAmntPer7 = '" . (int)$BonusAmntPer7 . "',
				BonusAmntPer8 = '" . (int)$BonusAmntPer8 . "',
				BonusAmntPer9 = '" . (int)$BonusAmntPer9 . "',
				BonusAmntPer10 = '" . (int)$BonusAmntPer10 . "',
				BonusAmntPer11 = '" . (int)$BonusAmntPer11 . "',
				BonusAmntPer12 = '" . (int)$BonusAmntPer12 . "',
				BonusAmntPer13 = '" . (int)$BonusAmntPer13 . "'	WHERE ID='".(int)$ID."'";
				
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Company has been Updated.</b>
			</div>';
			
			if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
			{
				if(is_file(DIR_COMPANY_LOGO . $Logo))
					unlink(DIR_COMPANY_LOGO . $Logo);
			
				flush();
				ini_set('memory_limit', '-1');
				
				$tempName = $_FILES["flPage"]['tmp_name'];
				$realName = "C".$ID . "." . $ext;
				$Logo = $realName; 
				$target = DIR_COMPANY_LOGO . $realName;

				flush();
			
				$moved=move_uploaded_file($tempName, $target);
			
				if($moved)
				{			
				
					$query="UPDATE companies SET Logo='" . dbinput($realName) . "' WHERE  ID=" . (int)$ID;
					mysql_query($query) or die(mysql_error());
				}
				else
				{
					$msg='<div class="alert alert-warning alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>Company has been saved but Logo can not be uploaded.</b>
						</div>';
				}
			}
				
	}

}
else
{
	$query="SELECT * FROM companies WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Company ID.</b>
		</div>';
		redirect("Companies.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Name=$row["Name"];
		$Abr=$row["Abr"];
		$Status=$row["Status"];
		$Tax=$row["Tax"];
		$ProvidentFund=$row["ProvidentFund"];
		$BonusType=$row["BonusType"];
		$PerDayHours=$row["PerDayHours"];
		$DeductionOnLates=$row["DeductionOnLates"];
		$DeductionOnLatesTypes=$row["DeductionOnLatesTypes"];
		$DeductionOnLatesAdjustment=$row["DeductionOnLatesAdjustment"];
		$SandwitchDeductions=$row["SandwitchDeductions"];
		$RefreshQuota=$row["RefreshQuota"];
		$CurrencySymbol=$row["CurrencySymbol"];
		$PassingPercentage=$row["PassingPercentage"];
		$NumOfAttempts=$row["NumOfAttempts"];
		$InterviewPercentage=$row["InterviewPercentage"];
		$YearStartFrom=$row["YearStartFrom"];
		$LoanDeductionPercent=$row["LoanDeductionPercent"];
		
		$BonusPloicy1=$row["BonusPloicy1"];
		$BonusPloicy2=$row["BonusPloicy2"];
		$BonusPloicy3=$row["BonusPloicy3"];
		$BonusPloicy4=$row["BonusPloicy4"];
		$BonusPloicy5=$row["BonusPloicy5"];
		$BonusPloicy6=$row["BonusPloicy6"];
		$BonusPloicy7=$row["BonusPloicy7"];
		$BonusPloicy8=$row["BonusPloicy8"];
		$BonusPloicy9=$row["BonusPloicy9"];
		$BonusPloicy10=$row["BonusPloicy10"];
		$BonusPloicy11=$row["BonusPloicy11"];
		$BonusPloicy12=$row["BonusPloicy12"];
		$BonusPloicy13=$row["BonusPloicy13"];
		$BonusBaseOn1=$row["BonusBaseOn1"];
		$BonusBaseOn2=$row["BonusBaseOn2"];
		$BonusBaseOn3=$row["BonusBaseOn3"];
		$BonusBaseOn4=$row["BonusBaseOn4"];
		$BonusBaseOn5=$row["BonusBaseOn5"];
		$BonusBaseOn6=$row["BonusBaseOn6"];
		$BonusBaseOn7=$row["BonusBaseOn7"];
		$BonusBaseOn8=$row["BonusBaseOn8"];
		$BonusBaseOn9=$row["BonusBaseOn9"];
		$BonusBaseOn10=$row["BonusBaseOn10"];
		$BonusBaseOn11=$row["BonusBaseOn11"];
		$BonusBaseOn12=$row["BonusBaseOn12"];
		$BonusBaseOn13=$row["BonusBaseOn13"];
		$BonusAmntPer1=$row["BonusAmntPer1"];
		$BonusAmntPer2=$row["BonusAmntPer2"];
		$BonusAmntPer3=$row["BonusAmntPer3"];
		$BonusAmntPer4=$row["BonusAmntPer4"];
		$BonusAmntPer5=$row["BonusAmntPer5"];
		$BonusAmntPer6=$row["BonusAmntPer6"];
		$BonusAmntPer7=$row["BonusAmntPer7"];
		$BonusAmntPer8=$row["BonusAmntPer8"];
		$BonusAmntPer9=$row["BonusAmntPer9"];
		$BonusAmntPer10=$row["BonusAmntPer10"];
		$BonusAmntPer11=$row["BonusAmntPer11"];
		$BonusAmntPer12=$row["BonusAmntPer12"];
		$BonusAmntPer13=$row["BonusAmntPer13"];
		
		$Days1=$row["Days1"];
		$HalfDays1=$row["HalfDays1"];
		$Days2=$row["Days2"];
		$HalfDays2=$row["HalfDays2"];
		$Days3=$row["Days3"];
		$HalfDays3=$row["HalfDays3"];
		$Days4=$row["Days4"];
		$HalfDays4=$row["HalfDays4"];
		$Days5=$row["Days5"];
		$HalfDays5=$row["HalfDays5"];
		$Days6=$row["Days6"];
		$HalfDays6=$row["HalfDays6"];
		$Days7=$row["Days7"];
		$HalfDays7=$row["HalfDays7"];
		$Days8=$row["Days8"];
		$HalfDays8=$row["HalfDays8"];
		$Days9=$row["Days9"];
		$HalfDays9=$row["HalfDays9"];
		$Days10=$row["Days10"];
		$HalfDays10=$row["HalfDays10"];
		$Days11=$row["Days11"];
		$HalfDays11=$row["HalfDays11"];
		$Days12=$row["Days12"];
		$HalfDays12=$row["HalfDays12"];
		$Days13=$row["Days13"];
		$HalfDays13=$row["HalfDays13"];
		$Days14=$row["Days14"];
		$HalfDays14=$row["HalfDays14"];
		$Days15=$row["Days15"];
		$HalfDays15=$row["HalfDays15"];
		$Days16=$row["Days16"];
		$HalfDays16=$row["HalfDays16"];
		$Days17=$row["Days17"];
		$HalfDays17=$row["HalfDays17"];
		$Days18=$row["Days18"];
		$HalfDays18=$row["HalfDays18"];
		$Days19=$row["Days19"];
		$HalfDays19=$row["HalfDays19"];
		$Days20=$row["Days20"];
		$HalfDays20=$row["HalfDays20"];
		$Days21=$row["Days21"];
		$HalfDays21=$row["HalfDays21"];
		$Days22=$row["Days22"];
		$HalfDays22=$row["HalfDays22"];
		$Days23=$row["Days23"];
		$HalfDays23=$row["HalfDays23"];
		$Days24=$row["Days24"];
		$HalfDays24=$row["HalfDays24"];
		$Days25=$row["Days25"];
		$HalfDays25=$row["HalfDays25"];
		$Days26=$row["Days26"];
		$HalfDays26=$row["HalfDays26"];
		$Days27=$row["Days27"];
		$HalfDays27=$row["HalfDays27"];
		$Days28=$row["Days28"];
		$HalfDays28=$row["HalfDays28"];
		$Days29=$row["Days29"];
		$HalfDays29=$row["HalfDays29"];
		$Days30=$row["Days30"];
		$HalfDays30=$row["HalfDays30"];
		$Days31=$row["Days31"];
		$HalfDays31=$row["HalfDays31"];
		
		$EDays1=$row["EDays1"];
		$EHalfDays1=$row["EHalfDays1"];
		$EDays2=$row["EDays2"];
		$EHalfDays2=$row["EHalfDays2"];
		$EDays3=$row["EDays3"];
		$EHalfDays3=$row["EHalfDays3"];
		$EDays4=$row["EDays4"];
		$EHalfDays4=$row["EHalfDays4"];
		$EDays5=$row["EDays5"];
		$EHalfDays5=$row["EHalfDays5"];
		$EDays6=$row["EDays6"];
		$EHalfDays6=$row["EHalfDays6"];
		$EDays7=$row["EDays7"];
		$EHalfDays7=$row["EHalfDays7"];
		$EDays8=$row["EDays8"];
		$EHalfDays8=$row["EHalfDays8"];
		$EDays9=$row["EDays9"];
		$EHalfDays9=$row["EHalfDays9"];
		$EDays10=$row["EDays10"];
		$EHalfDays10=$row["EHalfDays10"];
		$EDays11=$row["EDays11"];
		$EHalfDays11=$row["EHalfDays11"];
		$EDays12=$row["EDays12"];
		$EHalfDays12=$row["EHalfDays12"];
		$EDays13=$row["EDays13"];
		$EHalfDays13=$row["EHalfDays13"];
		$EDays14=$row["EDays14"];
		$EHalfDays14=$row["EHalfDays14"];
		$EDays15=$row["EDays15"];
		$EHalfDays15=$row["EHalfDays15"];
		$EDays16=$row["EDays16"];
		$EHalfDays16=$row["EHalfDays16"];
		$EDays17=$row["EDays17"];
		$EHalfDays17=$row["EHalfDays17"];
		$EDays18=$row["EDays18"];
		$EHalfDays18=$row["EHalfDays18"];
		$EDays19=$row["EDays19"];
		$EHalfDays19=$row["EHalfDays19"];
		$EDays20=$row["EDays20"];
		$EHalfDays20=$row["EHalfDays20"];
		$EDays21=$row["EDays21"];
		$EHalfDays21=$row["EHalfDays21"];
		$EDays22=$row["EDays22"];
		$EHalfDays22=$row["EHalfDays22"];
		$EDays23=$row["EDays23"];
		$EHalfDays23=$row["EHalfDays23"];
		$EDays24=$row["EDays24"];
		$EHalfDays24=$row["EHalfDays24"];
		$EDays25=$row["EDays25"];
		$EHalfDays25=$row["EHalfDays25"];
		$EDays26=$row["EDays26"];
		$EHalfDays26=$row["EHalfDays26"];
		$EDays27=$row["EDays27"];
		$EHalfDays27=$row["EHalfDays27"];
		$EDays28=$row["EDays28"];
		$EHalfDays28=$row["EHalfDays28"];
		$EDays29=$row["EDays29"];
		$EHalfDays29=$row["EHalfDays29"];
		$EDays30=$row["EDays30"];
		$EHalfDays30=$row["EHalfDays30"];
		$EDays31=$row["EDays31"];
		$EHalfDays31=$row["EHalfDays31"];
		$Logo=$row["Logo"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Company</title>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
$(function() {
    //$('#single').hide(); 
    $('#DeductionOnLatesTypes').change(function(){
        if($('#DeductionOnLatesTypes').val() == 'Included') {
			$('#single').hide(1000);
			$('#both').show(1000);
        } else {
            $('#single').show(1000);
			$('#both').hide(1000);
        } 
    });
});

$(document).ready(function () {				
		if($('#LateTypeVarify').val() == 'Included') {
			$('#single').hide(1000);
			$('#both').show(1000);
        } else {
            $('#single').show(1000);
			$('#both').hide(1000);
        } 
});
</script>
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
      <h1>Edit Company</h1>
      <ol class="breadcrumb">
        <li><a href="Companies.php"><i class="fa fa-dashboard"></i>Companies</a></li>
        <li class="active">Edit Company</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Companies.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>	

			<?php
			// for($i=1;$i<=31;$i++)
			// {
						
				// echo '$Days'.$i.'=$row["Days'.$i.'"];<br>
				// $HalfDays'.$i.'=$row["HalfDays'.$i.'"];<br>
				// $Adjustment'.$i.'=$row["Adjustment'.$i.'"];<br>
						// ';
			// }
			?>
		 
		 <div class="col-md-6">
          <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Company Information</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
						  <label id="labelimp" for="flPage" class="labelimp" >Logo:</label>
						  <input type="file" name="flPage" />
						  <p class="help-block">Image types allowed: jpg, jpeg, gif, png.</p>
						</div>
						<p>
							<?php 
							if(isset($Logo) && $Logo !="")
							{
							echo '<img class="thumbnail" src="'.DIR_COMPANY_LOGO.$Logo.'" height="80">';
							}
							?>
						</p>
			  
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Name">Company Name: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="Name" name="Name" class="form-control"  value="'.$Name.'" />';
				?>
                </div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Abr">Code: </label>
				  <?php 
				echo '<input type="text" maxlength="4" id="Name" name="Abr" class="form-control"  value="'.$Abr.'" />';
				?>
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
        
          <div class="box box-solid">
		  <div class="box-header bg-box-blue">
                <h3 class="box-title">Leaves Management</h3>
            </div>
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" >Company's Year Start From: </label>
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
                  <label id="labelimp" >Refresh Leaves Quota Type: </label>
                  <select name="RefreshQuota" class="form-control">
				  <option value="Clear Previous" <?php echo ($RefreshQuota == "Clear Previous" ? ' selected' : ''); ?>>Leave Discard</option>
				  <option value="Include Previous" <?php echo ($RefreshQuota == "Include Previous" ? ' selected' : ''); ?>>Leave Carry Forward</option>
				  <option value="Paid Previous" <?php echo ($RefreshQuota == "Paid Previous" ? ' selected' : ''); ?>>Leave Encashment</option>
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
     
          
		
        </div>
		

        <div class="col-md-6">
		
		<div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Attendance Management</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
                  <label id="labelimp" >Salary Deduction On Lates: </label>
                  <select name="DeductionOnLates" class="form-control">
				  <option value="Yes" <?php echo ($DeductionOnLates == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($DeductionOnLates == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Lates Deduction Type: </label>
                  <select name="DeductionOnLatesTypes" id="DeductionOnLatesTypes" class="form-control">
				  <option value="Included" <?php echo ($DeductionOnLatesTypes == "Included" ? ' selected' : ''); ?>>Included Lates and Earlies</option>
				  <option value="Individual" <?php echo ($DeductionOnLatesTypes == "Individual" ? ' selected' : ''); ?>>Individual Lates and Earlies</option>
				  </select>
                </div>
				
				<input type="hidden" id="LateTypeVarify" value="<?php echo $DeductionOnLatesTypes; ?>" />
				
				<div class="form-group">
                  <label id="labelimp" >Lates Deduction or Adjustment: </label>
                  <select name="DeductionOnLatesAdjustment" id="DeductionOnLatesAdjustment" class="form-control">
				  <option value="No" <?php echo ($DeductionOnLatesAdjustment == "No" ? ' selected' : ''); ?>>Deduction from Salary</option>
				  <option value="Yes" <?php echo ($DeductionOnLatesAdjustment == "Yes" ? ' selected' : ''); ?>>Adjust from Leave Quota</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Sandwitch Deductions</label>
                  <select name="SandwitchDeductions" class="form-control">
				  <option value="No" <?php echo ($SandwitchDeductions == "No" ? ' selected' : ''); ?>>No</option>
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
                  <select disabled name="Tax" class="form-control">
				  <option value="Yes" <?php echo ($Tax == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($Tax == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Provident Fund: </label>
                  <select disabled name="ProvidentFund" class="form-control">
				  <option value="Yes" <?php echo ($ProvidentFund == "Yes" ? ' selected' : ''); ?>>Yes</option>
				  <option value="No" <?php echo ($ProvidentFund == "No" ? ' selected' : ''); ?>>No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Bonus Type: </label>
                  <select disabled name="BonusType" class="form-control">
				  <option value="Fixed" <?php echo ($BonusType == "Fixed" ? ' selected' : ''); ?>>Fixed Bonus For All Employees</option>
				  <option value="Individual" <?php echo ($BonusType == "Individual" ? ' selected' : ''); ?>>Individual Bonuses For Selected Employees</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="LoanDeductionPercent">Loan Deduction Percent at Bonus: </label>
                  <?php 
				echo '<input type="number" maxlength="100" id="LoanDeductionPercent" name="LoanDeductionPercent" class="form-control"  value="'.$LoanDeductionPercent.'" />';
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
		
		<div class="col-md-12" id="single">
		<div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Lates / Earlies Schedule</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <h4>Total Lates / Earlies </h4>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					   <h4>Lates Days Deduction</h4>
					</div>
				  </div>
				  <div class="col-md-2">
					<h4>HalfDay</h4>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					   <h4>Earlies Days Deduction</h4>
					</div>
				  </div>
				  <div class="col-md-2">
					<h4>HalfDay</h4>
				  </div>
			  </div>
			
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 1 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days1" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days1 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays1" value="1" <?php echo ($HalfDays1 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays1" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays1 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays1" value="1" <?php echo ($EHalfDays1 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 2 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days2" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days2 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays2" value="1" <?php echo ($HalfDays2 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays2" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays2 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays2" value="1" <?php echo ($EHalfDays2 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 3 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days3" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days3 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays3" value="1" <?php echo ($HalfDays3 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays3" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays3 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays3" value="1" <?php echo ($EHalfDays3 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 4 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days4" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days4 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays4" value="1" <?php echo ($HalfDays4 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays4" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays4 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays4" value="1" <?php echo ($EHalfDays4 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 5 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days5" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days5 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays5" value="1" <?php echo ($HalfDays5 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays5" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays5 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays5" value="1" <?php echo ($EHalfDays5 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 6 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days6" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days6 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays6" value="1" <?php echo ($HalfDays6 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays6" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays6 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays6" value="1" <?php echo ($EHalfDays6 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 7 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days7" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days7 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays7" value="1" <?php echo ($HalfDays7 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays7" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays7 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays7" value="1" <?php echo ($EHalfDays7 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 8 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days8" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days8 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays8" value="1" <?php echo ($HalfDays8 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays8" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays8 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays8" value="1" <?php echo ($EHalfDays8 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 9 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days9" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days9 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays9" value="1" <?php echo ($HalfDays9 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays9" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays9 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays9" value="1" <?php echo ($EHalfDays9 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 10 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days10" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days10 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays10" value="1" <?php echo ($HalfDays10 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays10" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays10 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays10" value="1" <?php echo ($EHalfDays10 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 11 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days11" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days11 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays11" value="1" <?php echo ($HalfDays11 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays11" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays11 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays11" value="1" <?php echo ($EHalfDays11 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 12 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days12" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days12 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays12" value="1" <?php echo ($HalfDays12 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays12" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays12 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays12" value="1" <?php echo ($EHalfDays12 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 13 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days13" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days13 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays13" value="1" <?php echo ($HalfDays13 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays13" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays13 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays13" value="1" <?php echo ($EHalfDays13 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 14 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days14" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days14 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays14" value="1" <?php echo ($HalfDays14 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays14" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays14 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays14" value="1" <?php echo ($EHalfDays14 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 15 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days15" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days15 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays15" value="1" <?php echo ($HalfDays15 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays15" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays15 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays15" value="1" <?php echo ($EHalfDays15 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 16 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days16" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days16 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays16" value="1" <?php echo ($HalfDays16 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays16" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays16 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays16" value="1" <?php echo ($EHalfDays16 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 17 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days17" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days17 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays17" value="1" <?php echo ($HalfDays17 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays17" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays17 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays17" value="1" <?php echo ($EHalfDays17 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 18 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days18" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days18 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays18" value="1" <?php echo ($HalfDays18 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays18" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays18 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays18" value="1" <?php echo ($EHalfDays18 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 19 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days19" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days19 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays19" value="1" <?php echo ($HalfDays19 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays19" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays19 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays19" value="1" <?php echo ($EHalfDays19 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 20 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days20" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days20 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays20" value="1" <?php echo ($HalfDays20 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays20" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays20 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays20" value="1" <?php echo ($EHalfDays20 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 21 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days21" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days21 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays21" value="1" <?php echo ($HalfDays21 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays21" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays21 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays21" value="1" <?php echo ($EHalfDays21 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 22 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days22" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days22 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays22" value="1" <?php echo ($HalfDays22 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays22" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays22 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays22" value="1" <?php echo ($EHalfDays22 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 23 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days23" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days23 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays23" value="1" <?php echo ($HalfDays23 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays23" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays23 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays23" value="1" <?php echo ($EHalfDays23 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 24 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days24" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days24 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays24" value="1" <?php echo ($HalfDays24 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays24" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays24 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays24" value="1" <?php echo ($EHalfDays24 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 25 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days25" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days25 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays25" value="1" <?php echo ($HalfDays25 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays25" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays25 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays25" value="1" <?php echo ($EHalfDays25 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 26 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days26" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days26 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays26" value="1" <?php echo ($HalfDays26 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays26" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays26 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays26" value="1" <?php echo ($EHalfDays26 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 27 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days27" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days27 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays27" value="1" <?php echo ($HalfDays27 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays27" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays27 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays27" value="1" <?php echo ($EHalfDays27 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 28 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days28" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days28 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays28" value="1" <?php echo ($HalfDays28 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays28" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays28 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays28" value="1" <?php echo ($EHalfDays28 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 29 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days29" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days29 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays29" value="1" <?php echo ($HalfDays29 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays29" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays29 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays29" value="1" <?php echo ($EHalfDays29 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 30 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days30" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days30 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays30" value="1" <?php echo ($HalfDays30 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays30" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays30 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays30" value="1" <?php echo ($EHalfDays30 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-2">
					<div class="form-group">
					  <label id="labelimp" >Total 31 Lates / Earlies</label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="Days31" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days31 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays31" value="1" <?php echo ($HalfDays31 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="EDays31" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($EDays31 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="EHalfDays31" value="1" <?php echo ($EHalfDays31 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>

			  
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
        </div>
		</div>
		
		<div class="col-md-12" id="both">
		<div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Lates / Earlies Schedule</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <h4>Number of Lates (Including Earlies) </h4>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					   <h4>Num of Days Deduction</h4>
					</div>
				  </div>
				  <div class="col-md-2">
					<h4>HalfDay Deduction</h4>
				  </div>
			  </div>
			
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 1 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days1" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days1 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays1" value="1" <?php echo ($HalfDays1 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 2 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days2" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days2 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays2" value="1" <?php echo ($HalfDays2 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 3 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days3" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days3 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays3" value="1" <?php echo ($HalfDays3 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 4 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days4" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days4 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays4" value="1" <?php echo ($HalfDays4 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 5 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days5" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days5 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays5" value="1" <?php echo ($HalfDays5 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 6 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days6" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days6 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays6" value="1" <?php echo ($HalfDays6 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 7 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days7" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days7 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays7" value="1" <?php echo ($HalfDays7 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 8 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days8" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days8 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays8" value="1" <?php echo ($HalfDays8 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 9 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days9" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days9 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays9" value="1" <?php echo ($HalfDays9 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 10 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days10" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days10 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays10" value="1" <?php echo ($HalfDays10 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 11 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days11" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days11 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays11" value="1" <?php echo ($HalfDays11 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 12 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days12" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days12 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays12" value="1" <?php echo ($HalfDays12 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 13 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days13" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days13 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays13" value="1" <?php echo ($HalfDays13 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 14 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days14" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days14 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays14" value="1" <?php echo ($HalfDays14 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 15 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days15" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days15 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays15" value="1" <?php echo ($HalfDays15 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 16 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days16" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days16 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays16" value="1" <?php echo ($HalfDays16 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 17 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days17" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days17 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays17" value="1" <?php echo ($HalfDays17 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 18 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days18" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days18 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays18" value="1" <?php echo ($HalfDays18 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 19 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days19" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days19 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays19" value="1" <?php echo ($HalfDays19 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 20 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days20" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days20 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays20" value="1" <?php echo ($HalfDays20 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 21 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days21" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days21 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays21" value="1" <?php echo ($HalfDays21 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 22 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days22" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days22 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays22" value="1" <?php echo ($HalfDays22 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 23 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days23" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days23 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays23" value="1" <?php echo ($HalfDays23 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 24 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days24" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days24 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays24" value="1" <?php echo ($HalfDays24 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 25 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days25" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days25 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays25" value="1" <?php echo ($HalfDays25 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 26 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days26" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days26 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays26" value="1" <?php echo ($HalfDays26 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 27 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days27" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days27 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays27" value="1" <?php echo ($HalfDays27 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 28 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days28" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days28 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays28" value="1" <?php echo ($HalfDays28 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 29 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days29" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days29 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays29" value="1" <?php echo ($HalfDays29 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 30 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days30" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days30 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays30" value="1" <?php echo ($HalfDays30 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label id="labelimp" >Total 31 Lates (Including Earlies) </label>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<select name="Days31" class="form-control">
					  <?php 
					  for($i = 0; $i <= 31; $i++)
					  {
					  ?>
						   <option value="<?php echo $i; ?>" <?php echo ($Days31 == $i ? ' selected' : ''); ?>><?php echo $i.' Days'; ?></option>
					  <?php
					  }
					  ?>
					</select>
					</div>
				  </div>
				  <div class="col-md-2">
					<div class="form-group">
						<input type="checkbox" name="HalfDays31" value="1" <?php echo ($HalfDays31 == 1 ? ' checked="checked"' : ''); ?>>
					</div>
				  </div>
			  </div>
			   
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
        </div>
		</div>
	
		<div class="col-md-12">
		<div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Bonus Policy</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <h4>Number of Days (Months) </h4>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					   <h4>Bonus Applicable As </h4>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					   <h4>Bonus Base On </h4>
					</div>
				  </div>
				  <div class="col-md-3">
					<h4>Amount / Percentage </h4>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >1 to 30 Days (1 Month) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy1" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy1 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy1 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy1 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy1 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy1 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn1" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn1 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn1 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer1" value="<?php echo $BonusAmntPer1; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >31 to 60 Days (2 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy2" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy2 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy2 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy2 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy2 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy2 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn2" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn2 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn2 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer2" value="<?php echo $BonusAmntPer2; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >61 to 90 Days (3 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy3" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy3 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy3 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy3 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy3 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy3 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn3" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn3 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn3 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer3" value="<?php echo $BonusAmntPer3; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >91 to 120 Days (4 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy4" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy4 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy4 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy4 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy4 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy4 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn4" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn4 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn4 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer4" value="<?php echo $BonusAmntPer4; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >121 to 150 Days (5 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy5" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy5 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy5 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy5 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy5 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy5 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn5" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn5 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn5 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer5" value="<?php echo $BonusAmntPer5; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >151 to 180 Days (6 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy6" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy6 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy6 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy6 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy6 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy6 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn6" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn6 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn6 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer6" value="<?php echo $BonusAmntPer6; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >181 to 210 Days (7 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy7" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy7 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy7 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy7 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy7 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy7 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn7" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn7 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn7 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer7" value="<?php echo $BonusAmntPer7; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >211 to 240 Days (8 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy8" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy8 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy8 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy8 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy8 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy8 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn8" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn8 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn8 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer8" value="<?php echo $BonusAmntPer8; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >241 to 270 Days (9 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy9" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy9 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy9 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy9 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy9 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy9 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn9" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn9 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn9 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer9" value="<?php echo $BonusAmntPer9; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >271 to 300 Days (10 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy10" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy10 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy10 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy10 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy10 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy10 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn10" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn10 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn10 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer10" value="<?php echo $BonusAmntPer10; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >301 to 330 Days (11 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy11" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy11 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy11 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy11 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy11 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy11 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn11" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn11 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn11 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer11" value="<?php echo $BonusAmntPer11; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >331 to 365 Days (12 Months) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy12" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy12 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy12 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy12 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy12 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy12 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn12" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn12 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn12 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer12" value="<?php echo $BonusAmntPer12; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <label id="labelimp" >366 or Above Days (1 Year Above) </label>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusPloicy13" class="form-control">
					 <option value="None" <?php echo ($BonusPloicy13 == 'None' ? ' selected' : ''); ?>>None</option>
					 <option value="Fixed" <?php echo ($BonusPloicy13 == 'Fixed' ? ' selected' : ''); ?>>Fixed Amount</option>
					 <option value="Gross" <?php echo ($BonusPloicy13 == 'Gross' ? ' selected' : ''); ?>>Gross Salary</option>
					 <option value="Basic" <?php echo ($BonusPloicy13 == 'Basic' ? ' selected' : ''); ?>>Basic Salary</option>
					 <option value="GrossAnnual" <?php echo ($BonusPloicy13 == 'GrossAnnual' ? ' selected' : ''); ?>>Gross With Annual Bonus</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
					<select name="BonusBaseOn13" class="form-control">
					 <option value="Monthly" <?php echo ($BonusBaseOn13 == 'Monthly' ? ' selected' : ''); ?>>Monthly</option>
					 <option value="Percentage" <?php echo ($BonusBaseOn13 == 'Percentage' ? ' selected' : ''); ?>>Percentage</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<input type="number" class="form-control" name="BonusAmntPer13" value="<?php echo $BonusAmntPer13; ?>">
					</div>
				  </div>
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
