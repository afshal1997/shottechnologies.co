<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");
// redirect("https://hrms.technado.co/");

// function chat_refresh()
// {
// 	$_SESSION['RecID'] = "";
// 	unset($_SESSION['RecID']);
// 	redirect("Dashboard.php");
// }

// if (isset($_GET['refresh'])) {
//     chat_refresh();
//   }

// if(isset($_POST["action"]) && $_POST["action"] == "submit_formChat")
// {	
// 	if(isset($_POST['ChatCode']) && $_POST['ChatCode'] != ""){
// 	$_SESSION['RecID'] = $_POST['ChatCode'];
// 	}
// 	else
// 	{
// 	$_SESSION['RecID'] = "Error";
// 	}
// 	redirect("Dashboard.php");	
// }


// if(isset($_SESSION['UserID']) && isset($_SESSION['RecID'])){
// 	$myid = empCodeByID($_SESSION['UserID']);
// 	$fid = $_SESSION['RecID'];
// }

// if(isset($_POST['myid']) && isset($_POST['fid'])){
// 	$myid = $_POST['myid'];
// 	$fid = $_POST['fid'];
// }

$Anual=0;
$Casual=0;
$Sick=0;
$CAnual=0;
$CCasual=0;
$CSick=0;
$TAnual=0;
$TCasual=0;
$TSick=0;
$query1="SELECT AnualLeaves,CasualLeaves,SickLeaves FROM leaves_quota  WHERE ID <>0 AND EmpID=".$_SESSION['UserID']." AND Approved = 1";
$res1 = mysql_query($query1) or die(mysql_error());
$num1 = mysql_num_rows($res1);
if($num1 == 1)
{
	$row1 = mysql_fetch_array($res1);
	$Anual=$row1['AnualLeaves'];
	$Casual=$row1['CasualLeaves'];
	$Sick=$row1['SickLeaves'];
	
	$query2="SELECT AnualLeaves,CasualLeaves,SickLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".$_SESSION['UserID']."";
	$res2 = mysql_query($query2) or die(mysql_error());
	$num2 = mysql_num_rows($res2);
	
	if($num2 == 1)
	{
		$row2 = mysql_fetch_array($res2);
		$CAnual=$row2['AnualLeaves'];
		$CCasual=$row2['CasualLeaves'];
		$CSick=$row2['SickLeaves'];
		
		$TAnual = $Anual - $CAnual;
		$TCasual = $Casual - $CCasual;
		$TSick = $Sick - $CSick;
	}
}

$Status="";
$Department="";
if(isset($_REQUEST["Status"]))
		$Status=trim($_REQUEST["Status"]);
if(isset($_REQUEST["Department"]))
		$Department=trim($_REQUEST["Department"]);
		
$ageZeroTo20 = date('Y') - 20;
$age21to30 = $ageZeroTo20 - 10;
$age31to40 = $age21to30 - 10;
$age41to50 = $age31to40 - 10;
$age51toAbove = $age41to50 - 50;

function  total_males_in_department($Department,$Status)
{
	
	$res = mysql_query("SELECT * FROM employees WHERE Gender = 'Male' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_females_in_department($Department,$Status)
{
	
	$res = mysql_query("SELECT * FROM employees WHERE Gender = 'Female' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_permanental_in_department($Department,$Status)
{
	
	$res = mysql_query("SELECT * FROM employees WHERE EmpType = 'Permanent' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_contractual_in_department($Department,$Status)
{
	
	$res = mysql_query("SELECT * FROM employees WHERE EmpType = 'Contractual' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_probation_in_department($Department,$Status)
{
	
	$res = mysql_query("SELECT * FROM employees WHERE EmpType = 'Probation' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_b20_in_department($Department,$Status)
{
	$ageZeroTo20 = date('Y') - 20;
	$age21to30 = $ageZeroTo20 - 10;
	$age31to40 = $age21to30 - 10;
	$age41to50 = $age31to40 - 10;
	$age51toAbove = $age41to50 - 50;
	
	$res = mysql_query("SELECT * FROM employees WHERE (DATE_FORMAT(DOB, '%Y') BETWEEN ".$ageZeroTo20." AND ".date('Y').") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_b23_in_department($Department,$Status)
{
	$ageZeroTo20 = date('Y') - 20;
	$age21to30 = $ageZeroTo20 - 10;
	$age31to40 = $age21to30 - 10;
	$age41to50 = $age31to40 - 10;
	$age51toAbove = $age41to50 - 50;

	$res = mysql_query("SELECT * FROM employees WHERE (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age21to30." AND ".$ageZeroTo20.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_b34_in_department($Department,$Status)
{
	$ageZeroTo20 = date('Y') - 20;
	$age21to30 = $ageZeroTo20 - 10;
	$age31to40 = $age21to30 - 10;
	$age41to50 = $age31to40 - 10;
	$age51toAbove = $age41to50 - 50;

	$res = mysql_query("SELECT * FROM employees WHERE (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age31to40." AND ".$age21to30.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_b45_in_department($Department,$Status)
{
	$ageZeroTo20 = date('Y') - 20;
	$age21to30 = $ageZeroTo20 - 10;
	$age31to40 = $age21to30 - 10;
	$age41to50 = $age31to40 - 10;
	$age51toAbove = $age41to50 - 50;

	$res = mysql_query("SELECT * FROM employees WHERE (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age41to50." AND ".$age31to40.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}
function  total_a50_in_department($Department,$Status)
{
	$ageZeroTo20 = date('Y') - 20;
	$age21to30 = $ageZeroTo20 - 10;
	$age31to40 = $age21to30 - 10;
	$age41to50 = $age31to40 - 10;
	$age51toAbove = $age41to50 - 50;

	$res = mysql_query("SELECT * FROM employees WHERE (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age51toAbove." AND ".$age41to50.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."") or die(mysql_error());
	$Rs = mysql_fetch_assoc($res);
	$Students = mysql_num_rows($res);
	return $Students;
}

?>
<?php
$query = "SELECT Count(*) as male FROM employees where Gender = 'Male' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$male = $row['male'];

$query = "SELECT Count(*) as female FROM employees where Gender = 'Female' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$female = $row['female'];

$query = "SELECT Count(*) as probation FROM employees where EmpType = 'Probation' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$probation = $row['probation'];

$query = "SELECT Count(*) as permanental FROM employees where EmpType = 'Permanent' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$permanental = $row['permanental'];

$query = "SELECT Count(*) as ageZeroTo20 FROM employees where (DATE_FORMAT(DOB, '%Y') BETWEEN ".$ageZeroTo20." AND ".date('Y').") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$_ageZeroTo20 = $row['ageZeroTo20'];

$query = "SELECT Count(*) as age21to30 FROM employees where (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age21to30." AND ".$ageZeroTo20.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$_age21to30 = $row['age21to30'];

$query = "SELECT Count(*) as age31to40 FROM employees where (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age31to40." AND ".$age21to30.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$_age31to40 = $row['age31to40'];

$query = "SELECT Count(*) as age41to50 FROM employees where (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age41to50." AND ".$age31to40.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$_age41to50 = $row['age41to50'];

$query = "SELECT Count(*) as age51toAbove FROM employees where (DATE_FORMAT(DOB, '%Y') BETWEEN ".$age51toAbove." AND ".$age41to50.") ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$_age51toAbove = $row['age51toAbove'];

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Dashboard</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- fullCalendar -->
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/font-awesome-animation.min.css">
<!--<link href="css/custom.css" rel="stylesheet" type="text/css" />-->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<style>
#labelimp {
	background-color: #428BCA;
	padding: 4px;
	color:white;
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
	echo ($allnotifications > 0 ? '<audio src="images/ring.wav" type="audio/wav" autoplay></audio>' : '');
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
			include_once("Sidebar.php");
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="height:55px;color:#fff;background:url(images/dashboard-back.png)">
      <h1> Dashboard <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php" style="color:#fff"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content dashboard-pg-wrap">
      <!-- Small boxes (Stat box) -->
					<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR user_authentication($_SESSION['UserID'],'DashEmp') OR external_user_authentication($_SESSION['UserID'],'DashEmp')){ ?>
                    <div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                           <div class="form-group">
							  <div class="card header-card-1" style="background-image: url('images/header-card-1.jpg');">
								  <div class="card-body">
								    <h3 class="card-title border-left-1">4</h3>
								    <h5 class="card-subtitle mb-2 text-muted">Total head count</h5>
								  </div>
								</div>
							</div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                           <div class="form-group">
							  <div class="card header-card-1" style="background-image: url('images/header-card-1.jpg');">
								  <div class="card-body">
								    <h3 class="card-title border-left-2">4</h3>
								    <h5 class="card-subtitle mb-2 text-muted">Full time employees</h5>
								  </div>
								</div>
							</div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-xs-12">
                           <div class="form-group">
							  <div class="card header-card-1" style="background-image: url('images/header-card-1.jpg');">
								  <div class="card-body">
								    <h3 class="card-title border-left-3">4</h3>
								    <h5 class="card-subtitle mb-2 text-muted">Part time employees</h5>
								  </div>
								</div>
							</div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                           <div class="form-group">
							  <div class="card header-card-1" style="background-image: url('images/header-card-1.jpg');">
								  <div class="card-body">
								    <h3 class="card-title border-left-4">4</h3>
								    <h5 class="card-subtitle mb-2 text-muted">Employees with Scheduled Absence</h5>
								  </div>
								</div>
							</div>
                        </div>
<!-- 
						<div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm apply-filter-btn" style="background-color: #4a4a4b;color: #fff;">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
					</form>
                    </div><!-- /.row -->
					
					
					<div>
					<div class="row">
						<div class="col-md-4">
					        <!-- BAR CHART -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Gross Vs Payroll</h3>
                    
                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body chart-responsive">
                                  <canvas id="myChart"></canvas>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                             
                        </div>

					    <div class="col-md-4">
					        <!-- BAR CHART -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Gross Vs Payroll</h3>
                    
                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body chart-responsive">
                                  <div class="chart" id="bar-chart1" style="height: 300px;"></div>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                             
                        </div>
                        <div class="col-md-4">
					        <!-- BAR CHART -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Gross Vs Payroll</h3>
                    
                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body chart-responsive">
                                  <canvas id="mypieChart"></canvas>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                             
                        </div>
                    </div>
                    
                    <div class="row">

						<div class="col-md-4">
                            <!-- DONUT CHART -->
                            <div class="box box-success">
                                <div class="box-header">
									<i class="fa fa-venus-mars"></i>
                                    <h3 class="box-title">Male to Female Employees Ratio</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
								
                            </div><!-- /.box -->

                        </div>
						<div class="col-md-4">
						    <!-- AREA CHART -->
                              <div class="box box-primary">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Joinings Vs Resignations</h3>
                    
                                  <!--<div class="box-tools pull-right">-->
                                  <!--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                                  <!--  </button>-->
                                  <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                                  <!--</div>-->
                                </div>
                                <div class="box-body chart-responsive">
                                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                            <!-- DONUT CHART -->
                            <div class="box box-info" style="display:none">
                                <div class="box-header">
									<i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Employees by Age Group</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart2" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div>
						<div class="col-md-4">
                            <!-- DONUT CHART -->
                            <div class="box box-purple">
                                <div class="box-header" style="text-align:center">
									<i class="fa fa-briefcase"></i>
                                    <h3 class="box-title">Employees by Types</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart3" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div>
					</div>
					</div>
					
					<div class="row">
					<div class="box box-primary" style="display:none">
						<div class="box-header">
							<h3 class="box-title">Area Chart</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="revenue-chart" style="height: 300px;"></div>
						</div>
					</div>

					
					<div class="box box-danger" style="display:none">
						<div class="box-header">
							<h3 class="box-title">Donut Chart</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
						</div>
					</div>
					
					 
					<div class="box box-info" style="display:none">
						<div class="box-header">
							<h3 class="box-title">Line Chart</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="line-chart" style="height: 300px;"></div>
						</div>
					</div>
					
					<div class="col-md-4 col-xs-12">
					<div class="box box-success graph-box">
						<div class="box-header">
							<i class="fa fa-venus-mars"></i>
                            <h3 class="box-title">Male to Female Employees Ratio</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="bar-chart" style="height: 250px;"></div>
						</div>
						<!--<div class="box-footer clearfix table-responsive" style="background-color:#9A9A9A;">-->
						<!--	<table style="text-align:center" class="table table-striped">-->
						<!--		<thead>-->
						<!--			<tr>-->
						<!--				<th style="text-align:center">Gender</th>-->
						<!--				<th style="text-align:center">Employees</th>-->
						<!--			</tr>-->
						<!--		</thead>-->
						<!--		<tbody>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">Male</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $male; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">Female</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $female; ?></td>-->
						<!--			</tr>-->
						<!--		</tbody>-->
						<!--	</table>-->
						<!--</div>-->
					</div>
					<!--<div class="box box-solid bg-default notification-box">-->
					<!--	<div class="box-header" style="color:white;background-color:#2B2829;">-->
					<!--		<i class="fa fa-bell-o"></i><h3 class="box-title">Notifications</h3>-->
					<!--		<div class="box-tools pull-right"><a href="Notifications.php"><i style="color:white">VIEW ALL</i></a></div>-->
					<!--	</div>-->
					<!--</div>-->
					<!--<hr style="background-color:black; height:2px;">-->
					</div>
					
					<div class="col-md-4 col-xs-12">
					<div class="box box-success graph-box">
						<div class="box-header">
							<i class="fa fa-calendar"></i>
                            <h3 class="box-title">Employees by Age Group</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="bar-chart2" style="height: 250px;"></div>
						</div>
						<!--<div class="box-footer clearfix table-responsive" style="background-color:#9A9A9A;">-->
						<!--	<table style="text-align:center" class="table table-striped">-->
						<!--		<thead>-->
						<!--			<tr>-->
						<!--				<th style="text-align:center">Age</th>-->
						<!--				<th style="text-align:center">Employees</th>-->
						<!--			</tr>-->
						<!--		</thead>-->
						<!--		<tbody>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">Below 20</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $_ageZeroTo20; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">21 to 30</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $_age21to30; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">31 to 40</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $_age31to40; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">41 to 50</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $_age41to50; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">50 Above</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $_age51toAbove; ?></td>-->
						<!--			</tr>-->
						<!--		</tbody>-->
						<!--	</table>-->
						<!--</div>-->
					</div>
					</div>
					
					<div class="col-md-4 col-xs-12">
					<div class="box box-success graph-box">
						<div class="box-header">
							<i class="fa fa-briefcase"></i>
                            <h3 class="box-title">Employees by Types</h3>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="bar-chart3" style="height: 250px;"></div>
						</div>
						<!--<div class="box-footer clearfix table-responsive" style="background-color:#9A9A9A;">-->
						<!--	<table style="text-align:center" class="table table-striped">-->
						<!--		<thead>-->
						<!--			<tr>-->
						<!--				<th style="text-align:center">Types</th>-->
						<!--				<th style="text-align:center">Employees</th>-->
						<!--			</tr>-->
						<!--		</thead>-->
						<!--		<tbody>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">Permanent</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $permanental; ?></td>-->
						<!--			</tr>-->
						<!--			<tr>-->
						<!--				<td style="line-height:0.628571">Probation</td>-->
						<!--				<td style="line-height:0.628571"><?php echo $probation; ?></td>-->
						<!--			</tr>-->
						<!--		</tbody>-->
						<!--	</table>-->
						<!--</div>-->
					</div>
					<!--<div class="box box-solid notification-box">-->
					<!--	<div class="box-header" style="color:white;background-color:#2B2829;">-->
					<!--		<i class="fa fa-home"></i><h3 class="box-title">Holidays</h3>-->
					<!--		<div class="box-tools pull-right"><a href="GazettedHolidays.php"><i style="color:white">VIEW ALL</i></a></div>-->
					<!--	</div>-->
					<!--</div>-->
					<!--<hr style="background-color:black; height:2px;">-->
					</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-6" >
						<div class="box box-primary padding calendar-box" style="background-color:#445873;color:#c1c1c1">
						<div id="calendar" style="padding:5px"></div>
						</div>
						</div>
						<div class="col-md-6">
						    
						    <div class="box box-primary">
                                <div class="box-header">
                                   
                                </div>
                                <div class="box-body dashboard-square">
                                    
                                    
									<a style="border-radius: 10px !important; width:200px;" href="GetAttendanceLatest.php" class="btn bg-maroon bg-theme-color">
                                       Mark Attendance  <span>Press Me Please</span>
                                    </a>
                                    <a style="border-radius: 10px !important; width:200px;" href="CompanyPolicies.php" class="btn bg-maroon bg-theme-color">
                                        Company Policies <span>Explore Policies</span>
                                    </a>
                                    
                                   
                                </div><!-- /.box-body -->
                            </div>
							
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                                </div>
                                <div class="box-body dashboard-square">
                                    
                                    <!--<a href="Attendance.php" disabled class="btn btn-app bg-red">
                                        <i class="fa fa-calendar"></i> My Attendance
                                    </a>-->
                                    <a href="MyPaySlips.php" class="btn btn-app bg-purple bg-theme-color">
                                        <i class="fa fa-money"></i> <span>My PaySlips</span>
                                    </a>
                                    <a href="Documents.php" class="btn btn-app bg-blue bg-theme-color">
                                        <i class="fa fa-file-text-o"></i> <span>My Documents</span>
                                    </a>
                                    <a href="MyTrainings.php" class="btn btn-app bg-green bg-theme-color">
                                        <i class="fa fa-book"></i> <span>My Trainings </span>
                                    </a>
									<a href="MyProfile.php" class="btn btn-app bg-maroon bg-theme-color">
                                        <i class="fa fa-user"></i> <span>My Profile </span>
                                    </a>
                                    <a href="EmployeesInMySupervision.php" class="btn btn-app bg-maroon bg-theme-color">
                                        <i class="fa fa-users"></i> <span>In My Supervision </span>
                                    </a>
                                   
                                </div><!-- /.box-body -->
                            </div>
							<br>
							<div class="box box-solid annual-leaves-box" style="color:white;text-align:center">
                                <div class="box-header" style="background-color:#37122E;color:white;margin: -5px -15px 0 -15px;">
									<h4>My Annual Leaves</h4>
                                </div>
                                <div class="box-body">
                                    <table id="dataTable" class="table">
										<tr >
										  <td><b>Entitled</b></td>
										  <td><b>Taken</b></td>
										  <td><b>Balance</b></td>
										</tr>
										<tr>
										  <td><?php echo $Anual ; ?></td>
										  <td><?php //echo $TAnual ; ?>0</td>
										  <td><?php echo $CAnual ; ?></td>
										</tr>
									</table>
                                </div>
								<!--<div class="box-footer" style="background-color:#6E255C;color:white">-->
        <!--                            <button onclick="location.href='GetLeave.php'" style="background:none; border:1px #37122E solid;color:#000" class="btn btn-default btn-block btn-sm">Make a new leave request</button>-->
        <!--                        </div>-->
                            </div>
							<div class="box box-solid casual-leaves-box" style="color:white;text-align:center">
                                <div class="box-header" style="background-color:#6F2D22;color:white;margin: -5px -15px 0 -15px;">
                                    <h4>My Casual Leaves</h4>
                                </div>
                                <div class="box-body">
                                    <table id="dataTable" class="table">
										<tr >
										  <td><b>Entitled</b></td>
										  <td><b>Taken</b></td>
										  <td><b>Balance</b></td>
										</tr>
										<tr>
										  <td><?php echo $Casual ; ?></td>
										  <td><?php //echo $TCasual ; ?>0</td>
										  <td><?php echo $CCasual ; ?></td>
										</tr>
									</table>
                                </div>
								<!--<div class="box-footer" style="background-color:#EF6A4F;color:white">-->
        <!--                            <button onclick="location.href='GetLeave.php'" style="background:none; border:1px #6F2D22 solid;color:#6F2D22" class="btn btn-default btn-block btn-sm">Make a new leave request</button>-->
        <!--                        </div>-->
                            </div>
                            <div class="box box-solid casual-leaves-box" style="color:white;text-align:center">
                                <div class="box-header" style="background-color:#6F2D22;color:white;margin: -5px -15px 0 -15px;">
                                    <h4>My Sick Leaves</h4>
                                </div>
                                <div class="box-body">
                                    <table id="dataTable" class="table">
										<tr >
										  <td><b>Entitled</b></td>
										  <td><b>Taken</b></td>
										  <td><b>Balance</b></td>
										</tr>
										<tr>
										  <td><?php echo $Sick ; ?></td>
										  <td><?php //echo $TSick ; ?>0</td>
										  <td><?php echo $CSick ; ?></td>
										</tr>
									</table>
                                </div>
								<!--<div class="box-footer" style="background-color:#EF6A4F;color:white">-->
        <!--                            <button onclick="location.href='GetLeave.php'" style="background:none; border:1px #6F2D22 solid;color:#6F2D22" class="btn btn-default btn-block btn-sm">Make a new leave request</button>-->
        <!--                        </div>-->
                            </div>
                              
						</div>
					</div>
					
					
					
					
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- FLOT CHARTS -->       
		<script src="js/jquery.min.js"></script>
		<script src="js/moment.min.js"></script>

        <!-- jQuery 2.0.2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app2.js" type="text/javascript"></script>
		<script src="js/livestamp.js"></script>
		<script type="text/javascript">
            $(function() {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });

                    });
                }
                ini_events($('#external-events div.external-event'));

                /* initialize the calendar
                 -----------------------------------------------------------------*/
				 <?php 
				 $sql = "SELECT ID, Title,StartDate,EndDate,StartTime,EndTime,Color FROM events WHERE ID <> 0";
					$data = mysql_query($sql) or die(mysql_error());	
					$num = mysql_num_rows($data);
				 ?>
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                        m = date.getMonth(),
                        y = date.getFullYear();
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {//This is to add icons to the visible buttons
                        prev: "\<",
                        next: "\>",
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                    //Random default events
                    events: [
					<?php 
					while($row = mysql_fetch_array($data))
					{
					$StartDateAr = explode('/',$row['StartDate']);
					$StartDate = $StartDateAr[2].','.($StartDateAr[1]-1).','.$StartDateAr[0];
					$EndDateAr = explode('/',$row['EndDate']);
					$EndDate = $EndDateAr[2].','.($EndDateAr[1]-1).','.$EndDateAr[0];
					$StartTime = $row['StartTime'];
					$EndTime = $row['EndTime'];
					?>
					{
						title: "<?php echo dboutput($row['Title']);?>",
						start: new Date(<?php echo $StartDate;?>,<?php echo time_format_function($StartTime);?>),
						end: new Date(<?php echo $EndDate;?>,<?php echo time_format_function($EndTime);?>),
						allDay: false,
						backgroundColor: "<?php echo dboutput($row['Color']);?>", //red
						borderColor: "<?php echo dboutput($row['Color']);?>" //red
					}
					<?php

						$num--;

						if($num!=0)

						{

							echo ',';

						}

					}

					?>
                    ],
                    editable: false,
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    }
                });

            });
        </script>
        <script type="text/javascript">
            $(function() {
                "use strict";
                
                // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: '2018 Q1', item1: 10, item2: 5},
        {y: '2018 Q2', item1: 12, item2: 15},
        {y: '2018 Q3', item1: 4, item2: 5},
        {y: '2018 Q4', item1: 8, item2: 1},
        {y: '2019 Q1', item1: 6, item2: 3},
        {y: '2019 Q2', item1: 14, item2: 5},
        {y: '2019 Q3', item1: 7, item2: 14},
        {y: '2019 Q4', item1: 4, item2: 1},
        {y: '2020 Q1', item1: 8, item2: 4}
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2'],
      labels: ['Joinings', 'Resignations'],
      lineColors: ['#e9c51a', '#2484a8'],
      hideHover: 'auto'
    });
                
                //DONUT CHART
                var donut = new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#022667", "#EC5CA1"],
                    data: [
                        {label: "Male", value: <?php echo $male; ?>},
                        {label: "Female", value: <?php echo $female; ?>}
                    ],
                    hideHover: 'auto'
                });
				
				var donut = new Morris.Donut({
                    element: 'sales-chart2',
                    resize: true,
                    colors: ["#D3D3D3","#ACACAC","#8A8A8A","#595959","#353535"],
                    data: [
                        {label: "Below 20", value: <?php echo $_ageZeroTo20; ?>},
                        {label: "21 to 30", value: <?php echo $_age21to30; ?>},
						{label: "31 to 40", value: <?php echo $_age31to40; ?>},
                        {label: "41 to 50", value: <?php echo $_age41to50; ?>},
						{label: "50 Above", value: <?php echo $_age51toAbove; ?>}
                    ],
                    hideHover: 'auto'
                });
				
				var donut = new Morris.Donut({
                    element: 'sales-chart3',
                    resize: true,
                    colors: ["#0855ca", "#E08E0B"],
                    data: [
						{label: "Permanent", value: <?php echo $permanental; ?>},
                        {label: "Probation", value: <?php echo $probation; ?>}
                    ],
                    hideHover: 'auto'
                });
                
                 //BAR CHART
                var bar = new Morris.Bar({
                  element: 'bar-chart1',
                  resize: true,
                  data: [
                    {y: '2013', a: 100, b: 90},
                    {y: '2014', a: 75, b: 65},
                    {y: '2015', a: 50, b: 40},
                    {y: '2016', a: 75, b: 65},
                    {y: '2017', a: 50, b: 40},
                    {y: '2018', a: 75, b: 65},
                    {y: '2019', a: 100, b: 90}
                  ],
                  barColors: ['#0965cf', '#353535'],
                  xkey: 'y',
                  ykeys: ['a', 'b'],
                  labels: ['GROSS', 'PAYROLL'],
                  hideHover: 'auto'
                });
				
				 <?php 
				if($Department == "")
				{
				 
				 $sqlmf = "SELECT Department FROM departments WHERE ID <>0 AND Status = 1";
					$datamf = mysql_query($sqlmf) or die(mysql_error());	
					$nummf = mysql_num_rows($datamf);
				 ?>
				//BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
                        <?php 
					while($rowmf = mysql_fetch_array($datamf))
					{
					?>
					{y: '<?php echo dboutput($rowmf['Department']);?>', a: <?php echo total_males_in_department($rowmf['Department'],$Status);?>, b: <?php echo total_females_in_department($rowmf['Department'],$Status);?>}
					<?php
						$nummf--;
						if($nummf!=0)
						{
							echo ',';
						}
					}
					?>
                    ],
                    barColors: ['#405A78', '#F000BA'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Male', 'Female'],
                    hideHover: 'auto'
                });
				<?php
				}
				else
				{
				?>
				//BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
					{y: '<?php echo $Department;?>', a: <?php echo total_males_in_department($Department,$Status);?>, b: <?php echo total_females_in_department($Department,$Status);?>}
                    ],
                    barColors: ['#405A78', '#F000BA'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Male', 'Female'],
                    hideHover: 'auto'
                });
				<?php
				}
				?>
				
				
				
				// var bar = new Morris.Bar({
                    // element: 'bar-chart2',
                    // resize: true,
                    // data: [
                        // {y: 'HR', a: 100, b: 90, c:20, d: 90, e:20},
                        // {y: 'Information Technology', a: 75, b: 65, c:25, d: 90, e:20},
                        // {y: 'Research', a: 50, b: 40, c:30, d: 90, e:20},
                        // {y: 'Administrator', a: 75, b: 65, c:35, d: 90, e:20},
                        // {y: 'Marketing', a: 50, b: 40, c:40, d: 90, e:20}
						
                    // ],
                    // barColors: ['#00a65a', '#f56954', '#F000BA', '#405A78', '#22d5c9'],
                    // xkey: 'y',
                    // ykeys: ['a', 'b', 'c', 'd', 'e'],
                    // labels: ['Blow 20', '21 to 30', '31 to 40', '41 to 50', '50 Above'],
                    // hideHover: 'auto'
                // });
				<?php 
				if($Department == "")
				{
				 
				 $sqlage = "SELECT Department FROM departments WHERE ID <>0 AND Status = 1";
					$dataage = mysql_query($sqlage) or die(mysql_error());	
					$numage = mysql_num_rows($dataage);
				 ?>
				var bar = new Morris.Bar({
                    element: 'bar-chart2',
                    resize: true,
                    data: [
					<?php 
					while($rowage = mysql_fetch_array($dataage))
					{
					?>
					{y: '<?php echo dboutput($rowage['Department']);?>', a: <?php echo total_b20_in_department($rowage['Department'],$Status);?>, b: <?php echo total_b23_in_department($rowage['Department'],$Status);?>, c: <?php echo total_b34_in_department($rowage['Department'],$Status);?>, d: <?php echo total_b45_in_department($rowage['Department'],$Status);?>, e: <?php echo total_a50_in_department($rowage['Department'],$Status);?>}
					<?php
						$numage--;
						if($numage!=0)
						{
							echo ',';
						}
					}
					?>
						
                    ],
                    barColors: ['#00a65a', '#f56954', '#F000BA', '#405A78', '#22d5c9'],
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c', 'd', 'e'],
                    labels: ['Blow 20', '21 to 30', '31 to 40', '41 to 50', '50 Above'],
                    hideHover: 'auto'
                });
				<?php
				}
				else
				{
				?>
				var bar = new Morris.Bar({
                    element: 'bar-chart2',
                    resize: true,
                    data: [
                        {y: '<?php echo $Department;?>', a: <?php echo total_b20_in_department($Department,$Status);?>, b: <?php echo total_b23_in_department($Department,$Status);?>, c: <?php echo total_b34_in_department($Department,$Status);?>, d: <?php echo total_b45_in_department($Department,$Status);?>, e: <?php echo total_a50_in_department($Department,$Status);?>}
                    ],
                    barColors: ['#00a65a', '#f56954', '#F000BA', '#405A78', '#22d5c9'],
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c', 'd', 'e'],
                    labels: ['Blow 20', '21 to 30', '31 to 40', '41 to 50', '50 Above'],
                    hideHover: 'auto'
                });
				<?php
				}
				?>
				
				
				<?php 
				if($Department == "")
				{
				 
				 $sqltyp = "SELECT Department FROM departments WHERE ID <>0 AND Status = 1";
					$datatyp = mysql_query($sqltyp) or die(mysql_error());	
					$numtyp = mysql_num_rows($datatyp);
				?>
				var bar = new Morris.Bar({
                    element: 'bar-chart3',
                    resize: true,
                    data: [
					<?php 
					while($rowtyp = mysql_fetch_array($datatyp))
					{
					?>
					{y: '<?php echo dboutput($rowtyp['Department']);?>', a: <?php echo total_permanental_in_department($rowtyp['Department'],$Status);?>, b: <?php echo total_probation_in_department($rowtyp['Department'],$Status);?>}
					<?php
						$numtyp--;
						if($numtyp!=0)
						{
							echo ',';
						}
					}
					?>
                    ],
                    barColors: ['#00a65a', '#f56954'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Permanent', 'Probation'],
                    hideHover: 'auto'
                });
				<?php
				}
				else
				{
				?>
				//BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart3',
                    resize: true,
                    data: [
					{y: '<?php echo $Department;?>', a: <?php echo total_permanental_in_department($Department,$Status);?>, b: <?php echo total_probation_in_department($Department,$Status);?>}
                    ],
                    barColors: ['#00a65a', '#f56954'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Permanent', 'Probation'],
                    hideHover: 'auto'
                });
				<?php
				}
				?>
				
                
            });
        </script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->  
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
		<script src="js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="js/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
		<script type="text/javascript">
		$(document).keyup(function(e){
			if(e.keyCode == 13){
				if($('#msenger textarea').val().trim() == ""){
					$('#msenger textarea').val('');
				}else{
					$('#msenger textarea').attr('readonly', 'readonly');
					$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
					sendMsg();
				}		
			}
		});	

		$(document).ready(function() {
			$('#msg-min').focus();
			$('#msenger').submit(function(e){
				$('#msenger textarea').attr('readonly', 'readonly');
				$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
				sendMsg();
				e.preventDefault();	
			});
		});

		function sendMsg(){
			$.ajax({
				type: 'post',
				url: 'chatM.php?rq=new',
				data: $('#msenger').serialize(),
				dataType: 'json',
				success: function(rsp){
						$('#msenger textarea').removeAttr('readonly');
						$('#sb-mt').removeAttr('disabled');	// Enable submit button
						if(parseInt(rsp.status) == 0){
							alert(rsp.msg);
						}else if(parseInt(rsp.status) == 1){
							$('#msenger textarea').val('');
							$('#msenger textarea').focus();
							//$design = '<div>'+rsp.msg+'<span class="time-'+rsp.lid+'"></span></div>';
							$design = '<div class="float-fix">'+
											'<div class="m-rply">'+
												'<div class="msg-bg">'+
													'<div class="msgA">'+
														rsp.msg+
														'<div class="">'+
															'<div class="msg-time time-'+rsp.lid+'"></div>'+
															'<div class="myrply-i"></div>'+
														'</div>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>';
							$('#cstream').append($design);

							$('.time-'+rsp.lid).livestamp();
							$('#dataHelper').attr('last-id', rsp.lid);
							$('#chat').scrollTop($('#cstream').height());
						}
					}
				});
		}
		function checkStatus(){
			$fid = '<?php echo $fid; ?>';
			$mid = '<?php echo $myid; ?>';
			$.ajax({
				type: 'post',
				url: 'chatM.php?rq=msg',
				data: {fid: $fid, mid: $mid, lid: $('#dataHelper').attr('last-id')},
				dataType: 'json',
				cache: false,
				success: function(rsp){
						if(parseInt(rsp.status) == 0){
							return false;
						}else if(parseInt(rsp.status) == 1){
							getMsg();
						}
					}
				});	
		}

		// Check for latest message
		setInterval(function(){checkStatus();}, 200);

		function getMsg(){
			$fid = '<?php echo $fid; ?>';
			$mid = '<?php echo $myid; ?>';
			$.ajax({
				type: 'post',
				url: 'chatM.php?rq=NewMsg',
				data:  {fid: $fid, mid: $mid},
				dataType: 'json',
				success: function(rsp){
						if(parseInt(rsp.status) == 0){
							//alert(rsp.msg);
						}else if(parseInt(rsp.status) == 1){
							$design = '<div class="float-fix">'+
											'<div class="f-rply">'+
												'<div class="msg-bg">'+
													'<div class="msgA">'+
														rsp.msg+
														'<div class="">'+
															'<div class="msg-time time-'+rsp.lid+'"></div>'+
															'<div class="myrply-f"></div>'+
														'</div>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>';
							$('#cstream').append($design);
							$('#chat').scrollTop ($('#cstream').height());
							$('.time-'+rsp.lid).livestamp();
							$('#dataHelper').attr('last-id', rsp.lid);	
						}
					}
			});
		}
		</script>
		<script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [],
        datasets: [{
          backgroundColor: [
            "#75d164",
            "#e85f3d",
            "#658dd2"
          ],
          borderColor:[
          "#75d164",
          "#e85f3d",
          "#658dd2"
          ],
          data: [12, 19, 7]
        }]
      }
    });

    </script>
    <script>
      var ctx = document.getElementById("mypieChart").getContext('2d');
      var mypieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [],
        datasets: [{
          backgroundColor: [
            "#81b72b"
          ],
          borderColor:[
          '#abcb68',
          '#abcb68'
          ],
          data: [65, 19]
        }]
      }
    });
    </script>
    </body>
</html>