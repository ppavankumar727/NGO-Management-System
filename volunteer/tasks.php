<?php 
session_start();
require_once "../pdo.php";

if(!isset($_SESSION['volunteer_id'])){
    die("Login first");
}
if(isset($_POST['cancel'])){
    header('Location: ../index.php');
    return;
}

require_once "../pdo.php";
if (isset($_POST['task'])){
    if((strlen($_POST['task'])>0)){
        $stmt = $pdo->prepare('INSERT INTO `task` 
        (`task`, `volunteer_id`) VALUES ( :it, :vid)');
            $stmt->execute(array(
            ':it' => $_POST['task'],
            ':vid' => $_SESSION['volunteer_id']
            ));
            header('Location: ../index.php');
            return;
       
    }
    else {
        $_SESSION['error']="All fields requred";
        header("Location: tasks.php");
        return;
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>volunteer  tasks</title>
    <?php include("bootstrap.php");?>
</head>
<body>
<?php
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
        unset ($_SESSION['success']);
    }

    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>

    <h1>Enter Task</h1>
    <form method="post">
        <p>	task:
            <input type="text" name="task" size="60"/></p>
            <input type="submit" value="Submit">
            <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>