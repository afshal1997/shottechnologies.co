<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$EmpID=0;
	$Rights="";
	$RightsArray=array();
	$CompanyID="";
	$CompID=array();
	$Status='Active';
	$FirstName='';
	$LastName='';
	$Username='';
	$Password='';
	$Role='';
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["FirstName"]))
		$FirstName=trim($_POST["FirstName"]);
	if(isset($_POST["LastName"]))
		$LastName=trim($_POST["LastName"]);
	if(isset($_POST["Username"]))
		$Username=trim($_POST["Username"]);
	if(isset($_POST["Password"]))
		$Password=trim($_POST["Password"]);
	if(isset($_POST["Role"]))
		$Role=trim($_POST["Role"]);
	if(isset($_POST["Status"]))
		$Status=trim($_POST["Status"]);	
	if(isset($_POST["Rights"]))
	{
		$Rights=implode(',', $_POST['Rights']);
		$RightsArray=$_POST['Rights'];
	}
	if(isset($_POST["CompanyID"]))
	{
		$CompanyID=implode(',', $_POST['CompanyID']);
		$CompID=$_POST['CompanyID'];
	}
	
	if($FirstName == '')
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter FirstName.</b>
		</div>';
	}
	else if($Username == '')
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Username.</b>
		</div>';
	}
	else if($Password == '')
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please enter Password.</b>
		</div>';
	}	
	else if($Role == '')
	{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Please select Role.</b>
		</div>';
	}	
	else
	{
		$query="SELECT UserName FROM externalusers WHERE UserName = '".$Username."'";
		$result = mysql_query ($query) or die(mysql_error()); 
		$num = mysql_num_rows($result);
		
		if($num != 0)
		{
		$msg='<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>UserName already exist.</b>
		</div>';
		}
	}

	if($msg=="")
	{
		$query="UPDATE externalusers SET DateModified=NOW(),
		FirstName = '" . dbinput($FirstName) . "',
		LastName = '" . dbinput($LastName) . "',
		UserName = '" . dbinput($Username) . "',
		Password = '" . dbinput($Password) . "',
		Role = '" . dbinput($Role) . "',
		Rights = '" . dbinput($Rights) . "',
		Companies = '" . dbinput($CompanyID) . "',
		Status='". dbinput($Status) . "'
		WHERE ID='".(int)$ID."'";
		mysql_query($query) or die (mysql_error());
		//echo $query;
		
		$msg='<div class="alert alert-success alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>External Account has been Updated.</b>
		</div>';	
	}
}
else
{
	$query="SELECT ID,Status,Rights,Companies,FirstName,LastName,UserName,Password,Role FROM externalusers WHERE  ID='" .(int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid External Account ID.</b>
		</div>';
		redirect("ExternalAccounts.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Status=$row["Status"];
		$Rights=$row["Rights"];
		$RightsArray=explode(',', $Rights);
		$CompanyID=$row["Companies"];
		$CompID=explode(',', $CompanyID);
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$UserName=$row["UserName"];
		$Password=$row["Password"];
		$Role=$row["Role"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit External Account</title>
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

.securityTable tr td {
	padding:10px;
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
      <h1>Edit External Account</h1>
      <ol class="breadcrumb">
        <li><a href="ExternalAccounts.php"><i class="fa fa-dashboard"></i>External Accounts</a></li>
        <li class="active">Edit External Account</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer no-print" style="text-align:right;">
		  <a class="btn btn-primary margin no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</a>
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='ExternalAccounts.php'">Cancel</button>
        </div>
        <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				?>
		<div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
					  <label id="labelimp" class="labelimp" for="FirstName">First Name:</label>
					  <?php 
					echo '<input type="text" maxlength="100" id="FirstName" name="FirstName" class="form-control"  value="'.$FirstName.'" />';
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
		 <div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
						  <label id="labelimp" class="labelimp" for="LastName">Last Name: </label>
						  <?php 
						echo '<input type="text" maxlength="100" id="LastName" name="LastName" class="form-control"  value="'.$LastName.'" />';
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
		 
		 <div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
				  <label id="labelimp" >Status: </label>
				  <label>
				  <input type="radio" name="Status" value="Active"<?php echo ($Status == 'Active' ? ' checked="checked"' : ''); ?>>
				  Active</label>
				  <label>
				  <input type="radio" name="Status" value="Deactive"<?php echo ($Status == 'Deactive' ? ' checked="checked"' : ''); ?>>
				  Deactive</label>
				</div>
				<br>
			    <input type="hidden" name="action" value="submit_form" />
              </div>
              <!-- /.box-body -->
            
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
         </div>
		 
		 
		 <div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
					  <label id="labelimp" class="labelimp" for="Username">Username:</label>
					  <?php 
					echo '<input type="text" maxlength="100" id="Username" name="Username" class="form-control"  value="'.$Username.'" />';
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
		 <div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
				
				<div class="form-group">
						  <label id="labelimp" class="labelimp" for="Password">Password: </label>
						  <?php 
						echo '<input type="password" maxlength="100" id="Password" name="Password" class="form-control"  value="'.$Password.'" />';
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
		 
		 <div class="col-md-4 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				
				<div class="form-group">
						  <label id="labelimp" for="Role" >Role</label>
						  <select style="width:100%" name="Role" id="Role" class="form-control">
							<option value="" >Select Role</option>
							<?php
							foreach($_ROLES as $roles)
							{
							echo '<option '.(($_SESSION['RoleID'] != 'Administrator' AND $roles != 'Security') ? 'disabled' : '').' '.($Role == $roles ? 'selected' : '').' value="'.$roles.'">'.$roles.'</option>';
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
		 
		 <div class="col-md-12 no-print">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<div class="form-group">
                  <label id="labelimp" for="CompanyID" >Company: </label>
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
		 
		  
		 <div class="col-md-12">
		  <div class="box box-solid">
          <div class="box-header bg-box-blue">
                <h3 class="box-title">&emsp;</h3>
            </div>
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
			  
				<h1>Dashboard</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Dashboard Icon</b></td>
				<td colspan="5">Visibility <input id="DashIcon" <?php echo (in_array('DashIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DashIcon" /></td>
				</tr>
				<tr>
				<td><b>Employees Charts</b></td>
				<td>Execute <input id="DashEmp" <?php echo (in_array('DashEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DashEmp" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Events Calendar</b></td>
				<td>Execute <input id="DashEvntClndr" <?php echo (in_array('DashEvntClndr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DashEvntClndr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Shortcut Icons</b></td>
				<td>Execute <input id="DashShrtIcn" <?php echo (in_array('DashShrtIcn', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DashShrtIcn" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Chatting</b></td>
				<td>Execute <input id="DashChat" <?php echo (in_array('DashChat', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DashChat" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				 
				<hr>
				
				<h1>Employees Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Employees Management Icon</b></td>
				<td colspan="5">Visibility <input id="EmpIcon" <?php echo (in_array('EmpIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpIcon" /></td>
				</tr>
				<tr>
				<td><b>Employees</b></td>
				<td>Execute <input id="EmpExeEmp" <?php echo (in_array('EmpExeEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpExeEmp" /></td>
				<td>Insert <input id="EmpInsEmp" <?php echo (in_array('EmpInsEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpInsEmp" /></td>
				<td>Update <input id="EmpUpdEmp" <?php echo (in_array('EmpUpdEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpUpdEmp" /></td>
				<td>Delete <input id="EmpDelEmp" <?php echo (in_array('EmpDelEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpDelEmp" /></td>
				<td>Print <input id="EmpPrntEmp" <?php echo (in_array('EmpPrntEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpPrntEmp" /></td>
				</tr>
				<tr>
				<td><b>Increments</b></td>
				<td>Execute <input id="EmpExeInc" <?php echo (in_array('EmpExeInc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpExeInc" /></td>
				<td>Insert <input id="EmpInsInc" <?php echo (in_array('EmpInsInc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpInsInc" /></td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="EmpPrntInc" <?php echo (in_array('EmpPrntEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpPrntEmp" /></td>
				</tr>
				<tr>
				<td><b>Expired CNIC</b></td>
				<td>Execute <input id="EmpExeExpCNIC" <?php echo (in_array('EmpExeExpCNIC', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpExeExpCNIC" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="EmpPrntExpCNIC" <?php echo (in_array('EmpPrntExpCNIC', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EmpPrntExpCNIC" /></td>
				</tr>
				</table>
				<hr>
				
				<h1>Attendance Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Attendance Management Icon</b></td>
				<td colspan="5">Visibility <input id="AttIcon" <?php echo (in_array('AttIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttIcon" /></td>
				</tr>
				<tr>
				<td><b>Attendance Ledger</b></td>
				<td>Execute <input id="AttExeAttLed" <?php echo (in_array('AttExeAttLed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttExeAttLed" /></td>
				<td>Insert</td>
				<td>Update <input id="AttUpdAttLed" <?php echo (in_array('AttUpdAttLed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttUpdAttLed" /></td>
				<td>Delete <input id="AttDelAttLed" <?php echo (in_array('AttDelAttLed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttDelAttLed" /></td>
				<td>Print <input id="AttPrntAttLed" <?php echo (in_array('AttPrntAttLed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttPrntAttLed" /></td>
				</tr>
				<tr>
				<td><b>Time Adjust Requests</b></td>
				<td>Execute <input id="AttExeTimAdjReq" <?php echo (in_array('AttExeTimAdjReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttExeTimAdjReq" /></td>
				<td>Insert</td>
				<td>Update <input id="AttUpdTimAdjReq" <?php echo (in_array('AttUpdTimAdjReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttUpdTimAdjReq" /></td>
				<td>Delete <input id="AttDelTimAdjReq" <?php echo (in_array('AttDelTimAdjReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttDelTimAdjReq" /></td>
				<td>Print <input id="AttPrntTimAdjReq" <?php echo (in_array('AttPrntTimAdjReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttPrntTimAdjReq" /></td>
				</tr>
				<tr>
				<td><b>Manual Attendance</b></td>
				<td>Execute <input id="AttExeManAtt" <?php echo (in_array('AttExeManAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttExeManAtt" /></td>
				<td>Insert <input id="AttInsManAtt" <?php echo (in_array('AttInsManAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttInsManAtt" /></td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Attendance Ledger</b></td>
				<td>Execute <input id="AttExeMyAtt" <?php echo (in_array('AttExeMyAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttExeMyAtt" /></td>
				<td>Insert</td>
				<td>Update <input id="AttUpdMyAtt" <?php echo (in_array('AttUpdMyAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttUpdMyAtt" /></td>
				<td>Delete</td>
				<td>Print <input id="AttPrntMyAtt" <?php echo (in_array('AttPrntMyAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttPrntMyAtt" /></td>
				</tr>
				<tr>
				<td><b>Mark Attendance</b></td>
				<td>Execute <input id="AttExeMrkAtt" <?php echo (in_array('AttExeMrkAtt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="AttExeMrkAtt" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Rosters</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Rosters Icon</b></td>
				<td colspan="5">Visibility <input id="RosIcon" <?php echo (in_array('RosIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosIcon" /></td>
				</tr>
				<tr>
				<td><b>Attendance Roster</b></td>
				<td>Execute <input id="RosExeAttRos" <?php echo (in_array('RosExeAttRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosExeAttRos" /></td>
				<td>Insert <input id="RosInsAttRos" <?php echo (in_array('RosInsAttRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosInsAttRos" /></td>
				<td>Update <input id="RosUpdAttRos" <?php echo (in_array('RosUpdAttRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosUpdAttRos" /></td>
				<td>Delete <input id="RosDelAttRos" <?php echo (in_array('RosDelAttRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosDelAttRos" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Sandwich Roster</b></td>
				<td>Execute <input id="RosExeSanRos" <?php echo (in_array('RosExeSanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosExeSanRos" /></td>
				<td>Insert</td>
				<td>Update <input id="RosUpdSanRos" <?php echo (in_array('RosUpdSanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosUpdSanRos" /></td>
				<td>Delete</td>
				<td>Print <input id="RosPrntSanRos" <?php echo (in_array('RosPrntSanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosPrntSanRos" /></td>
				</tr>
				<tr>
				<td><b>Loan Roster</b></td>
				<td>Execute <input id="RosExeLoanRos" <?php echo (in_array('RosExeLoanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosExeLoanRos" /></td>
				<td>Insert</td>
				<td>Update <input id="RosUpdLoanRos" <?php echo (in_array('RosUpdLoanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosUpdLoanRos" /></td>
				<td>Delete</td>
				<td>Print <input id="RosPrntLoanRos" <?php echo (in_array('RosPrntLoanRos', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="RosPrntLoanRos" /></td>
				</tr>
				</table>
				<hr>
				
				<h1>Payroll Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Payroll Icon</b></td>
				<td colspan="5">Visibility <input id="PayIcon" <?php echo (in_array('PayIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayIcon" /></td>
				</tr>
				<tr>
				<td><b>Payroll Reports</b></td>
				<td>Execute <input id="PayExePayRep" <?php echo (in_array('PayExePayRep', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExePayRep" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="PayPrntPayRep" <?php echo (in_array('PayPrntPayRep', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntPayRep" /></td>
				</tr>
				<tr>
				<td><b>Payrolls</b></td>
				<td>Execute <input id="PayExePayrol" <?php echo (in_array('PayExePayrol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExePayrol" /></td>
				<td>Insert <input id="PayInsPayrol" <?php echo (in_array('PayInsPayrol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayInsPayrol" /></td>
				<td>Update</td>
				<td>Delete <input id="PayDelPayrol" <?php echo (in_array('PayDelPayrol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayDelPayrol" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Payrolls Account</b></td>
				<td>Execute <input id="PayExePayrolAcc" <?php echo (in_array('PayExePayrolAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExePayrolAcc" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Payrolls Audit</b></td>
				<td>Execute <input id="PayExePayrolAud" <?php echo (in_array('PayExePayrolAud', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExePayrolAud" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>SalarySheet</b></td>
				<td>Execute <input id="PayExeSalShet" <?php echo (in_array('PayExeSalShet', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeSalShet" /></td>
				<td>Insert</td>
				<td>Update <input id="PayUpdSalShet" <?php echo (in_array('PayUpdSalShet', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayUpdSalShet" /></td>
				<td>Delete</td>
				<td>Print <input id="PayPrntSalShet" <?php echo (in_array('PayPrntSalShet', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntSalShet" /></td>
				</tr>
				<tr>
				<td><b>Pay Slips</b></td>
				<td>Execute <input id="PayExePaySlip" <?php echo (in_array('PayExePaySlip', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExePaySlip" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="PayPrntPaySlip" <?php echo (in_array('PayPrntPaySlip', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntPaySlip" /></td>
				</tr>
				<tr>
				<td><b>Bank Letter</b></td>
				<td>Execute <input id="PayExeBnkLtr" <?php echo (in_array('PayExeBnkLtr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeBnkLtr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="PayPrntBnkLtr" <?php echo (in_array('PayPrntBnkLtr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntBnkLtr" /></td>
				</tr>
				<tr>
				<td><b>Journal Voucher</b></td>
				<td>Execute <input id="PayExeJV" <?php echo (in_array('PayExeJV', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeJV" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="PayPrntJV" <?php echo (in_array('PayPrntJV', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntJV" /></td>
				</tr>
				<tr>
				<td><b>Fix Allowances</b></td>
				<td>Execute <input id="PayExeFixAlw" <?php echo (in_array('PayExeFixAlw', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeFixAlw" /></td>
				<td>Insert <input id="PayInsFixAlw" <?php echo (in_array('PayInsFixAlw', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayInsFixAlw" /></td>
				<td>Update <input id="PayUpdFixAlw" <?php echo (in_array('PayUpdFixAlw', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayUpdFixAlw" /></td>
				<td>Delete <input id="PayDelFixAlw" <?php echo (in_array('PayDelFixAlw', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayDelFixAlw" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Fix Deductions</b></td>
				<td>Execute <input id="PayExeFixDed" <?php echo (in_array('PayExeFixDed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeFixDed" /></td>
				<td>Insert <input id="PayInsFixDed" <?php echo (in_array('PayInsFixDed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayInsFixDed" /></td>
				<td>Update <input id="PayUpdFixDed" <?php echo (in_array('PayUpdFixDed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayUpdFixDed" /></td>
				<td>Delete <input id="PayDelFixDed" <?php echo (in_array('PayDelFixDed', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayDelFixDed" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Adjustments</b></td>
				<td>Execute <input id="PayExeAdjus" <?php echo (in_array('PayExeAdjus', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeAdjus" /></td>
				<td>Insert <input id="PayInsAdjus" <?php echo (in_array('PayInsAdjus', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayInsAdjus" /></td>
				<td>Update <input id="PayUpdAdjus" <?php echo (in_array('PayUpdAdjus', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayUpdAdjus" /></td>
				<td>Delete <input id="PayDelAdjus" <?php echo (in_array('PayDelAdjus', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayDelAdjus" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Pay Slips</b></td>
				<td>Execute <input id="PayExeMyPaySlp" <?php echo (in_array('PayExeMyPaySlp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayExeMyPaySlp" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="PayPrntMyPaySlp" <?php echo (in_array('PayPrntMyPaySlp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="PayPrntMyPaySlp" /></td>
				</tr>
				</table>
				<hr>
				
				<h1>Loan & Advance Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Loan & Advance Management Icon</b></td>
				<td colspan="5">Visibility <input id="LnAIcon" <?php echo (in_array('LnAIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAIcon" /></td>
				</tr>
				<tr>
				<td><b>Loans</b></td>
				<td>Execute <input id="LnAExeLoans" <?php echo (in_array('LnAExeLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeLoans" /></td>
				<td>Insert <input id="LnAInsLoans" <?php echo (in_array('LnAInsLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAInsLoans" /></td>
				<td>Update <input id="LnAUpdLoans" <?php echo (in_array('LnAUpdLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAUpdLoans" /></td>
				<td>Delete <input id="LnADelLoans" <?php echo (in_array('LnADelLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnADelLoans" /></td>
				<td>Print <input id="LnAPrntLoans" <?php echo (in_array('LnAPrntLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAPrntLoans" /></td>
				</tr>
				<tr>
				<td><b>Loan Requests</b></td>
				<td>Execute <input id="LnAExeLoanReqs" <?php echo (in_array('LnAExeLoanReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeLoanReqs" /></td>
				<td>Insert</td>
				<td>Update <input id="LnAUpdLoanReqs" <?php echo (in_array('LnAUpdLoanReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAUpdLoanReqs" /></td>
				<td>Delete <input id="LnADelLoanReqs" <?php echo (in_array('LnADelLoanReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnADelLoanReqs" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Loan Manual Recoveries</b></td>
				<td>Execute <input id="LnAExeLonManRecov" <?php echo (in_array('LnAExeLonManRecov', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeLonManRecov" /></td>
				<td>Insert <input id="LnAInsLonManRecov" <?php echo (in_array('LnAInsLonManRecov', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAInsLonManRecov" /></td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Loans</b></td>
				<td>Execute <input id="LnAExeLonMyLoans" <?php echo (in_array('LnAExeLonMyLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeLonMyLoans" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="LnAPrntLonMyLoans" <?php echo (in_array('LnAPrntLonMyLoans', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAPrntLonMyLoans" /></td>
				</tr>
				<tr>
				<td><b>My Loan Requests</b></td>
				<td>Execute <input id="LnAExeMyLoanReqs" <?php echo (in_array('LnAExeMyLoanReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeMyLoanReqs" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Apply for Loan</b></td>
				<td>Execute <input id="LnAExeAppForLon" <?php echo (in_array('LnAExeAppForLon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeAppForLon" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Advances</b></td>
				<td>Execute <input id="LnAExeAdvnc" <?php echo (in_array('LnAExeAdvnc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeAdvnc" /></td>
				<td>Insert <input id="LnAInsAdvnc" <?php echo (in_array('LnAInsAdvnc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAInsAdvnc" /></td>
				<td>Update <input id="LnAUpdAdvnc" <?php echo (in_array('LnAUpdAdvnc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAUpdAdvnc" /></td>
				<td>Delete <input id="LnADelAdvnc" <?php echo (in_array('LnADelAdvnc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnADelAdvnc" /></td>
				<td>Print <input id="LnAPrntAdvnc" <?php echo (in_array('LnAPrntAdvnc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAPrntAdvnc" /></td>
				</tr>
				<tr>
				<td><b>Advance Requests</b></td>
				<td>Execute <input id="LnAExeAdvReqs" <?php echo (in_array('LnAExeAdvReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeAdvReqs" /></td>
				<td>Insert</td>
				<td>Update <input id="LnAUpdAdvReqs" <?php echo (in_array('LnAUpdAdvReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAUpdAdvReqs" /></td>
				<td>Delete <input id="LnADelAdvReqs" <?php echo (in_array('LnADelAdvReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnADelAdvReqs" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Advances</b></td>
				<td>Execute <input id="LnAExeLonMyAdvns" <?php echo (in_array('LnAExeLonMyAdvns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeLonMyAdvns" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print <input id="LnAPrntLonMyAdvns" <?php echo (in_array('LnAPrntLonMyAdvns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAPrntLonMyAdvns" /></td>
				</tr>
				<tr>
				<td><b>My Advance Requests</b></td>
				<td>Execute <input id="LnAExeMyAdvnsReqs" <?php echo (in_array('LnAExeMyAdvnsReqs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeMyAdvnsReqs" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Apply for Advance</b></td>
				<td>Execute <input id="LnAExeAppForAdvns" <?php echo (in_array('LnAExeAppForAdvns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LnAExeAppForAdvns" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Documents Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Documents Management Icon</b></td>
				<td colspan="5">Visibility <input id="DocIcon" <?php echo (in_array('DocIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DocIcon" /></td>
				</tr>
				<tr>
				<td><b>My Documents</b></td>
				<td>Execute <input id="DocExeMyDoc" <?php echo (in_array('DocExeMyDoc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DocExeMyDoc" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Employees Documents</b></td>
				<td>Execute <input id="DocExeEmpDoc" <?php echo (in_array('DocExeEmpDoc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DocExeEmpDoc" /></td>
				<td>Insert <input id="DocInsEmpDoc" <?php echo (in_array('DocInsEmpDoc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DocInsEmpDoc" /></td>
				<td>Update</td>
				<td>Delete <input id="DocDelEmpDoc" <?php echo (in_array('DocDelEmpDoc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="DocDelEmpDoc" /></td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Leaves Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Leaves Management Icon</b></td>
				<td colspan="5">Visibility <input id="LeavIcon" <?php echo (in_array('LeavIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavIcon" /></td>
				</tr>
				<tr>
				<td><b>Assign Leaves Quota</b></td>
				<td>Execute <input id="LeavExeAssLevQuo" <?php echo (in_array('LeavExeAssLevQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeAssLevQuo" /></td>
				<td>Insert <input id="LeavInsAssLevQuo" <?php echo (in_array('LeavInsAssLevQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavInsAssLevQuo" /></td>
				<td>Update <input id="LeavUpdAssLevQuo" <?php echo (in_array('LeavUpdAssLevQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavUpdAssLevQuo" /></td>
				<td>Delete <input id="LeavDelAssLevQuo" <?php echo (in_array('LeavDelAssLevQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelAssLevQuo" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Leaves</b></td>
				<td>Execute <input id="LeavExeLeavs" <?php echo (in_array('LeavExeLeavs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeLeavs" /></td>
				<td>Insert <input id="LeavInsLeavs" <?php echo (in_array('LeavInsLeavs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavInsLeavs" /></td>
				<td>Update</td>
				<td>Delete <input id="LeavDelLeavs" <?php echo (in_array('LeavDelLeavs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelLeavs" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Writeoff Leaves</b></td>
				<td>Execute <input id="LeavExeWrtOfLev" <?php echo (in_array('LeavExeWrtOfLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeWrtOfLev" /></td>
				<td>Insert <input id="LeavInsWrtOfLev" <?php echo (in_array('LeavInsWrtOfLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavInsWrtOfLev" /></td>
				<td>Update</td>
				<td>Delete <input id="LeavDelWrtOfLev" <?php echo (in_array('LeavDelWrtOfLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelWrtOfLev" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Grant Leaves</b></td>
				<td>Execute <input id="LeavExeGrntLev" <?php echo (in_array('LeavExeGrntLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeGrntLev" /></td>
				<td>Insert <input id="LeavInsGrntLev" <?php echo (in_array('LeavInsGrntLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavInsGrntLev" /></td>
				<td>Update</td>
				<td>Delete <input id="LeavDelGrntLev" <?php echo (in_array('LeavDelGrntLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelGrntLev" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Employees Quota</b></td>
				<td>Execute <input id="LeavExeEmpQuo" <?php echo (in_array('LeavExeEmpQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeEmpQuo" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Leave Requests</b></td>
				<td>Execute <input id="LeavExeLevReq" <?php echo (in_array('LeavExeLevReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeLevReq" /></td>
				<td>Insert</td>
				<td>Update <input id="LeavUpdLevReq" <?php echo (in_array('LeavUpdLevReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavUpdLevReq" /></td>
				<td>Delete <input id="LeavDelLevReq" <?php echo (in_array('LeavDelLevReq', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelLevReq" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Gazetted Holidays</b></td>
				<td>Execute <input id="LeavExeGazHol" <?php echo (in_array('LeavExeGazHol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeGazHol" /></td>
				<td>Insert <input id="LeavInsGazHol" <?php echo (in_array('LeavInsGazHol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavInsGazHol" /></td>
				<td>Update <input id="LeavUpdGazHol" <?php echo (in_array('LeavUpdGazHol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavUpdGazHol" /></td>
				<td>Delete <input id="LeavDelGazHol" <?php echo (in_array('LeavDelGazHol', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavDelGazHol" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Current Quota </b></td>
				<td>Execute <input id="LeavExeMyCrntQuo" <?php echo (in_array('LeavExeMyCrntQuo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeMyCrntQuo" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Apply For Leave </b></td>
				<td>Execute <input id="LeavExeAppForLev" <?php echo (in_array('LeavExeAppForLev', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="LeavExeAppForLev" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Events Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Events Management Icon</b></td>
				<td colspan="5">Visibility <input id="EventIcon" <?php echo (in_array('EventIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EventIcon" /></td>
				</tr>
				<tr>
				<td><b>Events</b></td>
				<td>Execute <input id="EvntExeEvnt" <?php echo (in_array('EvntExeEvnt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EvntExeEvnt" /></td>
				<td>Insert <input id="EvntInsEvnt" <?php echo (in_array('EvntInsEvnt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EvntInsEvnt" /></td>
				<td>Update <input id="EvntUpdEvnt" <?php echo (in_array('EvntUpdEvnt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EvntUpdEvnt" /></td>
				<td>Delete <input id="EvntDelEvnt" <?php echo (in_array('EvntDelEvnt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EvntDelEvnt" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Events Calendar</b></td>
				<td>Execute <input id="EvntExeEvntClndr" <?php echo (in_array('EvntExeEvntClndr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="EvntExeEvntClndr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Trainings Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Trainings Management Icon</b></td>
				<td colspan="5">Visibility <input id="TrainIcon" <?php echo (in_array('TrainIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainIcon" /></td>
				</tr>
				<tr>
				<td><b>Assign Trainings</b></td>
				<td>Execute <input id="TrainExeAssTrain" <?php echo (in_array('TrainExeAssTrain', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeAssTrain" /></td>
				<td>Insert <input id="TrainInsAssTrain" <?php echo (in_array('TrainInsAssTrain', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainInsAssTrain" /></td>
				<td>Update <input id="TrainUpdAssTrain" <?php echo (in_array('TrainUpdAssTrain', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainUpdAssTrain" /></td>
				<td>Delete <input id="TrainDelAssTrain" <?php echo (in_array('TrainDelAssTrain', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainDelAssTrain" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Trainings Details</b></td>
				<td>Execute <input id="TrainExeTrainDetl" <?php echo (in_array('TrainExeTrainDetl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeTrainDetl" /></td>
				<td>Insert</td>
				<td>Update <input id="TrainUpdTrainDetl" <?php echo (in_array('TrainUpdTrainDetl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainUpdTrainDetl" /></td>
				<td>Delete</td>
				<td>Print <input id="TrainPrntTrainDetl" <?php echo (in_array('TrainPrntTrainDetl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainPrntTrainDetl" /></td>
				</tr>
				<tr>
				<td><b>Trainings Calendar</b></td>
				<td>Execute <input id="TrainExeTrainCalndr" <?php echo (in_array('TrainExeTrainCalndr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeTrainCalndr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Test Builder </b></td>
				<td>Execute <input id="TrainExeTstBldr" <?php echo (in_array('TrainExeTstBldr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeTstBldr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Tests </b></td>
				<td>Execute <input id="TrainExeTsts" <?php echo (in_array('TrainExeTsts', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeTsts" /></td>
				<td>Insert <input id="TrainInsTsts" <?php echo (in_array('TrainInsTsts', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainInsTsts" /></td>
				<td>Update <input id="TrainUpdTsts" <?php echo (in_array('TrainUpdTsts', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainUpdTsts" /></td>
				<td>Delete <input id="TrainDltTsts" <?php echo (in_array('TrainDltTsts', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainDltTsts" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Questions </b></td>
				<td>Execute <input id="TrainExeQstns" <?php echo (in_array('TrainExeQstns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeQstns" /></td>
				<td>Insert <input id="TrainInsQstns" <?php echo (in_array('TrainInsQstns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainInsQstns" /></td>
				<td>Update <input id="TrainUpdQstns" <?php echo (in_array('TrainUpdQstns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainUpdQstns" /></td>
				<td>Delete <input id="TrainDltQstns" <?php echo (in_array('TrainDltQstns', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainDltQstns" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Answers </b></td>
				<td>Execute <input id="TrainExeAnsws" <?php echo (in_array('TrainExeAnsws', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeAnsws" /></td>
				<td>Insert <input id="TrainInsAnsws" <?php echo (in_array('TrainInsAnsws', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainInsAnsws" /></td>
				<td>Update <input id="TrainUpdAnsws" <?php echo (in_array('TrainUpdAnsws', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainUpdAnsws" /></td>
				<td>Delete <input id="TrainDltAnsws" <?php echo (in_array('TrainDltAnsws', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainDltAnsws" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Employees Results </b></td>
				<td>Execute <input id="TrainExeEmpReslts" <?php echo (in_array('TrainExeEmpReslts', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeEmpReslts" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Trainings </b></td>
				<td>Execute <input id="TrainExeMyTrangs" <?php echo (in_array('TrainExeMyTrangs', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeMyTrangs" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>My Training Results </b></td>
				<td>Execute <input id="TrainExeMyTrangsReslt" <?php echo (in_array('TrainExeMyTrangsReslt', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeMyTrangsReslt" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>In My Supervision </b></td>
				<td>Execute <input id="TrainExeInMySprvisn" <?php echo (in_array('TrainExeInMySprvisn', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="TrainExeInMySprvisn" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Jobs Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Jobs Management Icon</b></td>
				<td colspan="5">Visibility <input id="JobIcon" <?php echo (in_array('JobIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobIcon" /></td>
				</tr>
				<tr>
				<td><b>Career Form</b></td>
				<td>Execute <input id="JobExeCarerFrm" <?php echo (in_array('JobExeCarerFrm', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeCarerFrm" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Career Form Demo</b></td>
				<td>Execute <input id="JobExeCarerFrmDmo" <?php echo (in_array('JobExeCarerFrmDmo', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeCarerFrmDmo" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Job Posts</b></td>
				<td>Execute <input id="JobExeJobPost" <?php echo (in_array('JobExeJobPost', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeJobPost" /></td>
				<td>Insert <input id="JobInsJobPost" <?php echo (in_array('JobInsJobPost', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobInsJobPost" /></td>
				<td>Update <input id="JobUpdJobPost" <?php echo (in_array('JobUpdJobPost', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobUpdJobPost" /></td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Resumes</b></td>
				<td>Execute <input id="JobExeResumes" <?php echo (in_array('JobExeResumes', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeResumes" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Job Candidates</b></td>
				<td>Execute <input id="JobExeJobCandi" <?php echo (in_array('JobExeJobCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeJobCandi" /></td>
				<td>Insert <input id="JobInsJobCandi" <?php echo (in_array('JobInsJobCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobInsJobCandi" /></td>
				<td>Update <input id="JobUpdJobCandi" <?php echo (in_array('JobUpdJobCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobUpdJobCandi" /></td>
				<td>Delete <input id="JobDltJobCandi" <?php echo (in_array('JobDltJobCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobDltJobCandi" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Interviews Scheduled</b></td>
				<td>Execute <input id="JobExeIntrviwSchedl" <?php echo (in_array('JobExeIntrviwSchedl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeIntrviwSchedl" /></td>
				<td>Insert <input id="JobInsIntrviwSchedl" <?php echo (in_array('JobInsIntrviwSchedl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobInsIntrviwSchedl" /></td>
				<td>Update <input id="JobUpdIntrviwSchedl" <?php echo (in_array('JobUpdIntrviwSchedl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobUpdIntrviwSchedl" /></td>
				<td>Delete <input id="JobDltIntrviwSchedl" <?php echo (in_array('JobDltIntrviwSchedl', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobDltIntrviwSchedl" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Interviews Details</b></td>
				<td>Execute <input id="JobExeIntrviwDetls" <?php echo (in_array('JobExeIntrviwDetls', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeIntrviwDetls" /></td>
				<td>Insert</td>
				<td>Update <input id="JobUpdIntrviwDetls" <?php echo (in_array('JobUpdIntrviwDetls', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobUpdIntrviwDetls" /></td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Interviews Calendar</b></td>
				<td>Execute <input id="JobExeIntrviwClndr" <?php echo (in_array('JobExeIntrviwClndr', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeIntrviwClndr" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Shortlist Candidates</b></td>
				<td>Execute <input id="JobExeShrtlstCandi" <?php echo (in_array('JobExeShrtlstCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeShrtlstCandi" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete <input id="JobDltShrtlstCandi" <?php echo (in_array('JobDltShrtlstCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobDltShrtlstCandi" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Disqualified Candidates</b></td>
				<td>Execute <input id="JobExeDisqulifyCandi" <?php echo (in_array('JobExeDisqulifyCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobExeDisqulifyCandi" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete <input id="JobDltDisqulifyCandi" <?php echo (in_array('JobDltDisqulifyCandi', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="JobDltDisqulifyCandi" /></td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Whistle Blow</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Whistle Blow Icon</b></td>
				<td colspan="5">Visibility <input id="WhistleIcon" <?php echo (in_array('WhistleIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleIcon" /></td>
				</tr>
				<tr>
				<td><b>Authorized Employees</b></td>
				<td>Execute <input id="WhistleExeAuthrizEmp" <?php echo (in_array('WhistleExeAuthrizEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeAuthrizEmp" /></td>
				<td>Insert</td>
				<td>Update <input id="WhistleUpdAuthrizEmp" <?php echo (in_array('WhistleUpdAuthrizEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleUpdAuthrizEmp" /></td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Compose Message</b></td>
				<td>Execute <input id="WhistleExeCompsMsg" <?php echo (in_array('WhistleExeCompsMsg', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeCompsMsg" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Inbox</b></td>
				<td>Execute <input id="WhistleExeInbox" <?php echo (in_array('WhistleExeInbox', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeInbox" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Outbox</b></td>
				<td>Execute <input id="WhistleExeOutbox" <?php echo (in_array('WhistleExeOutbox', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeOutbox" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Whistle Blow</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Whistle Blow Icon</b></td>
				<td colspan="5">Visibility <input id="WhistleIcon" <?php echo (in_array('WhistleIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleIcon" /></td>
				</tr>
				<tr>
				<td><b>Authorized Employees</b></td>
				<td>Execute <input id="WhistleExeAuthrizEmp" <?php echo (in_array('WhistleExeAuthrizEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeAuthrizEmp" /></td>
				<td>Insert</td>
				<td>Update <input id="WhistleUpdAuthrizEmp" <?php echo (in_array('WhistleUpdAuthrizEmp', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleUpdAuthrizEmp" /></td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Compose Message</b></td>
				<td>Execute <input id="WhistleExeCompsMsg" <?php echo (in_array('WhistleExeCompsMsg', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeCompsMsg" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Inbox</b></td>
				<td>Execute <input id="WhistleExeInbox" <?php echo (in_array('WhistleExeInbox', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeInbox" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Outbox</b></td>
				<td>Execute <input id="WhistleExeOutbox" <?php echo (in_array('WhistleExeOutbox', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="WhistleExeOutbox" /></td>
				<td>Insert</td>
				<td>Update</td>
				<td>Delete</td>
				<td>Print</td>
				</tr>
				</table>
				<hr>
				
				<h1>Security Management</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Security Management Icon</b></td>
				<td colspan="5">Visibility <input id="SecureIcon" <?php echo (in_array('SecureIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureIcon" /></td>
				</tr>
				<tr>
				<td><b>Employees Security Accounts</b></td>
				<td>Execute <input id="SecureExeEmpSecAcc" <?php echo (in_array('SecureExeEmpSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureExeEmpSecAcc" /></td>
				<td>Insert <input id="SecureInsEmpSecAcc" <?php echo (in_array('SecureInsEmpSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsEmpSecAcc" /></td>
				<td>Update <input id="SecureUpdEmpSecAcc" <?php echo (in_array('SecureUpdEmpSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdEmpSecAcc" /></td>
				<td>Delete <input id="SecureDltEmpSecAcc" <?php echo (in_array('SecureDltEmpSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltEmpSecAcc" /></td>
				<td>Print <input id="SecurePrntEmpSecAcc" <?php echo (in_array('SecurePrntEmpSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecurePrntEmpSecAcc" /></td>
				</tr>
				<tr>
				<td><b>External Security Accounts</b></td>
				<td>Execute <input id="SecureExeExtSecAcc" <?php echo (in_array('SecureExeExtSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureExeExtSecAcc" /></td>
				<td>Insert <input id="SecureInsExtSecAcc" <?php echo (in_array('SecureInsExtSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsExtSecAcc" /></td>
				<td>Update <input id="SecureUpdExtSecAcc" <?php echo (in_array('SecureUpdExtSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdExtSecAcc" /></td>
				<td>Delete <input id="SecureDltExtSecAcc" <?php echo (in_array('SecureDltExtSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltExtSecAcc" /></td>
				<td>Print <input id="SecurePrntExtSecAcc" <?php echo (in_array('SecurePrntExtSecAcc', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecurePrntExtSecAcc" /></td>
				</tr>
				</table>
				<hr>
				
				<h1>Organization Settings</h1>
				<table border='1' class="securityTable">
				<tr>
				<td><b>Organization Settings Icon</b></td>
				<td colspan="5">Visibility <input id="OrgIcon" <?php echo (in_array('OrgIcon', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgIcon" /></td>
				</tr>
				<tr>
				<td><b>Companies</b></td>
				<td>Execute <input id="OrgExeCopmany" <?php echo (in_array('OrgExeCopmany', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeCopmany" /></td>
				<td>Insert <input id="SecureInsCopmany" <?php echo (in_array('SecureInsCopmany', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsCopmany" /></td>
				<td>Update <input id="SecureUpdCopmany" <?php echo (in_array('SecureUpdCopmany', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdCopmany" /></td>
				<td>Delete <input id="SecureDltCopmany" <?php echo (in_array('SecureDltCopmany', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltCopmany" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Locations</b></td>
				<td>Execute <input id="OrgExeLocation" <?php echo (in_array('OrgExeLocation', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeLocation" /></td>
				<td>Insert <input id="SecureInsLocation" <?php echo (in_array('SecureInsLocation', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsLocation" /></td>
				<td>Update <input id="SecureUpdLocation" <?php echo (in_array('SecureUpdLocation', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdLocation" /></td>
				<td>Delete <input id="SecureDltLocation" <?php echo (in_array('SecureDltLocation', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltLocation" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Time Schedules</b></td>
				<td>Execute <input id="OrgExeSchedule" <?php echo (in_array('OrgExeSchedule', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeSchedule" /></td>
				<td>Insert <input id="SecureInsSchedule" <?php echo (in_array('SecureInsSchedule', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsSchedule" /></td>
				<td>Update <input id="SecureUpdSchedule" <?php echo (in_array('SecureUpdSchedule', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdSchedule" /></td>
				<td>Delete <input id="SecureDltSchedule" <?php echo (in_array('SecureDltSchedule', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltSchedule" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Overtime Policies</b></td>
				<td>Execute <input id="OrgExeOvertime" <?php echo (in_array('OrgExeOvertime', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeOvertime" /></td>
				<td>Insert <input id="SecureInsOvertime" <?php echo (in_array('SecureInsOvertime', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsOvertime" /></td>
				<td>Update <input id="SecureUpdOvertime" <?php echo (in_array('SecureUpdOvertime', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdOvertime" /></td>
				<td>Delete <input id="SecureDltOvertime" <?php echo (in_array('SecureDltOvertime', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltOvertime" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Loan Types</b></td>
				<td>Execute <input id="OrgExeLoanType" <?php echo (in_array('OrgExeLoanType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeLoanType" /></td>
				<td>Insert <input id="SecureInsLoanType" <?php echo (in_array('SecureInsLoanType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsLoanType" /></td>
				<td>Update <input id="SecureUpdLoanType" <?php echo (in_array('SecureUpdLoanType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdLoanType" /></td>
				<td>Delete <input id="SecureDltLoanType" <?php echo (in_array('SecureDltLoanType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltLoanType" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Allowance Types</b></td>
				<td>Execute <input id="OrgExeAllowType" <?php echo (in_array('OrgExeAllowType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeAllowType" /></td>
				<td>Insert <input id="SecureInsAllowType" <?php echo (in_array('SecureInsAllowType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsAllowType" /></td>
				<td>Update <input id="SecureUpdAllowType" <?php echo (in_array('SecureUpdAllowType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdAllowType" /></td>
				<td>Delete <input id="SecureDltAllowType" <?php echo (in_array('SecureDltAllowType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltAllowType" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Deduction Types</b></td>
				<td>Execute <input id="OrgExeDeductType" <?php echo (in_array('OrgExeDeductType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeDeductType" /></td>
				<td>Insert <input id="SecureInsDeductType" <?php echo (in_array('SecureInsDeductType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsDeductType" /></td>
				<td>Update <input id="SecureUpdDeductType" <?php echo (in_array('SecureUpdDeductType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdDeductType" /></td>
				<td>Delete <input id="SecureDltDeductType" <?php echo (in_array('SecureDltDeductType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltDeductType" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Adjustment Types</b></td>
				<td>Execute <input id="OrgExeAdjustType" <?php echo (in_array('OrgExeAdjustType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeAdjustType" /></td>
				<td>Insert <input id="SecureInsAdjustType" <?php echo (in_array('SecureInsAdjustType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsAdjustType" /></td>
				<td>Update <input id="SecureUpdAdjustType" <?php echo (in_array('SecureUpdAdjustType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdAdjustType" /></td>
				<td>Delete <input id="SecureDltAdjustType" <?php echo (in_array('SecureDltAdjustType', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltAdjustType" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Institutes / Universities</b></td>
				<td>Execute <input id="OrgExeUniversity" <?php echo (in_array('OrgExeUniversity', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeUniversity" /></td>
				<td>Insert <input id="SecureInsUniversity" <?php echo (in_array('SecureInsUniversity', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsUniversity" /></td>
				<td>Update <input id="SecureUpdUniversity" <?php echo (in_array('SecureUpdUniversity', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdUniversity" /></td>
				<td>Delete <input id="SecureDltUniversity" <?php echo (in_array('SecureDltUniversity', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltUniversity" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Banks</b></td>
				<td>Execute <input id="OrgExeBank" <?php echo (in_array('OrgExeBank', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeBank" /></td>
				<td>Insert <input id="SecureInsBank" <?php echo (in_array('SecureInsBank', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsBank" /></td>
				<td>Update <input id="SecureUpdBank" <?php echo (in_array('SecureUpdBank', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdBank" /></td>
				<td>Delete <input id="SecureDltBank" <?php echo (in_array('SecureDltBank', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltBank" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Grades</b></td>
				<td>Execute <input id="OrgExeGrade" <?php echo (in_array('OrgExeGrade', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeGrade" /></td>
				<td>Insert <input id="SecureInsGrade" <?php echo (in_array('SecureInsGrade', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsGrade" /></td>
				<td>Update <input id="SecureUpdGrade" <?php echo (in_array('SecureUpdGrade', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdGrade" /></td>
				<td>Delete <input id="SecureDltGrade" <?php echo (in_array('SecureDltGrade', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltGrade" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Departments</b></td>
				<td>Execute <input id="OrgExeDepart" <?php echo (in_array('OrgExeDepart', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeDepart" /></td>
				<td>Insert <input id="SecureInsDepart" <?php echo (in_array('SecureInsDepart', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsDepart" /></td>
				<td>Update <input id="SecureUpdDepart" <?php echo (in_array('SecureUpdDepart', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdDepart" /></td>
				<td>Delete <input id="SecureDltDepart" <?php echo (in_array('SecureDltDepart', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltDepart" /></td>
				<td>Print</td>
				</tr>
				<tr>
				<td><b>Designations</b></td>
				<td>Execute <input id="OrgExeDesig" <?php echo (in_array('OrgExeDesig', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="OrgExeDesig" /></td>
				<td>Insert <input id="SecureInsDesig" <?php echo (in_array('SecureInsDesig', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureInsDesig" /></td>
				<td>Update <input id="SecureUpdDesig" <?php echo (in_array('SecureUpdDesig', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureUpdDesig" /></td>
				<td>Delete <input id="SecureDltDesig" <?php echo (in_array('SecureDltDesig', $RightsArray) ? "checked = checked" : "") ?> type="checkbox" name="Rights[]" value="SecureDltDesig" /></td>
				<td>Print</td>
				</tr>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
