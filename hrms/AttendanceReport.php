<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>

<?php
// $times = array('10:00:00','09:08:40');

// $totaltime = '';
// foreach($times as $time){
        // $timestamp = strtotime($time);
        // $totaltime += $timestamp;
// }

// $average_time = ($totaltime/count($times));

// echo date('H:i:s',$average_time);
// exit();
$Rate=0;
$Times=array();
$AvgArrTime="";
$AvgArrTimeHD="";
$AvgDepTime="";
$AvgDepTimeHD="";

$LateEarly=0;
$HalfDays=0;
$Absents=0;
$OvertimeHours=0;

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
$TotalOTMinutes=0;
$TotalWorkingMinutesMinusOT=0;
$TotalWorkingMinutesPlusOT=0;
$TotalWorkingHours = 0;
$TotalWorkingMinutes = 0;
$TotalWorkingMinutes2 = 0;
$TotalWorkingHoursOT = 0;
$TotalWorkingMinutesOT = 0;
$TotalWorkingMinutesOT2 = 0;
$TotalEarlyHours=0;
$TotalEarlyMinutes = 0;
$TotalEarlyMinutes2 = 0;
$TotalLateHours=0;
$TotalLateMinutes = 0;
$TotalLateMinutes2 = 0;
$TotalOvertimeHours = 0;
$TotalOvertimeMinutes = 0;
$TotalOvertimeMinutes2 = 0;
$TotalOvertimeHoursWorking = 0;
$TotalOvertimeMinutesWorking = 0;
$TotalOvertimeHoursHolidays = 0;
$TotalOvertimeMinutesHolidays = 0;

$PrintMode=0;
$Rows=10;

	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
if($action == "UpdateRoster")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["UpdateRoster"]=$_REQUEST["ids"];
			redirect("UpdateRoster.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Update Roster.</b>
			</div>';
		}
	}
	$_SESSION["UpdateRoster"]="";
	
if($action == "DeleteTime")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["DeleteTime"]=$_REQUEST["ids"];
			redirect("DeleteTime.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Delete Time.</b>
			</div>';
		}
	}
	$_SESSION["DeleteTime"]="";
	
if($action == "DeleteLeave")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["DeleteLeave"]=$_REQUEST["ids"];
			redirect("DeleteLeave.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Delete Leave.</b>
			</div>';
		}
	}
	$_SESSION["DeleteLeave"]="";
	
if($action == "GrantLeaves")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["GrantLeave"]=$_REQUEST["ids"];
			redirect("GrantLeave.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Grant Leaves.</b>
			</div>';
		}
	}
	$_SESSION["GrantLeave"]="";

if($action == "TimeAdjust")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["TimeAdjust"]=$_REQUEST["ids"];
			redirect("TimeAdjust.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Adjust Time.</b>
			</div>';
		}
	}
	$_SESSION["TimeAdjust"]="";
	
if($action == "ArrivalTimeAdjust")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["ArrivalTimeAdjust"]=$_REQUEST["ids"];
			redirect("ArrivalTimeAdjust.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Adjust Arrival Time.</b>
			</div>';
		}
	}
	$_SESSION["ArrivalTimeAdjust"]="";
	
if($action == "DepartTimeAdjust")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["DepartTimeAdjust"]=$_REQUEST["ids"];
			redirect("DepartTimeAdjust.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Adjust Depart Time.</b>
			</div>';
		}
	}
	$_SESSION["DepartTimeAdjust"]="";
?>


<?php
if(!isset($_SESSION['CompanyIDLedger']))
$_SESSION['CompanyIDLedger']=1000;

if(!isset($_SESSION['LocationLedger']))
$_SESSION['LocationLedger']=0;

if(!isset($_SESSION['DesignationLedger']))
$_SESSION['DesignationLedger']="";

if(!isset($_SESSION['DepartmentLedger']))
$_SESSION['DepartmentLedger']="";

if(!isset($_SESSION['EmployeeLedger']))
$_SESSION['EmployeeLedger']=0;

if(!isset($_SESSION['SortByLedger']))
$_SESSION['SortByLedger']="e.EmpID";

if(!isset($_SESSION['SortTypeLedger']))
$_SESSION['SortTypeLedger']="";

if(!isset($_SESSION['LateLedger']))
$_SESSION['LateLedger']=0;

if(!isset($_SESSION['EarlyDepLedger']))
$_SESSION['EarlyDepLedger']=0;

if(!isset($_SESSION['HalfDayLedger']))
$_SESSION['HalfDayLedger']=0;

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

$Legends= 1;

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
			
if(!isset($_SESSION['FromDateLedger']))
$_SESSION['FromDateLedger']=$FromDate;

if(!isset($_SESSION['TillDateLedger']))
$_SESSION['TillDateLedger']=$TillDate;


if(isset($_REQUEST["CompanyID"]))
		$_SESSION['CompanyIDLedger']=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
		$_SESSION['LocationLedger']=trim($_REQUEST["Location"]);
if(isset($_REQUEST["Designation"]))
		$_SESSION['DesignationLedger']=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
		$_SESSION['DepartmentLedger']=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SortBy"]))
		$_SESSION['SortByLedger']=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["SortType"]))
		$_SESSION['SortTypeLedger']=trim($_REQUEST["SortType"]);
if(isset($_REQUEST["Employee"]))
		$_SESSION['EmployeeLedger']=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Legends"]))
		$Legends=trim($_REQUEST["Legends"]);
	
if(isset($_REQUEST["LateLedger"]))
{
	if($_REQUEST["LateLedger"] == 1)
	$_SESSION['LateLedger']=1;
	else
	$_SESSION['LateLedger']=0;
}
else
{
	$_SESSION['LateLedger']=0;
}

if(isset($_REQUEST["EarlyDepLedger"]))
{
	if($_REQUEST["EarlyDepLedger"] == 1)
	$_SESSION['EarlyDepLedger']=1;
	else
	$_SESSION['EarlyDepLedger']=0;
}
else
{
	$_SESSION['EarlyDepLedger']=0;
}

if(isset($_REQUEST["HalfDayLedger"]))
{
	if($_REQUEST["HalfDayLedger"] == 1)
	$_SESSION['HalfDayLedger']=1;
	else
	$_SESSION['HalfDayLedger']=0;
}
else
{
	$_SESSION['HalfDayLedger']=0;
}
	
if(isset($_REQUEST["FromDate"]))
		$_SESSION['FromDateLedger']=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
		$_SESSION['TillDateLedger']=trim($_REQUEST["TillDate"]);
	
if(isset($_REQUEST["PrintMode"]))
	$PrintMode=trim($_REQUEST["PrintMode"]);
if(isset($_REQUEST["Rows"]))
	$Rows=(int)$_REQUEST["Rows"];

	// echo $FromDate;
	// exit();
// echo $FromDate.'<br>'; 
// echo date_format_Ymd($FromDate);exit();	
	

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

<title>Attendance Report</title>
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
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<!-- Bootstrap time Picker -->
<link href="css/timepicker/bootstrap-timepicker.min.css" rel="styleshee
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
<style type="text/css">
    table{
        border:none;
    }
	
	#printable table
	{
		table-layout: auto;
		width:100%;
		font-size:10px;
	}
	
	#printable tr
	{
		display:flex;
		width:100%;
	}
	
	#printable th
	{	
		overflow: hidden;
		width: 100px;
		color:black;
		text-align:left;
	}
	
	#printable td
	{
		overflow: hidden;
		width: 100px;
		text-align:left;
	}	
	
	@media screen {
		#printable table tbody .head{
			display: none;
		}
	} 
	
	@media print {
		.head {
			page-break-before: always;
		}
	} 
</style>

<script>
    	$(document).ready(function(){
		var head = $('#printable table thead tr');
		$( "#printable table tbody tr:nth-child(<?php echo $Rows; ?>n+<?php echo $Rows; ?>)" ).after(head.clone());

	});
</script>

<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>

<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
	
	function UpdateRoster()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Update Roster."))
			{
				$("#action").val("UpdateRoster");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Update Roster");
	}
	
	function DeleteTime()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Delete Time."))
			{
				$("#action").val("DeleteTime");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Delete Time");
	}
	
	function DeleteLeave()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Delete Leave."))
			{
				$("#action").val("DeleteLeave");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Delete Leave");
	}
	
	function GrantLeaves()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Grant Leaves."))
			{
				$("#action").val("GrantLeaves");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Grant Leaves");
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
	
	function ArrivalTimeAdjust()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Adjust Arrival Time."))
			{
				$("#action").val("ArrivalTimeAdjust");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Adjust Arrival Time");
	}
	
	function DepartTimeAdjust()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Adjust Depart Time."))
			{
				$("#action").val("DepartTimeAdjust");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Adjust Depart Time");
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

.chkIds[type="checkbox"]{
  width: 30px; /*Desired width*/
  height: 30px; /*Desired height*/
}

</style>
<script type="text/javascript" async="async" id="true" src="excel/views2.json"></script>
<script type="text/javascript" src="excel/300lo.json"></script>
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
				
				$query="SELECT li.UserID,li.ID,SUM(li.HalfDay) AS NumHalfDay,SUM(li.Late) AS NumLates,SUM(li.EarlyDep) AS NumEarly,e.EmpID,e.FirstName,e.LastName FROM employees e LEFT JOIN roster_login_history li ON li.UserID = e.ID WHERE e.Status = 'Active' AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['SortByLedger'] != "" ? ' GROUP BY li.UserID ORDER BY '.$_SESSION['SortByLedger'].',li.DateAdded,e.EmpID ASC' : '')." ";
				
				// $query="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,li.LateArrival,li.EarlyDepart,li.ScheduleDepart AS Depart,sh.Name AS ScheduleName,li.ScheduleArrival AS ScheduleArrivalTime,li.ScheduleDepart AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['SortTypeLedger'] != "" ? ' AND li.Status = \''.$_SESSION['SortTypeLedger'].'\'' : '')." ".($_SESSION['LateLedger'] == 1 ? ' AND li.Late = 1' : '')." ".($_SESSION['EarlyDepLedger'] == 1 ? ' AND li.EarlyDep = 1' : '')." ".($_SESSION['HalfDayLedger'] == 1 ? ' AND li.HalfDay = 1' : '')." ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].',li.DateAdded,e.EmpID ASC' : '')." ";
				
			
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Attendance Report <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Report</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content <?php echo ($PrintMode == 1 ? 'no-print' : '') ?>">
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
								 <input type="text" id="FromDate" name="FromDate" class="form-control"  <?php echo 'value="'.$_SESSION['FromDateLedger'].'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask/>
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
								 <input type="text" id="TillDate" name="TillDate" class="form-control"  <?php echo 'value="'.$_SESSION['TillDateLedger'].'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask/>
							</div>
							</div>
						</div><!-- ./col -->
						 <div class="col-lg-4 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['EmployeeLedger'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
                       <!-- <div class="ui-widget">
                        Employee:
                        <input class="form-control" id="tags">
						</div>-->
						</div>
						<br>
					   </div>
					   
					   <div class="col-lg-1 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Headings" >Print Mode: </label>
								<input type="radio" <?php echo ($PrintMode == 1 ? ' checked="checked"' : ''); ?> value="1" name="PrintMode" id="On"><label for="On">On</label>
								<input type="radio" <?php echo ($PrintMode == 0 ? ' checked="checked"' : ''); ?> value="0" name="PrintMode" id="Off"><label for="Off">Off</label><br>
							</div>
							<br>
						</div><!-- ./col -->
						<div class="col-lg-1 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Rows" >Rows: </label>
								<input class="form-control" type="number"  value="<?php echo $Rows; ?>" name="Rows" id="Rows">
							</div>
							<br>
						</div><!-- ./col -->
						
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
							  Company:
							  <select name="CompanyID" id="CompanyID" class="form-control">
								<option value="">All Companies</option>
								<?php
								 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['CompanyIDLedger'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
						  Location:
							<select name="Location" id="Location" class="form-control">
							<option value="" >All Locations</option>
							<?php
							$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['LocationLedger'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
						  Designation:
							<select name="Designation" id="Designation" class="form-control">
							<option value="" >All Designations</option>
							<?php
							foreach($_DESIGNATION as $Designations)
							{
							echo '<option '.($_SESSION['DesignationLedger'] == $Designations ? 'selected' : '').' value="'.$Designations.'">'.$Designations.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
						  Department:
							<select name="Department" id="Department" class="form-control">
							<option value="" >All Departments</option>
							<?php
							foreach($_DEPARTMENT as $Departments)
							{
							echo '<option '.($_SESSION['DepartmentLedger'] == $Departments ? 'selected' : '').' value="'.$Departments.'">'.$Departments.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
							</select>
							</div>
						</div><!-- ./col -->
                        
                      
                       
						<div class="col-lg-2 col-xs-12 no-print">
							<br>
                           <div class="form-group">
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			<div class="box-footer no-print" style="text-align:right;">
               <button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print no-print"></i> Print</button>
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-print no-print"></i> Excel</button>
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
                
  
                 <?php if($PrintMode == 0){ ?> 
              <table class="blue table table-bordered" id="tblExport">
                  <thead class="">
                    <tr style="color:white;" class="head">
					  <th>S#</th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Avg Time In</th>
					  <th>Avg Time In + HD</th>
					  <th>Avg Time Out</th>
					  <th>Avg Time Out + HD</th>
					  <th>P</th>
					  <th>AB</th>
					  <th>Off Day</th>
					  <th>Leave</th>
                      <th>No Of Lates</th>
					  <th>Late Time</th>
					  <th>No Of Early</th>
					  <th>Early Time</th>
					  <th>No Of H.D.</th>
					  <!--<th>Half Days Time</th>-->
					  <th>Working Time</th>
					  <th>OT</th>
					  <th>Working Hrs</th>
					  <th>Working Hrs + OT</th>
					  <th>Dif Hrs</th>
					  <th>Rate</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="25" align="center" class="error"><b>No Attandence listed.</b></td>
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
				
		?>
                    <tr>
					  <td><?php echo $i; ?></td>
                        <input type="hidden" name="ids1[]" value="<?php echo $ID; ?>"></td>
					  <td style="text-align:left;"><?php echo dboutput($row['EmpID']); ?></td>
					  <td style="text-align:left;"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <td>
					  <?php
						$query2 = "SELECT ID,LoginTime FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present' AND HalfDay = 0";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								$Times[] = $row2["LoginTime"];
							}
							//print_r($Times);
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgArrTime = ($totaltime/count($Times));

							echo date('h:i a',$AvgArrTime);
							$Times=array();
						}
					  ?>
					  </td>
					  <td>
					  <?php
						$query2 = "SELECT ID,LoginTime FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								$Times[] = $row2["LoginTime"];
							}
							
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgArrTimeHD = ($totaltime/count($Times));

							echo date('h:i a',$AvgArrTimeHD);
							$Times=array();
						}
					  ?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT lo.LogoutTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status = 'Present' AND li.HalfDay = 0";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["LogoutTime"] != Null)
								{
									$Times[] = $row2["LogoutTime"];
								}
							}
							
							if(count($Times) > 0)
							{
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgDepTime = ($totaltime/count($Times));

							echo date('h:i a',$AvgDepTime);
							}
							$Times=array();
						}
						?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT lo.LogoutTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["LogoutTime"] != Null)
								{
									$Times[] = $row2["LogoutTime"];
								}
							}
							
							if(count($Times) > 0)
							{
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgDepTimeHD = ($totaltime/count($Times));

							echo date('h:i a',$AvgDepTimeHD);
							}
							$Times=array();
						}
						?>
					  </td>
					  <td>
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td>
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Absent'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
						$Absents = $num2;
					  ?>
					  </td>
					  <td>
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td>
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Leave'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td>
					  <?php 
					  echo dboutput($row['NumLates']); 
					  $LateEarly += $row['NumLates'];
					  ?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT li.ID,li.Late,li.LateArrival,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
						
								if(dboutput($row2["Late"]) == 1)
								{
							   list($hours, $minutes) = explode(':', $row2["LateArrival"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalLateHours = $TotalLateHours + $hours;
									$TotalLateMinutes = $TotalLateMinutes + $minutes;
								}
							}
							$TotalLateMinutes2 = round(($TotalLateMinutes % 60));
							$TotalLateMinutes = round(($TotalLateMinutes / 60));
							$TotalLateHours = $TotalLateHours + $TotalLateMinutes;
							echo "<span>$TotalLateHours</span>H / <span>$TotalLateMinutes2</span>M";
							$TotalLateMinutes2 = 0;
							$TotalLateHours = 0;
							$TotalLateMinutes =0;
						}
						?>
					  </td>
					  <td>
					  <?php 
					  echo dboutput($row['NumEarly']); 
					  $LateEarly += $row['NumEarly'];
					  ?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT li.ID,li.EarlyDep,li.EarlyDepart,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									if(dboutput($row2["EarlyDep"]) == 1)
									{
								   list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row2["EarlyDepart"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));
										
										$TotalEarlyHours = $TotalEarlyHours + $hours;
										$TotalEarlyMinutes = $TotalEarlyMinutes + $minutes;
									}
								  }
							}
							$TotalEarlyMinutes2 = round(($TotalEarlyMinutes % 60));
							$TotalEarlyMinutes = round(($TotalEarlyMinutes / 60));
							$TotalEarlyHours = $TotalEarlyHours + $TotalEarlyMinutes;
							echo "<span>$TotalEarlyHours</span>H / <span>$TotalEarlyMinutes2</span>M";
							$TotalEarlyMinutes2 = 0;
							$TotalEarlyHours = 0;
							$TotalEarlyMinutes =0;
						}
						?>
						</td>
					  <td>
					  <?php 
					  echo dboutput($row['NumHalfDay']); 
					  $HalfDays = $row['NumHalfDay'];
					  ?>
					  </td>
					  <!--<td>-</td>-->
					  
					  <td>
					  <?php
						$query2 = "SELECT ID,ScheduleArrival,ScheduleDepart FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								list($hours, $minutes) = explode(':', $row2["ScheduleArrival"]);
								$startTimestamp = mktime($hours, $minutes);
								list($hours, $minutes) = explode(':', $row2["ScheduleDepart"]);
								$endTimestamp = mktime($hours, $minutes);
								$seconds = $endTimestamp - $startTimestamp;
								$minutes = ($seconds / 60) % 60;
								$hours = floor($seconds / (60 * 60));
								
								$TotalHours = $TotalHours + $hours;
								$TotalMinutes = $TotalMinutes + $minutes;
							}
							echo "<span>$TotalHours</span>H / <span>$TotalMinutes</span>M";
						}
					  ?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									if($row2["TDepartTime"] > $row2["ScheduleDepart"])
									{
									list($hours, $minutes) = explode(':', $row2["ScheduleDepart"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalOvertimeHours = $TotalOvertimeHours + $hours;
									$TotalOvertimeMinutes = $TotalOvertimeMinutes + $minutes;
									}
								  }
							}
							$TotalOvertimeMinutes2 = round(($TotalOvertimeMinutes % 60));
							$TotalOvertimeMinutes = round(($TotalOvertimeMinutes / 60));
							$TotalOvertimeHours = $TotalOvertimeHours + $TotalOvertimeMinutes;
							echo "<span>$TotalOvertimeHours</span>H / <span>$TotalOvertimeMinutes2</span>M";
						}
						?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalWorkingHours = $TotalWorkingHours + $hours;
									$TotalWorkingMinutes = $TotalWorkingMinutes + $minutes;
								  }
							}
							$TotalWorkingMinutes2 = round(($TotalWorkingMinutes % 60));
							$TotalWorkingMinutes = round(($TotalWorkingMinutes / 60));
							$TotalWorkingHours = $TotalWorkingHours + $TotalWorkingMinutes;
							
							$TotalOTMinutes = ($TotalOvertimeHours * 60);
							$TotalOTMinutes += $TotalOvertimeMinutes2;
							$TotalWorkingMinutesPlusOT = ($TotalWorkingHours * 60);
							$TotalWorkingMinutesPlusOT += $TotalWorkingMinutes2;
							$TotalWorkingMinutesMinusOT = $TotalWorkingMinutesPlusOT - $TotalOTMinutes;
							
							$TotalWorkingMinutes2 = round(($TotalWorkingMinutesMinusOT % 60));
							$TotalWorkingHours = round(($TotalWorkingMinutesMinusOT / 60));
							
							echo "<span>$TotalWorkingHours</span>H / <span>$TotalWorkingMinutes2</span>M";
						}
						?>
					  </td>
					  <td>
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalWorkingHoursOT = $TotalWorkingHoursOT + $hours;
									$TotalWorkingMinutesOT = $TotalWorkingMinutesOT + $minutes;
								  }
							}
							$TotalWorkingMinutesOT2 = round(($TotalWorkingMinutesOT % 60));
							$TotalWorkingMinutesOT = round(($TotalWorkingMinutesOT / 60));
							$TotalWorkingHoursOT = $TotalWorkingHoursOT + $TotalWorkingMinutesOT;
							echo "<span>$TotalWorkingHoursOT</span>H / <span>$TotalWorkingMinutesOT2</span>M";
						}
						?>
					  </td>
					  <td>
					  <?php
							echo $TotalWorkingHoursOT - $TotalHours.'H';
							
							$OvertimeHours = ($TotalWorkingHoursOT - $TotalHours);
							
							if($LateEarly == 3 || $LateEarly < 3)
							{
								$Rate += 4;
							}
							else if($LateEarly == 5 || $LateEarly < 5)
							{
								$Rate += 3;
							}
							else if($LateEarly == 8 || $LateEarly < 8)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if($HalfDays == 0)
							{
								$Rate += 4;
							}
							else if($HalfDays == 1 || $HalfDays == 2)
							{
								$Rate += 3;
							}
							else if($HalfDays == 3 || $HalfDays == 4)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if($Absents == 0)
							{
								$Rate += 4;
							}
							else if($Absents == 1)
							{
								$Rate += 3;
							}
							else if($Absents == 2 || $Absents == 3)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if(($TotalWorkingHoursOT - $TotalHours) >= 10)
							{
								$Rate += 4;
							}
							else if(($TotalWorkingHoursOT - $TotalHours) >= 5)
							{
								$Rate += 3;
							}
							else if(($TotalWorkingHoursOT - $TotalHours) >= 0)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							$LateEarly=0;
							$HalfDays=0;
							$Absents=0;
							$OvertimeHours=0;
							$TotalHours = 0;
							$TotalMinutes =0;
							$TotalOTMinutes=0;
							$TotalWorkingMinutesMinusOT=0;
							$TotalWorkingMinutesPlusOT=0;
							$TotalWorkingMinutes2 = 0;
							$TotalWorkingHours = 0;
							$TotalWorkingMinutes =0;
							$TotalWorkingMinutesOT2 = 0;
							$TotalWorkingHoursOT = 0;
							$TotalWorkingMinutesOT =0;
							$TotalOvertimeMinutes2 = 0;
							$TotalOvertimeHours = 0;
							$TotalOvertimeMinutes =0;
					  ?>
					  </td>
					  <td>
					  <?php
						echo round(($Rate / 4),2);
					  
					  $Rate=0;
					  ?>
					  </td>
                    </tr>
                    <?php	
					$i++;
				
				}
			} 
		?>
                  </tbody>
				  
                </table>
				<?php } ?>
              </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
	<?php if($PrintMode == 1){ ?>
			<div id="printable">
			 <table class="blue table table-bordered" style="border:none">
                  <thead class="">
                    <tr style="color:white;" class="head">
					  <th style="width:40px">S#</th>
                      <th style="width:50px">Code</th>
					  <th style="width:135px">Employee</th>
					  <th style="width:55px">Avg Time In</th>
					  <th style="width:55px">Avg Time In + HD</th>
					  <th style="width:55px">Avg Time Out</th>
					  <th style="width:55px">Avg Time Out + HD</th>
					  <th style="width:40px">P</th>
					  <th style="width:40px">AB</th>
					  <th style="width:40px">Off Day</th>
					  <th style="width:45px">Leave</th>
                      <th style="width:40px">No Of Lates</th>
					  <th style="width:50px">Late Time</th>
					  <th style="width:40px">No Of Early</th>
					  <th style="width:50px">Early Time</th>
					  <th style="width:40px">No Of H.D.</th>
					  <!--<th>Half Days Time</th>-->
					  <th style="width:55px">Working Time</th>
					  <th style="width:50px">OT</th>
					  <th style="width:55px">Working Hrs</th>
					  <th style="width:55px">Working Hrs + OT</th>
					  <th style="width:45px">Dif Hrs</th>
					  <th style="width:43px">Rate</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="25" align="center" class="error" style="width:1133px"><b>No Attandence listed.</b></td>
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
				
		?>
                    <tr>
					  <td style="width:40px"><?php echo $i; ?></td>
                        <input type="hidden" name="ids1[]" value="<?php echo $ID; ?>"></td>
					  <td style="text-align:left;width:50px"><?php echo dboutput($row['EmpID']); ?></td>
					  <td style="text-align:left;width:135px"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <td style="width:55px">
					  <?php
						$query2 = "SELECT ID,LoginTime FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present' AND HalfDay = 0";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								$Times[] = $row2["LoginTime"];
							}
							//print_r($Times);
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgArrTime = ($totaltime/count($Times));

							echo date('h:i a',$AvgArrTime);
							$Times=array();
						}
					  ?>
					  </td>
					  <td style="width:55px">
					  <?php
						$query2 = "SELECT ID,LoginTime FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								$Times[] = $row2["LoginTime"];
							}
							
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgArrTimeHD = ($totaltime/count($Times));

							echo date('h:i a',$AvgArrTimeHD);
							$Times=array();
						}
					  ?>
					  </td>
					  <td style="width:55px">
					  <?php
					  $query2 = "SELECT lo.LogoutTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status = 'Present' AND li.HalfDay = 0";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["LogoutTime"] != Null)
								{
									$Times[] = $row2["LogoutTime"];
								}
							}
							
							if(count($Times) > 0)
							{
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgDepTime = ($totaltime/count($Times));

							echo date('h:i a',$AvgDepTime);
							}
							$Times=array();
						}
						?>
					  </td>
					  <td style="width:55px">
					  <?php
					  $query2 = "SELECT lo.LogoutTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["LogoutTime"] != Null)
								{
									$Times[] = $row2["LogoutTime"];
								}
							}
							
							if(count($Times) > 0)
							{
							$totaltime = '';
							foreach($Times as $time){
									$timestamp = strtotime($time);
									$totaltime += $timestamp;
							}

							$AvgDepTimeHD = ($totaltime/count($Times));

							echo date('h:i a',$AvgDepTimeHD);
							}
							$Times=array();
						}
						?>
					  </td>
					  <td style="width:40px">
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Present'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td style="width:40px">
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Absent'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
						$Absents = $num2;
					  ?>
					  </td>
					  <td style="width:40px">
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td style="width:45px">
					  <?php
						$query2 = "SELECT ID FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status = 'Leave'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						echo $num2;
					  ?>
					  </td>
					  <td style="width:40px">
					  <?php 
					  echo dboutput($row['NumLates']); 
					  $LateEarly += $row['NumLates'];
					  ?>
					  </td>
					  <td style="width:50px">
					  <?php
					  $query2 = "SELECT li.ID,li.Late,li.LateArrival,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
						
								if(dboutput($row2["Late"]) == 1)
								{
							   list($hours, $minutes) = explode(':', $row2["LateArrival"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalLateHours = $TotalLateHours + $hours;
									$TotalLateMinutes = $TotalLateMinutes + $minutes;
								}
							}
							$TotalLateMinutes2 = round(($TotalLateMinutes % 60));
							$TotalLateMinutes = round(($TotalLateMinutes / 60));
							$TotalLateHours = $TotalLateHours + $TotalLateMinutes;
							echo "<span>$TotalLateHours</span>H / <span>$TotalLateMinutes2</span>M";
							$TotalLateMinutes2 = 0;
							$TotalLateHours = 0;
							$TotalLateMinutes =0;
						}
						?>
					  </td>
					  <td style="width:40px">
					  <?php 
					  echo dboutput($row['NumEarly']); 
					  $LateEarly += $row['NumEarly'];
					  ?>
					  </td>
					  <td style="width:50px">
					  <?php
					  $query2 = "SELECT li.ID,li.EarlyDep,li.EarlyDepart,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									if(dboutput($row2["EarlyDep"]) == 1)
									{
								   list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
										$startTimestamp = mktime($hours, $minutes);

										list($hours, $minutes) = explode(':', $row2["EarlyDepart"]);
										$endTimestamp = mktime($hours, $minutes);

										$seconds = $endTimestamp - $startTimestamp;
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));
										
										$TotalEarlyHours = $TotalEarlyHours + $hours;
										$TotalEarlyMinutes = $TotalEarlyMinutes + $minutes;
									}
								  }
							}
							$TotalEarlyMinutes2 = round(($TotalEarlyMinutes % 60));
							$TotalEarlyMinutes = round(($TotalEarlyMinutes / 60));
							$TotalEarlyHours = $TotalEarlyHours + $TotalEarlyMinutes;
							echo "<span>$TotalEarlyHours</span>H / <span>$TotalEarlyMinutes2</span>M";
							$TotalEarlyMinutes2 = 0;
							$TotalEarlyHours = 0;
							$TotalEarlyMinutes =0;
						}
						?>
						</td>
					  <td style="width:40px">
					  <?php 
					  echo dboutput($row['NumHalfDay']); 
					  $HalfDays = $row['NumHalfDay'];
					  ?>
					  </td>
					  <!--<td>-</td>-->
					  
					  <td style="width:55px">
					  <?php
						$query2 = "SELECT ID,ScheduleArrival,ScheduleDepart FROM roster_login_history where UserID = ".$row['UserID']." AND (DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								list($hours, $minutes) = explode(':', $row2["ScheduleArrival"]);
								$startTimestamp = mktime($hours, $minutes);
								list($hours, $minutes) = explode(':', $row2["ScheduleDepart"]);
								$endTimestamp = mktime($hours, $minutes);
								$seconds = $endTimestamp - $startTimestamp;
								$minutes = ($seconds / 60) % 60;
								$hours = floor($seconds / (60 * 60));
								
								$TotalHours = $TotalHours + $hours;
								$TotalMinutes = $TotalMinutes + $minutes;
							}
							echo "<span>$TotalHours</span>H / <span>$TotalMinutes</span>M";
						}
					  ?>
					  </td>
					  <td style="width:50px">
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									if($row2["TDepartTime"] > $row2["ScheduleDepart"])
									{
									list($hours, $minutes) = explode(':', $row2["ScheduleDepart"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalOvertimeHours = $TotalOvertimeHours + $hours;
									$TotalOvertimeMinutes = $TotalOvertimeMinutes + $minutes;
									}
								  }
							}
							$TotalOvertimeMinutes2 = round(($TotalOvertimeMinutes % 60));
							$TotalOvertimeMinutes = round(($TotalOvertimeMinutes / 60));
							$TotalOvertimeHours = $TotalOvertimeHours + $TotalOvertimeMinutes;
							echo "<span>$TotalOvertimeHours</span>H / <span>$TotalOvertimeMinutes2</span>M";
						}
						?>
					  </td>
					  <td style="width:55px">
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalWorkingHours = $TotalWorkingHours + $hours;
									$TotalWorkingMinutes = $TotalWorkingMinutes + $minutes;
								  }
							}
							$TotalWorkingMinutes2 = round(($TotalWorkingMinutes % 60));
							$TotalWorkingMinutes = round(($TotalWorkingMinutes / 60));
							$TotalWorkingHours = $TotalWorkingHours + $TotalWorkingMinutes;
							
							$TotalOTMinutes = ($TotalOvertimeHours * 60);
							$TotalOTMinutes += $TotalOvertimeMinutes2;
							$TotalWorkingMinutesPlusOT = ($TotalWorkingHours * 60);
							$TotalWorkingMinutesPlusOT += $TotalWorkingMinutes2;
							$TotalWorkingMinutesMinusOT = $TotalWorkingMinutesPlusOT - $TotalOTMinutes;
							
							$TotalWorkingMinutes2 = round(($TotalWorkingMinutesMinusOT % 60));
							$TotalWorkingHours = round(($TotalWorkingMinutesMinusOT / 60));
							
							echo "<span>$TotalWorkingHours</span>H / <span>$TotalWorkingMinutes2</span>M";
						}
						?>
					  </td>
					  <td style="width:55px">
					  <?php
					  $query2 = "SELECT li.ID,li.ScheduleArrival,li.ScheduleDepart,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded where li.UserID = ".$row['UserID']." AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') AND li.Status <> 'Off Day'";
						$res2 = mysql_query($query2) or die(mysql_error());
						$num2 = mysql_num_rows($res2);
						if($num2 > 0)
						{
							while($row2 = mysql_fetch_array($res2))
							{
								if($row2["TDepartTime"] != Null)
								  {
									list($hours, $minutes) = explode(':', $row2["TArrivalTime"]);
									$startTimestamp = mktime($hours, $minutes);

									list($hours, $minutes) = explode(':', $row2["TDepartTime"]);
									$endTimestamp = mktime($hours, $minutes);

									$seconds = $endTimestamp - $startTimestamp;
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									$TotalWorkingHoursOT = $TotalWorkingHoursOT + $hours;
									$TotalWorkingMinutesOT = $TotalWorkingMinutesOT + $minutes;
								  }
							}
							$TotalWorkingMinutesOT2 = round(($TotalWorkingMinutesOT % 60));
							$TotalWorkingMinutesOT = round(($TotalWorkingMinutesOT / 60));
							$TotalWorkingHoursOT = $TotalWorkingHoursOT + $TotalWorkingMinutesOT;
							echo "<span>$TotalWorkingHoursOT</span>H / <span>$TotalWorkingMinutesOT2</span>M";
						}
						?>
					  </td>
					  <td style="width:45px">
					  <?php
							echo $TotalWorkingHoursOT - $TotalHours.'H';
							
							$OvertimeHours = ($TotalWorkingHoursOT - $TotalHours);
							
							if($LateEarly == 3 || $LateEarly < 3)
							{
								$Rate += 4;
							}
							else if($LateEarly == 5 || $LateEarly < 5)
							{
								$Rate += 3;
							}
							else if($LateEarly == 8 || $LateEarly < 8)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if($HalfDays == 0)
							{
								$Rate += 4;
							}
							else if($HalfDays == 1 || $HalfDays == 2)
							{
								$Rate += 3;
							}
							else if($HalfDays == 3 || $HalfDays == 4)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if($Absents == 0)
							{
								$Rate += 4;
							}
							else if($Absents == 1)
							{
								$Rate += 3;
							}
							else if($Absents == 2 || $Absents == 3)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							if(($TotalWorkingHoursOT - $TotalHours) >= 10)
							{
								$Rate += 4;
							}
							else if(($TotalWorkingHoursOT - $TotalHours) >= 5)
							{
								$Rate += 3;
							}
							else if(($TotalWorkingHoursOT - $TotalHours) >= 0)
							{
								$Rate += 2;
							}
							else
							{
								$Rate += 1;
							}
							
							$LateEarly=0;
							$HalfDays=0;
							$Absents=0;
							$OvertimeHours=0;
							$TotalHours = 0;
							$TotalMinutes =0;
							$TotalOTMinutes=0;
							$TotalWorkingMinutesMinusOT=0;
							$TotalWorkingMinutesPlusOT=0;
							$TotalWorkingMinutes2 = 0;
							$TotalWorkingHours = 0;
							$TotalWorkingMinutes =0;
							$TotalWorkingMinutesOT2 = 0;
							$TotalWorkingHoursOT = 0;
							$TotalWorkingMinutesOT =0;
							$TotalOvertimeMinutes2 = 0;
							$TotalOvertimeHours = 0;
							$TotalOvertimeMinutes =0;
					  ?>
					  </td>
					  <td style="width:43px">
					  <?php
						echo round(($Rate / 4),2);
					  
					  $Rate=0;
					  ?>
					  </td>
                    </tr>
                    <?php	
					$i++;
				
				}
			} 
		?>
                  </tbody>
				  
                </table>
			</div>
	<?php } ?>
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!--<script src="excel/jquery.min.js"></script>-->
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
