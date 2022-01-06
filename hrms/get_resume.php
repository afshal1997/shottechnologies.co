<div class="form-group">
  <label id="labelimp" for="Resume" >Resume #: </label>
  <select name="Resume" id="Resume" class="form-control">
	<option value="0" >Select Resume</option>
<?php
	include('Common.php');
	
	
	if(isset($_REQUEST["PostID"]) && ctype_digit(trim($_REQUEST["PostID"])))
		$PostID = trim($_REQUEST["PostID"]);
	
	$query = "SELECT ID FROM resumes where PostID = ".$PostID."";
	$res = mysql_query($query);
	while($row = mysql_fetch_array($res))
	{
	echo '<option '.($Resume == $row['ID'] ? 'selected' : '').' value="'.$row['ID'].'">Res#: '.$row['ID'].'</option>';
	} 
					
	
?>
</select>
</div>

