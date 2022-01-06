<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>

<?php
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
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
?>


<?php
$CompanyID=1000;
$Location=0;
$Designation="";
$Department="";
$Employee=0;
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

$TillDate=date("Y-m-d");

if($TillDate > date("Y-m-25"))
{
$FromDate=date("Y-m-26");
}
else
{
$d=strtotime("-1 Months");
// echo date("Y-m-d", $d);		
$FromDate=date("Y-m-26", $d);
}
			




if(isset($_REQUEST["CompanyID"]))
		$CompanyID=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
		$Location=trim($_REQUEST["Location"]);
if(isset($_REQUEST["Designation"]))
		$Designation=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
		$Department=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SortBy"]))
		$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["SortType"]))
		$SortType=trim($_REQUEST["SortType"]);
if(isset($_REQUEST["Employee"]))
		$Employee=trim($_REQUEST["Employee"]);
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
<head>
<meta charset="UTF-8">
<title>Attendance Ledger</title>
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
<body class="skin-blue">
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
				DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,sh.LateArrival,sh.EarlyDepart,sh.DepartTime AS Depart,sh.Name AS ScheduleName,sh.ArrivalTime AS ScheduleArrivalTime,sh.DepartTime AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND (li.DateAdded BETWEEN '".$FromDate."' AND '".$TillDate."') ".($CompanyID != "" ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != "" ? ' AND e.Location = '.$Location.'' : '')." ".($Designation != "" ? ' AND e.Designation = \''.$Designation.'\'' : '')." ".($Department != "" ? ' AND e.Department = \''.$Department.'\'' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($SortType != "" ? ' AND li.Status = \''.$SortType.'\'' : '')." ".($SortBy != "" ? ' ORDER BY '.$SortBy.',li.DateAdded,e.EmpID ASC' : '')." ";
				
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
      <h1>Attendance Ledger <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Ledger</li>
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
							 <input autofocus type="date" name="FromDate" value="<?php echo $FromDate; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
							<div class="form-group">
							Till:
							 <input type="date" name="TillDate" value="<?php echo $TillDate; ?>" class="form-control" />
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
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							  Company:
							  <select name="CompanyID" id="CompanyID" class="form-control">
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
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
						  Location:
							<select name="Location" id="Location" class="form-control">
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
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
						  Designation:
							<select name="Designation" id="Designation" class="form-control">
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
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
						  Department:
							<select name="Department" id="Department" class="form-control">
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
                        
                       <div class="col-lg-6 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
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
				<button type="button" onClick="javascript:GrantLeaves()" class="btn btn-warning margin no-print">Grant Leave</button>
				<button type="button" onClick="javascript:TimeAdjust()" class="btn btn-white margin no-print">Time Adjust</button>
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
					  <td><?php echo dboutput($row["MArrivalTime"]); ?></td>
					  <td><?php echo dboutput($row["MDepartTime"]); ?></td>
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
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
