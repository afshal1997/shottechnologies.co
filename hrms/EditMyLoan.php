<?php
include_once("Common.php");
include("CheckAdminLogin.php");




	$msg="";
	$Code='';
	$LoanType="";
	$DuductionType="";
	$Amount=0;
	$RepaymentAmount=0;
	$DisbursementDate="";
	$Status=0;
	$EmployeeID=0;
	$LoanRequestID=0;
	$RemainingAmount=0;
	$ManualRecovery=0;
	$DateCompleted="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
		if(isset($_POST["Status"]))
			$Status=trim($_POST["Status"]);
		

	if($msg=="")
	{

		
		$query="UPDATE loans SET 
				Status = '".(int)$Status."',
				ApprovedBy = '" . dbinput($_SESSION['UserID']) . "',
				DateModified = NOW() WHERE ID = ".$ID."";
		mysql_query($query) or die (mysql_error());
		//$ID = mysql_insert_id();

		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Loan has been updated.</b>
		</div>';		
		
		redirect("Loans.php");	
	}
		

}
else
{
	$query="SELECT ID,EmpID,Code,Status,LoanReqID,LoanType,DuductionType,Amount,DisbursementDate,RepaymentAmount,RemainingAmount,DateCompleted FROM loans WHERE ID='" .(int)$ID . "'";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Loan ID.</b>
		</div>';
		redirect("Loans.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$Code=dboutput($rows['Code']);
		$EmployeeID=dboutput($rows['EmpID']);
		$LoanType=dboutput($rows['LoanType']);
		$DuductionType=dboutput($rows['DuductionType']);
		$Amount=dboutput($rows['Amount']);
		$RepaymentAmount=dboutput($rows['RepaymentAmount']);
		$DisbursementDate=dboutput($rows['DisbursementDate']);
		$Status=dboutput($rows['Status']);
		$LoanRequestID=dboutput($rows['LoanReqID']);
		$RemainingAmount=dboutput($rows['RemainingAmount']);
		$DateCompleted=dboutput($rows['DateCompleted']);
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Loan</title>
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
      <h1> Edit Loan</h1>
      <ol class="breadcrumb">
        <li><a href="MyLoans.php"><i class="fa fa-dashboard"></i>My Loans</a></li>
        <li class="active">Edit Loan</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button class="btn btn-primary margin" type="button" onClick="location.href='MyLoans.php'">Cancel</button>
            </div>
              <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			
				// $j=1;
				// for($i = 48000 ; $i > 0 ; $i = $i - 10000)
				// {	
					
					// echo $j.' - '.($i >= 10000 ? 10000 : $i).'<br>';
					// $j++;
				// }
				
				// $startdate=strtotime($RepaymentDate);

				   // echo date("M d", $startdate),"<br>";
				   // $startdate = strtotime("+1 month", $startdate);
				   
				   // echo date("M d", $startdate),"<br>";
				   // $startdate = strtotime("+1 month", $startdate);
				   
				   // echo date("M d", $startdate),"<br>";
				   // $startdate = strtotime("+1 month", $startdate);
				
				
				
							

				?>
		<div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" for="EmployeeID" >Employee: </label>
				  <select disabled name="EmployeeID" id="EmployeeID" class="form-control">
					<option value="0" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName FROM employees ORDER BY EmpID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($EmployeeID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].'</option>';
					} 
					?>
					</select>
				</div>
				
				
				<div class="form-group">
				  <label id="labelimp" >Loan Request #: </label>
					<?php
					 $query = "SELECT Code FROM loan_requests Where ID=".$LoanRequestID."";
					$res = mysql_query($query);
					$num=mysql_num_rows($res);
					if($num == 1)
					{
						$row = mysql_fetch_array($res);
						echo '<input type="text" class="form-control" disabled value="'.$row['Code'].'" />';
					}
					else
					{
						echo '<input type="text" class="form-control" disabled value="Manual Loan" />';
					}
					?>
					</select>
				</div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="Status">Status: </label>
				<select disabled name="Status" class="form-control">
				<option <?php echo ($Status == "0" ? 'selected' : ''); ?> value="0">Running</option>
				<option <?php echo ($Status == "2" ? 'selected' : ''); ?> value="2">Stoped</option>
				<option <?php echo ($Status == "1" ? 'selected' : ''); ?> value="1">Completed</option>
				</select>
                </div>
				<?php
				if($Status == 1)
				{
                echo '<input type="hidden" name="Status" value="1" />';
				}
				?>
				
				<input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
                  <label id="labelimp" >Tran #: </label>
                  <?php 
				echo '<input type="text" class="form-control" disabled value="'.$Code.'" />';
				?>
                </div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="LoanType">Loan Type: </label>
				<select disabled name="LoanType" class="form-control">
				<option <?php echo ($LoanType == "Company Loan" ? 'selected' : ''); ?> value="Company Loan">Company Loan</option>
				<option <?php echo ($LoanType == "Car Loan" ? 'selected' : ''); ?> value="Car Loan">Car Loan</option>
				</select>
                </div>
				
				<div class="form-group">
                <label id="labelimp" class="labelimp" for="DuductionType">Duduction Period:</label>
				<select disabled name="DuductionType" class="form-control">
				<option <?php echo ($DuductionType == "Monthly" ? 'selected' : ''); ?> value="Monthly">Monthly</option>
				</select>
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
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
					<label id="labelimp" for="Amount">Loan Amount:</label>
						<input disabled type="number" name="Amount" autocomplete="off" value="<?php echo $Amount; ?>" class="form-control" id="Amount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="RepaymentAmount">Installment Amount:</label>
						<input disabled type="number" name="RepaymentAmount" autocomplete="off" value="<?php echo $RepaymentAmount; ?>" class="form-control" id="RepaymentAmount"/>
				</div><!-- /.form group -->
				
				<div class="form-group">
					<label id="labelimp" for="DisbursementDate">Disbursement Date:</label>
						<input disabled type="date" name="DisbursementDate" autocomplete="off" value="<?php echo $DisbursementDate; ?>" class="form-control" id="DisbursementDate"/>
				</div><!-- /.form group -->
				
				
                <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		
		<div class="col-md-12">
				
					<div class="box box-solid">
					<div class="box-header bg-box-blue">
						<h3 class="box-title">Loan Summary</h3>
					</div>
					<!-- general form elements -->
					<div style="padding:15px;" class="box-primary">
					
					  <!-- form start -->
					  <div class="box-body">
			<div class="row">		   
					<div class="col-md-4">
					  <div class="box">
					  
						<!-- general form elements -->
						<div style="padding:15px;" class="box-primary">
						
						  <!-- form start -->
						  <div class="box-body">
							
							<div class="form-group">
							  <label id="labelimp" >Monthly Deduction: </label>
							  <?php 
							echo '<input type="text" class="form-control" disabled value="'.$RepaymentAmount.'" />';
							?>
							</div>
							
							<div class="form-group">
								<label id="labelimp" for="DateCompleted">Completed Date:</label>
									<input disabled type="date" name="DateCompleted" autocomplete="off" value="<?php echo ($DateCompleted == '0000-00-00' ? '' : $DateCompleted); ?>" class="form-control" id="DateCompleted"/>
							</div><!-- /.form group -->
							
							<input type="hidden" name="action" value="submit_form" />
						  </div>
						  <!-- /.box-body -->
						
						</div>
						<!-- /.box -->
						<!-- Form Element sizes -->
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="box">
					  
						<!-- general form elements -->
						<div style="padding:15px;" class="box-primary">
						
						  <!-- form start -->
						  <div class="box-body">
							
							<div class="form-group">
							  <label id="labelimp" >Recovered: </label>
							  <?php 
							echo '<input type="text" class="form-control" disabled value="'.($Amount - $RemainingAmount).'" />';
							?>
							</div>
							
							<?php
							$query = "SELECT SUM(Amount) AS ManualRecovery FROM loans_manualrecovery where ID <> 0 AND LoanID='" . (int)$ID . "'";
							$res = mysql_query($query) or die(mysql_error());
							$num = mysql_num_rows($res);
							if($num > 0)
							{
								$row = mysql_fetch_array($res);
								$ManualRecovery = $row['ManualRecovery'];
							}
							?>
							
							<div class="form-group">
							  <label id="labelimp" >Recovered Manually: </label>
							  <?php 
							echo '<input type="text" class="form-control" disabled value="'.$ManualRecovery.'" />';
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
					  <div class="box">
					  
						<!-- general form elements -->
						<div style="padding:15px;" class="box-primary">
						
						  <!-- form start -->
						  <div class="box-body">
							
							<div class="form-group">
							  <label id="labelimp" >Installment's Balance: </label>
							  <?php 
								$j=1;
								for($i = $RemainingAmount ; $i > 0 ; $i = $i - $RepaymentAmount)
								{
									// echo $j.' - '.$i.'<br>';
									$j++;
								}
							echo '<input type="text" class="form-control" disabled value="'.($j-1).'" />';
							?>
							</div>
							
							<div class="form-group">
							  <label id="labelimp" >Loan's Balance: </label>
							  <?php 
							echo '<input type="text" class="form-control" disabled value="'.$RemainingAmount.'" />';
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
					</div>
						
						
						<input type="hidden" name="action" value="submit_form" />
					  </div>
					  <!-- /.box-body -->
					
					</div>
					<!-- /.box -->
					<!-- Form Element sizes -->
				  </div>
				
				
				</div>
				
			<div class="col-md-12 no-print">
		  
			  <div class="box box-solid">
			  <div class="box-header bg-box-blue">
					<h3 class="box-title">Loan Manual Recoveries</h3>
				</div>
				<!-- general form elements -->
				<div style="padding:15px;" class="box-primary">
				
				  <!-- form start -->
				  <div class="box-body">
				   
					<table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
					  <th>Date</th>
					  <th>Amount</th>
					  <th>Payment Method</th>
					  <th>Reason</th>
					  <th>Received By</th>
                    </tr>
                  </thead>
				  
                  <tbody>
				
				
                    <?php
					$query = "SELECT e.FirstName,e.LastName,e.EmpID,l.Amount,DATE_FORMAT(l.PaymentDate, '%D %b %Y') AS PaymentDate,l.PaymentType,l.Reason FROM loans_manualrecovery l LEFT JOIN employees e ON l.ApprovedBy = e.ID where l.ID <> 0 AND l.LoanID='" . (int)$ID . "' Order By l.PaymentDate ASC";
					$res = mysql_query($query) or die(mysql_error());
					$num = mysql_num_rows($res);
					
					if($num > 0)
					{
						$count = 0;
						while($row = mysql_fetch_array($res))
						{
						$count++;
							?>
								<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $row['PaymentDate']; ?></td>
								<td><?php echo $row['Amount']; ?></td>
								<td><?php if(dboutput($row["PaymentType"])=='1'){echo 'Cash';} else if(dboutput($row["PaymentType"])=='2'){echo 'Cheque';} else if(dboutput($row["PaymentType"])=='3'){echo 'Adjustment';} else if(dboutput($row["PaymentType"])=='4'){echo 'Bonus';} ?></td>
								<td><?php echo dboutput($row["Reason"]); ?></td>
								<td><?php echo $row['FirstName'].' '.$row['LastName'].'('.$row['EmpID'].')'; ?></td>
								</tr>
							<?php
						}
						
					}
					?>
					
					
					
                  </tbody>
                </table>
				  </div>
				  <!-- /.box-body -->
				
				
				</div>
				<!-- /.box -->
				<!-- Form Element sizes -->
			  </div>
			</div>
			<div class="col-md-12">
		  
			  <div class="box box-solid">
			  <div class="box-header bg-box-blue">
					<h3 class="box-title">Loan Recovery Schedule</h3>
				</div>
				<!-- general form elements -->
				<div style="padding:15px;" class="box-primary">
				
				  <!-- form start -->
				  <div class="box-body">
				   
					<table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
					  <th>Date</th>
					  <th>Amount</th>
					  <th>Status</th>
                    </tr>
                  </thead>
				  
                  <tbody>
				
				
                    <?php
					$query = "SELECT ID,Amount,DATE_FORMAT(RepaymentDate, '%D %b %Y') AS RepaymentDate,Status FROM loans_schedule where ID <> 0 AND LoanID='" . (int)$ID . "'";
					$res = mysql_query($query) or die(mysql_error());
					$num = mysql_num_rows($res);
					
					if($num > 0)
					{
						$count = 0;
						while($row = mysql_fetch_array($res))
						{
						$count++;
							?>
								<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $row['RepaymentDate']; ?></td>
								<td><?php echo $row['Amount']; ?></td>
								<td><?php if(dboutput($row["Status"])=='1'){echo '<mark style="background-color:#0f0">Recovered</mark>';}else if(dboutput($row["Status"])=='0'){echo '<mark style="background-color:#ff0">Running</mark>';}else{echo '<mark style="background-color:#f00">Stoped</mark>';} ?></td>
								</tr>
							<?php
						}
						
					}
					?>
					
					
					
                  </tbody>
                </table>
					
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
</body>
</html>
