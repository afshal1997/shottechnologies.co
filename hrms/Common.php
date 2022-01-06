<?php
	session_start();
	set_time_limit(0);
	include("DBConnection.php");
	global $dbh;
	$path= explode("/", $_SERVER["PHP_SELF"]);
	$self = $_SERVER['PHP_SELF'];

	$dbh=mysql_connect (DB_HOST, DB_USERNAME, DB_PASSWORD) or die ('Could not connect to the database because: ' . mysql_error());
	mysql_select_db(DB_NAME);
	
	

	$queryORG="SELECT * FROM organization_settings";
	
	$resultORG = mysql_query ($queryORG) or die(mysql_error()); 
	$numORG = mysql_num_rows($resultORG);
	
	if($numORG==1)
	{
		$rowORG = mysql_fetch_array($resultORG,MYSQL_ASSOC);
		
		$GraceTimeORG=$rowORG["GraceTime"];
		$CurrencySymbolORG=$rowORG["CurrencySymbol"];
		$PassingPercentageORG=$rowORG["PassingPercentage"];
		$NumOfAttemptsORG=$rowORG["NumOfAttempts"];
		$InterviewPercentageORG=$rowORG["InterviewPercentage"];
		$YearStartFromORG=$rowORG["YearStartFrom"];
	}
		
	
	define("DIR_MODULES", "modules/");
	
	define("MANDATORY", "<span class=\"mandatory noPrint\">*</span>");
	define("THUMB_WIDTH", 72); //In Pixel
	define("THUMB_HEIGHT", 72); //In Pixel
	define("INDENT", "&nbsp;&nbsp;&nbsp;");
	define("MAX_IMAGE_SIZE", 5120); //In KB
	define("MAX_CSV_SIZE", 20480); //In KB
	
	
	
	define("DIR_BRANDS_IMAGES", "assets/brands-images/");
	define("DIR_CATEGORY_BANNERS", "assets/category-banners/");
	define("DIR_PRODUCTS_IMAGES", "assets/product-images/");
	define("DIR_PAGE_BANNERS", "assets/infopage-banner/");
	define("DIR_LOGOS", "assets/logo/");
	define("DIR_SLIDERS", "assets/website-sliders/");
	define("DIR_THUMBNAILS", "assets/thumbnails/");
	define("DIR_WEBSITE_BANNERS", "assets/website-banners/");
	define("DIR_PAYMENT_METHODS", "assets/payment-methods/");
	define("DIR_MULTIMEDIA_IMAGES", "assets/multimedia-images/");
	define("DIR_SOCIALMEDIA_IMAGES", "assets/socialmedia-images/");
	define("DIR_NEWSLETTERS", "assets/newsletters/");
	define("DIR_EMPLOYEEPHOTOES", "assets/employeephotoes/");
	define("DIR_DOCUMENTS", "assets/documents/");
	define("DIR_WEBSITE_CVS", "assets/resumes/");
	define("DIR_COMPANY_LOGO", "assets/company-logo/");
	
	define("CURRENCY_SYMBOL", "".$CurrencySymbolORG."");
	define("PASSING_PERCENTAGE", $PassingPercentageORG);
	define("NUM_OF_TEST_ATTEMPTS", $NumOfAttemptsORG);
	define("INTERVIEW_PERCENTAGE", $InterviewPercentageORG);
	define("GRACE_ARRIVAL_TIME", "".$GraceTimeORG."");
	define("YEAR_START_FROM", $YearStartFromORG);
	
	
	$sqlGrade = "SELECT Grade FROM grades WHERE ID <> 0 AND Status = 1";
	$dataGrade = mysql_query($sqlGrade) or die(mysql_error());	
	$numGrade = mysql_num_rows($dataGrade);

	$_GRADE=array();
	while($rowGrade = mysql_fetch_array($dataGrade))
	{
		$_GRADE []= $rowGrade['Grade'];
	}
	
	
	$sqlDesignation = "SELECT Designation FROM designations WHERE ID <> 0 AND Status = 1";
	$dataDesignation = mysql_query($sqlDesignation) or die(mysql_error());	
	$numDesignation = mysql_num_rows($dataDesignation);

	$_DESIGNATION=array();
	while($rowDesignation = mysql_fetch_array($dataDesignation))
	{
		$_DESIGNATION []= $rowDesignation['Designation'];
	}
	
	
	$sqlDepartment = "SELECT ID,Department FROM departments WHERE ID <> 0 AND Status = 1";
	$dataDepartment = mysql_query($sqlDepartment) or die(mysql_error());	
	$numDepartment = mysql_num_rows($dataDepartment);

	$_DEPARTMENT=array();
	$_DEPARTMENTID=array();
	while($rowDepartment = mysql_fetch_array($dataDepartment))
	{
		$_DEPARTMENT []= $rowDepartment['Department'];
		$_DEPARTMENTID []= $rowDepartment['ID'];
	}

	
	
	
	
	
	$_ROLES = array("Employee", "HR", "Accounts", "Audit", "Administrator", "Security");
	$_EMPLOYEETYPES = array("Probation","Contractual", "Permanent","Temporary","Notice Period","Internee","MTO");
	$_SALUTATION = array("Mr", "Miss", "Mrs", "Ms", "Dr");
	$_MARITALSTATUS = array("Single", "Married", "Separated", "Divorced", "Widowed");
	$_GENDER = array("Male", "Female");
	$_BLOODGROUP = array("AB+", "A+", "B+", "O+", "AB-", "A-", "B-", "O-");
	$_RELIGION = array("ISLAM","Non-Muslim");
	$_AttendanceAllowance = array("None", "FixedAmount","GrossSalary");
	
	$_AD = array("<i class=\"fa fa-fw fa-times-circle\"></i>", "<i class=\"fa fa-fw fa-check-circle\"></i>");

	$_IMAGE_ALLOWED_TYPES=array("jpg", "jpeg", "gif", "png");
	$_FILE_ALLOWED_TYPES=array("gif", "jpeg", "jpg", "png", "zip", "rar", "doc", "docx", "ppt", "pptx", "xls", "xlsx", "pdf", "txt");
	$_ONLY_CSV_ALLOWED=array("csv");
	$_NEWSLETTER_ALLOWED_TYPES=array("html", "htm", "HTML");
	$_PACKAGE_TYPES=array("-- Not Selected --", "Corporate", "Individual");
	$_USERS_TYPES=array("-- Not Selected --", "Corporate", "Individual");
	$_CATEGORY_TYPES=array("-- Not Selected --", "Company Profile", "Salary Report", "Feedback");
	$_FORM_TYPES=array("-- Not Selected --", "Corporate", "Individual");
	$_AD=array("Deactive", "Active");
	$_OPEN_IN=array("_self", "_blank");
	$_INPUT_TYPE=array("","Radio", "Selection", "Textbox");
	$_QUESTION_MODULES=array("","Countries","Industries","Educations","Experiances", "Occupation", "Skills", "KSA Cities", "Spciality (Majors)", "Traning Courses");
	$_MONTHS = array("January","February","March","April","May","June","July","August","September","October","November","December");
	$_EXP_MONTH = array("","1","2","3","6","9","12","24","48");
	$_MARK_AS = array("", "Gender", "Grade","Company Size");
	$_MARK_AS_COMPANY = array("", "Company Size", "Industry", "KSA City");
	$_ADS_POSITION = array("", "Header", "Sidebar");
	$_AD_FILE_NAMES = array("", array("Main Page","Index.php"), array("Dashboard","Dashboard.php"), array("Pages","Page.php"), array("Login","Login.php"), 
						array("Registration","Registration.php"),array("404","404.php"), );						
	$_INSTITUTE_TYPE = array("", "College/University", "Vocational/Technical", "Other");
	$_MAJOR_TYPES = array("", "Scientific", "Non Scientific");
	$_MAJOR_TYPES_UNIVERSITY = array("", "Normal", "Vocational");
	$_QUESTION_MODULES_CORPORATE = array("","Industries", "KSA Cities", "How old is your company", "How many Branchs","How long to fill position (Time to Fill)","How long to join position (Time to Join)","How do you rate your Salary in your industry");
	$_MISC_TYPE=array("Heading", "Message", "HTML", "Image");
	$_EXCLUDEED_FILES = array("--Index.php","Blank.php","BuyPackage.php","BuyUsers.php","CompanyProfile(WithoutModules).php","CompanyProfile1.php","CorporateForm.php","CorporateUsers.php","Countries.php","Dashboard2.php","Faqs.php","Header1.php","IndividualForm.php","IndividualSalaryReport(02-05-14).php","IndividualSalaryReport-backup(20-04-14).php","IndividualUsers.php","Industries.php","Institutes.php","Logout.php","Majors.php","NationalCategories.php","News.php","QuestionCategories.php","Questions.php","Sidebar.php","buy_package.php","buy_report_corporate.php","chart.php","check.php","check_user_login.php","circles.php","display_image.php","form.php","index--.php","index2.php","inner.php","inquiries.php","ipnac.php","ipnc.php","ipnlistener.php","ipnp.php","ipnpa.php","ipnu.php","print_session.php","profile_check.php","profile_indicator.php","question_rivision---.php","question_rivision--.php","report1.php","report2.php","report___.php","rivision(WithoutAnswer).php","rivision(WithoutSubAnswer).php","s.php","salary_report1.php","show_cities.php","skill_details.php","test.php","thumbnail_generator.php","up.php","user_credits.php","user_info.php","user_reports_display.php","user_side_bar.php","view_list.php","view_salary_report-old.php","view_salary_report-test.php","view_salary_report_test.php");

	//var_dump(stream_get_wrappers()); //check installed extention in php.ini
	function Newsletter($Newsletter)
	{
		$Content=file_get_contents($Newsletter);
		return $Content;
	}
	
	function redirect($url)
	{
		header("Location: " . $url);
		exit();
	}
	
	function validEmailAddress($email_address)
	{
		if(strpos($email_address, " ") > 0)
			return false;
			
		//return preg_match("^(([\w-]+\.)+[\w-]+|([a-zA-Z]{1}|[\w-]{2,}))@((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|([a-zA-Z]+[\w-]+\.)+[a-zA-Z]{2,4})$^", $email_address);
		
		return filter_var($email_address, FILTER_VALIDATE_EMAIL);
	}
	
	function validDate($dt)
	{
		if(trim($dt) == "")
			return false;
			
		$d = explode("/", $dt);
		if(sizeof($d) != 3)
			return false;
			
		if(!ctype_digit($d[0]) || !ctype_digit($d[1]) || !ctype_digit($d[2]))
			return false;
			
		return checkdate($d[1], $d[0], $d[2]);
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
	
	function dboutput($string)
	{
		return stripslashes($string);
	}
	
	function not_null($value)
	{
		if (is_array($value))
		{
			if (sizeof($value) > 0)
				return true;
			else
				return false;
		}
		else
		{
			if ((is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0))
				return true;
			else
				return false;
		}
	}
	
	function replace_quote($string)
	{
		return str_replace('"', '&quot;', $string);
	}
	
	$PageCounter = 0;	
	function get_menu($parent_id=0)
	{
		global $PageCounter, $_OPEN_IN;
		$rc = mysql_query("SELECT c.ID, c.ParentID, cd.Title, c.ExternalLink, c.LinkTargert
		FROM cms c
		LEFT JOIN cms_details cd ON cd.CMSID = c.ID AND cd.LanguageID='".(int)LANGUAGE_ID."'
		WHERE c.ShowInMenu = 1 AND c.Status = 1 AND c.ParentID = '".(int)$parent_id."' ORDER BY c.SortOrder, c.ID") or die(mysql_error());
		if(mysql_num_rows($rc) > 0)
		{
			$PageCounter++;
			echo '<ul'.($parent_id == 0 ? ' id="menu-main-menu" class="menu"' : ' class="sub-menu"').'>';
			
				
			while($RsC = mysql_fetch_assoc($rc))
			{	$html='';
				if(strtolower(dboutput($RsC["ExternalLink"])) == "login.php")
				{
					if(isset($_SESSION['User']) && $_SESSION['User']==true)
					{
						$Title = "My Account";
						$href = "Dashboard.php";
						$html='<ul id="menu-main-menu" class="menu">
								<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="Dashboard.php"><span id="headertext">Dashboard</span></a></li>
								<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="salary_report.php?agree=true&action=submit_survey"><span id="headertext">Salary Survey</span></a></li>';
								 if(($_SESSION["UserType"] == 1)  || ($_SESSION["UserType"] == 2 && $_SESSION["ShowReport"] == 1 && $_SESSION["ParentUserType"] == 1 ) ||  ($_SESSION["UserType"] == 2 && $_SESSION["ParentUserType"] == 2 && $_SESSION["ShowReport"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0))
								 {
									$html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="ReportManagement.php"><span id="headertext">Reports Management</span></a></li>';
								}
								if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["IsSubAdmin"] == 1)|| ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0))) 	{ 
								
								if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["Credit_Management"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0)))						 
								{
								$html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="CreditManagement.php"><span id="headertext">Credits Management</span></a></li>';
								 }
    							 if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["User_Management"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0))) 
								 {
								$html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="UserManagement.php"><span id="headertext">User Management</span></a></li>';
								}
     							if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && ($_SESSION["UserType"] == 1 || $_SESSION["Company_Profile"] == 1))
	 							{
								$html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="CompanyProfile.php"><span id="headertext">Company Profile</span></a></li>';
								}
								}
								$html .= '<li  id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.(isset($_SESSION["User"]) && $_SESSION["User"] == true && $_SESSION["UserType"] == 1 ? "UpdateProfileCorporate.php" : "UpdateProfileIndividual.php").'"><span id="headertext">Personal Details</span></a></li>';
								$html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="Logout.php"><span id="headertext">Logout</span></a></li>';
								
								$html .= '</ul>';
					}
					else
					{
						$Title = dboutput($RsC["Title"]);
						$href = dboutput($RsC["ExternalLink"]);
					}
				}
				else
				{
					$Title = dboutput($RsC["Title"]);
					$href = (dboutput($RsC["ExternalLink"]) != "" ? dboutput($RsC["ExternalLink"]) : "Page.php?id=".$RsC["ID"]);
				}
				
				if($parent_id == 0)
					echo '<li id="menu-item-'.$RsC["ID"].'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.$href.'" target="'.$_OPEN_IN[$RsC["LinkTargert"]].'"><span id="headertext">'.$Title.'</span></a>'.$html;
				else
					echo '<li id="menu-item-'.$RsC["ID"].'" class="menu-item menu-item-type-post_type menu-item-object-portfolio"><a href="'.$href.'" target="'.$_OPEN_IN[$RsC["LinkTargert"]].'"><span id="headertext">'.$Title.'</span></a>';
					
				get_menu($RsC["ID"]);
				
				echo '</li>';
			}
			
			echo '</ul>';
		}
	
	}
	function get_pages_ids($parent_id = 0)
	{
		global $pages_ids;
		$r = mysql_query("SELECT ID FROM cms  WHERE ParentID = " . (int)$parent_id) or die("Product categories tree select: " . mysql_error());
		if(mysql_num_rows($r) > 0)
		{
			while($RsC = mysql_fetch_assoc($r))
			{
				$pages_ids .= "," . $RsC["ID"];
					
				get_pages_ids($RsC["ID"]);
			}
			
		}
	}
	function generate_password()
	{
		$pass = "";
		$salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZ0123456789abchefghjkmnpqrstuvwxyz";
		srand((double)microtime()*1000000);
		$i = 0;		
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		
		return $pass;
	}
	
	function generate_refno($ID)
	{
		$refno = "";
		$salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZ0123456789abchefghjkmnpqrstuvwxyz";
		srand((double)microtime()*1000000);
		$i = 0;  
		while ($i <= 7)
		{
			$num = rand() % 33;
			$tmp = substr($salt, $num, 1);
			$refno = $refno . $tmp;
			$i++;
			if($i == 4)
				$refno = $refno . $ID;
		}
		
		return $refno;
	}
	
	function send_mail($From, $To, $Subject, $Body, $IsHTML = true, $Attachments=array())
	{
		$headers = "from: ".SMTP_USER."\r\n";
		$headers .= "Content-type: text/html\r\n";
		return mail($To, $Subject, $Body, $headers);
		
	}
		
	function count_coupon($StoreID)
	{
	
		$res = mysql_query("SELECT * FROM coupons WHERE StoreID = ".(int)$StoreID."");
		$total = mysql_num_rows($res);
		
		return $total;
		
	}
	function get_total_coupons()
	{
	
		$res = mysql_query("SELECT * FROM coupons");
		$total = mysql_num_rows($res);
		
		return $total;
		
	}
	function get_total_store()
	{
	
		$res = mysql_query("SELECT * FROM stores");
		$total = mysql_num_rows($res);
		
		return $total;
		
	}
	function get_brand($Name)
	{
		$res = mysql_query("SELECT ID,BrandName,Image FROM brands WHERE ID <> 0 AND BrandName Like '".$Name."%'") or die(mysql_error());
		$num = mysql_num_rows($res);
		if($num = 0)
		{
			echo ' ';
		}
		else
		{
			while($row = mysql_fetch_array($res))
			{
				echo '<div class="col-md-2 col-xs-12">
						<div class="item-innner" align="center">	    																													
							<img src="admin/'.DIR_BRANDS_IMAGES.dboutput($row['Image']).'" alt="" style="width:190px; height:110px; border:solid 1px #c1c1c1;">
							<a href="#"><h3>'.$row['BrandName'].'</h3></a>
						</div>
					</div>';
			}
		}
	}
	
	
	
	
	function PercentageToRatio($per = 0)
	{
		$rating = $per / 20;
		echo $rating;
	}

	function getCountryByCode($Country)
	{
			echo ($Country == 'AFG' ? 'Afghanistan' : '');
			echo ($Country == 'ALA' ? 'Åland Islands' : '');
			echo ($Country == 'ALB' ? 'Albania' : '');
			echo ($Country == 'DZA' ? 'Algeria' : '');
			echo ($Country == 'ASM' ? 'American Samoa' : '');
			echo ($Country == 'AND' ? 'Andorra' : '');
			echo ($Country == 'AGO' ? 'Angola' : '');
			echo ($Country == 'AIA' ? 'Anguilla' : '');
			echo ($Country == 'ATA' ? 'Antarctica' : '');
			echo ($Country == 'ATG' ? 'Antigua and Barbuda' : '');
			echo ($Country == 'ARG' ? 'Argentina' : '');
			echo ($Country == 'ARM' ? 'Armenia' : '');
			echo ($Country == 'ABW' ? 'Aruba' : '');
			echo ($Country == 'AUS' ? 'Australia' : '');
			echo ($Country == 'AUT' ? 'Austria' : '');
			echo ($Country == 'AZE' ? 'Azerbaijan' : '');
			echo ($Country == 'BHS' ? 'Bahamas' : '');
			echo ($Country == 'BHR' ? 'Bahrain' : '');
			echo ($Country == 'BGD' ? 'Bangladesh' : '');
			echo ($Country == 'BRB' ? 'Barbados' : '');
			echo ($Country == 'BLR' ? 'Belarus' : '');
			echo ($Country == 'BEL' ? 'Belgium' : '');
			echo ($Country == 'BLZ' ? 'Belize' : '');
			echo ($Country == 'BEN' ? 'Benin' : '');
			echo ($Country == 'BMU' ? 'Bermuda' : '');
			echo ($Country == 'BTN' ? 'Bhutan' : '');
			echo ($Country == 'BOL' ? 'Bolivia, Plurinational State of' : '');
			echo ($Country == 'BES' ? 'Bonaire, Sint Eustatius and Saba' : '');
			echo ($Country == 'BIH' ? 'Bosnia and Herzegovina' : '');
			echo ($Country == 'BWA' ? 'Botswana' : '');
			echo ($Country == 'BVT' ? 'Bouvet Island' : '');
			echo ($Country == 'BRA' ? 'Brazil' : '');
			echo ($Country == 'IOT' ? 'British Indian Ocean Territory' : '');
			echo ($Country == 'BRN' ? 'Brunei Darussalam' : '');
			echo ($Country == 'BGR' ? 'Bulgaria' : '');
			echo ($Country == 'BFA' ? 'Burkina Faso' : '');
			echo ($Country == 'BDI' ? 'Burundi' : '');
			echo ($Country == 'KHM' ? 'Cambodia' : '');
			echo ($Country == 'CMR' ? 'Cameroon' : '');
			echo ($Country == 'CAN' ? 'Canada' : '');
			echo ($Country == 'CPV' ? 'Cape Verde' : '');
			echo ($Country == 'CYM' ? 'Cayman Islands' : '');
			echo ($Country == 'CAF' ? 'Central African Republic' : '');
			echo ($Country == 'TCD' ? 'Chad' : '');
			echo ($Country == 'CHL' ? 'Chile' : '');
			echo ($Country == 'CHN' ? 'China' : '');
			echo ($Country == 'CXR' ? 'Christmas Island' : '');
			echo ($Country == 'CCK' ? 'Cocos (Keeling) Islands' : '');
			echo ($Country == 'COL' ? 'Colombia' : '');
			echo ($Country == 'COM' ? 'Comoros' : '');
			echo ($Country == 'COG' ? 'Congo' : '');
			echo ($Country == 'COD' ? 'Congo, the Democratic Republic of the' : '');
			echo ($Country == 'COK' ? 'Cook Islands' : '');
			echo ($Country == 'CRI' ? 'Costa Rica' : '');
			echo ($Country == 'CIV' ? 'Côte dIvoire' : '');
			echo ($Country == 'HRV' ? 'Croatia' : '');
			echo ($Country == 'CUB' ? 'Cuba' : '');
			echo ($Country == 'CUW' ? 'Curaçao' : '');
			echo ($Country == 'CYP' ? 'Cyprus' : '');
			echo ($Country == 'CZE' ? 'Czech Republic' : '');
			echo ($Country == 'DNK' ? 'Denmark' : '');
			echo ($Country == 'DJI' ? 'Djibouti' : '');
			echo ($Country == 'DMA' ? 'Dominica' : '');
			echo ($Country == 'DOM' ? 'Dominican Republic' : '');
			echo ($Country == 'ECU' ? 'Ecuador' : '');
			echo ($Country == 'EGY' ? 'Egypt' : '');
			echo ($Country == 'SLV' ? 'El Salvador' : '');
			echo ($Country == 'GNQ' ? 'Equatorial Guinea' : '');
			echo ($Country == 'ERI' ? 'Eritrea' : '');
			echo ($Country == 'EST' ? 'Estonia' : '');
			echo ($Country == 'ETH' ? 'Ethiopia' : '');
			echo ($Country == 'FLK' ? 'Falkland Islands (Malvinas)' : '');
			echo ($Country == 'FRO' ? 'Faroe Islands' : '');
			echo ($Country == 'FJI' ? 'Fiji' : '');
			echo ($Country == 'FIN' ? 'Finland' : '');
			echo ($Country == 'FRA' ? 'France' : '');
			echo ($Country == 'GUF' ? 'French Guiana' : '');
			echo ($Country == 'PYF' ? 'French Polynesia' : '');
			echo ($Country == 'ATF' ? 'French Southern Territories' : '');
			echo ($Country == 'GAB' ? 'Gabon' : '');
			echo ($Country == 'GMB' ? 'Gambia' : '');
			echo ($Country == 'GEO' ? 'Georgia' : '');
			echo ($Country == 'DEU' ? 'Germany' : '');
			echo ($Country == 'GHA' ? 'Ghana' : '');
			echo ($Country == 'GIB' ? 'Gibraltar' : '');
			echo ($Country == 'GRC' ? 'Greece' : '');
			echo ($Country == 'GRL' ? 'Greenland' : '');
			echo ($Country == 'GRD' ? 'Grenada' : '');
			echo ($Country == 'GLP' ? 'Guadeloupe' : '');
			echo ($Country == 'GUM' ? 'Guam' : '');
			echo ($Country == 'GTM' ? 'Guatemala' : '');
			echo ($Country == 'GGY' ? 'Guernsey' : '');
			echo ($Country == 'GIN' ? 'Guinea' : '');
			echo ($Country == 'GNB' ? 'Guinea-Bissau' : '');
			echo ($Country == 'GUY' ? 'Guyana' : '');
			echo ($Country == 'HTI' ? 'Haiti' : '');
			echo ($Country == 'HMD' ? 'Heard Island and McDonald Islands' : '');
			echo ($Country == 'VAT' ? 'Holy See (Vatican City State)' : '');
			echo ($Country == 'HND' ? 'Honduras' : '');
			echo ($Country == 'HKG' ? 'Hong Kong' : '');
			echo ($Country == 'HUN' ? 'Hungary' : '');
			echo ($Country == 'ISL' ? 'Iceland' : '');
			echo ($Country == 'IND' ? 'India' : '');
			echo ($Country == 'IDN' ? 'Indonesia' : '');
			echo ($Country == 'IRN' ? 'Iran, Islamic Republic of' : '');
			echo ($Country == 'IRQ' ? 'Iraq' : '');
			echo ($Country == 'IRL' ? 'Ireland' : '');
			echo ($Country == 'IMN' ? 'Isle of Man' : '');
			echo ($Country == 'ISR' ? 'Israel' : '');
			echo ($Country == 'ITA' ? 'Italy' : '');
			echo ($Country == 'JAM' ? 'Jamaica' : '');
			echo ($Country == 'JPN' ? 'Japan' : '');
			echo ($Country == 'JEY' ? 'Jersey' : '');
			echo ($Country == 'JOR' ? 'Jordan' : '');
			echo ($Country == 'KAZ' ? 'Kazakhstan' : '');
			echo ($Country == 'KEN' ? 'Kenya' : '');
			echo ($Country == 'KIR' ? 'Kiribati' : '');
			echo ($Country == 'PRK' ? 'Korea, Democratic Peoples Republic of' : '');
			echo ($Country == 'KOR' ? 'Korea, Republic of' : '');
			echo ($Country == 'KWT' ? 'Kuwait' : '');
			echo ($Country == 'KGZ' ? 'Kyrgyzstan' : '');
			echo ($Country == 'LAO' ? 'Lao Peoples Democratic Republic' : '');
			echo ($Country == 'LVA' ? 'Latvia' : '');
			echo ($Country == 'LBN' ? 'Lebanon' : '');
			echo ($Country == 'LSO' ? 'Lesotho' : '');
			echo ($Country == 'LBR' ? 'Liberia' : '');
			echo ($Country == 'LBY' ? 'Libya' : '');
			echo ($Country == 'LIE' ? 'Liechtenstein' : '');
			echo ($Country == 'LTU' ? 'Lithuania' : '');
			echo ($Country == 'LUX' ? 'Luxembourg' : '');
			echo ($Country == 'MAC' ? 'Macao' : '');
			echo ($Country == 'MKD' ? 'Macedonia, the former Yugoslav Republic of' : '');
			echo ($Country == 'MDG' ? 'Madagascar' : '');
			echo ($Country == 'MWI' ? 'Malawi' : '');
			echo ($Country == 'MYS' ? 'Malaysia' : '');
			echo ($Country == 'MDV' ? 'Maldives' : '');
			echo ($Country == 'MLI' ? 'Mali' : '');
			echo ($Country == 'MLT' ? 'Malta' : '');
			echo ($Country == 'MHL' ? 'Marshall Islands' : '');
			echo ($Country == 'MTQ' ? 'Martinique' : '');
			echo ($Country == 'MRT' ? 'Mauritania' : '');
			echo ($Country == 'MUS' ? 'Mauritius' : '');
			echo ($Country == 'MYT' ? 'Mayotte' : '');
			echo ($Country == 'MEX' ? 'Mexico' : '');
			echo ($Country == 'FSM' ? 'Micronesia, Federated States of' : '');
			echo ($Country == 'MDA' ? 'Moldova, Republic of' : '');
			echo ($Country == 'MCO' ? 'Monaco' : '');
			echo ($Country == 'MNG' ? 'Mongolia' : '');
			echo ($Country == 'MNE' ? 'Montenegro' : '');
			echo ($Country == 'MSR' ? 'Montserrat' : '');
			echo ($Country == 'MAR' ? 'Morocco' : '');
			echo ($Country == 'MOZ' ? 'Mozambique' : '');
			echo ($Country == 'MMR' ? 'Myanmar' : '');
			echo ($Country == 'NAM' ? 'Namibia' : '');
			echo ($Country == 'NRU' ? 'Nauru' : '');
			echo ($Country == 'NPL' ? 'Nepal' : '');
			echo ($Country == 'NLD' ? 'Netherlands' : '');
			echo ($Country == 'NCL' ? 'New Caledonia' : '');
			echo ($Country == 'NZL' ? 'New Zealand' : '');
			echo ($Country == 'NIC' ? 'Nicaragua' : '');
			echo ($Country == 'NER' ? 'Niger' : '');
			echo ($Country == 'NGA' ? 'Nigeria' : '');
			echo ($Country == 'NIU' ? 'Niue' : '');
			echo ($Country == 'NFK' ? 'Norfolk Island' : '');
			echo ($Country == 'MNP' ? 'Northern Mariana Islands' : '');
			echo ($Country == 'NOR' ? 'Norway' : '');
			echo ($Country == 'OMN' ? 'Oman' : '');
			echo ($Country == 'PAK' ? 'Pakistan' : '');
			echo ($Country == 'PLW' ? 'Palau' : '');
			echo ($Country == 'PSE' ? 'Palestinian Territory, Occupied' : '');
			echo ($Country == 'PAN' ? 'Panama' : '');
			echo ($Country == 'PNG' ? 'Papua New Guinea' : '');
			echo ($Country == 'PRY' ? 'Paraguay' : '');
			echo ($Country == 'PER' ? 'Peru' : '');
			echo ($Country == 'PHL' ? 'Philippines' : '');
			echo ($Country == 'PCN' ? 'Pitcairn' : '');
			echo ($Country == 'POL' ? 'Poland' : '');
			echo ($Country == 'PRT' ? 'Portugal' : '');
			echo ($Country == 'PRI' ? 'Puerto Rico' : '');
			echo ($Country == 'QAT' ? 'Qatar' : '');
			echo ($Country == 'REU' ? 'Réunion' : '');
			echo ($Country == 'ROU' ? 'Romania' : '');
			echo ($Country == 'RUS' ? 'Russian Federation' : '');
			echo ($Country == 'RWA' ? 'Rwanda' : '');
			echo ($Country == 'BLM' ? 'Saint Barthélemy' : '');
			echo ($Country == 'SHN' ? 'Saint Helena, Ascension and Tristan da Cunha' : '');
			echo ($Country == 'KNA' ? 'Saint Kitts and Nevis' : '');
			echo ($Country == 'LCA' ? 'Saint Lucia' : '');
			echo ($Country == 'MAF' ? 'Saint Martin (French part)' : '');
			echo ($Country == 'SPM' ? 'Saint Pierre and Miquelon' : '');
			echo ($Country == 'VCT' ? 'Saint Vincent and the Grenadines' : '');
			echo ($Country == 'WSM' ? 'Samoa' : '');
			echo ($Country == 'SMR' ? 'San Marino' : '');
			echo ($Country == 'STP' ? 'Sao Tome and Principe' : '');
			echo ($Country == 'SAU' ? 'Saudi Arabia' : '');
			echo ($Country == 'SEN' ? 'Senegal' : '');
			echo ($Country == 'SRB' ? 'Serbia' : '');
			echo ($Country == 'SYC' ? 'Seychelles' : '');
			echo ($Country == 'SLE' ? 'Sierra Leone' : '');
			echo ($Country == 'SGP' ? 'Singapore' : '');
			echo ($Country == 'SXM' ? 'Sint Maarten (Dutch part)' : '');
			echo ($Country == 'SVK' ? 'Slovakia' : '');
			echo ($Country == 'SVN' ? 'Slovenia' : '');
			echo ($Country == 'SLB' ? 'Solomon Islands' : '');
			echo ($Country == 'SOM' ? 'Somalia' : '');
			echo ($Country == 'ZAF' ? 'South Africa' : '');
			echo ($Country == 'SGS' ? 'South Georgia and the South Sandwich Islands' : '');
			echo ($Country == 'SSD' ? 'South Sudan' : '');
			echo ($Country == 'ESP' ? 'Spain' : '');
			echo ($Country == 'LKA' ? 'Sri Lanka' : '');
			echo ($Country == 'SDN' ? 'Sudan' : '');
			echo ($Country == 'SUR' ? 'Suriname' : '');
			echo ($Country == 'SJM' ? 'Svalbard and Jan Mayen' : '');
			echo ($Country == 'SWZ' ? 'Swaziland' : '');
			echo ($Country == 'SWE' ? 'Sweden' : '');
			echo ($Country == 'CHE' ? 'Switzerland' : '');
			echo ($Country == 'SYR' ? 'Syrian Arab Republic' : '');
			echo ($Country == 'TWN' ? 'Taiwan, Province of China' : '');
			echo ($Country == 'TJK' ? 'Tajikistan' : '');
			echo ($Country == 'TZA' ? 'Tanzania, United Republic of' : '');
			echo ($Country == 'THA' ? 'Thailand' : '');
			echo ($Country == 'TLS' ? 'Timor-Leste' : '');
			echo ($Country == 'TGO' ? 'Togo' : '');
			echo ($Country == 'TKL' ? 'Tokelau' : '');
			echo ($Country == 'TON' ? 'Tonga' : '');
			echo ($Country == 'TTO' ? 'Trinidad and Tobago' : '');
			echo ($Country == 'TUN' ? 'Tunisia' : '');
			echo ($Country == 'TUR' ? 'Turkey' : '');
			echo ($Country == 'TKM' ? 'Turkmenistan' : '');
			echo ($Country == 'TCA' ? 'Turks and Caicos Islands' : '');
			echo ($Country == 'TUV' ? 'Tuvalu' : '');
			echo ($Country == 'UGA' ? 'Uganda' : '');
			echo ($Country == 'UKR' ? 'Ukraine' : '');
			echo ($Country == 'ARE' ? 'United Arab Emirates' : '');
			echo ($Country == 'GBR' ? 'United Kingdom' : '');
			echo ($Country == 'USA' ? 'United States' : '');
			echo ($Country == 'UMI' ? 'United States Minor Outlying Islands' : '');
			echo ($Country == 'URY' ? 'Uruguay' : '');
			echo ($Country == 'UZB' ? 'Uzbekistan' : '');
			echo ($Country == 'VUT' ? 'Vanuatu' : '');
			echo ($Country == 'VEN' ? 'Venezuela, Bolivarian Republic of' : '');
			echo ($Country == 'VNM' ? 'Viet Nam' : '');
			echo ($Country == 'VGB' ? 'Virgin Islands, British' : '');
			echo ($Country == 'VIR' ? 'Virgin Islands, U.S.' : '');
			echo ($Country == 'WLF' ? 'Wallis and Futuna' : '');
			echo ($Country == 'ESH' ? 'Western Sahara' : '');
			echo ($Country == 'YEM' ? 'Yemen' : '');
			echo ($Country == 'ZMB' ? 'Zambia' : '');
			echo ($Country == 'ZWE' ? 'Zimbabwe' : '');
	}
	
	function get_month_name($Month=0)
	{
		if($Month == 1)
		{
			return 'January';
		}
		else if($Month == 2)
		{
			return 'February';
		}
		else if($Month == 3)
		{
			return 'March';
		}
		else if($Month == 4)
		{
			return 'April';
		}
		else if($Month == 5)
		{
			return 'May';
		}
		else if($Month == 6)
		{
			return 'June';
		}
		else if($Month == 7)
		{
			return 'July';
		}
		else if($Month == 8)
		{
			return 'August';
		}
		else if($Month == 9)
		{
			return 'September';
		}
		else if($Month == 10)
		{
			return 'October';
		}
		else if($Month == 11)
		{
			return 'November';
		}
		else if($Month == 12)
		{
			return 'December';
		}
		else
		{
			return 0;
		}
	}
	
	function get_day_name($Day=0)
	{
		if($Day == 1)
		{
			return 'Monday';
		}
		else if($Day == 2)
		{
			return 'Tuesday';
		}
		else if($Day == 3)
		{
			return 'Wednesday';
		}
		else if($Day == 4)
		{
			return 'Thursday';
		}
		else if($Day == 5)
		{
			return 'Friday';
		}
		else if($Day == 6)
		{
			return 'Saturday';
		}
		else if($Day == 7)
		{
			return 'Sunday';
		}
		else
		{
			return 0;
		}
	}
	
	function days_in_month($month, $year) 
	{ 
	// calculate number of days in a month 
	return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
	}
	
	function overtime_amount_per_hour($OvertimesHours,$Month,$Year,$BasicSalary)
	{
		$PerDayHours=0;
		$Num_Of_Days_In_Month = 0;
		$Amount = 0;
		
		$query = "SELECT PerDayHours FROM organization_settings where ID <> 0";
		$res = mysql_query($query) or die(mysql_error());
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$row = mysql_fetch_array($res);
			$PerDayHours = $row['PerDayHours'];
		}
		
		$Num_Of_Days_In_Month = days_in_month($Month, $Year);
		
		$Amount = $BasicSalary / $Num_Of_Days_In_Month;
		$Amount = $Amount / $PerDayHours;
		return $Amount;
	}
	
	function overtime_amount($OvertimesHours=0,$Days=0,$Type="",$Base="",$Value=0,$BasicSalary=0,$GrossSalary=0,$CompID=0,$OvertimeHolidayDays=0)
	{
		$PerDayHours=0;
		$Amount = 0;
		
		$query = "SELECT PerDayHours FROM companies where ID <> 0 AND Status = 1 AND ID=".$CompID."";
		$res = mysql_query($query) or die(mysql_error());
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$row = mysql_fetch_array($res);
			$PerDayHours = $row['PerDayHours'];
		}
		
		if($Type == "FixedAmount")
		{
			$Amount = $OvertimesHours * $Value;
		}
		else if($Type == "Percentage")
		{
			if($Base == "Gross Per Hour")
			{
				$Amount = $GrossSalary / $Days;
				$Amount = $Amount / $PerDayHours;
				$Amount = ($Value / 100) * $Amount;
				$Amount = $OvertimesHours * $Amount;
			}
			else if($Base == "Basic Per Hour")
			{
				$Amount = $BasicSalary / $Days;
				$Amount = $Amount / $PerDayHours;
				$Amount = ($Value / 100) * $Amount;
				$Amount = $OvertimesHours * $Amount;
			}
			else if($Base == "Gross Per Day")
			{
				// $Amount = $GrossSalary / $Days;
				// $Amount = ($Value / 100) * $Amount;
				// $Amount = $OvertimesHours * $Amount;
				
				$Amount = $GrossSalary / $Days;
				$Amount = ($Value / 100) * $Amount;
				$Amount = $OvertimeHolidayDays * $Amount;
			}
			else if($Base == "Basic Per Day")
			{
				// $Amount = $BasicSalary / $Days;
				// $Amount = ($Value / 100) * $Amount;
				// $Amount = $OvertimesHours * $Amount;
				
				$Amount = $BasicSalary / $Days;
				$Amount = ($Value / 100) * $Amount;
				$Amount = $OvertimeHolidayDays * $Amount;
			}
		}
		
		return $Amount;
	}
	
	function get_my_attendance($Month=0,$Year=0,$UserID,$Type)
	{
		$NoOfDays =0;
		$OnTime =0;
		$Late =0;	
		
		$res = mysql_query("SELECT NoOfDays,OnTime,Late FROM attendance WHERE UserID = ".(int)$UserID." AND Month = '".($Month != 0 ? get_month_name($Month) : date("F"))."' AND Year = ".($Year != 0 ? $Year : date("Y"))."") or die(mysql_error());
		$rowss =  mysql_num_rows($res);
		$Rs = mysql_fetch_assoc($res);
		$NoOfDays = $Rs['NoOfDays'];
		$OnTime = $Rs['OnTime'];
		$Late = $Rs['Late'];
		
		if($rowss == 0)
			return 0;
		else
		{
		if($Type == 1)
			return $NoOfDays;
		if($Type == 2)
			return $OnTime;
		if($Type == 3)
			return $Late;
		}
	}
	
	function time_format_function($Time)
	{
		$T=array();
		$RT=array();
		$H="";
		$M="";
		$AMPM="";
		
		$T = explode(' ',$Time);
		$AMPM = $T[1];
		$RT = explode(':',$T[0]);
		$H=$RT[0];
		$M=$RT[1];
		
		if($AMPM == "PM")
		{
			if($H == "01")
			{
				$H = "13";
			}
			else if($H == "02")
			{
				$H = "14";
			}
			else if($H == "03")
			{
				$H = "15";
			}
			else if($H == "04")
			{
				$H = "16";
			}
			else if($H == "05")
			{
				$H = "17";
			}
			else if($H == "06")
			{
				$H = "18";
			}
			else if($H == "07")
			{
				$H = "19";
			}
			else if($H == "08")
			{
				$H = "20";
			}
			else if($H == "09")
			{
				$H = "21";
			}
			else if($H == "10")
			{
				$H = "22";
			}
			else if($H == "11")
			{
				$H = "23";
			}
		}
		else if($AMPM == "AM")
		{
			if($H == "12")
			{
				$H = "00";
			}
		}
		echo $H.','.$M;
	}
	
	function time_format_gracetime($Time)
	{
		$T=array();
		$RT=array();
		$H="";
		$M="";
		$AMPM="";
		
		$T = explode(' ',$Time);
		$AMPM = $T[1];
		$RT = explode(':',$T[0]);
		$H=$RT[0];
		$M=$RT[1];
		
		if($AMPM == "PM")
		{
			if($H == "01")
			{
				$H = "13";
			}
			else if($H == "02")
			{
				$H = "14";
			}
			else if($H == "03")
			{
				$H = "15";
			}
			else if($H == "04")
			{
				$H = "16";
			}
			else if($H == "05")
			{
				$H = "17";
			}
			else if($H == "06")
			{
				$H = "18";
			}
			else if($H == "07")
			{
				$H = "19";
			}
			else if($H == "08")
			{
				$H = "20";
			}
			else if($H == "09")
			{
				$H = "21";
			}
			else if($H == "10")
			{
				$H = "22";
			}
			else if($H == "11")
			{
				$H = "23";
			}
		}
		else if($AMPM == "AM")
		{
			if($H == "12")
			{
				$H = "00";
			}
		}
		return $H.':'.$M.':00';
	}
	
	function revert_time_format_gracetime($Time)
	{
		$T=array();
		$H="";
		$M="";
		$Real="";
		
		$T = explode(':',$Time);
		$H=$T[0];
		$M=$T[1];
		
		
		if($H == "00")
		{
			$Real = '12:'.$M.' AM';
		}
		else if($H == "01")
		{
			$Real = '01:'.$M.' AM';
		}
		else if($H == "02")
		{
			$Real = '02:'.$M.' AM';
		}
		else if($H == "03")
		{
			$Real = '03:'.$M.' AM';
		}
		else if($H == "04")
		{
			$Real = '04:'.$M.' AM';
		}
		else if($H == "05")
		{
			$Real = '05:'.$M.' AM';
		}
		else if($H == "06")
		{
			$Real = '06:'.$M.' AM';
		}
		else if($H == "07")
		{
			$Real = '07:'.$M.' AM';
		}
		else if($H == "08")
		{
			$Real = '08:'.$M.' AM';
		}
		else if($H == "09")
		{
			$Real = '09:'.$M.' AM';
		}
		else if($H == "10")
		{
			$Real = '10:'.$M.' AM';
		}
		else if($H == "11")
		{
			$Real = '11:'.$M.' AM';
		}
		else if($H == "12")
		{
			$Real = '12:'.$M.' PM';
		}
		else if($H == "13")
		{
			$Real = '01:'.$M.' PM';
		}
		else if($H == "14")
		{
			$Real = '02:'.$M.' PM';
		}
		else if($H == "15")
		{
			$Real = '03:'.$M.' PM';
		}
		else if($H == "16")
		{
			$Real = '04:'.$M.' PM';
		}
		else if($H == "17")
		{
			$Real = '05:'.$M.' PM';
		}
		else if($H == "18")
		{
			$Real = '06:'.$M.' PM';
		}
		else if($H == "19")
		{
			$Real = '07:'.$M.' PM';
		}
		else if($H == "20")
		{
			$Real = '08:'.$M.' PM';
		}
		else if($H == "21")
		{
			$Real = '09:'.$M.' PM';
		}
		else if($H == "22")
		{
			$Real = '10:'.$M.' PM';
		}
		else if($H == "23")
		{
			$Real = '11:'.$M.' PM';
		}
		
		return $Real;
	}
	function empCodeByID($ID)
	{
		$EmpID = "";
		$res = mysql_query("SELECT EmpID FROM employees WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$EmpID = $r['EmpID'];
		}
		return $EmpID;
	}
	
	
	
	function empTestStatusByID($ID=0,$tst=0,$tr=0)
	{
		$sql2 = "SELECT ID, StudentID, TestID, Grade, Attempts FROM stud_answers WHERE StudentID = '".(int)$ID."' AND TestID = '".(int)$tst."' AND (Grade = 'Passed' OR Attempts = ".NUM_OF_TEST_ATTEMPTS.")";
		$da2 = mysql_query($sql2);
		$ro2 = mysql_fetch_assoc($da2);
		if($ro2['StudentID'] == (int)$ID && $ro2['TestID'] == (int)$tst && ($ro2['Grade'] == 'Passed' || $ro2['Attempts'] == NUM_OF_TEST_ATTEMPTS))
		{
			return '<span class="btn" style="background:'.($ro2['Grade'] == 'Passed' ? 'green' : 'red').'; color:#fff;">Given | '.($ro2['Grade'] == 'Passed' ? 'Passed' : 'Failed').'</span> <a href="DeleteTest.php?Emp='.$ID.'&Test='.$tst.'&Training='.$tr.'" class="btn btn-info"><i class="fa fa-refresh"></i></a>';
		}
		else{
			return '<span class="btn" style="background:purple; color:#fff;">Not Given Yet</span>';
		}
	}
	
	function CompanyByEmployeeID($ID=0)
	{
		$CompanyID = 0;
		$res = mysql_query("SELECT CompanyID FROM employees WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$CompanyID = $r['CompanyID'];
			return $CompanyID;
		}
		else
		{
			return 0;
		}
		
	}
	
	function CompanyNameByID($ID=0)
	{
		$Name = "";
		$res = mysql_query("SELECT Name FROM companies WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['Name'];
			return $Name;
		}
		
	}
	
	function LocationNameByID($ID=0)
	{
		$Name = "";
		$res = mysql_query("SELECT Name FROM locations WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['Name'];
			return $Name;
		}
		
	}
	
	function ScheduleNameByID($ID=0)
	{
		$Name = "";
		$res = mysql_query("SELECT Name FROM schedules WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['Name'];
			return $Name;
		}
		
	}
	
	function OvertimePolicyNameByID($ID=0)
	{
		$Name = "";
		$res = mysql_query("SELECT Name FROM overtime_policies WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['Name'];
			return $Name;
		}
		return 'No Policy';
		
	}
		
	function empInfoByID($ID=0,$tst=0,$tr=0)
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT EmpID,FirstName,LastName,Designation,Department FROM employees WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$EmpID = $r['EmpID'];
			$Name = $r['FirstName'].' '.$r['LastName'];
			$Department = $r['Department'];
			$Designation = $r['Designation'];
			return '<tr><td>'.$Name.'</td><td>'.$EmpID.'</td><td>'.$Department.'</td><td>'.$Designation.'</td><td>'.empTestStatusByID($ID,$tst,$tr).'</td></tr>';
		}
		
	}
	
    function empNameByEmpID($ID=0)
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT FirstName,LastName FROM employees WHERE EmpID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['FirstName'].' '.$r['LastName'];
			return $Name;
		}
		
	}
	
	function RoleNameByEmpID($ID=0)
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT Role FROM employees WHERE EmpID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['Role'];
			return $Name;
		}
		
	}
	
	function empAppraisalStatusByEmp($ID=0,$app=0)
	{
		$sql2 = "SELECT ID, EmpMarks,SupMarks FROM appraisals_result WHERE EmpID = '".(int)$ID."' AND AppraisalID = '".(int)$app."'";
		$da2 = mysql_query($sql2);
		$ro2 = mysql_fetch_assoc($da2);
		if($ro2['EmpMarks'] > 0)
		{
			return '<span class="btn" style="background:purple; color:#fff;">'.$ro2['EmpMarks'].'</span>';
		}
		else{
			return 'Not Rate Yet';
		}
	}
	
	function empAppraisalStatusBySup($ID=0,$app=0)
	{
		$sql2 = "SELECT ID, EmpMarks,SupMarks FROM appraisals_result WHERE EmpID = '".(int)$ID."' AND AppraisalID = '".(int)$app."'";
		$da2 = mysql_query($sql2);
		$ro2 = mysql_fetch_assoc($da2);
		if($ro2['SupMarks'] > 0)
		{
			return '<span class="btn" style="background:green; color:#fff;">'.$ro2['SupMarks'].'</span>';
		}
		else{
			return 'Not Rate Yet';
		}
	}
	
	function empInfoByIDAppraisal($ID=0,$app=0)
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT EmpID,FirstName,LastName,Designation,Department FROM employees WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$EmpID = $r['EmpID'];
			$Name = $r['FirstName'].' '.$r['LastName'];
			$Department = $r['Department'];
			$Designation = $r['Designation'];
			return '<tr><td>'.$Name.'</td><td>'.$EmpID.'</td><td>'.$Department.'</td><td>'.$Designation.'</td><td>'.empAppraisalStatusByEmp($ID,$app).'</td><td>'.empAppraisalStatusBySup($ID,$app).'</td></tr>';
		}
		
	}
	
	function empInfoByCode($ID="")
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT EmpID,FirstName,LastName,Designation,Department FROM employees WHERE EmpID = '".$ID."'");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$EmpID = $r['EmpID'];
			$Name = $r['FirstName'].' '.$r['LastName'];
			$Department = $r['Department'];
			$Designation = $r['Designation'];
			return $EmpID.' | '.$Name.' | '.$Department.' - '.$Designation;
		}
		else
		{
			return "Employee Not Valid!";
		}
	}
	
	function getDepartmentById($ID=""){
	    $res = mysql_query("SELECT * FROM departments WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num > 0){
		    $r = mysql_fetch_array($res);
			$ID = $r['ID'];
			$Department = $r['Department'];
			$Status= $r['Status'];
			$data = array(
			  'id'=>$r['ID'],
			  'department'=>$r['Department']
			);
			return $data;
		} else {
		    return 0;
		}
	}
	
	function AuthorizedempInfoByID($ID=0)
	{
		$Name = "";
		$EmpID = "";
		$Department = "";
		$Designation = "";
		$res = mysql_query("SELECT EmpID,FirstName,LastName,Designation,Department FROM employees WHERE ID = ".(int)$ID."");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$EmpID = $r['EmpID'];
			$Name = $r['FirstName'].' '.$r['LastName'];
			$Department = $r['Department'];
			$Designation = $r['Designation'];
			return '<tr><td>'.$Name.'</td><td>'.$EmpID.'</td><td>'.$Department.'</td><td>'.$Designation.'</td></tr>';
		}
		
	}
	
	function canTestStatusByID($ID=0,$tst=0,$tr=0)
	{
		$sql2 = "SELECT ID, CandidateID, PostID, Score FROM candidates_answers WHERE CandidateID = '".(int)$ID."' AND PostID = '".(int)$tst."' AND Score > 0";
		$da2 = mysql_query($sql2);
		$ro2 = mysql_fetch_assoc($da2);
		if($ro2['CandidateID'] == (int)$ID && $ro2['PostID'] == (int)$tst && $ro2['Score'] > 0)
		{
			return '<span class="btn" style="background:'.($ro2['Score'] >= INTERVIEW_PERCENTAGE ? 'green' : 'red').'; color:#fff;">Given | '.$ro2['Score'].'%</span> <a href="DeleteInterview.php?Can='.$ID.'&Post='.$tst.'&Interview='.$tr.'" class="btn btn-warning"><i class="fa fa-refresh"></i></a> <a href="ShortlistCandidateNow.php?Can='.$ID.'&Interview='.$tr.'" class="btn btn-success"><i class="fa fa-filter"></i></a> <a href="DisqualifiedCandidateNow.php?Can='.$ID.'&Interview='.$tr.'" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></a>';
		}
		else{
			return '<span class="btn" style="background:purple; color:#fff;">Not Given Yet</span> <a href="TakeInterview.php?CanID='.$ID.'&PostID='.$tst.'" class="btn btn-warning">Take an Interview</a> <a href="ShortlistCandidateNow.php?Can='.$ID.'&Interview='.$tr.'" class="btn btn-success"><i class="fa fa-filter"></i></a> <a href="DisqualifiedCandidateNow.php?Can='.$ID.'&Interview='.$tr.'" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></a>';
		}
	}
		
	function canInfoByID($ID=0,$tst=0,$tr=0)
	{
		$Name = "";
		$Emailaddress = "";
		$Phone = "";
		$Resume = "";
		$res = mysql_query("SELECT c.FirstName,c.LastName,c.Emailaddress,c.Phone,r.Resume FROM candidates c LEFT JOIN resumes r ON c.Resume = r.ID WHERE c.ID = ".(int)$ID." AND c.IsShortlist = 'No' AND c.IsDisqualified = 'No' AND ApplyedFor='".$tst."'");
		$num = mysql_num_rows($res);
		if($num == 1)
		{
			$r = mysql_fetch_array($res);
			$Name = $r['FirstName'].' '.$r['LastName'];
			$Emailaddress = $r['Emailaddress'];
			$Phone = $r['Phone'];
			$Resume = $r['Resume'];
			return '<tr><td>'.$Name.'</td><td>'.$Emailaddress.'</td><td>'.$Phone.'</td><td><a href="assets/resumes/'.$Resume.'" class="btn btn-default" target="_Blank">View</a></td><td>'.canTestStatusByID($ID,$tst,$tr).'</td></tr>';
		}
		
	}
	
	function number_of_working_days($first_day_this_month, $last_day_this_month,$Month,$Year,$Employee) {
			
			$GazettedHolidaysFormula="";
			$ApprovedLeavesFormula="";
			$WorkingDaysOrganizationFormula="";
			
			$query = "SELECT WorkingDays FROM organization_settings where ID <> 0";
			$res = mysql_query($query) or die(mysql_error());
			$num_workingDaysFormula = mysql_num_rows($res);
			if($num_workingDaysFormula == 1)
			{
				$row1 = mysql_fetch_array($res);
				$WorkingDaysOrganizationFormula = $row1['WorkingDays'];
			}

			$query = "SELECT Date FROM gazetted_holidays WHERE Approved = 1 AND DATE_FORMAT(Date, '%m') = ".$Month."  AND DATE_FORMAT(Date, '%Y') = ".$Year."";
			$res = mysql_query($query) or die(mysql_error());
			$num_holidaysFormula = mysql_num_rows($res);
			if($num_holidaysFormula > 0)
			{
				while($row2 = mysql_fetch_array($res))
				{
					$GazettedHolidaysFormula .= $row2['Date'].',';
				}
			}
			
			$query = "SELECT LeaveDate FROM minus_leaves_quota WHERE EmpID = ".$Employee." AND DATE_FORMAT(LeaveDate, '%m') = ".$Month."  AND DATE_FORMAT(LeaveDate, '%Y') = ".$Year."";
			$res = mysql_query($query) or die(mysql_error());
			$num_approvedLeavesFormula = mysql_num_rows($res);
			if($num_approvedLeavesFormula > 0)
			{
				while($row3 = mysql_fetch_array($res))
				{
					$ApprovedLeavesFormula .= $row3['LeaveDate'].',';
				}
			}
			
			
			$workingDaysFormula = explode(',', $WorkingDaysOrganizationFormula); # date format = N (1 = Monday, ...)
			$holidayDaysFormula1 = ['1900-01-01']; # variable and fixed holidays
			$holidayDaysFormula2 = explode(',', $GazettedHolidaysFormula);
			$holidayDaysFormula3 = explode(',', $ApprovedLeavesFormula);
			$holidayDaysFormula = array_merge($holidayDaysFormula1,$holidayDaysFormula2,$holidayDaysFormula3);
			
			$first_day_this_month = new DateTime(''.$first_day_this_month.'');
			$last_day_this_month = new DateTime(''.$last_day_this_month.'');
			$last_day_this_month->modify('+1 day');
			$interval = new DateInterval('P1D');
			$periods = new DatePeriod($first_day_this_month, $interval, $last_day_this_month);

			$days = 0;
			foreach ($periods as $period) {
				if (!in_array($period->format('N'), $workingDaysFormula)) continue;
				if (in_array($period->format('Y-m-d'), $holidayDaysFormula)) continue;
				if (in_array($period->format('*-m-d'), $holidayDaysFormula)) continue;
				$days++;
			}
			return $days;
		}
		
		function number_of_working_days_without_weekends($first_day_this_month, $last_day_this_month,$Month,$Year,$Employee) {
			
			$ApprovedLeavesFormula="";

			$query = "SELECT LeaveDate FROM minus_leaves_quota WHERE EmpID = ".$Employee." AND DATE_FORMAT(LeaveDate, '%m') = ".$Month."  AND DATE_FORMAT(LeaveDate, '%Y') = ".$Year."";
			$res = mysql_query($query) or die(mysql_error());
			$num_approvedLeavesFormula = mysql_num_rows($res);
			if($num_approvedLeavesFormula > 0)
			{
				while($row = mysql_fetch_array($res))
				{
					$ApprovedLeavesFormula .= $row['LeaveDate'].',';
				}
			}
			
			
			$workingDaysFormula = [1,2,3,4,5,6,7]; # date format = N (1 = Monday, ...)
			$holidayDaysFormula1 = ['1900-01-01']; # variable and fixed holidays
			$holidayDaysFormula2 = explode(',', $ApprovedLeavesFormula);
			$holidayDaysFormula = array_merge($holidayDaysFormula1,$holidayDaysFormula2);
			
			$first_day_this_month = new DateTime(''.$first_day_this_month.'');
			$last_day_this_month = new DateTime(''.$last_day_this_month.'');
			$last_day_this_month->modify('+1 day');
			$interval = new DateInterval('P1D');
			$periods = new DatePeriod($first_day_this_month, $interval, $last_day_this_month);

			$days = 0;
			foreach ($periods as $period) {
				if (!in_array($period->format('N'), $workingDaysFormula)) continue;
				if (in_array($period->format('Y-m-d'), $holidayDaysFormula)) continue;
				if (in_array($period->format('*-m-d'), $holidayDaysFormula)) continue;
				$days++;
			}
			return $days;
		}
		
		function  total_tests()
		{
			
			$res = mysql_query("SELECT * FROM tests") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_questions()
		{
			
			$res = mysql_query("SELECT * FROM questions") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_answers()
		{
			
			$res = mysql_query("SELECT * FROM answers") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_employees_in_department($Department)
		{
			
			$res = mysql_query("SELECT * FROM employees WHERE Department = '".$Department."'") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_employees_in_designation($Designation)
		{
			
			$res = mysql_query("SELECT * FROM employees WHERE Designation = '".$Designation."'") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_employees_in_grade($Grade)
		{
			
			$res = mysql_query("SELECT * FROM employees WHERE Grade = '".$Grade."'") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_employees_in_businessunit($BusinessUnit)
		{
			
			$res = mysql_query("SELECT * FROM employees WHERE BusinessUnit = '".$BusinessUnit."'") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function  total_employees_in_subdepartment($SubDepartment)
		{
			
			$res = mysql_query("SELECT * FROM employees WHERE SubDepartment = '".$SubDepartment."'") or die(mysql_error());
			$Rs = mysql_fetch_assoc($res);
			$Students = mysql_num_rows($res);
			return $Students;
		}
		function user_authentication($Emp = 0,$Right="")
		{
			$res = mysql_query("SELECT ID FROM security WHERE EmpID = ".(int)$Emp." AND FIND_IN_SET('".$Right."',Rights) AND Status = 1") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 0)
			{
				return 0;
			}
			else
			{
				if($_SESSION['IsEmployee'] == true)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		function external_user_authentication($Emp = 0,$Right="")
		{
			$res = mysql_query("SELECT ID FROM externalusers WHERE ID = ".(int)$Emp." AND FIND_IN_SET('".$Right."',Rights) AND Status = 'Active'") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 0)
			{
				return 0;
			}
			else
			{
				if($_SESSION['IsEmployee'] == false)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		function user_authentication_with_company($Emp = 0,$Right="",$Company="")
		{
			$res = mysql_query("SELECT ID FROM security WHERE EmpID = ".(int)$Emp." AND FIND_IN_SET('".$Right."',Rights) AND FIND_IN_SET('".$Company."',Companies) AND Status = 1") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 0)
			{
				return 0;
			}
			else
			{
				if($_SESSION['IsEmployee'] == true)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		function external_user_authentication_with_company($Emp = 0,$Right="",$Company="")
		{
			$res = mysql_query("SELECT ID FROM externalusers WHERE ID = ".(int)$Emp." AND FIND_IN_SET('".$Right."',Rights) AND FIND_IN_SET('".$Company."',Companies) AND Status = 'Active'") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 0)
			{
				return 0;
			}
			else
			{
				if($_SESSION['IsEmployee'] == false)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		function user_arrivaltime($Emp = 0)
		{
			$res = mysql_query("SELECT LoginTime FROM roster_login_history WHERE ID = ".(int)$Emp."") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 0)
			{
				//return '9:0';
				return '';
			}
			else
			{
				$row = mysql_fetch_array($res);
				if($row['LoginTime'] == null)
				{
					//return '9:0';
					return '';
				}
				else
				{
					return $row['LoginTime'];
				}
			}
		}
		function user_departtime($Emp = 0)
		{
			$res = mysql_query("SELECT UserID,DateAdded FROM roster_login_history WHERE ID = ".(int)$Emp."") or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				$res2 = mysql_query("SELECT LogoutTime FROM roster_logout_history WHERE UserID = ".(int)$row['UserID']." AND DateAdded = '".$row['DateAdded']."'") or die(mysql_error());
				$num2 = mysql_num_rows($res2);
				if($num2 == 0)
				{
					//return '18:0';
					return '';
				}
				else
				{
					$row2 = mysql_fetch_array($res2);
					if($row2['LogoutTime'] == null)
					{
						//return '18:0';
						return '';
					}
					else
					{
						return $row2['LogoutTime'];
					}
				}
			}
		}
		function date_format_Ymd($dt="")
		{	
			$date=date_create($dt);
			return date_format($date,"Y-m-d");
		}
		
		function num_of_increments($ID=0)
		{
			$query="SELECT ID FROM increments WHERE EmpID='" . (int)$ID . "'";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			return $num;
		}
		
		function gross_plus_anual($ID=0)
		{
			$Gross=0;
			$Allowance=0;
			$Total=0;
			$query="SELECT Salary FROM employees WHERE ID='" . (int)$ID . "'";
			$res = mysql_query($query) or die(mysql_error());
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$row = mysql_fetch_array($res);
				$Gross = $row['Salary'];
			}
			
			$query2 = "SELECT Amount FROM allowances where ID <> 0 AND Approved = 1 AND EmpID='" . (int)$ID . "' AND Title = 'Annual Bonus Fix Allowance'";
			$res2 = mysql_query($query2) or die(mysql_error());
			$num2 = mysql_num_rows($res2);
			if($num2 == 1)
			{
				$row2 = mysql_fetch_array($res2);
				$Allowance = $row2['Amount'];
			}
			$Total = $Gross + $Allowance;
			return $Total;
		}
		
		function loan_remaining_amount($ID=0)
		{
			$RemainingAmount=0;
			$query="SELECT RemainingAmount FROM loans WHERE ID='" .(int)$ID . "'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			if($num==1)
			{
				$rows = mysql_fetch_assoc($result);
				$RemainingAmount=dboutput($rows['RemainingAmount']);
			}
			return $RemainingAmount;
		}
		
		function loan_schedule_amount($ID=0)
		{
			$RemainingAmount=0;
			$query="SELECT RepaymentAmount FROM loans WHERE ID='" .(int)$ID . "'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			if($num==1)
			{
				$rows = mysql_fetch_assoc($result);
				$RemainingAmount=dboutput($rows['RepaymentAmount']);
			}
			return $RemainingAmount;
		}
		
		function Payroll_Employee($ID=0)
		{
			$Name = "";
			$res = mysql_query("SELECT FirstName,LastName FROM employees WHERE ID = ".(int)$ID."");
			$num = mysql_num_rows($res);
			if($num == 1)
			{
				$r = mysql_fetch_array($res);
				$Name = $r['FirstName'].' '.$r['LastName'];
				return 'By '.$Name;
			}
			
		}
		
		// function bank_transfer_amount($ID=0,$compid=0,$bank='')
		// {
			// $Total;
			// $query3 = "SELECT SUM(p.GrossOfDays) AS GrossOfDays,SUM(p.WOvertimeA) AS WOvertimeA,SUM(p.LOvertimeA) AS LOvertimeA,SUM(p.OtherAllowances) AS OtherAllowances,SUM(p.OtherDeductions) AS OtherDeductions,SUM(p.IncomeTax) AS IncomeTax FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$bank."' AND p.BankorCash = 'Bank' AND p.StopSalary = 'No' AND p.Resignation = 'No' AND p.PayID = ".$ID." ORDER BY e.ID ASC";
					// $res3 = mysql_query($query3) or die(mysql_error());
					// $num3 = mysql_num_rows($res3);
					// if($num3 > 0)
					// {
						// $row3 = mysql_fetch_array($res3);
						// $Total = round($row3['OtherAllowances'] + round($row3['WOvertimeA'] + $row3['LOvertimeA']) + $row3['GrossOfDays'] - $row3['OtherDeductions'] - $row3['IncomeTax']);
					// }
			// return $Total;
		// }
		
		function bank_transfer_amount($ID=0,$compid=0,$bank='')
		{
			$Total;
			$query3 = "SELECT SUM(p.NetPay) AS NetPay FROM employees e LEFT JOIN payrolldetails p ON e.ID = p.EmpID LEFT JOIN payroll pr ON pr.ID = p.PayID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$bank."' AND p.BankorCash = 'Bank' AND p.StopSalary = 'No' AND p.Resignation = 'No' AND p.PayID = ".$ID." ORDER BY e.ID ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$row3 = mysql_fetch_array($res3);
						$Total = round($row3['NetPay']);
					}
			return $Total;
		}
		
		function bank_transfer_amount_bonus($ID=0,$compid=0,$bank='')
		{
			$Total;
			$query3 = "SELECT SUM(p.NetPay) AS NetPay FROM employees e LEFT JOIN bonusdetails p ON e.ID = p.EmpID LEFT JOIN bonus pr ON pr.ID = p.BonusID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$bank."' AND p.BankorCash = 'Bank' AND p.BonusID = ".$ID." ORDER BY e.ID ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$row3 = mysql_fetch_array($res3);
						$Total = round($row3['NetPay']);
					}
			return $Total;
		}
		
		function bank_transfer_amount_encashment($ID=0,$compid=0,$bank='')
		{
			$Total;
			$query3 = "SELECT SUM(p.NetPay) AS NetPay FROM employees e LEFT JOIN encashmentdetails p ON e.ID = p.EmpID LEFT JOIN encashment pr ON pr.ID = p.EncashmentID WHERE e.ID <> 0 AND e.CompanyID = ".$compid." AND e.Bank = '".$bank."' AND p.BankorCash = 'Bank' AND p.EncashmentID = ".$ID." ORDER BY e.ID ASC";
					$res3 = mysql_query($query3) or die(mysql_error());
					$num3 = mysql_num_rows($res3);
					if($num3 > 0)
					{
						$row3 = mysql_fetch_array($res3);
						$Total = round($row3['NetPay']);
					}
			return $Total;
		}
	

		function convertNumber($number)
		{
			//list($integer, $fraction) = explode(".", (string) $number);
			$integer = $number;
			$fraction = '0';
			
			$output = "";

			if ($integer{0} == "-")
			{
				$output = "negative ";
				$integer    = ltrim($integer, "-");
			}
			else if ($integer{0} == "+")
			{
				$output = "positive ";
				$integer    = ltrim($integer, "+");
			}

			if ($integer{0} == "0")
			{
				$output .= "zero";
			}
			else
			{
				$integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
				$group   = rtrim(chunk_split($integer, 3, " "), " ");
				$groups  = explode(" ", $group);

				$groups2 = array();
				foreach ($groups as $g)
				{
					$groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
				}

				for ($z = 0; $z < count($groups2); $z++)
				{
					if ($groups2[$z] != "")
					{
						$output .= $groups2[$z] . convertGroup(11 - $z) . (
								$z < 11
								&& !array_search('', array_slice($groups2, $z + 1, -1))
								&& $groups2[11] != ''
								&& $groups[11]{0} == '0'
									? " and "
									: ", "
							);
					}
				}

				$output = rtrim($output, ", ");
			}

			if ($fraction > 0)
			{
				$output .= " point";
				for ($i = 0; $i < strlen($fraction); $i++)
				{
					$output .= " " . convertDigit($fraction{$i});
				}
			}

			return $output;
		}

		function convertGroup($index)
		{
			switch ($index)
			{
				case 11:
					return " decillion";
				case 10:
					return " nonillion";
				case 9:
					return " octillion";
				case 8:
					return " septillion";
				case 7:
					return " sextillion";
				case 6:
					return " quintrillion";
				case 5:
					return " quadrillion";
				case 4:
					return " trillion";
				case 3:
					return " billion";
				case 2:
					return " million";
				case 1:
					return " thousand";
				case 0:
					return "";
			}
		}

		function convertThreeDigit($digit1, $digit2, $digit3)
		{
			$buffer = "";

			if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
			{
				return "";
			}

			if ($digit1 != "0")
			{
				$buffer .= convertDigit($digit1) . " hundred";
				if ($digit2 != "0" || $digit3 != "0")
				{
					$buffer .= " and ";
				}
			}

			if ($digit2 != "0")
			{
				$buffer .= convertTwoDigit($digit2, $digit3);
			}
			else if ($digit3 != "0")
			{
				$buffer .= convertDigit($digit3);
			}

			return $buffer;
		}

		function convertTwoDigit($digit1, $digit2)
		{
			if ($digit2 == "0")
			{
				switch ($digit1)
				{
					case "1":
						return "ten";
					case "2":
						return "twenty";
					case "3":
						return "thirty";
					case "4":
						return "forty";
					case "5":
						return "fifty";
					case "6":
						return "sixty";
					case "7":
						return "seventy";
					case "8":
						return "eighty";
					case "9":
						return "ninety";
				}
			} else if ($digit1 == "1")
			{
				switch ($digit2)
				{
					case "1":
						return "eleven";
					case "2":
						return "twelve";
					case "3":
						return "thirteen";
					case "4":
						return "fourteen";
					case "5":
						return "fifteen";
					case "6":
						return "sixteen";
					case "7":
						return "seventeen";
					case "8":
						return "eighteen";
					case "9":
						return "nineteen";
				}
			} else
			{
				$temp = convertDigit($digit2);
				switch ($digit1)
				{
					case "2":
						return "twenty-$temp";
					case "3":
						return "thirty-$temp";
					case "4":
						return "forty-$temp";
					case "5":
						return "fifty-$temp";
					case "6":
						return "sixty-$temp";
					case "7":
						return "seventy-$temp";
					case "8":
						return "eighty-$temp";
					case "9":
						return "ninety-$temp";
				}
			}
		}

		function convertDigit($digit)
		{
			switch ($digit)
			{
				case "0":
					return "zero";
				case "1":
					return "one";
				case "2":
					return "two";
				case "3":
					return "three";
				case "4":
					return "four";
				case "5":
					return "five";
				case "6":
					return "six";
				case "7":
					return "seven";
				case "8":
					return "eight";
				case "9":
					return "nine";
			}
		}

		function manualAttStatus($Status="P")
		{
			$ManualStatus = "Present";	
				
				if($Status == "P")
				{
					$ManualStatus = 'Present';
				}
				else if($Status == "p")
				{
					$ManualStatus = 'Present';
				}
				else if($Status == "A")
				{
					$ManualStatus = 'Absent';
				}
				else if($Status == "a")
				{
					$ManualStatus = 'Absent';
				}
				else if($Status == "L")
				{
					$ManualStatus = 'Leave';
				}
				else if($Status == "l")
				{
					$ManualStatus = 'Leave';
				}
				else if($Status == "O")
				{
					$ManualStatus = 'Off Day';
				}
				else if($Status == "o")
				{
					$ManualStatus = 'Off Day';
				}
				else if($Status == "H")
				{
					$ManualStatus = 'Off Day';
				}
				else if($Status == "h")
				{
					$ManualStatus = 'Off Day';
				}
				
				return $ManualStatus;
		}

		function backup_tables($host,$user,$pass,$name,$tables)
		{
			$return='';	
			$link = mysql_connect($host,$user,$pass);
			mysql_select_db($name,$link);
			
			//get all of the tables
			if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}
			else
			{
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			
			//cycle through
			$return.= 'SET AUTOCOMMIT=0;';
			$return.="\n";
			$return.= 'START TRANSACTION;';
			$return.="\n\n\n";
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				$return.= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
			}
			$return.= 'COMMIT;';
			//save file
			// $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
			// fwrite($handle,$return);
			// fclose($handle);

			// header('Pragma: anytextexeptno-cache', true);
			// header("Pragma: public");
			// header("Expires: 0");
			// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			// header("Cache-Control: private", false);
			header("Content-Type: text/plain");
			header("Content-Disposition: attachment; filename=\"dbbackup_".date('DMY').(date('G')+3).date('ia').".sql\"");
			echo $return; exit();
			
		}
		
		if(isset($_REQUEST['DBbackup']) && $_REQUEST['DBbackup']=='BackUp')
		{
			backup_tables(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME,'*');
			//backup_tables('localhost','root','','project_management','*');
		}
		
		function tax_exceed_amount($amount=0)
		{
			$tax_exceed_amount = 0;
			
			if($amount >= 0 && $amount <= 400000)
			{
				$tax_exceed_amount = 0;
			}
			else if($amount > 400000 && $amount <= 500000)
			{
				$tax_exceed_amount = 400000;
			}
			else if($amount > 500000 && $amount <= 750000)
			{
				$tax_exceed_amount = 500000;
			}
			else if($amount > 750000 && $amount <= 1400000)
			{
				$tax_exceed_amount = 750000;
			}
			else if($amount > 1400000 && $amount <= 1500000)
			{
				$tax_exceed_amount = 1400000;
			}
			else if($amount > 1500000 && $amount <= 1800000)
			{
				$tax_exceed_amount = 1500000;
			}
			else if($amount > 1800000 && $amount <= 2500000)
			{
				$tax_exceed_amount = 1800000;
			}
			else if($amount > 2500000 && $amount <= 3000000)
			{
				$tax_exceed_amount = 2500000;
			}
			else if($amount > 3000000 && $amount <= 3500000)
			{
				$tax_exceed_amount = 3000000;
			}
			else if($amount > 3500000 && $amount <= 4000000)
			{
				$tax_exceed_amount = 3500000;
			}
			else if($amount > 4000000 && $amount <= 7000000)
			{
				$tax_exceed_amount = 4000000;
			}
			else if($amount > 7000000)
			{
				$tax_exceed_amount = 7000000;
			}
			else
			{
				$tax_exceed_amount = 0;
			}
			
			return $tax_exceed_amount;
		}
		
		function tax_rate_percentage($amount=0)
		{
			$tax_rate_percentage = 0;
			
			if($amount >= 0 && $amount <= 400000)
			{
				$tax_rate_percentage = 0;
			}
			else if($amount > 400000 && $amount <= 500000)
			{
				$tax_rate_percentage = 0.2;
			}
			else if($amount > 500000 && $amount <= 750000)
			{
				$tax_rate_percentage = 0.5;
			}
			else if($amount > 750000 && $amount <= 1400000)
			{
				$tax_rate_percentage = 0.10;
			}
			else if($amount > 1400000 && $amount <= 1500000)
			{
				$tax_rate_percentage = 0.125;
			}
			else if($amount > 1500000 && $amount <= 1800000)
			{
				$tax_rate_percentage = 0.15;
			}
			else if($amount > 1800000 && $amount <= 2500000)
			{
				$tax_rate_percentage = 0.175;
			}
			else if($amount > 2500000 && $amount <= 3000000)
			{
				$tax_rate_percentage = 0.20;
			}
			else if($amount > 3000000 && $amount <= 3500000)
			{
				$tax_rate_percentage = 0.225;
			}
			else if($amount > 3500000 && $amount <= 4000000)
			{
				$tax_rate_percentage = 0.25;
			}
			else if($amount > 4000000 && $amount <= 7000000)
			{
				$tax_rate_percentage = 0.275;
			}
			else if($amount > 7000000)
			{
				$tax_rate_percentage = 0.30;
			}
			else
			{
				$tax_rate_percentage = 0;
			}
			
			return $tax_rate_percentage;
		}
		
		function tax_rate_amount($amount=0)
		{
			$tax_rate_amount = 0;
			
			if($amount >= 0 && $amount <= 400000)
			{
				$tax_rate_amount = 0;
			}
			else if($amount > 400000 && $amount <= 500000)
			{
				$tax_rate_amount = 0;
			}
			else if($amount > 500000 && $amount <= 750000)
			{
				$tax_rate_amount = 2000;
			}
			else if($amount > 750000 && $amount <= 1400000)
			{
				$tax_rate_amount = 14500;
			}
			else if($amount > 1400000 && $amount <= 1500000)
			{
				$tax_rate_amount = 79500;
			}
			else if($amount > 1500000 && $amount <= 1800000)
			{
				$tax_rate_amount = 92000;
			}
			else if($amount > 1800000 && $amount <= 2500000)
			{
				$tax_rate_amount = 137000;
			}
			else if($amount > 2500000 && $amount <= 3000000)
			{
				$tax_rate_amount = 259500;
			}
			else if($amount > 3000000 && $amount <= 3500000)
			{
				$tax_rate_amount = 359500;
			}
			else if($amount > 3500000 && $amount <= 4000000)
			{
				$tax_rate_amount = 472000;
			}
			else if($amount > 4000000 && $amount <= 7000000)
			{
				$tax_rate_amount = 597000;
			}
			else if($amount > 7000000)
			{
				$tax_rate_amount = 1422000;
			}
			else
			{
				$tax_rate_amount = 0;
			}
			
			return $tax_rate_amount;
		}
		
		function kpi_total($ID=0)
		{
			$r = mysql_query("SELECT SUM(WS) AS WeightedScore FROM kpi WHERE 
			Status=1 AND EmpID = ".$ID."") or die(mysql_error());
			$r2 = mysql_fetch_array($r);
			if(($r2['WeightedScore'] + $WS) > 1)
			{
				$msg='#f00';
			}
			elseif(($r2['WeightedScore'] + $WS) < 1)
			{
				$msg='#d67082';
			}
			else
			{
				$msg='#83a583';
			}
			
			return $msg;
		}
		
		
		function sendOnboarding(){
		    $r = mysql_query("SELECT * FROM onboarding") or die(mysql_error());
			$r2 = mysql_fetch_array($r);
			
			return $r2;
		}
?>