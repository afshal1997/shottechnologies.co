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

$PrintMode=0;
$Rows=10;

	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>


<?php
$_SESSION['PayrollPreviousMonthAuditReport'] = "";


if(!isset($_SESSION['PayrollMonthAuditReport']))
$_SESSION['PayrollMonthAuditReport']=date('M Y');

if(!isset($_SESSION['PayrollCompanyIDAuditReport']))
$_SESSION['PayrollCompanyIDAuditReport']=0;

				




if(isset($_REQUEST["PayrollMonth"]))
		$_SESSION['PayrollMonthAuditReport']=trim($_REQUEST["PayrollMonth"]);
if(isset($_REQUEST["CompanyID"]))
		$_SESSION['PayrollCompanyIDAuditReport']=trim($_REQUEST["CompanyID"]);
	
	
$c = strtotime($_SESSION['PayrollMonthAuditReport']);
$d=strtotime("-1 Months",$c);	
$_SESSION['PayrollPreviousMonthAuditReport']=date("M Y", $d);

$LastMonthDate=date("Y-m-26", $d);
$c=strtotime("+1 Months",$d);
$CurrentMonthDate=date("Y-m-25", $c);

//echo $LastMonthDate.' & '.$CurrentMonthDate;

if(isset($_REQUEST["PrintMode"]))
	$PrintMode=trim($_REQUEST["PrintMode"]);
if(isset($_REQUEST["Rows"]))
	$Rows=(int)$_REQUEST["Rows"];

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
<title>Salary Reconciliation / Audit Report</title>
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

.chkIds[type="checkbox"]{
  width: 30px; /*Desired width*/
  height: 30px; /*Desired height*/
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

				
				
				//$query="SELECT li.ID,li.Status,li.MStatus,li.HalfDay,li.Late,li.EarlyDep,li.DateAdded AS CheckDate ,li.LoginDate,DATE_FORMAT(li.LoginDate, '%D %b %Y') AS Date , DATE_FORMAT(li.LoginDate, '%W') AS Day , DATE_FORMAT(li.LoginTime, '%h:%i %p') AS ArrivalTime ,DATE_FORMAT(li.LoginTime, '%T') AS TArrivalTime ,li.LoginTime AS LoginAdjust,DATE_FORMAT(li.MLoginTime, '%h:%i %p') AS MArrivalTime , DATE_FORMAT(lo.LogoutTime, '%h:%i %p') AS DepartTime,DATE_FORMAT(lo.LogoutTime, '%T') AS TDepartTime,lo.LogoutTime AS LogoutAdjust,DATE_FORMAT(lo.MLogoutTime, '%h:%i %p') AS MDepartTime,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.OvertimePolicy,sh.LateArrival,sh.EarlyDepart,sh.DepartTime AS Depart,sh.Name AS ScheduleName,sh.ArrivalTime AS ScheduleArrivalTime,sh.DepartTime AS ScheduleDepartTime FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded  WHERE e.Status = 'Active' AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['SortTypeLedger'] != "" ? ' AND li.Status = \''.$_SESSION['SortTypeLedger'].'\'' : '')." ".($_SESSION['LateLedger'] == 1 ? ' AND li.Late = 1' : '')." ".($_SESSION['EarlyDepLedger'] == 1 ? ' AND li.EarlyDep = 1' : '')." ".($_SESSION['HalfDayLedger'] == 1 ? ' AND li.HalfDay = 1' : '')." ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].',li.DateAdded,e.EmpID ASC' : '')." ";
				
					
				$query="SELECT ID FROM payroll WHERE MonthPayroll = '".$_SESSION['PayrollMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND ID <> 0";
				
				
				
				//echo $query; exit();
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Salary Reconciliation / Audit Report <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Salary Reconciliation / Audit Report</li>
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
							  <label id="labelimp2" for="Role" >Payroll Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<div class="form-group">
							  Payroll Month:
							  <select name="PayrollMonth" id="PayrollMonth" class="form-control">
								<option value="">Select Payroll Month</option>
								<?php
								 $query = "SELECT DISTINCT MonthPayroll FROM payroll where ID <> 0 ORDER BY ID DESC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollMonthAuditReport'] == $row['MonthPayroll'] ? 'selected' : '').' value="'.$row['MonthPayroll'].'">'.$row['MonthPayroll'].'</option>';
								} 
								?>
							  </select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<div class="form-group">
							  Company:
							  <select name="CompanyID" id="CompanyID" class="form-control">
								<option value="">All Companies</option>
								<?php
								 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollCompanyIDAuditReport'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
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
						<div class="col-lg-4 col-xs-12 no-print">
                           <div class="form-group">		
							<br>
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			
			<div class="box-footer no-print" style="text-align:right;">
               <!-- <button disabled type="submit" class="btn btn-default margin">Present</button>
				<button disabled type="submit" class="btn btn-danger margin">Absent</button>-->
				<button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
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
		 
              <table class="blue table table-bordered">
                  <thead class="">
                    <tr style="color:white;">
					  <th>S#</th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>CNIC#</th>
					  <th>Appointment Date</th>
					  <th>Left Date</th>
					  <th>Company</th>
					  <th>Location</th>
                      <th>Department</th>
					  <th>Gross Payment</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="20" align="center" class="error"><b>No Data listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$i=1;
				$amnt=0;
				
				$query2="SELECT COUNT(pd.EmpID) AS HeadCount,SUM(pd.Gross) AS Gross FROM payroll p LEFT JOIN payrolldetails pd ON pd.PayID = p.ID WHERE p.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND p.ID <> 0";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
				?>
				<tr style="background-color:black;color:white;">
					  <th colspan="10"><?php echo '&emsp;&emsp;&emsp;Last Month&emsp;&emsp;&emsp;Head Count: '.$row2['HeadCount'].'&emsp;&emsp;&emsp;Gross Payment: '.number_format($row2['Gross'],2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10">&emsp;&emsp;&emsp;Employee Joined</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,e.Salary,c.Name AS CompanyName,l.Name AS LocationName FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE e.ID <> 0 AND (e.JoiningDate BETWEEN '".date_format_Ymd($LastMonthDate)."' AND '".date_format_Ymd($CurrentMonthDate)."') ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')."";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td></td>
						  <td><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td><?php echo dboutput($row2["Department"]); ?></td>
						  <td><?php echo dboutput($row2["Salary"]); $amnt = $amnt + $row2["Salary"]; ?></td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10"><?php echo '&emsp;&emsp;&emsp;Employee Joined&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10">&emsp;&emsp;&emsp;Employee Left</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,DATE_FORMAT(e.LeavingDate, '%D %b %Y') AS LeavingDate,e.Salary,c.Name AS CompanyName,l.Name AS LocationName FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE e.ID <> 0 AND (e.LeavingDate BETWEEN '".date_format_Ymd($LastMonthDate)."' AND '".date_format_Ymd($CurrentMonthDate)."') ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')."";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td><?php echo dboutput($row2["LeavingDate"]); ?></td>
						  <td><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td><?php echo dboutput($row2["Department"]); ?></td>
						  <td><?php echo dboutput($row2["Salary"]); $amnt = $amnt + $row2["Salary"]; ?></td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10"><?php echo '&emsp;&emsp;&emsp;Employee Left&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10">&emsp;&emsp;&emsp;Employee Change</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,DATE_FORMAT(e.LeavingDate, '%D %b %Y') AS LeavingDate,pd1.Gross AS Salary,c.Name AS CompanyName,l.Name AS LocationName FROM payroll p1 LEFT JOIN payrolldetails pd1 ON pd1.PayID = p1.ID LEFT JOIN employees e ON pd1.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p1.ID <> 0 AND p1.MonthPayroll = '".$_SESSION['PayrollMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p1.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND pd1.EmpID IN (SELECT e.ID FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '').") AND pd1.Gross NOT IN (SELECT pd2.Gross FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '').")";
				//echo $query2; exit();
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td><?php echo dboutput($row2["LeavingDate"]); ?></td>
						  <td><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td><?php echo dboutput($row2["Department"]); ?></td>
						  <td>
						  <?php 
						  $query4="SELECT pd2.Gross FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND pd2.EmpID = ".$row2["EmpID"]."";
						  $result4 = mysql_query ($query4) or die(mysql_error()); 
						  $maxRow4 = mysql_num_rows($result4);
						  if($maxRow4 == 1)
						  {
							 $row4 = mysql_fetch_array($result4,MYSQL_ASSOC);
							 $row2["Salary"] = $row2["Salary"] - $row4["Gross"];
						  }
						  echo $row2["Salary"]; 
						  $amnt = $amnt + $row2["Salary"]; ?>
						  </td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10"><?php echo '&emsp;&emsp;&emsp;Employee Change&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
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
	<?php if($PrintMode == 1){ ?>
			<div id="printable">
				<table class="blue table table-bordered" style="border:none">
                  <thead class="">
                    <tr style="color:white;" class="head">
					  <th style="width:40px">S#</th>
                      <th style="width:50px">Code</th>
					  <th style="width:135px">Employee</th>
					  <th style="width:130px">CNIC#</th>
					  <th style="width:130px">Appointment Date</th>
					  <th style="width:130px">Left Date</th>
					  <th style="width:130px">Company</th>
					  <th style="width:130px">Location</th>
                      <th style="width:130px">Department</th>
					  <th style="width:125px">Gross Payment</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="20" align="center" class="error" style="width:1130px"><b>No Data listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$i=1;
				$amnt=0;
				
				$query2="SELECT COUNT(pd.EmpID) AS HeadCount,SUM(pd.Gross) AS Gross FROM payroll p LEFT JOIN payrolldetails pd ON pd.PayID = p.ID WHERE p.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND p.ID <> 0";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
				?>
				<tr style="background-color:black;color:white;">
					  <th colspan="10" style="width:1130px"><?php echo '&emsp;&emsp;&emsp;Last Month&emsp;&emsp;&emsp;Head Count: '.$row2['HeadCount'].'&emsp;&emsp;&emsp;Gross Payment: '.number_format($row2['Gross'],2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10" style="width:1130px">&emsp;&emsp;&emsp;Employee Joined</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,e.Salary,c.Name AS CompanyName,l.Name AS LocationName FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE e.ID <> 0 AND (e.JoiningDate BETWEEN '".date_format_Ymd($LastMonthDate)."' AND '".date_format_Ymd($CurrentMonthDate)."') ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')."";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td style="width:40px"><?php echo $i; ?></td>
						  <td style="width:50px"><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td style="width:135px"><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td style="width:130px"></td>
						  <td style="width:130px"><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["Department"]); ?></td>
						  <td style="width:125px"><?php echo dboutput($row2["Salary"]); $amnt = $amnt + $row2["Salary"]; ?></td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10" style="width:1130px"><?php echo '&emsp;&emsp;&emsp;Employee Joined&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10" style="width:1130px">&emsp;&emsp;&emsp;Employee Left</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,DATE_FORMAT(e.LeavingDate, '%D %b %Y') AS LeavingDate,e.Salary,c.Name AS CompanyName,l.Name AS LocationName FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE e.ID <> 0 AND (e.LeavingDate BETWEEN '".date_format_Ymd($LastMonthDate)."' AND '".date_format_Ymd($CurrentMonthDate)."') ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')."";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td style="width:40px"><?php echo $i; ?></td>
						  <td style="width:50px"><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td style="width:135px"><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["LeavingDate"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["Department"]); ?></td>
						  <td style="width:125px"><?php echo dboutput($row2["Salary"]); $amnt = $amnt + $row2["Salary"]; ?></td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10" style="width:1130px"><?php echo '&emsp;&emsp;&emsp;Employee Left&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
                </tr>
				<tr style="background-color:#0897A0;color:white;">
					  <th colspan="10" style="width:1130px">&emsp;&emsp;&emsp;Employee Change</th>
                </tr>
				<?php
				$i=1;
				$amnt=0;
				$query2="SELECT e.EmpID,e.FirstName,e.LastName,e.CNICNumber,e.Department,DATE_FORMAT(e.JoiningDate, '%D %b %Y') AS JoiningDate,DATE_FORMAT(e.LeavingDate, '%D %b %Y') AS LeavingDate,pd1.Gross AS Salary,c.Name AS CompanyName,l.Name AS LocationName FROM payroll p1 LEFT JOIN payrolldetails pd1 ON pd1.PayID = p1.ID LEFT JOIN employees e ON pd1.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p1.ID <> 0 AND p1.MonthPayroll = '".$_SESSION['PayrollMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p1.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND pd1.EmpID IN (SELECT e.ID FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '').") AND pd1.Gross NOT IN (SELECT pd2.Gross FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '').")";
				//echo $query2; exit();
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$maxRow2 = mysql_num_rows($result2);
				if($maxRow2 > 0)
				{
					while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
					{
						?>
						<tr>
						  <td style="width:40px"><?php echo $i; ?></td>
						  <td style="width:50px"><?php echo dboutput($row2["EmpID"]); ?></td>
						  <td style="width:135px"><?php echo dboutput($row2['FirstName']).' '.dboutput($row2['LastName']); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["CNICNumber"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["JoiningDate"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["LeavingDate"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["CompanyName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["LocationName"]); ?></td>
						  <td style="width:130px"><?php echo dboutput($row2["Department"]); ?></td>
						  <td style="width:125px">
						  <?php 
						  $query4="SELECT pd2.Gross FROM payroll p2 LEFT JOIN payrolldetails pd2 ON pd2.PayID = p2.ID LEFT JOIN employees e ON pd2.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID WHERE p2.ID <> 0 AND p2.MonthPayroll = '".$_SESSION['PayrollPreviousMonthAuditReport']."' ".($_SESSION['PayrollCompanyIDAuditReport'] != "" ? ' AND p2.CompanyID = '.$_SESSION['PayrollCompanyIDAuditReport'].'' : '')." AND pd2.EmpID = ".$row2["EmpID"]."";
						  $result4 = mysql_query ($query4) or die(mysql_error()); 
						  $maxRow4 = mysql_num_rows($result4);
						  if($maxRow4 == 1)
						  {
							 $row4 = mysql_fetch_array($result4,MYSQL_ASSOC);
							 $row2["Salary"] = $row2["Salary"] - $row4["Gross"];
						  }
						  echo $row2["Salary"]; 
						  $amnt = $amnt + $row2["Salary"]; ?>
						  </td>
						</tr>
						<?php
						$i++;
					}
				}
				
				?>
				<tr style="background-color:#589093;color:white;">
					  <th colspan="10" style="width:1130px"><?php echo '&emsp;&emsp;&emsp;Employee Change&emsp;&emsp;&emsp;Head Count: '.$maxRow2.'&emsp;&emsp;&emsp;Gross Payment: '.number_format($amnt,2); ?></th>
                </tr>
				<?php
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
