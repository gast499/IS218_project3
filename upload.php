<?php
require('includes/config.php');
define (UPLOAD_DIR, "uploads/");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
    
    $stmt = "UPDATE members SET image = '".$_FILES['myFile']['name']."' WHERE username = '".$_SESSION['username']."'";
    $db->query($stmt);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
    header('Location: memberpage.php');
}
?>