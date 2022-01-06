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
			$row = mysql_query("SELECT Photo FROM employees  WHERE ID = ". $BID ."") or die (
mysql_error());
			$dt = mysql_fetch_array($row);
			if(is_file(DIR_EMPLOYEEPHOTOES . $dt['Photo']))
				unlink(DIR_EMPLOYEEPHOTOES . $dt['Photo']);
			
			
			mysql_query("DELETE FROM employees  WHERE ID IN (" . $BID . ")") or die (mysql_error());
			
			}
						
			$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Delete All selected Employees.</b>
			</div>';
			redirect("Employees.php");
		
		}
		else
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Employee to delete.</b>
			</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employees</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->



<link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->



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
			alert("Please select Employee to delete");
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

				
				
				$query="SELECT e.ID,c.Name,e.Status,e.Photo,e.EmpID,e.FirstName,e.LastName,e.Role,e.Department,e.Designation,DATE_FORMAT(e.DateAdded, '%D %b %Y<br>%r') AS Added,DATE_FORMAT(e.DateModified, '%D %b %Y<br>%r') AS Updated
				FROM employees e LEFT JOIN companies c ON e.CompanyID = c.ID WHERE e.ID <>0 ORDER BY e.Status,e.ID";
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$num = mysql_num_rows($result);
				
				
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Employees <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employees</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Employees</h3>
			  <div class="buttons" style="width:70%">
				<button class="btn bg-purple margin" type="button" onClick="location.href='SortedBulkDownload.php'">Sorted Download</button>
				<button class="btn btn-warning margin" type="button" onClick="location.href='BulkUpload.php'">Bulk Upload</button>
				<button class="btn btn-danger margin" type="button" onClick="location.href='BulkDownload.php'">Bulk Download</button>
                <button class="btn btn-success margin" type="button" onClick="location.href='AddNewEmployee.php'">Add New</button>
                <button type="button" class="btn bg-navy margin" onClick="javascript:doDelete()" <?php if($num<=0) {echo ' disabled="disabled"';}?>>Delete</button>
				
                
               
                
                
              </div>
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
			  <input type="hidden" id="action" name="action" value="" />
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="color:#000;">
                      <th style="text-align:center"><!--<input type="checkbox" name="chkAll" class="checkUncheckAll">--></th>
                      <th>Name</th>
					  <th>Photo</th>
					  <th>Employee ID</th>
					  <!--<th>Role</th>-->
					  <th>Company</th>
					  <th>Department</th>
					  <th>Designation</th>
					  <th>Status</th>
                      <th>Added</th>
                      <th>Updated</th>
                      <th class="sorting"></th>
                    </tr>
                  </thead>
				  
                  <tbody>
				
				<?php
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
		?>
                    <tr>
                      <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
                        <input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
                      <td><a href="EmployeeProfile.php?ID=<?php echo $row["ID"]; ?>" target="_blank"><?php echo dboutput($row["FirstName"]) ." ". dboutput($row["LastName"]); ?></a></td>
					  <td><img class="thumbnail" src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $row['Photo']) ? DIR_EMPLOYEEPHOTOES.dboutput($row['Photo']) : 'images/avatar.png'); ?>"  style="width:80px;" /></td>
					  <td><?php echo dboutput($row["EmpID"]); ?></td>
					  <!--<td><?php //echo dboutput($row["Role"]); ?></td>-->
					  <td><?php echo dboutput($row["Name"]); ?></td>
					  <td><?php echo dboutput($row["Department"]); ?></td>
					  <td><?php echo dboutput($row["Designation"]); ?></td>
                      <!--<td><?php //if(dboutput($row["Status"])=='Active'){echo '<i style="font-size:20px" class="fa fa-fw fa-check-circle"></i>';}else{echo '<i style="font-size:20px" class="fa fa-fw fa-times-circle"></i>';} ?></td>-->
					 <td><?php if(dboutput($row["Status"])=='Active'){echo '<span style="background-color:green;color:white">&nbsp;Active&nbsp;</span>';}else{echo '<span style="background-color:red;color:white">&nbsp;Deactive&nbsp;</span>';} ?></td>
                      <td><?php echo $row["Added"]; ?></td>
                      <td><?php echo $row["Updated"]; ?></td>
					  <td align="center" class="noPrint"><button class="btn btn-info margin" type="button" onClick="location.href='EditEmployee.php?ID=<?php echo $row["ID"]; ?>'">Edit</button></td>
                    </tr>
                    <?php				
				}
			mysql_close($dbh);
		?>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/demo.js" type="text/javascript"></script>
        <!-- page script -->
		
       <!-- <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
				
            });
        </script>-->    
     <script type="text/javascript">
            $(function() {
               $("#example1").dataTable();
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        
        

</body>
</html>
