<?php
include_once("Common.php");
include("CheckAdminLogin.php");

	$msg="";
	$Approved=0;
	$ApprovedBy=0;
	$FrwdEmpID=0;
	$Title="";
	$Date="";
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{
	if(isset($_POST["Title"]))
		$Title=trim($_POST["Title"]);
	if(isset($_POST["Date"]))
		$Date=trim($_POST["Date"]);
	if(isset($_POST["FrwdEmpID"]) && ctype_digit($_POST['FrwdEmpID']))
		$FrwdEmpID=trim($_POST["FrwdEmpID"]);

			
		if($Title == "")
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please enter Title.</b>
				</div>';
		}
		else if($Date == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Date.</b>
			</div>';
		}
		else if($FrwdEmpID == 0)
		{
			$Approved=1;
			$ApprovedBy=$_SESSION["UserID"];
		}

		


	if($msg=="")
	{		
		$query="INSERT INTO gazetted_holidays SET 
				Title = '" . dbinput($Title) . "',
				Date = '" . dbinput($Date) . "',
				FrwdEmpID='".(int)$FrwdEmpID . "',
				Approved = '" . dbinput($Approved) . "',
				ApprovedBy = '" . (int)$ApprovedBy . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Gazetted Holiday has been added.</b>
		</div>';		
		
		redirect("AddNewGazettedHoliday.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Gazetted Holiday</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, LeavesQuota-scalable=no' name='viewport'>
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
      <h1> Add Gazetted Holiday</h1>
      <ol class="breadcrumb">
        <li><a href="GazettedHolidays.php"><i class="fa fa-dashboard"></i>Gazetted Holidays</a></li>
        <li class="active">Add Gazetted Holiday</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='GazettedHolidays.php'">Cancel</button>
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
                  <label id="labelimp" class="labelimp" for="Title">Title: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="Title" name="Title" class="form-control"  value="'.$Title.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Date">Date: </label>
                  <?php 
				echo '<input type="date" maxlength="100" id="Date" name="Date" class="form-control"  value="'.$Date.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="FrwdEmpID" >Forward Application To: </label>
				  <select disabled name="FrwdEmpID" id="FrwdEmpID" class="form-control">
					<option value="0" >No Forward</option>
					<?php
					 $query = "SELECT ID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY Department,Designation ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($FrwdEmpID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
					</select>
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
<script>
	$(function(){
	var sidebar = $('.sidebar-menu');  // cache sidebar to a variable for performance

	sidebar.delegate('.treeview','click',function(){ 
	  if($(this).hasClass('active')){
		$(this).removeClass('active');
		sidebar.find('.inactive > .treeview-menu').hide(200);
		sidebar.find('.inactive').removeClass('inactive');
	   $(this).addClass('inactive');
	   $(this).find('.treeview-menu').show(200);
	 }else{
	  sidebar.find('.active').addClass('inactive');          
	  sidebar.find('.active').removeClass('active'); 
	   $(this).Class('treeview-menu').hide(200);
	 }
	});

	});
	
	$(document).click(function (event) {   
    $('.treeview-menu:visible').hide();
	});

	</script>
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
