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
if ((isset($_POST['item']))){
    if((strlen($_POST['item'])>0)){

        $stmt1 = $pdo->prepare('INSERT INTO `items`(`item`,`donor_id`) VALUES ( :it, :did)');
        $stmt1->execute(array(
            ':it' => $_POST['item'],
            ':did' => $_SESSION['donor_id']
            )
            );
            $_SESSION['success'] = "Item inserted";
            header('Location: ../index.php');
            return;

    }
    else {
        $_SESSION['error']="All fields requred";
        header("Location: donateitems.php");
        return;
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Donate</title>
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
    <h1 class="h3 mb-3 font-weight-normal">Insert Items</h1>
        <p> Donation Amount :
            <input type="text"  name="item"/></p>
        </p>
            <input type="submit" class="btn btn-lg btn-primary btn-bloc" value="Submit">
            <input type="submit" class="btn btn-lg btn-primary btn-bloc" name="cancel" value="cancel">
    </form>
</body>
</html>