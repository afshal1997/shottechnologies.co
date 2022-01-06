<?php
include_once("Common.php");
include("CheckAdminLogin.php");

if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR')
{}else{redirect("Dashboard.php");}	
	
	$msg="";
	$ID=0;
	$Approved=0;
	$ApprovedBy=0;
	$EmpID=0;
	$FrwdEmpID=0;
	$Title="";
	$Amount=0;
	$Percentage=0;
	$Date="";
	$Type="";
	$Taxable="";
	$Description="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	if(isset($_REQUEST["EmpID"]) && ctype_digit(trim($_REQUEST["EmpID"])))
		$EmpID=trim($_REQUEST["EmpID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["AmountPercentage"]))
		$Amount=trim($_POST["AmountPercentage"]);
	if(isset($_POST["AmountPercentage"]))
		$Percentage=trim($_POST["AmountPercentage"]);
	if(isset($_POST["Title"]))
		$Title=trim($_POST["Title"]);
	if(isset($_POST["Date"]))
		$Date=trim($_POST["Date"]);
	if(isset($_POST["Type"]))
		$Type=trim($_POST["Type"]);
	if(isset($_POST["Taxable"]))
		$Taxable=trim($_POST["Taxable"]);
	if(isset($_POST["Description"]))
		$Description=trim($_POST["Description"]);
	if(isset($_POST["EmpID"]) && ctype_digit($_POST['EmpID']))
		$EmpID=trim($_POST["EmpID"]);
	if(isset($_POST["FrwdEmpID"]) && ctype_digit($_POST['FrwdEmpID']))
		$FrwdEmpID=trim($_POST["FrwdEmpID"]);

	
		if($Title == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Title.</b>
			</div>';
		}
		else if($Type == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Amount Type.</b>
			</div>';
		}
		else if($Type == "FixedAmount" && $Amount == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please enter Amount.</b>
				</div>';
		}
		else if($Type == "Percentage" && $Percentage == 0)
		{
				$msg='<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Please enter Percentage.</b>
				</div>';
		}
		else if($Taxable == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Taxable.</b>
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
		
	
	if($msg=="")
	{
		
			$query="UPDATE allowances SET 
			Title = '" . dbinput($Title) . "',
			Amount = '" . dbinput($Amount) . "',
			Percentage = '" . dbinput($Percentage) . "',
			Date = '" . dbinput($Date) . "',
			Type = '" . dbinput($Type) . "',
			Taxable = '" . dbinput($Taxable) . "',
			EmpID='".(int)$EmpID . "',
			FrwdEmpID='".(int)$FrwdEmpID . "',
			Approved = '" . dbinput($Approved) . "',
			ApprovedBy = '" . (int)$ApprovedBy . "',
			Description = '" . dbinput($Description) . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die ('Could not update Allowance because: ' . mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Allowance has been Updated.</b>
			</div>';
		
			
		
			
	}

}
else
{
	$query="SELECT ID, Approved,ApprovedBy,EmpID,FrwdEmpID,Title,Amount,Percentage,Date,Type,Taxable,Description FROM allowances WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Allowance ID.</b>
		</div>';
		redirect("Allowances.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Approved=$row["Approved"];
		$ApprovedBy=$row["ApprovedBy"];
		$EmpID=$row["EmpID"];
		$FrwdEmpID=$row["FrwdEmpID"];
		$Title=$row["Title"];
		$Amount=$row["Amount"];
		$Percentage=$row["Percentage"];
		$Date=$row["Date"];
		$Type=$row["Type"];
		$Taxable=$row["Taxable"];
		$Description=$row["Description"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Allowance</title>
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
      <h1>Edit Allowance</h1>
      <ol class="breadcrumb">
        <li><a href="Allowances.php"><i class="fa fa-dashboard"></i>Allowances</a></li>
        <li class="active">Edit Allowance</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>&EmpID=<?php echo $EmpID; ?>"" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Allowances.php'">Cancel</button>
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
                  <label id="labelimp" for="Title" >Title: </label>
				  <select name="Title" id="Title" class="form-control">
					<option value="" >Select Allowance Title</option>
					<?php
					 $query = "SELECT ID,Name FROM allowancetypes where Status = 1 ORDER BY Name ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($Title == $row['Name'] ? 'selected' : '').' value="'.$row['Name'].'">'.$row['Name'].'</option>';
					} 
					?>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Type" >Amount Type: </label>
				  <select name="Type" id="Type" class="form-control">
					<option value="" >Select Amount Type</option>
					<option <?php echo ($Type == 'FixedAmount' ? 'selected' : '');?> value="FixedAmount" >FixedAmount</option>
					<option <?php echo ($Type == 'Percentage' ? 'selected' : '');?> value="Percentage" >Percentage</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="AmountPercentage">Amount / Percentage: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="AmountPercentage" name="AmountPercentage" placeholder="'.CURRENCY_SYMBOL.'" class="form-control"  value="'.($Type == "Percentage" ? $Percentage : $Amount).'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="Taxable" >Taxable: </label>
				  <select name="Taxable" id="Taxable" class="form-control">
					<option value="" >Select Taxable</option>
					<option <?php echo ($Taxable == 'Yes' ? 'selected' : '');?> value="Yes" >Yes</option>
					<option <?php echo ($Taxable == 'No' ? 'selected' : '');?> value="No" >No</option>
				  </select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Date">Date: </label>
                  <?php 
				echo '<input type="date" maxlength="100" id="Date" name="Date" class="form-control"  value="'.$Date.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" for="EmpID" >Employee Name: </label>
				  <select disabled name="EmpID" id="EmpID" class="form-control">
					<option value="0" >Select Employee</option>
					<?php
					 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY Department,Designation ASC";
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
				  <select name="FrwdEmpID" id="FrwdEmpID" class="form-control">
					<option value="0" >No Forward</option>
					<?php
					 $query = "SELECT ID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' AND Role = 'Administrator' ORDER BY Department,Designation ASC";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($FrwdEmpID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</option>';
					} 
					?>
					</select>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Description">Description: </label>
                  <?php 
				echo '<textarea rows="6" id="Description" name="Description" class="form-control">'.$Description.'</textarea>';
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
