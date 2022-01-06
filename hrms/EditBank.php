<?php
include_once("Common.php");
include("CheckAdminLogin.php");

if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
{}else{redirect("Dashboard.php");}	
	
	$msg="";
	$ID=0;
	$Status=1;
	$Bank='';
	$AccountNo='';
	$LetterHead='';
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);		
	if(isset($_POST["Bank"]))
		$Bank=trim($_POST["Bank"]);
	if(isset($_POST["Status"]) && ((int)$_POST["Status"] == 0 || (int)$_POST["Status"] == 1))
		$Status=trim($_POST["Status"]);
	if(isset($_POST["AccountNo"]))
		$AccountNo=trim($_POST["AccountNo"]);
	if(isset($_POST["LetterHead"]))
		$LetterHead=trim($_POST["LetterHead"]);

	
		if($Bank == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Bank.</b>
			</div>';
		}
		
	
	if($msg=="")
	{
		$r = mysql_query("SELECT Name FROM banks WHERE 
		Name='".dbinput($Bank)."' AND ID <> '".(int)$ID."'") or die(mysql_error());
		if(mysql_num_rows($r) == 0)
		{
			$query="UPDATE banks SET Status='".(int)$Status . "', DateModified=NOW(),
			Name = '" . dbinput($Bank) . "',
			AccountNo = '" . dbinput($AccountNo) . "',
			LetterHead = '" . $LetterHead . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Bank has been Updated.</b>
			</div>';
		
		}
		else
		{
			$msg = '<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Name already exists.</b>
			</div>';
		}
			
		
			
	}

}
else
{
	$query="SELECT ID, Name,Status,AccountNo,LetterHead,DATE_FORMAT(DateAdded, '%D %b %Y %r') AS Added, DATE_FORMAT(DateModified,
	 '%D %b %Y %r') AS Updated FROM banks WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Bank ID.</b>
		</div>';
		redirect("Banks.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Bank=$row["Name"];
		$Status=$row["Status"];
		$AccountNo=$row["AccountNo"];
		$LetterHead=$row["LetterHead"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Bank</title>
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
      <h1>Edit Bank</h1>
      <ol class="breadcrumb">
        <li><a href="Banks.php"><i class="fa fa-dashboard"></i>Banks</a></li>
        <li class="active">Edit Bank</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>"" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Banks.php'">Cancel</button>
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
               <div class="form-group">
                  <label id="labelimp" for="Bank" >Bank: </label>
                  <?php 
				echo '<input type="text" id="Bank" name="Bank" class="form-control"  value="'.$Bank.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="AccountNo" >Account No: </label>
                  <?php 
				echo '<input type="text" id="AccountNo" name="AccountNo" class="form-control"  value="'.$AccountNo.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="LetterHead" >Letter Head: </label>
                  <?php 
				echo '<textarea id="LetterHead" placeholder="* Use <br> for line break" rows="5" name="LetterHead" class="form-control">'.$LetterHead.'</textarea>';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Status: </label>
                  <label>
                  <input type="radio" name="Status" value="1"<?php echo ($Status == 1 ? ' checked="checked"' : ''); ?>>
                  Enable</label>
                  <label>
                  <input type="radio" name="Status" value="0"<?php echo ($Status == 0 ? ' checked="checked"' : ''); ?>>
                  Disable</label>
                </div>
				
				
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
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
