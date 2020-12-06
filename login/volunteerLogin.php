<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO - login</title>
</head>
<body>

<?php
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
        unset ($_SESSION['success']);
    }
?>

    <form action="" method="post">    
    <p><label for="username">Username :</label>
    <input type="text" name = "username" id = "username">
    </p>
    <p><label for="password">Password :</label>
    <input type="password" name = "password" id ="password">
    </p>
    <p><input type="submit" name="submit">  <input type="submit" name="cancel" value = "cancel"></p>

    </form>

</body>
</html>