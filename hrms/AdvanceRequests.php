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
			mysql_query("DELETE FROM advance_requests  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Advance Requests.</b>
			</div>';
			redirect("AdvanceRequests.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Advance Request to delete.</b>
			</div>';
		}
	}
	
	
	if($action == "approve")
	{
		if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		{
			foreach($_REQUEST["ids"] as $BID)
			{
			
			$query="SELECT ID,Code,EmpID,Amount,RepaymentDate from advance_requests WHERE ID = ".$BID." AND Approved = 0";
			$result = mysql_query($query) or die (mysql_error());
			$num = mysql_num_rows($result);
			if($num == 1)
			{
			$row2=mysql_fetch_array($result);
					
			$query="UPDATE advance_requests SET 
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				Approved = 1,
				AdvanceGranted = 1,
				DateModified = NOW() WHERE ID = ".$BID."";
			mysql_query($query) or die (mysql_error());
			
			$get_max_details = mysql_query("SELECT * FROM advances ORDER BY ID DESC LIMIT 1")
			or die(mysql_error());
			$row = mysql_fetch_array($get_max_details);
			$last_query = $row['ID'];
			if ($last_query ==  0) {$last_query1 = 0;} else {$last_query1 = $last_query;}
			$i = $last_query1;
			$i++;
			$Code = "A-".str_pad($i,5,"0",STR_PAD_LEFT);
			
			$query="INSERT INTO advances SET 
				EmpID = '" . dbinput($row2['EmpID']) . "',
				AdvanceReqID = '" . dbinput($row2['ID']) . "',
				Code = '".dbinput($Code)."',
				Status = 0,
				Amount = '" . $row2['Amount'] . "',
				RemainingAmount = '" . $row2['Amount'] . "',
				RepaymentDate = '" . dbinput($row2['RepaymentDate']) . "',
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				DateAdded = NOW()";
			mysql_query($query) or die (mysql_error());
			$ID = mysql_insert_id();
			}
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Approved All selected Advance Requests.</b>
			</div>';
			redirect("AdvanceRequests.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Advance Request to Approve.</b>
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Advance Requests</title>
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
			alert("Please select Advance Request to delete");
	}
	
	function doApprove()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Approve all selected advances."))
			{
				$("#action").val("approve");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Advance Request to Approve");
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
				$nav="";
				$rowsPerPage=20;
				$pageNum=1;
				
				$DFrom="";
				$DTo="";
				$DateFrom="";
				$DateTo="";
				
				$Keywords="";
				
				$SortField=2;
				$SortType="ASC";
					
				$_SORT_FIELDS = array("DateAdded");
				
				if(isset($_REQUEST["Keywords"]))
					$Keywords = trim($_REQUEST["Keywords"]);

				if(isset($_REQUEST["PageIndex"]) && ctype_digit(trim($_REQUEST["PageIndex"])))
					$pageNum=trim($_REQUEST["PageIndex"]);

				$offset = ($pageNum - 1) * $rowsPerPage;
				$limit=" Limit ".$offset.", ".$rowsPerPage;
				
				$query="SELECT l.ID,l.Approved,l.AdvanceGranted,l.Code,l.Amount,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Added,DATE_FORMAT(l.DateModified, '%D %b %Y') AS Updated
				FROM advance_requests l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN employees a ON l.ApprovedBy = a.ID WHERE l.ID <>0 ".($_SESSION['CompanyIDEmployeeFrm'] != 0 ? ' AND e.CompanyID = '.$_SESSION['CompanyIDEmployeeFrm'].'' : '')." ".($_SESSION['LocationEmployeeFrm'] != 0 ? ' AND e.Location = '.$_SESSION['LocationEmployeeFrm'].'' : '')." ".($_SESSION['EmployeeEmployeeFrm'] != 0 ? ' AND e.ID = '.$_SESSION['EmployeeEmployeeFrm'].'' : '')." ".($_SESSION['DepartmentEmployeeFrm'] != "" ? ' AND e.Department = "'.$_SESSION['DepartmentEmployeeFrm'].'"' : '')." ".($_SESSION['DesignationEmployeeFrm'] != "" ? ' AND e.Designation = "'.$_SESSION['DesignationEmployeeFrm'].'"' : '')." ".($_SESSION['EmpTypeEmployeeFrm'] != '' ? ' AND e.Status = "'.$_SESSION['EmpTypeEmployeeFrm'].'"' : '')." ORDER BY ".$_SESSION['SortByEmployeeFrm']." ASC";
				
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
					// if($maxPage>1)
					// for($page = 1; $page <= $maxPage; $page++)
					// {
						
					   // if ($page == $pageNum)
						  // $nav .= "&nbsp;<li class=\"active\"><a href='#'>$page</a></li >"; 
					   // else
						  // $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">$page</a> </li>";
					// }
					
					// if ($pageNum > 1)
					// {
						// $page  = $pageNum - 1;
						// $prev  = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Previous</a> ";
						// $first = "&nbsp;<a href=\"$self?PageIndex=1&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">First</a> ";
					// } 
					// else
					// {
					   // $prev  = ''; 
					   // $first = '&nbsp;First'; 
					// }
					
					// if ($pageNum < $maxPage)
					// {
						// $page = $pageNum + 1;
						// $next = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Next</a> ";
						// $last = "&nbsp;<a href=\"$self?PageIndex=$maxPage&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Last Page</a> ";
					// } 
					// else
					// {
					   // $next = "";
					   // $last = '&nbsp;Last'; 
					// }
				// }
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Advance Requests <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Advance Requests</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Advance Requests</h3>
			  <div class="buttons no-print">
                <a class="btn btn-primary margin no-print" onclick="window.print();" style="color:#fff"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-success margin" onClick="javascript:doApprove()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Bulk Approve</button>
				<button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Delete</button>
               
                
                
              </div>
				<div class="row margin">
					<form id="frmPages2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
                        <div class="col-lg-12 col-xs-12">
							<div class="form-group no-print">
							  <label id="labelimp2" for="Role" >Advance Requests Filters: </label>
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
						  Employee Status:
							<select name="EmpType" id="EmpType" class="form-control">
							<option value="" >Both Active and Deactive</option>
							<option <?php echo ($_SESSION['EmpTypeEmployeeFrm'] == 'Active' ? 'selected' : ''); ?> value="Active">Active</option>
							<option <?php echo ($_SESSION['EmpTypeEmployeeFrm'] == 'Deactive' ? 'selected' : ''); ?> value="Deactive">Deactive</option>
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
						<div class="col-lg-4 col-xs-12 no-print">
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
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="no-print" style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Tran#</th>
					  <th>Amount</th>
					  <th>Status</th>
					  <th>Advance Granted</th>
					  <th>Performed By</th>
					  <th>DateAdded</th>
					  <th>DateModified</th>
					  <th class="no-print"></th>
					  <th class="no-print"></th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Advance Request listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
		?>
                    <tr>
                      <td align="center" class="no-Print no-print"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo dboutput($row["Code"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["Amount"]); ?></td>
                      <td><?php if(dboutput($row["Approved"])=='1'){echo '<mark style="background-color:#0f0">Approved</mark>';}else if(dboutput($row["Approved"])=='0'){echo '<mark style="background-color:#ff0">Pending</mark>';}else{echo '<mark style="background-color:#f00">DisApproved</mark>';} ?></td>
					  <td><?php if(dboutput($row["AdvanceGranted"])=='1'){echo '<mark style="background-color:#0f0">Yes</mark>';}else{echo '<mark style="background-color:#f00">No</mark>';} ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td><?php echo $row["Updated"]; ?></td>
					  <td align="center" class="no-Print no-print"><button class="btn btn-info margin no-print" type="button" onClick="location.href='AdvanceRequestSlip.php?ID=<?php echo $row["ID"]; ?>'">Slip</button></td>
					  <td align="center" class="no-Print no-print"><button class="btn btn-info margin no-print" type="button" onClick="location.href='ViewAdvanceRequest.php?ID=<?php echo $row["ID"]; ?>'">Details</button></td>
                    </tr>
                    <?php				
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
                    <li class="prev "> <?php //echo $prev;?> </li>
                    <?php
					//echo $nav;
					?>
                    <li class="next"> <?php //echo $next;?> </li>
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
