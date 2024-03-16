<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
  
 if(!isset($_SESSION['Admin'])){
         echo '<script type="text/javascript">alert("Please login first!!");window.location.assign("login.php");</script>';
     }
  
  // Store the cipher method
	$ciphering = "AES-128-CTR";

	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;

	// Non-NULL Initialization Vector for encryption
	$encryption_iv = '1234567891011121';
    
    // Store the encryption key
	$encryption_key = "travel123";
    $emailuser= $_SESSION['Admin'];
    
    if(isset($_POST['filter'])){
          $destinationFilter = $_POST['destination'];
          $queryTable = "SELECT * FROM `schedule` INNER JOIN `company` ON schedule.companyID = company.companyID where schedule.scheduleDestination='$destinationFilter'";
    }else{
          $queryTable = "SELECT * FROM `schedule` INNER JOIN `company` ON schedule.companyID = company.companyID;";
    }

    if(isset($_POST['add'])){
         $company = $_POST['company'];
         $time = $_POST['time'];
         $duration = $_POST['duration'];
         $busdate = $_POST['busdate'];
         $destinationAdd = $_POST['destination'];
         $price = $_POST['price'];
         $number = date('N', strtotime($scheduleDateUpdate));
         if($number==1){
             $day='Monday';
         }else if($number ==2){
             $day='Tuesday';
         }else if($number ==3){
             $day='Wednesday';
         }
         else if($number ==4){
             $day='Thursday';
         }
         else if($number ==5){
             $day='Friday';
         }
         else if($number ==6){
             $day='Saturday';
         }
         else if($number ==7){
             $day='Sunday';
         }
         
         $query="INSERT INTO `schedule`(`companyID`, `scheduleTime`, `scheduleDuration`, `scheduleDate`, `scheduleDestination`, `schedulePrice`, `day`)  VALUES ('$company','$time','$duration','$busdate','$destinationAdd','$price','$day')";
          if(mysqli_query($conn, $query) )
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_schedule.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_schedule.php');</script>'";
		}
        
    }
    
     if(isset($_POST['update'])){
         $destinationUpdate = $_POST['scheduleDestinationPHP'];
         $scheduleTimeUpdate = $_POST['scheduleTimePHP'];
         $scheduleDateUpdate = $_POST['scheduleDatePHP'];
         $scheduleDurationUpdate = $_POST['scheduleDurationPHP'];
         $companyUpdate = $_POST['company'];
         $schedulePriceUpdate = $_POST['schedulePricePHP'];
         $number = date('N', strtotime($scheduleDateUpdate));
         $scheduleIDUpdate = $_POST['scheduleID'];
         if($number==1){
             $day='Monday';
         }else if($number ==2){
             $day='Tuesday';
         }else if($number ==3){
             $day='Wednesday';
         }
         else if($number ==4){
             $day='Thursday';
         }
         else if($number ==5){
             $day='Friday';
         }
         else if($number ==6){
             $day='Saturday';
         }
         else if($number ==7){
             $day='Sunday';
         }
         
         $query="UPDATE `schedule` SET `companyID`='$companyUpdate',`scheduleTime`='$scheduleTimeUpdate',`scheduleDuration`='$scheduleDurationUpdate',`scheduleDate`='$scheduleDateUpdate',`scheduleDestination`='$destinationUpdate',`schedulePrice`='$schedulePriceUpdate',`day`='$day' where `scheduleID` ='$scheduleIDUpdate'";
         if(mysqli_query($conn, $query) )
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_schedule.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_schedule.php');</script>'";
		}
	   
     }
?>
<html>
<head>
<meta charset="utf-8">
<title>Bus Schedule List</title>
	<style>
		.nav{
		color: #FFFFFF;
	}
	.nav a{
		padding: 10px;
		font-size: 16px;
		color:white;
	}
	.nav a:hover{
		background:#FFD100;
		box-shadow: 0px 1px 10px #fff;
		color: black;
		transition:0.3s;
		border-radius: 10px;
	}
	.login{
		font-family: Arvo;
		border-radius: 15px;
		height: 30px;
		width: 70px;
		border:0px;
		background-color: #FFFFFF;		
	}
	.login:hover{
		background:#FFD100;
		box-shadow: 0px 1px 10px #fff;
		color: black;
		transition:0.3s;
		border-radius: 15px;
	}
	.sinbus{
		color: #FFFFFF;
		font-family: Arvo;
	}
	.img {
		width: 200px;
	    height: 100px;
	}
	.video{
	    box-shadow: 0px 1px 10px #000000;
	}
	.audio{
	    box-shadow: 0px 1px 10px #000000;
	}
	.delbtn{
		padding-top:10px;
		padding-bottom: 10px;
		padding-left: 20px;
		padding-right: 20px;
		background-color: #BF0808;
		color:White;
		border-radius: 10px;
		text-decoration: none;
		font-size: 14px;
		font-family: Arial;
		}
		.upbtn{
			padding-top:10px;
			padding-bottom: 10px;
			padding-left: 20px;
			padding-right: 20px;
			background-color: #141850;
			color:white;
			border-radius: 10px;
			font-size: 14px;
			border:0px;
			font-family: Arial;
		 }
		 @media (max-width: 640px) {
          .modal {
            position: relative;
            width: 100%;
          }
        }
	   .modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  padding-top: 20px; /* Location of the box */
		  left: 0;
		  top: 0;
		  width: 100%; /* Full width */
		  height: 100%; /* Full height */
		  overflow: auto; /* Enable scroll if needed */
		  background-color: rgb(0,0,0); /* Fallback color */
		  background: rgba(0, 0, 0, 0.5);/* Black w/ opacity */
		  transition: opacity 500ms ease-in-out;
		    top: 0;
          left: 0;
          right: 0;
          bottom: 0;
		}	 
		  /* Modal Content */
		.modal-content {
		  transform: translate(-50%, -50%) scale(0.75);
		  background-color: #fefefe;
		  margin: auto;
		  padding: 30px;
		  border: 1px solid #888;
		  top: 50%;
          left: 50%;
          width: 60%;
          padding: 30px;
		  position: absolute;
		  height:600px;
		}
		.close {
			color: #aaaaaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}
		.update {
		  background-color: #04AA6D;
		  color: white;
		  padding: 14px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  height:50px;
		  border-radius:10px;
		}

		.update:hover {
		  opacity: 0.8;
		}
		.file{
		   height:50px;
		   font-size:16px;
		   padding-top:10px;
		}
		/*#company{
		    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
		}*/
		 .timetable{
			  margin-left: 10%;
			  margin-right: 10%;
		  }
		  input[type="search"] {
                height: 30px;
                border-radius: 10px;
                font-size: 16px;
                margin-bottom: 20px;
            }
		  .dataTables_length{
			  display:none;
		  }
		  
		  input[type=text], select {
			width: 25%;
			padding: 12px 20px;
			border-radius: 4px;
			box-sizing: border-box;
			margin-right: 8px;
		}
		input[type=date], select {
			width: 25%;
			padding: 12px 10px;
			border-radius: 4px;
			box-sizing: border-box;
		}
		  input[type=email], select {
			width: 25%;
			padding: 12px 20px;
			border-radius: 4px;
			box-sizing: border-box;
			margin-right: 8px;
		}
		input[type=number], select {
			width: 25%;
			padding: 12px 10px;
			margin: 8px 0;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.searchbtn{
			background:#FFE42F;
			color:Black;
			font-size: 16px;
			padding-top: 12px;
			padding-bottom: 12px;
			padding-left: 30px;
			padding-right: 30px;
			transition:0.3s;
			margin-left: 5%;
			border-radius: 10px;
			border:0;
			
			  }
		  .searchbtn:hover{
			  background-color: #C1B200;
		  }
		  
		  .ResetBtn{
			
			background:#FF0000;
			color:White;
			font-size: 16px;
			padding-top: 12px;
			padding-bottom: 12px;
			padding-left: 30px;
			padding-right: 30px;
			transition:0.3s;
			border-radius: 10px;
			  border:0;
			  }
		  .ResetBtn:hover{
			background:#B80003;
			color:White;
			  }
		 .add{
    			 padding-top:10px;
    			padding-bottom: 10px;
    			padding-left: 20px;
    			padding-right: 20px; 
    			background-color: #04AA6D;
    		    color: white;
    		  border: none;
    		  border-radius:10px;
			  }
	    .add:hover {
		  opacity: 0.8;
		}
		.addingform{
		    font-size:16px;
		}
		.fitimg {
				
			  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("home1.png") center fixed no-repeat;
			background-size:cover;
			}
			#company_previous{
		    
		    color: white;
		}
		#company_next{
		    color: white;
		}
		#company_info{
		    margin-top:20px;
		    color: white;
		}
		.paginate_button{
		    color: white;
		    margin-top:20px;
		    margin-left:50px;
		    margin-right:50px;
		}
		#company_paginate{
		     margin-top:20px;
		     margin-bottom:20px;
		}
		label{
		    height: 30px;
	    border-radius: 10px;
	    font-size:16px;
	    margin-bottom:20px;
	    color:white;
		}
		.dataTables_filter{
		    width:80%;
		}
		</style>
</head>
	<body style="font-family:Arvo; margin:0;" class="fitimg">
	    
		<div class="nav" style="background-color:#141850; text-align:center;" >
		<table style="margin-left: 20px;"><tr style="color: #FFFFFF;">
      <th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="20px"></th><th  style="font-size:35px;">SinBus</th>
		<td width="100px">
			</td>
		<td width="800px" align='center'>
			<br>
	    <a style="text-decoration: none;" href="home.php"><b>Home</b></a>
		
		&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
		
		<?php
			if(isset($_SESSION['Admin'])){
				echo '<a style="text-decoration: none;" href="schedule.php"><b>Book Ticket</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';
	           echo '<a style="text-decoration: none;" href="admin_schedule.php"><b>Manage Schedule</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';
			    echo '<a style="text-decoration: none;" href="admin_companylist.php"><b>Manage Company</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';
	           echo  '<a style="text-decoration: none;" href="history.php"><b>Booking List</b></a>
		               ';
			    
			    
			}
		?>
        </br></br>
		</td>
			<td width="110px"></td>
			<?php
			if(!isset($_SESSION['Admin'])){
				echo '
		    <td><button class="login" onclick="login()">Login</button>';
			}else{
				echo '
		    <td><button class="login" onclick="logout()">Logout</button>';
			}

			?>
			</td>
			</tr></table>
	
	</div>
	
	<br><br><br>
	<h2 style="text-align:center; color:white"><b>Bus Schedule List</b></h2>
	<br><br><br>
	
	<section class="timetable" >
	<div>
	    
			<br>
				<!--div class="row" align="center">
					   <form method="post">
						<select class="des" id="destination" name="destination" required>
							<option value="">Destination</option>
							<option value="Perak" <?php if($destinationFilter=='Perak'){echo "selected='selected'";} ?>>Perak</option>
							<option value="Perlis" <?php if($destinationFilter=='Perlis'){echo "selected='selected'";} ?>>Perlis</option>
							<option value="Penang" <?php if($destinationFilter=='Penang'){echo "selected='selected'";} ?>>Penang</option>
							<option value="Kelantan" <?php if($destinationFilter=='Kelantan'){echo "selected='selected'";} ?>>Kelantan</option>
							<option value="Terengganu" <?php if($destinationFilter=='Terrenganu'){echo "selected='selected'";} ?>>Terrenganu</option>
							<option value="Kuala Lumpur" <?php if($destinationFilter=='Kuala Lumpur'){echo "selected='selected'";} ?>>Kuala Lumpur</option>
							<option value="Malacca" <?php if($destinationFilter=='Malacca'){echo "selected='selected'";} ?>>Malacca</option>
							<option value="Pahang" <?php if($destinationFilter=='Pahang'){echo "selected='selected'";} ?>>Pahang</option>
							<option value="Negeri Sembilan" <?php if($destinationFilter=='Negeri Sembilan'){echo "selected='selected'";} ?>>Negeri Sembilan</option>
							<option value="Selangor" <?php if($destinationFilter=='Selangor'){echo "selected='selected'";} ?>>Selangor</option>
							<option value="Johor" <?php if($destinationFilter=='Johor'){echo "selected='selected'";} ?>>Johor</option>
						</select>
						  
						<button class="searchbtn" type="submit" name="filter">Search</button>
						<button class="resetbtn"  >Reset</button>
						
					  </form>
					</div-->
				
	<div align="center" >
	<section >
	    <button class="add" onclick='addModal()' style='float:right'>+&nbsp;&nbsp;&nbsp;&nbsp;Add</button>
		    <table style="test-align:center; background-color: white;" id="company" border="1" width="100%">
		        <thead>
			<tr>
			<th align="center" width="50px" height="50px" style="padding-bottom: 10px;">#</th>
			<th align="center" width="100px" height="50px" style="padding-bottom: 10px;">Company</th>
			<th align="center" width="60px" height="50px" style="padding-bottom: 10px;">Time</th>
			<th align="center" width="100px" height="50px" style="padding-bottom: 10px;">Duration</th>
			<th align="center" width="80px" height="50px" style="padding-bottom: 10px;">Date</th>
			<th align="center" width="150px" height="50px" style="padding-bottom: 10px;">Destination</th>
			<th align="center" width="100px" height="50px" style="padding-bottom: 10px;">Available Seats</th>
			<th align="center" width="100px" height="50px" style="padding-bottom: 10px;">Price (RM)</th>
			<th align="center" width="100px" height="50px" style="padding-bottom: 10px;">Action</th>
			</tr>
			  </thead>
		<?php
		  
			$result = $conn->query($queryTable);
			$number=0;
			if ($result->num_rows >0) {
			    $scheduleTimePHP = array();
			    $scheduleDurationPHP = array();
			    $scheduleDatePHP = array();
			    $scheduleDestinationPHP = array();
			    $schedulePricePHP = array();
			    $companyIDPHP = array();
			    $ScheduleIDPHP = array();
			    $day = array();
			    
				 while ($row = $result ->fetch_assoc()){ 
					  extract($row);
					    $number=$number+1;
					    $scheduleTimePHP[$number] = $scheduleTime;
					    $scheduleDurationPHP[$number] = $scheduleDuration;
					    $scheduleDatePHP[$number]= $scheduleDate;
					    $scheduleDestinationPHP[$number] = $scheduleDestination;
					    $schedulePricePHP[$number] = $schedulePrice;
					    $dayPHP[$number] = $day;
					    $companyIDPHP[$number] = $companyID;
					    $ScheduleIDPHP[$number] = $scheduleID;
					    
					    //calculate seat
					    $querySeat = "SELECT * FROM `ticket` where `scheduleID` = '$scheduleID'";
            			$resultSeat = $conn->query($querySeat);
            			$numberseat=0;
            			if ($resultSeat->num_rows >0) {
            				 while ($rowSeat = $resultSeat ->fetch_assoc()){ 
            					  extract($rowSeat);
            					  $numberseat=$numberseat+1;
            				 }
            			}
            			$totalseat= 24-$numberseat;
            			 $encryption = openssl_encrypt($scheduleID, $ciphering,	$encryption_key,$options, $encryption_iv);
						$encrptID = base64_encode($encryption);
            						echo"
						<tr height='100px'>
						     <td  style='text-align:center'>$number</td>
                			<td style='text-align:center'>$companyName</td>
        					<td style='text-align:center'>$scheduleTime</td>
        					<td style='text-align:center'>$scheduleDuration</td>
        					<td style='text-align:center'>$scheduleDate</td>
        					<td style='text-align:center'>$scheduleDestination</td>
        					<td style='text-align:center'>$totalseat</td>
        					<td style='text-align:center'>$schedulePrice</td>
						
							 <td style='text-align:center'><button class='upbtn'onclick='modal($number)'><b>Update</b></button>
								<br><br>
							    <a class='delbtn' href='admin_deleteschedule.php?id=$encrptID'><b>Delete</b></a><br><br></td>
							</tr>
							";
					        
							
				   }
			}
		
		?>
		</table>
	</section>
		</br></br></br></br></br>
	</div>
	</section>
	<!--Update-->
	<div id="myModal" class="modal">
	    <div class="modal-content"><span class="close" id="close">&times;</span>
	      <form  method="post">
			  <div class="imgcontainer" align="center">
				<h1>Update Form</h1>
			  </div>

			  <div class="container" style="margin-left:5%; margin-right:5%;">
			     
			      <table align="center" border="0" width="100%" >
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Destination: </b></td>
			          <td colspan="3"> <select class="des" id="scheduleDestinationPHP" name="scheduleDestinationPHP" style="font-size:16px;width:100%" required>
							<option value="">Destination</option>
							<option value="Perak">Perak</option>
							<option value="Perlis">Perlis</option>
							<option value="Penang">Penang</option>
							<option value="Kelantan">Kelantan</option>
							<option value="Terengganu">Terrenganu</option>
							<option value="Kuala Lumpur">Kuala Lumpur</option>
							<option value="Malacca">Malacca</option>
							<option value="Pahang">Pahang</option>
							<option value="Negeri Sembilan">Negeri Sembilan</option>
							<option value="Selangor">Selangor</option>
							<option value="Johor">Johor</option>
						</select>
						</td>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Time: </b></td>
			          <td colspan="3"><input type="time" class="form-control "  placeholder="Select Time" id="scheduleTimePHP" name="scheduleTimePHP" /></td>
			      </tr>
			        <tr height="70px">
			          <td colspan="3" class="addingform"><b>Date: </b></td>
			          <td colspan="3"><input type="date" id="scheduleDatePHP" name="scheduleDatePHP" style="font-size:16px;width:100%" required/></td>
			      </tr>
			       <tr height="70px">
			          <td colspan="3" class="addingform"><b>Duration: </b></td>
			          <td colspan="3"><input type="text"  name="scheduleDurationPHP"  id="scheduleDurationPHP" style="font-size:16px;width:100%" required/></td>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Price (RM): </b></td>
			          <td colspan="3"><input type="number"  name="schedulePricePHP"  id="schedulePricePHP" style="font-size:16px;width:100%" required/></td>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Company : </b></td>
			          <td colspan="3"><select id="company" name="company" style="font-size:16px;width:100%" required/>
	
			             <?php
			               $query = "SELECT * FROM `company`";
                			$result = $conn->query($query);
                			if ($result->num_rows >0) {
                			     while ($row = $result ->fetch_assoc()){ 
					               extract($row);
			                     echo "<option value='$companyID'>$companyName</option>";
                			     }
                			}
                			
                			?>

                       </select>
                       <input type='hidden' id='scheduleID' name='scheduleID'  />
			          </td>
			      </tr>
			     
			      <tr height="70px"><td colspan="5">
				<button name="update" type="submit" class="update"  style="font-size:16px;">Update</button></td></tr>
                </table>
			  </div>

			</form> </div>
           </div>
           
           <!--AddSchedule-->
           <div id="myModal2" class="modal">
	    <div class="modal-content"><span class="close" id="close2">&times;</span>
	      <form  method="post">
			  <div class="imgcontainer" align="center">
				<h1>Adding Schedule Form</h1>
			  </div>

			  <div class="container" style="margin-left:5%; margin-right:5%;">
			      <table align="center" border="0" width="100%" >
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Company : </b></td>
			          <td colspan="3"><select id="company" name="company" style="font-size:16px;width:100%" required/>
	                   <option value=''>Select</option>
			             <?php
			               $query = "SELECT * FROM `company`";
                			$result = $conn->query($query);
                			if ($result->num_rows >0) {
                			     while ($row = $result ->fetch_assoc()){ 
					               extract($row);
			                     echo "<option value='$companyID'>$companyName</option>";
                			     }
                			}
                			
                			?>

                       </select>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Time: </b></td>
			          <td colspan="3"><input type="time" class="form-control " name='time' placeholder="Select Time" id="Text1" /></td>
			      </tr>
			       <tr height="70px">
			          <td colspan="3" class="addingform"><b>Duration: </b></td>
			          <td colspan="3"><input type="text" id="duration" name="duration"  style="font-size:16px;width:100%" required/></td>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Date: </b></td>
			          <td colspan="3"><input type="date" id="busdate" name="busdate" style="font-size:16px;width:100%" required/></td>
			      </tr>
			      <tr height="70px">
			          <td colspan="3" class="addingform"><b>Destination: </b></td>
			          <td colspan="3"> <select class="des" id="destination" name="destination" style="font-size:16px;width:100%" required>
							<option value="">Destination</option>
							<option value="Perak">Perak</option>
							<option value="Perlis">Perlis</option>
							<option value="Penang">Penang</option>
							<option value="Kelantan">Kelantan</option>
							<option value="Terengganu">Terrenganu</option>
							<option value="Kuala Lumpur">Kuala Lumpur</option>
							<option value="Malacca">Malacca</option>
							<option value="Pahang">Pahang</option>
							<option value="Negeri Sembilan">Negeri Sembilan</option>
							<option value="Selangor">Selangor</option>
							<option value="Johor">Johor</option>
						</select>
						</td>
			      </tr>
			      <tr height="70px">
			      
			          <!--td width="20px"></td-->
			          <td class="addingform" colspan="3"><b>Price (RM): </b></td>
			          <td><input type="number" min="0" max="10000" step="1" name="price" id="price"
			          style="font-size:16px;width:100%"required></td>
			      </tr>
			      
			      <tr height="70px"><td colspan="5">
				<button name="add" type="submit" class="update"  style="font-size:16px;">Register</button></td></tr>
                </table>
			  </div>

			</form> </div>
           </div>
    
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script>
$(document).ready(function() {
    
    var table = $('#company').DataTable( {
        select: true
    } );
 
    table
        .on( 'select', function ( e, dt, type, indexes ) {
          
          
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
          
         
        } );

} );
	function login(){
		window.location.assign('login.php');
	}
	function logout(){
		window.location.assign('logout.php');
	}
	function addModal(){
	    	var modal = document.getElementById("myModal2");
	    		// Get the <span> element that closes the modal
	    	var span = document.getElementById("close2");

		    // When the user clicks the button, open the modal 

		      modal.style.display = "block";
		      
		  span.onclick = function() {
    		  modal.style.display = "none";
    		}
    
    		// When the user clicks anywhere outside of the modal, close it
    		window.onclick = function(event) {
    		  if (event.target == modal) {
    			modal.style.display = "none";
    		  }
	}
	}
	function modal(id){
   
		// Get the modal
		var modal = document.getElementById("myModal");
        var number = '<?php echo $number ?>'; 
	    var scheduleTimePHP =[],scheduleDurationPHP=[],scheduleDatePHP=[],scheduleDestinationPHP=[],schedulePricePHP=[],companyIDPHP=[],ScheduleIDPHP=[];
	    <?php
	        for($i=1;$i<$number;$i++){
	    ?>
	    
			scheduleTimePHP[<?php echo $i ?>]='<?php echo $scheduleTimePHP[$i] ?>';
	        scheduleDurationPHP[<?php echo $i ?>]='<?php echo $scheduleDurationPHP[$i] ?>';
	        scheduleDatePHP[<?php echo $i ?>]='<?php echo $scheduleDatePHP[$i] ?>';
	        scheduleDestinationPHP[<?php echo $i ?>]='<?php echo $scheduleDestinationPHP[$i] ?>';
	        schedulePricePHP[<?php echo $i ?>]='<?php echo $schedulePricePHP[$i] ?>';
	        companyIDPHP[<?php echo $i ?>]='<?php echo $companyIDPHP[$i] ?>';
	        ScheduleIDPHP[<?php echo $i ?>]='<?php echo $ScheduleIDPHP[$i] ?>';
	    <?php
		}
	    ?>
	    document.getElementById("scheduleDestinationPHP").value=scheduleDestinationPHP[id];
	    document.getElementById("scheduleTimePHP").value=scheduleTimePHP[id];
	    document.getElementById("scheduleDatePHP").value=scheduleDatePHP[id];
	    document.getElementById("scheduleDurationPHP").value=scheduleDurationPHP[id];
		document.getElementById("company").value=companyIDPHP[id];
	    document.getElementById("scheduleID").value = ScheduleIDPHP[id];
	    document.getElementById("schedulePricePHP").value = schedulePricePHP[id];
    
		// Get the <span> element that closes the modal
		var span = document.getElementById("close");

		// When the user clicks the button, open the modal 

		  modal.style.display = "block";


		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
			modal.style.display = "none";
		  }
}
}	
</script>