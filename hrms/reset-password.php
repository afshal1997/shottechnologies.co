<?php
include_once("Common.php");
// redirect("https://hrms.shottechnologies.co/");
if(isset($_SESSION['Login']) && $_SESSION['Login']==true)
	redirect("Dashboard.php");

    $msg = "";
	

	if(isset($_REQUEST["token"]))
	{
		$query="SELECT ID,EmailAddress FROM employees WHERE  token='" . $_REQUEST["token"] . "'";
		
		$result = mysql_query ($query) or die(mysql_error()); 
		$num = mysql_num_rows($result);
		
		if($num==0)
		{
			redirect("Login.php?expired");
		}
		else
		{
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$ID=$row["ID"];
			$EmailAddress=$row["EmailAddress"];
		}
	}

	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{	
		if(isset($_POST["Password"]))
			$Password=trim($_POST["Password"]);
		if(isset($_POST["Password2"]))
			$Password2=trim($_POST["Password2"]);
		
			if($Password == "") {
				$msg='<div class=\"error\">Please Enter Password.</div>';
			}	
			else if($Password != $Password2) {
				$msg='<div class=\"error\">Confirm Password Not Matched.</div>';
			}

			if($msg=="")
		{
				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            	$token = substr(str_shuffle($permitted_chars), 0, 24);

				$query="UPDATE employees SET DateModified=NOW(),
					Password = '" . dbinput($Password) . "',token = '" . $token . "'
				WHERE ID='".(int)$ID."'";
				mysql_query($query) or die (mysql_error());
				//echo $query;
				
				redirect("Login.php?success");			
				
		}

	}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Reset Password</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="login-body" style="background:none;">
   <div class="login-wrap">
      <div class="login-banner"></div>
      <div class="form-box" id="login-box">
          <div class="form-box-inner">
            <div class="form-logo"><img src="css/images/logo-big.png" class="img-responsive"></div>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>?token=<?php echo $_REQUEST["token"]; ?>" method="post">
                <p class="form-title">Reset Password</p>
            <div class="body">
               <span style="color:red;font-size:12px;">
               <?php 
                  if(isset($msg))
                  echo $msg
                  ?>
               </span>
               <div class="form-group">
                 
                  <div class="input-group">
                     <input type="text"  value="<?php echo $ID; ?>"  class="form-control" readonly />
                  </div>
               </div>
               <div class="form-group">
                 
                  <div class="input-group">
                     <input type="text"  value="<?php echo $EmailAddress; ?>"  class="form-control" readonly />
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <input type="password" name="Password" value="" class="form-control" placeholder="Password"/>
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <input type="password" name="Password2" value="" class="form-control" placeholder="Confirm Password"/>
                  </div>
               </div>
            </div>
            <div class="login-footer">
               <button type="submit" class="btn bg-login-blue btn-block">Reset Password</button>
               <!--<p><a href="#">I forgot my password</a></p>-->
            </div>
            <input type="hidden" name="action" value="submit_form" />
         </form>
            <div class="text-right" style="margin-top:5px;">
            </div>
         </div>
         <p class="copy-right">Copyright © 2020 My Portal. All rights reserved.</p>
      </div>
   </div>
   

   
   
   <!-- jQuery 2.0.2 -->
   <!--<script src="ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
   <script src="js/jquery-2.1.1.js"></script>
   <!-- Bootstrap -->
   <script src="js/bootstrap.min.js" type="text/javascript"></script>
 </body>
</html>
