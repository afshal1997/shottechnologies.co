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

$What="";

$LeaveDays = array();
$HalfDays = array();

$ArrivalTime="";
$DepartTime="";
$LateArrival="";
$EarlyDepart="";
$ArrivalHalfDay="";
$DepartHalfDay="";

$startdate = '';

$LastID=0;

	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];


$e=strtotime("+1 Days");
$TillDate=date("d-m-Y", $e);
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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Leave Adjust Requests</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Adjustment-scalable=no' name='viewport'>
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
			alert("Please select Leave Adjust Request to delete");
	}
	
	function doBulkapprove()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to bulk approve."))
			{
				$("#action").val("bulkapprove");
				$("#frmPages").submit();
			}
		}
		else
			alert("Please select Leave Adjust Request to Approve");
	}
	
</script>
</head>
<body class="skin-blue attendance-pg-wrap">
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
				
				$query="SELECT l.ID,l.Type,l.Adjust,l.RosterID,DATE_FORMAT(l.Date, '%D %b %Y') AS AdjustDate,l.Approved,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Added,DATE_FORMAT(l.DateModified, '%D %b %Y') AS Updated,l.DisapproveReason FROM leaveadjust_requests l LEFT JOIN employees e ON l.EmpID = e.ID LEFT JOIN employees a ON l.ApprovedBy = a.ID WHERE l.ID <>0 AND (l.DateAdded BETWEEN '".date_format_Ymd($FromDate)."' AND '".date_format_Ymd($TillDate)."') AND e.ID = '".$_SESSION['UserID']."' ORDER BY l.Approved,l.ID DESC";
				
				
				
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
      <h1> My Leave Adjust Requests <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Leave Adjust Requests</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">My Leave Adjust Requests</h3>

            </div>
			<div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="margin">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Requests Filters: </label>
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
						 Employee:
						<select name="Employee" id="myselectdemo" disabled class="js-example-disabled-results form-control">
						  <option value="" >All Employees</option>
							<?php
							 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 ORDER BY ID ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($_SESSION['UserID'] == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].'</option>';
							} 
							?>
						</select>
						</div>
						<br>
					   </div>
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
					  <th>Adjust Date</th>
					  <th>Adjust Type</th>
					  <th>Leave Type</th>
					  <th>Status</th>
					  <th>Performed By</th>
					  <th>DateAdded</th>
					  <th>DateModified</th>
					  <th>HR Comments</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Leave Adjust Request listed.</b></td>
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
					  <td><?php echo dboutput($row["AdjustDate"]); ?></td>
					  <td><?php echo dboutput($row["Adjust"]); ?></td>
					  <td><?php echo dboutput($row["Type"]); ?></td>
                      <td><?php if(dboutput($row["Approved"])=='1'){echo '<mark style="background-color:#0f0">Approved</mark>';}else if(dboutput($row["Approved"])=='0'){echo '<mark style="background-color:#ff0">Pending</mark>';}else{echo '<mark style="background-color:#f00">DisApproved</mark>';} ?></td>
                      <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td><?php echo $row["Updated"]; ?></td>
					  <td><?php echo $row["DisapproveReason"]; ?></td>
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
