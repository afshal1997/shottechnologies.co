<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	

if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
	$query2="UPDATE encashment SET Steps = 0 WHERE ID = " . (int)$ID . "";
	mysql_query($query2) or die (mysql_error());
	
	$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Retrun to HR Successfully.</b>
	</div>';
	redirect("EncashmentSheet.php?ID=".$ID);
?>