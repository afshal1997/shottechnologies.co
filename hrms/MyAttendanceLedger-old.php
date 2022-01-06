<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$TotalDays = 0;
$TotalPresent = 0;
$TotalAbsent = 0;
$TotalOffDays = 0;
$TotalLeaves = 0;
$TotalHalfdays = 0;
$TotalLates = 0;
$TotalEarlyDepart = 0;
$TotalHours = 0;
$TotalMinutes = 0;
$TotalWorkingHours = 0;
$TotalWorkingMinutes = 0;
$TotalOvertimeHours = 0;
$TotalOvertimeMinutes = 0;


	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];

if($action == "GrantLeaves")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["LeaveAdjustRequest"]=$_REQUEST["ids"];
			redirect("LeaveAdjustRequest.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Request for Leave Adjust.</b>
			</div>';
		}
	}
	$_SESSION["LeaveAdjustRequest"]="";

if($action == "TimeAdjust")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["TimeAdjustRequest"]=$_REQUEST["ids"];
			redirect("TimeAdjustRequest.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Request for Time Adjust.</b>
			</div>';
		}
	}
	$_SESSION["TimeAdjustRequest"]="";
?>


<?php
$CompanyID=$_SESSION['MyCompany'];
$Location=$_SESSION['MyLocation'];
$Designation=$_SESSION['MyDesignation'];
$Department=$_SESSION['MyDepartment'];
$Employee=$_SESSION['UserID'];
$SortBy="e.EmpID";
$SortType="";

// $LoginTime="11:30:00";
// $ArrivalHalfDay="11:30:00";

// if($LoginTime > $ArrivalHalfDay)	
// {
	// echo 'HalfDay';
// }
// else
// {
	// echo 'At Time';
// }
					
// exit();					


$Legends = 0;

$startdate = "";
$Roster = array();
$RosterString = "";		

$TillDate=date("d-m-Y");

if($TillDate > date("25-m-Y"))
{
$FromDate=date("26-m-Y");
}
else
{
$d=strtotime("-1 Months");
// echo date("Y-m-d", $d);		
$FromDate=date("26-m-Y", $d);
}
			




if(isset($_REQUEST["SortBy"]))
		$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["SortType"]))
		$SortType=trim($_REQUEST["SortType"]);
if(isset($_REQUEST["Legends"]))
		$Legends=trim($_REQUEST["Legends"]);
	
if(isset($_REQUEST["FromDate"]))
		$FromDate=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
		$TillDate=trim($_REQUEST["TillDate"]);

	// echo $FromDate;
	// exit();

$hours=0; 
$minutes=0;	

$LeaveDays = array();
$OffDay = "";
$ApplyAfter = "";

$Month=0;
$Year=0;
$Day=0;
if(isset($_REQUEST["Month"]))
		$Month=trim($_REQUEST["Month"]);
if(isset($_REQUEST["Year"]))
		$Year=trim($_REQUEST["Year"]);
if(isset($_REQUEST["Day"]))
		$Day=trim($_REQUEST["Day"]);
	// $action = "";
	// $msg = "";
	// if(isset($_POST["action"]))
		// $action = $_POST["action"];
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>My Attendance</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
	
	function GrantLeaves()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Adjust Leaves."))
			{
				$("#action").val("GrantLeaves");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Adjust Leaves");
	}
	
	function TimeAdjust()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Adjust Time."))
			{
				$("#action").val("TimeAdjust");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Adjust Time");
	}
	
</script>
<!--<script>
$("#bottomMenu").hide();
$(window).scroll(function() {
    if ($(window).scrollTop() > 400) {
        $("#bottomMenu").fadeIn("slow");
    }
    else {
        $("#bottomMenu").fadeOut("fast");
    }
});
</script>-->
<script>
;(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="containerss" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };
})(jQuery);

$(document).ready(function(){
   $("table").fixMe();
   $(".up").click(function() {
      $('html, body').animate({
      scrollTop: 0
   }, 2000);
 });
});
</script>



<script>
  $(function() {
    var availableTags = [
		<?php
		 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
		$res = mysql_query($query);
		while($row = mysql_fetch_array($res))
		{
		echo '"'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].'",';
		} 
		?>
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
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
<body class="skin-blue attendance-pg-wrap">
<!--<div id="bottomMenu">
<table id="" class="table table-bordered" style="">
                  <thead>
                    <tr>
					  <th style="width:40px !important;">S#</th>
                      <th style="text-align:center; width:30px !important;"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th style=" !important;">Employee</th>
					  <th style="width:98px !important;">Date</th>
					  <th style="width:75px !important;">Time In</th>
                      <th style="width:75px !important;">Time Out</th>
					  <th style="width:78px !important;">Modified<br>Time In</th>
                      <th style="width:79px !important;">Modified<br>Time Out</th>
					  <th style="width:49px !important;">Late<br>Arr</th>
					  <th style="width:52px !important;">Early<br>Dep</th>
					  <th style="width:76px !important;">Working<br>Hours</th>
					  <th style="width:80px !important;">Overtime</th>
					  <th style="width:98px !important;">Modified<br>Remarks</th>
					  <th style="width:78px !important;">Remarks</th>
                    </tr>
                  </thead>
                  </table>
</div>-->
<!-- header logo: style can be found in header.less -->
<?php
	include_once("Header.php");
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
		include_once("Sidebar.php");
?>		
		
<?php
				// $query="SELECT FromDate,NumOfDays,What FROM roster WHERE ID <> 0 ORDER BY FromDate ASC";
				// $result = mysql_query ($query) or die(mysql_error()); 
				// while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				// {
					// $startdate=strtotime($row['FromDate']);
					// for($i=0;$i<$row['NumOfDays'];$i++)
					// {
						// echo '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.date("Y-m-d", $startdate)." | ".$row['What']."<br>";
						// $startdate = strtotime("+1 day", $startdate);
					// }
				// }
				
				$query="SELECT FromDate,NumOfDays,What FROM roster WHERE ID <> 0 ORDER BY FromDate ASC";
				$result = mysql_query ($query) or die(mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
					$startdate=strtotime($row['FromDate']);
					for($i=0;$i<$row['NumOfDays'];$i++)
					{
						$Roster[] = date("Y-m-d", $startdate);
						$startdate = strtotime("+1 day", $startdate);
					}
				}
				sort($Roster);
				
				$RosterString = implode(',',$Roster);
				
				// echo $RosterString;
				// exit();
				
				// print_r($Roster);
				// exit();

				
				//$query="SELECT li.Status,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.LoginDate = lo.LogoutDate LEFT JOIN employees e ON li.UserID = e.ID WHERE DATE_FORMAT(li.LoginDate, '%d') = ".($Day != 0 ? $Day : "DATE_FORMAT(NOW(), '%d')")." AND DATE_FORMAT(li.LoginDate, '%m') = ".($Month != 0 ? $Month : "DATE_FORMAT(NOW(), '%m')")."  AND DATE_FORMAT(li.LoginDate, '%Y') = ".($Year != 0 ? $Year : "DATE_FORMAT(NOW(), '%Y')")." ".($CompanyID != "" ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != "" ? ' AND e.Location = '.$Location.'' : '')." ".($Designation != "" ? ' AND e.Designation = \''.$Designation.'\'' : '')." ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($SortBy != "" ? ' ORDER BY '.$SortBy.' ASC' : '')." ";
				
				
				// $query="SELECT li.Status,li.LoginDate AS CheckDate ,
				// DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.LoginDate = lo.LogoutDate LEFT JOIN employees e ON li.UserID = e.ID WHERE (li.LoginDate BETWEEN '".$FromDate."' AND '".$TillDate."') ".($CompanyID != "" ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != "" ? ' AND e.Location = '.$Location.'' : '')." ".($Designation != "" ? ' AND e.Designation = \''.$Designation.'\'' : '')." ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($SortBy != "" ? ' ORDER BY '.$SortBy.' ASC' : '')." ";
				
				$query="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,
				DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,sh.LateArrival,sh.EarlyDepart,sh.DepartTime AS Depart,sh.Name AS ScheduleName,sh.ArrivalTime AS ScheduleArrivalTime,sh.DepartTime AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND (li.DateAdded BETWEEN '".date_format_Ymd($FromDate)."' AND '".date_format_Ymd($TillDate)."') ".($CompanyID != "" ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != "" ? ' AND e.Location = '.$Location.'' : '')." ".($Designation != "" ? ' AND e.Designation = \''.$Designation.'\'' : '')." ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($SortType != "" ? ' AND li.Status = \''.$SortType.'\'' : '')." ".($SortBy != "" ? ' ORDER BY '.$SortBy.',li.DateAdded,e.EmpID ASC' : '')." ";
				
				// AND (li.LoginDate BETWEEN '".$FromDate."' AND '".$TillDate."')
				// DATE_FORMAT(sh.ArrivalTime, '%h:%i %p') AS ScheduleArrival,DATE_FORMAT(sh.DepartTime, '%h:%i %p') AS ScheduleDepart,
				
				//AND li.LoginDate IN ('".$RosterString."') 
				// echo $query;
				// exit();
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>My Attendance <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info" style="padding:5px;">
          <br>
            <!-- /.box-header -->
		
			<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Attendance Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							From:
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								 <input type="text" id="FromDate" name="FromDate" class="form-control"  <?php echo 'value="'.$FromDate.'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask/>
							</div>
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
							<div class="form-group">
							Till:
							 <div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								 <input type="text" id="TillDate" name="TillDate" class="form-control"  <?php echo 'value="'.$TillDate.'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask/>
							</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($SortBy == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($SortBy == 'li.LoginDate' ? 'selected' : ''); ?> value="li.LoginDate">Date</option>
								<option <?php echo ($SortBy == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($SortBy == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($SortBy == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($SortBy == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($SortBy == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort Type:
							 <select name="SortType" id="SortType" class="form-control">
								<option value="">All</option>
								<option <?php echo ($SortType == 'Present' ? 'selected' : ''); ?> value="Present">Present</option>
								<!--<option <?php //echo ($SortType == 'Late' ? 'selected' : ''); ?> value="Late">Late Arrival</option>
								<option <?php //echo ($SortType == 'Early Departure' ? 'selected' : ''); ?> value="Early Departure">Early Departure</option>
								<option <?php //echo ($SortType == 'Halfday' ? 'selected' : ''); ?> value="Halfday">Halfday</option>-->
								<option <?php echo ($SortType == 'Leave' ? 'selected' : ''); ?> value="Leave">Leave</option>
								<option <?php echo ($SortType == 'Off Day' ? 'selected' : ''); ?> value="Off Day">Offday</option>
								<option <?php echo ($SortType == 'Absent' ? 'selected' : ''); ?> value="Absent">Absent</option>
								<!--<option <?php //echo ($SortType == 'Overtime' ? 'selected' : ''); ?> value="Overtime">Overtime</option>-->
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							  Company:
							  <select disabled name="CompanyID" id="CompanyID" class="form-control">
								<option value="">All Companies</option>
								<?php
								 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($CompanyID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Location:
							<select disabled name="Location" id="Location" class="form-control">
							<option value="" >All Locations</option>
							<?php
							$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Location == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Designation:
							<select disabled name="Designation" id="Designation" class="form-control">
							<option value="" >All Designations</option>
							<?php
							foreach($_DESIGNATION as $designations)
							{
							echo '<option '.($Designation == $designations ? 'selected' : '').' value="'.$designations.'">'.$designations.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Department:
							<select disabled name="Department" id="Department" class="form-control">
							<option value="" >All Departments</option>
							<?php
							foreach($_DEPARTMENT as $departments)
							{
							echo '<option '.($Department == $departments ? 'selected' : '').' value="'.$departments.'">'.$departments.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
                        
                       <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
						 Employee:
						<select disabled name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
                       <!-- <div class="ui-widget">
                        Employee:
                        <input class="form-control" id="tags">
						</div>-->
						</div>
						
					   </div>
                        
                        
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  <input type="checkbox" <?php echo ($Legends == 1 ? ' checked="checked"' : ''); ?> value="1" name="Legends"> Show These Legends:<br>
						<i style="width:10px;height:10px;border:1px black solid;background-color:white">&emsp;&nbsp;</i> Present
						<i style="width:10px;height:10px;border:1px black solid;background-color:red">&emsp;&nbsp;</i> Absent
						<i style="width:10px;height:10px;border:1px black solid;background-color:yellow">&emsp;&nbsp;</i> Leave
						<i style="width:10px;height:10px;border:1px black solid;background-color:lightgreen">&emsp;&nbsp;</i> Late<div style=
						"height:2px"></div>
						<i style="width:10px;height:10px;border:1px black solid;background-color:#c1c1c1">&emsp;&nbsp;</i> Modified
						<i style="width:10px;height:10px;border:1px black solid;background-color:pink">&emsp;&nbsp;</i> Off Day&thinsp;
						<i style="width:10px;height:10px;border:1px black solid;background-color:lightblue">&emsp;&nbsp;</i> Half Day
						
						</div>
						</div><!-- ./col -->
						
                        
						<div class="col-lg-3 col-xs-12 no-print">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			
			<div class="box-footer no-print" style="text-align:right;">
               <!-- <button disabled type="submit" class="btn btn-default margin">Present</button>
				<button disabled type="submit" class="btn btn-danger margin">Absent</button>-->
				<button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
				<!--<button type="button" onClick="javascript:TimeAdjust()" class="btn btn-white margin no-print">Time Adjust Request</button>-->
				<!--<button type="button" onClick="javascript:GrantLeaves()" class="btn btn-warning margin no-print">Leave Adjust Request</button>-->
				<!--<button disabled type="submit" class="btn bg-navy margin">Cancle Off Day</button>--
				>
                <!--<button class="btn btn-primary margin" type="button" onClick="location.href='Employees.php'">Cancel</button>-->
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
                
  
                  
		 
              <table class="blue table table-bordered">
                  <thead class="">
                    <tr style="color:white;">
					  <th>S#</th>
                      <th style="text-align:center;"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Date</th>
					  <th>Time In</th>
                      <th>Time Out</th>
					  <th>Modified<br>Time In</th>
                      <th>Modified<br>Time Out</th>
					  <th>Schedule</th>
					  <th class="no-print">Late<br>Arr</th>
					  <th class="no-print">Early<br>Dep</th>
					  <th>Working<br>Hours</th>
					  <th>Overtime</th>
					  <th>Modified<br>Remarks</th>
					  <th>Remarks</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="20" align="center" class="error"><b>No Attandence listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$i=1;
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
					if (in_array(''.$row['CheckDate'].'', $Roster, TRUE))
					{
					
					$TotalDays = $TotalDays + 1;
					if($row["Status"] == 'Present')
					{
						$TotalPresent = $TotalPresent + 1;
					}
					if($row["Status"] == 'Absent')
					{
						$TotalAbsent = $TotalAbsent + 1;
					}
					if($row["Status"] == 'Off Day')
					{
						$TotalOffDays = $TotalOffDays + 1;
					}
					if($row["Status"] == 'Leave')
					{
						$TotalLeaves = $TotalLeaves + 1;
					}
					if($row["HalfDay"] == 1)
					{
						$TotalHalfdays = $TotalHalfdays + 1;
					}
					if($row["Late"] == 1)
					{
						$TotalLates = $TotalLates + 1;
					}
					if($row["EarlyDep"] == 1)
					{
						$TotalEarlyDepart = $TotalEarlyDepart + 1;
					}
					if($row['Status'] != 'Off Day')
					{
						list($hours, $minutes) = explode(':', $row["ScheduleArrivalTime"]);
						$startTimestamp = mktime($hours, $minutes);
						list($hours, $minutes) = explode(':', $row["ScheduleDepartTime"]);
						$endTimestamp = mktime($hours, $minutes);
						$seconds = $endTimestamp - $startTimestamp;
						$minutes = ($seconds / 60) % 60;
						$hours = floor($seconds / (60 * 60));
						
						$TotalHours = $TotalHours + $hours;
						$TotalMinutes = $TotalMinutes + $minutes;
					}
		?>
                    <tr <?php echo ($row["Status"] == 'Absent' ? ($Legends == 1 ? 'style="background-color:red;color:white;"' : '') : '' ); ?><?php echo ($row["Status"] == 'Off Day' ? ($Legends == 1 ? 'style="background-color:pink;"' : '') : '' ); ?><?php echo ($row["Status"] == 'Leave' ? ($Legends == 1 ? 'style="background-color:yellow;"' : '') : '' ); ?><?php echo ($row["HalfDay"] == 1 ? ($Legends == 1 ? 'style="background-color:lightblue;color:black"' : '') : '' ); ?><?php echo ($row["Late"] == 1 || $row["EarlyDep"] == 1 ? ($Legends == 1 ? 'style="background-color:lightgreen;color:black"' : '') : '' ); ?>>
					  <td><?php echo $i; ?></td>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $ID; ?>"></td>
					  <td style="text-align:left;"><?php echo dboutput($row['EmpID']); ?></td>
					  <td style="text-align:left;"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <!--<td><?php //echo dboutput($row['Designation']); ?></td>
					  <td><?php //echo dboutput($row['Department']); ?></td>-->
					  <td><?php echo dboutput($row["Day"])."<br>".dboutput($row["Date"]); ?></td>
					  <td <?php echo (dboutput($row["MArrivalTime"]) != NULL || dboutput($row["MDepartTime"]) != NULL ? ($Legends == 1 ? 'style="background-color:#c1c1c1;"' : '') : ''); ?>><?php echo (dboutput($row["ArrivalTime"]) == NULL ? '' : dboutput($row["ArrivalTime"])); ?></td>
					  <td <?php echo (dboutput($row["MArrivalTime"]) != NULL || dboutput($row["MDepartTime"]) != NULL ? ($Legends == 1 ? 'style="background-color:#c1c1c1;"' : '') : ''); ?>><?php echo (dboutput($row["DepartTime"]) == NULL ? '' : dboutput($row["DepartTime"])); ?></td>
					  <td><?php echo (dboutput($row["MArrivalTime"]) == '12:00 AM' ? '' : dboutput($row["MArrivalTime"])); ?></td>
					  <td><?php echo (dboutput($row["MDepartTime"]) == '12:00 AM' ? '' : dboutput($row["MDepartTime"])); ?></td>
					  <td><?php echo revert_time_format_gracetime($row["ScheduleArrivalTime"]).'<br>To<br>'.revert_time_format_gracetime($row["ScheduleDepartTime"]); ?></td>
					  <td class="no-print">
					  <?php 
					  if(dboutput($row["Late"]) == 1)
						{
					   list($hours, $minutes) = explode(':', $row["LateArrival"]);
							$startTimestamp = mktime($hours, $minutes);

							list($hours, $minutes) = explode(':', $row["TArrivalTime"]);
							$endTimestamp = mktime($hours, $minutes);

							$seconds = $endTimestamp - $startTimestamp;
							$minutes = ($seconds / 60) % 60;
							$hours = floor($seconds / (60 * 60));

							echo "<b>$hours</b>H / <b>$minutes</b>M";
						}
					  ?>
					  </td>
					  <td class="no-print">
					  <?php
					  if(dboutput($row["EarlyDep"]) == 1)
						{
					   list($hours, $minutes) = explode(':', $row["TDepartTime"]);
							$startTimestamp = mktime($hours, $minutes);

							list($hours, $minutes) = explode(':', $row["EarlyDepart"]);
							$endTimestamp = mktime($hours, $minutes);

							$seconds = $endTimestamp - $startTimestamp;
							$minutes = ($seconds / 60) % 60;
							$hours = floor($seconds / (60 * 60));

							echo "<b>$hours</b>H / <b>$minutes</b>M";
						}
						?>
					  </td>
					  <td>
					  <?php
					  if($row["TArrivalTime"] == Null || $row["TDepartTime"] == Null)
					  {
						 
							
							echo "<b>0</b>H / <b>0</b>M";
					  }
					  else
					  {
					   list($hours, $minutes) = explode(':', $row["TArrivalTime"]);
							$startTimestamp = mktime($hours, $minutes);

							list($hours, $minutes) = explode(':', $row["TDepartTime"]);
							$endTimestamp = mktime($hours, $minutes);

							$seconds = $endTimestamp - $startTimestamp;
							$minutes = ($seconds / 60) % 60;
							$hours = floor($seconds / (60 * 60));

							echo "<b>$hours</b>H / <b>$minutes</b>M";
							
							$TotalWorkingHours = $TotalWorkingHours + $hours;
							$TotalWorkingMinutes = $TotalWorkingMinutes + $minutes;
					  }
					  ?>
					  </td>
					  <td>
					  <?php 
					  if($row['LeavesDays'] != "")
						{
						$LeaveDays = explode(',',$row['LeavesDays']);
						}
						$OffDay=strtotime($row["LoginDate"]);
						if (in_array(''.date("N", $OffDay).'', $LeaveDays))
						{
							if($row["OvertimePolicy"] != 0)
							{
							  if($row["TArrivalTime"] == Null || $row["TDepartTime"] == Null)
							  {
									
							  }
							  else
							  {
							   list($hours, $minutes) = explode(':', $row["TArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));

									echo "<b>$hours</b>H / <b>$minutes</b>M";
									
									$TotalOvertimeHours = $TotalOvertimeHours + $hours;
									$TotalOvertimeMinutes = $TotalOvertimeMinutes + $minutes;
							  }
							}
						}
						else
						{
							if($row["OvertimePolicy"] != 0)
							{
								
							$query4="SELECT ApplyAfter FROM overtime_policies WHERE ID <> 0 AND ID = ".$row["OvertimePolicy"]." AND Status = 1";
							$result4 = mysql_query ($query4) or die(mysql_error()); 
							$num4 = mysql_num_rows($result4);
							if($num4 == 1)
							{
								$row4 = mysql_fetch_array($result4,MYSQL_ASSOC);
								
								 if($row["TArrivalTime"] == Null || $row["TDepartTime"] == Null)
								  {
									
								  }
								  else
								  {
									$ApplyAfter = strtotime($row['Depart']);
									$ApplyAfter = date("H:i:s", strtotime('+'.$row4['ApplyAfter'].' minutes', $ApplyAfter));  
									
									if($row["TDepartTime"] > $ApplyAfter)
									{  
										list($hours, $minutes) = explode(':', $ApplyAfter);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row["TDepartTime"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));

										echo "<b>$hours</b>H / <b>$minutes</b>M";
										
										$TotalOvertimeHours = $TotalOvertimeHours + $hours;
										$TotalOvertimeMinutes = $TotalOvertimeMinutes + $minutes;
									}
								  }
							}
							
							}
						}
					  ?>
					  </td>
					  <td><?php echo dboutput($row["MStatus"]); ?></td>
					  <td><?php echo ($row["HalfDay"] == 1 ? 'HalfDay<br>' : '' ); ?><?php echo ($row["Late"] == 1 ? 'Late<br>' : '' ); ?><?php echo ($row["EarlyDep"] == 1 ? 'Early<br>' : '' ); ?><?php echo dboutput($row["Status"]); ?></td>
                    </tr>
                    <?php	
					$i++;
					}
				
				}
			} 
		?>
				<?php
				  $TotalMinutes = round(($TotalMinutes / 60));
				  $TotalHours = $TotalHours + $TotalMinutes;
				  
				  $TotalWorkingMinutes = round(($TotalWorkingMinutes / 60));
				  $TotalWorkingHours = $TotalWorkingHours + $TotalWorkingMinutes;
				  
				  $TotalOvertimeMinutes = round(($TotalOvertimeMinutes / 60));
				  $TotalOvertimeHours = $TotalOvertimeHours + $TotalOvertimeMinutes;
				  if($maxRow>0)
					{
				  ?>
					<tr>
					  <td style="color:white;background-color:black;" colspan="20">Total Days: <?php echo $TotalDays; ?>, Present: <?php echo $TotalPresent; ?>, Absent <?php echo $TotalAbsent; ?>, OffDays <?php echo $TotalOffDays; ?>, Leaves <?php echo $TotalLeaves; ?>, Halfdays <?php echo $TotalHalfdays; ?>, Lates <?php echo $TotalLates; ?>, EarlyDepart <?php echo $TotalEarlyDepart; ?>, Total Hours <?php echo $TotalHours; ?>, Working Hours <?php echo $TotalWorkingHours; ?>, DifferenceWorkingHours <?php echo $TotalHours - $TotalWorkingHours; ?>, OvertimeHours <?php echo $TotalOvertimeHours; ?></td>
                    </tr>
				<?php 
					}
				?>
                  </tbody>
				  
                </table>
              </form>
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
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->

<!-- page script -->
<script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                });
            });
        </script>
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>

