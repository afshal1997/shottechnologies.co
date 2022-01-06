<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php"); ?>
<?php 
$Image = "";
$ImageExtArray = array();
$ImageExt = "";
$ImagePath = "";
function base64_encode_image ($filename=string,$filetype=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}

function empPhotoByCode($ID="")
{
	$Photo = "";
	$res = mysql_query("SELECT Photo FROM employees WHERE EmpID = '".$ID."'");
	$num = mysql_num_rows($res);
	if($num == 1)
	{
		$r = mysql_fetch_array($res);
		$Photo = $r['Photo'];
		if($Photo == "")
		{
			return "NotFound.png";
		}
		else
		{
			return $Photo;
		}
	}
	else
	{
		return "NotFound.png";
	}
}
?>
<html>
<head>
	<meta http-equiv="refresh" content="900">
	<script>
		var Notification = window.Notification || window.mozNotification || window.webkitNotification;

		Notification.requestPermission(function (permission) {
			// console.log(permission);
		});

		function show() {
			
			<?php
			$DesktopQueryString = "SELECT DISTINCT m.from from msg m where m.to='".empCodeByID($_SESSION['UserID'])."' AND m.status=1 order by m.id desc";
			$DesktopQuery = mysql_query($DesktopQueryString);
			
			$number_of_D_Notifications = mysql_num_rows($DesktopQuery);
			if($number_of_D_Notifications > 0)
			{
				while($row = mysql_fetch_array($DesktopQuery))
				{
				$Image = empPhotoByCode($row['from']);
				$ImageExtArray = explode('.',$Image);
				$ImageExt = $ImageExtArray[1];
				$ImagePath = (is_file(DIR_EMPLOYEEPHOTOES . $Image) ? DIR_EMPLOYEEPHOTOES.$Image : 'images/avatar.png');
			?>
				window.setTimeout(function () {
				var instance = new Notification(
					"You Have a Chat", {
						body: "From: <?php echo empInfoByCode($row['from']); ?> ",
						icon: "<?php echo base64_encode_image($ImagePath,$ImageExt); ?>"
					}
				);

				instance.onclick = function () {
					// Something to do
				};
				instance.onerror = function () {
					// Something to do
				};
				instance.onshow = function () {
					// Something to do
				};
				instance.onclose = function () {
					// Something to do
				};
				}, 1000);
				
			<?php
				}
			}
			?>

			return false;
		}
	</script>
	<script type="text/javascript">
        window.onload = show;
    </script>
</head>
<body>
</body>
</html>