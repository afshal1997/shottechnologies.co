<label id="labelimp">Question</label>
<div>
	<select name="QuestionID" id="QuestionID" class="form-control">
	<option value="0" >Select Question</option>
<?php
	include('Common.php');
	
	// $QuestionID = 0;
	
	if(isset($_REQUEST["TestID"]) && ctype_digit(trim($_REQUEST["TestID"])))
		$TestID = trim($_REQUEST["TestID"]);
	
	$r = mysql_query("SELECT ID, Question FROM questions WHERE TestID = '".dbinput($TestID)."'") or die(mysql_error());
	$n = mysql_num_rows($r);
	
	if($n == 0)
	{
		echo '<option value="0">No Questions</option>';
	}
	else
	{
		while($Rs = mysql_fetch_assoc($r))
		echo '<option '.($QuestionID == $row['ID'] ? 'selected' : '').' value="'.dboutput($Rs['ID']).'">'.dboutput($Rs['Question']).'</option>';
	}
	
?>
</select>
</div>
