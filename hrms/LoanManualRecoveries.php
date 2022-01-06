<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$CompanyID=0;
$Location=0;
$Employee=0;
$Department="";
$SortBy="e.FirstName";
$FromDate="";
$TillDate="";

	$action = "";
	$msg = "";
	// if(isset($_POST["action"]))
		// $action = $_POST["action"];
// if($action == "delete")
	// {
		// if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		// {
			// foreach($_REQUEST["ids"] as $BID)
			// {
			// mysql_query("DELETE FROM Loans  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			// }
						
			// $_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Delete All selected Loans.</b>
			// </div>';
			// redirect("Loans.php");
		
		// }
		// else
		// {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Please select Loan to delete.</b>
			// </div>';
		// }
	// }
	
$TillDate=date("d-m-Y");
$d=strtotime("-1 Months");	
$FromDate=date("d-m-Y", $d);

if(isset($_REQUEST["CompanyID"]))
	$CompanyID=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
	$Location=trim($_REQUEST["Location"]);
if(isset($_REQUEST["Employee"]))
	$Employee=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Department"]))
	$Department=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SortBy"]))
	$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["FromDate"]))
	$FromDate=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
	$TillDate=trim($_REQUEST["TillDate"]);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Loan Manual Recoveries</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Loan-scalable=no' name='viewport'>
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
	
	
	// function doDelete()
	// {
		// if($(".chkIds").is(":checked"))
		// {
			// if(confirm("Are you sure to delete."))
			// {
				// $("#action").val("delete");
				// $("#frmPages").submit();
			// }
		// }
		// else
			// alert("Please select Loan to delete");
	// }
	
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
				
				$query="SELECT lmr.ID,lmr.Amount,DATE_FORMAT(lmr.PaymentDate, '%D %b %Y') AS PaymentDate,lmr.PaymentType,lmr.Reason,d.Code,d.Amount AS LoanAmount,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(lmr.DateAdded, '%D %b %Y') AS Added
				FROM loans_manualrecovery lmr LEFT JOIN loans d ON lmr.LoanID = d.ID LEFT JOIN employees e ON lmr.EmpID = e.ID LEFT JOIN employees a ON lmr.ApprovedBy = a.ID WHERE lmr.ID <>0 AND (lmr.PaymentDate BETWEEN '".date_format_Ymd($FromDate)."' AND '".date_format_Ymd($TillDate)."') ".($CompanyID != 0 ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != 0 ? ' AND e.Location = '.$Location.'' : '')." ".($Employee != 0 ? ' AND e.ID = '.$Employee.'' : '')." ".($Department != "" ? ' AND e.Department = '.$Department.'' : '')." ORDER BY ".$SortBy." ASC";
				
				
				
				$result = mysql_query ($query.$limit) or die("Could not select because: ".mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die(mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				if($maxRow > 0)
				{ 
					$maxPage = ceil($maxRow/$rowsPerPage);
					$nav  = '';
					if($maxPage>1)
					for($page = 1; $page <= $maxPage; $page++)
					{
						
					   if ($page == $pageNum)
						  $nav .= "&nbsp;<li class=\"active\"><a href='#'>$page</a></li >"; 
					   else
						  $nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">$page</a> </li>";
					}
					
					if ($pageNum > 1)
					{
						$page  = $pageNum - 1;
						$prev  = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Previous</a> ";
						$first = "&nbsp;<a href=\"$self?PageIndex=1&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">First</a> ";
					} 
					else
					{
					   $prev  = ''; // we're on page one, don't print previous link
					   $first = '&nbsp;First'; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = "&nbsp;<a href=\"$self?PageIndex=$page&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Next</a> ";
						$last = "&nbsp;<a href=\"$self?PageIndex=$maxPage&rpp=$rowsPerPage&Keywords=$Keywords&SortField=$SortField&SortType=$SortType&DFrom=$DFrom&DTo=$DTo\" class=\"lnk\">Last Page</a> ";
					} 
					else
					{
					   $next = "";
					   $last = '&nbsp;Last'; // nor the last page link
					}
				}
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Loan Manual Recoveries <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loan Manual Recoveries</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Manual Recoveries</h3>
			  <div class="buttons">
                
                <button class="btn btn-success margin" type="button" onClick="location.href='AddNewLoanManualRecovery.php'">Add New</button>
                
               
                
                
              </div>
            </div>
			<div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Recovery Filters: </label>
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
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($SortBy == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
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
						<br>
					   </div>
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
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Loan Tran #</th>
					  <th>Loan Amount</th>
					  <th>Recovery Voucher #</th>
					  <th>Recovery Amount</th>
					  <th>Recovery Date</th>
					  <th>Payment Method</th>
					  <th>Reason</th>
					  <th>Performed By</th>
					  <th>DateAdded</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Loan Manual Recovery listed.</b></td>
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
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']).' ('.dboutput($row['Department']).' - '.dboutput($row['Designation']).')'; ?></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <td><?php echo dboutput($row["Code"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["LoanAmount"]); ?></td>
					  <td>Voucher # <?php echo dboutput($row["ID"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["Amount"]); ?></td>
					  <td><?php echo $row["PaymentDate"]; ?></td>
                      <td><?php if(dboutput($row["PaymentType"])=='1'){echo 'Cash';} else if(dboutput($row["PaymentType"])=='2'){echo 'Cheque';} else if(dboutput($row["PaymentType"])=='3'){echo 'Adjustment';} else if(dboutput($row["PaymentType"])=='4'){echo 'Bonus';} ?></td>
					  <td><?php echo dboutput($row["Reason"]); ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
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
            <div class="row">
              <div class="col-xs-6">
                <div class="dataTables_info" id="example2_info"> Total <?php echo $maxRow;?> entries </div>
              </div>
              <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php echo $prev;?> </li>
                    <?php
					echo $nav;
					?>
                    <li class="next"> <?php echo $next;?> </li>
                  </ul>
                </div>
              </div>
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
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#myselect').select2();
</script>
</body>
</html>
