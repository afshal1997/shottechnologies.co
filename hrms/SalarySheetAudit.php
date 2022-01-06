<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php
$msg="";
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Salary Sheet Audit</title>
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
		floa {padding-left:100px;}
		pre1 {padding-left:30px;}
		.flo {margin-left:100px}
		
		.flo1 {margin-left:100px}
		
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
      <h1> Salary Sheet Audit<small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payrolls</li>
      </ol><hr>
      <h1 class="alig invoice-title">C.I.M. SHIPPING </h1>
      <h4 class="alig invoice-title">Salary Sheet for the Month of August 2009			
</h4>
<h6 class="alig">ALL STAFF(Audit)</h6>
      
                        <div class="col-xs-12 no-print">
                            <button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
          <br>
			
					
                  
            
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
					  <th rowspan="2">Card No</th>
                      <th rowspan="2">Employee Name</th>
                      
                      <th colspan="4">Salary</th>
                    
                     <th colspan="4">Attendance</th>
                       <th rowspan="2">Gross Salary</th>
                     <th colspan="2">OverTime</th>
                   
                    
                             <th rowspan="2">Other Allowances</th>
                              <th rowspan="2">Gross Payment</th>
                               <th rowspan="2">Other Deductions</th>
                                <th rowspan="2">Income Tax</th>
                                 <th rowspan="2">Net Pay</th>
                      </tr>
                     <tr>
                        <th rowspan="">Basic Salary</th>
                      <th rowspan="">Allowances</th>
                      <th rowspan="">Gross Salary Rate</th>
                      <th rowspan="">Attd Days</th>
                      
                      
					  <th>Festival Holidays</th>
                      <th>LEAVE</th>
					  <th>Leave WithOut Pay</th>
                       <th>Total Days</th>
                       
                       
                     <th>OverTime Hours</th>
                       <th>OverTime Amoun</th>
                       
                  </tr>
                    
                    
                  </thead>
				  
                  <tbody>
                   
                    <tr class="noPrint">
               
                         <thead class="">
                    
                     <tr>
                      
					  <th colspan="19">C.I.M. SHIPPING</th>
                    </tr>
                     <tr>
                      
					  <th colspan="19">Faislabad office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                           <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                                      <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- -->
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                    <th colspan="2">subtotal</th> 
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   </br></br>
                   
                   
                   
					  <th colspan="19">Karachi office</th>
                    </tr>
                  
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                       <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employee 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>       
                       
                   <!-- --> 
                   
					  <th colspan="19">Lahore office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                       <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                       <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                       <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th> 
                    <th>Total Empolyees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                   
					  <th colspan="19">Sialkot office</th>
                    </tr>
                    <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                   <!-- --> 
                  
                       
                   <!------------------------------------------------------ -->
                   
                   <th colspan="19" class="abc" >Emkay Lines Private Limited	</br>KARACHI OFFICE
</th>
                   
					 
                    </tr>
                     <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                  <!-- --> 
                   
					  <th colspan="19">Karachi office</th>
                    </tr>
                     <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                  <!-- --> 
                  
                   <!-- --------------------------------------- -->
                     <th colspan="19">Emkay Logistics	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="19">Karachi office</th>
                    </tr>
                   <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                   
                   
                   <!---------------------------------------------------------- -->
                   
                     <th colspan="19">Tasamarine & Logistics		
	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="19">Karachi office</th>
                    </tr>
                   <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                   
                    
                   
                   <!-- ----------------------------------------------- -->
                   
                   
                     <th colspan="19">TASAMARINE DEPOT.		
		
	
</th>
                    </tr>
                     <tr>
                      
					  <th colspan="19">Karachi office</th>
                    </tr>
                   
                   <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
               
                  <!---- ---------------------------------------------------- -->
                  
                   <th colspan="19">          TMT YARD	
		
		
	
</th>
                    </tr>
               
                   <th colspan="">1</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>
                   <!-- --> 
                          <th colspan="">2</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                        <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr>                   <!-- --> 
                     <th colspan="">3</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">4</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                     <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                     <th colspan="">5</th>
                      <th>1.1</th>
					  <th>Gulbhar</th>
                       <th>12392</th>
                      <th>20123</th>
					  <th>123</th>
                      <th > D: 0 <br>L: 0.0 <br>H: 0.0   </th>
                     <th>&nbsp;</th>
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
                       
                       </tr><!-- --> 
                    <th colspan="2">subtotal</th>
                    <th>Total Employees 5</th>
                     <th>3239</th>
                       <th>123</th>
                       <th>800</th>
					  <th></th>
                      <th></th>
                       <th></th>
					  <th></th>
                      	  <th></th>
                      <th>29125</th>
                       <th>23</th>
                      <th>0</th>
					  <th>0</th>
                       <th>2409</th>
                     <th></th>
                       <th></th>
                       <th>776321</th>
			           </tr>
                       
                 
                   
                  
  
                  </thead>
                    </tr>
                   
				
				
                  </tbody>
                </table>
                </br></br></br></br></br></br>
                
                 <div class="col-lg-4"><hr></div>
        <div class="col-lg-4"><hr> </div>
       
        <div class="col-lg-4" ><hr></div></br>
                
                
                
        <div class="col-lg-4"><h4 class="flo1">H.R. Manager's Sign.</h4> </div>
        <div class="col-lg-4"><h4 class="flo1"> Department Manager's Sign.</h4> </div>
       
        <div class="col-lg-4" > <h4 class="flo">Finance Manager's Sign.</h4></div></br>
        

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
