<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
if($action == "delete")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
			foreach($_REQUEST["ids"] as $BID)
			{
			mysql_query("DELETE FROM allowances  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Allowances.</b>
			</div>';
			redirect("Allowances.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Allowance to delete.</b>
			</div>';
		}
	}
?>
<?php
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
if(!isset($_SESSION['TitleAllowance']))
$_SESSION['TitleAllowance']="";
if(!isset($_SESSION['FromDate']))
$_SESSION['FromDate']="";
if(!isset($_SESSION['TillDate']))
$_SESSION['TillDate']="";

?>
<?php	
if(isset($_REQUEST["CompanyID"]))
	$_SESSION['CompanyIDEmployeeFrm']=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
	$_SESSION['LocationEmployeeFrm']=trim($_REQUEST["Location"]);
if(isset($_REQUEST["SortBy"]))
	$_SESSION['SortByEmployeeFrm']=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["EmpType"]))
	$_SESSION['EmpTypeEmployeeFrm']=trim($_REQUEST["EmpType"]);
if(isset($_REQUEST["Employee"]))
	$_SESSION['EmployeeEmployeeFrm']=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Designation"]))
	$_SESSION['DesignationEmployeeFrm']=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
	$_SESSION['DepartmentEmployeeFrm']=trim($_REQUEST["Department"]);
if(isset($_REQUEST["TitleAllowance"]))
	$_SESSION['TitleAllowance']=trim($_REQUEST["TitleAllowance"]);
if(isset($_REQUEST["FromDate"]))
	$_SESSION['FromDate']=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
	$_SESSION['TillDate']=trim($_REQUEST["TillDate"]);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Allowances</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Allowance-scalable=no' name='viewport'>
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
	
	
	function doDelete()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to delete."))
			{
				$("#action").val("delete");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Allowance to delete");
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
				
				$query="SELECT d.ID,d.Approved,d.EmpID,d.Amount,d.Percentage,d.Type,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,d.Title,DATE_FORMAT(d.Date, '%D %b %Y') AS Added
				FROM allowances d LEFT JOIN employees e ON d.EmpID = e.ID LEFT JOIN employees a ON d.ApprovedBy = a.ID WHERE d.ID <>0 ".($_SESSION['TitleAllowance'] != "" ? ' AND d.Title = "'.$_SESSION['TitleAllowance'].'"' : '')." ".($_SESSION['CompanyIDEmployeeFrm'] != 0 ? ' AND e.CompanyID = '.$_SESSION['CompanyIDEmployeeFrm'].'' : '')." ".($_SESSION['LocationEmployeeFrm'] != 0 ? ' AND e.Location = '.$_SESSION['LocationEmployeeFrm'].'' : '')." ".($_SESSION['EmployeeEmployeeFrm'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeEmployeeFrm'].'' : '')." ".($_SESSION['DepartmentEmployeeFrm'] != "" ? ' AND e.Department = "'.$_SESSION['DepartmentEmployeeFrm'].'"' : '')." ".($_SESSION['DesignationEmployeeFrm'] != "" ? ' AND e.Designation = "'.$_SESSION['DesignationEmployeeFrm'].'"' : '')." ".($_SESSION['EmpTypeEmployeeFrm'] != '' ? ' AND e.Status = "'.$_SESSION['EmpTypeEmployeeFrm'].'"' : '')." ".($_SESSION['FromDate'] != "" && $_SESSION['TillDate'] != "" ? ' AND (d.Date BETWEEN \''.$_SESSION['FromDate'].'\' AND \''.$_SESSION['TillDate'].'\')' : '')." ORDER BY ".$_SESSION['SortByEmployeeFrm']." ASC";				
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 

				$maxRow = mysql_num_rows($result);
				
				// $result = mysql_query ($query.$limit) or die("Could not select because: ".mysql_error()); 
				// $num = mysql_num_rows($result);
				
				// $r = mysql_query ($query) or die(mysql_error());
				// $self = $_SERVER['PHP_SELF'];

				// $maxRow = mysql_num_rows($r);
				// if($maxRow > 0)
				// { 
					// $maxPage = ceil($maxRow/$rowsPerPage);
					// $nav  = '';
					
					// $pmin = ($pageNum > $adjacents) ? ($pageNum - $adjacents) : 1;
					// $pmax = ($pageNum < ($maxPage - $adjacents)) ? ($pageNum + $adjacents) : $maxPage;
					// for ($i = $pmin; $i <= $pmax; $i++) {
						// if ($i == $pageNum) {
							// $nav .= "&nbsp;<li class=\"active\"><a href='#'>$i</a></li >"; 
						// } elseif ($i == 1) {
							// $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$i\" class=\"lnk\">$i</a> </li>";
						// } else {
							// $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$i\" class=\"lnk\">$i</a> </li>";
						// }
					// }
					
					// if ($pageNum > 1)
					// {
						// $page  = $pageNum - 1;
						// $prev  = "&nbsp;<a href=\"$self?PageIndex=$page\" class=\"lnk\">Previous</a> ";
						// $first = "&nbsp;<a href=\"$self?PageIndex=1\" class=\"lnk\">First Page</a> ";
					// } 
					// else
					// {
					   // $prev  = "&nbsp;<a href=\"#\" style=\"cursor:not-allowed;\" class=\"lnk\">Previous</a> ";
					   // $first = "";
					// }
					
					// if ($pageNum < $maxPage)
					// {
						// $page = $pageNum + 1;
						// $next = "&nbsp;<a href=\"$self?PageIndex=$page\" class=\"lnk\">Next</a> ";
						// $last = "&nbsp;<a href=\"$self?PageIndex=$maxPage\" class=\"lnk\">Last Page</a> ";
					// } 
					// else
					// {
					   // $next = "&nbsp;<a href=\"#\" style=\"cursor:not-allowed;\" class=\"lnk\">Next</a> ";
					   // $last = ""; // nor the last page link
					// }
				// }
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Allowances <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Allowances</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Allowances</h3>
			  <div class="buttons no-print">
				<a class="btn btn-primary margin no-print" onclick="window.print();" style="color:#fff"><i class="fa fa-print"></i> Print</a>
				<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
                <button class="btn btn-success margin" type="button" onClick="location.href='AddBulkAllowances.php'">Bulk Upload (CSV)</button>
                <button class="btn btn-success margin" type="button" onClick="location.href='AddNewAllowance.php'">Add New</button>
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-print no-print"></i> Excel</button>
                <button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Delete</button>
				<?php } ?>
                
               
            </div>
			
			<div class="row margin">
					<form id="frmPages" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
					<input type="hidden" id="action" name="action" value="" />
                        <div class="col-lg-12 col-xs-12">
							<div class="form-group no-print">
							  <label id="labelimp2" for="Role" >Allowances Filters: </label>
							</div>
                        </div><!-- ./col -->
						
						<div class="col-lg-2 col-xs-12">
							<div class="form-group">
							From:
							 <input type="date" name="FromDate" value="<?php echo $_SESSION['FromDate']; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-2 col-xs-12">
							<div class="form-group">
							Till:
							 <input type="date" name="TillDate" value="<?php echo $_SESSION['TillDate']; ?>" class="form-control" />
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
								echo '<option '.($_SESSION['CompanyIDEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
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
							echo '<option '.($_SESSION['LocationEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
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
							echo '<option '.($_SESSION['DepartmentEmployeeFrm'] == $Departments ? 'selected' : '').' value="'.$Departments.'">'.$Departments.'</option>';
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
							echo '<option '.($_SESSION['DesignationEmployeeFrm'] == $Designations ? 'selected' : '').' value="'.$Designations.'">'.$Designations.'</option>';
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
							<option <?php echo ($_SESSION['EmpTypeEmployeeFrm'] == 'Active' ? 'selected' : ''); ?> value="Active">Active</option>
							<option <?php echo ($_SESSION['EmpTypeEmployeeFrm'] == 'Deactive' ? 'selected' : ''); ?> value="Deactive">Deactive</option>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
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
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							  Title:
							  <select name="TitleAllowance" id="TitleAllowance" class="form-control">
								<option value="">All Titles</option>
								<?php
								 $query = "SELECT DISTINCT Title FROM allowances";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($_SESSION['TitleAllowance'] == $row['Title'] ? 'selected' : '').' value="'.$row['Title'].'">'.$row['Title'].'</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-5 col-xs-12 no-print">
                        <div class="form-group">
						 Employee:
						<select name="Employee" id="myselect" class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ".($_SESSION['EmpTypeEmployeeFrm'] != '' ? ' AND Status = "'.$_SESSION['EmpTypeEmployeeFrm'].'"' : '')." ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['EmployeeEmployeeFrm'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
							} 
							?>
						</select>
						</div>
					   </div>
						<div class="col-lg-8 col-xs-12 no-print">
						</div>
						<div class="col-lg-4 col-xs-12 no-print">
                           <div class="form-group">	
						<br>						   
						   <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
              <form id="frmPages2"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action2" name="action2" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="no-print" style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
					  <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Allowance Title</th>
					  <th>Amount Type</th>
					  <th>Amount / Percentage</th>
					  <th>Approved</th>
					  <th>Approved By</th>
					  <th>Date</th>
					  <th class="no-print"></th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="200" align="center" class="error"><b>No Allowance listed.</b></td>
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
                      <td align="center" class="noPrint no-print"><input class="chkIds no-print" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                     <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo dboutput($row["Title"]); ?></td>
					  <td><?php echo dboutput($row["Type"]); ?></td>
					  <td><?php echo ($row["Type"] == "FixedAmount" ? CURRENCY_SYMBOL.' '.dboutput($row["Amount"]) : dboutput($row["Percentage"]) . '%') ; ?></td>
                      <td><?php if(dboutput($row["Approved"])=='1'){echo '<i class="fa fa-fw fa-check-circle"></i>';}else{echo '<i class="fa fa-fw fa-times-circle"></i>';} ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td align="center" class="noPrint no-print"><button class="btn btn-info margin" type="button" onClick="location.href='EditAllowance.php?ID=<?php echo $row["ID"]; ?>&EmpID=<?php echo $row["EmpID"]; ?>'">Edit</button></td>
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
            <br>
            <!--<div class="row">
              <div class="col-xs-6">
                <div class="dataTables_info" id="example2_info"> Total <?php //echo $maxRow;?> entries </div>
              </div>
              <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php //echo $first;?> </li>
					<li class="prev "> <?php //echo $prev;?> </li>
                    <?php
					//echo $nav;
					?>
                    <li class="next"> <?php //echo $next;?> </li>
					<li class="next"> <?php //echo $last;?> </li>
                  </ul>
                </div>
              </div>
            </div>-->
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
<script src="excel/jquery.btechco.excelexport.js"></script>
<script src="excel/jquery.base64.js"></script>
<script src="excel/secure_download.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#dataTable").btechco_excelexport({
                containerid: "dataTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>
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
