<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<!--?php
if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR' OR user_authentication($_SESSION['UserID'],'TrainExeInMySprvisn') OR external_user_authentication($_SESSION['UserID'],'TrainExeInMySprvisn'))
{}else{redirect("Dashboard.php");}
?-->
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
<title>Appraisals In My Supervision</title>
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
				
				$query="SELECT ID, Title,StartTime,EndTime, StartDate,EndDate FROM appraisals WHERE ID <> 0 AND FIND_IN_SET (".$Employee.", Employees)";
				if($Keywords != "")
					$query .= " AND (Title LIKE '%" . dbinput($Keywords) . "%')";
				$query .= " ORDER BY ID DESC";
				
				
				
				
				$result = mysql_query ($query.$limit) or die("Could not select because: ".mysql_error()); 
				$num = mysql_num_rows($result);
				
				$r = mysql_query ($query) or die(mysql_error());
				$self = $_SERVER['PHP_SELF'];

				$maxRow = mysql_num_rows($r);
				if($maxRow > 0)
				{ 
					$maxPage = ceil($maxRow/$rowsPerPage);
					$nav  = '';
					
					$pmin = ($pageNum > $adjacents) ? ($pageNum - $adjacents) : 1;
					$pmax = ($pageNum < ($maxPage - $adjacents)) ? ($pageNum + $adjacents) : $maxPage;
					for ($i = $pmin; $i <= $pmax; $i++) {
						if ($i == $pageNum) {
							$nav .= "&nbsp;<li class=\"active\"><a href='#'>$i</a></li >"; 
						} elseif ($i == 1) {
							$nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$i\" class=\"lnk\">$i</a> </li>";
						} else {
							$nav .= "&nbsp;<li ><a href=\"$self?PageIndex=$i\" class=\"lnk\">$i</a> </li>";
						}
					}
					
					if ($pageNum > 1)
					{
						$page  = $pageNum - 1;
						$prev  = "&nbsp;<a href=\"$self?PageIndex=$page\" class=\"lnk\">Previous</a> ";
						$first = "&nbsp;<a href=\"$self?PageIndex=1\" class=\"lnk\">First Page</a> ";
					} 
					else
					{
					   $prev  = "&nbsp;<a href=\"#\" style=\"cursor:not-allowed;\" class=\"lnk\">Previous</a> ";
					   $first = ""; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = "&nbsp;<a href=\"$self?PageIndex=$page\" class=\"lnk\">Next</a> ";
						$last = "&nbsp;<a href=\"$self?PageIndex=$maxPage\" class=\"lnk\">Last Page</a> ";
					} 
					else
					{
					   $next = "&nbsp;<a href=\"#\" style=\"cursor:not-allowed;\" class=\"lnk\">Next</a> ";
					   $last = ""; // nor the last page link
					}
				}
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>In My Supervision <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">In My Supervision</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Appraisals In My Supervision</h3>
			  <form action="<?php echo $self;?>" method="post" style="clear:both; margin:0 5px">
                    <div class="input-group input-group-sm">
                        <input value="<?php if(isset($_REQUEST["Keywords"])){echo trim($_REQUEST["Keywords"]);}?>" type="text" name="Keywords" class="form-control span2">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
			<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-3 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Appraisals Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-6 col-xs-12">
							<div class="form-group">
							  <select name="Employee" id="Employee" class="form-control">
								<option value="0" >Select Employee</option>
									<?php
									 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID <> 0 AND Status = 'Active' AND Supervisor = '".empCodeByID($_SESSION['UserID'])."' ORDER BY ID ASC";
									$res = mysql_query($query);
									while($row = mysql_fetch_array($res))
									{
									echo '<option '.($Employee == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
									} 
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-xs-12">
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
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Title</th>
					  <th>Start</th>
					  <th>End</th>
					  <th>Self Rated</th>
					  <th>Supervisor Rated</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="11" align="center" class="error"><b>No Appraisal listed.</b></td>
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
                      <td><?php echo dboutput($row["Title"]); ?></td>
					  <td><?php echo dboutput($row["StartDate"]).' | '.dboutput($row["StartTime"]); ?></td>
					  <td><?php echo dboutput($row["EndDate"]).' | '.dboutput($row["EndTime"]); ?></td>
					  <td>
						<?php 
							$sql2 = "SELECT ID, EmpID, EmpMarks,SupMarks FROM appraisals_result WHERE EmpID = '".$Employee."' AND AppraisalID = '".$row['ID']."'";
							$da2 = mysql_query($sql2);
							$ro2 = mysql_fetch_assoc($da2);
							if($ro2['EmpMarks'] > 0)
							{
								echo '<span class="btn" style="background:green; color:#fff;">Rated | '.$ro2['EmpMarks'].'</span>';
							}
							else{
								$strDate = $row['StartDate'];
								$strDate = str_replace('/', '-', $strDate);
								$enDate = $row['EndDate'];
								$enDate = str_replace('/', '-', $enDate);
								echo ((date('Y-m-d', strtotime(date('Y-m-d'))) >= date('Y-m-d', strtotime($strDate))) && (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($enDate))) ? '<span class="btn btn-danger">Not Rate Yet</span>' : '<span class="btn btn-danger">'.((date('Y-m-d', strtotime(date('Y-m-d'))) > date('Y-m-d', strtotime($enDate))) ? 'Appraisal Missed' : 'Pending').'</span>');
							}
							?>
					  </td>
					  <td>
						<?php 
							$sql2 = "SELECT ID, EmpID, EmpMarks,SupMarks FROM appraisals_result WHERE EmpID = '".$Employee."' AND AppraisalID = '".$row['ID']."'";
							$da2 = mysql_query($sql2);
							$ro2 = mysql_fetch_assoc($da2);
							if($ro2['SupMarks'] > 0)
							{
								echo '<span class="btn" style="background:green; color:#fff;">Rated | '.$ro2['SupMarks'].'</span>';
							}
							else{
								$strDate = $row['StartDate'];
								$strDate = str_replace('/', '-', $strDate);
								$enDate = $row['EndDate'];
								$enDate = str_replace('/', '-', $enDate);
								echo ((date('Y-m-d', strtotime(date('Y-m-d'))) >= date('Y-m-d', strtotime($strDate))) && (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($enDate))) ? '<a class="btn btn-primary" href="GiveRankSup.php?ID='.$row['ID'].'&Employee='.$Employee.'">Rate Now</a>' : '<span class="btn btn-danger">'.((date('Y-m-d', strtotime(date('Y-m-d'))) > date('Y-m-d', strtotime($enDate))) ? 'Appraisal Missed' : 'Pending').'</span>');
							}
							?>
					  </td>
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
                    <li class="prev "> <?php echo $first;?> </li>
					<li class="prev "> <?php echo $prev;?> </li>
                    <?php
					echo $nav;
					?>
                    <li class="next"> <?php echo $next;?> </li>
					<li class="next"> <?php echo $last;?> </li>
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
