<?php
require('includes/config.php');

$stmt = "SELECT * FROM members";
echo '<table border=1>';
echo '<tr>';
echo '<thead>';
echo '<th>Member ID</th><th>Username</th><th>Encrypted Password</th><th>e-Mail</th><th>Image</th>';
echo '</thead>';
echo '</tr>';
foreach($db->query($stmt) as $row){
  echo '<tr>';
  echo '<td>'.$row['memberID'].'</td>';
  echo '<td>'.$row['username'].'</td>';
  echo '<td>'.$row['password'].'</td>';
  echo '<td>'.$row['email'].'</td>';
  echo "<td><img width='100' height='100' src='uploads/".$row['image']."' alt='User Profile Picture'></td>";
  echo '</tr>';
}
echo '</table>';
?>