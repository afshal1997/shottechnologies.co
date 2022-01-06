<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
	
	$CanID = 0;
	$PostID = 0;
	
	$A1 = 0;
	$A2 = 0;
	$A3 = 0;
	$A4 = 0;
	$A5 = 0;
	$A6 = 0;
	$A7 = 0;
	$A8 = 0;
	$A9 = 0;
	$A10 = 0;

	$msg = '';
	$Score = 0;
	

	if(isset($_REQUEST['CanID']) && ctype_digit($_REQUEST['CanID']))
		$CanID = $_REQUEST['CanID'];
	if(isset($_REQUEST['PostID']) && ctype_digit($_REQUEST['PostID']))
		$PostID = $_REQUEST['PostID'];
	

	if(isset($_POST['submit_frm']) && $_POST['submit_frm']=='submit_form')
	{
		
		if(isset($_POST["A1"]) && ctype_digit($_POST['A1']))
		$A1=trim($_POST["A1"]);
		if(isset($_POST["A2"]) && ctype_digit($_POST['A2']))
		$A2=trim($_POST["A2"]);
		if(isset($_POST["A3"]) && ctype_digit($_POST['A3']))
		$A3=trim($_POST["A3"]);
		if(isset($_POST["A4"]) && ctype_digit($_POST['A4']))
		$A4=trim($_POST["A4"]);
		if(isset($_POST["A5"]) && ctype_digit($_POST['A5']))
		$A5=trim($_POST["A5"]);
		if(isset($_POST["A6"]) && ctype_digit($_POST['A6']))
		$A6=trim($_POST["A6"]);
		if(isset($_POST["A7"]) && ctype_digit($_POST['A7']))
		$A7=trim($_POST["A7"]);
		if(isset($_POST["A8"]) && ctype_digit($_POST['A8']))
		$A8=trim($_POST["A8"]);
		if(isset($_POST["A9"]) && ctype_digit($_POST['A9']))
		$A9=trim($_POST["A9"]);
		if(isset($_POST["A10"]) && ctype_digit($_POST['A10']))
		$A10=trim($_POST["A10"]);
			
		$Score = ($A1 + $A2 + $A3 + $A4 + $A5 + $A6 + $A7 + $A8 + $A9 + $A10);

		if($Score > 0)
		{
			$query = "INSERT INTO candidates_answers SET CandidateID = '".(int)$CanID."', PostID = '".(int)$PostID."',  Score = '".$Score."', A1 = '".$A1."', A2 = '".$A2."', A3 = '".$A3."', A4 = '".$A4."', A5 = '".$A5."', A6 = '".$A6."', A7 = '".$A7."', A8 = '".$A8."', A9 = '".$A9."', A10 = '".$A10."', DateAdded = NOW()";
			mysql_query($query) or die(mysql_error());
			
			$_SESSION['Score'] = $Score;
			$_SESSION['Percent'] = 'Candidate Got '.$Score.'%';
			redirect($self);
		}
		else
		{
			$msg = "Please Complete your Interview";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Take Interview</title>
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
      <h1> Take Interview <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Interviews.php"><i class="fa fa-dashboard"></i> Take Interview</a></li>
        <li class="active">Take Interview</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
			  <?php
				$queryTN = "Select PostName FROM jobposts WHERE ID = '".$PostID."'";
				$resultTN = mysql_query($queryTN) or die(mysql_error());
				$numTN = mysql_num_rows($resultTN);
				if($numTN == 1)
				{
					$rowTN = mysql_fetch_array($resultTN);
					echo 'Applyed For '.$rowTN['PostName'].' | Minimum Percentage to Qualify ('.INTERVIEW_PERCENTAGE.'%)';
				}
			  ?>
			  
			  <?php
				if(isset($_SESSION['Percent']) && $_SESSION['Percent'] != '')
				{
					if($_SESSION['Score'] >= INTERVIEW_PERCENTAGE)
					{
						echo '<span style="color:green;">'.$_SESSION['Percent'].'</span>';
					}
					else if($_SESSION['Score'] < INTERVIEW_PERCENTAGE)
					{
						echo '<span style="color:red;">'.$_SESSION['Percent'].'</span>';
					}
						$_SESSION['Score'] = '';
						$_SESSION['Percent'] = '';
					
				}
				?>
			  
			  </h3>
			  <div class="buttons" style="width:30%">
                <button class="btn bg-navy margin" type="button" onClick="location.href='Interviews.php'">Back</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
             <?php
				if(isset($_SESSION['msg']))
				{
					echo '<p style="color:red; font-size:20px;">'.$_SESSION['msg'].'</p>';
					$_SESSION['msg']='';
				}
				echo '<p style="color:red; font-size:20px; text-align:center">'.$msg.'</p>';
			?>
              <?php
                if(isset($_REQUEST['PostID']))
				{
				?>
			
				  <form action="<?php echo $_SERVER['PHP_SELF'];?>?CanID=<?php echo $CanID;?>&PostID=<?php echo $PostID;?>" class="form-horizontal no-margin" method="post" enctype="multipart/form-data">
					 
						<hr>
					 
					     <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">1) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Dress Code</label>
								 <select name="A1" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">2) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Attitude</label>
								 <select name="A2" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">3) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Communication Skills</label>
								 <select name="A3" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">4) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Technical Knowledge</label>
								 <select name="A4" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">5) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Confidence</label>
								 <select name="A5" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">6) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Potential</label>
								 <select name="A6" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">7) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Learning Ability</label>
								 <select name="A7" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">8) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Mental Capacity</label>
								 <select name="A8" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">9) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Analytical Approach</label>
								 <select name="A9" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						  <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;">10) </label>
							<div class="col-sm-5">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8">Willingness to Work</label>
								 <select name="A10" style="width:100px">
								 <option value="0">0</option>
								 <option value="1">1</option>
								 <option value="2">2</option>
								 <option value="3">3</option>
								 <option value="4">4</option>
								 <option value="5">5</option>
								 <option value="6">6</option>
								 <option value="7">7</option>
								 <option value="8">8</option>
								 <option value="9">9</option>
								 <option value="10">10</option>
								 </select>
								 
							</div>
						  </div>
						  
						  <hr>
						  
						<?php
							}
							?>
							
                      <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">
							
							<?php
							if(isset($_REQUEST['PostID']))
							{
							?>

								<button type="submit" class="btn btn-info" >Submit</button>
								<input type="button" onclick="location.href='Interviews.php'" value="Cancel" class="btn btn-info"/>
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
