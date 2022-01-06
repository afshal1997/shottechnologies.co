<?php
include("Common2.php"); 

if(isset($_REQUEST["empid"]))
		$val =trim($_REQUEST["empid"]);
$query = "SELECT ID,Photo FROM employees where EmpID='".dbinput($val)."' AND ID='".(int)$_SESSION["UserID"]."'";
	
$data = mysql_query($query) or die(mysql_error());
$num = mysql_num_rows($data);
if($num == 1)
{
$row = mysql_fetch_array($data);
?>

<input type="hidden" name="UserID" value="<?php echo $row['ID']; ?>">
<input type="hidden" name="Photo" value="<?php echo dboutput($row["Photo"]); ?>">
<input type="hidden" name="action" value="submit_form">
<button type="submit" class="btn-trans-sensor"> </button>
<?php
}
else
{
?>

<?php
}
?>