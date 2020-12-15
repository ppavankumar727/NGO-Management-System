
<?php 
session_start();
require_once "../pdo.php";
if(!isset($_SESSION['admin_id'])){
    die("Login first");
}
if(!isset($_GET['donor_id'])){
    die("No param");
}
if(isset($_POST['cancel'])){
    header('Location: ../index.php');
    return;   
}
else if(isset($_POST['submit'])){
$stmt3 = $pdo->query( "DELETE FROM `ngo_account` WHERE `ngo_account`.`donor_id` =".$_GET['donor_id']);
$rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
header('Location: ../index.php');
return;  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("bootstrap.php"); ?>

</head>
<body  class="text-center">
    <div>
        <form class="form-signin" action="" method="post">
        <h1>Are You Sure Want To DELETE</h1>
                <br>
        <input type="submit" class="btn btn-lg btn-primary btn-bloc" name ="submit"value="Yes">
            <input type="submit" class="btn btn-lg btn-primary btn-bloc" name="cancel" value="Cancel"></p>
        </form>
    </div>
</body>
</html>
