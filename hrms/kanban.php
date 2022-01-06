<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kanban_source/style.css?v=<?php echo rand(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700,800,900" rel="stylesheet">
    <title>Kanban Board</title>
    <style>
        body {
        background: url('https://i.pinimg.com/originals/4f/39/10/4f39103da156fb7e479abd6355932e88.jpg');
        background-repeat: no-repeat;
        background-size:cover;
        overflow-x:hidden;
        }
        .board {
            opacity:0.9;
        }
        label {
            color:white;
        }
        .boards {
            border-top: 0px;
        }
        
    </style>
</head>
<body class="light" style="margin-top:100px !important;max-width:100% !Important;">
    <div id="loadingScreen">
        <div class="loader"></div>
    </div>
    <div class="controls p-3">
        <form class="form-inline">
            <label for="titleInput">Task Name:</label>
            <input class="form-control form-control-sm" type="text" name="title" id="titleInput" autocomplete="off">
            <label for="descriptionInput">Description:</label>
            <input class="form-control form-control-sm" type="text" name="description" id="descriptionInput" autocomplete="off">
            <label for="titleInput">Choose User: &nbsp;</label>
            <select class="form-control form-control-sm" name="client_id" id="client_id">
                <?php 
                    $query = "SELECT * from employees";
                    $result = mysql_query($query) or die ('Could not update Adjustment because: ' . mysql_error());
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        echo '<option value="' . $row['EmpID'].'">'.$row['UserName'].'</option>';
                    }
                
                ?>
            </select>
            <button class="btn btn-dark" id="add" style="margin-left:25px;">Add</button>
            
        </form>
    </div>
    <div class="container">
    <div class="boards overflow-auto" id="boardsContainer">
    </div>
    </div>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="kanban_source/script.js?v=<?php echo rand(); ?>" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>if (window.module) module = window.module;</script>
<script type="text/javascript">


</script>
</body>
</html>
