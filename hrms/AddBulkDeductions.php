<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$ID=0;

		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_ONLY_CSV_ALLOWED))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			Only '.implode(", ", $_ONLY_CSV_ALLOWED) . ' extention file can be uploaded.
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_CSV_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			CSV size must be ' . (MAX_CSV_SIZE/1024) . ' MB or less.
			</div>';
		}
	}
		

	
		if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please Upload File.</b>
			</div>';
		}



	if($msg=="")
	{

    if (is_uploaded_file($_FILES['flPage']['tmp_name'])) {
	
	// $deleterecords = "TRUNCATE TABLE individual_bonuses"; //empty the table of its current records
	// mysql_query($deleterecords) or die(mysql_error());
    
    //Import uploaded file to Database
    $handle = fopen($_FILES['flPage']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$empinfo="SELECT ID from employees WHERE ID <> 0 AND ID = '".$data[0]."'";
        $empresult = mysql_query($empinfo) or die(mysql_error());
		$numbers = mysql_num_rows($empresult);
		if($numbers == 1)
		{	
			$EmpIDrow = mysql_fetch_array($empresult);
			$EmpID = $EmpIDrow['ID'];
			$validate="SELECT ID from deductions WHERE ID <> 0 AND EmpID = '".$EmpID."' AND Title = '".$data[1]."'";
			$result = mysql_query($validate) or die(mysql_error());
			$num = mysql_num_rows($result);
			if($num == 0)
			{
				$import="INSERT into deductions(EmpID,FrwdEmpID,Approved,ApprovedBy,Title,Amount,Percentage,Type,Date) values('$EmpID','0','1','".$_SESSION['UserID']."','$data[1]','$data[2]','$data[2]','$data[3]',NOW())";
				//echo $import;exit();
				mysql_query($import) or die(mysql_error());
			}
			else
			{
				$import="DELETE from deductions WHERE ID <> 0 AND EmpID = '".$EmpID."' AND Title = '".$data[1]."'";
				mysql_query($import) or die(mysql_error());
				//echo $import;exit();
				
				$import="INSERT into deductions(EmpID,FrwdEmpID,Approved,ApprovedBy,Title,Amount,Percentage,Type,Date) values('$EmpID','0','1','".$_SESSION['UserID']."','$data[1]','$data[2]','$data[2]','$data[3]',NOW())";
				//echo $import;exit();
				mysql_query($import) or die(mysql_error());
			}
		}
    }
    fclose($handle);
	
    $_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Deductions has been Uploaded.</b>
		</div>';
	}
	else
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Deductions Not Uploaded.</b>
		</div>';
	}

		redirect("AddBulkDeductions.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Basic Deductions</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
      <h1> Add Basic Deductions</h1>
      <ol class="breadcrumb">
        <li><a href="Deductions.php"><i class="fa fa-dashboard"></i>Deductions</a></li>
        <li class="active">Add Basic Deductions</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Deductions.php'">Cancel</button>
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
				<input type="hidden" name="action" value="submit_form" />
				
				<div class="form-group">
                  <label id="labelimp" for="Deductions" class="labelimp" >Upload (CSV): </label>
                  <input type="file" id="Deductions" name="flPage" />
                </div>
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
             
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
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
