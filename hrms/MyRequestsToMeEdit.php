<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$msg="";
	$Title="";
	$RequestType="";
	$Description="";
	$AssignedTo="";
	$AssignedBy="";
	$AddedBy="";
	$RequestStatus="";
	$Employees=array();
    $getAssignedTo = "";
    
$myID = $_GET['ID'];
$query="SELECT * from request_desks where ID = '$myID'";
$res = mysql_query($query) or die (mysql_error());
while($row = mysql_fetch_array($res)){
    $getTitle = $row['Title'];
    $getRequestType = $row['RequestType'];
    $getDescription = $row['Description'];
	$getAssignedTo = $row["AssignedTo"];
	$getAssignedBy = $row["AssignedBy"];
	$getRequestStatus= $row["RequestStatus"];
	$getAddedBy = $row['AddedBy'];
}

if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{		

	if(isset($_POST["Title"]))
		$Title=trim($_POST["Title"]);
	if(isset($_POST["RequestType"]))
		$RequestType=$_POST["RequestType"];
	if(isset($_POST["Description"]))
		$Description=trim($_POST["Description"]);
	if(isset($_POST["AddedBy"]))
		$AddedBy=trim($_POST["AddedBy"]);
	if(isset($_POST["AssignedTo"]))
		$AssignedTo=$_POST["AssignedTo"];
	if(isset($_POST["AssignedBy"]))
		$AssignedBy=trim($_POST["AssignedBy"]);
	if(isset($_POST["RequestStatus"]))
	{
		$RequestStatus=trim($_POST["RequestStatus"]);
	}

		if($RequestType == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select RequestType to Attempt Test.</b>
			</div>';
		}
		else if($AssignedTo == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Assign Some Department.</b>
			</div>';
		}	
		else if($Description == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Start Date.</b>
			</div>';
		}

		


	if($msg=="")
	{
	   $myID = $_POST['idss'];
        //$myID = 1;
	    $USERID = $_SESSION["UserID"];
        // $query = "UPDATE request_desks SET Title = ".'$Title'.", RequestType = ".'$RequestType'.", Description = " .'$Description'.", AssignedTo = ".'$AssignedTo'.", AddedBy = ".'$USERID'." 
        // where ID = ".$myID;

			$query="UPDATE request_desks SET 
			RequestType = '" . dbinput($RequestType) . "',
			Description = '" . dbinput($Description) . "',
			AssignedTo = '" . dbinput($AssignedTo) . "',
			RequestStatus = '" . dbinput($RequestStatus) . "',
			AddedBy = '" . dbinput($AddedBy) . "'
			WHERE ID='".(int)$myID."'";

		mysql_query($query) or die (mysql_error());
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Request has been launched.</b>
		</div>';		
		
		redirect("MyRequestsToMe.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Request</title>
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
      <h1> Update Request</h1>
      <ol class="breadcrumb">
        <li><a href="MyRequestsToMe.php"><i class="fa fa-dashboard"></i>Requests</a></li>
        <li class="active">Update Request</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='MyRequestsToMe.php'">Cancel</button>
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
				echo '<input type="text" maxlength="200" id="Title" class="form-control"  value="'.$getTitle.'" disabled/>';
				?>
                </div>
				
				<div class="form-group" style="display:none;">
                  <label id="labelimp">Request Type: </label>
					<input type="hidden" name="RequestType"  class="form-control" value="<?php echo $getRequestType; ?>">
                </div>
                
                <div class="form-group">
                  <label id="labelimp" >Request Status</label>
						<select class="form-control" name="RequestStatus">
							<option value="Pending" <?php echo ($getRequestStatus == 'Pending') ? 'selected' : ''; ?>>Pending</option>
							<option value="Resolved" <?php echo ($getRequestStatus == 'Resolved') ? 'selected' : ''; ?>>Resolved</option>
						</select>
                </div>
                
                
                <div class="form-group" style="display:none;">
                    
                  <label id="labelimp"  >Assign To: </label>
                 <div class="selectBox" onclick="showCheckboxes2()">
						<select class="form-control">
							<option value="">Select Employees</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes2" style="height:250px; overflow:scroll;">						
						<?php
						 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active'";
						$res = mysql_query($query);
						while($row = mysql_fetch_array($res))
						{						
						echo '<label><input '.(($row['EmpID'] == $getAssignedTo) ? "checked = checked" : "").' type="radio" name="AssignedTo" value="'.$row['EmpID'].'"/>&ensp;'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</label>';
						} 
						?>
				  </div>
                </div>
                
                
				<div class="form-group" style="display:none;">
                  <label id="labelimp" class="labelimp" for="Query">Query: </label>
                  <?php 
				    echo '<textarea style="display:none;" id="Description" name="Description" class="form-control" value="'.$getDescription.'" >' . $getDescription . '</textarea>';
				    ?>
                </div>
                <input type="hidden" name="idss" value="<?php echo $myID; ?>">
				<input type="hidden" name="AddedBy" value="<?php echo $getAddedBy; ?>">
				<input type="hidden" name="AssignedBy" value="<?php echo $_SESSION['EmpID']; ?>">
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