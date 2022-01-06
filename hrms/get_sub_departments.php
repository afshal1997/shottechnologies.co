<option value="" <?php echo ($SubDepartment == '' ? 'selected' : ''); ?> >All SubDepartments</option>
<?php
	include('Common2.php');
	
	// $QuestionID = 0;
	if(isset($_REQUEST["depid"]))
	{
	$depid = trim($_REQUEST["depid"]);
	$depids = explode('_', $depid);
	$depid = $depids[1];
	}

	// echo '<option>'.$depid.'</option>';

	
	$res = mysql_query("SELECT ID,SubDepartment FROM subdepartments WHERE DepartmentID = '".dbinput($depid)."'") or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
	echo '<option '.($SubDepartment == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">'.$row['SubDepartment'].'</option>';
	}
?>