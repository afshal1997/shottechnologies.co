<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$Emp=0;
	$Test=0;
	$Training=0;

	if(isset($_REQUEST["Emp"]) && ctype_digit(trim($_REQUEST["Emp"])))
	$Emp=trim($_REQUEST["Emp"]);
	if(isset($_REQUEST["Test"]) && ctype_digit(trim($_REQUEST["Test"])))
	$Test=trim($_REQUEST["Test"]);
	if(isset($_REQUEST["Training"]) && ctype_digit(trim($_REQUEST["Training"])))
	$Training=trim($_REQUEST["Training"]);
	
	if($Emp != 0)
	{
	$query="DELETE FROM stud_answers WHERE StudentID = '".(int)$Emp."' AND TestID = '".(int)$Test."'";
	mysql_query($query) or die (mysql_error());
	}
		redirect('TrainingsDetails.php?ID='.$Training);

?>