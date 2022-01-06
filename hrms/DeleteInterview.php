<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$Can=0;
	$Post=0;
	$Interview=0;

	if(isset($_REQUEST["Can"]) && ctype_digit(trim($_REQUEST["Can"])))
	$Can=trim($_REQUEST["Can"]);
	if(isset($_REQUEST["Post"]) && ctype_digit(trim($_REQUEST["Post"])))
	$Post=trim($_REQUEST["Post"]);
	if(isset($_REQUEST["Interview"]) && ctype_digit(trim($_REQUEST["Interview"])))
	$Interview=trim($_REQUEST["Interview"]);
	
	if($Can != 0)
	{
	$query="DELETE FROM candidates_answers WHERE CandidateID = '".(int)$Can."' AND PostID = '".(int)$Post."'";
	mysql_query($query) or die (mysql_error());
	}
		redirect('InterviewsDetails.php?ID='.$Interview);

?>