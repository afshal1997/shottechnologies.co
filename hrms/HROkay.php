<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	

if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
$query="SELECT ID FROM payroll WHERE ID='" . (int)$ID . "' AND Steps = 0";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==1)
	{
		$query2="UPDATE payroll SET Steps = 1, Step1ID = '".(int)$_SESSION["UserID"]."', Step1Date = NOW() WHERE ID = " . (int)$ID . "";
		mysql_query($query2) or die (mysql_error());
		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Successfully Submited to Accounts.</b>
		</div>';
		redirect("SalarySheet.php?ID=".$ID);
	}
	else
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Something not matched.</b>
		</div>';
		redirect("SalarySheet.php?ID=".$ID);
	}
?>