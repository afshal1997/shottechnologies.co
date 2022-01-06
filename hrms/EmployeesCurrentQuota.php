<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$Anual=0;
$Casual=0;
$CAnual=0;
$CCasual=0;
$TAnual=0;
$TCasual=0;

?>
<?php
$Employee=0;

if(isset($_REQUEST["Employee"]))
		$Employee=trim($_REQUEST["Employee"]);
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employees Leaves Quota</title>
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

				
				$query1="SELECT AnualLeaves,CasualLeaves FROM leaves_quota  WHERE ID <>0 AND EmpID=".(int)$Employee." AND Approved = 1";
				$res1 = mysql_query($query1) or die(mysql_error());
				$num1 = mysql_num_rows($res1);
				if($num1 == 1)
				{
					$row1 = mysql_fetch_array($res1);
					$Anual=$row1['AnualLeaves'];
					$Casual=$row1['CasualLeaves'];
					
					$query2="SELECT AnualLeaves,CasualLeaves FROM current_leaves_quota  WHERE ID <>0 AND EmpID=".(int)$Employee."";
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
				}
				
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Employees Current Leaves Quota <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employees Current Leaves Quota</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Employee Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-6 col-xs-12">
							<div class="form-group">
							  <select name="Employee" id="Employee" class="form-control">
								<option value="0" >Select Employee</option>
									<?php
									 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 AND Status = 'Active' ORDER BY ID ASC";
									$res = mysql_query($query);
									while($row = mysql_fetch_array($res))
									{
									echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
									} 
									?>
								</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
					</form>
            </div><!-- /.row -->
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
                      <th width="80%">Leaves Type</th>
					  <th>Entitled</th>
					  <th>Taken</th>
					  <th>Balance</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <tr>
                      
                      
					  <td width="50%">Annual Leaves</td>
					  <td><?php echo $Anual ; ?></td>
                      <td><?php echo $TAnual ; ?></td>
					  <td><?php echo $CAnual ; ?></td>
                    </tr>
					<tr>
                      
                      
					  <td width="50%">Casual Leaves</td>
					  <td><?php echo $Casual ; ?></td>
                      <td><?php echo $TCasual ; ?></td>
					  <td><?php echo $CCasual ; ?></td>
                    </tr>
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
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#Employee').select2();
</script>
</body>
</html>
