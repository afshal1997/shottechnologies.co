<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<?php 
if($_POST['dd']):
    $task_id = $_POST['dd']['id'];
    $title = $_POST['dd']['title'];
    $position = $_POST['dd']['position'];
    $client_id = $_POST['dd']['client_id'];
    $query = "INSERT into kanban VALUES (null, '$task_id', '$title', '', '$position','false', '$client_id')";
    $result = mysql_query($query) or die ('Could not add because: ' . mysql_error());
    // echo json_encode($_POST);
   echo json_encode($_POST['dd']);
endif;
if(isset($_POST['update'])):
    $task_name = $_POST['update']['cards'];
    for($i=0; $i<count($task_name);$i++){
        $data2 = $task_name[$i]['id'];
        $datas1 = $task_name[$i]['position'];
        $name = $task_name[$i]['title'];
        $query = "UPDATE kanban SET task_name = '" . $name ."', status = '" .$datas1. "' WHERE task_id = ".$data2;
        $result = mysql_query($query) or die ('Could not update Adjustment because: ' . mysql_error());
    }
	//echo $query;
endif;
if(isset($_GET)):
    $id = $_SESSION["UserID"];
    $query = "select task_name as title, status as position, task_id as id, description as description, priority as priority from kanban where client_id = '$id'";
    $result = mysql_query($query) or die ('Could not update Adjustment because: ' . mysql_error());
	while($data = mysql_fetch_array($result,MYSQL_ASSOC)) {
      $arr[] = $data;
    }
    echo json_encode($arr);
endif;	
if(isset($_POST['del'])):
    $task_name = $_POST['update']['cards'];
    $query = "DELETE FROM kanban WHERE task_id = ".$id;
    $result = mysql_query($query) or die ('Could not update Adjustment because: ' . mysql_error());

	//echo $query;
endif;
?>