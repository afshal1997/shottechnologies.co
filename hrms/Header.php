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
    body > .header .navbar {
        background: linear-gradient(<?php echo $nav_upper_gradient; ?>, <?php echo $nav_lower_gradient; ?>);
    }
</style>
<header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="Dashboard.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="images/logo.png" style="width:80%;" />
            </a>
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                          <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                
                               <!-- font Awesome -->
                                        <small id="clockdisp"> <?php 

$datetime = new DateTime(null, new DateTimeZone('GMT'));
$datetime->modify('+5 hours');
echo $datetime->format('l jS M Y');																				
// $h = "5";
// $hm = $h * 60; 
// $ms = $hm * 60;
// $gmdate = gmdate("l jS M Y", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
// echo $gmdate;

//Loan Complete Query Start
$queryLoanRunning="UPDATE loans SET Status = 0 WHERE RemainingAmount > 0.1 AND Status <> 2";
mysql_query ($queryLoanRunning) or die(mysql_error()); 
$queryLoanComplete="UPDATE loans SET DateCompleted = NOW(),Status = 1 WHERE RemainingAmount < 0.1 AND Status <> 1";
mysql_query ($queryLoanComplete) or die(mysql_error()); 
$queryLoanCompleteAgain="UPDATE loans SET DateCompleted = NOW(),Status = 1 WHERE RemainingAmount < 0.1 AND Status = 1 AND DateCompleted = '0000-00-00'";
mysql_query ($queryLoanCompleteAgain) or die(mysql_error()); 
//Loan Complete Query End

$query5="SELECT ID,IsCheck FROM messages2 WHERE IsCheck=0 AND FIND_IN_SET ('".$_SESSION['UserID']."' ,Receivers) ";
$result5 = mysql_query ($query5) or die(mysql_error()); 
$num5 = mysql_num_rows($result5);
if($num5==0)
{
$_SESSION["RecMsg"]=0;				
}
else
{
$_SESSION["RecMsg"]=$num5;
}

?> </small>
                            </a>

                        </li>
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span><img height="30" style="margin-top:-6px" src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION["Photo"] : 'images/avatar.png'); ?>" class="img-circle" alt="" /> <?php echo $_SESSION["UserFullName"]; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION["Photo"] : 'images/avatar.png'); ?>" class="img-circle" alt="" />
                                    <p>
                                         <?php echo $_SESSION["UserFullName"]; ?><br>
										 <small>
										 <?php echo $_SESSION["RoleID"]; ?>
										 </small>
                                        <small>Member since <?php echo $_SESSION["JoinDate"]; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body 
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div style="float:left">
                                        <!--<a href="EmployeeProfile.php" class="btn btn-default btn-flat">Profile</a>-->
										<a href="MyProfile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
									<div style="float:left;margin-left:4.5px;">
									<!--<div style="float:left;margin-left:11.5px;">-->
                                        <a href="LockNow.php" class="btn btn-default btn-flat">Lock Screen</a>
                                    </div>
                                    <div style="float:left" class="pull-right">
                                        <a href="Logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown messages-menu">
							<?php
							$allnotifications = 0;							
							 $query="SELECT bs.ID,bs.Amount,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(bs.Date, '%D %b %Y') AS Dated FROM basicsalary bs LEFT JOIN employees e ON bs.EmpID = e.ID WHERE bs.ID <>0 AND bs.Approved=0 AND bs.FrwdEmpID =".$_SESSION['UserID'];
							$result = mysql_query ($query) or die(mysql_error()); 
							$num = mysql_num_rows($result);
							
							 // $query2="SELECT l.ID,l.Type,l.Sender,l.NumOfDays,l.FromDate,l.ToDate,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leave_approvals l LEFT JOIN employees e ON l.Sender = e.ID WHERE l.ID <>0 AND l.Approval=0 AND l.ApproveBy ='".empCodeByID($_SESSION['UserID'])."'";
							// $result2 = mysql_query ($query2) or die(mysql_error()); 
							// $num2 = mysql_num_rows($result2);
							
							$query2="SELECT l.ID,l.Type,l.Sender,l.NumOfDays,l.FromDate,l.ToDate,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leave_approvals l LEFT JOIN employees e ON l.Sender = e.ID WHERE l.ID <>0 AND l.Approval=0 AND l.ApproveBy ='".$_SESSION['RoleID']."'";
							$result2 = mysql_query ($query2) or die(mysql_error()); 
							$num2 = mysql_num_rows($result2);
							
							$query3="SELECT l.ID,l.LoanType,l.EmpID,l.Code,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM loan_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							
							$query4="SELECT l.ID,l.EmpID,l.Code,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM advance_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result4 = mysql_query ($query4) or die(mysql_error()); 
							$num4 = mysql_num_rows($result4);
							
							$query5="SELECT t.ID,t.EmpID,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(t.DateAdded, '%D %b %Y') AS Dated FROM timeadjust_requests t LEFT JOIN employees e ON t.EmpID = e.ID WHERE t.ID <>0 AND t.Approved=0 AND t.NotificationTO = ".$_SESSION['UserID']."";
							$result5 = mysql_query ($query5) or die(mysql_error()); 
							$num5 = mysql_num_rows($result5);
							
							$query6="SELECT l.ID,l.Type,l.EmpID,l.Adjust,l.Date,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leaveadjust_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result6 = mysql_query ($query6) or die(mysql_error()); 
							$num6 = mysql_num_rows($result6);
							
							$allnotifications = $num+$num2+$num3+$num4+$num5+$num6;
							?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="<?php echo ($allnotifications > 0 ? 'faa-ring animated fa fa-bell' : 'fa fa-bell-o'); ?>"></i>
                                <span class="label label-success"><?php echo ($num+$num2+$num3+$num4+$num5+$num6); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo ($num+$num2+$num3+$num4+$num5+$num6); ?> Notifications</li>
                                <li>
                                   
                                    <ul class="menu">
                                        
										<?php
										if($num == 0 && $num2 == 0 && $num3 == 0 && $num4 == 0 && $num5 == 0 && $num6 == 0)
										{
											echo '&ensp;Currently not available any notification.';
										}
										 while($row = mysql_fetch_array($result,MYSQL_ASSOC))
										 {
										 $Image=explode(',', $row["Photo"]);
										 $img1 = $Image[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img1) ? DIR_EMPLOYEEPHOTOES.$img1 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row["EmpID"].' | '.$row["FirstName"].' '.$row["LastName"]; ?></p>
                                                    Approval For: (Basic Salary: <?php echo CURRENCY_SYMBOL.' '.$row["Amount"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='Approve.php?ID=<?php echo $row["ID"]; ?>&msg=BasicSalary'" class="btn btn-success btn-sm">Approve</button>
												<button onClick="location.href='Denied.php?ID=<?php echo $row["ID"]; ?>&msg=BasicSalary'" class="btn btn-danger btn-sm">Denied</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
										 {
										 $Image2=explode(',', $row2["Photo"]);
										 $img12 = $Image2[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img12) ? DIR_EMPLOYEEPHOTOES.$img12 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row2["EmpID"].' | '.$row2["FirstName"].' '.$row2["LastName"]; ?></p>
                                                     Approval For: (<?php echo $row2["Type"]; ?>)<br>
													 &nbsp;Details: (Num Of Days: <?php echo $row2["NumOfDays"]; ?>, From Date: <?php echo $row2["FromDate"]; ?> | To Date: <?php echo $row2["ToDate"]; ?>)<br>
													 &nbsp;Reason: (<?php echo $row2["Reason"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row2["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<!--<button onClick="location.href='Approve.php?ID=<?php //echo $row2["ID"]; ?>&msg=Leave&LeaveNOD=<?php //echo $row2["NumOfDays"]; ?>&LeaveType=<?php //echo $row2["Type"]; ?>&LeaveStartFrom=<?php //echo $row2["FromDate"]; ?>&LeaveSender=<?php //echo $row2["Sender"]; ?>'" class="btn btn-success btn-sm">Approve</button>-->
												<button onClick="location.href='ViewLeaveRequest.php?ID=<?php echo $row2["ID"]; ?>'" class="btn btn-info btn-sm">Details</button>
												<button onClick="location.href='LeaveRequests.php'" class="btn btn-warning btn-sm">View All</button>
												<!--<button onClick="location.href='Denied.php?ID=<?php //echo $row2["ID"]; ?>&msg=Leave'" class="btn btn-danger btn-sm">Denied</button>-->
                                            </a>
										</li> 
										<?php
										 }
										 while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
										 {
										 $Image3=explode(',', $row3["Photo"]);
										 $img13 = $Image3[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img13) ? DIR_EMPLOYEEPHOTOES.$img13 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row3["EmpID"].' | '.$row3["FirstName"].' '.$row3["LastName"]; ?></p>
                                                     Approval For: (<?php echo $row3["LoanType"]; ?>)<br>
													 &nbsp;Tran#: (<?php echo $row3["Code"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row3["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewLoanRequest.php?ID=<?php echo $row3["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='LoanRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row4 = mysql_fetch_array($result4,MYSQL_ASSOC))
										 {
										 $Image4=explode(',', $row4["Photo"]);
										 $img14 = $Image4[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img14) ? DIR_EMPLOYEEPHOTOES.$img14 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row4["EmpID"].' | '.$row4["FirstName"].' '.$row4["LastName"]; ?></p>
                                                     Approval For: (Advance Salary)<br>
													 &nbsp;Tran#: (<?php echo $row4["Code"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row4["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewAdvanceRequest.php?ID=<?php echo $row4["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='AdvanceRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row5 = mysql_fetch_array($result5,MYSQL_ASSOC))
										 {
										 $Image5=explode(',', $row5["Photo"]);
										 $img15 = $Image5[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img15) ? DIR_EMPLOYEEPHOTOES.$img15 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row5["EmpID"].' | '.$row5["FirstName"].' '.$row5["LastName"]; ?></p>
                                                     Approval For: (Time Adjust)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row5["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewTimeAdjustRequest.php?ID=<?php echo $row5["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='TimeAdjustRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row6 = mysql_fetch_array($result6,MYSQL_ASSOC))
										 {
										 $Image6=explode(',', $row6["Photo"]);
										 $img16 = $Image6[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img16) ? DIR_EMPLOYEEPHOTOES.$img16 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row6["EmpID"].' | '.$row6["FirstName"].' '.$row6["LastName"]; ?></p>
                                                     Approval For: (Leave Adjust with <?php echo $row6["Type"]; ?>)<br>
													 &nbsp;Details: (<?php echo $row6["Adjust"]; ?> Leave, Date: <?php echo $row6["Date"]; ?>)<br>
													 &nbsp;Reason: (<?php echo $row6["Reason"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row6["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewLeaveAdjustRequest.php?ID=<?php echo $row6["ID"]; ?>'" class="btn btn-info btn-sm">Details</button>
												<button onClick="location.href='LeaveAdjustRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										?>
										
                                    </ul>
                                </li>
                                <li class="footer"><a href="Notifications.php">Notifications</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <a href="#menu" id="toggle"><i class="fa fa-ellipsis-v"></i></i></a>
                <div id="menu">
                  <div class="navbar-right mobile">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                          <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                
                               <!-- font Awesome -->
                                        <small id="clockdisp"> <?php 

$datetime = new DateTime(null, new DateTimeZone('GMT'));
$datetime->modify('+5 hours');
echo $datetime->format('l jS M Y');																				
// $h = "5";
// $hm = $h * 60; 
// $ms = $hm * 60;
// $gmdate = gmdate("l jS M Y", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
// echo $gmdate;

//Loan Complete Query Start
$queryLoanRunning="UPDATE loans SET Status = 0 WHERE RemainingAmount > 0.1 AND Status <> 2";
mysql_query ($queryLoanRunning) or die(mysql_error()); 
$queryLoanComplete="UPDATE loans SET DateCompleted = NOW(),Status = 1 WHERE RemainingAmount < 0.1 AND Status <> 1";
mysql_query ($queryLoanComplete) or die(mysql_error()); 
$queryLoanCompleteAgain="UPDATE loans SET DateCompleted = NOW(),Status = 1 WHERE RemainingAmount < 0.1 AND Status = 1 AND DateCompleted = '0000-00-00'";
mysql_query ($queryLoanCompleteAgain) or die(mysql_error()); 
//Loan Complete Query End

$query5="SELECT ID,IsCheck FROM messages2 WHERE IsCheck=0 AND FIND_IN_SET ('".$_SESSION['UserID']."' ,Receivers) ";
$result5 = mysql_query ($query5) or die(mysql_error()); 
$num5 = mysql_num_rows($result5);
if($num5==0)
{
$_SESSION["RecMsg"]=0;				
}
else
{
$_SESSION["RecMsg"]=$num5;
}

?> </small>
                            </a>

                        </li>
						
                        <!--<li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                   
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>-->
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span><img height="30" style="margin-top:-6px" src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION["Photo"] : 'images/avatar.png'); ?>" class="img-circle" alt="" /> <?php echo $_SESSION["UserFullName"]; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu mobile-slide">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $_SESSION['Photo']) ? DIR_EMPLOYEEPHOTOES.$_SESSION["Photo"] : 'images/avatar.png'); ?>" class="img-circle" alt="" />
                                    <p>
                                         <?php echo $_SESSION["UserFullName"]; ?><br>
										 <small>
										 <?php echo $_SESSION["RoleID"]; ?>
										 </small>
                                        <small>Member since <?php echo $_SESSION["JoinDate"]; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body 
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div style="float:left">
                                        <!--<a href="EmployeeProfile.php" class="btn btn-default btn-flat">Profile</a>-->
										<a href="MyProfile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
									<div style="float:left;margin-left:4.5px;">
									<!--<div style="float:left;margin-left:11.5px;">-->
                                        <a href="LockNow.php" class="btn btn-default btn-flat">Lock Screen</a>
                                    </div>
                                    <div style="float:left" class="pull-right">
                                        <a href="Logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown messages-menu">
							<?php
							$allnotifications = 0;							
							 $query="SELECT bs.ID,bs.Amount,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(bs.Date, '%D %b %Y') AS Dated FROM basicsalary bs LEFT JOIN employees e ON bs.EmpID = e.ID WHERE bs.ID <>0 AND bs.Approved=0 AND bs.FrwdEmpID =".$_SESSION['UserID'];
							$result = mysql_query ($query) or die(mysql_error()); 
							$num = mysql_num_rows($result);
							
							 // $query2="SELECT l.ID,l.Type,l.Sender,l.NumOfDays,l.FromDate,l.ToDate,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leave_approvals l LEFT JOIN employees e ON l.Sender = e.ID WHERE l.ID <>0 AND l.Approval=0 AND l.ApproveBy ='".empCodeByID($_SESSION['UserID'])."'";
							// $result2 = mysql_query ($query2) or die(mysql_error()); 
							// $num2 = mysql_num_rows($result2);
							
							$query2="SELECT l.ID,l.Type,l.Sender,l.NumOfDays,l.FromDate,l.ToDate,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leave_approvals l LEFT JOIN employees e ON l.Sender = e.ID WHERE l.ID <>0 AND l.Approval=0 AND l.ApproveBy ='".$_SESSION['RoleID']."'";
							$result2 = mysql_query ($query2) or die(mysql_error()); 
							$num2 = mysql_num_rows($result2);
							
							$query3="SELECT l.ID,l.LoanType,l.EmpID,l.Code,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM loan_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							
							$query4="SELECT l.ID,l.EmpID,l.Code,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM advance_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result4 = mysql_query ($query4) or die(mysql_error()); 
							$num4 = mysql_num_rows($result4);
							
							$query5="SELECT t.ID,t.EmpID,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(t.DateAdded, '%D %b %Y') AS Dated FROM timeadjust_requests t LEFT JOIN employees e ON t.EmpID = e.ID WHERE t.ID <>0 AND t.Approved=0 AND t.NotificationTO = ".$_SESSION['UserID']."";
							$result5 = mysql_query ($query5) or die(mysql_error()); 
							$num5 = mysql_num_rows($result5);
							
							$query6="SELECT l.ID,l.Type,l.EmpID,l.Adjust,l.Date,l.Reason,e.Photo,e.EmpID,e.FirstName,e.LastName,DATE_FORMAT(l.DateAdded, '%D %b %Y') AS Dated FROM leaveadjust_requests l LEFT JOIN employees e ON l.EmpID = e.ID WHERE l.ID <>0 AND l.Approved=0 AND l.NotificationTO = '".$_SESSION['RoleID']."'";
							$result6 = mysql_query ($query6) or die(mysql_error()); 
							$num6 = mysql_num_rows($result6);
							
							$allnotifications = $num+$num2+$num3+$num4+$num5+$num6;
							?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="<?php echo ($allnotifications > 0 ? 'faa-ring animated fa fa-bell' : 'fa fa-bell-o'); ?>"></i>
                                <span class="label label-success"><?php echo ($num+$num2+$num3+$num4+$num5+$num6); ?></span>
                            </a>
                            <ul class="dropdown-menu mobile-noti">
                                <li class="header">You have <?php echo ($num+$num2+$num3+$num4+$num5+$num6); ?> Notifications</li>
                                <li>
                                   
                                    <ul class="menu">
                                        
										<?php
										if($num == 0 && $num2 == 0 && $num3 == 0 && $num4 == 0 && $num5 == 0 && $num6 == 0)
										{
											echo '&ensp;Currently not available any notification.';
										}
										 while($row = mysql_fetch_array($result,MYSQL_ASSOC))
										 {
										 $Image=explode(',', $row["Photo"]);
										 $img1 = $Image[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img1) ? DIR_EMPLOYEEPHOTOES.$img1 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row["EmpID"].' | '.$row["FirstName"].' '.$row["LastName"]; ?></p>
                                                    Approval For: (Basic Salary: <?php echo CURRENCY_SYMBOL.' '.$row["Amount"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='Approve.php?ID=<?php echo $row["ID"]; ?>&msg=BasicSalary'" class="btn btn-success btn-sm">Approve</button>
												<button onClick="location.href='Denied.php?ID=<?php echo $row["ID"]; ?>&msg=BasicSalary'" class="btn btn-danger btn-sm">Denied</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
										 {
										 $Image2=explode(',', $row2["Photo"]);
										 $img12 = $Image2[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img12) ? DIR_EMPLOYEEPHOTOES.$img12 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row2["EmpID"].' | '.$row2["FirstName"].' '.$row2["LastName"]; ?></p>
                                                     Approval For: (<?php echo $row2["Type"]; ?>)<br>
													 &nbsp;Details: (Num Of Days: <?php echo $row2["NumOfDays"]; ?>, From Date: <?php echo $row2["FromDate"]; ?> | To Date: <?php echo $row2["ToDate"]; ?>)<br>
													 &nbsp;Reason: (<?php echo $row2["Reason"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row2["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<!--<button onClick="location.href='Approve.php?ID=<?php //echo $row2["ID"]; ?>&msg=Leave&LeaveNOD=<?php //echo $row2["NumOfDays"]; ?>&LeaveType=<?php //echo $row2["Type"]; ?>&LeaveStartFrom=<?php //echo $row2["FromDate"]; ?>&LeaveSender=<?php //echo $row2["Sender"]; ?>'" class="btn btn-success btn-sm">Approve</button>-->
												<button onClick="location.href='ViewLeaveRequest.php?ID=<?php echo $row2["ID"]; ?>'" class="btn btn-info btn-sm">Details</button>
												<button onClick="location.href='LeaveRequests.php'" class="btn btn-warning btn-sm">View All</button>
												<!--<button onClick="location.href='Denied.php?ID=<?php //echo $row2["ID"]; ?>&msg=Leave'" class="btn btn-danger btn-sm">Denied</button>-->
                                            </a>
										</li> 
										<?php
										 }
										 while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
										 {
										 $Image3=explode(',', $row3["Photo"]);
										 $img13 = $Image3[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img13) ? DIR_EMPLOYEEPHOTOES.$img13 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row3["EmpID"].' | '.$row3["FirstName"].' '.$row3["LastName"]; ?></p>
                                                     Approval For: (<?php echo $row3["LoanType"]; ?>)<br>
													 &nbsp;Tran#: (<?php echo $row3["Code"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row3["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewLoanRequest.php?ID=<?php echo $row3["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='LoanRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row4 = mysql_fetch_array($result4,MYSQL_ASSOC))
										 {
										 $Image4=explode(',', $row4["Photo"]);
										 $img14 = $Image4[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img14) ? DIR_EMPLOYEEPHOTOES.$img14 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row4["EmpID"].' | '.$row4["FirstName"].' '.$row4["LastName"]; ?></p>
                                                     Approval For: (Advance Salary)<br>
													 &nbsp;Tran#: (<?php echo $row4["Code"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row4["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewAdvanceRequest.php?ID=<?php echo $row4["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='AdvanceRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row5 = mysql_fetch_array($result5,MYSQL_ASSOC))
										 {
										 $Image5=explode(',', $row5["Photo"]);
										 $img15 = $Image5[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img15) ? DIR_EMPLOYEEPHOTOES.$img15 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row5["EmpID"].' | '.$row5["FirstName"].' '.$row5["LastName"]; ?></p>
                                                     Approval For: (Time Adjust)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row5["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewTimeAdjustRequest.php?ID=<?php echo $row5["ID"]; ?>'" class="btn btn-success btn-sm">View Details</button>
												<button onClick="location.href='TimeAdjustRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										 while($row6 = mysql_fetch_array($result6,MYSQL_ASSOC))
										 {
										 $Image6=explode(',', $row6["Photo"]);
										 $img16 = $Image6[0];
										?>
										<li style="overflow-x:scroll;">  
                                            <a>
                                                <div class="pull-left">
                                                    <img src="<?php echo (is_file(DIR_EMPLOYEEPHOTOES . $img16) ? DIR_EMPLOYEEPHOTOES.$img16 : 'images/avatar.png'); ?>" class="img-circle" alt=""/>
                                                </div>
                                                <h4>
													<p>Employee: <?php echo $row6["EmpID"].' | '.$row6["FirstName"].' '.$row6["LastName"]; ?></p>
                                                     Approval For: (Leave Adjust with <?php echo $row6["Type"]; ?>)<br>
													 &nbsp;Details: (<?php echo $row6["Adjust"]; ?> Leave, Date: <?php echo $row6["Date"]; ?>)<br>
													 &nbsp;Reason: (<?php echo $row6["Reason"]; ?>)
                                                    <small class="pull-left" style="margin:3px 0 0 5px;"><i class="fa fa-clock-o"></i> <?php echo $row6["Dated"]; ?></small>
                                                </h4>
                                                <p></p>
												<br>
												<button onClick="location.href='ViewLeaveAdjustRequest.php?ID=<?php echo $row6["ID"]; ?>'" class="btn btn-info btn-sm">Details</button>
												<button onClick="location.href='LeaveAdjustRequests.php'" class="btn btn-warning btn-sm">View All</button>
                                            </a>
										</li> 
										<?php
										 }
										?>
										
                                    </ul>
                                </li>
                                <li class="footer"><a href="Notifications.php">Notifications</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                </div>
            </nav>
        </header>
		
		<a class="no-print" title="" href="https://your-url/chatting/" target="_blank"><div style="width:50px;height:50px;border-radius:5px 0 0 5px;position:fixed;top:145px;right:0px;background-color:black;z-index:9999999999999;font-size: 25px;display: flex;justify-content: center;align-items: center;color: #fff;"><i class="fa fa-comments-o" aria-hidden="true"></i>


</div></a>
		
		<iframe src="DesktopNotifications.php" style="display:none" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto"></iframe>