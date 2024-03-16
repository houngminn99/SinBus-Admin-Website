<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
    
  if(!isset($_SESSION['Admin'])){
         echo '<script type="text/javascript">alert("Please login first!!");window.location.assign("login.php");</script>';
     }
     
    
     
  if(isset($_POST['filter'])){
	  $date = $_POST['bookingdate'];
	  $destination = $_POST['destination'];
	  $todaydate=date("Y-m-d");
	  if($date>$todaydate){
	      
	         $query = "SELECT * FROM `schedule` INNER JOIN company ON schedule.companyID = company.companyID WHERE`scheduleDestination`='$destination' && `scheduleDate`='$date'";
             $result = $conn->query($query);
             $tempSchedule=0;
            	if ($result->num_rows > 0)
            	{
            	    $schduleID= array();
            		while ($row = $result->fetch_assoc())
            		{
            		    $schduleID[$tempSchedule]= $row["scheduleID"];
            			$tempSchedule=$tempSchedule+1;
            			
                   }
             }
	      
	      
	        
             $queryticket = "SELECT schedule.scheduleID, ticket.Seat FROM `schedule` INNER JOIN `ticket` ON schedule.scheduleID = ticket.scheduleID WHERE`scheduleDestination`='$destination' && `scheduleDate`='$date'";
             $result = $conn->query($queryticket);
             $tempTicket=0;
            	if ($result->num_rows > 0)
            	{
            	    $phpScheduleID = array();
            		$ticket = array();
            		$seatleft = array();
            		while ($row = $result->fetch_assoc())
            		{
            	        
            		    $phpScheduleID[$tempTicket]= $row["scheduleID"];
            			$ticket[$tempTicket] =$row["Seat"];
            			
            			for($i=0;$i<$tempSchedule;$i++){
            				if($phpScheduleID[$tempTicket] == $schduleID[$i]){
            					 $seatleft[$i]=$seatleft[$i]+1;
            				
            				}
            			}
            			$tempTicket=$tempTicket+1;
            			
                   }
             }	 
 	 
	  }else{
	       $date='';
	       $destination='';
	       echo '<script type="text/javascript">alert("Date cannot smaller than today!!");</script>';
	  }
	  
	  
  }else{
      $query='';
  }




?>

<!doctype html>
<html lang="en">
  <head>
  	<title>schedule</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--	<link rel="stylesheet" href="css/style.css">-->
	  <style>
		  table {
			  border-collapse: collapse; }
		 .table {
			  width: 100%;
			  border-radius:10px;
			  color: #212529; }
		  .table th,
		  .table td {
				padding: 0.75rem;
				vertical-align: top;
			  text-align: center;
				border-top: 1px solid #dee2e6; }
		   
			 .table {
		
			  width: 100%;
			  -webkit-box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29);
			  -moz-box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29);
			  box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29);
		  	}
			 .table thead th {
				border: none;
				padding-top: 10px;
				font-size: 16px;
				font-weight: bold;
			 }
			  .table thead tr {
				background: #ffffff;
				}
			  .table tbody tr {
				margin-bottom: 10px;
				border-bottom: 4px solid #f8f9fd; }
				.table tbody tr:last-child {
				  border-bottom: 0; }
			 .table tbody th, .table tbody td {
				border: none;
				padding: 30px;
				font-size: 14px;
				background: #fff;
				vertical-align: middle; }
			 .table tbody td.status span {
				position: relative;
				border-radius: 30px;
				padding: 4px 10px 4px 25px; }
		     .table tbody td.status span:after {
				  position: absolute;
				  top: 9px;
				  left: 10px;
				  width: 10px;
				  height: 10px;
				  content: '';
				  border-radius: 50%; }
			 .table tbody td.status .active {
				background: #cff6dd;
				color: #1fa750; }
				.table tbody td.status .active:after {
				  background: #23bd5a; }
			 .table tbody td.status .waiting {
				background: #fdf5dd;
				color: #cfa00c; }
				.table tbody td.status .waiting:after {
				  background: #f2be1d; }
			 .table tbody td .img {
				width: 100px;
				height: 50px;
				 }
			 .table tbody td .email span {
				display: block; }
		     .table tbody td .email span:last-child {
				  font-size: 12px;
				  color: rgba(0, 0, 0, 0.3); }
			 .table tbody td .close span {
				font-size: 12px;
				color: #dc3545; }
			 .img {
			  background-size: cover;
			  background-repeat: no-repeat;
			  background-position: center center; }
		  
		  /*copy this*/
		     .timetable{
			  margin-left: 20%;
			  margin-right: 20%;
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
		  .dataTables_filter{
			  display:none;
			  
		  }

		 input[type=search], select {
			width: 25%;
			padding: 12px 10px;
			margin: 8px 0;
			border-radius: 4px;
			box-sizing: border-box;
	   	  }
		  .dataTables_length{
			  display:none;
		  }
		  body{
			  margin: 0;
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
		  /*copy this*/
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
		  #nextBtn {
			  background-color: #141850;
			  color: #ffffff;
			  border: none;
			  padding: 10px 20px;
			  font-size: 17px;
			  cursor: pointer;
			  border-radius:5px;
			}

			#nextBtn:hover {
			  opacity: 0.8;
			}
			#prevBtn:hover {
			  opacity: 0.8;
			}
			#prevBtn {
			   background-color: #141850;
			  color: #ffffff;
			  border: none;
			  padding: 10px 20px;
			  font-size: 17px;
			  cursor: pointer;
			  border-radius:5px;
			}
		  .filter{
			  display:none;
		  }
		  
			.modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  padding-top: 10px; /* Location of the box */
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
		  padding: 20px;
		  border: 1px solid #888;
		  top: 50%;
          left: 50%;
          width: 80%;
          padding: 30px;
		  position: absolute;
		}
			.fitimg {
				
			  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("home1.png") center fixed no-repeat;
			background-size:cover;
			}
			
			#regForm {

			  background-color: #fefefe;
			  margin: auto;
			  padding: 20px;
			  border: 1px solid #888;
			  width: 50%;

			}

			h1 {
			  text-align: center;  
			}

			input {
			  padding: 10px;
			  width: 95%;
			  font-size: 17px;
			  font-family: Raleway;
			  border: 1px solid #aaaaaa;
			}

			/* Mark input boxes that gets an error on validation: */
			input.invalid {
			  background-color: #ffdddd;
			}

			/* Hide all steps by default: */
			.tab {
			  display: none;
			}

			

			/* Make circles that indicate the steps of the form: */
			.step {
			  height: 15px;
			  width: 15px;
			  margin: 0 2px;
			  background-color: #bbbbbb;
			  border: none;  
			  border-radius: 50%;
			  display: inline-block;
			  opacity: 0.5;
			}

			.step.active {
			  opacity: 1;
			}

			/* Mark the steps that are finished and valid: */
			.step.finish {
			  background-color: #04AA6D;
			}
					  /* The Close Button */
			.close {
			  color: #aaaaaa;
			  float: right;
			  font-size: 28px;
			  font-weight: bold;
			}

			.close:hover,
			.close:focus {
			  color: #000;
			  text-decoration: none;
			  cursor: pointer;
			}
		  .movie-container {
			  margin: 20px 0;
			}

			.movie-container select {
			  background-color: #fff;
			  border: 0;
			  border-radius: 5px;
			  font-size: 14px;
			  margin-left: 10px;
			  padding: 5px 15px 5px 15px;
			  -moz-appearance: none;
			  -webkit-appearance: none;
			  appearance: none;
			}

			.container {
			     border-style: solid;
				 border-radius: 30px;
				 margin-left: 35%;
				 margin-right: 38%;
				 padding-left: 25px;
				padding-right: 25px;
				padding-top: 50px;
				padding-bottom: 25px;
			}

			.seat {
			  background-color: #444451;
			  height: 23px;
			  width: 28px;
			  margin: 3px;
			  border-top-left-radius: 8px;
			  border-top-right-radius: 8px;
			}

			.seat-selected {
			  background-color: #6feaf6;
			}
		    
		    
             .seat.selected {
			  background-color: #6feaf6;
			}
		  
			.seat.occupied {
			  background-color: #d3d3d3;
			}

			.seat:nth-of-type(2) {
			  margin-right: 18px;
			}

			.seat:nth-last-of-type(2) {
			  margin-left: 18px;
			}

			.seat:not(.occupied):hover {
			  cursor: pointer;
			  transform: scale(1.2);
			}

			.showcase .seat:not(.occupied):hover {
			  cursor: default;
			  transform: scale(1);
			}

			.showcase {
			  background: rgba(0, 0, 0, 0.1);
			  padding: 5px 10px;
			  border-radius: 5px;
			  color: #777;
			  list-style-type: none;
			  display: flex;
			  
			}

			.showcase li {
			  display: flex;
			  align-items: center;
			  justify-content: center;
			 
			}

			.showcase li small {
			  margin-left: 2px;
			}
			
			
			.screen {
			  background-color: #fff;
			  height: 70px;
			  width: 100%;
			  margin: 15px 0;
			  transform: rotateX(-45deg);
			  box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
			}

			p.text {
			  margin: 5px 0;
				font-weight:normal
			}

			p.text span {
			  color: #0000FF;
				font-weight:normal
			}
		  
		 .row{
			  background: rgba(255, 255, 255, 0.5);
			  border-radius: 10px;
		  }
		  .row2 {
			  display: flex;
			 
			}

		  .table table-responsive-xl{
			  background-color: #FFFFFF;
			  border-radius: 10px;
			  width: 100%;
			  
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
   .dataTables_info{
       color:white;
       padding-top: 25px;
   }
    #example_paginate{
        color:white;
        padding-bottom: 35px;
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
				echo '<a style="text-decoration: none;" href="schedule.php" ><b>Book Ticket</b></a>
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
	<section class="timetable">
		<div>
			<br>
			<h2 class="heading-section" style="color:white;">Where do you want to go from Sintok, Kedah?</h2>
			
				<div class="row" align="center">
					   <form method="post">
						<input class="bookingdate" type="date" name="bookingdate" id="bookingdate" value="<?php echo $date ?>" required>
						<select class="des" id="destination" name="destination" required>
							<option value="">Destination</option>
							<option value="Perak" <?php if($destination=='Perak'){echo "selected='selected'";} ?>>Perak</option>
							<option value="Perlis" <?php if($destination=='Perlis'){echo "selected='selected'";} ?>>Perlis</option>
							<option value="Penang" <?php if($destination=='Penang'){echo "selected='selected'";} ?>>Penang</option>
							<option value="Kelantan" <?php if($destination=='Kelantan'){echo "selected='selected'";} ?>>Kelantan</option>
							<option value="Terengganu" <?php if($destination=='Terrenganu'){echo "selected='selected'";} ?>>Terengganu</option>
							<option value="Kuala Lumpur" <?php if($destination=='Kuala Lumpur'){echo "selected='selected'";} ?>>Kuala Lumpur</option>
							<option value="Malacca" <?php if($destination=='Malacca'){echo "selected='selected'";} ?>>Malacca</option>
							<option value="Pahang" <?php if($destination=='Pahang'){echo "selected='selected'";} ?>>Pahang</option>
							<option value="Negeri Sembilan" <?php if($destination=='Negeri Sembilan'){echo "selected='selected'";} ?>>Negeri Sembilan</option>
							<option value="Selangor" <?php if($destination=='Selangor'){echo "selected='selected'";} ?>>Selangor</option>
							<option value="Johor" <?php if($destination=='Johor'){echo "selected='selected'";} ?>>Johor</option>
						</select>
						  
						<button class="searchbtn" type="submit" name="filter">Search</button>
						 <button class="ResetBtn">Reset</button>
						
					  </form>
					</div>	
			<p style='color:red; text-align:center;' id='tableerrormessage'></p><br>
			<div class="row2">
			    
				<?php
				  if($query!=''){
				      echo"
				  
						<table class='table table-responsive-xl' id='example' align='center' border='1'>
						  <thead>
						    <tr>
						    	<th align='center' width='20px' style='padding-bottom: 10px;'>#</th>
								
						    	<th align='center' width='150px' style='padding-bottom: 10px;'>Company</th>
								<th align='center' width='60px' style='padding-bottom: 10px;'>Time</th>
						        <th align='center' width='350px' style='padding-bottom: 10px;'>Duration</th>
						        <th align='center' width='150px' style='padding-bottom: 10px;'>Date</th>
						        <th align='center' width='150px' style='padding-bottom: 10px;'>Destination</th>
								<th align='center' width='100px' style='padding-bottom: 10px;'>Available Seats</th>
								<th align='center' width='100px' style='padding-bottom: 10px;'>Price (RM)</th>
								<th style='display:none'>scheduleID</th>
						    </tr>
						  </thead>
						  
						  <tbody>
						    "; } ?>
								<?php
								
								if($query!='')
								{
								$num=0; 
								
							    $result = $conn->query($query);
                                if($result->num_rows > 0){
                                  while ($row = $result ->fetch_assoc()){
                                  extract($row);
								  $todaydate=date("Y-m-d");
								  if($scheduleDate>$todaydate)
								  {
								       $num=$num+1;
								       $temptable = 24 -$seatleft[($num-1)];
								       
        								echo"
        								<tr class='alert' role='alert'>
        						    	<td width='30px'>$num</td>
        						        <td><img class='img' style='text-align: center;' src='data:image/jpeg;base64,".base64_encode($companyPicture)."'/><p>$companyName</p></td>
        						        <td width='80px'>$scheduleTime</td>
        								<td width='250px'>$scheduleDuration</td>
        								<td width='350px'>$scheduleDate</td>
        								<td>$scheduleDestination</td>
        						        <td>$temptable</td>
        								<td>$schedulePrice</td>
        								<td style='display:none'>$scheduleID</td>
        								</tr>";
								      }
							    	}
                                }else if($scheduleDate==$todaydate){
								        $num=$num+1;
								        $temptable = 24 -$seatleft[($num-1)];
        								echo"
        								<tr class='alert' role='alert' style='color:#FF0000'>
        						    	<td>$num</td>
        						        <td><img class='img' style='text-align: center;' src='data:image/jpeg;base64,".base64_encode($companyPicture)."'/><p>$companyName</p></td>
        						        <td>$scheduleTime</td>
        								<td>$scheduleDuration</td>
        								<td>$scheduleDate</td>
        								<td>$scheduleDestination</td>
        						        <td>$temptable</td>
        								<td>$schedulePrice</td>
        								<td style='display:none'>$scheduleID</td>
        								</tr>";
								  }
                                if($num==0 && $query!=''){
                                    echo '<script type="text/javascript"> document.getElementById("tableerrormessage").innerHTML="Please refer to company bus schedule!!";</script>';
                                   
                                }else{
                                       echo '<script type="text/javascript"> document.getElementById("tableerrormessage").innerHTML="";</script>';
                                   
                                }
                                								    
								}
								?>
						    
						   	<?php
				  if($query!=''){
				      echo'
						  </tbody>
						</table>';}  ?>
				<br><br>	
			</div>
		</div>
		
	</section>
	<div class='modal' id='myModal'>
<form id="regForm" action="action_page.php" method="post"><span class="close">&times;</span>
  <h1 id="seatTitle">Register:</h1>
  <input type="hidden" name="ScheduleID" id="ScheduleID"/>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
  <div movie-containerclass="movie-container">
      
    </div>

			<ul class="showcase">
			  <li style="margin-left: 35%">
				<div class="seat"></div>
				<small>Available</small>&nbsp;&nbsp;&nbsp;
			  </li>
			  <li>
				<div class="seat selected"></div>
				<small>Selected</small>&nbsp;&nbsp;&nbsp;
			  </li>
			  <li style="margin-right: 35%">
				<div class="seat occupied"></div>
				<small>Occupied</small>
			  </li>
			</ul>

			<div class="container">
		

			  <div class="row2">
				 <div class="seat" id='seatid0'>
				    <input type="checkbox"  name="1a" value="1a" id='0' style="opacity:0;"/>
                  </div>
				<div class="seat"  id='seatid1'>
				    <input type="checkbox" name="1b" value="1b" id='1' style="opacity:0;"/>
                </div>
				<div class="seat"  id='seatid2'>
				    <input type="checkbox" name="1c" value="1c" id='2' style="opacity:0;"/>
                  </div>
				<div class="seat"  id='seatid3'>
				    <input type="checkbox" name="1d" value="1d" id='3' style="opacity:0;" />
                </div>
			  </div>

			  <div class="row2">
				<div class="seat"  id='seatid4'>
				    <input type="checkbox" name="2a" value="2a" id='4' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid5'>
				    <input type="checkbox" name="2b" value="2b" id='5' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid6'>
				    <input type="checkbox" name="2c" value="2c" id='6' style="opacity:0;" />
                  </div>
				<div class="seat"  id='seatid7'> 
				    <input type="checkbox" name="2d" value="2d" id='7' style="opacity:0;" />
                </div>
			  </div>

			  <div class="row2">
				<div class="seat"  id='seatid8'>
				    <input type="checkbox" name="3a" value="3a" id='8' style="opacity:0;"/>
                </div>
				<div class="seat"  id='seatid9'>
				    <input type="checkbox" name="3b" value='3b' id='9' style="opacity:0;" />
                </div>
			    <div class="seat"  id='seatid10'>
				    <input type="checkbox" name="3c" value="3c" id='10' style="opacity:0;"/>
                  </div>
				<div class="seat"  id='seatid11'>
				    <input type="checkbox" name="3d" value="3d" id='11' style="opacity:0;" />
                </div>
			  </div>

			  <div class="row2">
				<div class="seat"  id='seatid12'>
				    <input type="checkbox" name="4a" value="4a" id='12' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid13'>
				    <input type="checkbox" name="4b" value="4b" id='13' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid14'>
				    <input type="checkbox" name="4c" value="4c" id='14' style="opacity:0;" />
                  </div>
				<div class="seat"  id='seatid15'>
				    <input type="checkbox" name="4d" value="4d" id='15' style="opacity:0;" />
                </div>
			  </div>

			  <div class="row2">
				<div class="seat"  id='seatid16'>
				    <input type="checkbox" name="5a" value="5a" id='16' style="opacity:0;" />
                </div>
			    <div class="seat"  id='seatid17'>
				    <input type="checkbox" name="5b" value="5b" id='17' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid18'>
				    <input type="checkbox" name="5c" value="5c" id='18' style="opacity:0;" />
                  </div>
				<div class="seat"  id='seatid19'>
				    <input type="checkbox" name="5d" value="5d" id='19' style="opacity:0;" />
                </div>
			  </div>

			  <div class="row2">
				<div class="seat"  id='seatid20'>
				    <input type="checkbox" name="6a" value="6a" id='20' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid21'>
				    <input type="checkbox" name="6b" value="6b" id='21' style="opacity:0;" />
                </div>
				<div class="seat"  id='seatid22'>
				    <input type="checkbox" name="6c" value="6c" id='22' style="opacity:0;" />
                  </div>
				<div class="seat"  id='seatid23'>
				    <input type="checkbox" name="6d" value="6d" id='23' style="opacity:0;" />
                </div>
			  </div>
			</div>

			<p class="text" style="text-align: center">
			  You have selected <span id="count">0</span> seats for a price of RM<span
				id="price" >0</span>
				<input type="hidden" id='seatPrice' name='seatPrice'/>
			</p>
	  <p style="color: red; text-align: center;" id="errormessage"></p>
  </div>
  <div class="tab">
       <div id="customerdetail"></div>
  </div>

  <div class="tab">
     <h3>Confirmation:</h3>
	  <div class="row2">
       <table class="table table-responsive-xl" id='confirmPayment' >
						  <!--thead-->
						    <tr>
						    	
						    	<th>Description</th>
								<th>Unit Price</th>
						        <th>Qty</th>
						        <th>Amount (RM)</th>
						     
						    </tr>
						  <!--/thead-->
						  <!--tbody>
						      <tr>
						          <td></td>
						          <td></td>
						          <td></td>
						          <td></td>
						      </tr>
						      
						  </tbody-->
						</table></div>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
 
  </div>
</form>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    
	</body>
</html>
<script>

$(document).ready(function() {
   
    var table = $('#example').DataTable( {
        select: true
    } );
 
    table
        .on( 'select', function ( e, dt, type, indexes ) {
            var time = table.row( indexes  ).data()[2];
		    var destination2 = table.row( indexes  ).data()[5];
		    var date = table.row( indexes  ).data()[4];
		    var seat = table.row( indexes  ).data()[6];
		    var price = table.row( indexes  ).data()[7];
		    var scheduleID = table.row( indexes  ).data()[8];
		    var seatTitle = document.getElementById('seatTitle');
		    var seatPrice = document.getElementById('seatPrice');
		    var price2 = document.getElementById('price');
		    var count = document.getElementById('count');
		    var checkboxes = document.getElementsByTagName('input');
		    var ScheduleID = document.getElementById('ScheduleID');
            // Get the modal
			var modal = document.getElementById("myModal");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];
		
             if(seat<1){
				 alert('Seat was full ！！');
			 }else{
			        var uncheck=document.getElementsByTagName('input');
        			 for(var i=0;i<uncheck.length;i++)
        			 {
        			  if(uncheck[i].type=='checkbox')
        			  {
        			   uncheck[i].checked=false;
        			  }
        			 }
        			 
        			
        			seatTitle.innerHTML= ''+date+' - '+destination2;
					seatPrice.value = price; 
					ScheduleID.value=scheduleID;
					// When the user clicks the button, open the modal 
					 modal.style.display = "block";
					 ticket(scheduleID);
			 }
		    //pass value
		   
            
			// When the user clicks on <span> (x), close the modal
			 span.onclick = function() {
			  var ScheduleID = document.getElementById('ScheduleID').value='';
			  modal.style.display = "none";
			  price2.value='0';
			  count.value='0';
			  emptyseat();
			  document.getElementById("errormessage").innerHTML='';
			 if(currentTab==2){
						nextPrev(-2);myfunction();
					}else if(currentTab==3){
						nextPrev(-3);myfunction();
					}else if(currentTab==1){
						nextPrev(-1);myfunction();
					}else{myfunction();}
			 
			        var table = document.getElementById('confirmPayment');
        			var tbodyRowCount = table.tBodies[0].rows.length;
        			if(tbodyRowCount>1){
        				for (var i = 1; i < tbodyRowCount; i++) {
        				table.deleteRow(1);
        		
        				}
        			}
				
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
				      var ScheduleID = document.getElementById('ScheduleID').value='';
					  modal.style.display = "none";
					  price2.value='0';
					  count.value='0';
				      emptyseat();
					  document.getElementById("errormessage").innerHTML='';
					  if(currentTab==2){
						nextPrev(-2);myfunction();
					}else if(currentTab==3){
						nextPrev(-3);myfunction();
					}else if(currentTab==1){
						nextPrev(-1);myfunction();
					}else{myfunction();}
					
					var table = document.getElementById('confirmPayment');
        			var tbodyRowCount = table.tBodies[0].rows.length;
        			if(tbodyRowCount>1){
        				for (var i = 1; i < tbodyRowCount; i++) {
        				table.deleteRow(1);
        		
        				}
        			}
					  
			  }
			}
					} )
//        .on( 'deselect', function ( e, dt, type, indexes ) {
//            var time = table.row( indexes  ).data()[2];
//		    var destination = table.row( indexes  ).data()[5];
//		    var date = table.row( indexes  ).data()[4];
//		    var seat2 = table.row( indexes  ).data()[6];
//		    var price = table.row( indexes  ).data()[7];
//		    var scheduleID = table.row( indexes  ).data()[8];
//		    var seatTitle = document.getElementById('seatTitle');
//		    var seatPrice = document.getElementById('seatPrice');
//		    var price2 = document.getElementById('price');
//		    var count = document.getElementById('count');
//		    var checkboxes = document.getElementsByTagName('input');
//		    var ScheduleID = document.getElementById('ScheduleID');
//		    ticket(destination);
//            // Get the modal
//			var modal = document.getElementById("myModal");
//
//			// Get the <span> element that closes the modal
//			var span = document.getElementsByClassName("close")[0];
//             
//		    //pass value
//		    if(seat2<1){
//				 alert('Seat was full ！！');
//			 }else{
//				    alert("a");
//				    seatTitle.innerHTML= ''+date+' - '+destination;
//					seatPrice.value = price; 
//					ScheduleID.value=scheduleID;
//					// When the user clicks the button, open the modal 
//					 modal.style.display = "block";
//					 ticket(destination);
//			 }
//			
//            
//			// When the user clicks on <span> (x), close the modal
//			  span.onclick = function() {
//				  var ScheduleID = document.getElementById('ScheduleID').value='';
//			      modal.style.display = "none";
//				  price2.value='0';
//				  count.value='0';
//				  document.getElementById("errormessage").innerHTML='';
//		
//				  
//				 if(currentTab==2){
//						nextPrev(-1);
//						nextPrev(-1);
//					}else if(currentTab==3){
//						nextPrev(-1);
//						nextPrev(-1);
//						nextPrev(-1);
//					}else if(currentTab==1){
//						nextPrev(-1);
//					}else{myfunction();}
//			}
//				
//			
//
//			// When the user clicks anywhere outside of the modal, close it
//			window.onclick = function(event) {
//			  if (event.target == modal) {
//				      var ScheduleID = document.getElementById('ScheduleID').value='';
//					  modal.style.display = "none";
//					  price2.value='0';
//					  count.value='0';
//					  
//					  document.getElementById("errormessage").innerHTML='';
//					   if(currentTab==2){
//						nextPrev(-1);
//						nextPrev(-1);
//					}else if(currentTab==3){
//						nextPrev(-1);
//						nextPrev(-1);
//						nextPrev(-1);
//					}else if(currentTab==1){
//						nextPrev(-1);
//					}else{myfunction();}
//			  }
//			}
//           
//        } );
		} );
		var currentTab = 0; // Current tab is set to be the first tab (0)
		showTab(currentTab); // Display the current tab
    function emptyseat(){
		
		for (var x=0;x<24;x++){
			var seatid = document.getElementById('seatid'+x);
			if(seatid.className='seat selected')
			{
				seatid.className='seat';
			    document.getElementById(''+x).disabled = false;
			}
			
		}
		
	}
	function myfunction(){
			   seatRequestNumber=0;
			   var temp2 =0;
		       document.getElementById('count').innerHTML=0;
		       document.getElementById('price').innerHTML=0;
              
			   var h3 = document.getElementsByTagName('h3');
			  // A loop that checks every input field in the current tab:
			  for (i = 0; i < h3.length; i++) {
				// If a field is empty...
				if (h3[i].id == "row0") {
				    var myobj = document.getElementById("row0");
					myobj.remove();
				}
				if (h3[i].id == "row1") {
				    var myobj = document.getElementById("row1");
					myobj.remove();
				}
				if (h3[i].id == "row2") {
				    var myobj = document.getElementById("row2");
					myobj.remove();
				}
				if (h3[i].id == "row3") {
				    var myobj = document.getElementById("row3");
					myobj.remove();
				}
				
			  }
			var uncheck=document.getElementsByTagName('input');
			 for(var i=0;i<uncheck.length;i++)
			 {
			  if(uncheck[i].type=='checkbox')
			  {
			   uncheck[i].checked=false;
			  }
			 }
		    
		    var x = document.getElementsByClassName("seat selected");
		    var i=1, seatid=[];

			 while(i<x.length)
			{
                  
			      seatid[i]=x[i].id;
				  
				  i++;
			 }
		    if(x.length==2){
				changeClassName(seatid[1]);
			}else if(x.length==3){
				changeClassName(seatid[1]);
				changeClassName(seatid[2]);
			}else if(x.length==4){
				changeClassName(seatid[1]);
				changeClassName(seatid[2]);
				changeClassName(seatid[3]);
			}else if(x.length>4){
				changeClassName(seatid[1]);
				changeClassName(seatid[2]);
				changeClassName(seatid[3]);
				changeClassName(seatid[4]);
			}
            
			
	}
	    function ticket(destination){
			var destinationPHP,ticketPHP;
			var numberTicet = '<?php echo $tempTicket ?>';
			
			<?php 
	         for($i=0;$i<$tempTicket;$i++){
	        ?>
				destinationPHP = '<?php echo $phpScheduleID[$i] ?>';
			    numberTicet = '<?php echo $ticket[$i] ?>';
			    if(destination==destinationPHP){
					if(numberTicet=='1a'){
						document.getElementById('seatid0').className='seat occupied';
						document.getElementById('0').disabled = true;
					}else if(numberTicet=='1b'){
						document.getElementById('seatid1').className='seat occupied';
						document.getElementById('1').disabled = true;
					}else if(numberTicet=='1c'){
						document.getElementById('seatid2').className='seat occupied';
						document.getElementById('2').disabled = true;
					}else if(numberTicet=='1d'){
						document.getElementById('seatid3').className='seat occupied';
						document.getElementById('3').disabled = true;
					}else if(numberTicet=='2a'){
						document.getElementById('seatid4').className='seat occupied';
						document.getElementById('4').disabled = true;
					}else if(numberTicet=='2b'){
						document.getElementById('seatid5').className='seat occupied';
						document.getElementById('5').disabled = true;
					}else if(numberTicet=='2c'){
						document.getElementById('seatid6').className='seat occupied';
						document.getElementById('6').disabled = true;
					}else if(numberTicet=='2d'){
						document.getElementById('seatid7').className='seat occupied';
						document.getElementById('7').disabled = true;
					}else if(numberTicet=='3a'){
						document.getElementById('seatid8').className='seat occupied';
						document.getElementById('8').disabled = true;
					}else if(numberTicet=='3b'){
						document.getElementById('seatid9').className='seat occupied';
						document.getElementById('9').disabled = true;
					}else if(numberTicet=='3c'){
						document.getElementById('seatid10').className='seat occupied';
						document.getElementById('10').disabled = true;
					}else if(numberTicet=='3d'){
						document.getElementById('seatid11').className='seat occupied';
						document.getElementById('11').disabled = true;
					}else if(numberTicet=='4a'){
						document.getElementById('seatid12').className='seat occupied';
						document.getElementById('12').disabled = true;
					}else if(numberTicet=='4b'){
						document.getElementById('seatid13').className='seat occupied';
						document.getElementById('13').disabled = true;
					}else if(numberTicet=='4c'){
						document.getElementById('seatid14').className='seat occupied';
						document.getElementById('14').disabled = true;
					}else if(numberTicet=='4d'){
						document.getElementById('seatid15').className='seat occupied';
						document.getElementById('15').disabled = true;
					}else if(numberTicet=='5a'){
						document.getElementById('seatid16').className='seat occupied';
						document.getElementById('16').disabled = true;
					}else if(numberTicet=='5b'){
						document.getElementById('seatid17').className='seat occupied';
						document.getElementById('17').disabled = true;
					}else if(numberTicet=='5c'){
						document.getElementById('seatid18').className='seat occupied';
						document.getElementById('18').disabled = true;
					}else if(numberTicet=='5d'){
						document.getElementById('seatid19').className='seat occupied';
						document.getElementById('19').disabled = true;
					}else if(numberTicet=='6a'){
						document.getElementById('seatid20').className='seat occupied';
						document.getElementById('20').disabled = true;
					}else if(numberTicet=='6b'){
						document.getElementById('seatid21').className='seat occupied';
						document.getElementById('21').disabled = true;
					}else if(numberTicet=='6c'){
						document.getElementById('seatid22').className='seat occupied';
						document.getElementById('22').disabled = true;
					}else if(numberTicet=='6d'){
						document.getElementById('seatid23').className='seat occupied';
						document.getElementById('23').disabled = true;
					}
					
					
				}
			<?php
			}
			?>
		}
	    function changeClassName(id){
			document.getElementById(id).className='seat';
		}
		function showTab(n) {
		  // This function will display the specified tab of the form...
		  var x = document.getElementsByClassName("tab");
		  x[n].style.display = "block";
		  //... and fix the Previous/Next buttons:
		  if (n == 0) {
			document.getElementById("prevBtn").style.display = "none";
		  } else {
			document.getElementById("prevBtn").style.display = "inline";
		  }
		  if (n == (x.length - 1)) {
			document.getElementById("nextBtn").innerHTML = "Book Now";
		  } else {
			document.getElementById("nextBtn").innerHTML = "Next";
		  }
		  //... and run a function that will display the correct step indicator:
		  fixStepIndicator(n)
		}

		function nextPrev(n) {
	
		  if(currentTab==1 && n==-1){
			    myfunction();

				var table = document.getElementById('confirmPayment');
    			var count = $('#confirmPayment tr').length;
    
    			if(count>1){
    				for (var i = 1; i < count; i++) {
    				table.deleteRow(1);
    		
    				}
    			}
			}
		
		  // This function will figure out which tab to display
		  var x = document.getElementsByClassName("tab");
		  // Exit the function if any field in the current tab is invalid:
		  if (n == 1 && !validateForm()) return false;
		  // Hide the current tab:
		  x[currentTab].style.display = "none";
		  // Increase or decrease the current tab by 1:
		  currentTab = currentTab + n;
		  // if you have reached the end of the form...
		  if (currentTab >= x.length) {
			// ... the form gets submitted:
			document.getElementById("regForm").submit();
			return false;
		  }
		  // Otherwise, display the correct tab:
		  showTab(currentTab);
		}

		function validateForm() {
		  // This function deals with validation of the form fields
		  var x, y, i, valid = true,validRadio = false,number=0;
		  x = document.getElementsByClassName("tab");
		  y = x[currentTab].getElementsByTagName("input");
		  var customerdetail = document.getElementById('customerdetail');
		  // A loop that checks every input field in the current tab:
		  for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
			  // add an "invalid" class to the field:
			  y[i].className += " invalid";
			  // and set the current valid status to false
			  valid = false;
			}
			if (y[i].type == "checkbox") {
			  if(y[i].checked==true){
				  number=number+1;
			  }
			}
			 if (y[i].type == "radio") {
			  if(y[i].checked==true){
				  validRadio = true;
			  }
			}
		  }
			if(currentTab==0&& number==0){
				 valid = false;
				 document.getElementById("errormessage").innerHTML='Please check at least one seat!';
			}
			if(currentTab==0&& number!=0){
				  valid = true;
				  document.getElementById("errormessage").innerHTML='';
				  var name =[],temp=0;
				   var uncheck=document.getElementsByTagName('input');
				   for(var i=0;i<uncheck.length;i++)
				   {
				     if(uncheck[i].type=='checkbox' && uncheck[i].checked==true)
				       {
				           name[temp]=uncheck[i].name;
						   temp=temp+1;
						   
				       }
				    }
				   for(var x=0;x<temp;x++){
					      item = document.createElement("h3");
						  item.className = "row";
					      item.id='row'+x;
						  customerdetail.appendChild(item);
                          
					      part = document.createElement("h3");
					      part.id = 'h'+x;
						  part.innerHTML = "Seat No : "+name[x];
						  item.appendChild(part);
						  //  IMAGE
					      part = document.createElement("input");
						  part.type = "hidden" ;
						  part.value = name[x];
					      part.name = "SeatNumber[]";
					      part.id = "Seat"+x;
						  item.appendChild(part);
					      
						  part = document.createElement("input");
						  part.type = "text" ;
						  part.placeholder = "Name";
						  part.name = "Name[]";
					      part.id = "Name"+x;
						  item.appendChild(part);

						  //  email
						  part = document.createElement("input");
						  part.type = "email" ;
						  part.placeholder = "Email";
						  part.name = "Email[]";
					      part.id = "Email"+x;
						  item.appendChild(part);

						  //  phone
						  part = document.createElement("input");
						  part.type = "number" ;
						  part.placeholder = "Phone"
						  part.name = "Phone[]";
					      part.id = "Phone"+x;
						  item.appendChild(part);
				   }
				   var name2 =[],temp=0;
				   var sPrice = document.getElementById('seatPrice').value;
				   var uncheck2=document.getElementsByTagName('input');
				   var tmpForPayment=0;
				   var table = document.getElementById('confirmPayment');
				   for(var i=0;i<uncheck2.length;i++)
				   {
				     if(uncheck2[i].type=='checkbox' && uncheck2[i].checked==true)
				       {
						   
				           name2[tmpForPayment]=uncheck2[i].name;
						   tmpForPayment=tmpForPayment+1;
						   
				       }
				    }
				   var subtotal = tmpForPayment;
				   var row = table.insertRow(1);
					  var cell1 = row.insertCell(0);
					  var cell2 = row.insertCell(1);
					  var cell3 = row.insertCell(2);
					  var cell4 = row.insertCell(3);
				      cell1.innerHTML = "SUBTOTAL";
					  cell2.innerHTML ="-";
					  cell3.innerHTML ="-";
					  cell4.innerHTML =sPrice*subtotal;
				      var row = table.insertRow(1);
					  var cell1 = row.insertCell(0);
					  var cell2 = row.insertCell(1);
					  var cell3 = row.insertCell(2);
					  var cell4 = row.insertCell(3);
				      
				   for(var i=0;i<tmpForPayment;i++)
					{
					  var row = table.insertRow(1);
					  var cell1 = row.insertCell(0);
					  var cell2 = row.insertCell(1);
					  var cell3 = row.insertCell(2);
					  var cell4 = row.insertCell(3);
	
					  cell1.innerHTML = "1 ticket(s) from BusOnlineTicket.com("+name2[i]+" - RM"+sPrice+")";
					  cell2.innerHTML ="RM "+sPrice;
					  cell3.innerHTML ="1";
					  cell4.innerHTML =sPrice;
				   }
				  

			}
			
			
		  // If the valid status is true, mark the step as finished and valid:
		  if (valid) {
			document.getElementsByClassName("step")[currentTab].className += " finish";
		  }
		  return valid; // return the valid status
		}

		function fixStepIndicator(n) {
		  // This function removes the "active" class of all steps...
		  var i, x = document.getElementsByClassName("step");
		  for (i = 0; i < x.length; i++) {
			x[i].className = x[i].className.replace(" active", "");
		  }
		  //... and adds the "active" class on the current step:
		  x[n].className += " active";
		}
	
	
	   var seatRequestNumber=0;
	   var count = document.getElementById('count');
	  
       $("input[type='checkbox']").change(function(){
		
				var price2 = document.getElementById('seatPrice').value;
				if($(this).is(":checked")){
					if(seatRequestNumber<4)
			       {
			          
						$(this).parent().removeClass("seat"); 
						$(this).parent().addClass("seat selected"); 
						seatRequestNumber=seatRequestNumber+1;	
						count.innerHTML=seatRequestNumber;
						var total = seatRequestNumber*price2;
						document.getElementById('price').innerHTML=total;
						
				   }else{
				        $(this).prop('checked', false);
						alert('4 seats per one booking request');
					}
				}else{
					$(this).parent().removeClass("seat selected");  
						$(this).parent().addClass("seat"); 
						seatRequestNumber=seatRequestNumber-1;
						count.innerHTML=seatRequestNumber;
						var total = seatRequestNumber*price2;
						document.getElementById('price').innerHTML=total;
				}
			
		   
		});


</script>
<script>
	function login(){
		window.location.assign('login.php');
	}
	function logout(){
		window.location.assign('logout.php');
	}
</script>
