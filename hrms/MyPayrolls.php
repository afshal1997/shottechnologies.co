<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
$Employee=$_SESSION['UserID'];

	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My Payrolls</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
</style>
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
				$rowsPerPage=31;
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
				
				$query="SELECT d.ID,d.Month,d.Year,d.BasicSalary,d.TotalAmount,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,a.FirstName AS fn,a.LastName AS ln,a.Department AS dep,a.Designation AS des,DATE_FORMAT(d.CreatedTime, '%D %b %Y <br> %r') AS Added
				FROM payroll d LEFT JOIN employees e ON d.EmpID = e.ID LEFT JOIN employees a ON d.CreatedBy = a.ID WHERE d.ID <>0  AND d.EmpID =".$Employee." ORDER BY d.Month DESC,e.Department ASC,e.Designation ASC,e.FirstName ASC,e.LastName ASC";
				
				
				$result = mysql_query ($query.$limit) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die("Could not select because: ".mysql_error());
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
      <h1>My Payrolls <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Payrolls</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
		  <div class="box-body table-responsive">
              <?php
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
                      <th>Employee</th>
					  <th>ID / Code</th>
                      <th>Month</th>
					  <th>Year</th>
                      <th>Basic Salary</th>
					  <th>Net Salary</th>
					  <th>Created By</th>
					  <th>Time</th>
                      <th>Salary Slip</th>
					  <!--<th>Refresh Salary</th>-->
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
			?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Payroll listed.</b></td>
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
					  <td><?php echo get_month_name(dboutput($row["Month"])); ?></td>
					  <td><?php echo dboutput($row["Year"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["BasicSalary"]); ?></td>
					  <td><?php echo CURRENCY_SYMBOL.' '.dboutput($row["TotalAmount"]); ?></td>
					  <td><?php echo dboutput($row['fn']).' '.dboutput($row['ln']).' ('.dboutput($row['dep']).' - '.dboutput($row['des']).')'; ?></td>
					  <td><?php echo $row["Added"]; ?></td>
					  <td><a class="btn btn-success margin" href="SalarySlip.php?ID=<?php echo $row['ID']; ?>">View</a></td>
					 <!-- <td><button class="btn btn-info margin" type="button" onClick="">Refresh</button></td>-->
                    </tr>
                    <?php				
				}
			} 
		?>
                  </tbody>
                </table>
              </form>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <!--<div class="dataTables_info" id="example2_info"> Total <?php //echo $maxRow;?> entries </div>-->
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
