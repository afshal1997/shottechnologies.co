<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
	
	$LeaveDays = array();
	$HalfDays = array();
	
	$ArrivalTime="";
	$DepartTime="";
	$LateArrival="";
	$EarlyDepart="";
	$ArrivalHalfDay="";
	$DepartHalfDay="";
	
	$startdate = '';
	
if($action == "delete")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
			foreach($_REQUEST["ids"] as $BID)
			{
			mysql_query("DELETE FROM timeadjust_requests  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Time Adjust Requests.</b>
			</div>';
			redirect("TimeAdjustRequests.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Time Adjust Request to delete.</b>
			</div>';
		}
	}

if($action == "bulkapprove")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
		foreach($_REQUEST["ids"] as $BID)
		{
			
			$query="SELECT RosterID,LoginTime,LogoutTime FROM timeadjust_requests WHERE ID='" . (int)$BID . "'";
	
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			
			if($num==0)
			{
				$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<b>Invalid Time Adjust Request ID.</b>
				</div>';
				redirect("TimeAdjustRequests.php");
			}
			else
			{
				$rows = mysql_fetch_assoc($result);
				
				$query2="UPDATE timeadjust_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = 1,
				DateModified = NOW() WHERE ID = ".$BID."";
				mysql_query($query2) or die (mysql_error());
				
				$query3="SELECT lo.ID,li.LoginTime,lo.LogoutTime,li.Status
					 FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$rows['RosterID']."";
				$result3 = mysql_query($query3) or die (mysql_error());
				$num3 = mysql_num_rows($result3);
			
				if($num3 > 0)
				{
					$row = mysql_fetch_array($result3);
					
					if($row['Status'] == 'Off Day')
					{
						$query2="UPDATE roster_login_history SET MLoginTime='".$row['LoginTime']."',LoginTime='". time_format_gracetime($rows['LoginTime']) ."' WHERE ID='" . (int)$rows['RosterID'] . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query2="UPDATE roster_logout_history SET MLogoutTime='".$row['LogoutTime']."',LogoutTime='". time_format_gracetime($rows['LogoutTime']) ."' WHERE ID='" . (int)$row['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
					}
					else
					{
						$query2="UPDATE roster_login_history SET MLoginTime='".$row['LoginTime']."',LoginTime='". time_format_gracetime($rows['LoginTime']) ."', Status = 'Present' WHERE ID='" . (int)$rows['RosterID'] . "'";
						mysql_query($query2) or die (mysql_error());
						
						$query2="UPDATE roster_logout_history SET MLogoutTime='".$row['LogoutTime']."',LogoutTime='". time_format_gracetime($rows['LogoutTime']) ."' WHERE ID='" . (int)$row['ID'] . "'";
						mysql_query($query2) or die (mysql_error());
					}
						
				}
				
				$query5="SELECT e.ID AS EmpID,e.LeavesDays,lo.ID,li.LoginTime,li.DateAdded,lo.LogoutTime,li.Status
					 FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded WHERE li.ID = ".$rows['RosterID']."";
				$result5 = mysql_query($query5) or die (mysql_error());
				$num5 = mysql_num_rows($result5);
			
				if($num5 > 0)
				{
					$row5 = mysql_fetch_array($result5);			
					$startdate=strtotime($row5['DateAdded']);
					
					$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = '".$row5['EmpID']."'";
					$result = mysql_query ($query) or die(mysql_error());
					$num = mysql_num_rows($result);
					if($num == 1)
					{
						$row = mysql_fetch_array($result);
						
						$query="INSERT INTO temp_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."' AND Status <> 'Off Day' AND Status <> 'Absent'";
						mysql_query ($query) or die(mysql_error());
						
						$query="INSERT INTO temp_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded)
							SELECT lo.UserID, lo.LogoutTime, lo.MLogoutTime, lo.LogoutDate, lo.DateAdded FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
							WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status <> 'Off Day' AND li.Status <> 'Absent'";
						mysql_query ($query) or die(mysql_error());
						
						$query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						
						$query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						
						$query="INSERT INTO roster_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM temp_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						mysql_query ($query) or die(mysql_error());
						
						$query="INSERT INTO roster_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded FROM temp_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						mysql_query ($query) or die(mysql_error());
						
						$query="TRUNCATE TABLE temp_login_history";
						mysql_query ($query) or die(mysql_error());
						
						$query="TRUNCATE TABLE temp_logout_history";
						mysql_query ($query) or die(mysql_error());
						
						
						
						$query2="SELECT ID,LoginTime FROM roster_login_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						$num2 = mysql_num_rows($result2);
						$row2 = mysql_fetch_array($result2);
						
						if($num2 == 0)
						{
							if($row['LeavesDays'] != "")
							{
							$LeaveDays = explode(',',$row['LeavesDays']);
							}
							
							$query3="SELECT ID FROM minus_leaves_quota WHERE EmpID='" . (int)$row['ID'] . "' AND LeaveDate = '".date("Y-m-d", $startdate)."'";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							
							if ($num3 != 0)
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Leave'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Full day On" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$row['ID'] . "',
							Status = 'Absent',MStatus = '".$Reason."'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if (in_array(''.date("N", $startdate).'', $LeaveDays))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Off Day'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Full day Off" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "',
								Status = 'Off Day',MStatus = '".$Reason."'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
							else
							{
							$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$row['ID'] . "',
							Status = 'Absent'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
							}
						}
						else
						{
							
							if($row['HalfDays'] != "")
							{
							$HalfDays = explode(',',$row['HalfDays']);
							}
							
							$query4="SELECT ArrivalTime,LateArrival,ArrivalHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
							$result4 = mysql_query ($query4) or die(mysql_error()); 
							$num4 = mysql_num_rows($result4);
							if($num4 == 1)
							{
								$row4 = mysql_fetch_array($result4);
								//strtotime($Variable);
								$ArrivalTime=$row4['ArrivalTime'];
								$LateArrival=$row4['LateArrival'];
								$ArrivalHalfDay=$row4['ArrivalHalfDay'];
							}
							
							if (!in_array(''.date("N", $startdate).'', $HalfDays))
							{
								
								if ($What == "Allow Arrival Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
								}
								else if ($What == "Allow Late Arrival" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									
									if ($row2['LoginTime'] != null)
									{
										if ($row2['LoginTime'] > $ArrivalHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
								else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Not Allowed")
								{
									
									if ($row2['LoginTime'] != null)
									{
										if ($row2['LoginTime'] > $ArrivalHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
										else if ($row2['LoginTime'] > $LateArrival)
										{
										$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
								else if ($row['ArrivalHalfDay'] == "Not Allowed" && $row['LateArrivalPolicy'] == "Allowed")
								{
									if ($row2['LoginTime'] != null)
									{
										if ($row2['LoginTime'] > $ArrivalHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
							}
							
						}
						// Arrival End
						$query2="SELECT ID,LogoutTime FROM roster_logout_history WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						$result2 = mysql_query ($query2) or die(mysql_error()); 
						$num2 = mysql_num_rows($result2);
						$row2 = mysql_fetch_array($result2);
						
						if($num2 == 0)
						{
							
							$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							
							$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
								UserID = '" . (int)$row['ID'] . "'";
							mysql_query($query3) or die (mysql_error());
						}
						else
						{
							if($row['HalfDays'] != "")
							{
							$HalfDays = explode(',',$row['HalfDays']);
							}
							
							$query4="SELECT DepartTime,EarlyDepart,DepartHalfDay FROM schedules WHERE ID='" . (int)$row['ScheduleID'] . "'";
							$result4 = mysql_query ($query4) or die(mysql_error()); 
							$num4 = mysql_num_rows($result4);
							if($num4 == 1)
							{
								$row4 = mysql_fetch_array($result4);
								$DepartTime=$row4['DepartTime'];
								$EarlyDepart=$row4['EarlyDepart'];
								$DepartHalfDay=$row4['DepartHalfDay'];
							}
							
							
							if (!in_array(''.date("N", $startdate).'', $HalfDays))
							{						
								if ($What == "Allow Departure Half day" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
								}
								else if ($What == "Allow Early Departure" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
								{
									$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									
									if ($row2['LogoutTime'] != null)
									{
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
								else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Not Allowed")
								{
									
									if ($row2['LogoutTime'] != null)
									{
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
										else if ($row2['LogoutTime'] < $EarlyDepart)
										{
										$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
								else if ($row['DepartHalfDay'] == "Not Allowed" && $row['EarlyDeparturePolicy'] == "Allowed")
								{
									if ($row2['LogoutTime'] != null)
									{
										if ($row2['LogoutTime'] < $DepartHalfDay)
										{
										$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
										mysql_query($query3) or die (mysql_error());
										}
									}
								}
								//this is new code from
								
								$querytemp="SELECT li.LoginTime,lo.LogoutTime FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
								WHERE lo.UserID='" . (int)$row['ID'] . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status = 'Present'";
								$resulttemp = mysql_query($querytemp) or die (mysql_error());
								$numtemp = mysql_num_rows($resulttemp);
								$rowtemp = mysql_fetch_array($resulttemp);
								
								if ($rowtemp['LoginTime'] != null AND $rowtemp['LogoutTime'] == null)
								{
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
								}
								
								//this is new code till
							}
							
						}
						
						if($row['LeavesDays'] != "")
							{
							$LeaveDays = explode(',',$row['LeavesDays']);
							}
							
							if (in_array(''.date("N", $startdate).'', $LeaveDays))
							{
							$query3="UPDATE roster_login_history SET 
							Status = 'Off Day', EarlyDep = 0, Late = 0, HalfDay = 0 WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
							mysql_query($query3) or die (mysql_error());
							}
							
						$query3="UPDATE roster_login_history SET ScheduleArrival = '".$row['ArrivalTime']."',ScheduleDepart = '".$row['DepartTime']."',LateArrival = '".$row['LateArrival']."',EarlyDepart = '".$row['EarlyDepart']."',LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE UserID='" . (int)$row['ID'] . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						mysql_query($query3) or die (mysql_error());
					
					}
					
						
				}
				
			}
			
		}
			
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Time Adjust request has been Approved.</b>
			</div>';		
			
			redirect("TimeAdjustRequests.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Time Adjust Request to Approve.</b>
			</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Time Adjust Requests</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Allowance-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
	
	function doDelete()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to delete."))
			{
				$("#action").val("delete");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Time Adjust Request to delete");
	}
	
	function doBulkapprove()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to delete."))
			{
				$("#action").val("bulkapprove");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Time Adjust Request to Approve");
	}
	
</script>
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php
	include_once("Header.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
		include_once("Sidebar.php");

				$prev="";
				$next="";
				$nav="";
				$rowsPerPage=20;
				$pageNum=1;
				
				$DFrom="";
				$DTo="";
				$DateFrom="";
				$DateTo="";
				
				$Keywords="";
				
				$SortField=2;
				$SortType="ASC";
					
				$_SORT_FIELDS = array("DateAdded");
				
				if(isset($_REQUEST["Keywords"]))
					$Keywords = trim($_REQUEST["Keywords"]);

				if(isset($_REQUEST["PageIndex"]) && ctype_digit(trim($_REQUEST["PageIndex"])))
					$pageNum=trim($_REQUEST["PageIndex"]);

				$offset = ($pageNum - 1) * $rowsPerPage;
				$limit=" Limit ".$offset.", ".$rowsPerPage;
				
				$query="SELECT l.ID,l.RosterID,DATE_FORMAT(r.LoginDate, '%D %b %Y') AS AdjustDate,l.Approved,l.LoginTime,l.LogoutTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Added,DATE_FORMAT(l.DateModified, '%D %b %Y') AS Updated FROM timeadjust_requests l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN employees a ON l.ApprovedBy = a.ID LEFT JOIN roster_login_history r ON l.RosterID = r.ID WHERE l.ID <>0 ";
				if($Keywords != "")
					$query .= " AND (e.EmpID LIKE '%" . dbinput($Keywords) . "%')";
				$query .= " ORDER BY l.Approved,l.ID DESC";
				
				
				
				
				$result = mysql_query ($query.$limit) or die("Could not select because: ".mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die(mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				if($maxRow > 0)
				{ 
					$maxPage = ceil($maxRow/$rowsPerPage);
					$nav  = '';
					if($maxPage>1)
					for($page = 1; $page <= $maxPage; $page++)
					{
						
					   if ($page == $pageNum)
						  $nav .= "&nbsp;<li class=\"active\"><a href='#'>$page</a></li >"; 
					   else
						  $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">$page</a> </li>";
					}
					
					if ($pageNum > 1)
					{
						$page  = $pageNum - 1;
						$prev  = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Previous</a> ";
						$first = "&nbsp;<a href=\"$self?PageIndex=1&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">First</a> ";
					} 
					else
					{
					   $prev  = ''; // we're on page one, don't print previous link
					   $first = '&nbsp;First'; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Next</a> ";
						$last = "&nbsp;<a href=\"$self?PageIndex=$maxPage&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Last Page</a> ";
					} 
					else
					{
					   $next = "";
					   $last = '&nbsp;Last'; // nor the last page link
					}
				}
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Time Adjust Requests <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Time Adjust Requests</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Time Adjust Requests</h3>
			  <div class="buttons">
                
                <button type="button" class="btn btn-success margin" onClick="javascript:doBulkapprove()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Bulk Approve</button>
				
				<button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Delete</button>
				
				
               
                
                
              </div><form action="<?php echo $self;?>" method="post" style="clear:both; margin:0 5px">
                    <div class="input-group input-group-sm">
                        <input value="<?php if(isset($_REQUEST["Keywords"])){echo trim($_REQUEST["Keywords"]);}?>" type="text" name="Keywords" class="form-control span2">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Adjust Date</th>
					  <th>Arrival Time</th>
					  <th>Depart Time</th>
					  <th>Status</th>
					  <th>Performed By</th>
					  <th>DateAdded</th>
					  <th>DateModified</th>
					  <th></th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Time Adjust Request listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
		?>
                    <tr>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo dboutput($row["AdjustDate"]); ?></td>
					  <td><?php echo revert_time_format_gracetime($row["LoginTime"]); ?></td>
					  <td><?php echo revert_time_format_gracetime($row["LogoutTime"]); ?></td>
                      <td><?php if(dboutput($row["Approved"])=='1'){echo '<mark style="background-color:#0f0">Approved</mark>';}else if(dboutput($row["Approved"])=='0'){echo '<mark style="background-color:#ff0">Pending</mark>';}else{echo '<mark style="background-color:#f00">DisApproved</mark>';} ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td><?php echo $row["Updated"]; ?></td>
					  <td align="center" class="noPrint"><button class="btn btn-info margin" type="button" onClick="location.href='ViewTimeAdjustRequest.php?ID=<?php echo $row["ID"]; ?>'">Details</button></td>
                    </tr>
                    <?php				
				}
			} 
			mysql_close($dbh);
		?>
                  </tbody>
                </table>
              </form>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <div class="dataTables_info" id="example2_info"> Total <?php echo $maxRow;?> entries </div>
              </div>
              <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php echo $prev;?> </li>
                    <?php
					echo $nav;
					?>
                    <li class="next"> <?php echo $next;?> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- ./wrapper -->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->

</body>
</html>
