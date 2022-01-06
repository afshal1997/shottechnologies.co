<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php"); ?>
<?php 
$msg="";
$Title="";
$StartDate="";
$EndDate="";
$EmployeesToAttempt="";
$Employees=array();
$ID=0;
if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);

$query="SELECT ID,Title,Employees,StartDate,EndDate FROM appraisals WHERE ID <> 0 AND ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Invalid Appraisal ID.</b>
		</div>';
		redirect("Appraisals.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Title=$row["Title"];
		$StartDate=$row["StartDate"];
		$EndDate=$row["EndDate"];
		$Employees=explode(',', $row["Employees"]);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Appraisals Details</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Employee-scalable=no' name='viewport'>
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

		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Appraisals Details <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Appraisals Details</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Appraisal Title: <?php echo $Title; ?></h3>
			  <div class="buttons" style="width:50%">
                <button class="btn btn-info margin" type="button" onClick="location.href='AppraisalsCalendar.php'">Back to Calendar</button>
              </div>
            </div>
			<h4>&ensp;Duration: From - <?php echo $StartDate;?> | To - <?php echo $EndDate; ?></h4>
			<hr>
			<h4>&ensp;Employees: </h4>
            <!-- /.box-header -->
            <div class="box-body">
              
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
					  <th>ID / Code</th>
					  <th>Department</th>
					  <th>Designation</th>
					  <th>Self / Employee Score</th>
					  <th>Final / Supervisor Score</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
					
			if(empty($Employees))
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Employees listed.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				
				foreach($Employees as $emp)
				{
					echo empInfoByIDAppraisal($emp,$ID);
				}
			} 
			mysql_close($dbh);
		?>
                  </tbody>
                </table>
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
