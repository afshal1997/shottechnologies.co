<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
	$ID = 0;
	$Employee = 0;
	$msg = '';
	$i=0;
	$KPIID=array();
	$KPIID=array();
	$KPI=array();
	$WS=array();
	$Rank=array();
	

	if(isset($_REQUEST['ID']) && ctype_digit($_REQUEST['ID']))
		$ID = $_REQUEST['ID'];
	
	if(isset($_REQUEST['Employee']) && ctype_digit($_REQUEST['Employee']))
		$Employee = $_REQUEST['Employee'];
	

	if(isset($_POST['submit_frm']) && $_POST['submit_frm']=='submit_form')
	{
		// print_r($_POST);exit();
		// echo '<br>';
		
		if(isset($_REQUEST['ID']) && ctype_digit($_REQUEST['ID']))
			$ID = $_REQUEST['ID'];
	
		if(isset($_REQUEST['Employee']) && ctype_digit($_REQUEST['Employee']))
			$Employee = $_REQUEST['Employee'];
		
		if(isset($_POST["i"]))
			$i=$_POST["i"];
		if(isset($_POST["KPI"]))
			$KPIID=$_POST["KPIID"];
		if(isset($_POST["KPI"]))
			$KPI=$_POST["KPI"];
		if(isset($_POST["WS"]))
			$WS=$_POST["WS"];
		if(isset($_POST["Rank"]))
			$Rank=$_POST["Rank"];
		if($i > 0)
		{
			$query = "SELECT ID from appraisals_result WHERE EmpID = '".(int)$Employee."' AND AppraisalID = '".(int)$ID."'";
			//echo $query; exit();
			$resCount = mysql_query($query) or die(mysql_error());
			$numCount = mysql_num_rows($resCount);
			if($numCount == 1)
			{
								
				for($j = 0; $j < $i; $j++)
				{
					$query = "UPDATE appraisals_result_details SET SupID = '".(int)$_SESSION['UserID']."', SupRate = '".$Rank[$j]."',SupScore = '".($WS[$j] * $Rank[$j])."' WHERE AppraisalID = '".(int)$ID."' AND EmpID = '".(int)$Employee."' AND KPIID = '".$KPIID[$j]."'";
					mysql_query($query) or die(mysql_error());
				}
				
				$query = "SELECT SUM(SupScore) AS SupScore from appraisals_result_details WHERE EmpID = '".(int)$Employee."' AND AppraisalID = '".(int)$ID."'";
				//echo $query; exit();
				$resAttempts = mysql_query($query) or die(mysql_error());
				$numAttempts = mysql_num_rows($resAttempts);
				if($numAttempts == 1)
				{
					$row25 = mysql_fetch_array($resAttempts);
					$query = "UPDATE appraisals_result SET SupID = '".(int)$_SESSION['UserID']."',SupMarks = '".$row25['SupScore']."' WHERE EmpID = '".(int)$Employee."' AND AppraisalID = '".(int)$ID."'";
					mysql_query($query) or die(mysql_error());
				}
			}
			else
			{
				$query = "INSERT INTO appraisals_result SET EmpID = '".(int)$Employee."',SupID = '".(int)$_SESSION['UserID']."',AppraisalID = '".(int)$ID."',DateAdded = NOW()";
				mysql_query($query) or die(mysql_error());
				$TotalID = mysql_insert_id();
				
				for($j = 0; $j < $i; $j++)
				{
					$query = "INSERT INTO appraisals_result_details SET EmpID = '".(int)$Employee."', AppraisalID = '".(int)$ID."',  KPIID = '".$KPIID[$j]."', KPI = '".$KPI[$j]."', WS = '".$WS[$j]."', EmpRate = 1,EmpScore = '".($WS[$j] * 1)."',SupID = '".(int)$_SESSION['UserID']."',SupRate = '".$Rank[$j]."',SupScore = '".($WS[$j] * $Rank[$j])."',DateAdded = NOW()";
					mysql_query($query) or die(mysql_error());
				}
				
				$query = "SELECT SUM(EmpScore) AS EmpScore,SUM(SupScore) AS SupScore from appraisals_result_details WHERE EmpID = '".(int)$Employee."' AND AppraisalID = '".(int)$ID."'";
				//echo $query; exit();
				$resAttempts = mysql_query($query) or die(mysql_error());
				$numAttempts = mysql_num_rows($resAttempts);
				if($numAttempts == 1)
				{
					$row25 = mysql_fetch_array($resAttempts);
					$query = "UPDATE appraisals_result SET EmpMarks = '".$row25['EmpScore']."',SupMarks = '".$row25['SupScore']."' WHERE ID = '".(int)$TotalID."'";
					mysql_query($query) or die(mysql_error());
				}
			}
			
			
		}
		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Your Rating has been submitted.</b>
		</div>';
		redirect("InMySupervisionAppraisals.php");
	}
	
	$sql = "SELECT ID, Name, WS FROM kpi WHERE Status = 1 AND EmpID = ".$Employee."";
	$data = mysql_query($sql) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Rate Yourself</title>
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

		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Rate Employee <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="InMySupervisionAppraisals.php"><i class="fa fa-dashboard"></i> In My Supervision </a></li>
        <li class="active">Rate Employee</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
				
			  </h3>
			  <div class="buttons" style="width:50%">
                <button class="btn bg-navy margin" type="button" onClick="location.href='InMySupervisionAppraisals.php'">Back</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
				  <form action="<?php echo $_SERVER['PHP_SELF'];?>?ID=<?php echo $ID;?>&Employee=<?php echo $Employee;?>" class="form-horizontal no-margin" method="post" enctype="multipart/form-data">
						<hr>
						<div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">s.no </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Key Performance Indicators (KPI)</label>
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-4">Rating</label>
								 
								 
							</div>
						  </div>
						  
						  <hr>
						
						  
						  
					  <?php
					  $i = 1;
					  while($row = mysql_fetch_array($data))
					  {
					  ?>
					     <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;"><?php echo $i; ?>) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8"><?php echo $row['Name']; ?></label>
								 <input type="hidden" name="KPIID[]" value="<?php echo $row['ID']; ?>" />
								 <input type="hidden" name="KPI[]" value="<?php echo $row['Name']; ?>" />
								 <input type="hidden" name="WS[]" value="<?php echo $row['WS']; ?>" />
								 <input type="hidden" name="i" value="<?php echo $i; ?>" />
								 <select name="Rank[]" style="width:100px">
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  <?php
						  $i++;
						  }
					  ?>
					  
					  



                      <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">
							
							<?php
							if(isset($_REQUEST['ID']))
							{
							?>

								<button type="submit" class="btn btn-info" >Submit</button>
								<input type="button" onclick="location.href='InMySupervisionAppraisals.php'" value="Cancel" class="btn btn-info"/>
							<?php
							}
							?>

							<input type="hidden" name="submit_frm" value="submit_form" />

							
							

							</div>

						

                      </div>

                    </form>


				    <?php				
			mysql_close($dbh);
		?>

            </div>
            <br>
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
