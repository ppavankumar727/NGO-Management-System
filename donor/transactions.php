<?php 
require_once "../pdo.php";
session_start();
if(!isset($_SESSION['donor_id'])){
    die("Login first");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "bootstrap.php" ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg p-3 mb-5 ">
        <a class="navbar-brand" href="index.php">NGO</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="index.php" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
             <a class="nav-link" href="../index.php">Donor<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
        <a class="nav-link" href="logout.php"><?php 
          $stmt3 = $pdo->query("SELECT `name` FROM `donor` WHERE `donor_id` =".$_SESSION['donor_id']);
          $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
          echo $rows2[0]['name'];
        ?><span class="sr-only">(current)</span></a>
        </li>
            <li class="nav-item ">
                <a class="nav-link" href="../logout.php">Logout<span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container  rounded"> 

  <div class = "row ">
    <div class="col-6"><h3>Your Transactions</h3></div>
    <div class="col-6"> <?php
    echo "<a class='btn btn-primary btn-m 'style='width: 100px;' href='../index.php' role='button'>Go Back</a>";
 ?> 
 </div>
  </div>
  <div class = "row ">
    <div class="col">
      <table class="table shadow-lg p-3 mb-5 bg-light rounded ">
        <thead class="thead-dark">
          <tr class="">
            <th class="" scope="col">Sno </th>
            <th class="" scope="col">Date And Time</th>
            <th class="" scope="col">Amount</th>

          </tr>
        </thead>
        <tbody class="">
           <?php 
             $stmt3 = $pdo->query("SELECT * FROM `transaction` WHERE `donor_id` =".$_SESSION['donor_id']);
             $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
             $count = 1;
              foreach($rows as $row){
                echo "<tr class=''>";
                echo "<th scope='row' class=''>".$count."</th>";
                echo "<td class=''>".htmlentities($row['tdate'])."</td>";
                echo "<td class='' >".htmlentities($row['amount'])." </td>";
                echo "</tr>";
              $count++;
              }
            ?>
        </tbody>
      </table>
   </div>
  </div>


</body>
</html>