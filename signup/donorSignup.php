<?php 
require_once "../pdo.php";
session_start();

  if(isset($_POST['Cancel'])){
    header('Location: ../login/donorLogin.php');
    return;
  }

if ( isset($_POST['username'])  ) {
    if((strlen($_POST['username'])>0)){
        $stmt5 = $pdo->query("SELECT `username` FROM `donor_login` WHERE `username`= '".$_POST['username']."';");
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows5)>0){
            $_SESSION['error'] = "Username Already Exist Chose a different username";
            header('Location: donorSignup.php');
            return;
        }
    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['address'])&&isset($_POST['city'])&&isset($_POST['phone'])){
        if((strlen($_POST['name'])>0)&&(strlen($_POST['email'])>0)&&(strlen($_POST['address'])>0)&&(strlen($_POST['city'])>0)&&(strlen($_POST['phone'])>0)){
            $stmt5 = $pdo->query("SELECT `email` FROM `donor` WHERE `email`= '".$_POST['email']."';");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "email Already Exist Chose a different email";
                header('Location: donorSignup.php');
                return;
            }
            $stmt5 = $pdo->query("SELECT `phone` FROM `donor` WHERE `phone`= ".$_POST['phone'].";");
            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows5)>0){
                $_SESSION['error'] = "phone number Already Exist Chose a different phone";
                header('Location: donorSignup.php');
                return;
            }
        $stmt = $pdo->prepare('INSERT INTO donor
        (name,email,address ,city_id,phone) VALUES ( :nm, :em, :add, :ci, :ph)');
            $stmt->execute(array(
            ':nm' => $_POST['name'],
            ':em' => $_POST['email'],
            ':add' => $_POST['address'],
            ':ci' => $_POST['city'],
            ':ph' => $_POST['phone'])
            );$_fal="Record inserted";
    

            $stmt3 = $pdo->query("SELECT * FROM `donor` WHERE `donor_id`= (SELECT MAX(`donor_id`) FROM `donor`)");
            $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            if(($_POST['email']!=$rows2[0]['email'])||($_POST['phone']!=$rows2[0]['phone'])){
                $_SESSION['error']="Something went wrong please try again";
                header('Location: donorSignup.php');
                return;
            }



            $stmt1 = $pdo->prepare('INSERT INTO donor_login(username,password,donor_id) VALUES ( :ur, :pw, :dn)');
            $stmt1->execute(array(
                ':ur' => $_POST['username'],
                ':pw' => $_POST['password'],
                ':dn' => $rows2[0]['donor_id'],)
                );

                $_SESSION['success'] = "Record inserted";
                header('Location: ../login/donorLogin.php');
        }
        else{
            $_SESSION['error'] = "everything Is Required";
            header("Location: donorSignup.php");  
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
    <title>Document</title>
</head>
<body>
<?php 
if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
    unset($_SESSION['error']);

}
?>

    <form method="post">
        <p>	username:
            <input type="text" name="username" size="60"/></p>
        <p>	password:
            <input type="password" name="password" size="60"/></p>
        <p>	name:
            <input type="text" name="name" size="60"/></p>
        <p>email:
            <input type="email" name="email"/></p>
        <p>address:
            <input type="text" name="address"/></p>
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
            <input type="submit" name="Cancel" value="Cancel">
    </form>
</body>
</html>