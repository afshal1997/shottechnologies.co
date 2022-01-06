<?php
include_once("Common.php");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
{}else{redirect("index.php");}

	$msg = "";
	$UserID=0;
	$Photo="";
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

			
					
					
					
					$rows = mysql_query("SELECT UserID FROM user_login_history WHERE LoginDate = CURRENT_DATE() AND UserID = '".(int)$UserID."'");
					$num = mysql_num_rows($rows);
					
					if($num == 0)
					{
						mysql_query("INSERT INTO user_login_history SET UserID = '".(int)$UserID."',Status = 'Present', LoginTime=CURRENT_TIME(), LoginDate=CURRENT_DATE(),DateAdded=CURRENT_DATE()") or die(mysql_error());
					}
					else
					{
					$rows2 = mysql_query("SELECT UserID FROM user_logout_history WHERE LogoutDate = CURRENT_DATE() AND UserID = '".(int)$UserID."'");
					$num2 = mysql_num_rows($rows2);
					//echo $num;
					//exit();
					if($num2 == 0)
						mysql_query("INSERT INTO user_logout_history SET UserID = '".(int)$UserID."', LogoutTime=CURRENT_TIME(), LogoutDate=CURRENT_DATE(),DateAdded=CURRENT_DATE()") or die(mysql_error());
					else
						mysql_query("UPDATE user_logout_history SET  LogoutTime=CURRENT_TIME() WHERE UserID = '".(int)$UserID."' AND LogoutDate=CURRENT_DATE()") or die(mysql_error());
					}
					$_SESSION['Photoz'] = '<div id="picmsg" style="z-index:9999;width: 100%;height: 56%;background-color:#1C8C96;color:white;font-size:100%;margin-top:-32%">
													<img class="pull-right" src="'.(is_file(DIR_EMPLOYEEPHOTOES . $Photo) ? DIR_EMPLOYEEPHOTOES.$Photo : 'images/avatar.png').'" height="100%">
													</div>';
					$_SESSION['ThankYou'] = '<span id="thankxmsg" style="margin-top:-5px">&nbsp;Thank You</span>';
					$_SESSION['Audio'] = '<audio autoplay>
											  <source src="images/thankyou.mp3" type="audio/mpeg">
											  <source src="images/thankyou.ogg" type="audio/ogg">
											</audio>';
					mysql_close($dbh);
					redirect("GetAttendance.php");
		}
	}
?>
<!DOCTYPE html>
<html style="background-image:url('images/wall2.jpg');">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
		
		$("#EMPID").keyup(function () {
			
			$.ajax({			
					url: 'get_emp_attendance_username.php?empid='+$("#EMPID").val(),
					success: function(data) {
						$("#UserName").html(data);
					},
					error: function (xhr, textStatus, errorThrown) {
						alert(xhr.responseText);
						$("#UserName").removeAttr("disabled");
					}
			});

		});		
		
		
	});   

</script>
<script>
$(document).ready(function(){ 
		
		$("#EMPID").keyup(function () {
			
			$.ajax({			
					url: 'get_emp_attendance_bio.php?empid='+$("#EMPID").val(),
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
					url: 'get_emp_attendance_btn.php?empid='+$("#EMPID").val(),
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
<script>
$(document).ready(function(){ 
		
		$("#EMPID").keyup(function () {
			
			$.ajax({			
					url: 'get_emp_attendance_btn.php?empid='+$("#EMPID").val(),
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
<script>
// function changeArrival() {
    // var image = document.getElementById('arrivalImage');
    // if (image.src.match("uncheck")) {
        // image.src = "images/arrivaltime.png";
    // } else {
        // image.src = "images/arrivaltimeuncheck.png";
    // }
// }
</script>
 <script>
// function changeDepart() {
    // var image = document.getElementById('departImage');
    // if (image.src.match("uncheck")) {
        // image.src = "images/departtime.png";
    // } else {
        // image.src = "images/departtimeuncheck.png";
    // }
// }
 </script>
  <script>
function changeDepart() {
    var arrivalImage = document.getElementById('arrivalImage');
	var departImage = document.getElementById('departImage');
    if (departImage.src.match("uncheck")) {
        arrivalImage.src = "images/arrivaltimeuncheck.png";
		departImage.src = "images/departtime.png";
    } else {
        arrivalImage.src = "images/arrivaltime.png";
		departImage.src = "images/departtimeuncheck.png";
    }
}
 </script>
 <script>
function changeArrival() {
    var arrivalImage = document.getElementById('arrivalImage');
	var departImage = document.getElementById('departImage');
    if (arrivalImage.src.match("uncheck")) {
		arrivalImage.src = "images/arrivaltime.png";
		departImage.src = "images/departtimeuncheck.png";
    } else {
        arrivalImage.src = "images/arrivaltimeuncheck.png";
		departImage.src = "images/departtime.png";
    }
}
 </script>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$("#thankxmsg").slideUp(3000);	
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$("#picmsg").slideUp(3000);	
});
</script>
<style id="bio">
.biomatrics
{
background-image:url('images/bio5.png');width:388px;height:266px;
}
</style>
</head>
<body style="background-image:url('images/wall2.jpg');" onload="startTime()">

<div class="form-box" id="login-box">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="biomatrics">
	<img src="images/blink.gif" class="margin" style="margin-left:32%;width:13.5px;">
	
	<input type="text" id="EMPID" autocomplete="off" placeholder="Employee ID" class="pull-right margin" style="text-align:center;color:white;background-color:#666;border-radius:5px; zindex:9999; width:37%; position:relative;top:75%; border:#333 double 3px;">
	<span id="atn-btn"><div class="pull-right" style="width:10%;height:15%;background:none;border:none;margin-top: 31%;margin-right: -26%;"></div></span>
	<div class="pull-right margin" style="width: 35%;height: 29%;background-color:white;margin-top: 4%;margin-right: 7%;">
		<div style="width: 100%;height: 23%;background-color:#0C15D4;color:#999;">
		<p>&nbsp;Welcome! <span id="UserName"></span>
		<?php 
		if(isset($_SESSION['ThankYou']))
		{
			echo $_SESSION['ThankYou'];
			unset($_SESSION['ThankYou']);
		}
		?>
		</p>
		</div>
		
		<div style="z-index:0;width: 100%;height: 56%;background-color:#1C8C96;color:white;font-size:220%">
		<p id="txt"></p>
		</div>
		<?php 
		if(isset($_SESSION['Photoz']))
		{
			echo $_SESSION['Photoz'];
			unset($_SESSION['Photoz']);
		}
		?>
		
		<div style="width: 100%;height: 21%;background-color:black;color:#A9E921;">
		<p style="margin-bottom:3px">&nbsp;<?php echo date('Y-M-d'); ?><span class="pull-right"><?php echo date('D'); ?>&nbsp;</span></p>
		</div>
	</div>
	<img src="images/mirror.png" class="pull-right margin" style="position:relative;width: 35%;height: 29%;top: -36.5%;right: 46.3%;">
	<img onclick="changeDepart()" src="images/departtimeuncheck.png" id="departImage" class="margin" style="cursor:pointer;width:20%;position:relative;top: 2.5%;left: 32%;">
	<img onclick="changeArrival()" src="images/arrivaltimeuncheck.png" id="arrivalImage" class="margin" style="cursor:pointer;width:20%;position:relative;top: 2.5%;left: -16%;">
 </div>
  </form>
  <?php 
if(isset($_SESSION['Audio']))
{
	echo $_SESSION['Audio'];
	unset($_SESSION['Audio']);
}
?>
</div>
<!-- jQuery 2.0.2 -->
<script src="ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
