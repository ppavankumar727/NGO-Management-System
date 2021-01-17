<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg p-3 mb-5 ">
  <a class="navbar-brand" href="index.php">NGO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="index.php" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Admin<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="logout.php"><?php 
          $stmt3 = $pdo->query("SELECT `name` FROM `admin` WHERE `admin_id` =".$_SESSION['admin_id']);
          $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
          echo $rows2[0]['name'];
        ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="update/adminUpdate.php">Edit Profile<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="admin.php">Donors<span class="sr-only">(current)</span></a>
      </li>      
      <li class="nav-item ">
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container  rounded"> 
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

  <div class = "row ">
    <div class="col-6 "><h3>Runnnig Tasks</h3></div>
    <div class="col-6"><h3>Volunteers</h3></div>
  </div>
  <div class = "row ">
    <div class="col-6">
      <table class="table shadow-lg p-3 mb-5 bg-light rounded ">
        <thead class="thead-dark">
          <tr class="">
            <th class="" scope="col">Sno </th>
            <th class="" scope="col">Task Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="">
           <?php 
             $stmt3 = $pdo->query("SELECT * FROM task ");
             $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
             $count = 1;
              foreach($rows as $row){
                echo "<tr class=''>";
                echo "<th scope='row' class=''>".$count."</th>";
                echo "<td class=''>".htmlentities($row['task'])."</td>";
                echo("<td  > <a class='btn btn-primary btn-m' href='volunteer/deleteTask.php?task_id=".$row['task_id']."'>Remove Task</a></td>");
                echo "</tr>";
              $count++;
              }
            ?>
        </tbody>
      </table>
   </div>
   <div class="col-6">
      <table class="table shadow-lg p-3 mb-5 bg-light rounded ">
        <thead class="thead-dark">
          <tr class="">
            <th class="" scope="col">Sno </th>
            <th class="" scope="col">Task Name</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody class="">
           <?php 
             $stmt3 = $pdo->query("SELECT * FROM `volunteer`");
             $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
             $count = 1;
              foreach($rows as $row){
                echo "<tr class=''>";
                echo "<th scope='row' class=''>".$count."</th>";
                echo "<td class=''>".htmlentities($row['name'])."</td>";
                echo("<td class='' > <a class='btn btn-primary btn-sm' href='admin/delete2.php?volunteer_id=".$row['volunteer_id']."'>Remove Volunteer</a></td>");
                echo "</tr>";
              $count++;
              }
            ?>
        </tbody>
      </table>
   </div>
  </div>
</div>