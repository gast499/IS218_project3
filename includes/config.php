<?php
include('bootstrap.php');

ob_start();
session_start();

date_default_timezone_set('America/New_York');

//database information
define('DBHOST','sql2.njit.edu');
define('DBUSER','tmh27');
define('DBPASS','5OsR66EQ6');
define('DBNAME','tmh27');

//email activation information
define('DIR','https://web.njit.edu/~tmh27/is218/Project3/');
define('SITEEMAIL','noreply@domain.com');

try {

	//create PDO connection using singleton
 
  $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
  $pdo = PDOConnection::instance();
	$db = $pdo->getConnection($dsn, DBUSER, DBPASS);

} catch(PDOException $e) {
	//show errors
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

$userFactory = new UserFactory();
$user = $userFactory->newUser($db);

?>
