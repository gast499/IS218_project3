<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Profile Page';

require('layout/header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>User Profile Page - Welcome <?php echo $_SESSION['username']; ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>


</div>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
<?php 
$stmt = "SELECT * FROM members WHERE username = '".$_SESSION['username']."'";

foreach ($db->query($stmt) as $row) {
  if (empty($row['image'])){
    echo "<img style='vertical-align:middle' width='100' height='100' src='uploads/default-user-pic.gif' alt='Default User Profile Picture'>";
  }
  else {
    echo "<img style='float:left;vertical-align:middle' width='100' height='100' src='uploads/".$row['image']."' alt='User Profile Picture'>"; 
  }
  echo "<div style='display:table;width:400px;height:60px;'>";
  echo "<div style='padding-left:10px;display:table-cell;height:30px;'><b><big>Username: " . $row['username'];
  echo '<br><br>e-Mail Address: ' . $row['email'] . '</big></b></div>';
  echo '</div>';
}
?>
				<hr>

		</div>
	</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form action="upload.php" method="post" enctype="multipart/form-data"> 
        <input type="file" name="myFile">
        <br>
        <input type="submit" value="Upload & Change Profile Picture">
      </form>
    </div>
  </div>
</div>

<?php
require('layout/footer.php'); 
?>