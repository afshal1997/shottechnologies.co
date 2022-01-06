
<?php
	include('Common.php');
	
	$Anual=0;
	$Casual=0;
	$CAnual=0;
	$CCasual=0;
	$TAnual=0;
	$TCasual=0;
	
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID = trim($_REQUEST["ID"]);
	
	$query1="SELECT AnualLeaves,CasualLeaves FROM leaves_quota  WHERE ID <>0 AND EmpID=".$ID." AND Approved = 1";
	$res1 = mysql_query($query1) or die(mysql_error());
	$num1 = mysql_num_rows($res1);
	if($num1 == 1)
	{
		$row1 = mysql_fetch_array($res1);
		$Anual=$row1['AnualLeaves'];
		$Casual=$row1['CasualLeaves'];
		
		$query2="SELECT AnualLeaves,CasualLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".$ID."";
		$res2 = mysql_query($query2) or die(mysql_error());
		$num2 = mysql_num_rows($res2);
		
		if($num2 == 1)
		{
			$row2 = mysql_fetch_array($res2);
			$CAnual=$row2['AnualLeaves'];
			$CCasual=$row2['CasualLeaves'];
			
			$TAnual = $Anual - $CAnual;
			$TCasual = $Casual - $CCasual;
		}
	}
	
	
	
	
?>
<table  id="dataTable" class="table table-bordered table-striped">
  <thead style="color:black !important;">
	<tr>
	  <th width="80%" style="text-align:center;">Leaves Type</th>
	  <th>Entitled</th>
	  <th>Taken</th>
	  <th>Balance</th>
	</tr>
  </thead>
  
  <tbody>
	<tr>
	  
	  
	  <td width="50%">Annual Leaves</td>
	  <td><?php echo $Anual ; ?></td>
	  <td><?php echo $TAnual ; ?></td>
	  <td><?php echo $CAnual ; ?></td>
	</tr>
	<tr>
	  
	  
	  <td width="50%">Casual Leaves</td>
	  <td><?php echo $Casual ; ?></td>
	  <td><?php echo $TCasual ; ?></td>
	  <td><?php echo $CCasual ; ?></td>
	</tr>
  </tbody>
</table>