<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$msg="";
	$Title="";
	$StartDate="";
	$EndDate="";
	$StartTime="";
	$EndTime="";
	$Color="";
	$CandidatesToAttempt="";
	$Candidates=array();
	$Description="";
	$Post=0;
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["Title"]))
		$Title=trim($_POST["Title"]);
	if(isset($_POST["StartDate"]))
		$StartDate=trim($_POST["StartDate"]);
	if(isset($_POST["EndDate"]))
		$EndDate=trim($_POST["EndDate"]);
	if(isset($_POST["StartTime"]))
		$StartTime=trim($_POST["StartTime"]);
	if(isset($_POST["EndTime"]))
		$EndTime=trim($_POST["EndTime"]);
	if(isset($_POST["Color"]))
		$Color=trim($_POST["Color"]);
	if(isset($_POST["Post"]) && ctype_digit($_POST['Post']))
		$Post=trim($_POST["Post"]);
	if(isset($_POST["CandidatesToAttempt"]))
	{
		$CandidatesToAttempt=implode(',', $_POST['CandidatesToAttempt']);
		$Candidates=$_POST['CandidatesToAttempt'];
	}
	if(isset($_POST["Description"]))
		$Description=trim($_POST["Description"]);

		if($Title == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Title.</b>
			</div>';
		}
		else if($Post == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Post.</b>
			</div>';
		}	
		else if($CandidatesToAttempt == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Candidates to Attend this Interview.</b>
			</div>';
		}	
		else if($StartDate == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Start Date.</b>
			</div>';
		}
		else if($EndDate == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select End Date.</b>
			</div>';
		}	
		else if($StartTime == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Start Time.</b>
			</div>';
		}
		else if($EndTime == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select End Time.</b>
			</div>';
		}
		else if($Color == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Color.</b>
			</div>';
		}
		else if($Description == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Description.</b>
			</div>';
		}

		


	if($msg=="")
	{

		$query="INSERT INTO interviews SET 
				Title = '" . dbinput($Title) . "',
				Post = '" . (int)$Post . "',
				Candidates = '" . dbinput($CandidatesToAttempt) . "',
				Description = '" . $Description . "',
				StartDate = '" . dbinput($StartDate) . "',
				EndDate = '" . dbinput($EndDate) . "',
				StartTime = '" . dbinput($StartTime) . "',
				EndTime = '" . dbinput($EndTime) . "',
				Color = '" . dbinput($Color) . "', DateAdded = NOW() ";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Interview has been added.</b>
		</div>';		
		
		redirect("AddNewInterview.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Interview</title>
<style>
    .multiselect {
        width: auto;
    }
    .selectBox {
        position: relative;
    }
    .selectBox select {
        width: 100%;
    }
    .overSelect {
        position: absolute;
        left: 0; right: 0; top: 0; bottom: 0;
    }
	#checkboxes2 {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes2 label {
        display: block;
    }
    #checkboxes2 label:hover {
        background-color: #1e90ff;
    }
	</style>
	<script>
    var expanded = false;
    function showCheckboxes2() {
        var checkboxes = document.getElementById("checkboxes2");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	</script>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<script language="javascript" src="scripts/innovaeditor.js"></script>
<!-- bootstrap 3.0.2 -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Color Picker -->
<link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<!-- Bootstrap time Picker -->
<link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
      <h1> Add Interview</h1>
      <ol class="breadcrumb">
        <li><a href="Interviews.php"><i class="fa fa-dashboard"></i>Interviews</a></li>
        <li class="active">Add Interview</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Interviews.php'">Cancel</button>
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
                  <label id="labelimp" class="labelimp" for="Title">Title: </label>
                  <?php 
				echo '<input type="text" maxlength="200" id="Title" name="Title" class="form-control"  value="'.$Title.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Post" >Apply For Post: </label>
				  <select name="Post" id="Post" class="form-control">
					<option value="0" >Select Post</option>
					<?php
					 $query = "SELECT ID,PostName FROM jobposts where Status = 1";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($Post == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['PostName'].'</option>';
					} 
					?>
					</select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="CandidatesToAttempt" >Candidates: </label>
                 <div class="selectBox" onclick="showCheckboxes2()">
						<select class="form-control">
							<option>Select Candidates to attend this Interview</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes2" style="height:250px; overflow:scroll;">						
						<?php
						 $query = "SELECT c.ID,c.FirstName,c.LastName,jp.PostName FROM candidates c LEFT JOIN jobposts jp ON c.ApplyedFor = jp.ID where c.Status = 'Active' AND c.IsShortlist = 'No' AND c.IsDisqualified = 'No' ORDER BY c.ID,jp.PostName DESC";
						$res = mysql_query($query);
						while($rows = mysql_fetch_array($res))
						{						
						echo '<label><input '.(in_array($rows['ID'], $Candidates) ? "checked = checked" : "").' type="checkbox" name="CandidatesToAttempt[]" value="'.$rows['ID'].'" />&ensp;'.$rows['FirstName'].' '.$rows['LastName'].' | '.$rows['PostName'].'</label>';
						} 
						?>
				  </div>
                </div>
				
				<div class="form-group">
					<label id="labelimp" class="labelimp" for="StartDate">Start Date:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" id="StartDate" name="StartDate" class="form-control"  <?php echo 'value="'.$StartDate.'"'; ?> data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
					</div><!-- /.input group -->
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" class="labelimp" for="EndDate">End Date:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" id="EndDate" name="EndDate" class="form-control"  <?php echo 'value="'.$EndDate.'"'; ?> data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
					</div><!-- /.input group -->
				</div><!-- /.form group -->
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" id="StartTime">Start Time:</label>
						<div class="input-group">
							<input type="text" name="StartTime" id="StartTime" <?php echo 'value="'.$StartTime.'"' ?> class="form-control timepicker" />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
				
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label id="labelimp" for="EndTime">End Time:</label>
						<div class="input-group">
							<input type="text" name="EndTime" id="EndTime" <?php echo 'value="'.$EndTime.'"' ?> class="form-control timepicker"/>
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
				
				 <div class="form-group">
					<label id="labelimp" for="Color">Color:</label>
					<input type="text" name="Color" id="Color" <?php echo 'value="'.$Color.'"' ?> class="form-control my-colorpicker1"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
				  <label id="labelimp">Description or Requirements Details: </label>
					<?php
						$v = '<textarea name="Description" id="Description">';
						if(isset($_POST["Description"]))
							$v .= $_POST["Description"];
						$v .= '</textarea><script>
							var NSD = new InnovaEditor("NSD");
							NSD.width="100%";
							NSD.height=300;
							NSD.btnPrint=true;
							NSD.btnPasteText=true;
							NSD.btnFlash=true;
							NSD.btnForm=false;
							NSD.btnMedia=true;
							NSD.btnLTR=true;
							NSD.btnRTL=true;
							NSD.btnStrikethrough=true;
							NSD.btnSuperscript=true;
							NSD.btnSubscript=true;
							NSD.btnClearAll=true;
							NSD.btnSave=true;
							NSD.btnStyles=true;
							if(navigator.appName == \'Microsoft Internet Explorer\')
								NSD.cmdAssetManager = "modalDialogShow(\'../assetmanager/assetmanager.php\',640,465)";
							else						
								NSD.cmdAssetManager = "modalDialogShow(\'../../assetmanager/assetmanager.php\',640,465)";						
							NSD.css="../css/style.css";
							NSD.mode="XHTMLBody";
							NSD.REPLACE("Description");
							</script>';
							
							echo $v;
							?>
				</div>
				
                <input type="hidden" name="action" value="submit_form" />
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
<!-- jQuery UI 1.10.3 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app2.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/AdminLTE/demo.js" type="text/javascript"></script>

<script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                });
            });
        </script>
</body>
</html>
