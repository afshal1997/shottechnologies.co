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
	
	$ToDate=date("jS M Y");
	$d=strtotime("+5 Hours");		
	$ToDate=date("jS M Y", $d);
	$ToDateFormated=date("Y-m-d", $d);
	
	$query="SELECT e.ID,s.DayNight FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = ".(int)$_SESSION["UserID"]."";
	$res = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($res);
	
	if($row['DayNight'] == 1)
	{
	    if($ToHour < 15)
    	{
    	$d=strtotime("-19 Hours");		
    	$ToDate=date("jS M Y", $d);
    	$ToDateFormated=date("Y-m-d", $d);
    	}
	}
	

    $query="SELECT DATE_FORMAT(LoginTime, '%r') AS LoginTime FROM user_login_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
	$res = mysql_query($query) or die(mysql_error());
	$num1 = mysql_num_rows($res);
	if($num1 == 1)
	{
	$row = mysql_fetch_array($res);
	$LoginTimeFormat = $row['LoginTime'];
	}
	else
	{
	$LoginTimeFormat = 'Not Punched';
	}
	
	$query="SELECT DATE_FORMAT(LogoutTime, '%r') AS LogoutTime FROM user_logout_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
	$res = mysql_query($query) or die(mysql_error());
	$num2 = mysql_num_rows($res);
	if($num2 == 1)
	{
	$row = mysql_fetch_array($res);
	$LogoutTimeFormat = $row['LogoutTime'];
	}
	else
	{
	$LogoutTimeFormat = 'Not Punched';
	}
	                
	
	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{
		if(isset($_POST["UserID"]))
			$UserID=trim($_POST["UserID"]);
		if(isset($_POST["Photo"]))
			$Photo=trim($_POST["Photo"]);
			
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
					$_SESSION['Photoz'] = '<img id="picmsg" src="'.(is_file(DIR_EMPLOYEEPHOTOES . $Photo) ? DIR_EMPLOYEEPHOTOES.$Photo : 'images/avatar.png').'" class="placeholder-img">';
					//$_SESSION['ThankYou'] = '<span id="thankxmsg" style="margin-top:-5px">&nbsp;Thank You</span>';
					$_SESSION['Audio'] = '<audio autoplay>
											  <source src="images/thankyou.mp3" type="audio/mpeg">
											  <source src="images/thankyou.ogg" type="audio/ogg">
											</audio>';
					mysql_close($dbh);
					redirect("GetAttendanceNew.php");
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shot Technologies</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="timemachine/images/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="timemachine/css/style.css" />
<link rel="stylesheet" href="timemachine/css/responsive.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
		
		$("#EMPID").keyup(function () {
			
			$.ajax({			
					url: 'get_emp_attendance_bio_new.php?empid='+$("#EMPID").val(),
					success: function(data) {
						$("#bio").html(data);
					},
					error: function (xhr, textStatus, errorThrown) {
						alert(xhr.responseText);
						$("#bio").removeAttr("disabled");
					}
			});

		});		
		
		
	});   

</script>
<script>
$(document).ready(function(){ 
		
		$("#EMPID").keyup(function () {
			
			$.ajax({			
					url: 'get_emp_attendance_btn_new.php?empid='+$("#EMPID").val(),
					success: function(data) {
						$("#atn-btn").html(data);
					},
					error: function (xhr, textStatus, errorThrown) {
						alert(xhr.responseText);
						$("#atn-btn").removeAttr("disabled");
					}
			});

		});		
		
		
	});   

</script>
<script type="text/javascript">
//jQuery(document).ready(function(){	
//	$("#thankxmsg").slideUp(3000);	
//});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){	
	//$("#picmsg").slideUp(3000);
	$("#picmsg").fadeOut(5000);
});
</script>
<style>
    .btn-trans-sensor{
    position: absolute;
    
    width: 89px;
    height: 87px;
    top: 19px;
    left: 477px;
    background-size: 220px 251px;
    background-position: -62px -67px;
    border-radius: 10px;
    overflow: hidden;
    z-index: 1;
    background: transparent;
    cursor: pointer;
    }
</style>
</head>

<body>
	
<section class="main-sec">
	<div class="container">
		<div class="c-row">
			<div class="col-logo">
				<div class="logo-wrap">
					<a href="#!">
						<img src="timemachine/images/logo-2.png" alt="logo" class="img-fluid logo-2">
						<img src="timemachine/images/logo.png" alt="logo" class="img-fluid logo-1">
					</a>
				</div>
			</div>
			<div class="col-machine">
				<div class="machine-box">
				    
					<div class="machine-left">
						<div class="clock-box">
							<div class="clock">
								<ul>
									<li id="hours"></li>
									<!-- <li id="point">:</li> -->
									<li id="min"></li>
									<!-- <li id="point">:</li>
									<li id="sec"></li> -->
								</ul>
								<div id="Date"></div>
							</div>
						</div>
                        
                        
						<div class="emp-input">
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
								<div class="time-input">
									<input type="number" placeholder="Enter Your ID" id="EMPID">
								</div>
								<div class="btns">
									<div class="radio-btn in">
										<p>PRESS <br>TIME IN</p>
										<input type="radio" name="attendence" <?php echo ($num1 == 1 ? 'disabled' : ''); ?> value="1">
										<span class="outline"></span>
									</div>
									<div class="radio-btn out">
										<p>PRESS <br>TIME OUT</p>
										<input type="radio" name="attendence" <?php echo ($num1 == 0 ? 'disabled' : ''); ?> value="2">
										<span class="outline"></span>
									</div>
								</div>
							
							<div class="time-info">
							    <p>Date: <?php echo $ToDate; ?></p>
							    
								<p>Time in: <?php echo $LoginTimeFormat; ?></p>
								<p>Time out: <?php echo $LogoutTimeFormat; ?></p>
							</div>
							
								<span id="atn-btn">
						
						</span>
                           
					</form>
                            
                            
                            
						</div>
                        
                        
                        
                        
					</div>
					
					
					 <div class="machine-right">
					    <?php 
						if(isset($_SESSION['Photoz']))
						{
							echo $_SESSION['Photoz'];
							unset($_SESSION['Photoz']);
						}
				// 		$Photo = '2.jpg';
				// 		echo '<img id="picmsg" src="'.(is_file(DIR_EMPLOYEEPHOTOES . $Photo) ? DIR_EMPLOYEEPHOTOES.$Photo : 'images/avatar.png').'" class="placeholder-img">';
						?>
						<div class="indicator"></div>
					
						<div class="sensor">
						    <span id="bio">
						    <img src="timemachine/images/sensor-bg.png" class="sensor-img">
						    </span>
							<div class="sensor-inner">
								<div class="bar"></div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>	
</section>

 <?php 
if(isset($_SESSION['Audio']))
{
	echo $_SESSION['Audio'];
	unset($_SESSION['Audio']);
}
?>

<script src="timemachine/js/jquery-3.3.1.min.js"></script>
<script src="timemachine/js/custom.js"></script> 

</body>
</html>