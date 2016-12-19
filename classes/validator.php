<?php
  class Validator{
    public function validate($db){
      
      $sanitizedusername = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	    
      if(strlen($sanitizedusername) < 3){
		    $error[] = 'Username is too short.';
	    } else {
		    $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		    $stmt->execute(array(':username' => $sanitizedusername));
		    $row = $stmt->fetch(PDO::FETCH_ASSOC);
		    if(!empty($row['username'])){
			    $error[] = 'Username provided is already in use.';
		    }
 	    }
      
      $sanitizedpassword = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
      $sanitizedpasswordConfirm = filter_var($_POST['passwordConfirm'],FILTER_SANITIZE_STRING);
 	    
      if(strlen($sanitizedpassword) < 3){
	      $error[] = 'Password is too short.';
 	    }
      
 	    if(strlen($sanitizedpasswordConfirm) < 3){
 		    $error[] = 'Confirm password is too short.';
 	    }
 
 	    if($sanitizedpassword != $sanitizedpasswordConfirm){
 		    $error[] = 'Passwords do not match.';
 	    }
 
      $sanitizedemail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
 	    
      if(!filter_var($sanitizedemail, FILTER_VALIDATE_EMAIL)){
 	      $error[] = 'Please enter a valid email address';
 	    } 
      else {
		    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		    $stmt->execute(array(':email' => $_POST['email']));
		    $row = $stmt->fetch(PDO::FETCH_ASSOC);
		    if(!empty($row['email'])){
		  	  $error[] = 'Email provided is already in use.';
	  	  }
      }
      return $error;
    }
  }
?>