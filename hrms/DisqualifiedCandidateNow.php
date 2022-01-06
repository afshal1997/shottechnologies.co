<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$Can=0;
	$Interview=0;


	if(isset($_REQUEST["Interview"]) && ctype_digit(trim($_REQUEST["Interview"])))
	$Interview=trim($_REQUEST["Interview"]);
	if(isset($_REQUEST["Can"]) && ctype_digit(trim($_REQUEST["Can"])))
	$Can=trim($_REQUEST["Can"]);
	
	if($Can != 0)
	{
	$query="UPDATE candidates SET IsDisqualified = 'Yes' WHERE ID = '".(int)$Can."'";
	mysql_query($query) or die (mysql_error());
	}
		redirect('InterviewsDetails.php?ID='.$Interview);

	

?>