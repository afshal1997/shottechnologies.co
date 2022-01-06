<?php
include("Common2.php"); 

if(isset($_REQUEST["empid"]))
		$val =trim($_REQUEST["empid"]);
$query = "SELECT UserName FROM employees where EmpID='".dbinput($val)."' AND ID='".(int)$_SESSION["UserID"]."'";

$data = mysql_query($query) or die(mysql_error());
$num = mysql_num_rows($data);
if($num == 1)
{
$row = mysql_fetch_array($data);

echo $row['UserName'];

}

?>