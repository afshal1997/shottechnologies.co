<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$_SESSION["msg"] = '';
if(isset($_POST['submits'])):
    $front_nav_gradient = $_POST['front_nav_gradient'];
    $front_nav_color = $_POST['front_nav_color'];
    $developer_nav_color = $_POST['developer_nav_color'];
    $developer_nav_gradient = $_POST['developer_nav_gradient'];
    $sidebar_button = $_POST['sidebar_button'];
    $default_status = $_POST['default_status'];
	$query="UPDATE developer SET front_nav_gradient = '$front_nav_gradient',front_nav_color = '$front_nav_color',developer_nav_color='$developer_nav_color',developer_nav_gradient='$developer_nav_gradient', 
	sidebar_button = '$sidebar_button', default_status = '$default_status'
	WHERE developer_id = 1";
	mysql_query($query) or die ('Could not update Adjustment because: ' . mysql_error());
	//echo $query;
	
	$msg='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Developer settings has been updated.</b>
	</div>';
endif;
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Career</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Employee-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
</script>
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
      <h1> Developer Settings <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Developer Form</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">	
				<b>Developer Form</b>
			  </h3>
			 <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="developerForm">
			  <div class="buttons" style="width:50%">
                <button type="submit" name="submits" class="btn btn-success margin">Save</button>
                <button class="btn bg-navy margin" type="button" onClick="location.href='Dashboard.php'">Back</button>
              </div>
            </div>
            <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
            <?php
    			$query = "SELECT * FROM developer";
    			$res = mysql_query($query);
    			while($row = mysql_fetch_assoc($res))
    			{
    				$nav_upper_gradient = $row['front_nav_color'];
    				$nav_lower_gradient = $row['front_nav_gradient'];
    				$side_upper_gradient = $row['developer_nav_gradient'];
    				$side_lower_gradient = $row['developer_nav_color'];
    				$sidebar_button = $row['sidebar_button'];
    				$default_status = $row['default_status'];
    			} 
        	?>
            <!-- /.box-header -->
                <div class="box-body margin">
    			  <div class="row">
    			      <div class="col-lg-6 text-center">
    			          <p>Navigation Upper Gradient</p>
    			          <input type="color" name='front_nav_color' value="<?php echo $nav_upper_gradient; ?>" style="width:85%;">
    			      </div>
    			      <div class="col-lg-6 text-center">
    			          <p>Navigation Lower Gradient</p>
    			          <input type="color" name='front_nav_gradient'  value="<?php echo $nav_lower_gradient; ?>" style="width:85%;">
    			      </div>
    			  </div>
    			  <br>
    			  <div class="row">
    			      <div class="col-lg-6 text-center">
    			          <p>SideBar Upper Gradient</p>
    			          <input type="color" name='developer_nav_color' value="<?php echo $side_lower_gradient; ?>" style="width:85%;">
    			      </div>
    			      <div class="col-lg-6 text-center">
    			          <p>SideBar Lower Gradient</p>
    			          <input type="color" name="developer_nav_gradient" value="<?php echo $side_upper_gradient; ?>" style="width:85%;">
    			      </div>
    			  </div>
    			  <br>
    			 <div class="row">
    			      <div class="col-lg-6 text-center">
    			          <p>Set Default Theme</p>
    			         <input type="checkbox" id='default_theme' name='default_status' style="width:85%;" <?php if($default_status == 1): echo 'checked'; endif; ?>>
    			      </div>
    			  </div>
                </div>
                <input type="hidden" name="developer_submit" >
            </form>
            <br>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- ./wrapper -->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script>
$("#default_theme").on('click',function(){
    if($("#default_theme").prop("checked")){
        $(this).val('1');
        $('input[type="color"]').attr('disabled',true);
    } else {
        $(this).val('0');
        $('input[type="color"]').attr('disabled',false);
    }
});
</script>
</body>
</html>
