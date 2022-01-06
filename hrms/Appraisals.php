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
			
			mysql_query("DELETE FROM appraisals  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Appraisals.</b>
			</div>';
			redirect("Appraisals.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Appraisal to delete.</b>
			</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Appraisals</title>
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
			alert("Please select Appraisal to delete");
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
				
				$query="SELECT ID,Title,StartDate,EndDate,StartTime,EndTime,Color,DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM appraisals WHERE ID <>0 ";
				if($Keywords != "")
					$query .= " AND (Title LIKE '%" . dbinput($Keywords) . "%')";
				
				
				
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
      <h1> Appraisals <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Appraisals</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Appraisals</h3>
			  <div class="buttons" style="width:50%">
			  <?php if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR'){ ?>
                <button class="btn btn-success margin" type="button" onClick="location.href='AddNewAppraisal.php'">Add New</button>
                <?php } ?>

              <?php if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR'){ ?>
                <button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" <?php if($maxRow<=0) {echo ' disabled="disabled"';}?>>Delete</button>
              <?php } ?>
				
                
               
                
                
              </div><form action="<?php echo $self;?>" method="post" style="clear:both; margin:0 5px">
                    <div class="input-group input-group-sm">
                        <input value="<?php if(isset($_REQUEST["Keywords"])){echo trim($_REQUEST["Keywords"]);}?>" type="text" name="Keywords" class="form-control span2">
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
                      <th>Title</th>
					  <th>Start</th>
					  <th>End</th>
					  <th>Color</th>
                      <th>Added</th>
                      <th>Updated</th>
                      <th class="sorting"></th>
					  <th class="sorting"></th>
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
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><?php echo dboutput($row["Title"]); ?></td>
					  <td><?php echo dboutput($row["StartDate"]).' | '.dboutput($row["StartTime"]); ?></td>
					  <td><?php echo dboutput($row["EndDate"]).' | '.dboutput($row["EndTime"]); ?></td>
					  <td><div style="width:30px;height:30px;background-color:<?php echo dboutput($row["Color"]); ?>;"></div></td>
                      <td><?php echo $row["Added"]; ?></td>
                      <td><?php echo $row["Updated"]; ?></td>
					  <td align="center" class="noPrint">

					  <?php if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR'){ ?>
					  <button class="btn btn-info margin" type="button" onClick="location.href='EditAppraisal.php?ID=<?php echo $row["ID"]; ?>'">Edit</button>
					  <?php } ?>
					  </td>
					  <td align="center" class="noPrint"><button class="btn btn-primary margin" type="button" onClick="location.href='AppraisalsDetails.php?ID=<?php echo $row["ID"]; ?>'">Details</button></td>
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