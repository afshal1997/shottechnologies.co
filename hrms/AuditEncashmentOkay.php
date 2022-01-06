<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$ID=0;	
$AnualLeaves=0;
$CasualLeaves=0;

if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);

mysql_query("SET AUTOCOMMIT=0");
mysql_query("START TRANSACTION");	
	
$query="SELECT ID FROM encashment WHERE ID='" . (int)$ID . "' AND Steps = 2";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==1)
	{
		$query2="UPDATE encashment SET Steps = 3, Step3ID = '".(int)$_SESSION["UserID"]."', Step3Date = NOW() WHERE ID = " . (int)$ID . "";
		mysql_query($query2) or die (mysql_error());
		
		$query2="SELECT ID,EmpID,OtherDeductions FROM encashmentdetails WHERE EncashmentID='" . (int)$ID . "' AND OtherDeductions > 0";
		$result2 = mysql_query ($query2) or die(mysql_error()); 
		$num2 = mysql_num_rows($result2);
		if($num2 > 0)
		{
			while($row2 = mysql_fetch_array($result2))
			{
				$query3 = "SELECT ID,RemainingAmount FROM loans where EmpID = ".$row2['EmpID']." AND RemainingAmount > 0 ORDER BY LoanType ASC";
				$res3 = mysql_query($query3);
				$num3 = mysql_num_rows($res3);
				if($num3 > 0)
				{
					while($row3 = mysql_fetch_array($res3))
					{
						if($row3['RemainingAmount'] > $row2['OtherDeductions'])
						{
							$query="INSERT INTO loans_manualrecovery SET 
									EmpID = '" . dbinput($row2['EmpID']) . "',
									LoanID = '" . dbinput($row3['ID']) . "',
									PaymentType = '" . 5 . "',
									PaymentDate = NOW(),
									Amount = '" . $row2['OtherDeductions'] . "',
									ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
									DateAdded = NOW()";
							mysql_query($query) or die (mysql_error());
							
							 $query="UPDATE loans SET 
									RemainingAmount = RemainingAmount - ".$row2['OtherDeductions'].",
									DateModified = NOW() WHERE ID = '" . dbinput($row3['ID']) . "'";
							 mysql_query($query) or die (mysql_error());
							 
							 $query4="SELECT ID,Amount FROM loans_schedule 
									WHERE LoanID = '" . dbinput($row3['ID']) . "' ORDER BY ID DESC";
							 $res4 = mysql_query($query4) or die (mysql_error());
							 $num4 = mysql_num_rows($res4);
							if($num4 > 0)
							{
								while($row4 = mysql_fetch_array($res4))
								{
									if($row2['OtherDeductions'] > 0)
									{
										if($row2['OtherDeductions'] > $row4['Amount'])
										{
											$row2['OtherDeductions'] = $row2['OtherDeductions'] - $row4['Amount'];
											$query="DELETE FROM loans_schedule WHERE ID = '" . $row4['ID'] . "'";
											mysql_query($query) or die (mysql_error());
										}
										else if($row4['Amount'] == $row2['OtherDeductions'])
										{
											$row2['OtherDeductions'] = $row2['OtherDeductions'] - $row4['Amount'];
											$query="DELETE FROM loans_schedule WHERE ID = '" . $row4['ID'] . "'";
											mysql_query($query) or die (mysql_error());
										}
										else
										{
											$query="UPDATE loans_schedule SET 
													Amount = Amount - ".$row2['OtherDeductions'].",
													DateModified = NOW() WHERE ID = '" . $row4['ID'] . "'";
											 mysql_query($query) or die (mysql_error());
											 
											 $row2['OtherDeductions'] = 0;
										}
									}
									
								}
							}
						}
						else if($row3['RemainingAmount'] < $row2['OtherDeductions'])
						{
							$query="INSERT INTO loans_manualrecovery SET 
									EmpID = '" . dbinput($row2['EmpID']) . "',
									LoanID = '" . dbinput($row3['ID']) . "',
									PaymentType = '" . 5 . "',
									PaymentDate = NOW(),
									Amount = '" . $row3['RemainingAmount'] . "',
									ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
									DateAdded = NOW()";
							mysql_query($query) or die (mysql_error());
							
							 $query="UPDATE loans SET 
									RemainingAmount = RemainingAmount - ".$row3['RemainingAmount'].",
									DateModified = NOW() WHERE ID = '" . dbinput($row3['ID']) . "'";
							 mysql_query($query) or die (mysql_error());
							 
							 $query4="SELECT ID,Amount FROM loans_schedule 
									WHERE LoanID = '" . dbinput($row3['ID']) . "' ORDER BY ID DESC";
							 $res4 = mysql_query($query4) or die (mysql_error());
							 $num4 = mysql_num_rows($res4);
							if($num4 > 0)
							{
								while($row4 = mysql_fetch_array($res4))
								{
									if($row3['RemainingAmount'] > 0)
									{
										if($row3['RemainingAmount'] > $row4['Amount'])
										{
											$row3['RemainingAmount'] = $row3['RemainingAmount'] - $row4['Amount'];$row2['OtherDeductions'] = $row2['OtherDeductions'] - $row3['RemainingAmount'];
											$query="DELETE FROM loans_schedule WHERE ID = '" . $row4['ID'] . "'";
											mysql_query($query) or die (mysql_error());
										}
										else if($row4['Amount'] == $row3['RemainingAmount'])
										{
											$row3['RemainingAmount'] = $row3['RemainingAmount'] - $row4['Amount'];$row2['OtherDeductions'] = $row2['OtherDeductions'] - $row3['RemainingAmount'];
											$query="DELETE FROM loans_schedule WHERE ID = '" . $row4['ID'] . "'";
											mysql_query($query) or die (mysql_error());
										}
										else
										{
											$query="UPDATE loans_schedule SET 
													Amount = Amount - ".$row3['RemainingAmount'].",
													DateModified = NOW() WHERE ID = '" . $row4['ID'] . "'";
											 mysql_query($query) or die (mysql_error());
											 
											$row2['OtherDeductions'] = $row2['OtherDeductions'] - $row3['RemainingAmount'];
										}
									}
									
								}
							}
						}
					}
				}
			}
		}
		
		$query2="SELECT EmpID FROM encashmentdetails WHERE EncashmentID='" . (int)$ID . "'";
		$result2 = mysql_query ($query2) or die(mysql_error()); 
		$num2 = mysql_num_rows($result2);
		if($num2 > 0)
		{
			while($row2 = mysql_fetch_array($result2))
			{	
				$query3="SELECT ID FROM employees WHERE ID <>0 AND Status = 'Active' AND ID = ".$row2['EmpID']."";
				$result3 = mysql_query($query3) or die (mysql_error());
				$num3 = mysql_num_rows($result3);
				
				if($num3 > 0)
				{
					while($row3 = mysql_fetch_array($result3))
					{
						$query4="SELECT AnualLeaves,CasualLeaves FROM leaves_quota WHERE ID <>0 AND EmpID = ".$row3['ID']." AND Approved = 1";
						$result4 = mysql_query($query4) or die (mysql_error());
						$num4 = mysql_num_rows($result4);
						if($num4 == 1)
						{
							$row4 = mysql_fetch_array($result4);
							$AnualLeaves = $row4['AnualLeaves'];
							$CasualLeaves = $row4['CasualLeaves'];
							
							$query5="UPDATE current_leaves_quota SET 
									AnualLeaves = '" . (int)$AnualLeaves . "',
									CasualLeaves = '" . (int)$CasualLeaves . "' WHERE
									EmpID='".$row3['ID']. "'";
							mysql_query($query5) or die (mysql_error());
							
						}
					}
				}
			}
		}
		
		mysql_query("COMMIT");
		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Encashment Successfully Audit.</b>
		</div>';
		redirect("EncashmentSheet.php?ID=".$ID);
	}
	else
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Something not matched.</b>
		</div>';
		redirect("EncashmentSheet.php?ID=".$ID);
	}
?>