<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$CompanyID=1000;
$Location=0;
$SortBy="e.FirstName";
$EmpType="Active";
$Employee=0;
$Designation="";
$Department="";
$SubDepartment="";
$BusinessUnit="";
$Headings="";
$HeadID=array();
$PrintMode=0;
$Rows=10;
$Font=10;
$Pixel=100;

	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>


<?php	
if(isset($_REQUEST["CompanyID"]))
	$CompanyID=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
	$Location=trim($_REQUEST["Location"]);
if(isset($_REQUEST["SortBy"]))
	$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["EmpType"]))
	$EmpType=trim($_REQUEST["EmpType"]);
if(isset($_REQUEST["Employee"]))
	$Employee=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Designation"]))
	$Designation=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
	$Department=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SubDepartment"]))
	$SubDepartment=trim($_REQUEST["SubDepartment"]);
if(isset($_REQUEST["BusinessUnit"]))
	$BusinessUnit=trim($_REQUEST["BusinessUnit"]);
if(isset($_REQUEST["Headings"]))
	{
		$Headings=implode(',', $_REQUEST['Headings']);
		$HeadID=$_REQUEST['Headings'];
	}
if(isset($_REQUEST["PrintMode"]))
	$PrintMode=trim($_REQUEST["PrintMode"]);
if(isset($_REQUEST["Rows"]))
	$Rows=(int)$_REQUEST["Rows"];
if(isset($_REQUEST["Font"]))
	$Font=(int)$_REQUEST["Font"];
if(isset($_REQUEST["Pixel"]))
	$Pixel=(int)$_REQUEST["Pixel"];


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

<title>Employees Report</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="js/functions.js" type="text/javascript"></script>
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

<style type="text/css">
    table{
        border:none;
    }
	
	#printable table
	{
		table-layout: auto;
		width:100%;
		font-size:<?php echo $Font; ?>px;
	}
	
	#printable tr
	{
		display:flex;
		width:100%;
	}
	
	#printable th
	{	
		overflow: hidden;
		width: <?php echo $Pixel; ?>px;
		color:black;
		text-align:left;
	}
	
	#printable td
	{
		overflow: hidden;
		width: <?php echo $Pixel; ?>px;
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
	</script>
</head>
<body class="skin-blue employees-pg-wrap">
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
				$first="";
				$last="";
				$nav="";
				$rowsPerPage=20;
				$pageNum=1;
				$adjacents = 2;
				$Keywords="";
					
				
				if(isset($_REQUEST["Keywords"]))
					$Keywords = trim($_REQUEST["Keywords"]);

				if(isset($_REQUEST["PageIndex"]) && ctype_digit(trim($_REQUEST["PageIndex"])))
					$pageNum=trim($_REQUEST["PageIndex"]);

				$offset = ($pageNum - 1) * $rowsPerPage;
				$limit=" Limit ".$offset.", ".$rowsPerPage;
				
				$query="SELECT e.ID,e.Role,e.EmpType,e.EmpTypeDate,e.Designation,e.Department,e.Grade,e.Salary,e.GetSalary,e.Supervisor,e.AllowEmpLogin,e.UserName,e.Password,e.EmailAddress,e.PersonalEmailAddress,e.Notifications,e.Salutation,e.FirstName,e.LastName,e.FatherName,e.DOB,e.MaritalStatus,e.Gender,e.BloodGroup,e.Nationality,e.JoiningDate,e.ResignationDate,e.LeavingDate,e.ResignationAccepted,e.ResignationRemarks,e.EmpID,e.Status,e.CNICNumber,e.CNICIssueDate,e.CNICExpiration,e.IqamaNumber,e.PassportNumber,e.PassportIssueDate,e.PassportExpiration,e.DrivingLicenseNumber,e.DrivingLicenseIssueDate,e.DrivingLicenseExpiration,e.NOY,e.NOM,e.LastCompany,e.LastDesignation,e.LastSalary,e.LastWorkingDay,e.IsFirstJob,e.Address,c.Name AS CompanyID,e.MachineID,e.EmploymentType,l.Name AS Location,e.SalaryDisbursmintPeriod,e.SESSINo,e.EOBINo,e.Bonus,e.CanTakeLoan,e.CanTakeAdvance,e.PayFullSalary,e.SalePersonOutdoorPerson,e.StopSalary,e.EmployeeContribution,e.EmployerContribution,s.Name AS ScheduleID,ot.Name AS OvertimePolicy,e.AttendanceAllowance,e.AttAllAmount,e.LateArrivalPolicy,e.EarlyDeparturePolicy,e.ArrivalHalfDay,e.DepartHalfDay,e.AverageWorkingHours,e.WorkingType,e.LeavesDays,e.SandwichLeaves,e.HalfDays,e.Religion,e.Bank,e.AccountTitle,e.AccountNumber,e.LastEducationDegree,e.UniversityCollege,e.EducationCompletionYear,e.GradeMarksPercentage,e.LastTechnicalEducationCertificate,e.UniversityInstitute,e.TechnicalEducationCompletionYear,e.GradePercentageMarks,e.HomeNumber,e.OfficeNumber,e.MobileNumber,e.EmergencyPerson,e.Relationship,e.EmergencyNumber,e.Photo,e.DateAdded,e.DateModified,bs.BusinessUnit AS BusinessUnit,sd.SubDepartment AS SubDepartment FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID LEFT JOIN overtime_policies ot ON e.OvertimePolicy = ot.ID LEFT JOIN schedules s ON e.ScheduleID = s.ID LEFT JOIN subdepartments sd ON e.SubDepartment = sd.ID LEFT JOIN businessunits bs ON e.BusinessUnit = bs.ID WHERE e.ID <>0 ".($CompanyID != 0 ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != 0 ? ' AND e.Location = '.$Location.'' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($Department != "" ? ' AND e.Department = "'.$Department.'"' : '')." ".($SubDepartment != "" ? ' AND e.SubDepartment = "'.$SubDepartment.'"' : '')." ".($BusinessUnit != "" ? ' AND e.BusinessUnit = "'.$BusinessUnit.'"' : '')." ".($Designation != "" ? ' AND e.Designation = "'.$Designation.'"' : '')." ".($EmpType != '' ? ' AND e.Status = "'.$EmpType.'"' : '')." ORDER BY ".$SortBy." ASC";				
				
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die(mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				
				
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Employees Report<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employees Report</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content <?php echo ($PrintMode == 1 ? 'no-print' : '') ?>">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header">
              <h3 class="box-title no-print"><span class="no-print">Employees Report</span></h3>
			  <div class="buttons no-print" style="width:50%">
				
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-download"></i> Download Excel</button>
				<button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                
               
            </div>
			
			<div class="row margin no-print">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Employee Filters: </label>
							</div>
                        </div><!-- ./col -->
						
						
						<div class="col-lg-2 col-xs-12 no-print">
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
						<div class="col-lg-2 col-xs-12 no-print">
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
						<div class="col-lg-2 col-xs-12 no-print">
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
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
						  Sub Department:
							<select name="SubDepartment" id="SubDepartment" class="form-control">
							<option value="" >All Sub Departments</option>
							<?php
							$query = 'SELECT s.ID,s.SubDepartment,d.Department FROM subdepartments s LEFT JOIN departments d ON s.DepartmentID = d.ID WHERE s.Status = 1 ORDER BY d.Department,s.SubDepartment ASC';
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($SubDepartment == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['SubDepartment'].' ('.$row['Department'].')</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
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
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
						  Business Unit:
							<select name="BusinessUnit" id="BusinessUnit" class="form-control">
							<option value="" >All Business Units</option>
							<?php
							 $query = "SELECT ID,BusinessUnit FROM businessunits where Status = 1 ORDER BY BusinessUnit ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($BusinessUnit == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['BusinessUnit'].'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
						  Employee Status:
							<select name="EmpType" id="EmpType" class="form-control">
							<option value="" >Both Active and Deactive</option>
							<option <?php echo ($EmpType == 'Active' ? 'selected' : ''); ?> value="Active">Active</option>
							<option <?php echo ($EmpType == 'Deactive' ? 'selected' : ''); ?> value="Deactive">Deactive</option>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($SortBy == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($SortBy == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($SortBy == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($SortBy == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($SortBy == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($SortBy == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
								<option <?php echo ($SortBy == 'e.Status' ? 'selected' : ''); ?> value="e.Status">Status</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							  <label id="labelimp" for="Headings" >Headings: </label>
							 <div class="selectBox" onclick="showCheckboxes()">
									<select class="form-control">
										<option>Select Headings</option>
									</select>
									<div class="overSelect"></div>
								</div>
								<div id="checkboxes" style="height:250px; overflow:scroll;">						
									<?php
									$query = "SHOW FIELDS FROM employees";
									$res = mysql_query($query);
									while($row = mysql_fetch_array($res))
									{
									echo '<label>&emsp;<input '.(in_array($row['Field'], $HeadID) ? "checked = checked" : "").' type="checkbox" name="Headings[]" value="'.$row['Field'].'"/> '.$row['Field'].'</label>';
									}
									?>
							  </div>
							</div>
						</div><!-- ./col -->
						
						<div class="col-lg-5 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ".($EmpType != '' ? ' AND Status = "'.$EmpType.'"' : '')." ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
						</div>
					   </div>
					 <!--  <div class="col-lg-1 col-xs-12 no-print">-->
						<!--	<div class="form-group">-->
						<!--		<label id="labelimp" for="Headings" >Print Mode: </label>-->
						<!--		<input type="radio" <?php echo ($PrintMode == 1 ? ' checked="checked"' : ''); ?> value="1" name="PrintMode" id="On"><label for="On">On</label>-->
						<!--		<input type="radio" <?php echo ($PrintMode == 0 ? ' checked="checked"' : ''); ?> value="0" name="PrintMode" id="Off"><label for="Off">Off</label><br>-->
						<!--	</div>-->
						<!--</div>-->
						<!--<div class="col-lg-1 col-xs-12 no-print">-->
						<!--	<div class="form-group">-->
						<!--		<label id="labelimp" for="Rows" >Rows: </label>-->
						<!--		<input class="form-control" type="number"  value="<?php echo $Rows; ?>" name="Rows" id="Rows">-->
						<!--	</div>-->
						<!--</div>-->
						<!--<div class="col-lg-1 col-xs-12 no-print">-->
						<!--	<div class="form-group">-->
						<!--		<label id="labelimp" for="Font" >Font: </label>-->
						<!--		<input class="form-control" type="number"  value="<?php echo $Font; ?>" name="Font" id="Font">-->
						<!--	</div>-->
						<!--</div>-->
						<!--<div class="col-lg-1 col-xs-12 no-print">-->
						<!--	<div class="form-group">-->
						<!--		<label id="labelimp" for="Pixel" >Pixels: </label>-->
						<!--		<input class="form-control" type="number"  value="<?php echo $Pixel; ?>" name="Pixel" id="Pixel">-->
						<!--	</div>-->
						<!--</div>-->
						<div class="col-lg-3 col-xs-12 no-print">
                           &emsp;
                        </div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
                           <div class="form-group">	
						<br>						   
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" style="padding:7px;">
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
				
				<?php if($PrintMode == 0){ ?>
				
				<table id="dataTable" class="blue table table-bordered table-striped">
                  <thead class="">
                    <tr style="color:white;" class="head">
                      <th>S.No</th>
					  <?php
						foreach($HeadID AS $Heads)
						{
						echo '<th>'.$Heads.'</th>';
						}
					  ?>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="200" align="center" class="error"><b>No Employee listed.</b></td>
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
					  <?php
						foreach($HeadID AS $Heads)
						{
						echo '<td>'.dboutput($row[$Heads]).'</td>';
						}
					  ?>
					  
					  
					  <!--<td><?php //echo dboutput($row["FirstName"]) ." ". dboutput($row["LastName"]); ?></td>
					  <td><img class="thumbnail" src="<?php //echo (is_file(DIR_EMPLOYEEPHOTOES . $row['Photo']) ? DIR_EMPLOYEEPHOTOES.dboutput($row['Photo']) : 'images/avatar.png'); ?>"  style="width:80px;" /></td>
					  <td><?php //echo dboutput($row["EmpID"]); ?></td>
					  <td><?php //echo dboutput($row["Role"]); ?></td>
					  <td><?php //echo dboutput($row["Department"]); ?></td>
					  <td><?php //echo dboutput($row["Designation"]); ?></td>
                      <td><?php //if(dboutput($row["Status"])=='Active'){echo '<i class="fa fa-fw fa-check-circle"></i>';}else{echo '<i class="fa fa-fw fa-times-circle"></i>';} ?></td>-->
                    </tr>
                    <?php
				$i++;
				}
			} 
			mysql_close($dbh);
		?>
                  </tbody>
                </table>
				<?php } ?>
                </div>
				
              </form>
			  
            </div>
            <br>
			
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
	<?php if($PrintMode == 1){ ?>
			<div id="printable">
				<table class="table table-bordered" style="border:none">
                  <thead class="">
                    <tr style="color:white;" class="head">
                      <th>S.No</th>
					  <?php
						foreach($HeadID AS $Heads)
						{
						echo '<th>'.$Heads.'</th>';
						}
					  ?>
                    </tr>
                  </thead>
				  
                  <tbody >
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="200" align="center" class="error"><b>No Employee listed.</b></td>
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
					  <?php
						foreach($HeadID AS $Heads)
						{
						echo '<td>'.dboutput($row[$Heads]).'</td>';
						}
					  ?>
					  
					  
					  <!--<td><?php //echo dboutput($row["FirstName"]) ." ". dboutput($row["LastName"]); ?></td>
					  <td><img class="thumbnail" src="<?php //echo (is_file(DIR_EMPLOYEEPHOTOES . $row['Photo']) ? DIR_EMPLOYEEPHOTOES.dboutput($row['Photo']) : 'images/avatar.png'); ?>"  style="width:80px;" /></td>
					  <td><?php //echo dboutput($row["EmpID"]); ?></td>
					  <td><?php //echo dboutput($row["Role"]); ?></td>
					  <td><?php //echo dboutput($row["Department"]); ?></td>
					  <td><?php //echo dboutput($row["Designation"]); ?></td>
                      <td><?php //if(dboutput($row["Status"])=='Active'){echo '<i class="fa fa-fw fa-check-circle"></i>';}else{echo '<i class="fa fa-fw fa-times-circle"></i>';} ?></td>-->
                    </tr>
                    <?php
				$i++;
				}
			} 
			mysql_close($dbh);
		?>
                  </tbody>
                </table>
			</div>
				<?php } ?>
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
	
<!-- ./wrapper -->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
		<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
