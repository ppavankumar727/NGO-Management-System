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
if ((isset($_POST['bank'])) && (isset($_POST['ifsc_code']))&& (isset($_POST['acount']))&& (isset($_POST['donation']))){
    if((strlen($_POST['bank'])>0) && (strlen($_POST['ifsc_code'])>=0)&& (strlen($_POST['acount'])>=0)){

        $stmt3 = $pdo->query("SELECT * FROM `donor` WHERE `donor_id` = '".$_SESSION['donor_id']."'");
        $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('INSERT INTO ngo_account
        (bank,ifsc_code,acount,	donor_id,city_id,donations) VALUES ( :bn, :ifs, :ac, :don, :ci, :d)');
            $stmt->execute(array(
            ':bn' => $_POST['bank'],
            ':ifs' => $_POST['ifsc_code'],
            ':ac' => $_POST['acount'],
            ':don' => $_SESSION['donor_id'],
            ':ci' => $rows2[0]['city_id'],
            ':d' =>  $_POST['donation']
            ));
            header('Location: ../index.php');
            return;
       
    }
    else {
        $_SESSION['error']="All fields requred";
        header("Location: details.php");
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
<body  class="text-center">
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

    <form  class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Enter Your Details</h1>

        <p>	bank:
            <input type="text" name="bank" size="60"/></p>
        <p>	ifsc_code:
            <input type="text" name="ifsc_code" size="60"/></p>
        <p>Acount No:
            <input type="text" name="acount" size="60"/></p>
        </p>
        <p>Initial Donation:
            <input type="number" value=0 name="donation" size="60"/></p>
        </p>
            <input type="submit" class="btn btn-lg btn-primary btn-bloc" value="Submit">
            <input type="submit" class="btn btn-lg btn-primary btn-bloc" name="cancel" value="Cancel">
    </form>
</body>
</html>