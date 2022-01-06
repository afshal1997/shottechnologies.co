<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
$msg='';
$Subject="";
$Sender="";
$Date="";
$Body="";
$ID=0;
$RecieverID=0;
	if(isset($_REQUEST["MsgID"]) && ctype_digit(trim($_REQUEST["MsgID"])))
		$ID=trim($_REQUEST["MsgID"]);
	if(isset($_REQUEST["RecieverID"]) && ctype_digit(trim($_REQUEST["RecieverID"])))
		$RecieverID=trim($_REQUEST["RecieverID"]);
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_REQUEST["MsgID"]) && ctype_digit(trim($_REQUEST["MsgID"])))
		$ID=trim($_REQUEST["MsgID"]);
	if(isset($_REQUEST["RecieverID"]) && ctype_digit(trim($_REQUEST["RecieverID"])))
		$RecieverID=trim($_REQUEST["RecieverID"]);	
	if(isset($_POST["Subject"]))
		$Subject=trim($_POST["Subject"]);
	if(isset($_POST["Body"]))
		$Body=trim($_POST["Body"]);

	
	if($Body=="")
	{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter Message Content.</b>
			</div>';
	}
	if($msg=="")
	{
		$query="INSERT INTO messages SET  Sender='".$_SESSION['UserID']. "', DateAdded=NOW(),
				Subject = '" . dbinput($Subject) . "', Contents = '" . dbinput($Body) . "', Receivers = '" . $RecieverID . "'";
		mysql_query($query) or die ('Could not add category because: ' . mysql_error());
		// echo $query;
		// $ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Message has been Sended.</b>
		</div>';		
					
	}

}
	$query3="UPDATE messages SET IsCheck = 1, ReceivedBy = ".$_SESSION['UserID'].", DateModified=NOW() WHERE ID=".(int)$ID."";
			mysql_query($query3) or die (mysql_error());
	
	$query5="SELECT ID,IsCheck FROM messages WHERE IsCheck=0 AND FIND_IN_SET ('".$_SESSION['UserID']."' ,Receivers) ";
	$result5 = mysql_query ($query5) or die(mysql_error()); 
	$num5 = mysql_num_rows($result5);
	if($num5==0)
	{
	$_SESSION["RecMsg"]=0;				
	}
	else
	{
	$_SESSION["RecMsg"]=$num5;
	}

	$query="SELECT m.ID,m.Contents,m.Sender,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,m.IsCheck,m.Subject, DATE_FORMAT(m.DateAdded, '%D %b %Y<br>%r') AS Added
				FROM messages m LEFT JOIN employees e ON m.Sender = e.ID WHERE e.ID <>0 AND FIND_IN_SET ('".$_SESSION['UserID']."' ,m.Receivers) AND m.ID = ".$ID."";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Message ID.</b>
		</div>';
		redirect("Inbox.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$Subject=$row["Subject"];
		$Body=$row["Contents"];
		$Sender=$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')';
		$Date=$row["Added"];
		
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Read Message</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
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
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>
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
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Message Details</h1>
      <ol class="breadcrumb">
        <li><a href="Inbox.php"><i class="fa fa-dashboard"></i>Messages</a></li>
        <li class="active">Message Details</li>
      </ol>
    </section>
	
    <!-- Main content -->
    
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button class="btn btn-primary margin" type="button" onClick="location.href='Inbox.php'">Back</button>
        </div>
        
        <div class="col-md-12">
		<h3>Message Details</h3>
          <div class="box">
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
			  <!-- form start -->
              <div class="box-body">
                <table border="1" width="100%">
				<tr>
				<td width="10%"><b>Sender:</b></td><td><?php echo $Sender; ?></td>
				</tr>
				<tr>
				<td width="10%"><b>Time:</b></td><td><?php echo $Date; ?></td>
				</tr>
				<tr>
				<td width="10%"><b>Subject:</b></td><td><?php echo $Subject; ?></td>
				</tr>
				<tr>
				<td width="10%"><b>Content:</b></td><td><?php echo $Body; ?></td>
				</tr>
				</table>
				
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		
		
		<div class="col-md-12">
		<h3></h3>
          <div class="box">
			<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?MsgID=<?php echo $ID; ?>&RecieverID=<?php echo $RecieverID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
			<input type="hidden" name="MsgID" value="<?php echo $ID; ?>" />
			<input type="hidden" name="RecieverID" value="<?php echo $RecieverID; ?>" />
            <div class="box">
              <div class="box-header"> <i class="fa fa-envelope"></i>
                <h3 class="box-title">Reply Message</h3>
                
              </div>
              
              <div class="box-body">
               
                <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				
				?>
                <div class="form-group">
                  <?php 
                                        echo '<input type="text" placeholder="Subject" id="Subject" name="Subject" class="form-control"  value="Re: '. $Subject .'" />';
                                        ?>
                </div>
                <div>
                  <?php 
                                        echo '<textarea placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" class="textarea" name="Body"></textarea>';
                                        ?>
                </div>
              </div>
              <input type="hidden" name="action" value="submit_form" />
              <div class="box-footer clearfix">
                <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>
          </form>
          </div>
        </div>
		
		
      </section>
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
