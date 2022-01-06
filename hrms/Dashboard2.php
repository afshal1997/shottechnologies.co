<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");
$Anual=0;
$Sick=0;
$CAnual=0;
$CSick=0;
$TAnual=0;
$TSick=0;
$query1="SELECT AnualLeaves,SickLeaves FROM leaves_quota  WHERE ID <>0 AND EmpID=".$_SESSION['UserID']." AND Approved = 1";
$res1 = mysql_query($query1) or die(mysql_error());
$num1 = mysql_num_rows($res1);
if($num1 == 1)
{
	$row1 = mysql_fetch_array($res1);
	$Anual=$row1['AnualLeaves'];
	$Sick=$row1['SickLeaves'];
	
	$query2="SELECT AnualLeaves,SickLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".$_SESSION['UserID']."";
	$res2 = mysql_query($query2) or die(mysql_error());
	$num2 = mysql_num_rows($res2);
	
	if($num2 == 1)
	{
		$row2 = mysql_fetch_array($res2);
		$CAnual=$row2['AnualLeaves'];
		$CSick=$row2['SickLeaves'];
		
		$TAnual = $Anual - $CAnual;
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

$query = "SELECT Count(*) as contractual FROM employees where EmpType = 'Contractual' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
$res = mysql_query($query);
$row = mysql_fetch_array($res);
$contractual = $row['contractual'];

$query = "SELECT Count(*) as permanental FROM employees where EmpType = 'Permanental' ".($Status != "" ? " AND Status ='".$Status."'" : '')." ".($Department != "" ? " AND Department ='".$Department."'" : '')."";
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
<link href="css/custom.css" rel="stylesheet" type="text/css" />
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
    <section class="content-header" style="height:200px;color:#fff;background:url(images/dashboard-back.png)">
      <h1> Dashboard <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php" style="color:#fff"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
                    <div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Dashboard Filters: </label>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
							  <select name="Department" id="Department" class="form-control">
								<option <?php echo ($Department == "" ? 'selected' : ''); ?> value="" >All Departments</option>
								<?php
								foreach($_DEPARTMENT as $departments)
								{
								echo '<option '.($Department == $departments ? 'selected' : '').' value="'.$departments.'">'.$departments.'</option>';
								} 
								?>
								</select>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <select name="Status" id="Status" class="form-control">
								<option <?php echo ($Status == "" ? 'selected' : ''); ?> value="" >All Employees</option>
								<option <?php echo ($Status == "Active" ? 'selected' : ''); ?> value="Active" >Active Employees</option>
								<option <?php echo ($Status == "Deactive" ? 'selected' : ''); ?> value="Deactive" >Deactive Employees</option>
								</select>
							</div> 
                        </div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
					</form>
                    </div><!-- /.row -->
					
					
					
					<div class="row">
						<div class="col-md-4">
                            <!-- DONUT CHART -->
                            <div class="box box-success">
                                <div class="box-header">
									<i class="fa fa-venus-mars"></i>
                                    <h3 class="box-title">Male to Female Employees Ratio</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart" style="height: 300px;background-color:#0AA699;"></div>
                                </div><!-- /.box-body -->
								<div class="box-footer clearfix table-responsive" style="background-color:#00D8C6;">
                                    <table style="text-align:center" class="table table-striped">
										<thead>
											<tr>
												<th style="text-align:center">Gender</th>
												<th style="text-align:center">Employees</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="line-height:0.628571">Male</td>
												<td style="line-height:0.628571"><?php echo $male; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">Female</td>
												<td style="line-height:0.628571"><?php echo $female; ?></td>
											</tr>
										</tbody>
									</table>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
							<div class="box box-solid bg-default">
                                <div class="box-header" style="color:black;background-color:#c1c1c1;">
                                    <i class="fa fa-bell-o"></i><h3 class="box-title">Notifications</h3>
									<div class="box-tools pull-right"><a href="#"><i>VIEW ALL</i></a></div>
                                </div>
                            </div>
							<hr style="background-color:black; height:2px;">
                        </div>
						<div class="col-md-4">
                            <!-- DONUT CHART -->
                            <div class="box box-info">
                                <div class="box-header">
									<i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Employees by Age Group</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart2" style="height: 300px;background-color:#0474AD;"></div>
                                </div><!-- /.box-body -->
								<div class="box-footer clearfix table-responsive" style="background-color:#4CB5EA;">
                                    <table style="text-align:center" class="table table-striped">
										<thead>
											<tr>
												<th style="text-align:center">Age</th>
												<th style="text-align:center">Employees</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="line-height:0.628571">Below 20</td>
												<td style="line-height:0.628571"><?php echo $_ageZeroTo20; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">21 to 30</td>
												<td style="line-height:0.628571"><?php echo $_age21to30; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">31 to 40</td>
												<td style="line-height:0.628571"><?php echo $_age31to40; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">41 to 50</td>
												<td style="line-height:0.628571"><?php echo $_age41to50; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">50 Above</td>
												<td style="line-height:0.628571"><?php echo $_age51toAbove; ?></td>
											</tr>
										</tbody>
									</table>
                                </div><!-- /.box-footer -->
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
                                    <div class="chart" id="sales-chart3" style="height: 300px;background-color:#735F87;"></div>
                                </div><!-- /.box-body -->
								<div class="box-footer clearfix table-responsive" style="background-color:#A980D2;">
                                    <table style="text-align:center" class="table table-striped">
										<thead>
											<tr>
												<th style="text-align:center">Types</th>
												<th style="text-align:center">Employees</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="line-height:0.628571">Permanental</td>
												<td style="line-height:0.628571"><?php echo $permanental; ?></td>
											</tr>
											<tr>
												<td style="line-height:0.628571">Contractual</td>
												<td style="line-height:0.628571"><?php echo $contractual; ?></td>
											</tr>
										</tbody>
									</table>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
							<div class="box box-solid">
                                <div class="box-header" style="color:black;background-color:#c1c1c1;">
                                    <i class="fa fa-home"></i><h3 class="box-title">Holidays</h3>
									<div class="box-tools pull-right"><a href="GazettedHolidays.php"><i>VIEW ALL</i></a></div>
                                </div>
                            </div>
							<hr style="background-color:black; height:2px;">
                        </div>
					</div>
					
					<div class="row">
						<div class="col-md-6" >
						<div class="box box-primary padding" style="background-color:#445873;color:#c1c1c1">
						<div id="calendar" style="padding:5px"></div>
						</div>
						</div>
						<div class="col-md-6">
							
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                                </div>
                                <div class="box-body">
                                    
                                    <a href="Attendance.php" class="btn btn-app bg-red">
                                        <i class="fa fa-calendar"></i> My Attendance
                                    </a>
                                    <a href="MyPayrolls.php" class="btn btn-app bg-purple">
                                        <i class="fa fa-money"></i> My Payrolls
                                    </a>
                                    <a href="Documents.php" class="btn btn-app bg-blue">
                                        <i class="fa fa-file-text-o"></i> My Documents
                                    </a>
                                    <a href="MyTrainings.php" class="btn btn-app bg-green">
                                        <i class="fa fa-book"></i> My Trainings 
                                    </a>
									<a href="MyTrainingResults.php" class="btn btn-app bg-yellow">
                                        <i class="fa fa-trophy"></i> My Training Results 
                                    </a>
									<a href="EmployeeProfile.php" class="btn btn-app bg-maroon">
                                        <i class="fa fa-user"></i> My Profile 
                                    </a>
                                   
                                </div><!-- /.box-body -->
                            </div>
							<br>
							<div class="box box-solid" style="background-color:#6E255C;color:white;text-align:center">
                                <div class="box-header" style="background-color:#37122E;color:white;">
									<h4>My Anual Leaves</h4>
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
										  <td><?php echo $TAnual ; ?></td>
										  <td><?php echo $CAnual ; ?></td>
										</tr>
									</table>
                                </div>
								<div class="box-footer" style="background-color:#6E255C;color:white">
                                    <button onclick="location.href='GetLeave.php'" style="background:none; border:1px #37122E solid;color:#000" class="btn btn-default btn-block btn-sm">Make a new leave request</button>
                                </div><!-- /.box-body -->
                            </div>
							<div class="box box-solid" style="background-color:#EF6A4F;color:white;text-align:center">
                                <div class="box-header" style="background-color:#6F2D22;color:white">
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
										  <td><?php echo $TSick ; ?></td>
										  <td><?php echo $CSick ; ?></td>
										</tr>
									</table>
                                </div>
								<div class="box-footer" style="background-color:#EF6A4F;color:white">
                                    <button onclick="location.href='GetLeave.php'" style="background:none; border:1px #6F2D22 solid;color:#6F2D22" class="btn btn-default btn-block btn-sm">Make a new leave request</button>
                                </div><!-- /.box-body -->
                            </div>
                              
						</div>
					</div>
					
					<!--
					<div class="row">
						<div class="col-md-6">
                           <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Employees by Departments</h3>
                                </div>
                                <div class="box-body">
                                    <div id="bar-chart" style="height: 300px;"></div>
                                </div>
                            </div>

                        </div>
						<div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Employees by Designations</h3>
                                </div>
                                <div class="box-body">
                                    <div id="bar-chart2" style="height: 300px;"></div>
                                </div>
                            </div>

                        </div>
					</div>
   
                   <div class="row">
                     
                        <section class="col-lg-12 connectedSortable">        
							
							
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Chat</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle" >
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    
                                    <div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                  
                                    <div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                                Jane Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                    
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Susan Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
									<div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                    
                                    <div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                                Jane Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                    
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Susan Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>

                                    <div class="pull-right box-tools">
										<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>         

                        </section>
                    </div>-->
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- FLOT CHARTS -->       
<script type="text/javascript">
            $(function() {
                "use strict";
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
                    colors: ["#00A65A", "#E08E0B"],
                    data: [
						{label: "Permanental", value: <?php echo $permanental; ?>},
                        {label: "Contractual", value: <?php echo $contractual; ?>}
                    ],
                    hideHover: 'auto'
                });
				
				var bar_data = {
                    data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 25]],
                    color: "#6EBB00",
                };
                $.plot("#bar-chart", [bar_data], {
                    grid: {
                        borderWidth: 1,
                        borderColor: "#f3f3f3",
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.5,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });
				
				var bar_data = {
                    data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
                    color: "#04936C"
                };
                $.plot("#bar-chart2", [bar_data], {
                    grid: {
                        borderWidth: 1,
                        borderColor: "#f3f3f3",
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.5,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });
                
            });
        </script>
		
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

        <!-- AdminLTE for demo purposes -->       
        <!-- fullCalendar -->
        <!-- Page specific script -->
        

    </body>
</html>