<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Technado</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="images/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/responsive.css" />

</head>

<body>
	
	<div class="pg-top">
		<div class="container">
			<div class="header-row">
				<div class="logo">
					<a href="javascript:void(0)">
						<img src="images/logo.png" alt="logo" class="img-fluid">
					</a>
				</div>
				<div class="user">
					<div class="img">
						<img src="images/user-icon-1.png" alt="user" class="img-fluid">
					</div>
					<div class="desc">
						<p class="name">Jamal Ahmed</p>
						<p class="desig">Production Head</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main-sec">
		<div class="container">
			<div class="main-row">
				<div class="can-col">
					<div class="clock-wrap">
						<div id="myclock"></div>
					</div>
				</div>
				<div class="form-col">
					<div class="form-wrap">
						<form>
							<p class="heading"><span>Online</span>
							Attendance System</p>
							<div class="form-row">
								<div class="input-col">
									<input type="number" placeholder="Enter Your ID" value="01077" disabled>
								</div>
								<div class="btn-col">
									<input type="submit" class="c-btn g-btn" value="PRESS TIME IN">
									<!-- <button type="submit" class="c-btn g-btn">PRESS TIME IN</button> -->
								</div>
								<div class="btn-col">
									<input type="submit" class="c-btn r-btn" value="PRESS TIME OUT">
									<!-- <button type="submit" class="c-btn r-btn">PRESS TIME OUT</button> -->
								</div>
							</div>
						</form>
						<div class="attendance-det">
							<p class="heading">Today’s Attendance Details</p>
							<ul>
								<li><img src="images/icon-1.png" class="img-fluid" alt="icon"><span>Date:</span> Tuesday 14 july 2020</li>
								<li><img src="images/icon-2.png" class="img-fluid" alt="icon"><span>Time in:</span> 03:36:45 AM</li>
								<li><img src="images/icon-3.png" class="img-fluid" alt="icon"><span>Time out:</span> 05:03:36 PM</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.thooClock.js"></script>
<script src="js/custom.js"></script> 


</body>
</html>

