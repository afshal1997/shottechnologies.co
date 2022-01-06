<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";


mysql_query("SET AUTOCOMMIT=0");
mysql_query("START TRANSACTION");	
	
$query="SELECT distinct EmpID FROM minus_leaves_quota";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	while($row = mysql_fetch_array($result))
	{
		
		$query2="SELECT SUM(Qty) AS Quantity FROM minus_leaves_quota WHERE DATE_FORMAT(LeaveDate, '%Y') = '2017' AND EmpID =".$row['EmpID'];
	
		$result2 = mysql_query ($query2) or die(mysql_error()); 
		$num2 = mysql_num_rows($result2);
		if($num2 == 1)
		{
			$row2 = mysql_fetch_array($result2);
			
			if($row2['Quantity'] > 0)
			{			
			$query3="UPDATE current_leaves_quota SET CasualLeaves = (CasualLeaves - ".$row2['Quantity'].") WHERE  EmpID =".$row['EmpID'];
			$result3 = mysql_query ($query3) or die(mysql_error());
			}
			
		}
		
	}	
		mysql_query("COMMIT");
		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Leave Has been Updated.</b>
		</div>';
		redirect("Leaves.php");
	
?>