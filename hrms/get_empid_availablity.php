
<?php
include("Common.php"); 

if(isset($_REQUEST["ID"]))
		$val =trim($_REQUEST["ID"]);

$query = "SELECT * FROM employees where EmpID = '".$val."'";
	
$data = mysql_query($query) or die("ProductDescription not get".mysql_error());
$num = mysql_num_rows($data);
if($num != 0)
{
	echo '<span style="background-color:red;color:white">Not Available</span>';
}
else
{
	echo '<span style="background-color:green;color:white">Available</span>';
}
?>