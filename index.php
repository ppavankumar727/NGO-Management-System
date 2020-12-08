<?php 

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("bootstrap.php"); ?>
</head>
<body>
<?php
if(isset($_SESSION['volunteer_id'])){
        echo "<a href='logout.php'>Logout</a>";
        echo "<br>";
        echo "<a href='volunteer/tasks.php'>details</a>";
        echo "<p>".$_SESSION['role']."</p>";

}
else if(isset($_SESSION['admin_id'])){
    echo "<a href='logout.php'>Logout</a>";
    echo "<br>";
    echo "<a href='donor/tasks.php'>details</a>";
    echo "<p>".$_SESSION['role']."</p>";
}
else if(isset($_SESSION['donor_id'])){
    echo "<a href='logout.php'>Logout</a>";
    echo "<br>";
    echo "<a href='donor/details.php'>details</a>";
    echo "<p>".$_SESSION['role']."</p>";
}
else {
    require_once "./navbar.php";
}
 ?>
</body>
</html>