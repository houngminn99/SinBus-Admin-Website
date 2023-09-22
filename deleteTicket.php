<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
  if(!isset($_SESSION['Admin'])){
    echo '<script type="text/javascript">window.location.assign("login.php");</script>';
  }
  
	$temp = $_GET['id'];
    $id = base64_decode($temp);

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

   $query = "SELECT * FROM `ticket` INNER JOIN `schedule` on ticket.scheduleID = schedule.scheduleID WHERE ticket.id= '$decryption'";
	$result = $conn->query($query);
    if ($result->num_rows >0) {
		 while ($row = $result ->fetch_assoc()){ 
				  $scheduleID = $row["scheduleID"];
			      $Email = $row["Email"];
			      $Seat = $row["Seat"];
			      $Name = $row["Name"];
			      $Phone= $row["Phone"];
			      $date = $row["date"];
			      $price = $row["price"];
			      $emailuser = $row["emailuser"];
		   }
	}

   if($Email==''||$id ==''){
	     echo '<script type="text/javascript">window.location.assign("history.php");</script>';
   }else{
       $query ="DELETE FROM `ticket` where id='$decryption'";
	   $query2 ="INSERT INTO `ticket_delete`(`scheduleID`, `Email`, `Seat`, `Name`, `Phone`, `date`, `price`, `emailuser`) VALUES('$scheduleID','$Email','$Seat','$Name','$Phone','$date','$price','$emailuser')";

		if(mysqli_query($conn, $query) && mysqli_query($conn, $query2))
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('history.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('history.php');</script>'";
		}
	   
   }
	   
   

?>