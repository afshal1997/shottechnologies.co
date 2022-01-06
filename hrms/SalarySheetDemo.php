<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Salary Sheet</title>
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
#labelimp {
	background-color: #428BCA;
	padding: 4px;
	color:white;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
.alig {
	text-align:center;
	color:#303;
	font-family:Georgia, "Times New Roman", Times, serif;
	}
	.abc{
		size:58px;
		
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
      <h1> Salary Sheet<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payrolls</li>
      </ol><hr>
      <h1 class="alig invoice-title">C.I.M. SHIPPING </h1>
      <h4 class="alig invoice-title">SALARY FOR THE MONTH OF DECEMBER, 2015					
</h4>
<h6 class="alig">ALL STAFF</h6>
      
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
			
					
                        <div class="col-xs-12 no-print">
                            <button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                  
            
            <div class="scroll box-body table-responsive">
              <?php
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
			
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" id="action" name="action" value="" />
                <table id="dataTable" class="table table-bordered invoice" style="background-color:white">
                  <thead class="alig">
                    <tr >
                      <th rowspan="2">S#</th>
					  <th rowspan="2">Code</th>
                      <th rowspan="2">First Name</th>
                      
                      <th rowspan="2">Ast_</th>
                      <th rowspan="2">Designation</th>
                      <th rowspan="2">Actual Basic</th>
                      <th rowspan="2">Actual Gross</th>
                      <th rowspan="2">Annual Bonus</th>
                      <th rowspan="2">Salary Average_</th>
                      <th rowspan="2">PERIOD DAYS</th>
                     <th colspan="9">Attendance</th>
                       <th rowspan="2">OverTime Date</th>
                     <th rowspan="2">Basic Salary</th>
                     <th colspan="9">ALLOWENCES</th>
                     <th rowspan="2">GROSS SALARY</th>
                      <th colspan="8">DEDUCTIONS</th>
                                             <th colspan="1">TOTAL</th>
                          <th colspan="1">NET</th>
                            <th colspan="1">MODULE_</th>
                            
                             <th rowspan="2">MODULE</th>
                              <th rowspan="2">CASH</th>
                               <th rowspan="2">CHECQUE</th>
                                <th rowspan="2">CREDIT</th>
                                 <th rowspan="2">LETTER</th>
                                  <th rowspan="2">_</th>
                     
                     
                     
                     
                    </tr>
                     <tr>
                      
					  <th>Pay Days</th>
                      <th>LEAVE</th>
					  <th>HALF</th>
                       <th>LATE</th>
                     <th>LATE COUNT</th>
                       <th>ABSENT</th>
                      <th>DAYS</th>
					  <th>Over Time</th>
                      <th>Ded Hours</th>
                    
                       <th>House Rent</th>
                      <th>Utilities</th>
					  <th>CUNT OF_</th>
                       <th>CONVENCVE</th>
                     <th>SPECIAL</th>
                       <th>ABSENT</th>
                      <th>ADHOC_</th>
					  <th>ROUND</th>
                      <th>OTHER</th>
                      
                       <th>LATE/_</th>
                      <th>BREAKS</th>
                      
					  <th>ABS AMOUNT</th>
                       <th>LOAN</th>
                       
                     <th>ADV</th>
                       <th>AOC_</th>
                       <th>TAX</th>
					  <th>SU_</th>
                      
                       <th>OTHER</th>
                       <th>DFD</th>
					  <th>SALARY</th>
                      
                      
                      
                      
                    </tr>
                    
                    
                  </thead>
				  
                  <tbody>
                   
                    <tr class="noPrint">
               
                         <thead class="">
                    
                     <tr>
                      
					  <th colspan="50">C.I.M. SHIPPING</th>
                    </tr>
                     <tr>
                      
					  <th colspan="50">Faislabad office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   </br></br>
                   
                   
                   
					  <th colspan="50">Karachi office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                       
                         
                       
                   <!-- --> 
                   
					  <th colspan="50">Lahore office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>

                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   
					  <th colspan="50">Sialkot office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   <th colspan="5">Total CIM Shipping</th>
                      <th>2033123</th>
					  <th>123</th>
                     
                     <th>13888</th>
                     <th></th>
                        <th>233123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>442000</th>
                       <th>4449000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>529125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>32409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>53400</th>
                      <th>536723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>5776321</th>
			           </tr>
                  
                       
                   <!------------------------------------------------------ -->
                   
                   <th colspan="50" class="abc" >Emkay Lines Private Limited		
</th>
                   
					 
                    </tr>
                   
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>


                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   
					  <th colspan="50">Karachi office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   <th colspan="5">          Total   Emkay Lines Private Limited		
</th>
                      <th>2033123</th>
					  <th>123</th>
                     
                     <th>13888</th>
                     <th></th>
                        <th>233123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>442000</th>
                       <th>4449000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>529125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>32409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>53400</th>
                      <th>536723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>5776321</th>
			           </tr>
                  
                   <!-- --------------------------------------- -->
                     <th colspan="50">Emkay Logistics	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="50">Karachi office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   
                    <th colspan="5">          Total   Emkay Logistics	
		
</th>
                      <th>2033123</th>
					  <th>123</th>
                     
                     <th>13888</th>
                     <th></th>
                        <th>233123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>442000</th>
                       <th>4449000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>529125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>32409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>53400</th>
                      <th>536723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>5776321</th>
			           </tr>
                   <!---------------------------------------------------------- -->
                   
                     <th colspan="50">Tasamarine & Logistics		
	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="50">Karachi office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   
                    <th colspan="5">          Total   Tasamarine & Logistics		

		
</th>
                      <th>2033123</th>
					  <th>123</th>
                     
                     <th>13888</th>
                     <th></th>
                        <th>233123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>442000</th>
                       <th>4449000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>529125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>32409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>53400</th>
                      <th>536723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>5776321</th>
			           </tr>
                  
                   
                   <!-- ----------------------------------------------- -->
                   
                   
                     <th colspan="50">TASAMARINE DEPOT.		
		
	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="50">Karachi office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   
               
                  <!---- ---------------------------------------------------- -->
                  
                   <th colspan="50">          TMT YARD	
		
		
	
</th>
                    </tr>
               
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th></th>
                     <th>1888</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>3.1</th>
					  <th>Sohail</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>2392</th>
                      <th>2013</th>
					  <th>323</th>
                      <th></th>
                     <th>1288</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3439</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>25125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>527</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">3</th>
                      <th>1.5</th>
					  <th>yousuf</th>
                       <th></th>
                     <th>Manager</th>
                       <th>292</th>
                      <th>4513</th>
					  <th>1123</th>
                      <th></th>
                     <th>1288</th>
                      <th>3</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>22000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>19125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2109</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>406321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">4</th>
                      <th>2.2</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>1292</th>
                      <th>2023</th>
					  <th>123</th>
                      <th></th>
                     <th>188</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>32000</th>
                       <th>39000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>22125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>2</th>
                       <th></th>
                      <th></th>
                     <th>467</th>
                      <th>0</th>
                      <th>3200</th>
                      <th>76723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>436321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="">5</th>
                      <th>2.6</th>
					  <th>Zubair</th>
                       <th></th>
                     <th>offic Assistant</th>
                       <th>22392</th>
                      <th>30123</th>
					  <th>123</th>
                      <th></th>
                     <th>1588</th>
                      <th>30</th>
					  <th>0</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>43000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>3409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>564</th>
                      <th>0</th>
                      <th>3500</th>
                      <th>35723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>556321</th>
			           </tr>
                   <!-- --> 
                    <th colspan="5">subtotal</th>
                      <th>20123</th>
					  <th>123</th>
                     
                     <th>1888</th>
                     <th></th>
                        <th>23123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>42000</th>
                       <th>49000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>3400</th>
                      <th>36723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>776321</th>
			           </tr>
                   
                    <th colspan="5">          Total   TASAMARINE DEPOT.		
	

		
</th>
                      <th>2033123</th>
					  <th>123</th>
                     
                     <th>13888</th>
                     <th></th>
                        <th>233123</th>
                      <th>30</th>
					  <th>30</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>442000</th>
                       <th>4449000</th>
                    <th>3239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>529125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>32409</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>53400</th>
                      <th>536723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>5776321</th>
			           </tr>
                  
                  <th colspan="5">          GRAND TOTAL
	

		
</th>
                      <th>22033123</th>
					  <th>1223</th>
                     
                     <th>1322888</th>
                     <th></th>
                        <th>2233123</th>
                      <th>130</th>
					  <th>130</th>
                       <th>0</th>
                     <th>0</th>
                       <th>0</th>
                      <th>0</th>
					  <th>0</th>
                      <th>0</th>
                    <th>0</th>
                      <th>0</th>
                     <th>4421000</th>
                       <th>44491000</th>
                    <th>31239</th>
                       <th></th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>5229125</th>
                       <th></th>
                      <th>0</th>
					  <th>0</th>
                       <th>324309</th>
                     <th>0</th>
                       <th></th>
                      <th></th>
                     <th>567</th>
                      <th>0</th>
                      <th>553400</th>
                      <th>5366723</th>
                       <th>letter</th>
                     <th>4</th>
                       <th>0</th>
                      <th>0</th>
                       <th>0</th>
                       <th>57716321</th>
			           </tr>
                  
                   
                   
                   
                  </thead>
                    </tr>
                   
				
				
                  </tbody>
                </table>
              </form>
            </div>
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
