<?php
include_once("Common.php");
include("CheckAdminLogin.php");




	$OpeningLeave=0;
	$GrantLeave=0;
	$UtilizeLeave=0;
	$WriteOffLeave=0;
	$BalanceLeave=0;
	$AfterBalance=0;
	
	$msg="";
	$PayID = 0;
	
	$TotalLateEarlies = 0;
	$TotalLateEarliesDedDays = 0;
	$TotalLateDedDays = 0;
	$TotalEarliesDedDays = 0;
	
	$BasicSalary = 0;
	$AllowanceBreakup = 0;
	
	$Allowance_WithoutTax = 0;
	$Inc_Adjustments = 0;
	$OtherAllowances = 0;
	$AttAllowance = 0;
	
	$FixDeductions = 0;
	$Dec_Adjustments = 0;
	$OtherDeductions = 0;
	
	$IncomeTax = 0;
	
	$TotalDays = 0;
	$TotalPresent = 0;
	$TotalAbsent = 0;
	$TotalOffDays = 0;
	$TotalLeaves = 0;
	$TotalHalfdays = 0;
	$TotalLates = 0;
	$TotalEarlyDepart = 0;
	$TotalHours = 0;
	$TotalMinutes = 0;
	$TotalWorkingHours = 0;
	$TotalWorkingMinutes = 0;
	$TotalOvertimeHoursW = 0;
	$TotalOvertimeMinutesW = 0;
	$OvertimeAmountW = 0;
	$TotalOvertimeHoursL = 0;
	$TotalOvertimeMinutesL = 0;
	$OvertimeAmountL = 0;
	
	$OvertimeHolidayDays = 0;
	
	$PayFullSalary = "";
	$StopSalary = "";
	$Resignation = "";
	$BankorCash = "";
	$AccountNum = "";
	
	$EmployeeContribution = 0;
	$EmployerContribution = 0;
	
	
	$e="";
	$f=array();
	$MonthPayroll="";
	$ToDate=date("Y-m-25");
	$d=strtotime("-1 Months");		
	$FromDate=date("Y-m-26", $d);
	
	
	$Dates="";
	$DatesSplit=array();
	$num_of_days=0;
	$Remarks="";
	$SpecialRemarks="";
	$PayrollMonth="";
	
	$EmployeeID=0;
	$compid=0;
	
	$PreviousSalary=0;
	$RemainingLoan=0;
	$NetPay=0;
	
	$Title1="";
	$Title1check=0;
	$Title1amount=0;
	$Title2="";
	$Title2check=0;
	$Title2amount=0;
	$Title3="";
	$Title3check=0;
	$Title3amount=0;
	$Title4="";
	$Title4check=0;
	$Title4amount=0;
	$Title5="";
	$Title5check=0;
	$Title5amount=0;
	$Title6="";
	$Title6check=0;
	$Title6amount=0;
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);

	if(isset($_POST["Remarks"]))
		$Remarks=trim($_POST["Remarks"]);
	if(isset($_POST["SpecialRemarks"]))
		$SpecialRemarks=trim($_POST["SpecialRemarks"]);
	
	if(isset($_POST["NetPay"]))
		$NetPay=trim($_POST["NetPay"]);
	if(isset($_POST["RemainingLoan"]))
		$RemainingLoan=trim($_POST["RemainingLoan"]);
	if(isset($_POST["PreviousSalary"]))
		$PreviousSalary=trim($_POST["PreviousSalary"]);
	
	if(isset($_POST["Title1"]))
		$Title1=trim($_POST["Title1"]);
	if(isset($_POST["Title1amount"]))
		$Title1amount=trim($_POST["Title1amount"]);
	if(isset($_POST["Title1check"]))
		$Title1check=trim($_POST["Title1check"]);
	if(isset($_POST["Title2"]))
		$Title2=trim($_POST["Title2"]);
	if(isset($_POST["Title2amount"]))
		$Title2amount=trim($_POST["Title2amount"]);
	if(isset($_POST["Title2check"]))
		$Title2check=trim($_POST["Title2check"]);
	if(isset($_POST["Title3"]))
		$Title3=trim($_POST["Title3"]);
	if(isset($_POST["Title3amount"]))
		$Title3amount=trim($_POST["Title3amount"]);
	if(isset($_POST["Title3check"]))
		$Title3check=trim($_POST["Title3check"]);
	if(isset($_POST["Title4"]))
		$Title4=trim($_POST["Title4"]);
	if(isset($_POST["Title4amount"]))
		$Title4amount=trim($_POST["Title4amount"]);
	if(isset($_POST["Title4check"]))
		$Title4check=trim($_POST["Title4check"]);
	if(isset($_POST["Title5"]))
		$Title5=trim($_POST["Title5"]);
	if(isset($_POST["Title5amount"]))
		$Title5amount=trim($_POST["Title5amount"]);
	if(isset($_POST["Title5check"]))
		$Title5check=trim($_POST["Title5check"]);
	if(isset($_POST["Title6"]))
		$Title6=trim($_POST["Title6"]);
	if(isset($_POST["Title6amount"]))
		$Title6amount=trim($_POST["Title6amount"]);
	if(isset($_POST["Title6check"]))
		$Title6check=trim($_POST["Title6check"]);
		

	if($msg=="")
	{

		
		$query="Update fullnfinal SET NetPay = ".$NetPay.",PreviousSalary = ".$PreviousSalary.",RemainingLoan = ".$RemainingLoan." Where ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
			
			
			$ExtraAmount = 0;
			$ExtraAmount += $PreviousSalary;
			$ExtraAmount -= $RemainingLoan;
			
			if($Title1check > 0)
			{
				if($Title1check == 1)
				{
					$ExtraAmount += $Title1amount;
				}
				else if($Title1check == 2)
				{
					$ExtraAmount -= $Title1amount;
				}
			}
			
			if($Title2check > 0)
			{
				if($Title2check == 1)
				{
					$ExtraAmount += $Title2amount;
				}
				else if($Title2check == 2)
				{
					$ExtraAmount -= $Title2amount;
				}
			}
			
			if($Title3check > 0)
			{
				if($Title3check == 1)
				{
					$ExtraAmount += $Title3amount;
				}
				else if($Title3check == 2)
				{
					$ExtraAmount -= $Title3amount;
				}
			}
			
			if($Title4check > 0)
			{
				if($Title4check == 1)
				{
					$ExtraAmount += $Title4amount;
				}
				else if($Title4check == 2)
				{
					$ExtraAmount -= $Title4amount;
				}
			}
			
			if($Title5check > 0)
			{
				if($Title5check == 1)
				{
					$ExtraAmount += $Title5amount;
				}
				else if($Title5check == 2)
				{
					$ExtraAmount -= $Title5amount;
				}
			}
			
			if($Title6check > 0)
			{
				if($Title6check == 1)
				{
					$ExtraAmount += $Title6amount;
				}
				else if($Title6check == 2)
				{
					$ExtraAmount -= $Title6amount;
				}
			}
			
			$ExtraAmount = round($ExtraAmount);
			
			$query="Update fullnfinal SET GrandNetPay = ROUND(NetPay + ".$ExtraAmount.") Where ID = ".$ID."";
			mysql_query($query) or die (mysql_error());
		//$ID = mysql_insert_id();

		
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Full n Final has been updated.</b>
		</div>';		
		
		redirect("FullnFinal.php");	
	}
		

}
else
{
	$query="SELECT ID,EmpID,Remarks,SpecialRemarks,FromDate,ToDate,NumOfDays,NetPay,RemainingLoan,PreviousSalary,Title1,Title1amount,Title1check,Title2,Title2amount,Title2check,Title3,Title3amount,Title3check,Title4,Title4amount,Title4check,Title5,Title5amount,Title5check,Title6,Title6amount,Title6check FROM fullnfinal WHERE ID='" .(int)$ID . "'";
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Full n Final ID.</b>
		</div>';
		redirect("FullnFinal.php");
	}
	else
	{
		$rows = mysql_fetch_assoc($result);
		$EmployeeID=dboutput($rows['EmpID']);
		$Remarks=dboutput($rows['Remarks']);
		$SpecialRemarks=dboutput($rows['SpecialRemarks']);
		$FromDate=dboutput($rows['FromDate']);
		$ToDate=dboutput($rows['ToDate']);
		$NumOfDays=dboutput($rows['NumOfDays']);
		$NetPay=dboutput($rows['NetPay']);
		$PreviousSalary=dboutput($rows['PreviousSalary']);
		$RemainingLoan=dboutput($rows['RemainingLoan']);
		$Title1=dboutput($rows['Title1']);
		$Title1amount=dboutput($rows['Title1amount']);
		$Title1check=dboutput($rows['Title1check']);
		$Title2=dboutput($rows['Title2']);
		$Title2amount=dboutput($rows['Title2amount']);
		$Title2check=dboutput($rows['Title2check']);
		$Title3=dboutput($rows['Title3']);
		$Title3amount=dboutput($rows['Title3amount']);
		$Title3check=dboutput($rows['Title3check']);
		$Title4=dboutput($rows['Title4']);
		$Title4amount=dboutput($rows['Title4amount']);
		$Title4check=dboutput($rows['Title4check']);
		$Title5=dboutput($rows['Title5']);
		$Title5amount=dboutput($rows['Title5amount']);
		$Title5check=dboutput($rows['Title5check']);
		$Title6=dboutput($rows['Title6']);
		$Title6amount=dboutput($rows['Title6amount']);
		$Title6check=dboutput($rows['Title6check']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit FullnFinal</title>
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
      <h1> Edit Full n Final</h1>
      <ol class="breadcrumb">
        <li><a href="FullnFinal.php"><i class="fa fa-dashboard"></i>Full n Final</a></li>
        <li class="active">Edit Full n Final</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='FullnFinal.php'">Cancel</button>
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
                <h3 class="box-title">Full n Final Date</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="FromDate">From Date:</label>
				  <input type="date" disabled name="FromDate" value="<?php echo $FromDate; ?>" class="form-control" />
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="ToDate">Till Date:</label>
				  <input type="date" disabled name="ToDate" value="<?php echo $ToDate; ?>" class="form-control" />
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="">Total Days:</label>
				  <input type="text" disabled name="" value="<?php echo $NumOfDays; ?>" class="form-control" />
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
                <h3 class="box-title">Full n Final Remarks</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="Remarks">Remarks (Print at Slip):</label>
				  <?php 
				echo '<textarea rows="5" maxlength="500" id="Remarks" name="Remarks" class="form-control">'.$Remarks.'</textarea>';
				?>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="SpecialRemarks">Special Remarks (Only for Record):</label>
				  <?php 
				echo '<textarea rows="5" maxlength="500" id="SpecialRemarks" name="SpecialRemarks" class="form-control">'.$SpecialRemarks.'</textarea>';
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
                <h3 class="box-title">Full n Final Applicable</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
					<label id="labelimp" for="EmployeeID" >Employee: <span class="requiredStar">*</span></label>
					<select style="width:100%" name="EmployeeID" id="EmployeeID" class="form-control">
					<option value="" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where ID = ".$EmployeeID."";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($EmployeeID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
					</select>
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="NetPay">Salary After Calculate:</label>
				  <input type="text" name="NetPay" value="<?php echo $NetPay; ?>" class="form-control" />
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="PreviousSalary">Sum of Pending Salaries:</label>
				  <input type="text" name="PreviousSalary" value="<?php echo $PreviousSalary; ?>" class="form-control" />
				</div>
				
				<div class="form-group">
				  <label id="labelimp" class="labelimp" for="RemainingLoan">Remaining Loans Amount:</label>
				  <input type="text" name="RemainingLoan" value="<?php echo $RemainingLoan; ?>" class="form-control" />
				</div>
				

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
                <h3 class="box-title">Adjustment Heads</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <h4>Head Title </h4>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					   <h4>Title Type </h4>
					</div>
				  </div>
				  <div class="col-md-4">
					<h4>Amount </h4>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title1" value="<?php echo $Title1; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title1check" class="form-control">
					 <option value="0" <?php echo ($Title1check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title1check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title1check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title1amount" value="<?php echo $Title1amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title2" value="<?php echo $Title2; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title2check" class="form-control">
					 <option value="0" <?php echo ($Title2check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title2check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title2check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title2amount" value="<?php echo $Title2amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title3" value="<?php echo $Title3; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title3check" class="form-control">
					 <option value="0" <?php echo ($Title3check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title3check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title3check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title3amount" value="<?php echo $Title3amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title4" value="<?php echo $Title4; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title4check" class="form-control">
					 <option value="0" <?php echo ($Title4check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title4check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title4check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title4amount" value="<?php echo $Title4amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title5" value="<?php echo $Title5; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title5check" class="form-control">
					 <option value="0" <?php echo ($Title5check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title5check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title5check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title5amount" value="<?php echo $Title5amount; ?>">
					</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" name="Title6" value="<?php echo $Title6; ?>">
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
					<select name="Title6check" class="form-control">
					 <option value="0" <?php echo ($Title6check == '0' ? ' selected' : ''); ?>>No Need</option>
					 <option value="1" <?php echo ($Title6check == '1' ? ' selected' : ''); ?>>Incremental</option>
					 <option value="2" <?php echo ($Title6check == '2' ? ' selected' : ''); ?>>Decremental</option>
					</select>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group">
						<input type="number" class="form-control" name="Title6amount" value="<?php echo $Title6amount; ?>">
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
