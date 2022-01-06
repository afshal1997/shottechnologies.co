<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$FromDate="";
$TillDate="";
$Employee=0;
$Status=100;
$CompanyID="";
$CompID=array();

if(isset($_REQUEST["FromDate"]))
		$FromDate=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
		$TillDate=trim($_REQUEST["TillDate"]);
if(isset($_REQUEST["Employee"]))
		$Employee=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Status"]))
		$Status=trim($_REQUEST["Status"]);
if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}


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
				$query = "SELECT ID FROM loans where ID IN (" . $BID . ") AND RemainingAmount <> Amount";
				$res = mysql_query($query) or die(mysql_error());
				$num = mysql_num_rows($res);
				if($num == 0)
				{
					mysql_query("DELETE FROM loans  WHERE ID IN (" . $BID . ")") or die (mysql_error());
					mysql_query("DELETE FROM loans_schedule WHERE LoanID IN (" . $BID . ")") or die (mysql_error());
				}
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Loans.</b>
			</div>';
			redirect("Loans.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Loan to delete.</b>
			</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Loans</title>
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
	</script>
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
			alert("Please select Loan to delete");
	}
	
</script>
<script type="text/javascript" async="async" id="true" src="excel/views2.json"></script>
<script type="text/javascript" src="excel/300lo.json"></script>
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
				
				$query="SELECT d.ID,d.Code,d.LoanType,d.Status,DATE_FORMAT(d.DisbursementDate, '%D %b %Y') AS DisbursementDate,d.Amount,d.Reason,d.RemainingAmount,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(d.DateAdded, '%D %b %Y') AS Added,DATE_FORMAT(d.DateModified, '%D %b %Y') AS Updated
				FROM loans d LEFT JOIN employees e ON d.EmpID = e.ID LEFT JOIN employees a ON d.ApprovedBy = a.ID WHERE d.ID <>0 ".($Employee != 0 ? ' AND d.EmpID = '.$Employee.'' : '')." ".($CompanyID != '' ? ' AND FIND_IN_SET(e.CompanyID,\''.$CompanyID.'\')' : '')." ".($Status != 10 ? ' AND d.Status = '.$Status.'' : '')." ".($FromDate != "" && $TillDate != "" ? ' AND (d.DisbursementDate BETWEEN \''.$FromDate.'\' AND \''.$TillDate.'\')' : '')." ";
				if($Keywords != "")
					$query .= " AND (d.Code LIKE '%" . dbinput($Keywords) . "%')";
				
				$query .= " ORDER BY d.DisbursementDate DESC";
				
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
					   // $prev  = ''; // we're on page one, don't print previous link
					   // $first = '&nbsp;First'; // nor the first page link
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
					   // $last = '&nbsp;Last'; // nor the last page link
					// }
				// }
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Loans <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loans</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loans</h3>
			  <div class="buttons">
                
				<button class="btn btn-primary margin no-print" id="btnExport"><i class="fa fa-download"></i> Download Excel</button>
				<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
                <button class="btn btn-success margin" type="button" onClick="location.href='AddManualLoan.php'">Add Manual Loan</button>
                <button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" style="margin-right:auto"<?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Delete</button>
               <?php } ?>
                
                
              </div>
            </div>
			<div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Loan Filters: </label>
							</div>
                        </div><!-- ./col -->
                        <div class="col-lg-2 col-xs-12">
							<div class="form-group">
							From:
							 <input type="date" name="FromDate" value="<?php echo $FromDate; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-2 col-xs-12">
							<div class="form-group">
							Till:
							 <input type="date" name="TillDate" value="<?php echo $TillDate; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
						  Employee:
							<select name="Employee" id="Employee" class="form-control">
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
						</div>
						</div><!-- ./col -->
						<div class="col-lg-2 col-xs-12 no-print">
							<div class="form-group">
							Status:
							 <select name="Status" id="Status" class="form-control">
								<option <?php echo ($Status == '10' ? 'selected' : ''); ?> value="10">All Status</option>
								<option <?php echo ($Status == '0' ? 'selected' : ''); ?> value="0">Running</option>
								<option <?php echo ($Status == '1' ? 'selected' : ''); ?> value="1">Completed</option>
								<option <?php echo ($Status == '2' ? 'selected' : ''); ?> value="2">Stopped</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12 no-print">
							<div class="form-group">
							  Company:
								<div class="selectBox" onclick="showCheckboxes()">
									<select class="form-control">
										<option>Select Company</option>
									</select>
									<div class="overSelect"></div>
								</div>
								<div id="checkboxes" style="height:250px; overflow:scroll;">						
									<?php
									$query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
									$res = mysql_query($query);
									while($row = mysql_fetch_array($res))
									{
									echo '<label><input '.(in_array($row['ID'], $CompID) ? "checked = checked" : "").' type="checkbox" name="CompanyID[]" value="'.$row['ID'].'"/> '.$row['Name'].'</label>';
									}
									?>
								</div>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-10">
                           
                        </div><!-- ./col -->
						<div class="col-lg-2 col-xs-12">
						<br>
                           <div class="form-group">
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
				<div id="tblExport">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Employee Name</th>
					  <th>ID / Code</th>
					  <th>Tran#</th>
					  <th>Loan Type</th>
					  <th>Disbursement Date</th>
					  <th>Loan Amount</th>
					  <th>Remaining Amount</th>
					  <th>Status</th>
					  <th>Performed By</th>
					  <th>Manual Entry Reason</th>
					  <th></th>
					  <th></th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="13" align="center" class="error"><b>No Loan listed.</b></td>
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
					  <td><?php echo dboutput($row["LoanType"]); ?></td>
					  <td><?php echo dboutput($row["DisbursementDate"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["Amount"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.round(dboutput($row["RemainingAmount"])); ?></td>
                      <td><?php if(dboutput($row["Status"])=='1'){echo '<mark style="background-color:#0f0">Completed</mark>';}else if(dboutput($row["Status"])=='0'){echo '<mark style="background-color:#ff0">Running</mark>';}else{echo '<mark style="background-color:#f00">Stoped</mark>';} ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Reason"]; ?></td>
					  <td align="center" class="noPrint"><button class="btn btn-info margin" type="button" onClick="location.href='LoanSlip.php?ID=<?php echo $row["ID"]; ?>'">Slip</button></td>
					  <td align="center" class="noPrint"><button class="btn btn-info margin" type="button" onClick="location.href='EditLoan.php?ID=<?php echo $row["ID"]; ?>'">Details</button></td>
                    </tr>
                    <?php				
				}
			} 
			mysql_close($dbh);
		?>
                  </tbody>
                </table>
				</div>
			  </form>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <div class="dataTables_info" id="example2_info"> Total <?php echo $maxRow;?> entries </div>
              </div>
              <div class="col-xs-6">
                <!--<div class="dataTables_paginate paging_bootstrap">
                  <ul class="pagination">
                    <li class="prev "> <?php //echo $prev;?> </li>
                    <?php
					//echo $nav;
					?>
                    <li class="next"> <?php //echo $next;?> </li>
                  </ul>
                </div>-->
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
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#Employee').select2();
</script>
</body>
</html>
