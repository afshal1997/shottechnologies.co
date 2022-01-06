
	<option value="0" >Select Loan Tran #</option>
<?php
	include('Common.php');
	

	
	if(isset($_REQUEST["EmpID"]) && ctype_digit(trim($_REQUEST["EmpID"])))
		$EmpID = trim($_REQUEST["EmpID"]);
	
	$r = mysql_query("SELECT ID, Code,Amount,RemainingAmount FROM loans WHERE EmpID = ".dbinput($EmpID)." AND RemainingAmount > 0") or die(mysql_error());
	$n = mysql_num_rows($r);
	
	if($n == 0)
	{
		echo '<option value="0">No Loan Found</option>';
	}
	else
	{
		while($Rs = mysql_fetch_assoc($r))
		echo '<option value="'.dboutput($Rs['ID']).'">Tran#: '.dboutput($Rs['Code']).' | Amount: '.dboutput($Rs['Amount']).' | Balance: '.dboutput($Rs['RemainingAmount']).'</option>';
	}
	
?>

