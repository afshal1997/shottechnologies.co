<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>

<?php
	$action = "";
	$msg = "";
	if(isset($_POST["action"]))
		$action = $_POST["action"];
// if($action == "GrantLeaves")
	// {
		// if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		// {
						
			// $_SESSION["GrantLeave"]=$_REQUEST["ids"];
			// redirect("GrantLeave.php");
		
		// }
		// else
		// {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Please select Attendance to Grant Leaves.</b>
			// </div>';
		// }
	// }
	// $_SESSION["GrantLeave"]="";

// if($action == "TimeAdjust")
	// {
		// if(isset($_REQUEST["ids"]) && is_array($_REQUEST["ids"]))
		// {
						
			// $_SESSION["TimeAdjust"]=$_REQUEST["ids"];
			// redirect("TimeAdjust.php");
		
		// }
		// else
		// {
			// $msg='<div class="alert alert-danger alert-dismissable">
			// <i class="fa fa-ban"></i>
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			// <b>Please select Attendance to Adjust Time.</b>
			// </div>';
		// }
	// }
	// $_SESSION["TimeAdjust"]="";
?>


<?php
$CompanyID=0;
$Location=0;
$Designation="";
$Department="";
$Employee=0;
$SortBy="e.EmpID";
$SortType="";

// $LoginTime="11:30:00";
// $ArrivalHalfDay="11:30:00";

// if($LoginTime > $ArrivalHalfDay)	
// {
	// echo 'HalfDay';
// }
// else
// {
	// echo 'At Time';
// }
					
// exit();					

$Absents = array();


$Legends = 0;

$startdate = "";
$Roster = array();
$RosterString = "";		

$TillDate=date("Y-m-d");

if($TillDate > date("Y-m-25"))
{
$FromDate=date("Y-m-26");
}
else
{
$d=strtotime("-1 Months");
// echo date("Y-m-d", $d);		
$FromDate=date("Y-m-26", $d);
}
			




if(isset($_REQUEST["CompanyID"]))
		$CompanyID=trim($_REQUEST["CompanyID"]);
if(isset($_REQUEST["Location"]))
		$Location=trim($_REQUEST["Location"]);
if(isset($_REQUEST["Designation"]))
		$Designation=trim($_REQUEST["Designation"]);
if(isset($_REQUEST["Department"]))
		$Department=trim($_REQUEST["Department"]);
if(isset($_REQUEST["SortBy"]))
		$SortBy=trim($_REQUEST["SortBy"]);
if(isset($_REQUEST["SortType"]))
		$SortType=trim($_REQUEST["SortType"]);
if(isset($_REQUEST["Employee"]))
		$Employee=trim($_REQUEST["Employee"]);
if(isset($_REQUEST["Legends"]))
		$Legends=trim($_REQUEST["Legends"]);
	
if(isset($_REQUEST["FromDate"]))
		$FromDate=trim($_REQUEST["FromDate"]);
if(isset($_REQUEST["TillDate"]))
		$TillDate=trim($_REQUEST["TillDate"]);

	// echo $FromDate;
	// exit();

$hours=0; 
$minutes=0;	

$LeaveDays = array();
$OffDay = "";
$ApplyAfter = "";

$Month=0;
$Year=0;
$Day=0;
if(isset($_REQUEST["Month"]))
		$Month=trim($_REQUEST["Month"]);
if(isset($_REQUEST["Year"]))
		$Year=trim($_REQUEST["Year"]);
if(isset($_REQUEST["Day"]))
		$Day=trim($_REQUEST["Day"]);
	// $action = "";
	// $msg = "";
	// if(isset($_POST["action"]))
		// $action = $_POST["action"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sandwitch Roster Step 1</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script language="javascript" src="../js/functions.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
	
	
	function GrantLeaves()
	{
		if($(".chkIds").is(":checked"))
		{
			if(confirm("Are you sure to Duduct Sandwitch Leaves."))
			{
				$("#action").val("GrantLeaves");
				//$("#frmPages").submit();
			}
		}
		else
			alert("Please select Employee to Duduct Sandwitch Leaves");
	}
	
</script>
<!--<script>
$("#bottomMenu").hide();
$(window).scroll(function() {
    if ($(window).scrollTop() > 400) {
        $("#bottomMenu").fadeIn("slow");
    }
    else {
        $("#bottomMenu").fadeOut("fast");
    }
});
</script>-->
<script>
;(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="containerss" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };
})(jQuery);

$(document).ready(function(){
   $("table").fixMe();
   $(".up").click(function() {
      $('html, body').animate({
      scrollTop: 0
   }, 2000);
 });
});
</script>



<script>
  $(function() {
    var availableTags = [
		<?php
		 $query = "SELECT ID,EmpID,FirstName,LastName,Department,Designation FROM employees where Status = 'Active' ORDER BY ID ASC";
		$res = mysql_query($query);
		while($row = mysql_fetch_array($res))
		{
		echo '"'.$row['EmpID'].' | '.$row['FirstName'].' '.$row['LastName'].' ('.$row['Department'].' - '.$row['Designation'].'",';
		} 
		?>
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
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
</style>
</head>
<body class="skin-blue">
<!--<div id="bottomMenu">
<table id="" class="table table-bordered" style="">
                  <thead>
                    <tr>
					  <th style="width:40px !important;">S#</th>
                      <th style="text-align:center; width:30px !important;"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th style=" !important;">Employee</th>
					  <th style="width:98px !important;">Date</th>
					  <th style="width:75px !important;">Time In</th>
                      <th style="width:75px !important;">Time Out</th>
					  <th style="width:78px !important;">Modified<br>Time In</th>
                      <th style="width:79px !important;">Modified<br>Time Out</th>
					  <th style="width:49px !important;">Late<br>Arr</th>
					  <th style="width:52px !important;">Early<br>Dep</th>
					  <th style="width:76px !important;">Working<br>Hours</th>
					  <th style="width:80px !important;">Overtime</th>
					  <th style="width:98px !important;">Modified<br>Remarks</th>
					  <th style="width:78px !important;">Remarks</th>
                    </tr>
                  </thead>
                  </table>
</div>-->
<!-- header logo: style can be found in header.less -->
<?php
	include_once("Header.php");
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
		include_once("Sidebar.php");
?>		
		
<?php
				// $query="SELECT FromDate,NumOfDays,What FROM roster WHERE ID <> 0 ORDER BY FromDate ASC";
				// $result = mysql_query ($query) or die(mysql_error()); 
				// while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				// {
					// $startdate=strtotime($row['FromDate']);
					// for($i=0;$i<$row['NumOfDays'];$i++)
					// {
						// echo '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.date("Y-m-d", $startdate)." | ".$row['What']."<br>";
						// $startdate = strtotime("+1 day", $startdate);
					// }
				// }
				
				$query="SELECT FromDate,NumOfDays,What FROM roster WHERE ID <> 0 ORDER BY FromDate ASC";
				$result = mysql_query ($query) or die(mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
					$startdate=strtotime($row['FromDate']);
					for($i=0;$i<$row['NumOfDays'];$i++)
					{
						$Roster[] = date("Y-m-d", $startdate);
						$startdate = strtotime("+1 day", $startdate);
					}
				}
				sort($Roster);
				$RosterString = implode(',',$Roster);
				
				
				$query="SELECT DISTINCT e.ID,e.CompanyID,c.Name AS Company,e.EmpID,e.FirstName,e.LastName,e.Department,e.Designation,e.LeavesDays,e.SandwichLeaves,e.OvertimePolicy,sh.LateArrival,sh.EarlyDepart,sh.DepartTime AS Depart,sh.Name AS ScheduleName,c.SandwitchDeductions FROM employees e LEFT JOIN schedules sh ON e.ScheduleID = sh.ID LEFT JOIN roster_login_history li ON li.UserID = e.ID  LEFT JOIN roster_logout_history lo ON li.UserID = lo.UserID AND li.DateAdded = lo.DateAdded LEFT JOIN companies c ON e.CompanyID = c.ID WHERE e.Status = 'Active' AND c.SandwitchDeductions <> 'No' AND e.SandwichLeaves <> '' AND li.Status = 'Off Day' AND (li.DateAdded BETWEEN '".$FromDate."' AND '".$TillDate."') ".($CompanyID != "" ? ' AND e.CompanyID = '.$CompanyID.'' : '')." ".($Location != "" ? ' AND e.Location = '.$Location.'' : '')." ".($SortBy != "" ? ' ORDER BY '.$SortBy.',e.EmpID ASC' : '')." ";
				
				$result = mysql_query ($query) or die(mysql_error()); 
				$maxRow = mysql_num_rows($result);
				$self = $_SERVER['PHP_SELF'];
		?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Sandwitch Roster Step 1 <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sandwitch Roster Step 1</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info" style="padding:5px;">
          <br>
            <!-- /.box-header -->
		
			<div class="row margin">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="col-lg-12 col-xs-12">
                           <div class="form-group">
							  <label id="labelimp2" for="Role" >Attendance Filters: </label>
							</div>
                        </div><!-- ./col -->
						<div class="col-lg-4 col-xs-12">
							<div class="form-group">
							From:
							 <input autofocus type="date" name="FromDate" value="<?php echo $FromDate; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
							<div class="form-group">
							Till:
							 <input type="date" name="TillDate" value="<?php echo $TillDate; ?>" class="form-control" />
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-12 no-print">
							<div class="form-group">
							Sort By:
							 <select name="SortBy" id="SortBy" class="form-control">
								<option <?php echo ($SortBy == 'e.EmpID' ? 'selected' : ''); ?> value="e.EmpID">Code</option>
								<option <?php echo ($SortBy == 'e.FirstName' ? 'selected' : ''); ?> value="e.FirstName">Name</option>
								<option <?php echo ($SortBy == 'e.CompanyID' ? 'selected' : ''); ?> value="e.CompanyID">Company</option>
								<option <?php echo ($SortBy == 'e.Location' ? 'selected' : ''); ?> value="e.Location">Location</option>
								<option <?php echo ($SortBy == 'e.Department' ? 'selected' : ''); ?> value="e.Department">Department</option>
								<option <?php echo ($SortBy == 'e.Designation' ? 'selected' : ''); ?> value="e.Designation">Designation</option>
							</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-12">
							<div class="form-group">
							  Company:
							  <select name="CompanyID" id="CompanyID" class="form-control">
								<option value="">All Companies</option>
								<?php
								 $query = "SELECT ID,Name FROM companies where Status = 1 ORDER BY Name ASC";
								$res = mysql_query($query);
								while($row = mysql_fetch_array($res))
								{
								echo '<option '.($CompanyID == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].'</option>';
								} 
								?>
								</select>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-12">
							<div class="form-group">
						  Location:
							<select name="Location" id="Location" class="form-control">
							<option value="" >All Locations</option>
							<?php
							$query = "SELECT l.ID,l.Name,c.Abr FROM locations l LEFT JOIN companies c ON l.CompanyID = c.ID where l.Status = 1 ORDER BY l.Name ASC";
							$res = mysql_query($query);
							while($row = mysql_fetch_array($res))
							{
							echo '<option '.($Location == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['Name'].' | '.$row['Abr'].'</option>';
							} 
							?>
							</select>
						</div>
						</div><!-- ./col -->
						<div class="col-lg-4 col-xs-12 no-print">
                           <div class="form-group">
							  <button type="submit" class="btn btn-block btn-sm btn-success" style="background-color:#428BCA">Apply Filters</button>
							</div> 
                        </div><!-- ./col -->
						
					</form>
					
            </div><!-- /.row -->
			
			<div class="box-footer no-print" style="text-align:right;">
               <!-- <button disabled type="submit" class="btn btn-default margin">Present</button>
				<button disabled type="submit" class="btn btn-danger margin">Absent</button>-->
				<button type="button" onClick="javascript:GrantLeaves()" class="btn btn-success margin no-print">Next Step</button>
				<!--<button disabled type="submit" class="btn bg-navy margin">Cancle Off Day</button>--
				>
                <!--<button class="btn btn-primary margin" type="button" onClick="location.href='Employees.php'">Cancel</button>-->
            </div>
            <div class="box-body table-responsive">
              <?php
			  	echo $msg;
				if(isset($_SESSION["msg"]) && $_SESSION["msg"]!="")
				{
					echo $_SESSION["msg"];
					$_SESSION["msg"]="";
				}
			?>
			
              <form id="frmPages"  method="post" action="<?php echo $self;?>">
                <input type="hidden" name="rpp" value="<?php echo $rowsPerPage; ?>" />
                <input type="hidden" name="PageIndex" value="<?php echo $pageNum; ?>" />
                <input type="hidden" id="action" name="action" value="" />
                
  
                  
		 
              <table class="blue table table-bordered">
                  <thead class="">
                    <tr style="color:white;">
					  <th>S#</th>
                      <th style="text-align:center;"><input type="checkbox" name="chkAll" class="checkUncheckAll"></th>
                      <th>Code</th>
					  <th>Employee</th>
					  <th>Designation</th>
					  <th>Department</th>
					  <th>Company</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
			if($maxRow==0)
			{
		?>
                    <tr class="noPrint">
                      <td colspan="20" align="center" class="error"><b>No Sandwitch Found.</b></td>
                    </tr>
                    <?php 
			}
			else
			{
				?>
				
				<?php
				$i=1;
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
					$query2="SELECT SandwitchDeductions FROM companies WHERE ID = '".$row['CompanyID']."'";
				
					$result2 = mysql_query ($query2) or die(mysql_error()); 
					$maxRow2 = mysql_num_rows($result2);
					if($maxRow2 == 1)
					{
						$row2 = mysql_fetch_array($result2);
						$Absents = explode(',',$row['SandwichLeaves']);
						//rsort($Absents);
						// select ye k employee sandwitch k days mai absent hua hai....
						if($row2['SandwitchDeductions'] == 'OR')
						{
							$query3="SELECT ID,DateAdded,UserID FROM roster_login_history WHERE Status = 'Absent' AND (DateAdded BETWEEN '".$FromDate."' AND '".$TillDate."')  AND UserID = '".$row["ID"]."' ORDER BY DateAdded ASC";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$maxRow3 = mysql_num_rows($result3);
							$date = "";
							$dateArray = array();
							$Check = false;
							if($maxRow3 != 0)
							{
								while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
								{
									$date=date_create($row3['DateAdded']);
									//echo dboutput($row3['DateAdded']).' | '.dboutput($row3['UserID']).' | '.date_format($date,"N").'<br>';
									$dateArray[] = date_format($date,"N");
								}
								// echo $row['ID'].''.$row['FirstName'].'<br>';
								// print_r($Absents);
								// exit();
								foreach($Absents as $Abs)
								{
									if(in_array($Abs, $dateArray))
									{
										$Check = true;
									}
								}
								
								if($Check == true)
								{
								?>
									<tr>
									  <td><?php echo $i; ?></td>
									  <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
										<input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
									  <td style="text-align:left;"><?php echo dboutput($row['EmpID']); ?></td>
									  <td style="text-align:left;"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
									  <td><?php echo dboutput($row['Designation']); ?></td>
									  <td><?php echo dboutput($row['Department']); ?></td>
									  <td><?php echo dboutput($row['Company']); ?></td>
									</tr>
								<?php
								$i++;
								}
							}
						}
						else if($row2['SandwitchDeductions'] == 'AND')
						{
							$query3="SELECT ID,DateAdded,UserID FROM roster_login_history WHERE Status = 'Absent' AND (DateAdded BETWEEN '".$FromDate."' AND '".$TillDate."')  AND UserID = '".$row["ID"]."' ORDER BY DateAdded ASC";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$maxRow3 = mysql_num_rows($result3);
							$date = "";
							$dateArray = array();
							$Check = false;
							if($maxRow3 != 0)
							{
								while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
								{
									$date=date_create($row3['DateAdded']);
									//echo dboutput($row3['DateAdded']).' | '.dboutput($row3['UserID']).' | '.date_format($date,"N").'<br>';
									$dateArray[] = date_format($date,"N");
								}
								
								// echo $row['ID'].''.$row['FirstName'].'<br>';
								// print_r($dateArray);
								// exit();
								
								// print_r($Absents);
								// exit();
								
								$c = 0;
								foreach($dateArray as $dta)
								{
									foreach($Absents as $Abs)
									{
										if($Abs == $dta)
										{
											$c = $c+1;
											if($c == 2)
											{
												$Check = true;
											}
											
										}
										else
										{
											$c = 0;
										}
									}
								}
								
								
								if($Check == true)
								{
								?>
									<tr>
									  <td><?php echo $i; ?></td>
									  <td align="center" class="noPrint"><input class="chkIds" type="checkbox" name="ids[]" value="<?php echo $row["ID"]; ?>" />
										<input type="hidden" name="ids1[]" value="<?php echo $row["ID"]; ?>"></td>
									  <td style="text-align:left;"><?php echo dboutput($row['EmpID']); ?></td>
									  <td style="text-align:left;"><?php echo dboutput($row['FirstName']).' '.dboutput($row['LastName']); ?></td>
									  <td><?php echo dboutput($row['Designation']); ?></td>
									  <td><?php echo dboutput($row['Department']); ?></td>
									  <td><?php echo dboutput($row['Company']); ?></td>
									</tr>
								<?php
								$i++;
								}
							}
						}
					}
					
				}
			} 
		?>
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
