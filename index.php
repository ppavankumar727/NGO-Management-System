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
    if(isset($_SESSION['role'])){
        echo "<a href='logout.php'>Logout</a>";
        echo "<p>".$_SESSION['username']."</p>";
        echo "<p>".$_SESSION['role']."</p>";

}
 ?>
</body>
</html>