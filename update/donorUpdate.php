<?php 
require_once "../pdo.php";
session_start();
if(!isset($_SESSION['donor_id'])){
    die("Login first");
}
  if(isset($_POST['Cancel'])){
    header('Location: ../index.php');
    return;
  }


    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['address'])&&isset($_POST['city'])&&isset($_POST['phone'])){
        if((strlen($_POST['name'])>0)&&(strlen($_POST['email'])>0)&&(strlen($_POST['address'])>0)&&(strlen($_POST['city'])>0)&&(strlen($_POST['phone'])>0)){           
        $stmt = $pdo->prepare( "UPDATE `donor` SET  `email`= :em ,`address`= :add ,`city_id`= :ci ,`phone`= :ph ,`name`= :nm WHERE `donor_id` =". $_SESSION['donor_id']);
            $stmt->execute(array(
            ':nm' => $_POST['name'],
            ':em' => $_POST['email'],
            ':add' => $_POST['address'],
            ':ci' => $_POST['city'],
            ':ph' => $_POST['phone'])
            );
            $_SESSION['success'] = "Record inserted";
            header('Location: ../index.php');
        }
        else{
            $_SESSION['error'] = "everything Is Required";
            header("Location: donorUpdate.php");  
            return;         
        }
     }
    

$stmt4 = $pdo->query("SELECT * FROM `donor` WHERE `donor_id`=". $_SESSION['donor_id']);
$rows3 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

$name = htmlentities($rows3[0]['name']);
$email = htmlentities($rows3[0]['email']);
$address = htmlentities($rows3[0]['address']);
$city = htmlentities($rows3[0]['city_id']);
$phone = htmlentities($rows3[0]['phone']);
     
$stmt3 = $pdo->query("SELECT * FROM city");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONOR UPDATE</title>
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
        <h3 class="h3 mb-3 font-weight-normal">Edit Your Donor Profile</h3>  

        <p>	name:
            <input type="text" name="name" value="<?= $name ?>" size="30"/></p>
        <p>email:
            <input type="email" value="<?= $email ?>" name="email"/></p>
        <p>address:
            <input type="text" value="<?= $address ?>" name="address"/></p>
        <p>phone:
        <input type="text" value="<?= $phone  ?>" name="phone"/></p>
        <p> City : 
            <select id="city" value="<?= $city ?>" name="city">
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
            <input type="submit"  class="btn btn-lg btn-primary btn-bloc" name="Cancel" value="Cancel">
    </form>
</body>
</html>