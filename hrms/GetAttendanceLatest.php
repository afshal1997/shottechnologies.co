<?php
include_once("Common.php");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
{}else{redirect("index.php");}

    $query_q1="SELECT Quote,Author FROM quotes WHERE Quote_type = 2 ORDER BY RAND() Limit 1";
    $res_q1 = mysql_query($query_q1) or die(mysql_error());
    $row_q1 = mysql_fetch_array($res_q1);

    $query_q2="SELECT Quote,Author FROM quotes WHERE Quote_type = 1 ORDER BY RAND() Limit 1";
    $res_q2 = mysql_query($query_q2) or die(mysql_error());
    $row_q2 = mysql_fetch_array($res_q2);
    
    $query_q3="SELECT * FROM news WHERE News_type = 'techcrunch'";
    $res_q3 = mysql_query($query_q3) or die(mysql_error());
    //$row_q3 = mysql_fetch_assoc($res_q3);
    
    $query_q4="SELECT * FROM news WHERE News_type = 'nytimes'";
    $res_q4 = mysql_query($query_q4) or die(mysql_error());
    
    $query_q5="SELECT * FROM news WHERE News_type = 'abcnews'";
    $res_q5 = mysql_query($query_q5) or die(mysql_error());
    
    $query_q6="SELECT * FROM twitter WHERE 1";
    $res_q6 = mysql_query($query_q6) or die(mysql_error());
    
    $query_q7="SELECT * FROM news WHERE News_type = 'mashable'";
    $res_q7 = mysql_query($query_q7) or die(mysql_error());

    $ArrivalTime = "";
    $DepartTime = "";
    $LateArrival = "";
    $ArrivalHalfDay = "";
    $DepartHalfDay = "";
    $EarlyDepart = "";
    $ArrivalTimeSchedule = "";
    $DepartTimeSchedule = "";

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
    
    $query="SELECT e.ID,s.DayNight,s.LateArrival,s.ArrivalHalfDay,s.DepartHalfDay,s.EarlyDepart,DATE_FORMAT(STR_TO_DATE(s.ArrivalTime, '%H:%i:%s'), '%r') AS ArrivalTimeSchedule,DATE_FORMAT(STR_TO_DATE(s.DepartTime, '%H:%i:%s'), '%r') AS DepartTimeSchedule FROM employees e LEFT JOIN schedules s ON e.ScheduleID = s.ID WHERE e.ID = ".(int)$_SESSION["UserID"]."";
    $res = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($res);

    $LateArrival = $row['LateArrival'];
    $ArrivalHalfDay = $row['ArrivalHalfDay'];
    $DepartHalfDay = $row['DepartHalfDay'];
    $EarlyDepart = $row['EarlyDepart'];
    $ArrivalTimeSchedule = $row['ArrivalTimeSchedule'];
    $DepartTimeSchedule = $row['DepartTimeSchedule'];
    
    if($row['DayNight'] == 1)
    {
        if($ToHour < 15)
        {
        $d=strtotime("-19 Hours");      
        $ToDate=date("l jS F Y", $d);
        $ToDateFormated=date("Y-m-d", $d);
        }
    }
    

    $query="SELECT DATE_FORMAT(LoginTime, '%T') AS ArrivalTime,DATE_FORMAT(LoginTime, '%r') AS LoginTime,DATE_FORMAT(LoginDate, '%a %D %b %Y') AS LoginDate FROM user_login_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
    $res = mysql_query($query) or die(mysql_error());
    $num1 = mysql_num_rows($res);
    if($num1 == 1)
    {
    $row = mysql_fetch_array($res);
    $LoginTimeFormat = $row['LoginTime'].' - '.$row['LoginDate'];
    $ArrivalTime = $row['ArrivalTime'];
    }
    else
    {
    $LoginTimeFormat = 'Not Punched';
    }
    
    $query="SELECT DATE_FORMAT(LogoutTime, '%T') AS DepartTime,DATE_FORMAT(LogoutTime, '%r') AS LogoutTime,DATE_FORMAT(LogoutDate, '%a %D %b %Y') AS LogoutDate FROM user_logout_history WHERE UserID = ".(int)$_SESSION["UserID"]." AND ActualDate = '".$ToDateFormated."'";
    $res = mysql_query($query) or die(mysql_error());
    $num2 = mysql_num_rows($res);
    if($num2 == 1)
    {
    $row = mysql_fetch_array($res);
    $LogoutTimeFormat = $row['LogoutTime'].' - '.$row['LogoutDate'];
    $DepartTime = $row['DepartTime'];
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

      $attStatus = '';
      $attStatusLateIn = 0;
      $attStatusArrHalf = 0;
      $attStatusEarlyOut = 0;
      $attStatusDepHalf = 0;
      if($ArrivalTime <> '' && $ArrivalTime > $LateArrival){
        $attStatusLateIn = 1;
      }
      if($ArrivalTime <> '' && $ArrivalTime > $ArrivalHalfDay){
        $attStatusArrHalf = 1;
      }
      if($DepartTime <> '' && $DepartTime < $EarlyDepart){
        $attStatusEarlyOut = 1;
      }
      if($DepartTime <> '' && $DepartTime < $DepartHalfDay){
        $attStatusDepHalf = 1;
      }

      if($attStatusLateIn == 1 && $attStatusDepHalf == 1)
      {
        $attStatus = 'Late-In/Half Day';
      }
      else if($attStatusLateIn == 1 && $attStatusEarlyOut == 1)
      {
        $attStatus = 'Late-In/Early Out';
      }
      else if($attStatusLateIn == 1)
      {
        $attStatus = 'Late-In';
      }
      else if($attStatusArrHalf == 1 && $attStatusDepHalf == 1)
      {
        $attStatus = 'Half Day';
      }
      else if($attStatusArrHalf == 1 && $attStatusEarlyOut == 1)
      {
        $attStatus = 'Half Day/Early Out';
      }
      else if($attStatusEarlyOut == 1)
      {
        $attStatus = 'Early Out';
      }
      else if($attStatusArrHalf == 1)
      {
        $attStatus = 'Half Day';
      }
      else if($attStatusDepHalf == 1)
      {
        $attStatus = 'Half Day';
      }
      else if($row["Date"] > $PrintDate)
      {
        $attStatus = 'Half Day';
      }
      else
      {
        $attStatus = 'On-Time';
      }

      if($ArrivalTime == '' && $DepartTime == ''){
        $attStatus = 'Status';
      }

      if($DepartTime == '')
      {
        $totaltime = "0 hours 0 minutes";
      }
      else
      {
        list($hours, $minutes) = explode(':', $ArrivalTime);
        $startTimestamp = mktime($hours, $minutes);

        list($hours, $minutes) = explode(':', $DepartTime);
        $endTimestamp = mktime($hours, $minutes);
        
        $newTimestamp1 = mktime(00, 00);
        $newTimestamp2 = mktime(23, 59);
        
        if($endTimestamp < $startTimestamp)
        {
             $seconds2=0;
             $seconds =  $endTimestamp - $newTimestamp1;
             $seconds2 =  $newTimestamp2 - $startTimestamp;
             $seconds2 = abs($seconds2);
             $seconds = $seconds + $seconds2;
             $seconds += 60;
        }
        else
        {
            $seconds = $endTimestamp - $startTimestamp;
        }
        
        $minutes = ($seconds / 60) % 60;
        $hours = floor($seconds / (60 * 60));

        $totaltime = "$hours hours $minutes minutes";  
      }
      
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Hrms-360</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="refresh" content="300">
<link rel="icon" href="timemachineLatest/images/fev-icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="timemachineLatest/css/style.css" />
<link rel="stylesheet" href="timemachineLatest/css/responsive.css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .desc p a {color:#373737;text-decoration:none;}
    .trends-item p a {color:#03a9f4;text-decoration:none;}
    .twitter-title {color:#03a9f4;}
    .no-print {color: #ffffff;}
</style>
</head>

<body>
    <a class="no-print" title="" target="_blank"><div style="width:50px;height:50px;border-radius:0 5px 5px 0;position:fixed;top:280px;left:0px;background-color:black;z-index:9999999999999;font-size: 25px;display: flex;justify-content: center;align-items: center;color: #fff;"><i class="fa fa-comments-o" aria-hidden="true"></i></a>
</div>
    <marquee width="100%" direction="left" height="35px" style="padding: 10px 0">
<strong>Hadith of the Day</strong> “<?php echo $row_q1['Quote'] ?>” <i style="color: #0b48c5"><?php echo $row_q1['Author'] ?></i> &emsp;&emsp;&emsp;&emsp;&emsp;
<strong>Quote of the Day</strong> “<?php echo $row_q2['Quote'] ?>” <i style="color: #0b48c5"><?php echo $row_q2['Author'] ?></i>
</marquee>
	<!--<input type="hidden" id="server_date" value="<?= date("Y-m-d H:i:s") ?>">-->
	<div class="pg-top">
		<div class="container">
			<div class="header-row">
				<div class="col-lg-9">
				    <div class="logo">
					<a href="http://hrms.myprojectstaging.com/Dashboard.php">
						<img src="timemachineLatest/images/logo.png" alt="logo" class="img-fluid">
					</a>
				    </div>
				</div>
				<div class="col-lg-3">
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
	</div>

	<div class="main-sec">
		<div class="container">
			<div class="row">
				<div class="can-col col-lg-6">
					<div class="clock-wrap">
						<div class="clock-box">
						    <p class="clock-title">EST Time</p>
						    <div id="pstTime"></div>
						</div>
						<div class="clock-box">
						    <p class="clock-title">System Time</p>
						    <div id="systemTime"></div>
						</div>
					</div>
				</div>
				<div class="form-col col-lg-6">
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
                                <li><img src="timemachineLatest/images/icon-2.png" class="img-fluid" alt="icon"><span>Shift Timing:</span> <?php echo $ArrivalTimeSchedule.' - '.$DepartTimeSchedule; ?></li>
								<li><img src="timemachineLatest/images/icon-1.png" class="img-fluid" alt="icon"><span>Attendance Date:</span> <?php echo $ToDate; ?></li>
								<li><img src="timemachineLatest/images/icon-2.png" class="img-fluid" alt="icon"><span>Time In:</span> <?php echo $LoginTimeFormat; ?> <span class="attendace-status">(<?php echo $attStatus; ?>)</span></li>
								<li><img src="timemachineLatest/images/icon-3.png" class="img-fluid" alt="icon"><span>Time Out:</span> <?php echo $LogoutTimeFormat; ?></li>
								<li><img src="timemachineLatest/images/icon-4.png" class="img-fluid" alt="icon"><span>Total Shift Time:</span> <?php echo $totaltime; ?></li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="cta-btns">
        <!--<a href="#!">-->
        <!--    <img src="timemachineLatest/images/twitter.png" class="img-fluid">-->
        <!--    <span>Twitter <br>Trending</span>-->
        <!--</a>-->
        <!--    <img src="timemachineLatest/images/weather.png" class="img-fluid">-->
        <!--    <span>Weather <br>Forcast</span>-->
        <!--</a>-->
    </div>

    <div class="quote-box-wrap">
        <div class="quote-box-inner">
            <div class="icon">
                <img src="timemachineLatest/images/quote-icon.png" class="img-fluid">
            </div>
            <div class="text-box">
                <p class="title">Happy Mother Day’s</p>
                <p class="quote">“The influence of a mother in the lives of her children is beyond calculation.”</p>
                <p class="name">James E. Faust</p>
            </div>
        </div>
    </div>
    <div class="container" style="max-width: 1100px;">
        <p class="twitter-title"><img src="timemachineLatest/images/twitter.png" class="img-fluid" alt="icon">Twitter Trends</p>
        <!--<marquee class="trends-wrap" width="100%" direction="left" height="100%" style="padding: 10px 0">-->
        <div class="trends-row">
            <?php while($row = mysql_fetch_array($res_q6)){ ?>
            <div class="trends-item">
                <p class="t-name"><a href="<?php echo $row['Tweet_url']; ?>" target="_blank"><?php echo $row['Tweet']; ?></a></p>
                <p><?php echo $row['Tweet_count']; ?> tweets</p>
            </div>
            <?php } ?>
        </div>
    <!--</marquee>-->
    </div>
    
    <div class="newsfeed-wrap">
        <div class="newsfeed-bar">
            <div class="heading"><img src="timemachineLatest/images/tc-logo.png" class="img-fluid"></div>
            <?php while($row = mysql_fetch_array($res_q3)){ ?>
            <div class="newsfeed-item">
                <div class="n-img">
                    <a href="<?php echo $row['page_url']; ?>" target="_blank"><img src="<?php echo $row['image_url']; ?>" class="img-fluid"></a>
                </div>
                <div class="desc">
                    <p class="s-text">By <?php echo $row['author']; ?></p>
                    <p class="b-text"><a href="<?php echo $row['page_url']; ?>" target="_blank"><?php echo $row['title']; ?></a></p>
                    <p class="s-text"><?php echo date('d M Y h:i:s', strtotime($row['publishedAt'])); ?></p>
                </div>
            </div>
            <?php } ?>
            <!--<div class="heading"><img src="timemachineLatest/images/mashable-logo.png" class="img-fluid"></div>-->
            <?php //while($row = mysql_fetch_array($res_q7)){ ?>
            <!--<div class="newsfeed-item">-->
            <!--    <div class="n-img">-->
            <!--        <a href="<?php //echo $row['page_url']; ?>" target="_blank"><img src="<?php //echo $row['image_url']; ?>" class="img-fluid"></a>-->
            <!--    </div>-->
            <!--    <div class="desc">-->
            <!--        <p class="s-text">By <?php //echo $row['author']; ?></p>-->
            <!--        <p class="b-text"><a href="<?php //echo $row['page_url']; ?>" target="_blank"><?php //echo $row['title']; ?></a></p>-->
            <!--        <p class="s-text"><?php //echo date('d M Y h:i:s', strtotime($row['publishedAt'])); ?></p>-->
            <!--    </div>-->
            <!--</div>-->
            <?php //} ?>
            <div class="heading"><img src="timemachineLatest/images/nyt-logo.png" class="img-fluid"></div>
            <?php while($row = mysql_fetch_array($res_q4)){ ?>
            <div class="newsfeed-item">
                <div class="n-img">
                    <a href="<?php echo $row['page_url']; ?>" target="_blank"><img src="<?php echo $row['image_url']; ?>" class="img-fluid"></a>
                </div>
                <div class="desc">
                    <p class="s-text"><?php echo $row['author']; ?></p>
                    <p class="b-text"><a href="<?php echo $row['page_url']; ?>" target="_blank"><?php echo $row['title']; ?></a></p>
                    <p class="s-text"><?php echo date('d M Y h:i:s', strtotime($row['publishedAt'])); ?></p>
                </div>
            </div>
            <?php } ?>
            <div class="heading"><img src="timemachineLatest/images/aus-logo.png" class="img-fluid"></div>
            <?php while($row = mysql_fetch_array($res_q5)){ ?>
            <div class="newsfeed-item">
                <div class="n-img">
                    <a href="<?php echo $row['page_url']; ?>" target="_blank"><img src="<?php echo $row['image_url']; ?>" class="img-fluid"></a>
                </div>
                <div class="desc">
                    <p class="s-text">By <?php echo $row['author']; ?></p>
                    <p class="b-text"><a href="<?php echo $row['page_url']; ?>" target="_blank"><?php echo $row['title']; ?></a></p>
                    <p class="s-text"><?php echo date('d M Y h:i:s', strtotime($row['publishedAt'])); ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <button id="newsbar-toggle">VIEW NEWS</button>
    
<style>
    /*.clock-wrap canvas {*/
    /*    max-width: 100% !important;*/
    /*    width: 100% !important;*/
    /*}*/
    /*.clock-wrap {*/
    /*    text-align: center;*/
    /*    width: 100%;*/
    /*    display: flex;*/
    /*    flex-wrap: wrap;*/
    /*    justify-content: space-between;*/
    /*}*/
    /*.clock-wrap .clock-box {*/
    /*    width: calc(50% - 30px);*/
    /*}*/
    /*.main-row .can-col{*/
    /*    display: flex;*/
    /*}*/
    /*.clock-wrap {*/
    /*    align-items: center;*/
    /*}*/
    /*.clock-box .clock-title{*/
    /*    color: #373737;*/
    /*    font-size: 22px;*/
    /*    font-weight: 700;*/
    /*    line-height: 1.1;*/
    /*    text-align: center;*/
    /*    margin-bottom: 20px;*/
    /*}*/
    /*.clock-box .clock-title {*/
    /*    font-size: 22px;*/
    /*}*/
</style>

<?php 
if(isset($_SESSION['Audio']))
{
	echo $_SESSION['Audio'];
	unset($_SESSION['Audio']);
}
?>

<script src="timemachineLatest/js/jquery-3.3.1.min.js"></script>

<script src="timemachineLatest/js/jquery.thooClock.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script> 
 
 <script>
    $('#pstTime').thookClock({
        timeCorrection: {
          operator:'+',
          hours: 0,
          minutes: 0
        },
        secondHandColor:'#0b48c5',
    });
    $('#systemTime').thooClock({
        timeCorrection: {
          operator:'+',
          hours: 0,
          minutes: 0
        },
        secondHandColor:'#0b48c5',
    });    
 </script>
    
 <script>
    $("#newsbar-toggle").click(function(){
        $(this).toggleClass("active");
        $(".newsfeed-wrap").toggleClass("open");
    });
 </script>
 
 <script>
     VanillaTilt.init(document.querySelector(".clock-wrap"), {
			max: 15,
			speed: 400,
			glare: true,
			"max-glare": 0.2,
		});
 </script>
 
</body>
</html>

