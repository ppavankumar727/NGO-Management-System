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
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">

    <div class="row">
        
       
        <?php
        $stmt3 = $pdo->query("SELECT donationS FROM `ngo_account` WHERE `donor_id`=".$_SESSION['donor_id']);
        $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)>0){
            echo " <div class='col-6'>";
            
            echo "<h2 class='shadow-lg p-3 mb-5 bg-light rounded '>Your Overall Donations Are ₹ ".$rows[0]['donationS']." </h2>";
            echo "</div>";
            echo " <div class='col-6'>";

            echo "<a class='btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded ' style='width: 400px;' href='donor/donateMoney.php' role='button'>Donate</a>";
            echo "</div>";

        }
            else {

            echo ' 
                <div class="jumbotron col-6">
                    <h2 class="display-4">Hello, Donor!</h2>
                    <h1 class="display-5">Fill Your details To donate now </h1>
                    <hr class="my-4">
                    <p>Click The Button Below</p>
                    <a class="btn btn-primary btn-lg" href="donor/details.php" role="button">Fill Details</a>
                </div> 
            ';
        }
        
        ?>
        </div> 
    </div>
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
    


    </div>
</div>