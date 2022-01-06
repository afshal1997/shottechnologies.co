<?php
include_once("Common.php");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
{}else{redirect("index.php");}


	$msg = "";
	$UserID=0;
	$Photo="";
	
	$ToHour=date("G");
	$d=strtotime("+5 Hours");		
	$ToHour=date("G", $d);
	
	$ToDate=date("l jS F Y");
	$d=strtotime("+5 Hours");		
	$ToDate=date("l jS F Y", $d);
	$ToDateFormated=date("Y-m-d", $d);
	
	$query="SELECT e.ID,s.DayNight FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = ".(int)$_SESSION["UserID"]."";
	$res = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($res);
	
	if($row['DayNight'] == 1)
	{
	    if($ToHour < 15)
    	{
    	$d=strtotime("-19 Hours");		
    	$ToDate=date("l jS F Y", $d);
    	$ToDateFormated=date("Y-m-d", $d);
    	}
	}
	

    $query="SELECT DATE_FORMAT(LoginTime, '%r') AS LoginTime,DATE_FORMAT(LoginDate, '%a %D %b %Y') AS LoginDate FROM user_login_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
	$res = mysql_query($query) or die(mysql_error());
	$num1 = mysql_num_rows($res);
	if($num1 == 1)
	{
	$row = mysql_fetch_array($res);
	$LoginTimeFormat = $row['LoginTime'].' - '.$row['LoginDate'];
	}
	else
	{
	$LoginTimeFormat = 'Not Punched';
	}
	
	$query="SELECT DATE_FORMAT(LogoutTime, '%r') AS LogoutTime,DATE_FORMAT(LogoutDate, '%a %D %b %Y') AS LogoutDate FROM user_logout_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
	$res = mysql_query($query) or die(mysql_error());
	$num2 = mysql_num_rows($res);
	if($num2 == 1)
	{
	$row = mysql_fetch_array($res);
	$LogoutTimeFormat = $row['LogoutTime'].' - '.$row['LogoutDate'];
	}
	else
	{
	$LogoutTimeFormat = 'Not Punched';
	}
	                
	
	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{
		$UserID=trim($_SESSION['UserID']);
			
		if ($UserID==0)
			$msg = "User Fon Found";
			
		if($msg=='')
		{	
					
					$rows = mysql_query("SELECT UserID FROM user_login_history WHERE ActualDate = '".$ToDateFormated."' AND UserID = '".(int)$UserID."'");
					$num = mysql_num_rows($rows);
					
					if($num == 0)
					{
						mysql_query("INSERT INTO user_login_history SET UserID = '".(int)$UserID."',Status = 'Present', LoginTime=(NOW() + INTERVAL 5 HOUR), LoginDate=(NOW() + INTERVAL 5 HOUR),DateAdded=(NOW() + INTERVAL 5 HOUR),ActualDate='".$ToDateFormated."'") or die(mysql_error());
					}
					else
					{
					$rows2 = mysql_query("SELECT UserID FROM user_logout_history WHERE ActualDate = '".$ToDateFormated."' AND UserID = '".(int)$UserID."'");
					$num2 = mysql_num_rows($rows2);
					//echo $num;
					//exit();
					if($num2 == 0)
						mysql_query("INSERT INTO user_logout_history SET UserID = '".(int)$UserID."', LogoutTime=(NOW() + INTERVAL 5 HOUR), LogoutDate=(NOW() + INTERVAL 5 HOUR),DateAdded=(NOW() + INTERVAL 5 HOUR),ActualDate = '".$ToDateFormated."'") or die(mysql_error());
					else
						mysql_query("UPDATE user_logout_history SET  LogoutTime=(NOW() + INTERVAL 5 HOUR),LogoutDate=(NOW() + INTERVAL 5 HOUR),DateAdded=(NOW() + INTERVAL 5 HOUR) WHERE UserID = '".(int)$UserID."' AND ActualDate = '".$ToDateFormated."'") or die(mysql_error());
					}
					// $_SESSION['Photoz'] = '<img id="picmsg" src="'.(is_file(DIR_EMPLOYEEPHOTOES . $Photo) ? DIR_EMPLOYEEPHOTOES.$Photo : 'images/avatar.png').'" class="placeholder-img">';
					//$_SESSION['ThankYou'] = '<span id="thankxmsg" style="margin-top:-5px">&nbsp;Thank You</span>';
					$_SESSION['Audio'] = '<audio autoplay>
											  <source src="images/thankyou.mp3" type="audio/mpeg">
											  <source src="images/thankyou.ogg" type="audio/ogg">
											</audio>';
					mysql_close($dbh);
					redirect("GetAttendanceLatest.php");
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shot Technologies</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="timemachineLatest/images/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="timemachineLatest/css/style.css" />
<link rel="stylesheet" href="timemachineLatest/css/responsive.css" />

</head>

<body>
	
	<div class="pg-top">
		<div class="container">
			<div class="header-row">
				<div class="logo">
					<a href="https://hrms.shottechnologies.co/">
						<img src="timemachineLatest/images/logo.png" alt="logo" class="img-fluid">
					</a>
				</div>
				<div class="user">
					<div class="img">
						<img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION['Photo'] : 'images/avatar.png');  ?>" alt="user" class="img-fluid">
					</div>
					<div class="desc">
						<p class="name"><?php echo $_SESSION['UserFullName']; ?></p>
						<p class="desig"><?php echo $_SESSION['MyDesignation']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main-sec">
		<div class="container">
			<div class="main-row">
				<div class="can-col">
					<div class="clock-wrap">
						<div id="myclock"></div>
					</div>
				</div>
				<div class="form-col">
					<div class="form-wrap">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<input type="hidden" name="action" value="submit_form">
							<p class="heading"><span>Online</span>
							Attendance System</p>
							<div class="form-row">
								<div class="input-col">
									<input type="number" placeholder="Enter Your ID" value="<?php echo str_pad($_SESSION['UserID'],5,"0",STR_PAD_LEFT); ?>" disabled>
								</div>
								<div class="btn-col">
									<input type="submit" class="c-btn g-btn" value="PRESS TIME IN" <?php echo ($num1 == 1 ? 'disabled' : ''); ?>>
									<!-- <button type="submit" class="c-btn g-btn">PRESS TIME IN</button> -->
								</div>
								<div class="btn-col">
									<input type="submit" class="c-btn r-btn" value="PRESS TIME OUT" <?php echo ($num1 == 0 ? 'disabled' : ''); ?>>
									<!-- <button type="submit" class="c-btn r-btn">PRESS TIME OUT</button> -->
								</div>
							</div>
						</form>
						<div class="attendance-det">
							<p class="heading">Today’s Attendance Details</p>
							<ul>
								<li><img src="timemachineLatest/images/icon-1.png" class="img-fluid" alt="icon"><span>Attendance Date:</span> <?php echo $ToDate; ?></li>
								<li><img src="timemachineLatest/images/icon-2.png" class="img-fluid" alt="icon"><span>Time in:</span> <?php echo $LoginTimeFormat; ?></li>
								<li><img src="timemachineLatest/images/icon-3.png" class="img-fluid" alt="icon"><span>Time out:</span> <?php echo $LogoutTimeFormat; ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
if(isset($_SESSION['Audio']))
{
	echo $_SESSION['Audio'];
	unset($_SESSION['Audio']);
}
?>

<script src="timemachineLatest/js/jquery-3.3.1.min.js"></script>
<script src="timemachineLatest/js/jquery.thooClock.js"></script>
<script src="timemachineLatest/js/custom.js"></script> 


</body>
</html>