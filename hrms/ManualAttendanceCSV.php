<?php
include_once("Common.php");
include("CheckAdminLogin.php");

	$msg="";
	$ID=0;
	$EmpID = 0;
	
	$FromDate="";
	$ToDate="";
	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$CompanyID="";
	$CompID=array();
	$LocationID="";
	$LocID=array();
	$What="";
	$Reason="";
	
	
	$LeaveDays = array();
	$HalfDays = array();
	
	$ArrivalTime="";
	$DepartTime="";
	$LateArrival="";
	$EarlyDepart="";
	$ArrivalHalfDay="";
	$DepartHalfDay="";
	
	$startdate="";
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_ONLY_CSV_ALLOWED))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			Only '.implode(", ", $_ONLY_CSV_ALLOWED) . ' extention file can be uploaded.
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_CSV_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			CSV size must be ' . (MAX_CSV_SIZE/1024) . ' MB or less.
			</div>';
		}
	}
		

	
		if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please Upload File.</b>
			</div>';
		}



	if($msg=="")
	{

    if (is_uploaded_file($_FILES['flPage']['tmp_name'])) {
	
	// $deleterecords = "TRUNCATE TABLE individual_bonuses"; //empty the table of its current records
	// mysql_query($deleterecords) or die(mysql_error());
    
    //Import uploaded file to Database
    $handle = fopen($_FILES['flPage']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$empinfo="SELECT ID from employees WHERE ID <> 0 AND ID = '".$data[0]."' AND Status='Active'";
        $empresult = mysql_query($empinfo) or die(mysql_error());
		$numbers = mysql_num_rows($empresult);
		if($numbers == 1)
		{	
			$Emprow = mysql_fetch_array($empresult);
			$EmpID = $Emprow['ID'];
			$startdate=strtotime($data[1]);
				//-------------------------------------------------------------------
				
				$query="SELECT e.ID,e.CompanyID,e.Location,e.LeavesDays,e.HalfDays,e.ScheduleID,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,s.ArrivalTime,s.DepartTime,s.LateArrival,s.EarlyDepart FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = ".(int)$EmpID."";
				//echo $query; exit();
				$result = mysql_query ($query) or die(mysql_error());
				$num = mysql_num_rows($result);					
				while($row = mysql_fetch_array($result))
				{
					// $query="INSERT INTO temp_login_history (UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM roster_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."' AND Status <> 'Off Day' AND Status <> 'Absent'";
					// mysql_query ($query) or die(mysql_error());
					
					// $query="INSERT INTO temp_logout_history (UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT lo.UserID, lo.LogoutTime, lo.MLogoutTime, lo.LogoutDate, lo.DateAdded FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID) WHERE lo.UserID='" . (int)$EmpID . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status <> 'Off Day' AND li.Status <> 'Absent'";
					// mysql_query ($query) or die(mysql_error());
					
					
					
					// $validate="SELECT ID from temp_login_history WHERE ID <> 0 AND UserID = '".$EmpID."' AND LoginDate = '".date("Y-m-d", $startdate)."'";
					// $result = mysql_query($validate) or die(mysql_error());
					// $num = mysql_num_rows($result);
					// if($num == 0)
					// {
						// $import="INSERT into temp_login_history(UserID,LoginTime,LoginDate,Status,DateAdded) values('$EmpID','$data[2]','".date("Y-m-d", $startdate)."','Present','".date("Y-m-d", $startdate)."')";
						// mysql_query($import) or die(mysql_error());
						
						// $import="INSERT into temp_logout_history(UserID,LogoutTime,LogoutDate,DateAdded) values('$EmpID','$data[3]','".date("Y-m-d", $startdate)."','".date("Y-m-d", $startdate)."')";
						// mysql_query($import) or die(mysql_error());
					// }
					
					
					// $query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					// mysql_query ($query2) or die(mysql_error()); 
					
					// $query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					// mysql_query ($query2) or die(mysql_error()); 
					
					// $query="INSERT INTO roster_login_history(UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM temp_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					// mysql_query ($query) or die(mysql_error());
					
					// $query="INSERT INTO roster_logout_history(UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded FROM temp_logout_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					// mysql_query ($query) or die(mysql_error());
					
					// $query="TRUNCATE TABLE temp_login_history";
					// mysql_query ($query) or die(mysql_error());
					
					// $query="TRUNCATE TABLE temp_logout_history";
					// mysql_query ($query) or die(mysql_error());
					
					
					
					
					
					
					$validate="SELECT ID from temp_login_history WHERE ID <> 0 AND UserID = '".$EmpID."' AND LoginDate = '".date("Y-m-d", $startdate)."'";
					$result = mysql_query($validate) or die(mysql_error());
					$num = mysql_num_rows($result);
					if($num == 0)
					{
						$import="INSERT into temp_login_history(UserID,".($data[2] == '' ? '' : 'LoginTime,')."LoginDate,Status,DateAdded) values('$EmpID',".($data[2] == '' ? '' : '\''.$data[2].'\',')."'".date("Y-m-d", $startdate)."','".manualAttStatus($data[4])."','".date("Y-m-d", $startdate)."')";
						mysql_query($import) or die(mysql_error());
						
						$import="INSERT into temp_logout_history(UserID,".($data[3] == '' ? '' : 'LogoutTime,')."LogoutDate,DateAdded) values('$EmpID',".($data[3] == '' ? '' : '\''.$data[3].'\',')."'".date("Y-m-d", $startdate)."','".date("Y-m-d", $startdate)."')";
						mysql_query($import) or die(mysql_error());
					}
					
					
					$query2="DELETE FROM roster_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query ($query2) or die(mysql_error()); 
					
					$query2="DELETE FROM roster_logout_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query ($query2) or die(mysql_error()); 
					
					$query="INSERT INTO roster_login_history(UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded) SELECT UserID, LoginTime, MLoginTime, LoginDate, Status, MStatus, DateAdded FROM temp_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query ($query) or die(mysql_error());
					
					$query="INSERT INTO roster_logout_history(UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded) SELECT UserID, LogoutTime, MLogoutTime, LogoutDate, DateAdded FROM temp_logout_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query ($query) or die(mysql_error());
					
					$query="TRUNCATE TABLE temp_login_history";
					mysql_query ($query) or die(mysql_error());
					
					$query="TRUNCATE TABLE temp_logout_history";
					mysql_query ($query) or die(mysql_error());
					
					$query2="SELECT ID,LoginTime FROM roster_login_history WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					$result2 = mysql_query ($query2) or die(mysql_error()); 
					$num2 = mysql_num_rows($result2);
					$row2 = mysql_fetch_array($result2);
					
					if($num2 == 0)
					{
						if($row['LeavesDays'] != "")
						{
						$LeaveDays = explode(',',$row['LeavesDays']);
						}
						
						$query3="SELECT ID FROM minus_leaves_quota WHERE EmpID='" . (int)$EmpID . "' AND LeaveDate = '".date("Y-m-d", $startdate)."'";
						$result3 = mysql_query ($query3) or die(mysql_error()); 
						$num3 = mysql_num_rows($result3);
						
						if ($num3 != 0)
						{
						$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "',
							Status = 'Leave'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
						mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Full day On" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
						$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$EmpID  . "',
						Status = 'Absent',MStatus = '".$Reason."'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
						mysql_query($query3) or die (mysql_error());
						}
						else if (in_array(''.date("N", $startdate).'', $LeaveDays))
						{
						$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "',
							Status = 'Off Day'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
						mysql_query($query3) or die (mysql_error());
						}
						else if ($What == "Full day Off" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
						{
						$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "',
							Status = 'Off Day',MStatus = '".$Reason."'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
						mysql_query($query3) or die (mysql_error());
						}
						else
						{
						$query3="INSERT INTO roster_login_history SET LoginDate='".date("Y-m-d", $startdate)."' , DateAdded='".date("Y-m-d", $startdate)."',
						UserID = '" . (int)$EmpID  . "',
						Status = 'Absent'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
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
								$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Allow Late Arrival" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
								$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								
								if ($row2['LoginTime'] != null)
								{
									if ($row2['LoginTime'] > $ArrivalHalfDay)
									{
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
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
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									}
									else if ($row2['LoginTime'] > $LateArrival)
									{
									$query3="UPDATE roster_login_history SET Late = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
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
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									}
								}
							}
						}
						
					}
					// Arrival End
					$query2="SELECT ID,LogoutTime FROM roster_logout_history WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					$result2 = mysql_query ($query2) or die(mysql_error()); 
					$num2 = mysql_num_rows($result2);
					$row2 = mysql_fetch_array($result2);
					
					if($num2 == 0)
					{
						
						$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						mysql_query($query3) or die (mysql_error());
						
						$query3="INSERT INTO roster_logout_history SET DateAdded='".date("Y-m-d", $startdate)."',
							UserID = '" . (int)$EmpID  . "'";
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
								$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
							}
							else if ($What == "Allow Early Departure" && (in_array(''.$row['CompanyID'].'', $CompID) || in_array(''.$row['Location'].'', $LocID)))
							{
								$query3="UPDATE roster_login_history SET MStatus = '".$Reason."' WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
								mysql_query($query3) or die (mysql_error());
								
								if ($row2['LogoutTime'] != null)
								{
									if ($row2['LogoutTime'] < $DepartHalfDay)
									{
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
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
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									}
									else if ($row2['LogoutTime'] < $EarlyDepart)
									{
									$query3="UPDATE roster_login_history SET EarlyDep = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
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
									$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
									mysql_query($query3) or die (mysql_error());
									}
								}
							}
							//this is new code from
							
							$querytemp="SELECT li.LoginTime,lo.LogoutTime FROM roster_logout_history lo LEFT JOIN roster_login_history li ON (lo.DateAdded = li.DateAdded AND lo.UserID = li.UserID)
							WHERE lo.UserID='" . (int)$EmpID  . "' AND lo.DateAdded = '".date("Y-m-d", $startdate)."' AND li.Status = 'Present'";
							$resulttemp = mysql_query($querytemp) or die (mysql_error());
							$numtemp = mysql_num_rows($resulttemp);
							$rowtemp = mysql_fetch_array($resulttemp);
							
							if ($rowtemp['LoginTime'] != null AND $rowtemp['LogoutTime'] == null)
							{
								$query3="UPDATE roster_login_history SET HalfDay = 1 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
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
						Status = 'Off Day', EarlyDep = 0, Late = 0, HalfDay = 0 WHERE UserID='" . (int)$EmpID  . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
						mysql_query($query3) or die (mysql_error());
						}
						
					$query3="UPDATE roster_login_history SET ScheduleArrival = '".$row['ArrivalTime']."',ScheduleDepart = '".$row['DepartTime']."',LateArrival = '".$row['LateArrival']."',EarlyDepart = '".$row['EarlyDepart']."',LastModified = ".$_SESSION['UserID'].",Updated=1,DateModified=NOW() WHERE UserID='" . (int)$EmpID . "' AND DateAdded = '".date("Y-m-d", $startdate)."'";
					mysql_query($query3) or die (mysql_error());
				
				}
				
				//-------------------------------------------------------------------
		}
    }
    fclose($handle);
	
    $_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Attendance has been Uploaded.</b>
		</div>';
	}
	else
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Attendance Not Uploaded.</b>
		</div>';
	}

		redirect("ManualAttendanceCSV.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Add Bulk Manual Attendance</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<style>
#footer {
	width:100%;
	height:50px;
	background-color:#3c8dbc;
	text-align:center;
	vertical-align:center;
	padding-top:15px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body class="skin-blue attendance-pg-wrap">
<!-- header logo: style can be found in header.less -->
<?php
		include_once("Header.php");
		?>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
	include_once("Sidebar.php");
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Add Bulk Manual Attendance</h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Add Bulk Manual Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Dashboard.php'">Cancel</button>
            </div>
              <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
        <div class="col-md-12">
          <div class="box">
            
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
             
              <!-- form start -->
              <div class="box-body">
				<input type="hidden" name="action" value="submit_form" />
				
				<div class="form-group">
                  <label id="labelimp" for="Attendance" class="labelimp" >Upload (CSV): </label>
                  <input type="file" id="Attendance" name="flPage" />
                </div>
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
             
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		</div>
      </section>
    </form>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>




<!-- ./wrapper -->
<?php include_once("Footer.php"); ?>
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
</body>
</html>
