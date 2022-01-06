<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$Status=1;
	$TestID = 0;
	$AnswerID = '-1';
	$AnswerIDs ='';
	$AnswerType = '';
	$Question = '';
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST['Status']) && ctype_digit($_POST['Status']) && ($_POST['Status'] == 0 || $_POST['Status'] == 1))
			$Status = $_POST['Status'];
	if(isset($_POST['TestID'])&& ctype_digit($_POST['TestID']))
		$TestID = $_POST['TestID'];
	if(isset($_POST['AnswerID']))
		$AnswerID = $_POST['AnswerID'];
	if(isset($_POST['AnswerType']))
		$AnswerType = $_POST['AnswerType'];
	if(isset($_POST['AnswerIDs'])&& is_array($_POST['AnswerIDs']))
		$AnswerIDs = $_POST['AnswerIDs'];
	if(isset($_POST['Question']))
		$Question = $_POST['Question'];
	if($AnswerType == 'single')
	{
		$AnswerIDs = '';
	}
	else{
		$AnswerID = 0;
	}

	
		if($TestID == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Test Name.</b>
			</div>';
		}
		else if($Question == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Question.</b>
			</div>';
		}
		
	if($AnswerIDs != '')
	{
		$AnswerIDar = implode(',',$AnswerIDs);
	}
	if($msg=="")
	{
			$query="UPDATE questions SET TestID = '".(int)$TestID."', Question = '".dbinput($Question)."', AnswerType='".$AnswerType."', AnswerID = '".($AnswerIDs != '' ? $AnswerIDar : $AnswerID)."',  Status = '".$Status."', DateModified = NOW() WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Question has been Updated.</b>
			</div>';
			
		
			
	}

}
else
{
	$query="SELECT ID, TestID, Question, AnswerType, AnswerID, Status FROM questions WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Question ID.</b>
		</div>';
		redirect("Questions.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$TestID = $rows['TestID'];
		$AnswerType = $rows['AnswerType'];
		$AnswerID = $rows['AnswerID'];
		if($AnswerType == 'multi')
		{
			$AnswerIDs = explode(',',$AnswerID);
		}
		else
		{
			$AnswerID = $rows['AnswerID'];
		}
		$Question = dboutput($rows['Question']);
		$Status = $rows['Status'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Question</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<style>
#footer {
	width:100%;
	height:50px;
	background-color:#3c8dbc;
	text-align:center;
	vertical-align:center;
	padding-top:15px;
}
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script language="javascript">
$(document).ready(function (){
	$("#single").click(function () {
		$("#multians").slideUp(); 
		$("#singleans").slideDown(); 			
	});
	
	$("#multi").click(function(){
		$("#multians").slideDown(); 
		$("#singleans").slideUp(); 		
		
	});
	});
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
      <h1>Edit Question</h1>
      <ol class="breadcrumb">
        <li><a href="Questions.php"><i class="fa fa-dashboard"></i>Questions</a></li>
        <li class="active">Edit Question</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>"" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Questions.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
        <div class="col-md-12">
          <div class="box">
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
              <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label id="labelimp" for="TestID" >Test Name: </label>
				  <select name="TestID" id="TestID" class="form-control">
					<option value="0">Select Test</option>
					<?php
						$query1 = "SELECT ID, TestName FROM tests where Status = 1 ORDER BY ID DESC";
						$data = mysql_query($query1);
						while($row = mysql_fetch_array($data))
						{
							echo '<option '.($TestID == $row['ID'] ? ' selected ' : '').' value="'.$row['ID'].'">'.$row['TestName'].'</option>';
						}
					?>
				  </select>
                </div>
			   
                <div class="form-group">
                  <label id="labelimp" for="Question" >Question: </label>
                  <?php 
				echo '<textarea rows="5" id="Question" name="Question" class="form-control">'.$Question.'</textarea>';
				?>
                </div>
				
				<div class="form-group">
					<label id="labelimp" for="Question" >Answer type: </label>
						<label><input <?php echo ($AnswerType == 'single' ? ' checked ' : '') ?> type="radio" id="single" value="single" name="AnswerType" />Single</label> &nbsp;&nbsp; &nbsp; &nbsp; 
						<label><input <?php echo ($AnswerType == 'multi' ? ' checked ' : '') ?> type="radio" id="multi" value="multi" name="AnswerType" />Multiple</label> 
				</div>
				  <div id="singleans" <?php echo ($AnswerType == 'single' ? '' : 'style="display:none;"' )?> class="form-group">
					<div id="multiques">
						<select name="AnswerID" class="form-control">
							<option value="0">Select Answer</option>
							<?php
								$query1 = "SELECT ID, Answer FROM answers WHERE Status = 1 AND  QuestionID = ".$ID;
								$data = mysql_query($query1) or die(mysql_error());
								while($row = mysql_fetch_array($data))
								{
									echo '<option '.($AnswerID == $row['ID'] ? ' selected ' : '').' value="'.$row['ID'].'">'.$row['Answer'].'</option>';
								}
							?>
						</select>
					</div>
				  </div>
				  <div id="multians" <?php echo ($AnswerType == 'multi' ? '' : 'style="display:none;"' )?>  class="form-group">
					<div id="multiques">
						<?php
							$q = "SELECT ID, Answer FROM answers WHERE Status = 1 AND  QuestionID = ".$ID;
							$d = mysql_query($q) or die(mysql_error());
							while($r = mysql_fetch_array($d))
							{
						?>
							<label>
							<input type="checkbox" 
							<?php 
							if(isset($AnswerIDs) && $AnswerIDs != '')
							{
								echo ($AnswerType == 'multi' ? (in_array($r['ID'],$AnswerIDs) ? ' checked ' : '') : '' );
							}?> 
							value="<?php echo $r['ID'];?>" 
							name="AnswerIDs[]" > 
							<?php echo dboutput($r['Answer']);?>
							</label><br>
						<?php
							}
						?>
					</div>
				  </div>
				
				<div class="form-group">
                  <label id="labelimp" >Status: </label>
                  <label>
                  <input type="radio" name="Status" value="1"<?php echo ($Status == 1 ? ' checked="checked"' : ''); ?>>
                  Enable</label>
                  <label>
                  <input type="radio" name="Status" value="0"<?php echo ($Status == 0 ? ' checked="checked"' : ''); ?>>
                  Disable</label>
                </div>
				
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		
      </section>
    </form>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php include_once("Footer.php"); ?>
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
</body>
</html>
