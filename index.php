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

if(isset($_SESSION['volunteer_id'])){
        require_once "volunteerIndex.php";
}
else if(isset($_SESSION['admin_id'])){
    require_once "./adminIndex2.php";

}
else if(isset($_SESSION['donor_id'])){
    require_once "donorIndex.php";  
}
else {
    require_once "./navbar.php";
    require_once "./carousel.php";
}
 ?>
 
</body>
</html>