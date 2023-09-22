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

   $query = "SELECT * FROM `company` WHERE `companyID` = '$decryption'";
	$result = $conn->query($query);
    if ($result->num_rows >0) {
		 while ($row = $result ->fetch_assoc()){ 
				  $companyName = $row["companyName"];
			      $companyDetail = $row["companyDetail"];
			      $video = $row["video"];
			      $audio = $row["audio"];
		   }
	}else{
	    echo "<script type='text/javascript'>window.location.assign('$id');</script>";
	}

   if($Email==''||$id ==''|| $audio==''||$video==''){
	     echo '<script type="text/javascript">alert("variable no value")window.location.assign("home.php");</script>';
   }else{
       $query ="DELETE FROM `company` where companyID='$decryption'";
	   $audioFilePath = "asset/audio/$audio";
	   $VideoFilePath = "asset/video/$video";

		if(mysqli_query($conn, $query) && unlink("$audioFilePath") && unlink("$VideoFilePath"))
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_companylist.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_companylist.php');</script>'";
		}
	   
   }
	   
   

?>