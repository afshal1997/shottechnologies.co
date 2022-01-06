<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet" type="text/css" />
<?php
	$query = "SELECT * FROM developer";
	$res = mysql_query($query);
	while($row = mysql_fetch_assoc($res))
	{
		$nav_upper_gradient = $row['front_nav_color'];
		$nav_lower_gradient = $row['front_nav_gradient'];
		$side_upper_gradient = $row['developer_nav_gradient'];
		$side_lower_gradient = $row['developer_nav_color'];
		$sidebar_button = $row['sidebar_button'];
	} 
?>
<style>
    .skin-blue .sidebar a,.sidebar-menu .user-info,body > .header .logo {
        background: linear-gradient(<?php echo $side_upper_gradient; ?>, <?php echo $side_lower_gradient; ?>) !important;
    }
</style>
<aside class="left-side sidebar-offcanvas" style="background:linear-gradient(<?php echo $side_upper_gradient; ?>, <?php echo $side_lower_gradient; ?>);height: 100% !important;min-height:0px !important">
    
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <script>
// 	$(function(){
// 	var sidebar = $('.sidebar-menu'); 

// 	sidebar.delegate('.treeview','click',function(){ 
// 	   if($(this).hasClass('active')){
// 		$(this).removeClass('active');
// 		sidebar.find('.inactive > .treeview-menu').hide(200);
// 		sidebar.find('.inactive').removeClass('inactive');
// 	    $(this).addClass('inactive');
// 	    $(this).find('.treeview-menu').show(200);
// 	  }else{
// 	   sidebar.find('.active').addClass('inactive');          
// 	   sidebar.find('.active').removeClass('active'); 
// 	    $(this).Class('treeview-menu').hide(200);
// 	  }
// 	});

// 	});
	
// 	$(document).click(function (event) {   
//     $('.treeview-menu:visible').hide();
// 	});

	</script>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="user-info">
            <span><img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION["Photo"] : 'images/profile.png'); ?>" class="img-circle" alt="" /> </span>
            <span><?php echo $_SESSION["UserFullName"]; ?>
                <p class="status">Online</p>
            </span>
        </li>
      <li> <a href="Dashboard.php"> 
      <img src="images/dashboard-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
      <span class="sidetab-title">Dashboard</span>
      </a> 
      </li>
	  
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/employeem-1.png" data-widget="collapse" data-toggle="tooltip"/>
			<span class="sidetab-title">Employees</span>
		</a>
		<ul class="treeview-menu one">
		    <li class="treeview-menu-title">Employees</li>
			<?php if($_SESSION['UserID'] == 438){ ?>
			<!--<li><a href="EmployeesSearch.php"><i class="fa fa-angle-double-right"></i> Employees Search</a></li>-->
			<?php } ?>
			
			<li><a href="Employees.php"><i class="fa fa-angle-double-right"></i> Employees</a></li>
			<li><a href="EmployeesReport.php"><i class="fa fa-angle-double-right"></i> Employees Report</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Increments.php"><i class="fa fa-angle-double-right"></i> Increments</a></li>
			<li><a href="FullnFinal.php"><i class="fa fa-angle-double-right"></i> Full n Final</a></li>
			<!--<li><a href="#"><i class="fa fa-angle-double-right"></i> Promotions</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Demotions</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Warnings</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Facilities</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Awards / Rewards</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Resignations</a></li>-->
			<!--<li><a href="ExpiredCNIC.php"><i class="fa fa-angle-double-right"></i> Expired CNIC</a></li>-->
			<?php } ?>
		</ul>
	  </li>
	  <?php } ?>
	  
	  <li class="treeview" >
		<a href="#">
			<img src="images/perapi-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Performance Appraisal</span>
		</a>
		<ul class="treeview-menu one">
		    <li class="treeview-menu-title">Performance Appraisal</li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="KPI.php"><i class="fa fa-angle-double-right"></i> KPI Builder</a></li>
			<li><a href="RateAnalysis.php"><i class="fa fa-angle-double-right"></i> Rate Analysis</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Appraisals.php"><i class="fa fa-angle-double-right"></i> Assign Appraisal</a></li>
			<?php } ?>
			<li><a href="AppraisalsCalendar.php"><i class="fa fa-angle-double-right"></i> Appraisal Calendar</a></li>
			<li><a href="MyAppraisals.php"><i class="fa fa-angle-double-right"></i> My Appraisals</a></li>
			<li><a href="MyAppraisalResults.php"><i class="fa fa-angle-double-right"></i> My Appraisal Results</a></li>
			<li><a href="InMySupervisionAppraisals.php"><i class="fa fa-angle-double-right"></i> In My Supervision</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="AppraisalReports.php"><i class="fa fa-angle-double-right"></i> Appraisal Report</a></li>
			<?php } ?>
		</ul>
	  </li>
	 
	 <li class="treeview">
		<a href="#">
			<img src="images/attendancem-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Employees Attendance</span>
		</a>
		<ul class="treeview-menu one">
		    <li class="treeview-menu-title">Employees Attendance</li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'  OR $_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="AttendanceLedger.php"><i class="fa fa-angle-double-right"></i> Attendance Ledger</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<!--<li><a href="AttendanceReport.php"><i class="fa fa-angle-double-right"></i> Attendance Report</a></li>-->
			<!--<li><a href="LeaveAdjustRequests.php"><i class="fa fa-angle-double-right"></i> Leave Adjust Requests</a></li>-->
			<!--<li><a href="ManualAttendanceCSV.php"><i class="fa fa-angle-double-right"></i> Manual Attendance</a></li>-->
			<?php } ?>
			<?php } ?>
			<li><a href="TodaysAttendance.php"><i class="fa fa-angle-double-right"></i> Todays Attendance</a></li>
			<li><a href="MyTimeAdjustRequests.php"><i class="fa fa-angle-double-right"></i> My Time Adjust Requests</a></li>
			<li><a href="TimeAdjustRequests.php"><i class="fa fa-angle-double-right"></i> Time Adjust Requests</a></li>
			<!--<li><a href="MyLeaveAdjustRequests.php"><i class="fa fa-angle-double-right"></i> My Leave Adjust Requests</a></li>-->
			<li><a href="MyAttendanceLedger.php"><i class="fa fa-angle-double-right"></i> My Attendance</a></li>
			<li><a href="GetAttendanceLatest.php"><i class="fa fa-angle-double-right"></i> Mark Attendance</a></li>
		</ul>
	  </li>
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/rosterm-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top" />
			<span class="sidetab-title">Roster Generation</span>
		</a>
		<ul class="treeview-menu two">
		    <li class="treeview-menu-title">Roster Generation</li>
			<li><a href="Roster.php"><i class="fa fa-angle-double-right"></i>Attendance Roster</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<!--<li><a href="SandwitchRoster.php"><i class="fa fa-angle-double-right"></i>Sandwitch Roster</a></li>-->
			<li><a href="LoanRoster.php"><i class="fa fa-angle-double-right"></i>Loan Roster</a></li>
			<?php } ?>
		</ul>
	  </li>
	  <?php } ?>
	  <li class="treeview" >
		<a href="#">
			<img src="images/payrollm-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Payroll & Bonus</span>
		</a>
		<ul class="treeview-menu two">
		    <li class="treeview-menu-title">Payroll & Bonus</li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['UserID'] == 113){ ?>
			<li><a href="ReconciliationReports.php"><i class="fa fa-angle-double-right"></i>Reconciliation Report</a></li>
			<li><a href="ContributionInvestmentReport.php"><i class="fa fa-angle-double-right"></i>Contribution Investment Report</a></li>
			<li><a href="PayrollReports.php"><i class="fa fa-angle-double-right"></i>Payroll Reports</a></li>
			<li><a href="Payrolls.php"><i class="fa fa-angle-double-right"></i>Payrolls</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Accounts'){ ?>
			<li><a href="ReconciliationReports.php"><i class="fa fa-angle-double-right"></i>Reconciliation Report</a></li>
			<li><a href="ContributionInvestmentReport.php"><i class="fa fa-angle-double-right"></i>Contribution Investment Report</a></li>
			<li><a href="PayrollReports.php"><i class="fa fa-angle-double-right"></i>Payroll Reports</a></li>
			<li><a href="PayrollsAccounts.php"><i class="fa fa-angle-double-right"></i>Payrolls</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="ReconciliationReports.php"><i class="fa fa-angle-double-right"></i>Reconciliation Report</a></li>
			<li><a href="ContributionInvestmentReport.php"><i class="fa fa-angle-double-right"></i>Contribution Investment Report</a></li>
			<li><a href="PayrollReports.php"><i class="fa fa-angle-double-right"></i>Payroll Reports</a></li>
			<li><a href="PayrollsAudit.php"><i class="fa fa-angle-double-right"></i>Payrolls</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="Allowances.php"><i class="fa fa-angle-double-right"></i>Fix Allowances</a></li>
			<li><a href="Deductions.php"><i class="fa fa-angle-double-right"></i>Fix Deductions</a></li>
			<li><a href="Adjustments.php"><i class="fa fa-angle-double-right"></i>Adjustments</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Bonus.php"><i class="fa fa-angle-double-right"></i>Bonus</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Accounts'){ ?>
			<li><a href="BonusAccounts.php"><i class="fa fa-angle-double-right"></i>Bonus</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="BonusAudit.php"><i class="fa fa-angle-double-right"></i>Bonus</a></li>
			<?php } ?>
			<li><a href="MyPaySlips.php"><i class="fa fa-angle-double-right"></i>My PaySlips</a></li>
			<li><a href="MyBonusPaySlips.php"><i class="fa fa-angle-double-right"></i>My Bonus PaySlips</a></li>
		</ul>
	  </li>
	  <li class="treeview" >
		<a href="#">
			<img src="images/loansm-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Loan & Advance</span>
		</a>
		<ul class="treeview-menu two">
		    <li class="treeview-menu-title">Loan & Advance</li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit' OR $_SESSION['UserID'] == 113 OR $_SESSION['UserID'] == 81 OR $_SESSION['UserID'] == 399 OR $_SESSION['UserID'] == 369 OR $_SESSION['UserID'] == 231 OR $_SESSION['UserID'] == 192 OR $_SESSION['UserID'] == 190 OR $_SESSION['UserID'] == 448 OR $_SESSION['UserID'] == 263 OR $_SESSION['UserID'] == 419 OR $_SESSION['UserID'] == 463){ ?>
			<li><a href="LoanReports.php"><i class="fa fa-angle-double-right"></i> Loan Report</a></li>
			<li><a href="LoanScheduleReports.php"><i class="fa fa-angle-double-right"></i> Loan Schedule Report</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="Loans.php"><i class="fa fa-angle-double-right"></i> Loans</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="LoanRequests.php"><i class="fa fa-angle-double-right"></i> Loan Requests</a></li>
			<li><a href="LoanManualRecoveries.php"><i class="fa fa-angle-double-right"></i> Loan Manual Recovery</a></li>
			<?php } ?>
			<?php } ?>
			<li><a href="MyLoans.php"><i class="fa fa-angle-double-right"></i> My Loans</a></li>
			<li><a href="MyLoanRequests.php"><i class="fa fa-angle-double-right"></i> My Loan Requests</a></li>
			<li><a href="GetLoan.php"><i class="fa fa-angle-double-right"></i> Apply for Loan</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit' OR $_SESSION['UserID'] == 113 OR $_SESSION['UserID'] == 81 OR $_SESSION['UserID'] == 399 OR $_SESSION['UserID'] == 369 OR $_SESSION['UserID'] == 231 OR $_SESSION['UserID'] == 192 OR $_SESSION['UserID'] == 190 OR $_SESSION['UserID'] == 448 OR $_SESSION['UserID'] == 263 OR $_SESSION['UserID'] == 419 OR $_SESSION['UserID'] == 463){ ?>
			<li><a href="AdvanceReports.php"><i class="fa fa-angle-double-right"></i> Advance Report</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="Advances.php"><i class="fa fa-angle-double-right"></i> Advances</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="AdvanceRequests.php"><i class="fa fa-angle-double-right"></i> Advance Requests</a></li>
			<?php } ?>
			<?php } ?>
			<li><a href="MyAdvances.php"><i class="fa fa-angle-double-right"></i> My Advances</a></li>
			<li><a href="MyAdvanceRequests.php"><i class="fa fa-angle-double-right"></i> My Advance Requests</a></li>
			<li><a href="GetAdvance.php"><i class="fa fa-angle-double-right"></i> Apply for Advance</a></li>
		</ul>
	  </li>
	  <li class="treeview">
		<a href="#">
			<img src="images/documentsm-1.png" data-widget="collapse" data-placement="top" data-toggle="tooltip"/>
			<span class="sidetab-title">Files & Documents</span>
		</a>
		<ul class="treeview-menu three">
		    <li class="treeview-menu-title">Files & Documents</li>
			<li><a href="Documents.php"><i class="fa fa-angle-double-right"></i>My Documents</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="EmployeeDocuments.php"><i class="fa fa-angle-double-right"></i>Employees Documents</a></li>
			<?php } ?>
		</ul>
	  </li>
	  <li class="treeview" >
		<a href="#">
			<img src="images/leavesm-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Leaves & Encashment</span>
		</a>
		<ul class="treeview-menu three">
		    <li class="treeview-menu-title">Leaves & Encashment</li>
		 <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit'){ ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="LeavesQuota.php"><i class="fa fa-angle-double-right"></i> Assign Leaves Quota</a></li>
			<?php } ?>
			<li><a href="Leaves.php"><i class="fa fa-angle-double-right"></i> Leaves</a></li>
			<li><a href="WriteOffLeaves.php"><i class="fa fa-angle-double-right"></i> Writeoff Leaves</a></li>
			<li><a href="GrantLeaves.php"><i class="fa fa-angle-double-right"></i> Grant Leaves</a></li>
			<li><a href="EmployeesCurrentQuota.php"><i class="fa fa-angle-double-right"></i> Employees Quota</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="LeaveRequests.php"><i class="fa fa-angle-double-right"></i> Leave Requests</a></li>
			<?php } ?>
			<li><a href="CurrentQuota.php"><i class="fa fa-angle-double-right"></i> My Current Quota</a></li>
			<li><a href="GetLeave.php"><i class="fa fa-angle-double-right"></i> Apply for Leave</a></li>
			
			
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="EmployeesLeaveQuotaReport.php"><i class="fa fa-angle-double-right"></i> Leaves Quota Report</a></li>
			<li><a href="LeaveEncashments.php"><i class="fa fa-angle-double-right"></i>Leave Encashments</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Accounts'){ ?>
			<li><a href="LeaveEncashmentsAccounts.php"><i class="fa fa-angle-double-right"></i>Leave Encashments</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Audit'){ ?>
			<li><a href="EmployeesLeaveQuotaReport.php"><i class="fa fa-angle-double-right"></i> Leaves Quota Report</a></li>
			<li><a href="LeaveEncashmentsAudit.php"><i class="fa fa-angle-double-right"></i>Leave Encashments</a></li>
			<?php } ?>
			<li><a href="MyEncashmentPaySlips.php"><i class="fa fa-angle-double-right"></i>My Encashment PaySlips</a></li>
		</ul>
	  </li>
	  <li class="treeview">
		<a href="#">
			<img src="images/eventsm-1.png" data-widget="collapse" data-placement="top" data-toggle="tooltip"/>
			<span class="sidetab-title">Company Events</span>
		</a>
		<ul class="treeview-menu four">
		    <li class="treeview-menu-title">Company Events</li>
		<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Events.php"><i class="fa fa-angle-double-right"></i> Events</a></li>
			<?php } ?>
			<li><a href="EventsCalendar.php"><i class="fa fa-angle-double-right"></i> Events Calendar</a></li>
		</ul>
	  </li>
	  <li class="treeview" >
		<a href="#">
			<img src="images/trainingsm-1.png" data-widget="collapse" data-placement="top" data-toggle="tooltip"/>
			<span class="sidetab-title">Employees Trainings</span>
		</a>
		<ul class="treeview-menu five">
		    <li class="treeview-menu-title">Employees Trainings</li>
		<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Trainings.php"><i class="fa fa-angle-double-right"></i> Assign Trainings</a></li>
			<?php } ?>
			<li><a href="TrainingsCalendar.php"><i class="fa fa-angle-double-right"></i> Trainings Calendar</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="TestBuilder.php"><i class="fa fa-angle-double-right"></i> Test Builder</a></li>
			<li><a href="EmployeeResults.php"><i class="fa fa-angle-double-right"></i> Employees Results</a></li>
			<?php } ?>
			<li><a href="MyTrainings.php"><i class="fa fa-angle-double-right"></i> My Trainings</a></li>
			<li><a href="MyTrainingResults.php"><i class="fa fa-angle-double-right"></i> My Training Results</a></li>
			<li><a href="InMySupervision.php"><i class="fa fa-angle-double-right"></i> In My Supervision</a></li>
		</ul>
	  </li>
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li class="treeview" >
		<a href="#">
			<img src="images/jobsm-1.png" data-widget="collapse" data-placement="top" data-toggle="tooltip" />
			<span class="sidetab-title">Hiring & Recruitment</span>
		</a>
		<ul class="treeview-menu five">
		    <li class="treeview-menu-title">Hiring & Recruitment</li>
			<li><a href="Career.php"><i class="fa fa-angle-double-right"></i> Career Form</a></li>
			<li><a href="JobPosts.php"><i class="fa fa-angle-double-right"></i> Job Posts</a></li>
			<li><a href="Resumes.php"><i class="fa fa-angle-double-right"></i> Resumes</a></li>
			<li><a href="Candidates.php"><i class="fa fa-angle-double-right"></i> Job Candidates</a></li>
			<li><a href="Interviews.php"><i class="fa fa-angle-double-right"></i> Interviews Scheduled</a></li>
			<li><a href="InterviewsCalendar.php"><i class="fa fa-angle-double-right"></i> Interviews Calendar</a></li>
			<li><a href="ShortlistCandidates.php"><i class="fa fa-angle-double-right"></i> Shortlist Candidates</a></li>
			<li><a href="DisqualifiedCandidates.php"><i class="fa fa-angle-double-right"></i> Disqualified Candidates</a></li>
		</ul>
	  </li>
	  <?php } ?>
      <li> <a href="kanban.php"> 
      <img src="images/dashboard-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
      <span class="sidetab-title">Kanban</span>
      </a> 
      </li>
      <li class="treeview" >
		<a href="#">
			<img src="images/perapi-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Requests Desk</span>
		</a>
		<ul class="treeview-menu one">
            
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			    <li><a href="RequestsDesk.php"><i class="fa fa-angle-double-right"></i> All Requests</a></li>
			    <li><a href="MyRequestsToMe.php"><i class="fa fa-angle-double-right"></i> Assigned To Me</a></li>
			<?php } else if($_SESSION['RoleID'] !== 'Employee'){ ?>
			    <li><a href="MyRequestsToMe.php"><i class="fa fa-angle-double-right"></i> Assigned To Me</a></li>
			<?php }   ?>
			<?php if($_SESSION['RoleID'] == 'Employee'){ ?>
    			<li><a href="MyRequestsByMe.php"><i class="fa fa-angle-double-right"></i> My Requests</a></li>
			<?php } ?>
		</ul>
	  </li>
	  
	  
	  <li class="treeview" >
		<a href="#">
			<img src="images/perapi-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Onboarding</span>
		</a>
		<ul class="treeview-menu one">
            
			<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
			    <li><a href="Onboarding.php"><i class="fa fa-angle-double-right"></i>Settings</a></li>
			    <li><a href="OnboardingEmployees.php"><i class="fa fa-angle-double-right"></i>Employee Onboarding</a></li>
		    <?php } ?>
		</ul>
	  </li>
	  
	  <?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li class="treeview" >
		<a href="#">
			<img src="images/perapi-1.png" data-widget="collapse" data-toggle="tooltip" data-placement="top"/>
			<span class="sidetab-title">Survey</span>
		</a>
		<ul class="treeview-menu one">
                <li><a href="Surveys.php"><i class="fa fa-angle-double-right"></i>Forms</a></li>                
			    <li><a href="SurveysSettings.php"><i class="fa fa-angle-double-right"></i>Settings</a></li>
		</ul>
	  </li>
	  <?php } ?>

	 <!-- <li class="treeview">
		<a href="#">
			<img src="images/whistleblowm.png" data-widget="collapse" data-placement="top" data-toggle="tooltip" title="Whistle Blow" />
		</a>
		<ul class="treeview-menu">
		<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="AuthorizedEmployees.php"><i class="fa fa-angle-double-right"></i> Authorized Employees</a></li>
		<?php } ?>
			<li><a href="ComposeMessage.php"><i class="fa fa-angle-double-right"></i> Compose Message</a></li>
			<li><a href="Inbox.php"><i class="fa fa-angle-double-right"></i> Inbox <?php echo ($_SESSION['RecMsg'] <> 0 ? ' <small class=" badge pull-right bg-green">'.$_SESSION['RecMsg'].' New</small>' : ''); ?></a></li>
			<li><a href="Outbox.php"><i class="fa fa-angle-double-right"></i> Outbox</a></li>
		</ul>
	  </li>
	  <?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/securitym.png" data-widget="collapse" data-placement="top" data-toggle="tooltip" title="Security Management" />
		</a>
		<ul class="treeview-menu">
			<li><a href="SecurityAccounts.php"><i class="fa fa-angle-double-right"></i>Employees Security Accounts</a></li>
			<li><a href="ExternalAccounts.php"><i class="fa fa-angle-double-right"></i>External Security Accounts</a></li>
		</ul>
	  </li>-->
	  <?php } ?>
	   <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'Audit' OR user_authentication($_SESSION['UserID'],'OrgIcon') OR external_user_authentication($_SESSION['UserID'],'OrgIcon')){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/orgsetm-1.png" data-widget="collapse" data-placement="top" data-toggle="tooltip" />
			<span class="sidetab-title">Settings</span>
		</a>
		<ul class="treeview-menu five">
		    <li class="treeview-menu-title">Settings</li>
			<?php if($_SESSION['RoleID'] == 'Administrator' OR user_authentication($_SESSION['UserID'],'OrgExeCopmany') OR external_user_authentication($_SESSION['UserID'],'OrgExeCopmany')){ ?>
			<li><a href="Companies.php"><i class="fa fa-angle-double-right"></i> Companies</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR'){ ?>
			<li><a href="Locations.php"><i class="fa fa-angle-double-right"></i> Locations</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a href="Schedules.php"><i class="fa fa-angle-double-right"></i> Time Schedules</a></li>
			<li><a href="OvertimePolicies.php"><i class="fa fa-angle-double-right"></i> Overtime Policies</a></li>
			<li><a href="LoanTypes.php"><i class="fa fa-angle-double-right"></i> Loan Types</a></li>
			<li><a href="AllowanceTypes.php"><i class="fa fa-angle-double-right"></i> Allowance Types</a></li>
			<li><a href="DeductionTypes.php"><i class="fa fa-angle-double-right"></i> Deduction Types</a></li>
			<li><a href="AdjustmentTypes.php"><i class="fa fa-angle-double-right"></i> Adjustment Types</a></li>
			<!--<li><a href="Taxes.php"><i class="fa fa-angle-double-right"></i> Tax</a></li>
			<li><a href="ProvidentFunds.php"><i class="fa fa-angle-double-right"></i> Provident Fund</a></li>-->
			<li><a href="Institutes.php"><i class="fa fa-angle-double-right"></i> Institutes / Universities</a></li>	
			<li><a href="Banks.php"><i class="fa fa-angle-double-right"></i> Banks</a></li>
			<li><a href="Grades.php"><i class="fa fa-angle-double-right"></i> Grades</a></li>
			<li><a href="Departments.php"><i class="fa fa-angle-double-right"></i> Departments</a></li>
			<li><a href="SubDepartments.php"><i class="fa fa-angle-double-right"></i> Sub Departments</a></li>
			<li><a href="BusinessUnits.php"><i class="fa fa-angle-double-right"></i> Business Units</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Administrator' OR $_SESSION['RoleID'] == 'HR'){ ?>
			<li><a href="Designations.php"><i class="fa fa-angle-double-right"></i> Designations</a></li>
			<li><a href="developer.php"><i class="fa fa-angle-double-right"></i> Developer</a></li>
			<?php } ?>
			<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
			<!--<li><a style="cursor:pointer" onClick="javascript:doBackup()"><i class="fa fa-angle-double-right"></i> Database Backup</a></li>-->
			<!--<form id="backupfrm" method="post" action="<?php echo $self;?>">-->
			<!--<input type="hidden" id="DBbackup" name="DBbackup" value="" />-->
			<!--</form>-->
			<?php } ?>
		</ul>
	  </li>
	  <?php } ?>
	  
	 
    </ul>
  </section>

  <!-- /.sidebar -->
</aside>
<script language="javascript">
	function doBackup()
	{
		if(confirm("Are you sure to get backup."))
		{
			$("#DBbackup").val("BackUp");
			$("#backupfrm").submit();
		}
	}
	function UnAuthorized()
	{
		alert('You Don\'t have enough Rights to Proceed this Option.')
	}
</script>
