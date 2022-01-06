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
if(!isset($_SESSION['PayrollMonthReport']))
{
$_SESSION['PayrollMonthReport']=array();
$_SESSION['PayrollMonthReportString']="";
}

if(!isset($_SESSION['AllDedReport']))
$_SESSION['AllDedReport']="AllDed";

if(!isset($_SESSION['PayrollAllReport']))
$_SESSION['PayrollAllReport']="";

if(!isset($_SESSION['PayrollDedReport']))
$_SESSION['PayrollDedReport']="";

if(!isset($_SESSION['PayrollCompanyIDReport']))
$_SESSION['PayrollCompanyIDReport']= ($_SESSION['UserID'] == 399 ? 6 : ($_SESSION['UserID'] == 213 ? 4 : 1000));

if(!isset($_SESSION['PayrollLocationReport']))
$_SESSION['PayrollLocationReport']=0;

if(!isset($_SESSION['PayrollDesignationReport']))
$_SESSION['PayrollDesignationReport']="";

if(!isset($_SESSION['PayrollDepartmentReport']))
$_SESSION['PayrollDepartmentReport']="";

if(!isset($_SESSION['PayrollEmployeeReport']))
$_SESSION['PayrollEmployeeReport']=0;

if(!isset($_SESSION['PayrollSortByReport']))
$_SESSION['PayrollSortByReport']="e.EmpID";

if(!isset($_SESSION['PayrollLoans']))
$_SESSION['PayrollLoans']=0;

if(!isset($_SESSION['PayrollAdvances']))
$_SESSION['PayrollAdvances']=0;

if(!isset($_SESSION['PayrollInvestment']))
$_SESSION['PayrollInvestment']="";

if(!isset($_SESSION['PayrollIncomeTax']))
$_SESSION['PayrollIncomeTax']=0;

if(!isset($_SESSION['PayrollBankCash']))
$_SESSION['PayrollBankCash']=3;					




if(isset($_REQUEST["PayrollMonth"]))
{
	$_SESSION['PayrollMonthReport']=$_REQUEST["PayrollMonth"];
	$_SESSION['PayrollMonthReportString']=implode(',',$_SESSION['PayrollMonthReport']);
}
else
{
	$_SESSION['PayrollMonthReport']=array();
	$_SESSION['PayrollMonthReportString']="";
}
		
if(isset($_REQUEST["AllDed"]))
		$_SESSION['AllDedReport']=trim($_REQUEST["AllDed"]);
if(isset($_REQUEST["PayrollAllReport"]))
		$_SESSION['PayrollAllReport']=trim($_REQUEST["PayrollAllReport"]);
if(isset($_REQUEST["PayrollDedReport"]))
		$_SESSION['PayrollDedReport']=trim($_REQUEST["PayrollDedReport"]);
if(isset($_REQUEST["CompanyID"]))
		$_SESSION['PayrollCompanyIDReport']=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
		$_SESSION['PayrollLocationReport']=trim($_REQUEST["Location"]);
if(isset($_REQUEST["Designation"]))
		$_SESSION['PayrollDesignationReport']=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
		$_SESSION['PayrollDepartmentReport']=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SortBy"]))
		$_SESSION['PayrollSortByReport']=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["Employee"]))
		$_SESSION['PayrollEmployeeReport']=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["PayrollInvestment"]))
		$_SESSION['PayrollInvestment']=trim($_REQUEST["PayrollInvestment"]);
if(isset($_REQUEST["PayrollBankCash"]))
		$_SESSION['PayrollBankCash']=trim($_REQUEST["PayrollBankCash"]);
	
if(isset($_REQUEST["PayrollLoans"]))
{
	if($_REQUEST["PayrollLoans"] == 1)
	$_SESSION['PayrollLoans']=1;
	else
	$_SESSION['PayrollLoans']=0;
}
else
{
	$_SESSION['PayrollLoans']=0;
}

if(isset($_REQUEST["PayrollAdvances"]))
{
	if($_REQUEST["PayrollAdvances"] == 1)
	$_SESSION['PayrollAdvances']=1;
	else
	$_SESSION['PayrollAdvances']=0;
}
else
{
	$_SESSION['PayrollAdvances']=0;
}

if(isset($_REQUEST["PayrollIncomeTax"]))
{
	if($_REQUEST["PayrollIncomeTax"] == 1)
	$_SESSION['PayrollIncomeTax']=1;
	else
	$_SESSION['PayrollIncomeTax']=0;
}
else
{
	$_SESSION['PayrollIncomeTax']=0;
}
	
	
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
<title>Payroll Reports</title>
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
<script type="text/javascript" async="async" id="true" src="excel/views2.json"></script>
<script type="text/javascript" src="excel/300lo.json"></script>
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
				
				if($_SESSION['AllDedReport'] == 'AllDed')
				{
					
					$query="SELECT pdd.Name,pdd.Type,pdd.Amount,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldeductiondetails pdd ON p.ID = pdd.PayID LEFT JOIN employees e ON pdd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."') ".($_SESSION['PayrollDedReport'] != "" ? ' AND pdd.Name = \''.$_SESSION['PayrollDedReport'].'\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pdd.Amount <> 0
				
				UNION ALL
				
				SELECT pal.Name,pal.Type,pal.Amount,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollallowancedetails pal ON p.ID = pal.PayID LEFT JOIN employees e ON pal.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAllReport'] != "" ? ' AND pal.Name = \''.$_SESSION['PayrollAllReport'].'\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pal.Amount <> 0
				
				UNION ALL
				
				SELECT pcd.Name,pcd.Type,".($_SESSION['PayrollInvestment'] == "Employee" ? 'pcd.EmployeeContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? 'pcd.EmployerContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? 'pcd.Amount,' : '')."".($_SESSION['PayrollInvestment'] == "" ? 'pcd.Amount,' : '')."e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollcontributiondetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollInvestment'] == "" ? ' AND pcd.Name=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." ".($_SESSION['PayrollInvestment'] == "Employee" ? ' AND pcd.EmployeeContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? ' AND pcd.EmployerContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? ' AND pcd.Amount <> 0' : '')." 
				
				UNION ALL
				
				SELECT pln.Type AS Name,'Loan Deduction' AS Type,pln.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollloandetails pln ON p.ID = pln.PayID LEFT JOIN employees e ON pln.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollLoans'] == 0 ? ' AND pln.Type=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pln.Amount <> 0
				
				UNION ALL
				
				SELECT 'Advance' AS Name,'Advance Deduction' AS Type,pad.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolladvancedetails pad ON p.ID = pad.PayID LEFT JOIN employees e ON pad.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAdvances'] == 0 ? ' AND pad.AdvID=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pad.Amount <> 0
				
				UNION ALL
				
				SELECT 'Income Tax' AS Name,'Tax Deduction' AS Type,pd.IncomeTax AS Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollIncomeTax'] == 0 ? ' AND pd.Basic=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pd.IncomeTax <> 0
				";
					
				}
				if($_SESSION['AllDedReport'] == 'OnlyAll')
				{
					$query="SELECT pal.Name,pal.Type,pal.Amount,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollallowancedetails pal ON p.ID = pal.PayID LEFT JOIN employees e ON pal.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAllReport'] != "" ? ' AND pal.Name = \''.$_SESSION['PayrollAllReport'].'\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pal.Amount <> 0
				
				UNION ALL
				
				SELECT pcd.Name,pcd.Type,".($_SESSION['PayrollInvestment'] == "Employee" ? 'pcd.EmployeeContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? 'pcd.EmployerContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? 'pcd.Amount,' : '')."".($_SESSION['PayrollInvestment'] == "" ? 'pcd.Amount,' : '')."e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollcontributiondetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollInvestment'] == "" ? ' AND pcd.Name=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." ".($_SESSION['PayrollInvestment'] == "Employee" ? ' AND pcd.EmployeeContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? ' AND pcd.EmployerContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? ' AND pcd.Amount <> 0' : '')."
				
				UNION ALL
				
				SELECT pln.Type AS Name,'Loan Deduction' AS Type,pln.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollloandetails pln ON p.ID = pln.PayID LEFT JOIN employees e ON pln.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollLoans'] == 0 ? ' AND pln.Type=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pln.Amount <> 0
				
				UNION ALL
				
				SELECT 'Advance' AS Name,'Advance Deduction' AS Type,pad.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolladvancedetails pad ON p.ID = pad.PayID LEFT JOIN employees e ON pad.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAdvances'] == 0 ? ' AND pad.AdvID=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pad.Amount <> 0
				
				UNION ALL
				
				SELECT 'Income Tax' AS Name,'Tax Deduction' AS Type,pd.IncomeTax AS Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollIncomeTax'] == 0 ? ' AND pd.Basic=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pd.IncomeTax <> 0
				";
				}
				if($_SESSION['AllDedReport'] == 'OnlyDed')
				{
					
					$query="SELECT pdd.Name,pdd.Type,pdd.Amount,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldeductiondetails pdd ON p.ID = pdd.PayID LEFT JOIN employees e ON pdd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollDedReport'] != "" ? ' AND pdd.Name = \''.$_SESSION['PayrollDedReport'].'\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pdd.Amount <> 0
				
				UNION ALL
				
				SELECT pcd.Name,pcd.Type,".($_SESSION['PayrollInvestment'] == "Employee" ? 'pcd.EmployeeContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? 'pcd.EmployerContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? 'pcd.Amount,' : '')."".($_SESSION['PayrollInvestment'] == "" ? 'pcd.Amount,' : '')."e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollcontributiondetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollInvestment'] == "" ? ' AND pcd.Name=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." ".($_SESSION['PayrollInvestment'] == "Employee" ? ' AND pcd.EmployeeContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? ' AND pcd.EmployerContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? ' AND pcd.Amount <> 0' : '')."
				
				UNION ALL
				
				SELECT pln.Type AS Name,'Loan Deduction' AS Type,pln.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollloandetails pln ON p.ID = pln.PayID LEFT JOIN employees e ON pln.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollLoans'] == 0 ? ' AND pln.Type=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pln.Amount <> 0
				
				UNION ALL
				
				SELECT 'Advance' AS Name,'Advance Deduction' AS Type,pad.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolladvancedetails pad ON p.ID = pad.PayID LEFT JOIN employees e ON pad.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAdvances'] == 0 ? ' AND pad.AdvID=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pad.Amount <> 0
				
				UNION ALL
				
				SELECT 'Income Tax' AS Name,'Tax Deduction' AS Type,pd.IncomeTax AS Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollIncomeTax'] == 0 ? ' AND pd.Basic=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pd.IncomeTax <> 0
				";
					
				}
				if($_SESSION['AllDedReport'] == 'BothNone')
				{
					
					$query="SELECT pcd.Name,pcd.Type,".($_SESSION['PayrollInvestment'] == "Employee" ? 'pcd.EmployeeContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? 'pcd.EmployerContribution AS Amount,' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? 'pcd.Amount,' : '')."".($_SESSION['PayrollInvestment'] == "" ? 'pcd.Amount,' : '')."e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollcontributiondetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollInvestment'] == "" ? ' AND pcd.Name=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." ".($_SESSION['PayrollInvestment'] == "Employee" ? ' AND pcd.EmployeeContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Employer" ? ' AND pcd.EmployerContribution <> 0' : '')."".($_SESSION['PayrollInvestment'] == "Both" ? ' AND pcd.Amount <> 0' : '')."
				
				UNION ALL
				
				SELECT pln.Type AS Name,'Loan Deduction' AS Type,pln.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrollloandetails pln ON p.ID = pln.PayID LEFT JOIN employees e ON pln.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollLoans'] == 0 ? ' AND pln.Type=\'123\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pln.Amount <> 0
				
				UNION ALL
				
				SELECT 'Advance' AS Name,'Advance Deduction' AS Type,pad.Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolladvancedetails pad ON p.ID = pad.PayID LEFT JOIN employees e ON pad.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollAdvances'] == 0 ? ' AND pad.AdvID=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pad.Amount <> 0
				
				UNION ALL
				
				SELECT 'Income Tax' AS Name,'Tax Deduction' AS Type,pd.IncomeTax AS Amount ,e.FirstName,e.LastName,e.EmpID,e.Designation,e.CNICNumber,pd.Gross,pd.OtherAllowances,p.MonthPayroll FROM payroll p LEFT JOIN payrolldetails pcd ON p.ID = pcd.PayID LEFT JOIN employees e ON pcd.EmpID = e.ID LEFT JOIN payrolldetails pd ON pd.EmpID = e.ID AND pd.PayID = p.ID WHERE FIND_IN_SET(p.MonthPayroll,'".$_SESSION['PayrollMonthReportString']."')  ".($_SESSION['PayrollIncomeTax'] == 0 ? ' AND pd.Basic=\'ABC\'' : '')." ".($_SESSION['PayrollCompanyIDReport'] != "" ? ' AND e.CompanyID = '.$_SESSION['PayrollCompanyIDReport'].'' : '')." ".($_SESSION['PayrollLocationReport'] != "" ? ' AND e.Location = '.$_SESSION['PayrollLocationReport'].'' : '')." ".($_SESSION['PayrollDesignationReport'] != "" ? ' AND e.Designation = \''.$_SESSION['PayrollDesignationReport'].'\'' : '')." ".($_SESSION['PayrollDepartmentReport'] != "" ? ' AND e.Department = \''.$_SESSION['PayrollDepartmentReport'].'\'' : '')." ".($_SESSION['PayrollEmployeeReport'] != 0 ? ' AND e.ID = '.$_SESSION['PayrollEmployeeReport'].'' : '')." ".($_SESSION['PayrollBankCash'] == 1 ? ' AND pd.BankorCash = \'Bank\'' : '')." ".($_SESSION['PayrollBankCash'] == 2 ? ' AND pd.BankorCash = \'Cash\'' : '')." AND pd.IncomeTax <> 0
				";
					
				}
				
				
				//echo $query; exit();
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Payroll Reports <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll Reports</li>
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
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							Payroll Month:
							 <div class="selectBox" onclick="showCheckboxes2()">
									<select class="form-control">
										<option>Select Payroll Month</option>
									</select>
									<div class="overSelect"></div>
								</div>
								<div id="checkboxes2" style="height:250px; overflow:scroll;">						
									<?php					
									$query = "SELECT DISTINCT MonthPayroll FROM payroll where ID <> 0 ORDER BY ID DESC";
									$res = mysql_query($query) or die(mysql_error());
									while($row = mysql_fetch_array($res))
									{						
									echo '<label><input '.(in_array($row['MonthPayroll'], $_SESSION['PayrollMonthReport']) ? "checked = checked" : "").' type="checkbox" name="PayrollMonth[]" value="'.$row['MonthPayroll'].'"/>&ensp;'.$row['MonthPayroll'].'</label>';
									} 
									?>
							  </div>
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Allowances & Deductions:
							 <select name="AllDed" id="AllDed" class="form-control">
								<option <?php echo ($_SESSION['AllDedReport'] == 'AllDed' ? 'selected' : ''); ?> value="AllDed">Both Allowaces & Deductions</option>
								<option <?php echo ($_SESSION['AllDedReport'] == 'OnlyAll' ? 'selected' : ''); ?> value="OnlyAll">Only Allowaces</option>
								<option <?php echo ($_SESSION['AllDedReport'] == 'OnlyDed' ? 'selected' : ''); ?> value="OnlyDed">Only Deductions</option>
								<option <?php echo ($_SESSION['AllDedReport'] == 'BothNone' ? 'selected' : ''); ?> value="BothNone">Both None</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Allowace Types:
							 <select name="PayrollAllReport" id="PayrollAllReport" class="form-control">
								<option value="">Select Allowance</option>
								<optgroup label="Fixed Allowances">
								<?php
								 $query = "SELECT Name FROM allowancetypes WHERE ID <>0 AND Status = 1 AND Name <> 'House Rent' AND Name <> 'Utility' AND Name <> 'Conveyance' ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollAllReport'] == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
								} 
								?>
								</optgroup>
								<optgroup label="One Time Allowances">
								<?php
								 $query = "SELECT Name FROM adjustmenttypes WHERE ID <>0 AND Type = 1 AND Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollAllReport'] == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
								} 
								?>
								</optgroup>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Deduction Types:
							<select name="PayrollDedReport" id="PayrollDedReport" class="form-control">
								<option value="">Select Deduction</option>
								<optgroup label="Fixed Deductions">
								<?php
								 $query = "SELECT Name FROM deductiontypes WHERE ID <>0 AND Status = 1 AND Name <> 'Income Tax' ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollDedReport'] == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
								} 
								?>
								</optgroup>
								<optgroup label="One Time Deductions">
								<?php
								 $query = "SELECT Name FROM adjustmenttypes WHERE ID <>0 AND Type = 0 AND Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollDedReport'] == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
								} 
								?>
								</optgroup>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
							<div class="form-group">
							  Company:
							  <select <?php echo ($_SESSION['UserID'] == 399 ? 'disabled' : ''); ?><?php echo ($_SESSION['UserID'] == 213 ? 'disabled' : ''); ?> name="CompanyID" id="CompanyID" class="form-control">
								<option value="">All Companies</option>
								<?php
								 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['PayrollCompanyIDReport'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
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
							echo '<option '.($_SESSION['PayrollLocationReport'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
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
							foreach($_DESIGNATION as $Designations)
							{
							echo '<option '.($_SESSION['PayrollDesignationReport'] == $Designations ? 'selected' : '').' value="'.$Designations.'">'.$Designations.'</option>';
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
							echo '<option '.($_SESSION['PayrollDepartmentReport'] == $Departments ? 'selected' : '').' value="'.$Departments.'">'.$Departments.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
                        
                       <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['PayrollEmployeeReport'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
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
							Investment Savings:
							 <select name="PayrollInvestment" id="PayrollInvestment" class="form-control">
								<option value="" >Select Investments</option>
								<option <?php echo ($_SESSION['PayrollInvestment'] == 'Employee' ? 'selected' : ''); ?> value="Employee">Employee Contribution</option>
								<option <?php echo ($_SESSION['PayrollInvestment'] == 'Employer' ? 'selected' : ''); ?> value="Employer">Employer Contribution</option>
								<option <?php echo ($_SESSION['PayrollInvestment'] == 'Both' ? 'selected' : ''); ?> value="Both">Both Employee & Employer</option>
							</select>
							</div>
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
						
						<!--<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php //echo ($_SESSION['PayrollSortByReport'] == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
							</select>
							</div>
						</div>-->
						
						
						<div class="col-lg-3 col-xs-12 no-print">
                           <div class="form-group">
						   <input type="checkbox" <?php echo ($_SESSION['PayrollLoans'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="PayrollLoans" name="PayrollLoans"> <label for="PayrollLoans">Loans</label>&emsp;
						   <input type="checkbox" <?php echo ($_SESSION['PayrollAdvances'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="PayrollAdvances" name="PayrollAdvances"> <label for="PayrollAdvances">Advances</label>&emsp;
						   <input type="checkbox" <?php echo ($_SESSION['PayrollIncomeTax'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="PayrollIncomeTax" name="PayrollIncomeTax"> <label for="PayrollIncomeTax">Income Tax</label><br>
						   <input type="radio" <?php echo ($_SESSION['PayrollBankCash'] == 1 ? ' checked="checked"' : ''); ?> value="1" id="Bank" name="PayrollBankCash"> <label for="Bank">Bank</label>&emsp;
						   <input type="radio" <?php echo ($_SESSION['PayrollBankCash'] == 2 ? ' checked="checked"' : ''); ?> value="2" id="Cash" name="PayrollBankCash"> <label for="Cash">Cash</label>&emsp;
						   <input type="radio" <?php echo ($_SESSION['PayrollBankCash'] == 3 ? ' checked="checked"' : ''); ?> value="3" id="BankCash" name="PayrollBankCash"> <label for="BankCash">Bank / Cash Both</label><br>
						   
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			
			<div class="box-footer no-print" style="text-align:right;">
               <!-- <button disabled type="submit" class="btn btn-default margin">Present</button>
				<button disabled type="submit" class="btn btn-danger margin">Absent</button>-->
				<button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
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
                    <tr style="color:white;">
					  <th>S#</th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Gross + Monthly Staff Bonus</th>
					  <th>Designation</th>
					  <th>CNIC#</th>
					  <th>Title</th>
					  <th>Type</th>
                      <th>Amount</th>
					  <th>Payroll Month</th>
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
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
				?>
				<tr>
				  <td><?php echo $i; ?></td>
				  <td><?php echo dboutput($row["EmpID"]); ?></td>
				  <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
				  <td><?php echo ($row["Gross"] + $row["OtherAllowances"]); ?></td>
				  <td><?php echo dboutput($row["Designation"]); ?></td>
				  <td><?php echo dboutput($row["CNICNumber"]); ?></td>
				  <td><?php echo dboutput($row["Name"]); ?></td>
				  <td><?php echo dboutput($row["Type"]); ?></td>
				  <td><?php echo dboutput($row["Amount"]); $amnt = $amnt + $row["Amount"]; ?></td>
				  <td><?php echo dboutput($row["MonthPayroll"]); ?></td>
                </tr>
				<?php
				$i++;
				}
				?>
				<tr style="background-color:black;color:white;">
					  <th colspan="8">Total</th>
                      <th colspan="2"><?php echo $amnt; ?></th>
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
					  <th style="width:150px">Employee</th>
					  <th style="width:150px">Gross + Monthly Staff Bonus</th>
					  <th style="width:130px">Designation</th>
					  <th style="width:130px">CNIC#</th>
					  <th style="width:130px">Title</th>
					  <th style="width:130px">Type</th>
                      <th style="width:130px">Amount</th>
					  <th style="width:90px">Payroll Month</th>
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
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
				?>
				<tr>
				  <td style="width:40px"><?php echo $i; ?></td>
				  <td style="width:50px"><?php echo dboutput($row["EmpID"]); ?></td>
				  <td style="width:150px"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
				  <td style="width:150px"><?php echo ($row["Gross"] + $row["OtherAllowances"]); ?></td>
				  <td style="width:130px"><?php echo dboutput($row["Designation"]); ?></td>
				  <td style="width:130px"><?php echo dboutput($row["CNICNumber"]); ?></td>
				  <td style="width:130px"><?php echo dboutput($row["Name"]); ?></td>
				  <td style="width:130px"><?php echo dboutput($row["Type"]); ?></td>
				  <td style="width:130px"><?php echo dboutput($row["Amount"]); $amnt = $amnt + $row["Amount"]; ?></td>
				  <td style="width:90px"><?php echo dboutput($row["MonthPayroll"]); ?></td>
                </tr>
				<?php
				$i++;
				}
				?>
				<tr style="background-color:black;color:white;">
					  <th colspan="8" style="width:910px">Total</th>
                      <th colspan="2" style="width:220px"><?php echo $amnt; ?></th>
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
