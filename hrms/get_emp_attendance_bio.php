<?php
include("Common2.php"); 

if(isset($_REQUEST["empid"]))
		$val =trim($_REQUEST["empid"]);
$query = "SELECT ID FROM employees where EmpID='".dbinput($val)."' AND ID='".(int)$_SESSION["UserID"]."'";
	
$data = mysql_query($query) or die(mysql_error());
$num = mysql_num_rows($data);
if($num == 1)
{
?>
.biomatrics
{
background-image:url('images/bio4.png');width:388px;height:266px;
}
<?php
}
else
{
?>
.biomatrics
{
background-image:url('images/bio5.png');width:388px;height:266px;
}
<?php
}
?>