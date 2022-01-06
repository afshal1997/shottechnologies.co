<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<aside class="left-side sidebar-offcanvas" style="background-color:#041421">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
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
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li> <a target="_blank" href="Dashboard.php"> <img src="images/dashboard.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Dashboard" /> </a> </li>
	  
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/employeem.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Employee Management" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="Employees.php"><i class="fa fa-angle-double-right"></i> Employees</a></li>
			<li><a target="_blank" href="Increments.php"><i class="fa fa-angle-double-right"></i> Increments</a></li>
			<!--<li><a href="#"><i class="fa fa-angle-double-right"></i> Promotions</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Demotions</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Warnings</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Increments</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Facilities</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Awards / Rewards</a></li>
			<li><a href="#"><i class="fa fa-angle-double-right"></i> Resignations</a></li>-->
			<li><a target="_blank" href="ExpiredCNIC.php"><i class="fa fa-angle-double-right"></i> Expired CNIC</a></li>
		</ul>
	  </li>
	  <?php } ?>
	 
	 <li class="treeview">
		<a href="#">
			<img src="images/attendancem.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Attendance Management" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="AttendanceLedger.php"><i class="fa fa-angle-double-right"></i> Attendance Ledger</a></li>
			<li><a target="_blank" href="Attendance.php"><i class="fa fa-angle-double-right"></i> My Attendance</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<!--<li><a target="_blank" href="TodaysAttendance.php"><i class="fa fa-angle-double-right"></i> Todays Attendance</a></li>
			<li><a target="_blank" href="EmployeeAttendance.php"><i class="fa fa-angle-double-right"></i> Employees Attendance</a></li>-->
			<?php } ?>
			<li><a target="_blank" href="GetAttendance.php"><i class="fa fa-angle-double-right"></i> Mark Attendance</a></li>
		</ul>
	  </li>
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li>
		<a target="_blank" href="Roster.php">
			<img src="images/rosterm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Attendance Roster" />
		</a>
	  </li>
	  <?php } ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/payrollm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Payroll Management" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="MyPayrolls.php"><i class="fa fa-angle-double-right"></i>My Payrolls</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="Payrolls.php"><i class="fa fa-angle-double-right"></i> Payrolls</a></li>
			<li><a target="_blank" href="SalarySheet.php"><i class="fa fa-angle-double-right"></i> Salary Sheet</a></li>
			<li><a target="_blank" href="PaySlip.php"><i class="fa fa-angle-double-right"></i> Pay Slip</a></li>
			<!--<li><a target="_blank" href="GeneratePayroll.php"><i class="fa fa-angle-double-right"></i> Generate Payroll</a></li>-->
			<!--<li><a target="_blank" href="BasicSalary.php"><i class="fa fa-angle-double-right"></i> Basic Salary</a></li>-->
			<li><a target="_blank" href="Allowances.php"><i class="fa fa-angle-double-right"></i>Fix Allowances</a></li>
			<li><a target="_blank" href="Deductions.php"><i class="fa fa-angle-double-right"></i>Fix Deductions</a></li>
			<li><a target="_blank" href="Rewards.php"><i class="fa fa-angle-double-right"></i> Rewards</a></li>
			<!--<li><a target="_blank" href="AnualBonuses.php"><i class="fa fa-angle-double-right"></i> Anual Bonuses</a></li>
			<li><a target="_blank" href="IndividualBonuses.php"><i class="fa fa-angle-double-right"></i> Individual Bonuses</a></li>
			<li><a target="_blank" href="Deductions.php"><i class="fa fa-angle-double-right"></i> Deductions</a></li>-->
			<li><a target="_blank" href="Commissions.php"><i class="fa fa-angle-double-right"></i> Commissions</a></li>
			<li><a target="_blank" href="Reimbursements.php"><i class="fa fa-angle-double-right"></i> Reimbursements</a></li>
			<!--<li><a target="_blank" href="Overtimes.php"><i class="fa fa-angle-double-right"></i> Overtimes</a></li>-->
			<li><a target="_blank" href="Adjustments.php"><i class="fa fa-angle-double-right"></i> Adjustments</a></li>
			<?php } ?>
		</ul>
	  </li>
	  <li class="treeview">
		<a href="#">
			<img src="images/loansm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Loan & Advance Management" />
		</a>
		<ul class="treeview-menu">
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="Loans.php"><i class="fa fa-angle-double-right"></i> Loans</a></li>
			<!--<li><a target="_blank" href="ManualLoanRequest.php"><i class="fa fa-angle-double-right"></i> Manual Loan Request</a></li>-->
			<li><a target="_blank" href="LoanRequests.php"><i class="fa fa-angle-double-right"></i> Loan Requests</a></li>
			<li><a target="_blank" href="LoanManualRecoveries.php"><i class="fa fa-angle-double-right"></i> Loan Manual Recovery</a></li>
			<?php } ?>
			<li><a target="_blank" href="MyLoans.php"><i class="fa fa-angle-double-right"></i> My Loans</a></li>
			<li><a target="_blank" href="MyLoanRequests.php"><i class="fa fa-angle-double-right"></i> My Loan Requests</a></li>
			<li><a target="_blank" href="GetLoan.php"><i class="fa fa-angle-double-right"></i> Get a Loan</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="Advances.php"><i class="fa fa-angle-double-right"></i> Advances</a></li>
			<!--<li><a target="_blank" href="ManualAdvanceRequest.php"><i class="fa fa-angle-double-right"></i> Manual Advance Request</a></li>-->
			<li><a target="_blank" href="AdvanceRequests.php"><i class="fa fa-angle-double-right"></i> Advance Requests</a></li>
			<?php } ?>
			<li><a target="_blank" href="MyAdvanceRequests.php"><i class="fa fa-angle-double-right"></i> My Advance Requests</a></li>
			<li><a target="_blank" href="GetAdvance.php"><i class="fa fa-angle-double-right"></i> Get an Advance</a></li>
		</ul>
	  </li>
	  <!--<li class="treeview">
		<a href="#">
			<img src="images/documentsm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Documents Management" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="Documents.php"><i class="fa fa-angle-double-right"></i>My Documents</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="EmployeeDocuments.php"><i class="fa fa-angle-double-right"></i>Employees Documents</a></li>
			<?php } ?>
		</ul>
	  </li>-->
	  <li class="treeview">
		<a href="#">
			<img src="images/leavesm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Leaves Management" />
		</a>
		<ul class="treeview-menu">
		 <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="LeavesQuota.php"><i class="fa fa-angle-double-right"></i> Assign Leaves Quota</a></li>
			<li><a target="_blank" href="EmployeesCurrentQuota.php"><i class="fa fa-angle-double-right"></i> Employees Quota</a></li>
			<li><a target="_blank" href="LeaveRequests.php"><i class="fa fa-angle-double-right"></i> Leave Requests</a></li>
			<li><a target="_blank" href="GazettedHolidays.php"><i class="fa fa-angle-double-right"></i> Gazetted Holidays</a></li>
			<?php } ?>
			<li><a target="_blank" href="CurrentQuota.php"><i class="fa fa-angle-double-right"></i> My Current Quota</a></li>
			<li><a target="_blank" href="GetLeave.php"><i class="fa fa-angle-double-right"></i> Get a Leave</a></li>
		</ul>
	  </li>
	 <!-- <li class="treeview">
		<a href="#">
			<img src="images/eventsm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Events Management" />
		</a>
		<ul class="treeview-menu">
		<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="Events.php"><i class="fa fa-angle-double-right"></i> Events</a></li>
			<?php } ?>
			<li><a target="_blank" href="EventsCalendar.php"><i class="fa fa-angle-double-right"></i> Events Calendar</a></li>
		</ul>
	  </li>
	  <li class="treeview">
		<a href="#">
			<img src="images/trainingsm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Trainings Management" />
		</a>
		<ul class="treeview-menu">
		<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="Trainings.php"><i class="fa fa-angle-double-right"></i> Assign Trainings</a></li>
			<?php } ?>
			<li><a target="_blank" href="TrainingsCalendar.php"><i class="fa fa-angle-double-right"></i> Trainings Calendar</a></li>
			<?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="TestBuilder.php"><i class="fa fa-angle-double-right"></i> Test Builder</a></li>
			<li><a target="_blank" href="EmployeeResults.php"><i class="fa fa-angle-double-right"></i> Employees Results</a></li>
			<?php } ?>
			<li><a target="_blank" href="MyTrainings.php"><i class="fa fa-angle-double-right"></i> My Trainings</a></li>
			<li><a target="_blank" href="MyTrainingResults.php"><i class="fa fa-angle-double-right"></i> My Training Results</a></li>
			<li><a target="_blank" href="InMySupervision.php"><i class="fa fa-angle-double-right"></i> In My Supervision</a></li>
		</ul>
	  </li>
	  <?php if($_SESSION['RoleID'] == 'HR' OR $_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/jobsm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Jobs Management" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="Career.php"><i class="fa fa-angle-double-right"></i> Career Form</a></li>
			<li><a target="_blank" href="JobPosts.php"><i class="fa fa-angle-double-right"></i> Job Posts</a></li>
			<li><a target="_blank" href="Resumes.php"><i class="fa fa-angle-double-right"></i> Resumes</a></li>
			<li><a target="_blank" href="Candidates.php"><i class="fa fa-angle-double-right"></i> Job Candidates</a></li>
			<li><a target="_blank" href="Interviews.php"><i class="fa fa-angle-double-right"></i> Interviews Scheduled</a></li>
			<li><a target="_blank" href="InterviewsCalendar.php"><i class="fa fa-angle-double-right"></i> Interviews Calendar</a></li>
			<li><a target="_blank" href="ShortlistCandidates.php"><i class="fa fa-angle-double-right"></i> Shortlist Candidates</a></li>
			<li><a target="_blank" href="DisqualifiedCandidates.php"><i class="fa fa-angle-double-right"></i> Disqualified Candidates</a></li>
		</ul>
	  </li>
	  <?php } ?>
	  <li class="treeview">
		<a href="#">
			<img src="images/whistleblowm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Whistle Blow" />
		</a>
		<ul class="treeview-menu">
		<?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
			<li><a target="_blank" href="AuthorizedEmployees.php"><i class="fa fa-angle-double-right"></i> Authorized Employees</a></li>
		<?php } ?>
			<li><a target="_blank" href="ComposeMessage.php"><i class="fa fa-angle-double-right"></i> Compose Message</a></li>
			<li><a target="_blank" href="Inbox.php"><i class="fa fa-angle-double-right"></i> Inbox <?php echo ($_SESSION['RecMsg'] <> 0 ? ' <small class=" badge pull-right bg-green">'.$_SESSION['RecMsg'].' New</small>' : ''); ?></a></li>
			<li><a target="_blank" href="Outbox.php"><i class="fa fa-angle-double-right"></i> Outbox</a></li>
		</ul>
	  </li>
	  <!--
	  <li style="background-color:orange" class="treeview">
		<a href="#">
			<i class="faa-pulse animated fa fa-pie-chart"></i>
			<span>Reports</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			
		</ul>
	  </li>-->
	  <?php if($_SESSION['RoleID'] == 'Administrator'){ ?>
	  <li> <a target="_blank" href="Dashboard.php"> <img src="images/securitym.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Security Management" /> </a> </li>
	  <li class="treeview">
		<a href="#">
			<img src="images/orgsetm.png" data-widget="collapse" data-placement="right" data-toggle="tooltip" title="Organization Settings" />
		</a>
		<ul class="treeview-menu">
			<li><a target="_blank" href="OrganizationSettings.php"><i class="fa fa-angle-double-right"></i> Organization Settings</a></li>
			<li><a target="_blank" href="Companies.php"><i class="fa fa-angle-double-right"></i> Companies</a></li>
			<li><a target="_blank" href="Locations.php"><i class="fa fa-angle-double-right"></i> Locations</a></li>
			<li><a target="_blank" href="Schedules.php"><i class="fa fa-angle-double-right"></i> Time Schedules</a></li>
			<li><a target="_blank" href="OvertimePolicies.php"><i class="fa fa-angle-double-right"></i> Overtime Policies</a></li>
			<li><a target="_blank" href="LoanTypes.php"><i class="fa fa-angle-double-right"></i> Loan Types</a></li>
			<li><a target="_blank" href="AllowanceTypes.php"><i class="fa fa-angle-double-right"></i> Allowance Types</a></li>
			<li><a target="_blank" href="DeductionTypes.php"><i class="fa fa-angle-double-right"></i> Deduction Types</a></li>
			<li><a target="_blank" href="AdjustmentTypes.php"><i class="fa fa-angle-double-right"></i> Adjustment Types</a></li>
			<li><a target="_blank" href="Taxes.php"><i class="fa fa-angle-double-right"></i> Tax</a></li>
			<li><a target="_blank" href="ProvidentFunds.php"><i class="fa fa-angle-double-right"></i> Provident Fund</a></li>
			<li><a target="_blank" href="Institutes.php"><i class="fa fa-angle-double-right"></i> Institutes / Universities</a></li>	
			<li><a target="_blank" href="Banks.php"><i class="fa fa-angle-double-right"></i> Banks</a></li>
			<li><a target="_blank" href="Grades.php"><i class="fa fa-angle-double-right"></i> Grades</a></li>
			<li><a target="_blank" href="Departments.php"><i class="fa fa-angle-double-right"></i> Departments</a></li>
			<li><a target="_blank" href="Designations.php"><i class="fa fa-angle-double-right"></i> Designations</a></li>
		</ul>
	  </li>
	  <?php } ?>
	  
	 
    </ul>
  </section>

  <!-- /.sidebar -->
</aside>
