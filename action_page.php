<?php 
  session_start();
  error_reporting(0);
  include("dbconnect.php");
   if(!isset($_SESSION['Admin'])){
    echo '<script type="text/javascript">window.location.assign("schedule.php");</script>';
  }

   $number = count($_POST['Email']);
   $Email = $_POST['Email'];
   $Seat = $_POST['SeatNumber'];
   $Name = $_POST['Name'];
   $Phone = $_POST['Phone'];
   $ScheduleID = $_POST['ScheduleID'];
   $seatPrice = $_POST['seatPrice'];
   $fail =array();  
   $emailuser = $_SESSION['Admin'];

 
   for($x=0;$x<$number;$x++){
	   if(empty($Email[$x]) && empty($Seat[$x]) && empty($Name[$x]) && empty($Phone[$x]) && empty($ScheduleID) && empty($seatPrice)){
		  echo $fail[$x]='fail';
	   }
   }
   if(empty($fail)){
	    for($x=0;$x<$number;$x++){
		  $scID = $ScheduleID;
		  $em = $Email[$x];
		  $st = $Seat[$x];
		  $nme = $Name[$x];
		  $phne = $Phone[$x];
		 
		  $query = "INSERT INTO `ticket`(`scheduleID`, `Email`, `Seat`, `Name`, `Phone`,`price`,`emailuser`) VALUES ('$scID','$em','$st','$nme','$phne','$seatPrice','$emailuser')";
			if(mysqli_query($conn, $query))
			 {
				  echo "<script type='text/javascript'>alert('Success!!');window.location.assign('history.php');</script>'";
			 }else{
			      echo "<script type='text/javascript'>alert('Fail !!');window.location.assign('schedule.php');</script>'";
			 }
		}
   }

?>