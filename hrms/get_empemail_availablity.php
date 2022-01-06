
<?php
include("Common.php"); 

if(isset($_REQUEST["ID"]))
		$val =trim($_REQUEST["ID"]);

$query = "SELECT ID FROM employees where EmailAddress = '".$val."' AND EmailAddress <> ''";
	
$data = mysql_query($query) or die("ProductDescription not get".mysql_error());
$num = mysql_num_rows($data);
if($num != 0)
{
	echo '<input type="hidden" name="action" value="submit_forgot_form" />
	<button type="submit" class="btn btn-primary">Submit</button>';
}
else
{
	echo '<button type="button" disabled class="btn btn-primary">Submit</button>';
}
?>