<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg='';
$Receivers=array();
$EmployeesToRecieve="";
$Subject="";
$Body="";
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	
	if(isset($_POST["Receivers"]))
	{
		$EmployeesToRecieve=implode(',', $_POST['Receivers']);
		$Receivers=$_POST['Receivers'];
	}
	if(isset($_POST["Subject"]))
		$Subject=trim($_POST["Subject"]);
	if(isset($_POST["Body"]))
		$Body=trim($_POST["Body"]);
		
		
	if(empty($Receivers))
	{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Select Recipient Name.</b>
			</div>';
	}
	else if($Body=="")
	{
			$msg='<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Please Enter Message Content.</b>
			</div>';
	}
	if($msg=="")
	{
		$query="INSERT INTO messages SET  Sender='".$_SESSION['UserID']. "', DateAdded=NOW(),
				Subject = '" . dbinput($Subject) . "', Contents = '" . dbinput($Body) . "', Receivers = '" . dbinput($EmployeesToRecieve) . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		// $ID = mysql_insert_id();
		$_SESSION["msg"]='<div class="alert alert-success alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>Message has been Sended.</b>
		</div>';		
	
		redirect("ComposeMessage.php");
	}
}
//Total No Of User in Corporate and Individual

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Compose Message</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script language="javascript">
	$(document).ready(function () {				
		$(".checkUncheckAll").click(function () {
			$(".chkIds").prop("checked", $(this).prop("checked"));			
		});
	});
	var counter = 0;
	
	
	
</script>
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
      <h1>Compose Message <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Compose Messages</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="">
          
			<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
            <div class="box">
              <div class="box-header"> <i class="fa fa-envelope"></i>
                <h3 class="box-title">Compose Message</h3>
                
              </div>
              
              <div class="box-body">
               
                <?php
		  		echo $msg;
				if(isset($_SESSION["msg"]))
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
				
				
				?>
				
				
				<div class="form-group">
                 <div class="selectBox" onclick="showCheckboxes2()">
						<select class="form-control">
							<option>To:</option>
						</select>
						<div class="overSelect"></div>
					</div>
					<div id="checkboxes2" style="height:250px; overflow:scroll;">						
						<?php
						$query1="SELECT Employees FROM authorized_employees";
						$res1 = mysql_query($query1);
						$row1 = mysql_fetch_array($res1) or die(mysql_error());
						
						
						$query="SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' AND ID IN (".$row1['Employees'].") ORDER BY Department,Designation ASC";
						// echo $query;
						// exit();
						$res = mysql_query($query) or die(mysql_error());
						while($row = mysql_fetch_array($res))
						{						
						echo '<label><input '.(in_array($row['ID'], $Receivers) ? "checked = checked" : "").' type="checkbox" name="Receivers[]" value="'.$row['ID'].'"/>&ensp;'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].')</label>';
						} 
						?>
				  </div>
                </div>
                <div class="form-group">
					<?php 
					echo '<input type="text" placeholder="Subject" id="Subject" name="Subject" class="form-control"  value="'.$Subject.'" />';
					?>
                </div>
                <div>
                  <?php 
					echo '<textarea placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" class="textarea" name="Body">'.$Body.'</textarea>';
					?>
                </div>
              </div>
              <input type="hidden" name="action" value="submit_form" />
              <div class="box-footer clearfix">
                <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>
          </form>
		  
           
           
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
<!-- ./wrapper -->
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->

</body>
</html>
