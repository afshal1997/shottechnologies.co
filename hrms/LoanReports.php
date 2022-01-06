<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>

<?php
$CompanyID=0;
$Location=0;
$SortBy="e.FirstName";
$LoanType="";
$Employee=0;
$Designation="";
$Department="";
$OpeningEndDate="";
$FromDate="";
$TillDate="";

$OPNSchAmount=0;
$OPNManlAmount=0;
$CurSchAmount=0;
$CurManlAmount=0;

	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>


<?php	
$TillDate=date("d-m-Y");
$d=strtotime("-1 Months");	
$FromDate=date("d-m-Y", $d);

if(isset($_REQUEST["CompanyID"]))
	$CompanyID=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
	$Location=trim($_REQUEST["Location"]);
if(isset($_REQUEST["SortBy"]))
	$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["LoanType"]))
	$LoanType=trim($_REQUEST["LoanType"]);
if(isset($_REQUEST["Employee"]))
	$Employee=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Designation"]))
	$Designation=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
	$Department=trim($_REQUEST["Department"]);
if(isset($_REQUEST["FromDate"]))
	$FromDate=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
	$TillDate=trim($_REQUEST["TillDate"]);

$OpeningEndDate = date('Y-m-d', strtotime('-1 day', strtotime($FromDate)));



	

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
<title>Loan Reports</title>
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
<link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
				
				// $query="SELECT FromDate,NumOfDays,What FROM roster WHERE ID <> 0 ORDER BY FromDate ASC";
				// $result = mysql_query ($query) or die(mysql_error()); 
				// while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				// {
					// $startdate=strtotime($row['FromDate']);
					// for($i=0;$i<$row['NumOfDays'];$i++)
					// {
						// $Roster[] = date("Y-m-d", $startdate);
						// $startdate = strtotime("+1 day", $startdate);
					// }
				// }
				// sort($Roster);
				
				// $RosterString = implode(',',$Roster);
				
				// echo $RosterString;
				// exit();
				
				// print_r($Roster);
				// exit();

				
				
				$query="SELECT e.EmpID,e.FirstName,e.LastName,c.Name AS Company,l.ID,l.LoanType,l.Amount,l.RepaymentAmount,l.RemainingAmount FROM loans l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID WHERE l.ID <> 0 ".($CompanyID != 0 ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != 0 ? ' AND e.Location = '.$Location.'' : '')." ".($LoanType != '' ? ' AND l.LoanType = "'.$LoanType.'"' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($Department != "" ? ' AND e.Department = '.$Department.'' : '')." ".($Designation != "" ? ' AND e.Designation = '.$Designation.'' : '')." ORDER BY ".$SortBy." ASC";
				
				//echo $query;exit();
				
				//SUM(lm.Amount) AS PreManualAmount,
				
				//$query="SELECT  FROM loans l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID WHERE l.ID <> 0 AND (li.DateAdded BETWEEN '".date_format_Ymd($_SESSION['FromDateLedger'])."' AND '".date_format_Ymd($_SESSION['TillDateLedger'])."') ".($_SESSION['CompanyIDLedger'] != "" ? ' AND e.CompanyID = '.$_SESSION['CompanyIDLedger'].'' : '')." ".($_SESSION['LocationLedger'] != "" ? ' AND e.Location = '.$_SESSION['LocationLedger'].'' : '')." ".($_SESSION['DesignationLedger'] != "" ? ' AND e.Designation = \''.$_SESSION['DesignationLedger'].'\'' : '')." ".($_SESSION['DepartmentLedger'] != "" ? ' AND e.Department = \''.$_SESSION['DepartmentLedger'].'\'' : '')." ".($_SESSION['EmployeeLedger'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeLedger'].'' : '')." ".($_SESSION['SortTypeLedger'] != "" ? ' AND li.Status = \''.$_SESSION['SortTypeLedger'].'\'' : '')." ".($_SESSION['LateLedger'] == 1 ? ' AND li.Late = 1' : '')." ".($_SESSION['EarlyDepLedger'] == 1 ? ' AND li.EarlyDep = 1' : '')." ".($_SESSION['HalfDayLedger'] == 1 ? ' AND li.HalfDay = 1' : '')." ".($_SESSION['SortByLedger'] != "" ? ' ORDER BY '.$_SESSION['SortByLedger'].',li.DateAdded,e.EmpID ASC' : '')." ";
				
				
				//echo $query; exit();
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loan Reports <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loan Reports</li>
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
							  <label id="labelimp2" for="Role" >Loan Filters: </label>
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
						  Loan Type:
							<select name="LoanType" id="LoanType" class="form-control">
							<option value="" >All Loans</option>
							<?php
							$query = "SELECT Name FROM loantypes where Status = 1 ORDER BY Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($LoanType == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($SortBy == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($SortBy == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($SortBy == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($SortBy == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($SortBy == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($SortBy == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
								<option <?php echo ($SortBy == 'l.LoanType' ? 'selected' : ''); ?> value="l.LoanType">Loan Type</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
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
						<div class="col-lg-3 col-xs-12 no-print">
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
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Department:
							<select name="Department" id="Department" class="form-control">
							<option value="" >All Departments</option>
							<?php
							foreach($_DEPARTMENT as $Departments)
							{
							echo '<option '.($Department == $Departments ? 'selected' : '').' value="'.$Departments.'">'.$Departments.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Designation:
							<select name="Designation" id="Designation" class="form-control">
							<option value="" >All Designations</option>
							<?php
							foreach($_DESIGNATION as $Designations)
							{
							echo '<option '.($Designation == $Designations ? 'selected' : '').' value="'.$Designations.'">'.$Designations.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-8 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
						</div>
					   </div>
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
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-download"></i> Download Excel</button>
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
                
  
                  
				<div id="tblExport">
              <table class="blue table table-bordered">
                  <thead class="">
                    <tr style="color:white;">
					  <th>S#</th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Company</th>
					  <th>Type</th>
                      <th>Opening</th>
					  <th>Recovered</th>
					  <th>Balance</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="20" align="center" class="error"><b>No Loan listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$i=1;
				$amnt=0;
				$recov=0;
				$blnc=0;
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
				$query2="SELECT SUM(Amount) AS OPNSchAmount FROM loans_schedule WHERE ID <> 0 AND LoanID = ".$row["ID"]." AND Status = 1 AND (RepaymentDate BETWEEN '1900-01-01' AND '".date_format_Ymd($OpeningEndDate)."')";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				if($num2 > 0)
				{
					$row2 = mysql_fetch_array($result2);
					$OPNSchAmount = $row2['OPNSchAmount'];
				}
				$query2="SELECT SUM(Amount) AS OPNManlAmount FROM loans_manualrecovery WHERE ID <> 0 AND LoanID = ".$row["ID"]." AND (PaymentDate BETWEEN '1900-01-01' AND '".date_format_Ymd($OpeningEndDate)."')";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				if($num2 > 0)
				{
					$row2 = mysql_fetch_array($result2);
					$OPNManlAmount = $row2['OPNManlAmount'];
				}
				$query2="SELECT SUM(Amount) AS CurSchAmount FROM loans_schedule WHERE ID <> 0 AND LoanID = ".$row["ID"]." AND Status = 1 AND (RepaymentDate BETWEEN '".date_format_Ymd($FromDate)."' AND '".date_format_Ymd($TillDate)."')";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				if($num2 > 0)
				{
					$row2 = mysql_fetch_array($result2);
					$CurSchAmount = $row2['CurSchAmount'];
				}
				$query2="SELECT SUM(Amount) AS CurManlAmount FROM loans_manualrecovery WHERE ID <> 0 AND LoanID = ".$row["ID"]." AND (PaymentDate BETWEEN '".date_format_Ymd($FromDate)."' AND '".date_format_Ymd($TillDate)."')";
				$result2 = mysql_query ($query2) or die(mysql_error()); 
				$num2 = mysql_num_rows($result2);
				if($num2 > 0)
				{
					$row2 = mysql_fetch_array($result2);
					$CurManlAmount = $row2['CurManlAmount'];
				}
				if(($CurSchAmount + $CurManlAmount) != 0 OR ($row["Amount"] - ($OPNSchAmount + $OPNManlAmount + $CurSchAmount + $CurManlAmount)) != 0)
				{
				?>
				<tr>
				  <td><?php echo $i; ?></td>
				  <td><?php echo dboutput($row["EmpID"]); ?></td>
				  <td><?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?><a href="EditLoan.php?ID=<?php echo dboutput($row["ID"]); ?>" target="_blank"><?php } ?><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?><?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?></a><?php } ?></td>
				  <td><?php echo dboutput($row["Company"]); ?></td>
				  <td><?php echo dboutput($row["LoanType"]); ?></td>
				  <td><?php echo number_format($OPNSchAmount + $OPNManlAmount); $amnt = $amnt + ($OPNSchAmount + $OPNManlAmount); ?></td>
				  <td><?php echo number_format($CurSchAmount + $CurManlAmount); $recov = $recov + ($CurSchAmount + $CurManlAmount); ?></td>
				  <td><?php echo number_format($row["Amount"] - ($OPNSchAmount + $OPNManlAmount + $CurSchAmount + $CurManlAmount)); $blnc = $blnc + ($row["Amount"] - ($OPNSchAmount + $OPNManlAmount + $CurSchAmount + $CurManlAmount)); ?></td>
                </tr>
				<?php
				$i++;
				}
				}
				?>
				<tr style="background-color:black;color:white;">
					  <th colspan="5">Total</th>
                      <th><?php echo number_format($amnt); ?></th>
					  <th><?php echo number_format($recov); ?></th>
					  <th><?php echo number_format($blnc); ?></th>
                </tr>
				<?php
			} 
		?>
                  </tbody>
				  
                </table>
				</div>
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
<script src="excel/jquery.min.js"></script>
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
	</style>
			<script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
