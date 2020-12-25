<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg p-3 mb-5 ">
  <a class="navbar-brand" href="index.php">NGO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="index.php" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Donor<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="logout.php"><?php 
          $stmt3 = $pdo->query("SELECT `name` FROM `donor` WHERE `donor_id` =".$_SESSION['donor_id']);
          $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
          echo $rows2[0]['name'];
        ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="update/donorUpdate.php">Edit Profile<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
<?php 
      if(isset($_SESSION['success'])){
        echo '<div class="row alert alert-success" role="alert">';
        echo $_SESSION['success'];
        unset ($_SESSION['success']);
        echo '</div>' ;
    }

    if(isset($_SESSION['error'])){
        echo '<div class="row alert alert-danger" role="alert">';
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        echo '</div>';
    }
  ?>
    <div class="row">
      <div class="col-2">
        </div>  
        <div class="col-8">
            <img src="images/index/donate.jpg"alt="" class="col-12" >
        </div>
        <div class="col-2">
        </div>
    </div>
    <br>

    <div class="row">
        
       
        <?php
        $stmt3 = $pdo->query("SELECT donationS FROM `ngo_account` WHERE `donor_id`=".$_SESSION['donor_id']);
        $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)>0){
            echo " <div class='col-6'>";
            
            echo "<h2 class='shadow-lg p-3 mb-5 bg-light rounded '>Your Overall Donations Are ₹ ".$rows[0]['donationS']." </h2>";
            echo "</div>";
            echo " <div class='col-6'>";

            echo "<a class='btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded ' style='width: 200px;' href='donor/donateMoney.php' role='button'>Donate</a>";
            echo "<pre style = 'display : inline'> </pre>";
            echo "<a class='btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded ' style='width: 195px;' href='donor/transactions.php' role='button'>Check Transctions</a>";

            echo "</div>";

        }
            else {
              echo " <div class='col-6'>";
            
              echo "<h2 class='shadow-lg p-3 mb-5 bg-light rounded '>Fill Your Details To Donate Money </h2>";
              echo "</div>";
              echo " <div class='col-6'>";
  
              echo "<a class='btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded ' style='width: 400px;' href='donor/details.php' role='button'>Fill Details</a>";
              echo "</div>";
        }
        
        ?>
        </div> 
    <div class="row">
       <div class='col-6'>
          <h2 class='shadow-lg p-3 mb-5 bg-light rounded '>Donate Items Here </h2>  
        </div>
        <div class='col-6'>
          <a class='btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded ' style='width: 400px;' href='donor/donateItems.php' role='button'>Donate</a>
        </div>
    </div>
    
    <div class="row" >
      <div class="col-3"></div>
    <div class="col-6">
      <table class="table shadow-lg p-3 mb-5 bg-light rounded ">
        <h2>ITEMS YOU DONATED</h2>
        <thead class="thead-dark">
          <tr class="">
            <th class="" scope="col">Sno </th>
            <th class="" scope="col">item Name</th>
          </tr>
        </thead>
        <tbody class="">
           <?php 
             $stmt3 = $pdo->query("SELECT * FROM `items` WHERE `donor_id`=".$_SESSION['donor_id']);
             $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
             $count = 1;
              foreach($rows as $row){
                echo "<tr class=''>";
                echo "<th scope='row' class=''>".$count."</th>";
                echo "<td class=''>".htmlentities($row['item'])."</td>";
                echo "</tr>";
              $count++;
              }
            ?>
        </tbody>
      </table>
   </div>
   <div class="col-3"></div>
  </div>
</div>