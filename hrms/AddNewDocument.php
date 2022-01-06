<?php
include_once("Common.php");
include("CheckAdminLogin.php");



	$msg="";
	$ID=0;
	$Name="";
	$Employee=0;

		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_POST["Name"]))
		$Name=trim($_POST["Name"]);
	if(isset($_POST["Employee"]) && ctype_digit($_POST['Employee']))
		$Employee=trim($_POST["Employee"]);
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
		$filenamearray=explode(".", $_FILES["flPage"]['name']);
		$ext=strtolower($filenamearray[sizeof($filenamearray)-1]);
	
		if(!in_array($ext, $_FILE_ALLOWED_TYPES))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			Only '.implode(", ", $_FILE_ALLOWED_TYPES) . ' extentions files can be uploaded.
			</div>';
		}			
		else if($_FILES["flPage"]['size'] > (MAX_IMAGE_SIZE*1024))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			Document size must be ' . (MAX_IMAGE_SIZE/1024) . ' MB or less.
			</div>';
		}
	}
		

	
		if($Name == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Document Name.</b>
			</div>';
		}
		else if($Employee == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Please Select Employee.</b>
				</div>';
		}
		 else if((!isset($_FILES["flPage"])) || ($_FILES["flPage"]['name'] == ""))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please Upload Document.</b>
			</div>';
		}



	if($msg=="")
	{

	
		$query="INSERT INTO documents SET  DateAdded=NOW(),
				Name = '" . dbinput($Name) . "',
				EmployeeID = '" . (int)$Employee . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Document has been added.</b>
		</div>';
		
		if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
		{
			if(is_file(DIR_DOCUMENTS . $StoreImage))
				unlink(DIR_DOCUMENTS . $StoreImage);
		
			ini_set('memory_limit', '-1');
			
			$tempName = $_FILES["flPage"]['tmp_name'];
			$realName = "Doc".$ID . "." . $ext;
			$StoreImage = $realName; 
			$target = DIR_DOCUMENTS . $realName;

			$moved=move_uploaded_file($tempName, $target);
		
			if($moved)
			{			
			
				$query="UPDATE documents SET FileName='" . dbinput($realName) . "' WHERE  ID=" . (int)$ID;
				mysql_query($query) or die(mysql_error());
			}
			else
			{
				$_SESSION["msg"]='<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<b>Document has been saved but File can not be uploaded.</b>
					</div>';
			}
		}


		redirect("AddNewDocument.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Document</title>
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
      <h1> Add Document</h1>
      <ol class="breadcrumb">
        <li><a href="EmployeeDocuments.php"><i class="fa fa-dashboard"></i>Documents</a></li>
        <li class="active">Add Document</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='EmployeeDocuments.php'">Cancel</button>
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
                  <label id="labelimp" class="labelimp" for="Name">Document Name: </label>
                  <?php 
				echo '<input type="text" id="Name" name="Name" class="form-control"  value="'.$Name.'" />';
				?>
                </div>	

				<div class="form-group">
					<label id="labelimp" class="labelimp" for="Name">Employee: </label>
				  <select name="Employee" id="myselect" class="js-example-disabled-results form-control">
					<option value="0" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY ID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
					</select>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" for="document" class="labelimp" >Document: </label>
                  <input type="file" id="document" name="flPage" />
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
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
