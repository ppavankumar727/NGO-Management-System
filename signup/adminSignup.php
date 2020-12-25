<?php 
require_once "../pdo.php";
session_start();

 if(isset($_POST['cancel'])){
    header('Location: ../login/adminLogin.php');
    return;
  }

if ( isset($_POST['username'])  ) {
    if((strlen($_POST['username'])>0)&&(strlen($_POST['password'])>0)){

        $stmt5 = $pdo->query("SELECT `username` FROM `admin_login` WHERE `username`= '".$_POST['username']."';");
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows5)>0){
            $_SESSION['error'] = "Username Already Exist Chose a different username";
            header('Location: adminSignup.php');
            return;
        }

    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['city'])&&isset($_POST['phone'])){
        if((strlen($_POST['name'])>0)&&(strlen($_POST['email'])>0)&&(strlen($_POST['city'])>0)&&(strlen($_POST['phone'])>0)){
            $stmt5 = $pdo->query("SELECT `email` FROM `admin` WHERE `email`= '".$_POST['email']."';");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "email Already Exist Chose a different email";
                header('Location: adminSignup.php');
                return;
            }
            $stmt5 = $pdo->query("SELECT `phone` FROM `admin` WHERE `phone`= ".$_POST['phone'].";");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "phone Already Exist Chose a different phone";
                header('Location: adminSignup.php');
                return;
            }
            
        $stmt = $pdo->prepare('INSERT INTO admin
        (name,email,city_id,phone) VALUES ( :nm, :em, :ci, :ph)');
            $stmt->execute(array(
            ':nm' => $_POST['name'],
            ':em' => $_POST['email'],
            ':ci' => $_POST['city'],
            ':ph' => $_POST['phone'])
            );
    
          
            $stmt3 = $pdo->query("SELECT * FROM `admin` WHERE `admin_id`= (SELECT MAX(`admin_id`) FROM `admin`)");
            $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            if(($_POST['email']!=$rows2[0]['email'])||($_POST['phone']!=$rows2[0]['phone'])){
                $_SESSION['error']="Something went wrong please try again";
                header('Location: adminSignup.php');
                return;
            }

            
            $stmt1 = $pdo->prepare('INSERT INTO admin_login(username,password,admin_id) VALUES ( :ur, :pw, :dn)');
            $stmt1->execute(array(
                ':ur' => $_POST['username'],
                ':pw' => $_POST['password'],
                ':dn' => $rows2[0]['admin_id'],)
                );$_fal="Record inserted";

                $_SESSION['success'] = "Record inserted";
                header('Location: ../login/adminLogin.php');

            }
            else{
                $_SESSION['error'] = "everything Is Required";
                header("Location: adminSignup.php");  
                return;         
            }
        }
    }
}

$stmt3 = $pdo->query("SELECT * FROM city");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN SIGNUP</title>
    <?php include("bootstrap.php"); ?>

</head>
<body  class="text-center">

<?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alert alert-danger" role="alert">';
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        echo '</div>';
    }
?>
    <form method="post" class="form-signin">
    <img class="mb-4" src="../images/index/logo.png" alt="" width="72" height="72">
        <h3 class="h3 mb-3 font-weight-normal">Admin SIGNUP</h3>  

        <p>	username:
            <input type="text" name="username" size="30"/></p>
        <p>	password:
            <input type="password" name="password" size="30"/></p>
        <p>	name:
            <input type="text" name="name" size="30"/></p>
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
            <br>
            <br>
            <input type="submit"  class="btn btn-lg btn-primary btn-bloc" value="Submit">
            <input type="submit"  class="btn btn-lg btn-primary btn-bloc" name="cancel" value="Cancel">
    </form>
</body>
</html>