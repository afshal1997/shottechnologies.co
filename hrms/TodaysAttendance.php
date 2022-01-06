<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
// if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
// {}else{redirect("Dashboard.php");}
$UserID = $_SESSION['UserID'];
$Schedule = 2;
$Department = "";
$DepartmentID = [];
$SubDepartment = "";
$AttendanceStatus = "";
$Month=date('m');
$Year=date('Y');
$Day=date('d');
if(isset($_REQUEST["Month"]))
		$Month=trim($_REQUEST["Month"]);
if(isset($_REQUEST["Year"]))
		$Year=trim($_REQUEST["Year"]);
if(isset($_REQUEST["Day"]))
		$Day=trim($_REQUEST["Day"]);
if(isset($_REQUEST["Department"])){
	$Department=trim($_REQUEST["Department"]);
	$DepartmentID = explode('_',$Department);
	$Department = $DepartmentID[0];
}
if(isset($_REQUEST["AttendanceStatus"]))
		$AttendanceStatus=trim($_REQUEST["AttendanceStatus"]);	
if(isset($_REQUEST["SubDepartment"]))
		$SubDepartment=trim($_REQUEST["SubDepartment"]);
if(isset($_REQUEST["Schedule"]))
		$Schedule=trim($_REQUEST["Schedule"]);
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];

$PrintDate=date("jS M Y", mktime(0,0,0,$Month,$Day,$Year));
$PrintDay=date("l", mktime(0,0,0,$Month,$Day,$Year));
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
  <script src="internetfiles/html5shiv.js"></script>
  <script src="internetfiles/respond.min.js"></script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
		
		$("#Department").change(function () {
			
			$.ajax({			
					url: 'get_sub_departments.php?depid='+$("#Department").val(),
					success: function(data) {
						$("#SubDepartment").html(data);
					},
					error: function (xhr, textStatus, errorThrown) {
						alert(xhr.responseText);
						//$("#SubDepartment").removeAttr("disabled");
					}
			});

		});		
		
		
	});   

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

				$prev="";
				$next="";
				$nav="";
				$rowsPerPage=100;
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
				
				$query="SELECT sb.SubDepartment,s.LateArrival,s.ArrivalHalfDay,s.DepartHalfDay,s.EarlyDepart,li.Status,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.Supervisor FROM user_login_history li LEFT JOIN user_logout_history lo ON li.UserID = lo.UserID AND li.ActualDate = lo.ActualDate LEFT JOIN employees e ON li.UserID = e.ID LEFT JOIN schedules s ON e.ScheduleID = s.ID LEFT JOIN subdepartments sb ON e.SubDepartment = sb.ID WHERE DATE_FORMAT(li.ActualDate, '%d') = ".($Day != 0 ? $Day : "DATE_FORMAT(NOW(), '%d')")." AND DATE_FORMAT(li.ActualDate, '%m') = ".($Month != 0 ? $Month : "DATE_FORMAT(NOW(), '%m')")."  AND DATE_FORMAT(li.ActualDate, '%Y') = ".($Year != 0 ? $Year : "DATE_FORMAT(NOW(), '%Y')")." ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($SubDepartment != "" ? ' AND e.SubDepartment = '.$SubDepartment.'' : '')." ".($Schedule != "2" ? ' AND e.ScheduleID IN (SELECT ID from schedules WHERE DayNight = '.$Schedule.') ' : '')." ".($_SESSION['RoleID'] != "Administrator" && $_SESSION['RoleID'] != "HR" ? ' AND (e.EmpID = ' .$UserID.' OR e.Supervisor = ' .$UserID.')' : '')."";
				
				//echo $query; exit();
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
      <h1>Todays Attendance <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Todays Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
            <!-- /.box-header -->
		
			<div class="row margin no-print">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-1 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Filters: </label>
							</div>
                        </div>
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
							<select name="Department" id="Department" class="form-control">
							<option value="" <?php echo ($Department == '' ? 'selected' : ''); ?> >All Departments</option>
							<?php
							$i=0;
							foreach($_DEPARTMENT as $Departments)
							{
							echo '<option '.($Department == $Departments ? 'selected' : '').' value="'.$Departments.'_'.$_DEPARTMENTID[$i].'">'.$Departments.'</option>';
							$i++;
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
							<select name="SubDepartment" id="SubDepartment" class="form-control">
							<option value="" <?php echo ($SubDepartment == '' ? 'selected' : ''); ?> >All SubDepartments</option>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-1 col-xs-12">
							<div class="form-group">
							<select name="AttendanceStatus" id="AttendanceStatus" class="form-control">
							<option value="" <?php echo ($AttendanceStatus == '' ? 'selected' : ''); ?> >All Status</option>
							<option value="On-Time" <?php echo ($AttendanceStatus == 'On-Time' ? 'selected' : ''); ?> >On-Time</option>
							<option value="Late-In" <?php echo ($AttendanceStatus == 'Late-In' ? 'selected' : ''); ?> >Late-In</option>
							<option value="Early Out" <?php echo ($AttendanceStatus == 'Early Out' ? 'selected' : ''); ?> >Early Out</option>
							<option value="Late-In/Early Out" <?php echo ($AttendanceStatus == 'Late-In/Early Out' ? 'selected' : ''); ?> >Late-In/Early Out</option>
							<option value="Half Day" <?php echo ($AttendanceStatus == 'Half Day' ? 'selected' : ''); ?> >Half Day</option>
							<option value="Late-In/Half Day" <?php echo ($AttendanceStatus == 'Late-In/Half Day' ? 'selected' : ''); ?> >Late-In/Half Day</option>
							<option value="Half Day/Early Out" <?php echo ($AttendanceStatus == 'Half Day/Early Out' ? 'selected' : ''); ?> >Half Day/Early Out</option>
							<option value="Absent" <?php echo ($AttendanceStatus == 'Absent' ? 'selected' : ''); ?> >Absent</option>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-1 col-xs-12">
							<div class="form-group">
							<select name="Schedule" id="Schedule" class="form-control">
							<option value="2" <?php echo ($Schedule == '2' ? 'selected' : ''); ?> >All Shifts</option>
							<option value="0" <?php echo ($Schedule == '0' ? 'selected' : ''); ?> >Day</option>
							<option value="1" <?php echo ($Schedule == '1' ? 'selected' : ''); ?> >Night</option>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-1 col-xs-12">
							<div class="form-group">
							  <select name="Day" id="Day" class="form-control">
								<option <?php echo ($Day == "" ? 'selected' : ''); ?> value="" >Select Day</option>
									<?php
									for($i=1;$i<=31;$i++)
									{
									echo '<option '.($Day == $i ? 'selected' : '').' value="'.$i.'">'.$i.'</option>';
									} 
									?>
								</select>
							</div>
						</div>
                        <div class="col-lg-1 col-xs-12">
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
                        </div>
                        <div class="col-lg-1 col-xs-12">
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
                        </div>
						<div class="col-lg-1 col-xs-12">
							<a class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</a>
						 
                        </div>
						<div class="col-lg-1 col-xs-12">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div>
					</form>
            </div>
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
                <table id="dataTable" class="table table-bordered table-striped" id="tblExport">
                  <thead>
                    <tr>
					  <th>S.No</th>
                      <th>Employee</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Sub Department</th>
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
			$c = 1;
		?>
                    <!--<tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Attandence listed.</b></td>
                    </tr>-->
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$c=1;
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
				  $attStatus = '';
				  $attStatusLateIn = 0;
				  $attStatusArrHalf = 0;
				  $attStatusEarlyOut = 0;
				  $attStatusDepHalf = 0;
				  if($row["ArrivalTime"] > $row["LateArrival"]){
				  	$attStatusLateIn = 1;
				  }
				  if($row["ArrivalTime"] > $row["ArrivalHalfDay"]){
				  	$attStatusArrHalf = 1;
				  }
				  if(isset($row["DepartTime"]) && $row["DepartTime"] < $row["EarlyDepart"]){
				  	$attStatusEarlyOut = 1;
				  }
				  if(isset($row["DepartTime"]) && $row["DepartTime"] < $row["DepartHalfDay"]){
				  	$attStatusDepHalf = 1;
				  }

				  if($attStatusLateIn == 1 && $attStatusDepHalf == 1)
				  {
				  	$attStatus = 'Late-In/Half Day';
				  }
				  else if($attStatusLateIn == 1 && $attStatusEarlyOut == 1)
				  {
				  	$attStatus = 'Late-In/Early Out';
				  }
				  else if($attStatusLateIn == 1)
				  {
				  	$attStatus = 'Late-In';
				  }
				  else if($attStatusArrHalf == 1 && $attStatusDepHalf == 1)
				  {
				  	$attStatus = 'Half Day';
				  }
				  else if($attStatusArrHalf == 1 && $attStatusEarlyOut == 1)
				  {
				  	$attStatus = 'Half Day/Early Out';
				  }
				  else if($attStatusEarlyOut == 1)
				  {
				  	$attStatus = 'Early Out';
				  }
				  else if($attStatusArrHalf == 1)
				  {
				  	$attStatus = 'Half Day';
				  }
				  else if($attStatusDepHalf == 1)
				  {
				  	$attStatus = 'Half Day';
				  }
				  else if($row["Date"] > $PrintDate)
				  {
				  	$attStatus = 'Half Day';
				  }
				  else
				  {
				  	$attStatus = 'On-Time';
				  }
		?>
                    <tr <?php echo ($AttendanceStatus <> '' ? ($AttendanceStatus == $attStatus ? '' : 'style="display:none;"') : ''); ?>>
					  <td><?php echo $c; ?></td>
					  <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <td><?php echo dboutput($row["Designation"]); ?></td>
					  <td><?php echo dboutput($row["Department"]); ?></td>
					  <td><?php echo dboutput($row["SubDepartment"]); ?></td>
					  <td><?php echo dboutput($row["Date"]); ?></td>
					  <td><?php echo dboutput($row["Day"]); ?></td>
					  <td><?php echo dboutput($row["ArrivalTime"]); ?></td>
					  <td><?php echo (dboutput($row["DepartTime"]) == NULL ? 'Not Yet Logged Out' : dboutput($row["DepartTime"])); ?></td>
					  <td>
					  <?php
					  if(dboutput($row["DepartTime"]) == NULL)
					  {
						echo "<b>0</b> hours and <b>0</b> minutes";
					  }
					  else
					  {
						list($hours, $minutes) = explode(':', $row["ArrivalTime"]);
						$startTimestamp = mktime($hours, $minutes);

						list($hours, $minutes) = explode(':', $row["DepartTime"]);
						$endTimestamp = mktime($hours, $minutes);
						
						$newTimestamp1 = mktime(00, 00);
						$newTimestamp2 = mktime(23, 59);
                        
                        if($endTimestamp < $startTimestamp)
                        {
                             $seconds2=0;
    	                     $seconds =  $endTimestamp - $newTimestamp1;
    						 $seconds2 =  $newTimestamp2 - $startTimestamp;
    						 $seconds2 = abs($seconds2);
    						 $seconds = $seconds + $seconds2;
    						 $seconds += 60;
                        }
                        else
                        {
                            $seconds = $endTimestamp - $startTimestamp;
                        }
						
						$minutes = ($seconds / 60) % 60;
						$hours = floor($seconds / (60 * 60));

						echo "<b>$hours</b> hours <b>$minutes</b> minutes";
						
						if($hours < 9)
						{
						    $attStatus .= '/Short Time';
						}
					  }
					  ?>
					  </td>
					  <td><?php echo $attStatus; ?></td>
                    </tr>
                    <?php	
					$c++;
				}
			} 
			$query2="SELECT sb.SubDepartment,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.Supervisor FROM employees e LEFT JOIN subdepartments sb ON e.SubDepartment = sb.ID WHERE e.Status = 'Active' ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($SubDepartment != "" ? ' AND e.SubDepartment = '.$SubDepartment.'' : '')." ".($_SESSION['RoleID'] != "Administrator" && $_SESSION['RoleID'] != "HR" ? ' AND (e.EmpID = ' .$UserID.' OR e.Supervisor = ' .$UserID.')' : '')." ".($Schedule != "2" ? ' AND e.ScheduleID IN (SELECT ID from schedules WHERE DayNight = '.$Schedule.') ' : '')." AND e.ID NOT IN (SELECT li.UserID FROM user_login_history li WHERE DATE_FORMAT(li.ActualDate, '%d') = ".($Day != 0 ? $Day : "DATE_FORMAT(NOW(), '%d')")." AND DATE_FORMAT(li.ActualDate, '%m') = ".($Month != 0 ? $Month : "DATE_FORMAT(NOW(), '%m')")."  AND DATE_FORMAT(li.ActualDate, '%Y') = ".($Year != 0 ? $Year : "DATE_FORMAT(NOW(), '%Y')").")";
			$result2 = mysql_query ($query2) or die(mysql_error()); 
			$num2 = mysql_num_rows($result2);
		?>
		<?php
			if($num2==0)
			{
		?>
                    <!--<tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Attandence listed.</b></td>
                    </tr>-->
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$c=$c;
				while($row = mysql_fetch_array($result2,MYSQL_ASSOC))
				{
		?>
                    <tr <?php echo ($AttendanceStatus <> '' ? ($AttendanceStatus == 'Absent' ? '' : 'style="display:none;"') : ''); ?>>
					  <td><?php echo $c; ?></td>
					  <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <td><?php echo dboutput($row['Designation']); ?></td>
					  <td><?php echo dboutput($row['Department']); ?></td>
					  <td><?php echo dboutput($row['SubDepartment']); ?></td>
					  <td><?php echo $PrintDate; ?></td>
					  <td><?php echo $PrintDay; ?></td>
					  <td>Login Not Found</td>
					  <td>Logout Not Found</td>
					  <td><b>0</b> hours and <b>0</b> minutes</td>
					  <td>Absent</td>
                    </tr>
                    <?php	
					$c++;
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
<script src="excel/jquery.btechco.excelexport.js"></script>
<script src="excel/jquery.base64.js"></script>
<script src="excel/secure_download.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
            });
        });
    });
</script>
</body>
</html>
