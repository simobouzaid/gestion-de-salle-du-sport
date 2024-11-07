
<?php
require_once 'barnav.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['go'])) {
    $start = $_POST['start']; 
    $end = $_POST['end'];


    require_once 'database/database.php';
    require_once 'class.php';
   
   $id= $_SESSION['rsp']['id'];

    $cm = new cm($pdo);
    $e = $cm->statique($start, $end,$id);

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
    <form action="" method="post">
        <label for="">
        <input type="date" name="start">


        </label>
        <label for="">
        <input type="date" name="end" >

        </label>
        <input type="submit" name="go">
        <?php if(isset($e)){
            echo" <h3>les candids inscripe se sont : $e</h3>";

        }
        ?>
        
    </form>
    
</body>
</html>