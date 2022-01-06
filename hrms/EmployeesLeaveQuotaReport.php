<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$Anual=0;
$Casual=0;
$CAnual=0;
$CCasual=0;
$TAnual=0;
$TCasual=0;
$action="";
if(isset($_POST["action"]))
		$action = $_POST["action"];
?>
<?php

if($action == "UpdateQuota")
	{
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("START TRANSACTION");
		
		$query="TRUNCATE TABLE current_leaves_quota_encashment";
		mysql_query ($query) or die(mysql_error());
		
		$query="INSERT INTO current_leaves_quota_encashment (EmpID, AnualLeaves, SickLeaves, CasualLeaves) SELECT EmpID, AnualLeaves, SickLeaves, CasualLeaves FROM current_leaves_quota WHERE ID <> 0";
		mysql_query ($query) or die(mysql_error());
		
		$query="TRUNCATE TABLE current_leaves_quota";
		mysql_query ($query) or die(mysql_error());
		
		$query="INSERT INTO current_leaves_quota (EmpID, AnualLeaves, SickLeaves, CasualLeaves) SELECT EmpID, AnualLeaves, SickLeaves, CasualLeaves FROM leaves_quota WHERE ID <> 0 AND Approved = 1";
		mysql_query ($query) or die(mysql_error());
		
		mysql_query("COMMIT");
		
		redirect("EmployeesLeaveQuotaReport.php");
	}

if(!isset($_SESSION['CompanyIDEmployeeFrm']))
$_SESSION['CompanyIDEmployeeFrm']=0;
if(!isset($_SESSION['LocationEmployeeFrm']))
$_SESSION['LocationEmployeeFrm']=0;
if(!isset($_SESSION['DesignationEmployeeFrm']))
$_SESSION['DesignationEmployeeFrm']="";
if(!isset($_SESSION['DepartmentEmployeeFrm']))
$_SESSION['DepartmentEmployeeFrm']="";
if(!isset($_SESSION['EmployeeEmployeeFrm']))
$_SESSION['EmployeeEmployeeFrm']=0;
if(!isset($_SESSION['EmpTypeEmployeeFrm']))
$_SESSION['EmpTypeEmployeeFrm']="Active";
if(!isset($_SESSION['SortByEmployeeFrm']))
$_SESSION['SortByEmployeeFrm']="e.ID";

?>
<?php	
if(isset($_REQUEST["CompanyID"]))
	$_SESSION['CompanyIDEmployeeFrm']=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
	$_SESSION['LocationEmployeeFrm']=trim($_REQUEST["Location"]);
if(isset($_REQUEST["SortBy"]))
	$_SESSION['SortByEmployeeFrm']=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["Employee"]))
	$_SESSION['EmployeeEmployeeFrm']=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Designation"]))
	$_SESSION['DesignationEmployeeFrm']=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
	$_SESSION['DepartmentEmployeeFrm']=trim($_REQUEST["Department"]);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Current Leaves Quota Report</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, LeavesQuota-scalable=no' name='viewport'>
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
	
	
	function UpdateQuota()
	{
		if(confirm("Are you sure to Update Leave Quota."))
		{
			$("#action").val("UpdateQuota");
			$("#frmPages").submit();
		}
	}
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
				
				$query="SELECT l.EmpID AS ID,l.AnualLeaves,l.CasualLeaves,e.EmpID,e.FirstName,e.LastName,e.Designation,e.Department FROM leaves_quota l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN companies c ON e.CompanyID = c.ID WHERE L.ID <>0 ".($_SESSION['CompanyIDEmployeeFrm'] != 0 ? ' AND e.CompanyID = '.$_SESSION['CompanyIDEmployeeFrm'].'' : '')." ".($_SESSION['LocationEmployeeFrm'] != 0 ? ' AND e.Location = '.$_SESSION['LocationEmployeeFrm'].'' : '')." ".($_SESSION['EmployeeEmployeeFrm'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeEmployeeFrm'].'' : '')." ".($_SESSION['DepartmentEmployeeFrm'] != "" ? ' AND e.Department = "'.$_SESSION['DepartmentEmployeeFrm'].'"' : '')." ".($_SESSION['DesignationEmployeeFrm'] != "" ? ' AND e.Designation = "'.$_SESSION['DesignationEmployeeFrm'].'"' : '')." ORDER BY ".$_SESSION['SortByEmployeeFrm']." ASC";				
				
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 

				$maxRow = mysql_num_rows($result);
		?>
  <?php

				
				// $query1="SELECT AnualLeaves,CasualLeaves FROM leaves_quota  WHERE ID <>0 AND EmpID=".(int)$Employee." AND Approved = 1";
				// $res1 = mysql_query($query1) or die(mysql_error());
				// $num1 = mysql_num_rows($res1);
				// if($num1 == 1)
				// {
					// $row1 = mysql_fetch_array($res1);
					// $Anual=$row1['AnualLeaves'];
					// $Casual=$row1['CasualLeaves'];
					
					// $query2="SELECT AnualLeaves,CasualLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".(int)$Employee."";
					// $res2 = mysql_query($query2) or die(mysql_error());
					// $num2 = mysql_num_rows($res2);
					
					// if($num2 == 1)
					// {
						// $row2 = mysql_fetch_array($res2);
						// $CAnual=$row2['AnualLeaves'];
						// $CCasual=$row2['CasualLeaves'];
						
						// $TAnual = $Anual - $CAnual;
						// $TCasual = $Casual - $CCasual;
					// }
				// }
				
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Current Leaves Quota Report <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Current Leaves Quota Report</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row margin">
					<form id="frmPages" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
					<input type="hidden" id="action" name="action" value="" />
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" class="no-print" >Employees Filters: </label>
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
								echo '<option '.($_SESSION['CompanyIDEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
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
							echo '<option '.($_SESSION['LocationEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
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
							echo '<option '.($_SESSION['DepartmentEmployeeFrm'] == $Departments ? 'selected' : '').' value="'.$Departments.'">'.$Departments.'</option>';
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
							echo '<option '.($_SESSION['DesignationEmployeeFrm'] == $Designations ? 'selected' : '').' value="'.$Designations.'">'.$Designations.'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
								<option <?php echo ($_SESSION['SortByEmployeeFrm'] == 'e.Status' ? 'selected' : ''); ?> value="e.Status">Status</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-6 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['EmployeeEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
						</div>
					   </div>
						<div class="col-lg-3 col-xs-12 no-print">
                           <div class="form-group">	
						<br>						   
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			<div class="box-footer no-print" style="text-align:right;">
				<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
				<button type="button" onClick="javascript:UpdateQuota()" class="btn bg-navy margin no-print">Update Quota</button>
				<?php } ?>
				<button class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
            </div>
			
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
		  <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
             
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
					  <th>S.No</th>
					  <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Annual Entitled</th>
					  <th>Annual Taken</th>
					  <th>Annual Balance</th>
					  <th>Casual/Sick Entitled</th>
					  <th>Casual/Sick Taken</th>
					  <th>Casual/Sick Balance</th>
                    </tr>
                  </thead>
				  
                  <tbody>
				  <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="200" align="center" class="error"><b>No Leaves listed.</b></td>
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
					$Anual=$row['AnualLeaves'];
					$Casual=$row['CasualLeaves'];
					
					$query2="SELECT AnualLeaves,CasualLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".(int)$row['ID']."";
					$res2 = mysql_query($query2) or die(mysql_error());
					$num2 = mysql_num_rows($res2);
					
					if($num2 == 1)
					{
						$row2 = mysql_fetch_array($res2);
						$CAnual=$row2['AnualLeaves'];
						$CCasual=$row2['CasualLeaves'];
						
						$TAnual = $Anual - $CAnual;
						$TCasual = $Casual - $CCasual;
					}
		?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo $Anual ; ?></td>
                      <td><?php echo $TAnual ; ?></td>
					  <td><?php echo $CAnual ; ?></td>
					  <td><?php echo $Casual ; ?></td>
                      <td><?php echo $TCasual ; ?></td>
					  <td><?php echo $CCasual ; ?></td>
                    </tr>
					<?php
				$i++;
				}
			} 
			mysql_close($dbh);
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
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
		<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
