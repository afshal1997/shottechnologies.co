<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$EncashmentID = 0;

	$BasicSalary = 0;
	
	$EncashmentAllowances = 0;
	$OtherDeductions = 0;
	
	$BankorCash = "";
	$AccountNum = "";
	
	$MonthEncashment="";
	$EncashmentDate=date("Y-m-d");
	
	$BonusAmount = 0;
	$BonusAdjustAmount=0;
	$LoanBalance = 0;

	$JoiningDate = "";

	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$CompanyID="";
	$CompID=array();
	$Heading="";
	$Remarks="";
	
	$e="";
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{		
	
	if(isset($_POST["EncashmentDate"]))
	{
		$EncashmentDate=trim($_POST["EncashmentDate"]);
		$e=strtotime($EncashmentDate);		
		$MonthEncashment=date("M Y", $e);
	}
	if(isset($_POST["Heading"]))
		$Heading=trim($_POST["Heading"]);
	if(isset($_POST["Remarks"]))
		$Remarks=trim($_POST["Remarks"]);
	if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}
	
	
	if($CompanyID == "")
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please Select Company.</b>
		</div>';
	}
	
	
	if($msg=="")
	{
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("START TRANSACTION");
		
		$query="INSERT INTO encashment SET DateAdded=NOW(),
				MonthEncashment = '" . dbinput($MonthEncashment) . "',
				EncashmentDate = '" . dbinput($EncashmentDate) . "',
				Heading = '" . dbinput($Heading) . "',
				Remarks = '" . dbinput($Remarks) . "',
				CompanyID = '" . dbinput($CompanyID) . "',
				PerformedBy = '" . $_SESSION["UserID"] . "'";
		mysql_query($query) or die (mysql_error());
		$EncashmentID = mysql_insert_id();
		
		foreach($CompID as $compid) 
		{
			
			$query = "SELECT * FROM companies where ID <> 0 AND Status = 1 AND ID = ".$compid."";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				$query3 = "SELECT e.ID,e.Salary,e.ResignationAccepted,e.Bank,e.AccountNumber,e.JoiningDate,c.AnualLeaves FROM employees e LEFT JOIN current_leaves_quota_encashment c ON e.ID = c.EmpID where e.ID <> 0 AND e.Status = 'Active' AND e.ResignationAccepted = 'No' AND e.CompanyID = ".$compid." ORDER BY e.ID ASC";
				$res3 = mysql_query($query3) or die(mysql_error());
				$num3 = mysql_num_rows($res3);
				if($num3 > 0)
				{
					while($row3 = mysql_fetch_array($res3))
					{						

							$num_of_days = $row3['AnualLeaves'];
							
							
							if($row3['Bank'] != "")
							{
								$BankorCash = 'Bank';
							}
							else
							{
								$BankorCash = 'Cash';
							}
							
							$AccountNum = $row3['AccountNumber'];
						
							$query = "SELECT Amount AS BasicSalary FROM basicsalary where ID <> 0 AND EmpID = ".$row3["ID"]." AND Approved = 1";
							$res = mysql_query($query) or die(mysql_error());
							$num_basic = mysql_num_rows($res);
							if($num_basic == 1)
							{
							$row1 = mysql_fetch_array($res);
							$BasicSalary = $row1['BasicSalary'];
							}
							
							
							$query = "SELECT Title,Type,Amount,Percentage FROM allowances where ID <> 0 AND Approved = 1 AND EmpID = ".$row3["ID"]." AND Title = 'Annual Bonus Fix Allowance'";
								
							$res = mysql_query($query) or die(mysql_error());
							$num_withouttax_allowance = mysql_num_rows($res);
							if($num_withouttax_allowance > 0)
							{
								$row7 = mysql_fetch_array($res);
								$Type = $row7['Type'];
								if($Type == "FixedAmount")
								{
									$EncashmentAllowances += $row7['Amount'];
								}
								else if($Type == "Percentage")
								{
									$EncashmentAllowances += ($row7['Percentage'] / 100) * $BasicSalary;
								}
							}
							
							$BonusAmount = (($row3["Salary"] / 30) * $num_of_days);
							
							$BonusAmount = round($BonusAmount); //extra line
							
							$BonusAdjustAmount = (($BonusAmount / 100) * $row['LoanDeductionPercent']);
							
							$BonusAdjustAmount = round($BonusAdjustAmount); //extra line

							$query4="SELECT SUM(RemainingAmount) AS LoanBalance FROM loans WHERE ID <>0 AND EmpID='" . (int)$row3['ID'] . "' AND Status = 0";
							$res4 = mysql_query($query4) or die(mysql_error());
							$num4 = mysql_num_rows($res4);
							if($num4 > 0)
							{
								$row4 = mysql_fetch_array($res4);
								$LoanBalance = $row4['LoanBalance'];
							}
							
							$LoanBalance = round($LoanBalance); // extra line
							
							if($LoanBalance == 0)
							{
								$OtherDeductions = 0;
							}
							else if($LoanBalance >= $BonusAdjustAmount)
							{
								$OtherDeductions = $BonusAdjustAmount;
							}
							else if($LoanBalance <= $BonusAdjustAmount)
							{
								$OtherDeductions = $LoanBalance;
							}

							
							$query="INSERT INTO encashmentdetails SET 
							EncashmentID = '" . (int)$EncashmentID . "',
							EmpID = '" . (int)$row3["ID"] . "',
							Basic = '" . dbinput($BasicSalary) . "',
							Gross = '" . dbinput($row3["Salary"]) . "',
							TotalDays = '" . (int)$num_of_days . "',
							JoiningDate = '" . dbinput($row3["JoiningDate"]) . "',
							OtherAllowances = '" . $EncashmentAllowances . "',
							OtherDeductions = '" . $OtherDeductions . "',
							LoanBalance = '" . $LoanBalance . "',
							BonusAmount = '" . $BonusAmount . "',
							BankorCash = '" . dbinput($BankorCash) . "',
							AccountNum = '" . dbinput($AccountNum) . "',
							NetPay = '" . ($BonusAmount - $OtherDeductions) . "',
							PerformedBy='".$_SESSION['UserID'] . "',
							DateModified=NOW(),
							Remarks = ''";
							mysql_query($query) or die (mysql_error());
							
							
								$BasicSalary = 0;
								$EncashmentAllowances = 0;
								$BankorCash = "";
								$AccountNum = "";
								$num_of_days=0;
								$EncashmentAdjustAmount = 0;
								
								$OtherDeductions = 0;
								$BonusAmount = 0;
								$BonusAdjustAmount=0;
								$LoanBalance = 0;
					}
				}
			}			
		}
		
		mysql_query("COMMIT");
			
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Encashment has been Generated.</b>
		</div>';
		
		redirect("AddNewLeaveEncashment.php");
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Leave Encashment</title>
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
    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }
    #checkboxes label {
        display: block;
    }
    #checkboxes label:hover {
        background-color: #1e90ff;
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
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	</script>
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
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />

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
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
      <h1>Add Leave Encashment</h1>
      <ol class="breadcrumb">
        <li><a href="LeaveEncashments.php"><i class="fa fa-dashboard"></i>Leave Encashments</a></li>
        <li class="active">Add Leave Encashment</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Generate</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='LeaveEncashments.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>

        <div class="col-md-4">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Encashment Date</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="EncashmentDate">Encashment Date:</label>
				  <input autofocus type="date" name="EncashmentDate" value="<?php echo $EncashmentDate; ?>" class="form-control" />
				</div>
				

			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
         </div>
		 
		 <div class="col-md-4">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Encashment Remarks</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Heading">Heading:</label>
				  <?php 
				echo '<input type="text" maxlength="500" id="Heading" name="Heading" class="form-control" value="'.$Heading.'">';
				?>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Remarks">Remarks:</label>
				  <?php 
				echo '<textarea rows="2" maxlength="500" id="Remarks" name="Remarks" class="form-control">'.$Remarks.'</textarea>';
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
		 
		 <div class="col-md-4">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">Encashment Applicable</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
                  <label id="labelimp" for="CompanyID" >Company:<span class="requiredStar">*</span></label>
                 <div class="selectBox" onclick="showCheckboxes()">
						<select class="form-control">
							<option>Select Company</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes" style="height:250px; overflow:scroll;">						
						<?php
						$query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
						$res = mysql_query($query);
						while($row = mysql_fetch_array($res))
						{
						echo '<label><input '.(in_array($row['ID'], $CompID) ? "checked = checked" : "").' type="checkbox" name="CompanyID[]" value="'.$row['ID'].'"/> '.$row['Name'].'</label>';
						}
						?>
				  </div>
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