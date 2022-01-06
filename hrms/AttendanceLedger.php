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
$TotalOvertimeHoursWorking = 0;
$TotalOvertimeMinutesWorking = 0;
$TotalOvertimeHoursHolidays = 0;
$TotalOvertimeMinutesHolidays = 0;
$Night = 0;

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
	
if($action == "DeleteRecord")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["DeleteRecord"]=$_REQUEST["ids"];
			redirect("DeleteRecord.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to Delete Record.</b>
			</div>';
		}
	}
	$_SESSION["DeleteRecord"]="";
	
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
	
if($action == "ForcefullyAbsent")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["ForcefullyAbsent"]=$_REQUEST["ids"];
			redirect("ForcefullyAbsent.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Attendance to do Forcefully Absent.</b>
			</div>';
		}
	}
	$_SESSION["ForcefullyAbsent"]="";
	
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
	
if($action == "HiddenTimeAdjust")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
						
			$_SESSION["TimeAdjust"]=$_REQUEST["ids"];
			redirect("HiddenTimeAdjust.php");
		
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


if(!isset($_SESSION['LocationLedgerArray']))
{
$_SESSION['LocationLedgerArray']=array();
$_SESSION['LocationLedger']="";
}

// if(!isset($_SESSION['LocationLedger']))
// $_SESSION['LocationLedger']=0;

if(!isset($_SESSION['DesignationLedger']))
$_SESSION['DesignationLedger']="";

if(!isset($_SESSION['DepartmentLedger']))
$_SESSION['DepartmentLedger']="";

if(!isset($_SESSION['EmployeeLedger']))
$_SESSION['EmployeeLedger']=0;

if(!isset($_SESSION['EmpTypeLedger']))
$_SESSION['EmpTypeLedger']="Active";

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

if(!isset($_SESSION['NightLedger']))
$_SESSION['NightLedger']=0;

if(!isset($_SESSION['OvertimeLedger']))
$_SESSION['OvertimeLedger']=0;

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

$FromDate=date("Y-m-01");
$TillDate=date("Y-m-d");

// if($TillDate > date("25-m-Y"))
// {
// $FromDate=date("26-m-Y");
// }
// else
// {
// $d=strtotime("-1 Months");
// $FromDate=date("26-m-Y", $d);
// }
			
if(!isset($_SESSION['FromDateLedger']))
$_SESSION['FromDateLedger']=$FromDate;

if(!isset($_SESSION['TillDateLedger']))
$_SESSION['TillDateLedger']=$TillDate;


// if(isset($_REQUEST["CompanyID"]))
		// $_SESSION['CompanyIDLedger']=trim($_REQUEST["CompanyID"]);
if(isset($_SESSION["CompanyIDLedger"]))
{
	if(isset($_REQUEST["CompanyID"]))
	{
		$_SESSION['CompanyIDLedgerArray']=$_REQUEST["CompanyID"];
		$_SESSION['CompanyIDLedger']=implode(',',$_SESSION['CompanyIDLedgerArray']);
	}
	else
	{
		$_SESSION['CompanyIDLedgerArray']=array();
		$_SESSION['CompanyIDLedger']="";
	}
}
else
{
	$_SESSION['CompanyIDLedger']='1000';
}

if(!isset($_SESSION['CompanyIDLedger']))
$_SESSION['CompanyIDLedger']='1000';

if(!isset($_SESSION['CompanyIDLedgerArray']))
{
$_SESSION['CompanyIDLedgerArray']=array();
$_SESSION['CompanyIDLedger']="1000";
}


if(isset($_REQUEST["Location"]))
{
	$_SESSION['LocationLedgerArray']=$_REQUEST["Location"];
	$_SESSION['LocationLedger']=implode(',',$_SESSION['LocationLedgerArray']);
}
else
{
	$_SESSION['LocationLedgerArray']=array();
	$_SESSION['LocationLedger']="";
}
// if(isset($_REQUEST["Location"]))
		// $_SESSION['LocationLedger']=trim($_REQUEST["Location"]);
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
if(isset($_REQUEST["EmpType"]))
	$_SESSION['EmpTypeLedger']=trim($_REQUEST["EmpType"]);
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

if(isset($_REQUEST["NightLedger"]))
{
	if($_REQUEST["NightLedger"] == 1)
	$_SESSION['NightLedger']=1;
	else
	$_SESSION['NightLedger']=0;
}
else
{
	$_SESSION['NightLedger']=0;
}

if(isset($_REQUEST["OvertimeLedger"]))
{
	if($_REQUEST["OvertimeLedger"] == 1)
	$_SESSION['OvertimeLedger']=1;
	else
	$_SESSION['OvertimeLedger']=0;
}
else
{
	$_SESSION['OvertimeLedger']=0;
}
	
if(isset($_REQUEST["FromDate"]))
		$_SESSION['FromDateLedger']=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
		$_SESSION['TillDateLedger']=trim($_REQUEST["TillDate"]);

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
	
if(isset($_REQUEST["PrintMode"]))
	$PrintMode=trim($_REQUEST["PrintMode"]);
if(isset($_REQUEST["Rows"]))
	$Rows=(int)$_REQUEST["Rows"];
	
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

<script src="internetfiles/jquery-2-0-2-jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<script src="internetfiles/jquery-ui.css"></script>
<script src="internetfiles/jquery-1-10-2.js"></script>
<script src="internetfiles/jquery-ui.js"></script>
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
  <script src="internetfiles/html5shiv.js"></script>
  <script src="internetfiles/respond.min.js"></script>
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
	
	function DeleteRecord()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Delete Record."))
			{
				$("#action").val("DeleteRecord");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to Delete Record");
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
	
	function ForcefullyAbsent()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to do Forcefully Absent."))
			{
				$("#action").val("ForcefullyAbsent");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Attendance to do Forcefully Absent");
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
	
	function HiddenTimeAdjust()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Adjust Time."))
			{
				$("#action").val("HiddenTimeAdjust");
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
<style>
    .multiselect {
        width: auto;
    }
    .selectBox {
        position: relative;
    }
    .selectBox select {
        width: 100%;
    }
    .overSelect {
        position: absolute;
        left: 0; right: 0; top: 0; bottom: 0;
    }
	#checkboxes {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes label {
        display: block;
    }
    #checkboxes label:hover {
        background-color: #1e90ff;
    }
	#checkboxes2 {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes2 label {
        display: block;
    }
    #checkboxes2 label:hover {
        background-color: #1e90ff;
    }
	</style>
	<script>
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	function showCheckboxes2() {
        var checkboxes = document.getElementById("checkboxes2");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
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
// 		 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
// 		$res = mysql_query($query);
// 		while($row = mysql_fetch_array($res))
// 		{
// 		echo '"'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].'",';
// 		} 
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type="text/javascript" async="async" id="true" src="excel/views2.json"></script>
<script type="text/javascript" src="excel/300lo.json"></script>
</head>
<body class="skin-blue" style="font-size:12px;">
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

				
				//$query="SELECT li.Status,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.LoginDate = lo.LogoutDate LEFT JOIN employees e ON li.UserID = e.ID WHERE DATE_FORMAT(li.LoginDate, '%d') = ".($Day != 0 ? $Day : "DATE_FORMAT(NOW(), '%d')")." AND DATE_FORMAT(li.LoginDate, '%m') = ".($Month != 0 ? $Month : "DATE_FORMAT(NOW(), '%m')")."  AND DATE_FORMAT(li.LoginDate, '%Y') = ".($Year != 0 ? $Year : "DATE_FORMAT(NOW(), '%Y')")." ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].' ASC' : '')." ";
				
				
				// $query="SELECT li.Status,li.LoginDate AS CheckDate ,
				// DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%T') AS ArrivalTime , DATE_FORMAT(lo.LogoutTime, '%T') AS DepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation FROM roster_login_history li LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.LoginDate = lo.LogoutDate LEFT JOIN employees e ON li.UserID = e.ID WHERE (li.LoginDate BETWEEN '".$FromDate."' AND '".$TillDate."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].' ASC' : '')." ";
				
				$query="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,li.LateArrival,li.EarlyDepart,li.ScheduleDepart AS Depart,sh.Name AS ScheduleName,li.ScheduleArrival AS ScheduleArrivalTime,li.ScheduleDepart AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.ActualDate = lo.ActualDate  WHERE e.Status = '".$_SESSION['EmpTypeLedger']."' AND (li.ActualDate BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND FIND_IN_SET(e.CompanyID,\''.$_SESSION['CompanyIDLedger'].'\')' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND FIND_IN_SET(e.Location,\''.$_SESSION['LocationLedger'].'\')' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['EmpTypeLedger'] != '' ? ' AND e.Status = "'.$_SESSION['EmpTypeLedger'].'"' : '')." ".($_SESSION['SortTypeLedger'] != "" ? ' AND li.Status = \''.$_SESSION['SortTypeLedger'].'\'' : '')." ".($_SESSION['LateLedger'] == 1 ? ' AND li.Late = 1' : '')." ".($_SESSION['EarlyDepLedger'] == 1 ? ' AND li.EarlyDep = 1' : '')." ".($_SESSION['HalfDayLedger'] == 1 ? ' AND li.HalfDay = 1' : '')."  ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].',li.ActualDate,e.EmpID ASC' : '')." ";
				
				//echo $query;exit();
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
								 <!--<input type="text" name="" class="form-control"  <?php echo 'value="'.$_SESSION['FromDateLedger'].'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask />-->
								 <input type="date" id="FromDate" name="FromDate" class="form-control"  <?php echo 'value="'.$_SESSION['FromDateLedger'].'"'; ?> />
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
								 <!--<input type="text" id="" name="" class="form-control"  <?php echo 'value="'.$_SESSION['TillDateLedger'].'"'; ?> data-inputmask="'alias': 'dd-mm-yyyy'" data-mask />-->
								 <input type="date" id="TillDate" name="TillDate" class="form-control"  <?php echo 'value="'.$_SESSION['TillDateLedger'].'"'; ?> />
							</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'li.LoginDate' ? 'selected' : ''); ?> value="li.LoginDate">Date</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($_SESSION['SortByLedger'] == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort Type:
							 <select name="SortType" id="SortType" class="form-control">
								<option value="">All</option>
								<option <?php echo ($_SESSION['SortTypeLedger'] == 'Present' ? 'selected' : ''); ?> value="Present">Present</option>
								<!--<option <?php //echo ($_SESSION['SortTypeLedger'] == 'Late' ? 'selected' : ''); ?> value="Late">Late Arrival</option>
								<option <?php //echo ($_SESSION['SortTypeLedger'] == 'Early Departure' ? 'selected' : ''); ?> value="Early Departure">Early Departure</option>
								<option <?php //echo ($_SESSION['SortTypeLedger'] == 'Halfday' ? 'selected' : ''); ?> value="Halfday">Halfday</option>-->
								<option <?php echo ($_SESSION['SortTypeLedger'] == 'Leave' ? 'selected' : ''); ?> value="Leave">Leave</option>
								<option <?php echo ($_SESSION['SortTypeLedger'] == 'Off Day' ? 'selected' : ''); ?> value="Off Day">Offday</option>
								<option <?php echo ($_SESSION['SortTypeLedger'] == 'Absent' ? 'selected' : ''); ?> value="Absent">Absent</option>
								<!--<option <?php //echo ($_SESSION['SortTypeLedger'] == 'Overtime' ? 'selected' : ''); ?> value="Overtime">Overtime</option>-->
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							Company:
							 <div class="selectBox" onclick="showCheckboxes()">
									<select class="form-control">
										<option>Select Companies</option>
									</select>
									<div class="overSelect"></div>
								</div>
								<div id="checkboxes" style="height:250px; overflow:scroll;">						
									<?php					
									$query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
									$res = mysql_query($query) or die(mysql_error());
									while($row = mysql_fetch_array($res))
									{						
									echo '<label><input '.(in_array($row['ID'], $_SESSION['CompanyIDLedgerArray']) ? "checked = checked" : "").' type="checkbox" name="CompanyID[]" value="'.$row['ID'].'"/>&ensp;'.$row['Name'].'</label>';
									} 
									?>
							  </div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							Location:
							 <div class="selectBox" onclick="showCheckboxes2()">
									<select class="form-control">
										<option>Select Location</option>
									</select>
									<div class="overSelect"></div>
								</div>
								<div id="checkboxes2" style="height:250px; overflow:scroll;">						
									<?php					
									$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
									$res = mysql_query($query) or die(mysql_error());
									while($row = mysql_fetch_array($res))
									{						
									echo '<label><input '.(in_array($row['ID'], $_SESSION['LocationLedgerArray']) ? "checked = checked" : "").' type="checkbox" name="Location[]" value="'.$row['ID'].'"/>&ensp;'.$row['Name'].' | '.$row['Abr'].'</label>';
									} 
									?>
							  </div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
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
						<div class="col-lg-3 col-xs-12">
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
                        
                       <div class="col-lg-3 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ".($_SESSION['EmpTypeLedger'] != '' ? ' AND Status = "'.$_SESSION['EmpTypeLedger'].'"' : '')." ORDER BY ID ASC";
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
						
					   </div>
					   <div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Employee Status:
							<select name="EmpType" id="EmpType" class="form-control">
							<option value="" >Both Active and Deactive</option>
							<option <?php echo ($_SESSION['EmpTypeLedger'] == 'Active' ? 'selected' : ''); ?> value="Active">Active</option>
							<option <?php echo ($_SESSION['EmpTypeLedger'] == 'Deactive' ? 'selected' : ''); ?> value="Deactive">Deactive</option>
							</select>
						</div>
						</div><!-- ./col -->
                        
                        <style>
                        .new-span-for-icon{
                            width: 90px;
                            display: inline-block;
                            margin-bottom: 5px;
                        }
                        </style>
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  <input type="radio" <?php echo ($Legends == 1 ? ' checked="checked"' : ''); ?> value="1" name="Legends" id="legendsyes"> <label for="legendsyes">Show Legends</label>&emsp;
						  <input type="radio" <?php echo ($Legends == 0 ? ' checked="checked"' : ''); ?> value="0" name="Legends" id="legendsno"> <label for="legendsno">Hide Legends</label><br>
						<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:white">&emsp;&nbsp;</i> Present </span>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:red">&emsp;&nbsp;</i> Absent </span>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:yellow">&emsp;&nbsp;</i> Leave </span>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:lightgreen">&emsp;&nbsp;</i> Late </span><div style=
						"height:2px"></div>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:#c1c1c1">&emsp;&nbsp;</i> Modified </span>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:pink">&emsp;&nbsp;</i> Off Day&thinsp; </span>
					<span class='new-span-for-icon'>	<i style="width:10px;height:10px;border:1px black solid;background-color:lightblue">&emsp;&nbsp;</i> Half Day </span>
						
						
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
                           <div class="form-group">
						   <input type="checkbox" <?php echo ($_SESSION['LateLedger'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="LateLedger" name="LateLedger"> <label for="LateLedger">Late</label>&nbsp;
						   <input type="checkbox" <?php echo ($_SESSION['EarlyDepLedger'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="EarlyDepLedger" name="EarlyDepLedger"> <label for="EarlyDepLedger">Early</label>&nbsp;
						   <input type="checkbox" <?php echo ($_SESSION['HalfDayLedger'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="HalfDayLedger" name="HalfDayLedger"> <label for="HalfDayLedger">Halfday</label><br>
						   
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
						<!--<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Headings" >Print Mode: </label>
								<input type="radio" <?php //echo ($PrintMode == 1 ? ' checked="checked"' : ''); ?> value="1" name="PrintMode" id="On"><label for="On">On</label>
								<input type="radio" <?php //echo ($PrintMode == 0 ? ' checked="checked"' : ''); ?> value="0" name="PrintMode" id="Off"><label for="Off">Off</label><br>
							</div>
							<br>
						</div>
						<div class="col-lg-1 col-xs-12 no-print">
							<div class="form-group">
								<label id="labelimp" for="Rows" >Rows: </label>
								<input class="form-control" type="number"  value="<?php //echo $Rows; ?>" name="Rows" id="Rows">
							</div>
							<br>
						</div>-->
						
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
                
  
                <?php if($PrintMode == 0){ ?>  
              <table class="blue table table-bordered" id="tblExport">
                  <thead class="">
					<tr class="no-print">
					<th colspan="20" style="text-align:right;background-color:white;">
               <!-- <button disabled type="submit" class="btn btn-default margin">Present</button>
				<button disabled type="submit" class="btn btn-danger margin">Absent</button>-->
				<!---->
				<a class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</a>
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-print"></i> Excel</button>
				<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
				<!--<button type="button" onClick="javascript:DeleteRecord()" class="btn btn-danger margin no-print">Delete Record</button>-->
				<?php } ?>
				<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
				<!--<button type="button" onClick="javascript:DeleteTime()" class="btn btn-danger margin no-print">Delete Time</button>
				<button type="button" onClick="javascript:DeleteLeave()" class="btn btn-danger margin no-print">Delete Leave</button>
				<button type="button" onClick="javascript:ForcefullyAbsent()" class="btn btn-danger margin no-print">Forcefully Absent</button>
				<button type="button" onClick="javascript:GrantLeaves()" class="btn btn-warning margin no-print">Leave Adjust</button>-->
				<button type="button" onClick="javascript:TimeAdjust()" class="btn btn-white margin no-print">Time Adjust</button>
				<!--<button type="button" onClick="javascript:ArrivalTimeAdjust()" class="btn btn-white margin no-print">Arrival Time Adjust</button>
				<button type="button" onClick="javascript:DepartTimeAdjust()" class="btn btn-white margin no-print">Depart Time Adjust</button>
				<button type="button" onClick="javascript:UpdateRoster()" class="btn bg-navy margin no-print">Update Roster</button>-->
				<?php } ?>
				<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
				<!--<button type="button" onClick="javascript:HiddenTimeAdjust()" class="btn btn-white margin no-print">Hidden Time Adjust</button>-->
				<?php } ?>
				<!--<button disabled type="submit" class="btn bg-navy margin">Cancle Off Day</button>--
				>
                <!--<button class="btn btn-primary margin" type="button" onClick="location.href='Employees.php'">Cancel</button>-->
				<div style="height:8px;"></div>
				</th>
            </tr>
                    <tr style="color:white;">
					  <th>S#</th>
                      <th style="text-align:center;"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Date</th>
					  <th>Time In</th>
                      <th>Time Out</th>
					  <th>Mod<br>Time In</th>
                      <th>Mod<br>Time Out</th>
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
				// 		list($hours, $minutes) = explode(':', $row["ScheduleArrivalTime"]);
				// 		$startTimestamp = mktime($hours, $minutes);
				// 		list($hours, $minutes) = explode(':', $row["ScheduleDepartTime"]);
				// 		$endTimestamp = mktime($hours, $minutes);
				// 		$seconds = $endTimestamp - $startTimestamp;
				// 		$minutes = ($seconds / 60) % 60;
				// 		$hours = floor($seconds / (60 * 60));
						
				// 		$TotalHours = $TotalHours + $hours;
				// 		$TotalMinutes = $TotalMinutes + $minutes;
						
						list($hours, $minutes) = explode(':', $row["ScheduleArrivalTime"]);
							$startTimestamp = mktime($hours, $minutes);

							list($hours, $minutes) = explode(':', $row["ScheduleDepartTime"]);
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
		                    else{
		                        $seconds = $endTimestamp - $startTimestamp; 
		                    }
                            
							
							$minutes = ($seconds / 60) % 60;
							$hours = floor($seconds / (60 * 60));
							
							if($hours < 0)
							$hours = ($hours + 24);
							
							
						$TotalHours = $TotalHours + $hours;
						$TotalMinutes = $TotalMinutes + $minutes;
					}
					
					$isovertime = 0;
					
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
									$minutes = ($seconds / 60);
									
									$isovertime = $minutes;

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
										//code start
										$seconds += ($row4['ApplyAfter'] * 60);
										//code end
										$minutes = ($seconds / 60);
										
										$isovertime = $minutes;
									}
								  }
							}
							
							}
						}
		?>
                    <tr <?php echo ($isovertime > 0 ? ($_SESSION['OvertimeLedger'] == 1 ? 'style="display:none;"' : '') : '' ); ?> <?php echo ($row["Status"] == 'Absent' ? ($Legends == 1 ? 'style="background-color:red;color:white;"' : '') : '' ); ?><?php echo ($row["Status"] == 'Off Day' ? ($Legends == 1 ? 'style="background-color:pink;"' : '') : '' ); ?><?php echo ($row["Status"] == 'Leave' ? ($Legends == 1 ? 'style="background-color:yellow;"' : '') : '' ); ?><?php echo ($row["HalfDay"] == 1 ? ($Legends == 1 ? 'style="background-color:lightblue;color:black"' : '') : '' ); ?><?php echo ($row["Late"] == 1 || $row["EarlyDep"] == 1 ? ($Legends == 1 ? 'style="background-color:lightgreen;color:black"' : '') : '' ); ?>>
					  <td><?php echo $i; ?></td>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $ID; ?>"></td>
					  <td style="text-align:left;"><?php echo dboutput($row['EmpID']); ?></td>
					  <td style="text-align:left;"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
					  <!--<td><?php //echo dboutput($row['Designation']); ?></td>
					  <td><?php //echo dboutput($row['Department']); ?></td>-->
					  <td><?php echo dboutput($row["Day"])."<br>".dboutput($row["Date"]); ?></td>
					  <td <?php echo (dboutput($row["MArrivalTime"]) != NULL ? ($Legends == 1 ? 'style="background-color:#c1c1c1;"' : '') : ''); ?>><?php echo (dboutput($row["ArrivalTime"]) == NULL ? '' : dboutput($row["ArrivalTime"])); ?></td>
					  <td <?php echo (dboutput($row["MDepartTime"]) != NULL ? ($Legends == 1 ? 'style="background-color:#c1c1c1;"' : '') : ''); ?>><?php echo (dboutput($row["DepartTime"]) == NULL ? '' : dboutput($row["DepartTime"])); ?></td>
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
							
							$newTimestamp1 = mktime(00, 00);
							$newTimestamp2 = mktime(23, 59);

                            $T = explode(' ',$row["DepartTime"]);
							$T1 = explode(' ',$row["ArrivalTime"]);
		                    $AMPM = $T[1];
							$AMPM1 = $T1[1];
		                    
							if($AMPM1 == "AM" && $AMPM == "AM")
		                    {
		                     $seconds =  $endTimestamp - $startTimestamp;   
		                    }
							else if($AMPM1 == "AM"  && $AMPM == "PM")
		                    {
		                     $seconds = $endTimestamp - $startTimestamp;    
		                    }
							else if($AMPM1 == "PM"  && $AMPM == "PM")
		                    {
		                     $seconds = $endTimestamp - $startTimestamp;   
		                    }
							else if($AMPM1 == "PM"  && $AMPM == "AM")
		                    {
							$seconds2=0;
		                     $seconds =  $endTimestamp - $newTimestamp1;
							 $seconds2 =  $newTimestamp2 - $startTimestamp;
							 $seconds2 = abs($seconds2);
							 $seconds = $seconds + $seconds2;
							 $seconds += 60;
							 
		                    }
                            
							
							$minutes = ($seconds / 60) % 60;
							$hours = floor($seconds / (60 * 60));
							
							if($AMPM1 == "PM"  && $AMPM == "PM")
		                    {
		                     //$hours = ($hours + 24);
		                    }
							else if($AMPM1 == "PM"  && $AMPM == "AM")
		                    {
		                      //$hours = ($hours + 24);
		                    }
							
							if($hours < 0)
							$hours = ($hours + 24);
							
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

									$T = explode(' ',$row["DepartTime"]);
									$T1 = explode(' ',$row["ArrivalTime"]);
									$AMPM = $T[1];
									$AMPM1 = $T1[1];
									
									if($AMPM1 == "AM" && $AMPM == "AM")
									{
									 $seconds =  $endTimestamp - $startTimestamp;   
									}
									else if($AMPM1 == "AM"  && $AMPM == "PM")
									{
									 $seconds = $endTimestamp - $startTimestamp;    
									}
									else if($AMPM1 == "PM"  && $AMPM == "PM")
									{
									 $seconds = $endTimestamp - $startTimestamp;   
									}
									else if($AMPM1 == "PM"  && $AMPM == "AM")
									{
									 $seconds = $endTimestamp - $startTimestamp;
									 $seconds = abs($seconds);									 
									}
									
									$minutes = ($seconds / 60) % 60;
									$hours = floor($seconds / (60 * 60));
									
									
									

									
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
										//code start
										$seconds += ($row4['ApplyAfter'] * 60);
										//code end
										$minutes = ($seconds / 60) % 60;
										$hours = floor($seconds / (60 * 60));

										// if($row["Night"] == 0)
										// {
										echo "<b>$hours</b>H / <b>$minutes</b>M";
										
										
										$TotalOvertimeHours = $TotalOvertimeHours + $hours;
										$TotalOvertimeMinutes = $TotalOvertimeMinutes + $minutes;
										
										$TotalOvertimeHoursWorking = $TotalOvertimeHoursWorking + $hours;
										$TotalOvertimeMinutesWorking = $TotalOvertimeMinutesWorking + $minutes;
										// }
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
				  
				  $TotalOvertimeMinutesWorking = round(($TotalOvertimeMinutesWorking / 60));
				  $TotalOvertimeHoursWorking = $TotalOvertimeHoursWorking + $TotalOvertimeMinutesWorking;
				  
				  $TotalOvertimeMinutesHolidays = round(($TotalOvertimeMinutesHolidays / 60));
				  $TotalOvertimeHoursHolidays = $TotalOvertimeHoursHolidays + $TotalOvertimeMinutesHolidays;
				  
				  if($maxRow>0)
					{
				  ?>
					<tr>
					  <td style="color:white;background-color:black;" colspan="20">Total Days: <?php echo $TotalDays; ?>, Present: <?php echo $TotalPresent; ?>, Absent <?php echo $TotalAbsent; ?>, OffDays <?php echo $TotalOffDays; ?>, Leaves <?php echo $TotalLeaves; ?>, Halfdays <?php echo $TotalHalfdays; ?>, Lates <?php echo $TotalLates; ?>, EarlyDepart <?php echo $TotalEarlyDepart; ?>, Total Hours <?php echo $TotalHours; ?>, Working Hours <?php echo $TotalWorkingHours; ?>, DifferenceWorkingHours <?php echo $TotalHours - $TotalWorkingHours; ?>, Working OT Hours <?php echo $TotalOvertimeHoursWorking; ?>, Holidays OT Hours <?php echo $TotalOvertimeHoursHolidays; ?></td>
                    </tr>
				<?php 
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
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
