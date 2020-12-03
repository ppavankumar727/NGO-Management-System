<?php 
require_once "pdo.php";

$stmt = $pdo->query("SELECT * FROM city");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <p>	name:
            <input type="text" name="name" size="60"/></p>
        <p>email:
            <input type="email" name="email"/></p>
       <p>address:
            <input type="text" name="address"/></p>
        <p> City : 
            <select id="cars" name="city">
            <?php
            foreach($rows as $row){
                echo "<option value = ".$row['city_id'].">";
                echo htmlentities($row['cname']);
                echo "</option>";
            }
            ?>
            </select>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>