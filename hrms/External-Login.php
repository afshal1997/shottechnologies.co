<?php
include_once("Common.php");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
	redirect("Dashboard.php");

	$msg1 = "";
	$msg2 = "";
	$msg3 = "";
	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{
		if(isset($_POST["username"]))
			$username=trim($_POST["username"]);
		if(isset($_POST["password"]))
			$password=trim($_POST["password"]);
			
		if ($username=="")
			$msg1 = "<div class=\"error\">Please Enter Username.</div>";
		if ($password=="")
			$msg2 = "<div class=\"error\">Please Enter Password.</div>";
			
		if($msg1=='' && $msg2=='')
		{	
			$query="SELECT ID,FirstName,LastName,Photo, UserName, Password ,Role,DATE_FORMAT(JoiningDate, '%b %Y') AS Added FROM externalusers WHERE Status = 'Active' AND UserName='".dbinput($username)."'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);

			
			if($num==0 || $num > 1)
			{
				$_SESSION["Login"]=false;
				$_SESSION["IsEmployee"]=false;
				$_SESSION["UserID"]='';
				$_SESSION["Photo"]='';
				$_SESSION["UserFullName"]='';
				$_SESSION["RoleID"]='';
				$_SESSION["JoinDate"]='';
				$_SESSION["LockScreen"]=true;
				$msg3 = "<div class=\"error\">Invalid Username/Password.</div>";
				
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if(dboutput($row["Password"]) == $password)
				{
					$_SESSION["Login"]=true;
					$_SESSION["IsEmployee"]=false;
					$_SESSION["UserID"]=dboutput($row["ID"]);
					$_SESSION["Photo"]=dboutput($row["Photo"]);
					$_SESSION["UserFullName"]=dboutput($row["FirstName"]) .' '. dboutput($row["LastName"]);
					$_SESSION["RoleID"]=dboutput($row["Role"]);
					$_SESSION["JoinDate"]=dboutput($row["Added"]);
					$_SESSION["LockScreen"]=false;
					if(isset($_POST["remember_me"])) 
					{
						$year = time() + 31536000;
						setcookie('remember_me_u', $_POST['username'], $year);
						setcookie('remember_me_p', $_POST['password'], $year);
					}
					else 
					{
						if(isset($_COOKIE['remember_me_u']))
						{
							$past = time() - 100;
							setcookie('remember_me_u', '', $past);
						}
						if(isset($_COOKIE['remember_me_p']))
						{
							$past = time() - 100;
							setcookie('remember_me_p', '', $past);
						}
					}
					
					mysql_close($dbh);
					header("Location: Dashboard.php");
				}
				else
				{
					$_SESSION["Login"]=false;
					$_SESSION["IsEmployee"]=false;
					$_SESSION["UserID"]='';
					$_SESSION["Photo"]='';
					$_SESSION["UserFullName"]='';
					$_SESSION["RoleID"]='';
					$_SESSION["JoinDate"]='';
					$_SESSION["LockScreen"]=true;
					$msg3 = "<div class=\"error\">Invalid Username/Password.</div>";
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html style="background: url(images/login-bg.png) no-repeat center center fixed;">
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
</head>
<body style="background:none;">
<div class="form-box" id="login-box">
  <div class="header"><img src="images/login-logo.png" style="margin-top:-60px;"></div>
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <div class="body bg-gray"> <span style="color:red;font-size:12px;">
      <?php 
					if(isset($msg3))
					echo $msg3
					?>
      </span>
      <div class="form-group"> <span style="color:red;font-size:12px;">
        <?php if(isset($msg1)){echo $msg1;}?>
        </span>
		
	  <div class="input-group">
		<span class="input-group-addon bg-login-blue"><img src="images/login-user.png" width="18"></span>
        <input type="text" name="username" value="<?php if(isset($_REQUEST['username'])){echo $_REQUEST['username'];}else{if(isset($_COOKIE['remember_me_u'])){echo $_COOKIE['remember_me_u'];}}?>"  class="form-control" placeholder="Username"/>
		</div>
      </div>
      <div class="form-group"> <span style="color:red;font-size:12px;">
        <?php if(isset($msg2)){echo $msg2;}?>
        </span>
		<div class="input-group">
		<span class="input-group-addon bg-login-blue"><img src="images/login-pswd.png" width="18"></span>
        <input type="password" name="password" value="<?php if(isset($_COOKIE['remember_me_p'])){echo $_COOKIE['remember_me_p'];}?>" class="form-control" placeholder="Password"/>
		</div>
	  </div>
      <div class="form-group">
        <label><input type="checkbox" name="remember_me" 
						<?php if(isset($_COOKIE['remember_me_u'])) {
						echo 'checked="checked"';
						}
						else {
							echo '';
						}
						?> />
        Remember me</label></div>
    </div>
    <div class="footer">
      <button type="submit" class="btn bg-login-blue btn-block">Login</button>
      <!--<p><a href="#">I forgot my password</a></p>-->
    </div>
    <input type="hidden" name="action" value="submit_form" />
  </form>
  <div class="text-right" style="margin-top:5px;">
				<a href="http://cloud-innovator.com/" target="_blank"><img src="images/login-pby.png" /></a>
            </div>
</div>
<!-- jQuery 2.0.2 -->
<script src="ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
