<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
  if(!isset($_SESSION['Admin'])){
    echo '<script type="text/javascript">window.location.assign("home.php");</script>';
  }
  
	$temp = $_GET['id'];
    $id = base64_decode($temp);
    $Email = $_SESSION['Admin'];
    
	// Non-NULL Initialization Vector for decryption
	$decryption_iv = '1234567891011121';

	// Store the decryption key
	$decryption_key = "travel123";
    $ciphering = "AES-128-CTR";

	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	// Use openssl_decrypt() function to decrypt the data
   $decryption= openssl_decrypt ($id, $ciphering,$decryption_key, $options, $decryption_iv);

    $query = "SELECT * FROM `schedule` WHERE `scheduleID` = '$decryption'";
	$result = $conn->query($query);
    if ($result->num_rows >0) {
		 
	}else{
	    echo "<script type='text/javascript'>window.location.assign('No data inside database');</script>";
	}

   if($Email==''||$id ==''){
	     echo '<script type="text/javascript">alert("variable no value")window.location.assign("home.php");</script>';
   }else{
        $query ="DELETE FROM `schedule` where scheduleID='$decryption'";
		if(mysqli_query($conn, $query) )
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_schedule.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_schedule.php');</script>'";
		}
	   
   }
	   
   

?>