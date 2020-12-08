<?php 
session_start();

if(!isset($_SESSION['donor_id'])){
    die("Login first");
}
if(isset($_POST['cancel'])){
    header('Location: ../index.php');
    return;
}

require_once "../pdo.php";
if ((isset($_POST['donation']))){
    if(($_POST['donation']>0)){

        $stmt = $pdo->query("UPDATE `ngo_account`
        SET `donationS` = `donationS` + ".$_POST['donation']." WHERE `donor_id` = '".$_SESSION['donor_id']."'");
            header('Location: ../index.php');
            return;
       
    }
    else {
        $_SESSION['error']="All fields requred";
        header("Location: donateMoney.php");
        return;
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor DetailForm</title>
    <?php include("bootstrap.php");?>
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
?>

    <h1>Enter Your Details</h1>
    <form method="post">
        <p> Donation Amount :
            <input type="number" value=0 name="donation"/></p>
        </p>
            <input type="submit" value="Submit">
            <input type="submit" name="cancel" value="cancel">
    </form>
</body>
</html>