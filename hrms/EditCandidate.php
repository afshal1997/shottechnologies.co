<?php
include_once("Common.php");
include("CheckAdminLogin.php");
	
	$msg="";
	$Resume=0;
	$ApplyedFor=0;
	$EmailAddress="";
	$FirstName="";
	$LastName="";
	$Status="Active";
	$Phone="";
	
	$ID=0;
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	
		
	
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
		$ID=trim($_REQUEST["ID"]);
	if(isset($_POST["EmailAddress"]))
		$EmailAddress=trim($_POST["EmailAddress"]);
	if(isset($_POST["FirstName"]))
		$FirstName=trim($_POST["FirstName"]);
	if(isset($_POST["LastName"]))
		$LastName=trim($_POST["LastName"]);
	if(isset($_POST["Status"]))
		$Status=trim($_POST["Status"]);
	if(isset($_POST["Resume"]) && ctype_digit($_POST['Resume']))
		$Resume=trim($_POST["Resume"]);
	if(isset($_POST["Phone"]))
		$Phone=trim($_POST["Phone"]);

	
		if($FirstName == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter FirstName.</b>
			</div>';
		}
		else if($LastName == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter LastName.</b>
			</div>';
		}
		else if($Resume == 0)
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please select Resume.</b>
			</div>';
		}
		else if($EmailAddress == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter EmailAddress.</b>
			</div>';
		}
		else if(!validEmailAddress($EmailAddress))
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter valid EmailAddress.</b>
			</div>';
		}
		else if($Phone == "")
		{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please enter Phone Number.</b>
			</div>';
		}
		
		
	
	if($msg=="")
	{
			$query="UPDATE candidates SET DateModified=NOW(),
				EmailAddress = '" . dbinput($EmailAddress) . "',
				FirstName = '" . dbinput($FirstName) . "',
				LastName = '" . dbinput($LastName) . "',
				Status = '" . dbinput($Status) . "',
				Resume = '" . (int)$Resume . "',
				Phone = '" . dbinput($Phone) . "'
			WHERE ID='".(int)$ID."'";
			mysql_query($query) or die (mysql_error());
			//echo $query;
			
			$msg='<div class="alert alert-success alert-dismissable">
				<i class="fa fa-ban"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b>Candidate has been Updated.</b>
			</div>';
			
		
				
			
	}

}
else
{
	$query="SELECT * FROM candidates WHERE  ID='" . (int)$ID . "'";
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		$_SESSION["msg"]='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Invalid Candidate ID.</b>
		</div>';
		redirect("Candidates.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$ID=$row["ID"];
		$Resume=$row["Resume"];
		$ApplyedFor=$row["ApplyedFor"];
		$EmailAddress=$row["EmailAddress"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$Status=$row["Status"];
		$Phone=$row["Phone"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Candidate</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
      <h1>Edit Candidate</h1>
      <ol class="breadcrumb">
        <li><a href="Candidates.php"><i class="fa fa-dashboard"></i>Candidates</a></li>
        <li class="active">Edit Candidate</li>
      </ol>
    </section>
    <!-- Main content -->
    <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>?ID=<?php echo $ID; ?>"" method="post" enctype="multipart/form-data" name="frmPage">
      <input type="hidden" name="action" value="submit_form" />
      <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
      <section class="content">
        <div class="box-footer" style="text-align:right;">
          <button type="submit" class="btn btn-success margin">Save</button>
          <button class="btn btn-primary margin" type="button" onClick="location.href='Candidates.php'">Cancel</button>
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
                  <label id="labelimp" class="labelimp" for="FirstName">First Name: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="FirstName" name="FirstName" class="form-control"  value="'.$FirstName.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="LastName">Last Name: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="LastName" name="LastName" class="form-control"  value="'.$LastName.'" />';
				?>
                </div>
				
				<div class="form-group">
				  <label id="labelimp" for="Resume" >Resume #: </label>
				  <select name="Resume" id="Resume" class="form-control">
					<option value="0" >Select Resume</option>
					<?php					
					$query = "SELECT ID FROM resumes where PostID = ".$ApplyedFor."";
					$res = mysql_query($query);
					while($row = mysql_fetch_array($res))
					{
					echo '<option '.($Resume == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">Res#: '.$row['ID'].'</option>';
					} 
				?>
				</select>
				</div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="EmailAddress">Email Address: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="EmailAddress" name="EmailAddress" class="form-control"  value="'.$EmailAddress.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" class="labelimp" for="Phone">Phone Number: </label>
                  <?php 
				echo '<input type="text" maxlength="100" id="Phone" name="Phone" class="form-control"  value="'.$Phone.'" />';
				?>
                </div>
				
				<div class="form-group">
                  <label id="labelimp" >Status: </label>
                  <label>
                  <input type="radio" name="Status" value="Active"<?php echo ($Status == "Active" ? ' checked="checked"' : ''); ?>>
                  Active</label>
                  <label>
                  <input type="radio" name="Status" value="Deactive"<?php echo ($Status == "Deactive" ? ' checked="checked"' : ''); ?>>
                  Deactive</label>
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