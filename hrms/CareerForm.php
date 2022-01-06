<?php
session_start();
set_time_limit(0);
global $dbh;
$self = $_SERVER['PHP_SELF'];
define("DIR_WEBSITE_CVS_ONLINE", "assets/resumes/");

function redirect($url)
{
	header("Location: " . $url);
	exit();
}

function dbinput($string, $allow_html = false)
{
	global $dbh;
	
	if($allow_html == false)
		$string = strip_tags($string);
	
	if (function_exists('mysql_real_escape_string'))
		return mysql_real_escape_string($string, $dbh);
	elseif (function_exists('mysql_escape_string'))
		return mysql_escape_string($string);
	
	return addslashes($string);
}
$dbh=mysql_connect ("localhost", "stagenado_zeeshan", "QWERTY!2#4%6") or die ('Could not connect to the database because: ' . mysql_error());
mysql_select_db("stagenado_zeeshan");

$CV=0;
$msg_error="";
$Post=0;
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{	
	if(isset($_POST["Post"]) && ctype_digit($_POST['Post']))
		$Post=trim($_POST["Post"]);
		
	$allowedExts = array("pdf","doc","docx");
	if($Post == 0)
	{
		$msg_error='Please Select Job Post';
	}
	else if($_FILES["CVPath"]["name"] == '')
	{
		$msg_error='Please Upload Resume';
	}
	else 
	{
		$temp = explode(".", $_FILES["CVPath"]["name"]);
		$extension = end($temp);
		if(!in_array($extension, $allowedExts))
		{
			$msg_error='Please Upload Valid Extention File';
		}
	}
	
	
	if($msg_error =='')
	{
		$query="INSERT INTO resumes SET PostID = '" . dbinput((int)$Post) . "',DateAdded=NOW()";
		mysql_query($query) or die ('Could not add Resume because: ' . mysql_error());
		// echo $query;
		$CV = mysql_insert_id();
		$moved =  move_uploaded_file($_FILES["CVPath"]["tmp_name"],DIR_WEBSITE_CVS_ONLINE. $CV.'.'.$extension);
		$query = "UPDATE resumes SET Resume = '".$CV.".".$extension."' WHERE ID = ".$CV."";
		
		mysql_query($query) or die (mysql_error());
		$_SESSION["msg_error"]='Resume has been Submitted';
		redirect($self);
		
	}			

}
?>
<section id="upload_resume">
				<h3 class="form_heading">Send Resume To Us</h3>
				<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" name="frmPage">
				<label class="form_label" for="cv">Upload Resume</label><br>
				<input id="cv" type="file" name="CVPath" /><br><br>
				<label class="form_label" for="Post">Choose Job Post</label><br>
				<select class="form_dropdown" name="Post" id="Post">
						<option value="0" >Apply for Post</option>
						<?php
						$query = "SELECT PostName,ID FROM jobposts WHERE Status = 1";
						$res = mysql_query($query);
						while($row = mysql_fetch_array($res))
						{
						echo '<option '.($Post == $row['ID'] ? 'selected' : '').'value="'.$row['ID'].'">'.$row['PostName'].'</option>';
						}
						?>
				</select>
				<br><br>
				<input class="form_button" type="submit" name="submit" value="Apply" style="cursor:pointer" />
				<input type="hidden" name="action" value="submit_form" />
				</form>
				<label class="form_error_msg">
				<?php
					echo $msg_error;
					if(isset($_SESSION["msg_error"]))
					{
						echo $_SESSION["msg_error"];
						$_SESSION["msg_error"]="";
					}
				?>
				</label>					
</section>