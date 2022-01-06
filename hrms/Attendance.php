<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$Month=0;
$Year=0;
if(isset($_REQUEST["Month"]))
		$Month=trim($_REQUEST["Month"]);
if(isset($_REQUEST["Year"]))
		$Year=trim($_REQUEST["Year"]);
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attendance</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
		include_once("Sidebar.php");

				$prev="";
				$next="";
				$nav="";
				$rowsPerPage=31;
				$pageNum=1;
				
				$DFrom="";
				$DTo="";
				$DateFrom="";
				$DateTo="";
				
				$Keywords="";
				
				$SortField=2;
				$SortType="ASC";
					
				$_SORT_FIELDS = array("DateAdded");
				
				if(isset($_REQUEST["Keywords"]))
					$Keywords = trim($_REQUEST["Keywords"]);

				if(isset($_REQUEST["PageIndex"]) && ctype_digit(trim($_REQUEST["PageIndex"])))
					$pageNum=trim($_REQUEST["PageIndex"]);

				$offset = ($pageNum - 1) * $rowsPerPage;
				$limit=" Limit ".$offset.", ".$rowsPerPage;
				
				$query="SELECT li.Status,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime FROM user_login_history li LEFT JOIN user_logout_history lo ON li.UserID = lo.UserID AND li.LoginDate = lo.LogoutDate WHERE li.UserID = ".(int)$_SESSION["UserID"]." AND DATE_FORMAT(li.LoginDate, '%m') = ".($Month != 0 ? $Month : "DATE_FORMAT(NOW(), '%m')")."  AND DATE_FORMAT(li.LoginDate, '%Y') = ".($Year != 0 ? $Year : "DATE_FORMAT(NOW(), '%Y')")."";
				
				
				$result = mysql_query ($query.$limit) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die("Could not select because: ".mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				if($maxRow > 0)
				{ 
					$maxPage = ceil($maxRow/$rowsPerPage);
					$nav  = '';
					if($maxPage>1)
					for($page = 1; $page <= $maxPage; $page++)
					{
						
					   if ($page == $pageNum)
						  $nav .= "&nbsp;<li class=\"active\"><a href='#'>$page</a></li >"; 
					   else
						  $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">$page</a> </li>";
					}
					
					if ($pageNum > 1)
					{
						$page  = $pageNum - 1;
						$prev  = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Previous</a> ";
						$first = "&nbsp;<a href=\"$self?PageIndex=1&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">First</a> ";
					} 
					else
					{
					   $prev  = ''; // we're on page one, don't print previous link
					   $first = '&nbsp;First'; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Next</a> ";
						$last = "&nbsp;<a href=\"$self?PageIndex=$maxPage&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Last Page</a> ";
					} 
					else
					{
					   $next = "";
					   $last = '&nbsp;Last'; // nor the last page link
					}
				}
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Attendance <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
            <!-- /.box-header -->
			<div class="row margin">
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> <?php echo get_my_attendance($Month,$Year,$_SESSION['UserID'],1);?></h3>
              <p> Attendance This Month</p>
            </div>
            <div class="icon"> <i class="ion ion-stats-bars"></i> </div>
            <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
        </div>
		<!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> <?php echo get_my_attendance($Month,$Year,$_SESSION['UserID'],2);?></h3>
              <p> On time</p>
            </div>
            <div class="icon"> <i class="ion ion-stats-bars"></i> </div>
            <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
        </div>
		<!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3> <?php echo get_my_attendance($Month,$Year,$_SESSION['UserID'],3);?></h3>
              <p> Late</p>
            </div>
            <div class="icon"> <i class="ion ion-stats-bars"></i> </div>
            <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
        </div>
		
        
        <!-- ./col -->
      </div>
			<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Date Filters: </label>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
							  <select name="Month" id="Month" class="form-control">
								<option <?php echo ($Month == "" ? 'selected' : ''); ?> value="" >Select Month</option>
								<?php
								$i=1;
								foreach($_MONTHS as $months)
								{
								echo '<option '.($Month == $i ? 'selected' : '').' value="'.$i.'">'.$months.'</option>';
								$i++;
								} 
								?>
								</select>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <select name="Year" id="Year" class="form-control">
								<option <?php echo ($Year == 0 ? 'selected' : ''); ?> value="" >Select Year</option>
								<?php
								for($i = date('Y'); $i >= 2010; $i--)
								{
								echo '<option '.($i == $Year ? 'selected' : '').' value="'.$i.'">'.$i.'</option>';
								} 
								?>
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
            <div class="box-body table-responsive">
              <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
			
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Date</th>
                      <th>Day</th>
					  <th>Arrival Time</th>
                      <th>Depart Time</th>
					  <th>Total Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Attandence listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
		?>
                    <tr>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row["Date"]); ?></td>
					  <td><?php echo dboutput($row["Day"]); ?></td>
					  <td><?php echo dboutput($row["ArrivalTime"]); ?></td>
					  <td><?php echo (dboutput($row["DepartTime"]) == NULL ? 'You have not logged out' : dboutput($row["DepartTime"])); ?></td>
					  <td>
					  <?php
						list($hours, $minutes) = explode(':', $row["ArrivalTime"]);
						$startTimestamp = mktime($hours, $minutes);

						list($hours, $minutes) = explode(':', $row["DepartTime"]);
						$endTimestamp = mktime($hours, $minutes);

						$seconds = $endTimestamp - $startTimestamp;
						$minutes = ($seconds / 60) % 60;
						$hours = floor($seconds / (60 * 60));

						echo "<b>$hours</b> hours and <b>$minutes</b> minutes";
					  ?>
					  </td>
					  <td><?php echo dboutput($row["Status"]); ?></td>
                    </tr>
                    <?php				
				}
			} 
		?>
                  </tbody>
                </table>
              </form>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <!--<div class="dataTables_info" id="example2_info"> Total <?php //echo $maxRow;?> entries </div>-->
              </div>
              <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php echo $prev;?> </li>
                    <?php
					echo $nav;
					?>
                    <li class="next"> <?php echo $next;?> </li>
                  </ul>
                </div>
              </div>
            </div>
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

</body>
</html>
