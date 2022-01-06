<?php
    include_once("Common.php");
// redirect("https://hrms.shottechnologies.co/");

if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
	redirect("Dashboard.php");

    $msg = "";
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
			$query="SELECT ID,FirstName,LastName,Photo,Designation,Department,CompanyID,Location, EmpID, UserName, Password,Role,Supervisor,DATE_FORMAT(JoiningDate, '%b %Y') AS Added FROM employees WHERE Status = 'Active' AND AllowEmpLogin = 'Yes' AND UserName='".dbinput($username)."'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);

			
			if($num==0 || $num > 1)
			{
				$_SESSION["Login"]=false;
				$_SESSION["IsEmployee"]=false;
				$_SESSION["UserID"]='';
				$_SESSION["EmpID"]='';
				$_SESSION["Photo"]='';
				$_SESSION["UserFullName"]='';
				$_SESSION["RoleID"]='';
				$_SESSION["JoinDate"]='';
				$_SESSION["MyDesignation"]='';
				$_SESSION["MyDepartment"]='';
				$_SESSION["MyCompany"]='';
				$_SESSION["MyLocation"]='';
				$_SESSION["MySupervisor"]='';
				$_SESSION["LockScreen"]=true;
				$_SESSION["id"]='';
				$_SESSION["username"]='';
				$msg3 = "<div class=\"error\">Invalid Username/Password.</div>";
				
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if(dboutput($row["Password"]) == $password)
				{
					$_SESSION["Login"]=true;
					$_SESSION["IsEmployee"]=true;
					$_SESSION["UserID"]=dboutput($row["ID"]);
					$_SESSION["EmpID"]=dboutput($row["EmpID"]);
					$_SESSION["Photo"]=dboutput($row["Photo"]);
					$_SESSION["UserFullName"]=dboutput($row["FirstName"]) .' '. dboutput($row["LastName"]);
					$_SESSION["RoleID"]=dboutput($row["Role"]);
					$_SESSION["JoinDate"]=dboutput($row["Added"]);
					$_SESSION["MyDesignation"]=dboutput($row["Designation"]);
					$_SESSION["MyDepartment"]=dboutput($row["Department"]);
					$_SESSION["MyCompany"]=dboutput($row["CompanyID"]);
					$_SESSION["MyLocation"]=dboutput($row["Location"]);
					$_SESSION["MySupervisor"]=dboutput($row["Supervisor"]);
					$_SESSION["id"]=dboutput($row["ID"]);
				    $_SESSION["username"]=dboutput($row["UserName"]);
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
					$_SESSION["EmpID"]='';
					$_SESSION["Photo"]='';
					$_SESSION["UserFullName"]='';
					$_SESSION["RoleID"]='';
					$_SESSION["JoinDate"]='';
					$_SESSION["MyDesignation"]='';
					$_SESSION["MyDepartment"]='';
					$_SESSION["MyCompany"]='';
					$_SESSION["MyLocation"]='';
					$_SESSION["MySupervisor"]='';
					$_SESSION["LockScreen"]=true;
					$_SESSION["id"]='';
				    $_SESSION["username"]='';
					$msg3 = "<div class=\"error\">Invalid Username/Password.</div>";
				}
			}
		}
	}
	if(isset($_POST["action"]) && $_POST["action"] == "submit_forgot_form")
	{
		if(isset($_POST["EmailAddress"]))
			$EmailAddress=trim($_POST["EmailAddress"]);
			
		if ($EmailAddress=="")
			$msg = "<div class=\"error\">Please Enter EmailAddress.</div>";
			
		if($msg=='')
		{	
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token = substr(str_shuffle($permitted_chars), 0, 24);

			$query="UPDATE employees SET token = '".$token."' WHERE EmailAddress='".$EmailAddress."'";
			$result = mysql_query ($query) or die(mysql_error());
			
			$to = $EmailAddress;
            $subject = "Password Reset - HRMS Software";
             
             $message = "<h1>Please click at below link to reset your password.</h1>";
             
             $header = "From:hrms-software@shottechnologies.co \r\n";
            //  $header .= "Cc:afgh@somedomain.com \r\n";
             $header .= "MIME-Version: 1.0\r\n";
             $header .= "Content-type: text/html\r\n";
             
             $retval = mail ($to,$subject,$message,$header);
             
             if( $retval == true ) {
                redirect("Login.php?thank");
             }
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>HRM 360 || LogIn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="https://myprojectstaging.com/html/hrms-360/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://myprojectstaging.com/html/hrms-360/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://myprojectstaging.com/html/hrms-360/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://myprojectstaging.com/html/hrms-360/assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="css/webarch.css" rel="stylesheet" type="text/css" />
    
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="https://myprojectstaging.com/html/hrms-360/webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body>
      <script>
$(document).ready(function(){ 
		
		$("#EmpEmail").keyup(function () {
			$.ajax({			
				url: 'get_empemail_availablity.php?ID='+$("#EmpEmail").val(),
				success: function(data) {
					$("#Availablity").html(data);
				},
				error: function (xhr, textStatus, errorThrown) {
					alert(xhr.responseText);
					$("#Availablity").removeAttr("disabled");
				}
			});
		});		
		
		
	}); 
</script>
<div class="no-top login-bg" style="background-image: url('https://myprojectstaging.com/html/hrms-360/assets/img/login/login-bg.jpg');">
    <div class="container">
      <div class="row login-container column-seperation">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <br>
          <div class="text-center login-logo">
            <img src="images/logo.png" width="300">
          </div>
          <div class="card card card-login">
            <div class="card-body">
              <div class="text-center">
              <h4><b>Sign in with your Account</b></h4>
              </div>
          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="login-form validate" id="login-form" name="login-form">
            <div class="row">
              <span style="color:red;font-size:12px;">
               <?php 
                  if(isset($msg3))
                  echo $msg3
                  ?>
               </span>
               
              <span style="color:red;font-size:12px;">
              <?php if(isset($msg1)){echo $msg1;}?>
              </span>
              <div class="form-group col-md-12 login-margin">
                <input  autofocus type="text" name="username" value="<?php if(isset($_REQUEST['username'])){echo $_REQUEST['username'];}else{if(isset($_COOKIE['remember_me_u'])){echo $_COOKIE['remember_me_u'];}}?>"  class="form-control" placeholder="Username"">
              </div>
            </div>
            <div class="row">
                 <span style="color:red;font-size:12px;">
                  <?php if(isset($msg2)){echo $msg2;}?>
                  </span>
              <div class="form-group col-md-12 login-margin"><span class="help"></span>
                <input type="password" name="password" value="<?php if(isset($_COOKIE['remember_me_p'])){echo $_COOKIE['remember_me_p'];}?>" class="form-control" placeholder="Password"/>
              </div>
            </div>
            <div class="row">
              <div class="control-group col-md-12 text-left">
                      <label class="remember-me"><input type="checkbox" name="remember_me" 
                     <?php if(isset($_COOKIE['remember_me_u'])) {
                        echo 'checked="checked"';
                        }
                        else {
                        echo '';
                        }
                        ?> />
                  Remember me</label>
                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn bg-login-blue btn-block">Login</button>
              </div>
            </div>
            <input type="hidden" name="action" value="submit_form" />
          </form>
          </div>
          </div>
         <div class="text-center forgot">
               <h4><a href="#!" data-toggle="modal" data-target="#forgot-modal">Forgot Password?</a></h4>
          </div>
          <div class="footer-login">
            <h5>Copyright © <?php echo date('Y'); ?> Shot Technologies. All rights reserved.</h5>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN JS DEPENDECENCIES-->
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="https://myprojectstaging.com/html/hrms-360/webarch/js/webarch.js" type="text/javascript"></script>
    <script src="https://myprojectstaging.com/html/hrms-360/assets/js/chat.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    
    
       <div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title">Forgot Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="email" required placeholder="Email" autocomplete="OFF" name="EmailAddress" id="EmpEmail">
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <span id="Availablity"></span>
      </div>
      </form>
    </div>
  </div>
</div>
   
   <div class="modal fade" id="reset-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <img src="css/images/t-logo.png" class="img-responsive">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <h4>Please check your email to reset password.</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="expired-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <img src="css/images/t-logo.png" class="img-responsive">
        <h5 class="modal-title">Token Expired</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <h4>Your reset password token is expired.</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <img src="css/images/t-logo.png" class="img-responsive">
        <h5 class="modal-title">Password Changed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <h4>Your password is successfully changed. Please Login Now.</h4>
        </div>
      </div>
    </div>
  </div>
</div>
   
   
   <!-- jQuery 2.0.2 -->
   <!--<script src="ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
   <script src="js/jquery-2.1.1.js"></script>
   <!-- Bootstrap -->
   <script src="js/bootstrap.min.js" type="text/javascript"></script>
   <script>
       <?php if(isset($_GET["thank"])){ ?>
        $("#reset-modal").modal("show");
       <?php } ?>
       <?php if(isset($_GET["expired"])){ ?>
        $("#expired-modal").modal("show");
       <?php } ?>
       <?php if(isset($_GET["success"])){ ?>
        $("#success-modal").modal("show");
       <?php } ?>
   </script>
  </body>
</html>
