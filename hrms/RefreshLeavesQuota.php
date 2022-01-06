<?php
include_once("Common.php");
include("CheckAdminLogin.php");

	$msg="";
	
	$query="SELECT ID FROM employees WHERE ID <>0 AND Status = 'Active'";
	$result = mysql_query($query) or die (mysql_error());
	$num = mysql_num_rows($result);
	
	if($num > 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$query2="SELECT AnualLeaves,CasualLeaves FROM leaves_quota WHERE ID <>0 AND EmpID = ".$row['ID']." AND Approved = 1";
			$result2 = mysql_query($query2) or die (mysql_error());
			$num2 = mysql_num_rows($result2);
			if($num2 == 1)
			{
				$row2 = mysql_fetch_array($result2);
				$AnualLeaves = $row2['AnualLeaves'];
				$CasualLeaves = $row2['CasualLeaves'];
				
				$query3="SELECT ID,AnualLeaves FROM current_leaves_quota WHERE ID <>0 AND EmpID = ".$row['ID']."";
				$result3 = mysql_query($query3) or die (mysql_error());
				$num3 = mysql_num_rows($result3);
				
				if($num3 == 1)
				{
					$row3 = mysql_fetch_array($result3);
					
					$query4="SELECT RefreshQuota FROM organization_settings WHERE ID <>0";
					$result4 = mysql_query($query4) or die (mysql_error());
					$num4 = mysql_num_rows($result4);
					if($num4 == 1)
					{
					$row4 = mysql_fetch_array($result4);
					
					if($row4['RefreshQuota'] == 'Clear Previous')
					{
						$query="UPDATE current_leaves_quota SET 
								AnualLeaves = '" . (int)$AnualLeaves . "',
								CasualLeaves = '" . (int)$CasualLeaves . "' WHERE
								EmpID='".$row['ID']. "'";
						mysql_query($query) or die (mysql_error());
					}
					else if($row4['RefreshQuota'] == 'Include Previous')
					{
						$query="UPDATE current_leaves_quota SET 
								AnualLeaves = '" . (int)($AnualLeaves+$row3['AnualLeaves']) . "',
								CasualLeaves = '" . (int)$CasualLeaves . "' WHERE
								EmpID='".$row['ID']. "'";
						mysql_query($query) or die (mysql_error());
					}
					else if($row4['RefreshQuota'] == 'Paid Previous')
					{
						$query="INSERT INTO paid_leaves_quota SET 
								Leaves = '" . (int)$row3['AnualLeaves'] . "',
								EmpID='".$row['ID']. "',
								MonthYear=NOW()";
						mysql_query($query) or die (mysql_error());
						
						$query="UPDATE current_leaves_quota SET 
								AnualLeaves = '" . (int)$AnualLeaves . "',
								CasualLeaves = '" . (int)$CasualLeaves . "' WHERE
								EmpID='".$row['ID']. "'";
						mysql_query($query) or die (mysql_error());
						
					}
					
					}
				}
			}
		}
	}
	mysql_query("INSERT INTO refresh_leave_quota SET Year = ".date('Y')."") or die(mysql_error());
	$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b>Refresh Leaves Quota Successfully of all Employees.</b>
	</div>';
			
	
	redirect("LeavesQuota.php");	
?>