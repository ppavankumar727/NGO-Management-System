<?php 
require_once "pdo.php";
session_start();

 if(isset($_POST['cancel'])){
    header('Location: index.php');
    return;
  }

if ( isset($_POST['username'])  ) {
    if((strlen($_POST['username'])>0)){
    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['city'])&&isset($_POST['phone'])){
        $stmt = $pdo->prepare('INSERT INTO admin
        (name,email,city_id,phone) VALUES ( :nm, :em, :ci, :ph)');
            $stmt->execute(array(
            ':nm' => $_POST['name'],
            ':em' => $_POST['email'],
            ':ci' => $_POST['city'],
            ':ph' => $_POST['phone'])
            );$_fal="Record inserted";
    

            $stmt3 = $pdo->query("SELECT * FROM `admin` WHERE `name` = '".$_POST['name']."'");
            $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);


            $stmt1 = $pdo->prepare('INSERT INTO admin_login(username,password,admin_id) VALUES ( :ur, :pw, :dn)');
            $stmt1->execute(array(
                ':ur' => $_POST['username'],
                ':pw' => $_POST['password'],
                ':dn' => $rows2[0]['admin_id'],)
                );$_fal="Record inserted";

                header('Location: index.php');

        }
    }
}

/*$_SESSION['success'] = "Record inserted";
header("Location: view.php");
return;
    }else {
        $_SESSION['error'] = "Mileage and year must be numeric";
        header("Location: add.php");  
        return;        
    }
}
else {
    $_SESSION['error'] = "Make Is Required";
    header("Location: add.php");  
    return;         
}

*/



$stmt3 = $pdo->query("SELECT * FROM city");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <form method="post">
        <p>	username:
            <input type="text" name="username" size="60"/></p>
        <p>	password:
            <input type="password" name="password" size="60"/></p>
        <p>	name:
            <input type="text" name="name" size="60"/></p>
        <p>email:
            <input type="email" name="email"/></p>
        <p>phone:
        <input type="text" name="phone"/></p>
        <p> City : 
            <select id="city" name="city">
            <?php
            foreach($rows as $row){
                echo "<option value = ".$row['city_id'].">";
                echo htmlentities($row['cname']);
                echo "</option>";
            } 
            ?>
            </select>
            <input type="submit" value="Submit">
            <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>