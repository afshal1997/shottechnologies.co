
<?php
include("Common2.php"); 

if(isset($_REQUEST["empid"]))
		$val =trim($_REQUEST["empid"]);
$query = "SELECT ID FROM employees where EmpID='".dbinput($val)."'";
	
$data = mysql_query($query) or die(mysql_error());
$num = mysql_num_rows($data);
if($num == 1)
{
?>
.biomatrics
{
background-image:url('images/bio1.png');width:388px;height:266px;
}
<?php
}
else
{
?>
.biomatrics
{
background-image:url('images/bio2.png');width:388px;height:266px;
}
<?php
}
?>