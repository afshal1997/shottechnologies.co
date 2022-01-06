<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$ID=0;
	$Status=1;
	$Name='';
	$One='';
	$Two='';
	$Three='';
	$Four='';
	$Five='';
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);
	if(isset($_POST["Status"]) && ((int)$_POST["Status"] == 0 || (int)$_POST["Status"] == 1))
		$Status=trim($_POST["Status"]);
	if(isset($_POST["One"]))
		$One=trim($_POST["One"]);
	if(isset($_POST["Two"]))
		$Two=trim($_POST["Two"]);
	if(isset($_POST["Three"]))
		$Three=trim($_POST["Three"]);
	if(isset($_POST["Four"]))
		$Four=trim($_POST["Four"]);
	if(isset($_POST["Five"]))
		$Five=trim($_POST["Five"]);

	
		

	
		if($Name == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Rate Analysis Name.</b>
			</div>';
		}
		
		

	if($msg=="")
	{

	
		$query="INSERT INTO rate_analysis SET Status='".(int)$Status . "', DateAdded=NOW(),
				Name = '" . dbinput($Name) . "',One = '" . dbinput($One) . "',Two = '" . dbinput($Two) . "',Three = '" . dbinput($Three) . "',Four = '" . dbinput($Four) . "',Five = '" . dbinput($Five) . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		// $ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Rate Analysis has been added.</b>
		</div>';		

		redirect("AddNewRateAnalysis.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Rate Analysis</title>
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
      <h1>Add Rate Analysis </h1>
      <ol class="breadcrumb">
        <li><a href="RateAnalysis.php"><i class="fa fa-dashboard"></i>Rate Analysis</a></li>
        <li class="active">Add Rate Analysis</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='RateAnalysis.php'">Cancel</button>
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
                  <label id="labelimp" for="Name" >Rate Analysis Title: </label>
                  <?php 
				echo '<input type="text" id="Name" name="Name" class="form-control"  value="'.$Name.'" />';
				?>
                </div>	
				
				<div class="form-group">
                  <label id="labelimp" for="One" >One: </label>
                  <?php 
				echo '<input type="text" id="One" name="One" class="form-control"  value="'.$One.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Two" >Two: </label>
                  <?php 
				echo '<input type="text" id="Two" name="Two" class="form-control"  value="'.$Two.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Three" >Three: </label>
                  <?php 
				echo '<input type="text" id="Three" name="Three" class="form-control"  value="'.$Three.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Four" >Four: </label>
                  <?php 
				echo '<input type="text" id="Four" name="Four" class="form-control"  value="'.$Four.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Five" >Five: </label>
                  <?php 
				echo '<input type="text" id="Five" name="Five" class="form-control"  value="'.$Five.'" />';
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
                
                <input type="hidden" name="action" value="submit_form" />
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
