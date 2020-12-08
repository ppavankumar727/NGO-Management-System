
<?php 

if(!isset($_SESSION['donor_id'])){
    die("Login first");
}
if(isset($_POST['cancel'])){
    header('Location: ../index.php');
    return;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>