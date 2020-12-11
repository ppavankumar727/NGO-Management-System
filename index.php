<?php 

session_start();
require_once "./pdo.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO INDEX</title>
 
    <?php include("bootstrap.php"); ?>
    <link rel="stylesheet" href="bootstrap/css/style.css">
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
if(isset($_SESSION['volunteer_id'])){
        echo "<a href='logout.php'>Logout</a>";
        echo "<br>";
        echo "<a href='volunteer/tasks.php'>details</a>";
        echo "<p>".$_SESSION['role']."</p>";

}
else if(isset($_SESSION['admin_id'])){
    require_once "./adminIndex.php";

}
else if(isset($_SESSION['donor_id'])){
    echo "<a href='logout.php'>Logout</a>";
    echo "<a href='donor/donateitems.php'>Items</a>";
    echo "<a href='donor/donateMoney.php'>Money</a>";
    echo "<br>";
    echo "<a href='donor/details.php'>details</a>";
    echo "<p>".$_SESSION['role']."</p>";
}
else {
    require_once "./navbar.php";
    require_once "./carousel.php";
}
 ?>
 
</body>
</html>