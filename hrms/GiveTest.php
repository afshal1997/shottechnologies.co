<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$ID = 0;
	
	$TestID = 0;
	
	$AnswerID = '-1';
	$AnswerIDs = '';
	$AnswerType = '';
	$Question = '';

	$Status = 0;

	$msg = '';
	$Grade = '';
	

	if(isset($_REQUEST['TestID']) && ctype_digit($_REQUEST['TestID']))
		$ID = $_REQUEST['TestID'];
	

	if(isset($_POST['submit_frm']) && $_POST['submit_frm']=='submit_form')
	{
		// print_r($_POST);
		// echo '<br>';
		$i=0;
		$qu1 = "SELECT ID, Question, AnswerType FROM questions WHERE Status = 1 AND TestID = '".$ID."' AND AnswerID <> 0 ";
		$Err = '';
		$da1 = mysql_query($qu1) or die(mysql_error());
		while($ro1 = mysql_fetch_array($da1))
		{
			$var = 'SingleAnswerID-'.$ro1['ID'];
			if(isset($_POST["$var"]) && $_POST["$var"] != '')
			{	
				$QuestionID[$i] = $ro1['ID'];
				$array_of_ans[$i] = $_POST["$var"];
				$i++;
			}
			else{
				$Err .= "yes,";
			}
			
		}
		$err = explode(',',$Err);
		// print_r($array_of_ans);
		// exit();
		$i=0;
		if(!(in_array('yes',$err)))
		{
			$AnswerID = '';
		
			foreach($array_of_ans as $key => $values)
			{
				
				if(is_array($values)==1)
				{
					$AnswerID .= '-';
					$AnswerIDInnarArray = '';
					foreach($values as $inner_key => $inner_values)
					{
						$AnswerIDInnarArray .= ','.$inner_values;
						
					}
					
					$AnswerIDInnarArray = substr($AnswerIDInnarArray, 1);
					
					
					$AnswerID .= $AnswerIDInnarArray;
					// echo ($AnswerID);	
					// echo '<br>';
				}
				else
				{
					$AnswerID .= '-'.$values;
				}
			}
			// echo ($AnswerID);
			$QuestionIDs = implode('-',$QuestionID);
			$AnswerIDs = substr($AnswerID, 1);
			// echo $AnswerIDs;
			$AnsIDs = explode('-', $AnswerIDs);
			// print_r($AnsIDs);
			// exit();
			$Max = count($AnsIDs);
			
			$query = "Select ID, AnswerID FROM questions WHERE TestID = '".$ID."'";
			$data = mysql_query($query) or die(mysql_error());
			$c = 0;
			$ObtMarks = 0;
			while($row = mysql_fetch_array($data))
			{
				// echo 'Exam '.$AnsIDs[$c].'<br>';
				// echo 'Original '.$row['AnswerID'].'<br>';
				if($row['AnswerID'] == $AnsIDs[$c])
				{
					$ObtMarks++;
				}
				$c++;
			}
			// exit();
			
			$Perc = round((($ObtMarks / $Max) * 100),2);
			if($Perc >= PASSING_PERCENTAGE)
			{
				$Grade = 'Passed';
			}
			else{
				$Grade = 'Failed';
			}
			
			$query = "SELECT Attempts from stud_answers WHERE StudentID = '".(int)$_SESSION['UserID']."' AND TestID = '".(int)$ID."'";
			$resAttempts = mysql_query($query) or die(mysql_error());
			$numAttempts = mysql_num_rows($resAttempts);
			
			if($numAttempts == 0)
			{
				$query = "INSERT INTO stud_answers SET Attempts = 1, StudentID = '".(int)$_SESSION['UserID']."', TestID = '".(int)$ID."',  Maxmarks = '".$Max."', ObtMarks = '".$ObtMarks."', Grade = '".$Grade."', DateAdded = NOW()";
				mysql_query($query) or die(mysql_error());
			}
			else
			{
				$query = "UPDATE stud_answers SET Attempts = Attempts + 1, Maxmarks = '".$Max."', ObtMarks = '".$ObtMarks."', Grade = '".$Grade."', DateAdded = NOW() WHERE StudentID = '".(int)$_SESSION['UserID']."' AND TestID = '".(int)$ID."'";
				mysql_query($query) or die(mysql_error());
			}
			
			
			$_SESSION['Grade'] = $Grade;
			$_SESSION['Percent'] = $Grade.' | You Got '.$Perc.'%';
			redirect($self);
			
		}
		else
		{
			$msg = "Please Complete your Exam";
		}
	}
	
	$sql = "SELECT ID, Question, AnswerType FROM questions WHERE Status = 1 AND TestID = '".$ID."' AND AnswerID != 0 ";
	$data = mysql_query($sql) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Give Test</title>
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
			alert("Please select Training to delete");
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
      <h1> Give Test <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="MyTrainings.php"><i class="fa fa-dashboard"></i> My Trainings</a></li>
        <li class="active">Give Test</li>
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
				$queryTN = "Select TestName FROM tests WHERE ID = '".$ID."'";
				$resultTN = mysql_query($queryTN) or die(mysql_error());
				$numTN = mysql_num_rows($resultTN);
				if($numTN == 1)
				{
					$rowTN = mysql_fetch_array($resultTN);
					echo $rowTN['TestName'].' | Minimum Passing Percentage ('.PASSING_PERCENTAGE.'%)';
				}
				
				if(isset($_SESSION['Percent']) && $_SESSION['Percent'] != '')
				{
					if($_SESSION['Grade'] == "Passed")
					{
						echo '<span style="color:green;">'.$_SESSION['Percent'].'</span>';
					}
					else if($_SESSION['Grade'] == "Failed")
					{
						echo '<span style="color:red;">'.$_SESSION['Percent'].'</span>';
					}
						$_SESSION['Percent'] = '';
						$_SESSION['Grade'] = '';
					
				}
			  ?>
			  
			  </h3>
			  <div class="buttons" style="width:50%">
                <button class="btn bg-navy margin" type="button" onClick="location.href='MyTrainings.php'">Back</button>
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
              
                
			
				  <form action="<?php echo $_SERVER['PHP_SELF'];?>?TestID=<?php echo $ID;?>" class="form-horizontal no-margin" method="post" enctype="multipart/form-data">
						<hr>
					  <?php
					  $i = 1;
					  while($row = mysql_fetch_array($data))
					  {
					  ?>
					     <div class="form-group">
						   <label for="userName" class="col-sm-2 control-label" style="font-weight:bold; font-size:16px;"><?php echo $i.') '; ?></label>
							<div class="col-sm-10">
								 <label for="userName" style="font-size:14px; padding-top:7px;" class="col-sm-8"><?php echo $row['Question']; ?></label>
							</div>
						  </div>
						  <div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10" id="singleans" <?php echo ($row['AnswerType'] == 'single' ? '' : 'style="display:none"') ?>>
								 <?php
									$qu = "SELECT ID, Answer FROM answers WHERE Status = 1 AND  QuestionID = '".$row['ID']."'";
									$da = mysql_query($qu) or die(mysql_error());
									while($ro = mysql_fetch_array($da))
									{
								?>
										 &nbsp;&nbsp;&nbsp;&nbsp;<label>
	<input type="radio" 
	value="<?php echo $ro['ID'];?>" 
	<?php echo (isset($_POST['SingleAnswerID-'.$row['ID']]) &&  $_POST['SingleAnswerID-'.$row['ID']]== $ro['ID'] ? 'checked' : '')?> 
	name="SingleAnswerID-<?php echo $row['ID'];?>" > 

	<?php echo dboutput($ro['Answer']);?>
	<!---<?php echo $row['ID'];?>-<?php echo $_POST['SingleAnswerID-'.$row['ID']];?>-<?php echo $ro['ID'];?>-->

	</label><br>
									<?php
									}
									?>
							</div>
							
							<div class="col-sm-10" id="multians" <?php echo ($row['AnswerType'] == 'multi' ? '' : 'style="display:none"') ?>>
							
								 <?php
									$qu = "SELECT ID, Answer FROM answers WHERE Status = 1 AND  QuestionID = '".$row['ID']."'";
									$da = mysql_query($qu) or die(mysql_error());
									while($ro = mysql_fetch_array($da))
									{
								?>
										 &nbsp;&nbsp;&nbsp;&nbsp;<label>
	<input type="checkbox" 
	value="<?php echo $ro['ID'];?>" 
	 
	<?php echo (isset($_POST['SingleAnswerID-'.$row['ID']]) && in_array($ro['ID'],$_POST['SingleAnswerID-'.$row['ID']]) ? 'checked' : '')?> 

	name="SingleAnswerID-<?php echo $row['ID'];?>[]" > 

	<?php echo dboutput($ro['Answer']);?>

	<!-- - <?php echo $ro['ID'];?> - <?php print_r($_POST['SingleAnswerID-'.$row['ID']]);?>-->


	</label><br>
									<?php
									}
									?>
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
							if(isset($_REQUEST['TestID']))
							{
							?>

								<button type="submit" class="btn btn-info" >Submit</button>
								<input type="button" onclick="location.href='MyTrainings.php'" value="Cancel" class="btn btn-info"/>
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
