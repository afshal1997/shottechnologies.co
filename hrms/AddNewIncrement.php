<?php
include_once("Common.php");
include("CheckAdminLogin.php");


	$msg="";
	$Approved=0;
	$ApprovedBy=0;
	$EmpID=0;
	$FrwdEmpID=0;
	$Amount=0;
	$Date="";
	$EffectiveDate="";
	$ArrearMonths=0;
	$ArrearAmount=0;
	
	$Salary=0;
	$NetSalary=0;
	$BasicSalary=0;
	$Increment=0;
		
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["Amount"]))
		$Amount=trim($_POST["Amount"]);
	if(isset($_POST["Date"]))
		$Date=trim($_POST["Date"]);
	if(isset($_POST["EffectiveDate"]))
		$EffectiveDate=trim($_POST["EffectiveDate"]);
	if(isset($_POST["ArrearMonths"]) && ctype_digit($_POST['ArrearMonths']))
		$ArrearMonths=trim($_POST["ArrearMonths"]);
	if(isset($_POST["Description"]))
		$Description=trim($_POST["Description"]);
	if(isset($_POST["EmpID"]) && ctype_digit($_POST['EmpID']))
		$EmpID=trim($_POST["EmpID"]);
	if(isset($_POST["FrwdEmpID"]) && ctype_digit($_POST['FrwdEmpID']))
		$FrwdEmpID=trim($_POST["FrwdEmpID"]);

		if($Amount == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Amount.</b>
			</div>';
		}	
		else if($Date == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Date.</b>
			</div>';
		}
		else if($EffectiveDate == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Effective Date.</b>
			</div>';
		}
		else if($EmpID == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Employee Name.</b>
			</div>';
		}
		else if($FrwdEmpID == 0)
		{
			$Approved=1;
			$ApprovedBy=$_SESSION["UserID"];
		}

		$query = "SELECT Salary FROM employees where ID = ".$EmpID."";
		$res = mysql_query($query);
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$row = mysql_fetch_array($res);
			$Salary=$row["Salary"];
		}
		
		if($Salary < 1)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Employee Dont have Gross Salary.</b>
			</div>';
		}


	if($msg=="")
	{
		
		if($ArrearMonths > 0)
		{
			$query="INSERT INTO adjustments SET DateAdded=NOW(),
				Title = '9',
				Amount = '" . dbinput($Amount * $ArrearMonths) . "',
				Percentage = '" . dbinput($Amount * $ArrearMonths) . "',
				Date = '" . dbinput($Date) . "',
				Type = 'FixedAmount',
				EmpID='".(int)$EmpID . "',
				FrwdEmpID='0',
				Approved = '1',
				ApprovedBy = '" . $_SESSION["UserID"] . "',
				Description = ''";
			mysql_query($query) or die (mysql_error());
		}
		
		
		$Increment = $Amount;
		$Amount = $Amount + $Salary;
		$NetSalary = ($Amount / 3);
		$BasicSalary = ($NetSalary * 2);
		
		$query="UPDATE basicsalary SET Date='".$Date."',
			Approved = 1,
			ApprovedBy = '" . $_SESSION['UserID'] . "',
			Amount = '" . $BasicSalary . "' WHERE EmpID = '" . (int)$EmpID . "'";	
		mysql_query($query) or die (mysql_error());
		
		$query="UPDATE employees SET Salary='".$Amount."'
		WHERE ID = '" . (int)$EmpID . "'";	
		mysql_query($query) or die (mysql_error());
			
		$query="INSERT INTO increments SET 
				Amount = '" . dbinput($Increment) . "',
				Date = '" . dbinput($Date) . "',
				EffectiveDate = '" . dbinput($EffectiveDate) . "',
				ArrearMonths = '" . dbinput($ArrearMonths) . "',
				ArrearAmount = '" . dbinput($Increment * $ArrearMonths) . "',
				EmpID='".(int)$EmpID . "',
				FrwdEmpID='".(int)$FrwdEmpID . "',
				Approved = '" . dbinput($Approved) . "',
				ApprovedBy = '" . (int)$ApprovedBy . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		$ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Increment has been added.</b>
		</div>';		
		
		redirect("AddNewIncrement.php");	
	}
		

}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Add Increment</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Increment-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
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
		
		$("#Amount").keyup(function () {	
		
			var a = parseFloat($("#Amount").val());
			var b = parseFloat($("#ArrearMonths").val());

			var total = (a*b);

			
			$("#ArrearAmount").val(total);
			
		});
		
		$("#ArrearMonths").keyup(function () {	
		
			var a = parseFloat($("#Amount").val());
			var b = parseFloat($("#ArrearMonths").val());

			var total = (a*b);

			
			$("#ArrearAmount").val(total);
			
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
      <h1> Add Increment</h1>
      <ol class="breadcrumb">
        <li><a href="Increments.php"><i class="fa fa-dashboard"></i>Increments</a></li>
        <li class="active">Add Increment</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
      <section class="content">
       <div class="box-footer" style="text-align:right;">
                <button type="submit" class="btn btn-success margin">Save</button>
                <button class="btn btn-primary margin" type="button" onClick="location.href='Increments.php'">Cancel</button>
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
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Amount">Amount: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="Amount" name="Amount" placeholder="'.CURRENCY_SYMBOL.'" class="form-control"  value="'.$Amount.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Date">Date: </label>
                  <?php 
				echo '<input type="date" maxlength="100" id="Date" name="Date" class="form-control"  value="'.$Date.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="EffectiveDate">Effective Date: </label>
                  <?php 
				echo '<input type="date" maxlength="100" id="EffectiveDate" name="EffectiveDate" class="form-control"  value="'.$EffectiveDate.'" />';
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
                  <label id="labelimp" class="labelimp" for="ArrearMonths">Arrear Months: </label>
                  <?php 
				echo '<input type="number" maxlength="100" id="ArrearMonths" name="ArrearMonths" class="form-control"  value="'.$ArrearMonths.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="ArrearAmount">Arrear Amount: </label>
                  <?php 
				echo '<input type="text" disabled  maxlength="100" id="ArrearAmount" name="ArrearAmount" class="form-control"  value="'.$ArrearAmount.'" />';
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
                  <label id="labelimp" for="EmpID" >Employee Name: </label>
				  <select name="EmpID" id="EmpID" class="form-control">
					<option value="0" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($EmpID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="FrwdEmpID" >Forward Application To: </label>
				  <select disabled name="FrwdEmpID" id="FrwdEmpID" class="form-control">
					<option value="0" >No Forward</option>
					<?php
					 $query = "SELECT ID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' AND Role = 'Administrator' ORDER BY ID ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($FrwdEmpID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
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
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#EmpID').select2();
</script>
</body>
</html>
