<?php
include_once("Common.php");
include("CheckAdminLogin.php");

	
	

	$msg="";
	$Type="";
	$EmployeeID=0;
	$Reason="";
	$num_of_days=0;
	$num_of_available_days=0;
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["EmployeeID"]))
		$EmployeeID=trim($_POST["EmployeeID"]);
	if(isset($_POST["Type"]))
		$Type=trim($_POST["Type"]);
	if(isset($_POST["NumOfDays"]) && $_POST["NumOfDays"] != 0)
	{
		$num_of_days=trim($_POST["NumOfDays"]);
	
		if($Type == "AnualLeaves")
		{
			$query="SELECT AnualLeaves FROM current_leaves_quota WHERE EmpID = ".$EmployeeID."";
			$res = mysql_query($query) or die (mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$r = mysql_fetch_array($res);
				$num_of_available_days = $r['AnualLeaves'];
				
			}
		}
		else if($Type == "CasualLeaves")
		{
			$query="SELECT CasualLeaves FROM current_leaves_quota WHERE EmpID = ".$EmployeeID."";
			$res = mysql_query($query) or die (mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$r = mysql_fetch_array($res);
				$num_of_available_days = $r['CasualLeaves'];
				
			}
		}
	}
	if(isset($_POST["Reason"]))
		$Reason=trim($_POST["Reason"]);

		if($EmployeeID == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please Select Employee.</b>
			</div>';
		}
		else if($num_of_days == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please Enter Number Of Days.</b>
			</div>';
		}
		else if($num_of_available_days < $num_of_days)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Employee dont have enough leaves to proceed this request.</b>
			</div>';
		}
		else if($Reason == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<b>Please type reason.</b>
			</div>';
		}
		

	if($msg=="")
	{

		$query="INSERT INTO writeoff_leaves_quota SET LeaveDate = NOW(),
				LeaveType = '" . dbinput($Type) . "',
				NumOfDays = '" . (int)$num_of_days . "',
				EmpID = '" . $EmployeeID . "',
				Reason = '" . dbinput($Reason) . "',
				PerformedBy = '".$_SESSION['UserID']."'";
				
		mysql_query($query) or die (mysql_error());
		
		mysql_query("UPDATE current_leaves_quota SET ".$Type." = (".$Type." - ".(int)$num_of_days.") WHERE EmpID = ".$EmployeeID."") or die (mysql_error());
		
		// echo $query;
		// $ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Writeoff Leave request has been proceed.</b>
		</div>';		
		
		redirect("AddWriteoffLeave.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Writeoff Leave</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 	
		
		$("#EmployeeID").change(function () {
				if($(this).val() == 0)
				{
					$("#Quota").slideUp();
				}
				else
				{
					$.ajax({			
							url: 'get_employee_quota.php?ID='+$("#EmployeeID").val(),
							success: function(data) {
								$("#QuotaData").html(data);
								$("#Quota").slideDown(2000); 
							},
							error: function (xhr, textStatus, errorThrown) {
								alert(xhr.responseText);
								$("#QuotaData").removeAttr("disabled");
							}
					});
				}

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
      <h1> Add Writeoff Leave</h1>
      <ol class="breadcrumb">
        <li><a href="WriteoffLeaves.php"><i class="fa fa-dashboard"></i>Writeoff Leaves</a></li>
        <li class="active">Add Writeoff Leave</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='WriteoffLeaves.php'">Cancel</button>
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
		<div class="row" id="Quota">
		<div id="QuotaData" disabled>
		
		</div>
		</div>
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
				  <label id="labelimp" for="EmployeeID" >Employee:<span class="requiredStar">*</span> </label>
				  <select autofocus name="EmployeeID" id="EmployeeID" class="form-control">
					<option value="0" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName FROM employees WHERE Status = 'Active' ORDER BY EmpID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($EmployeeID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].'</option>';
					} 
					?>
					</select>
				</div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="Type">Leave Type: </label>
				<select name="Type" class="form-control">
				<option <?php echo ($Type == "AnualLeaves" ? 'selected' : ''); ?> value="AnualLeaves">Annual Leaves</option>
				<option <?php echo ($Type == "CasualLeaves" ? 'selected' : ''); ?> value="CasualLeaves">Casual Leaves</option>
				</select>
				
                </div>
				
				<div class="form-group">
					<label id="labelimp" for="NumOfDays">Number Of Days:<span class="requiredStar">*</span></label>
						<input type="number" name="NumOfDays" value="<?php echo $num_of_days; ?>" class="form-control" id="NumOfDays"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Reason">Reason:<span class="requiredStar">*</span> </label>
                  <?php 
					echo '<textarea rows="10" maxlength="500" id="Reason" name="Reason" class="form-control">'.$Reason.'</textarea>';
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
<script>
	$(function(){
	var sidebar = $('.sidebar-menu');  // cache sidebar to a variable for performance

	sidebar.delegate('.treeview','click',function(){ 
	  if($(this).hasClass('active')){
		$(this).removeClass('active');
		sidebar.find('.inactive > .treeview-menu').hide(200);
		sidebar.find('.inactive').removeClass('inactive');
	   $(this).addClass('inactive');
	   $(this).find('.treeview-menu').show(200);
	 }else{
	  sidebar.find('.active').addClass('inactive');          
	  sidebar.find('.active').removeClass('active'); 
	   $(this).Class('treeview-menu').hide(200);
	 }
	});

	});
	
	$(document).click(function (event) {   
    $('.treeview-menu:visible').hide();
	});

	</script>
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
                $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});
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
	<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#EmployeeID').select2();
</script>
</body>
</html>
