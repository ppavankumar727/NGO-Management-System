<?php 
require_once "../pdo.php";
session_start();
 if(isset($_POST['cancel'])){
    header('Location: ../login/volunteerLogin.php');
    return;
  }

if ( isset($_POST['username'])  ) {
    if((strlen($_POST['username'])>0)){
        $stmt5 = $pdo->query("SELECT `username` FROM `volunteer_login` WHERE `username`= '".$_POST['username']."';");
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows5)>0){
            $_SESSION['error'] = "Username Already Exist Chose a different username";
            header('Location: volunteerSignup.php');
            return;
        }
    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['intrests'])&&isset($_POST['date'])&&isset($_POST['city'])&&isset($_POST['phone'])){
        if((strlen($_POST['name'])>0)&&(strlen($_POST['email'])>0)&&(strlen($_POST['date'])>0)&&(strlen($_POST['intrests'])>0)&&(strlen($_POST['city'])>0)&&(strlen($_POST['phone'])>0)){
            $stmt5 = $pdo->query("SELECT `email` FROM `volunteer` WHERE `email`= '".$_POST['email']."';");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "email Already Exist Chose a different email";
                header('Location: volunteerSignup.php');
                return;
            }
            $stmt5 = $pdo->query("SELECT `phone` FROM `volunteer` WHERE `phone`= ".$_POST['phone'].";");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "phone number Already Exist Chose a different phone";
                header('Location: volunteerSignup.php');
                return;
            }
        $stmt = $pdo->prepare('INSERT INTO volunteer(name,email,intrests,dob ,city_id,phone) VALUES ( :nm, :em, :inn, :db, :ci, :ph)');
            $stmt->execute(array(
            ':nm' => $_POST['name'],
            ':em' => $_POST['email'],
            ':inn' => $_POST['intrests'],
            ':db' => $_POST['date'],
            ':ci' => $_POST['city'],
            ':ph' => $_POST['phone'])
            );
    

            $stmt3 = $pdo->query("SELECT * FROM `volunteer` WHERE `volunteer_id`= (SELECT MAX(`volunteer_id`) FROM `volunteer`)");
            $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            if(($_POST['email']!=$rows2[0]['email'])||($_POST['phone']!=$rows2[0]['phone'])){
                $_SESSION['error']="Something went wrong please try again";
                header('Location: volunteerSignup');
                return;
            }



            $stmt1 = $pdo->prepare('INSERT INTO volunteer_login(username,password,volunteer_id) VALUES ( :ur, :pw, :dn)');
            $stmt1->execute(array(
                ':ur' => $_POST['username'],
                ':pw' => $_POST['password'],
                ':dn' => $rows2[0]['volunteer_id'],)
                );

                $_SESSION['success'] = "Record inserted";
                header('Location: ../login/volunteerLogin.php');
            }
            else{
                $_SESSION['error'] = "everything Is Required";
                header("Location: volunteerSignup.php");  
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
    <title>Volunteer SIGNUP</title>
    <?php include("bootstrap.php"); ?>

</head>
<body class="text-center">
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
        <h3 class="h3 mb-3 font-weight-normal">Volunteer SIGNUP</h3>  
        <p>	username:
            <input type="text" name="username" size="30"/></p>
        <p>	password:
            <input type="password" name="password" size="30"/></p>
        <p>	name:
            <input type="text" name="name" size="30"/></p>
        <p>email:
            <input type="email" name="email"/></p>
        <p>address:
            <input type="text" name="intrests"/></p>
        <p>address:
            <input type="date" name="date"/></p>
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