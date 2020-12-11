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
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<?php 
$stmt3 = $pdo->query("SELECT ngo_account.donor_id , donor.name , ngo_account.donationS FROM donor JOIN ngo_account WHERE donor.donor_id = ngo_account.donor_id");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
<p>Donors are</p>
<ol>
<?php 
foreach($rows as $row){
    echo "<li>";
    echo htmlentities($row['name']);
    echo " ".htmlentities($row['donationS']);
    echo(" <a href='admin/delete.php?donor_id=".$row['donor_id']."'>Delete</a>");

    echo "</li>";
}
?>
</ul>
</div>    
