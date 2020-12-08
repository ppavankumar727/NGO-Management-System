<?php 
$stmt3 = $pdo->query("SELECT donor.name , ngo_account.donationS FROM donor JOIN ngo_account WHERE donor.donor_id = ngo_account.donor_id");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
<p>Donors are</p>
<ol>
<?php 
foreach($rows as $row){
    echo "<li>";
    echo htmlentities($row['name']);
    echo " ".htmlentities($row['donationS']);
    echo "</li>";
}
?>
</ul>
</div>    
