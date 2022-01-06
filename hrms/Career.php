<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Career</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, Employee-scalable=no' name='viewport'>
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
      <h1> Career Form <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Career Form</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">	
				<b>Career Form Integration</b>
			  </h3>
			  <div class="buttons" style="width:50%">
                <button class="btn bg-navy margin" type="button" onClick="location.href='Dashboard.php'">Back</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body margin">
            
             <p style="font-size:15px;font-family:verdana;">
			 HR lets you implement a complete Job Portal on your existing website. The Job Portal will be integrated to your HR Software, giving your website visitors a chance to apply directly from your website. Follow these simple steps to start with the integration:
			 </p> 
			 
			 <h3><i>Step 1 - Careers Page</i></h3>
			 
			 <p style="font-size:15px;font-family:verdana;">
			 Create a new web page in your existing website called careers or jobs (or any other name of your choice). Make sure your new careers page has the same interface as all other pages on the website.
			 </p> 
			 
			 
			 <h3><i>Step 2 - HTML Code</i></h3>
			 <p style="font-size:15px;font-family:verdana;">
			 Copy following HTML code and place it as the main content of your careers page or any place where you want to show your career form: 
			 </p> 
			 <div style="text-align:center">
			 <textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="3" style="width:40%;height:auto"></textarea>
			 </div>
			 
			 <h3><i>Step 3 - CSS Code</i></h3>
			 <p style="font-size:15px;font-family:verdana;">
			 Copy following CSS code and place it between the head tag of your careers page and customize this CSS code according to your website design: 
			 </p> 
			 <div style="text-align:center">
			 <textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="26" style="width:40%;height:auto"></textarea>
			 </div>
			  
			<h3><i>Step 4 - Testing</i></h3>
			 <p style="font-size:15px;font-family:verdana;">
			 Now your website is successfully integrated with HR Software. Please test the performance of your career form. <a href="CareerFormDemo.php">Demo</a>
			 </p> 
			  
            </div>
            <br>
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
