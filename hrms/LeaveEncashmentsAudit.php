<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
	$Rosterstartdate="";
	
	$num_of_days=0;
	$FromDate="";
	$CompanyID="";
	$CompID=array();
	$Remarks="";
	
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Leave Encashments</title>
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
			alert("Please select Leave Encashment to delete");
	}
	
	// function doUpdate()
	// {
		// if($(".chkIds").is(":checked"))
		// {
			// if(confirm("Are you sure to update."))
			// {
				// $("#action").val("update");
				// $("#frmPages").submit();
			// }
		// }
		// else
			// alert("Please select Payroll to update");
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
				
				$query="SELECT p.ID,DATE_FORMAT(p.DateAdded, '%D %b %Y<br>%r') AS DateAdded,DATE_FORMAT(p.EncashmentDate, '%D %b %Y') AS EncashmentDate,p.Heading,p.Steps,p.MonthEncashment,p.Remarks,p.CompanyID,e.EmpID,e.FirstName,e.LastName
				FROM encashment p LEFT JOIN employees e ON p.PerformedBy = e.ID WHERE p.ID <>0 AND p.Steps > 1";
				if($Keywords != "")
					$query .= " AND (p.MonthEncashment LIKE '%" . dbinput($Keywords) . "%')";
				$query .= " ORDER BY p.ID DESC";
				
				
				
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
      <h1> Leave Encashments <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave Encashments</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Leave Encashments</h3>
			  <div class="buttons">
			
              </div><form action="<?php echo $self;?>" method="post" style="clear:both; margin:0 5px">
                    <div class="input-group input-group-sm">
                        <input placeholder="Month" value="<?php if(isset($_REQUEST["Keywords"])){echo trim($_REQUEST["Keywords"]);}?>" type="text" name="Keywords" class="form-control span2">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form>
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
                      <th style="text-align:center"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Month</th>
					  <th>Encashment Date</th>
					  <th>Apply at Company</th>
					  <th>Heading</th>
					  <th>Remarks</th>
					  <th>Performed By</th>
					  <th>DateAdded</th>
					  <th></th>
					  <th></th>
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
                      <td colspan="15" align="center" class="error"><b>No Leave Encashment listed.</b></td>
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
                      <td align="center" class="noPrint"><input <?php echo ($row["Steps"] != 0 ? 'disabled' : ''); ?> class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo $row["MonthEncashment"]; ?></td>
					  <td><?php echo $row["EncashmentDate"]; ?></td>
					  <td>
					   <?php
						$query2 = "SELECT Name FROM companies where FIND_IN_SET(ID,'".$row["CompanyID"]."')";
						$res2 = mysql_query($query2) or die(mysql_error());
						while($row2 = mysql_fetch_array($res2))
						{
						echo $row2['Name'].'<br>';
						}
					  ?>
					  </td>
					  <td><?php echo dboutput($row["Heading"]); ?></td>
					  <td><?php echo dboutput($row["Remarks"]); ?></td>
                      <td><?php echo $row["EmpID"].' | '.$row["FirstName"]. ' ' .$row["LastName"]; ?></td>
					  <td><?php echo $row["DateAdded"]; ?></td>
					  <td align="center" class="noPrint"><button class="btn btn-info margin" type="button" onClick="location.href='EncashmentSheet.php?ID=<?php echo $row["ID"]; ?>'">Encashment Sheet</button><br><br>
					   <a href="EncashmentSheetCash.php?ID=<?php echo $row["ID"]; ?>" class="btn btn-success">Cash</a>
					   <a href="EncashmentSheetBank.php?ID=<?php echo $row["ID"]; ?>" class="btn btn-success">Bank</a></td> 
					   <td align="center" class="noPrint"><button <?php echo ($row["Steps"] != 3 ? 'disabled' : ''); ?> class="btn btn-warning margin" type="button" onClick="location.href='EncashmentSlips.php?ID=<?php echo $row["ID"]; ?>'">Pay Slips</button></td>
					   <td align="center" class="noPrint"><button <?php echo ($row["Steps"] < 0 ? 'disabled' : ''); ?> class="btn btn-danger margin" type="button" onClick="location.href='BankLetterEncashment.php?ID=<?php echo $row["ID"]; ?>'">Bank Letter</button><br><button <?php echo ($row["Steps"] < 0 ? 'disabled' : ''); ?> class="btn btn-danger margin" type="button" onClick="location.href='BankFTReportEncashment.php?ID=<?php echo $row["ID"]; ?>'">FT Report</button></td>
					   <td align="center" class="noPrint"><button <?php echo ($row["Steps"] < 0 ? 'disabled' : ''); ?> class="btn btn-warning margin" type="button" onClick="location.href='JournalVoucherEncashment.php?ID=<?php echo $row["ID"]; ?>'">Journal Voucher</button></td>
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

</body>
</html>
