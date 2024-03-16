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

   if (isset($_POST['update'])) {

		$Name = $_POST['Name'];
	    $Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$ID = $_POST['ID'];


		 $query ="UPDATE `ticket` SET `Phone`='$Phone', `Name`='$Name',`Email`='$Email' where id='$ID'";

		if(mysqli_query($conn, $query))
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('history.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail!');window.location.assign('history.php');</script>'";
		}
	}
  
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>My Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--	<link rel="stylesheet" href="css/style.css">-->
	<style>
	        .nav a{
			 padding: 10px;
			 font-size: 18px;
			 color:white;
	       }
			.nav a:hover{
				background:#FFD100;
		        box-shadow: 0px 1px 10px #fff;
		        color: black;
		        transition:0.3s;
		        border-radius: 10px;
			}
		.bookingtable{
			  box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
			  
		}
			 
		.timetable{
		margin-left: 10%;
		margin-right: 10%;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
		border-radius: 10px;
		}
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
		.dataTables_filter{
			padding: 10px;
			font-size: 17px;
			float: left;
			width: 80%;
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
			
			  }
		  .ResetBtn{
			
			background:#FF0000;
			color:Black;
			font-size: 16px;
			padding-top: 12px;
			padding-bottom: 12px;
			padding-left: 30px;
			padding-right: 30px;
			transition:0.3s;
			
			
			  }
		  .filter{
			  border-style: solid;
			  background:#d3d3d3;
			  padding: 10px;
			  text-align: center;
		  }
		  /* Style the tab */
			.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			border-radius: 10px;
			box-shadow:  0px 1px 10px #fff;
			width:50%;
			margin-left:400px;
			}
		  

		/* Style the buttons inside the tab */
		.tab button {
			background-color: white;
			float: left;
			border:0;
			padding: 14px 16px;
		 	transition: 0.3s;
		 	font-size: 17px;
			width: 50%;
			border-radius: 10px;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
		  background-color: #ddd;

		}

		/* Create an active/current tablink class */
		.tab button.active {
		  background-color: #ccc;

		}

		/* Style the tab content */
		.tabcontent {
		  display: none;
		  
		  border-top: none;


		}
		input[type=text], input[type=password], input[type=number], input[type=email]{
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  box-sizing: border-box;
		}

		.cancelbtn {
		  width: auto;
		  padding: 10px 18px;
		  background-color: #f44336;
		}
		.container {
		  padding: 16px;
		  font-size:16px;
		}

		span.psw {
		  float: right;
		  padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
		  span.psw {
			 display: block;
			 float: none;
		  }
		  .cancelbtn {
			 width: 100%;
		  }
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
		  padding: 20px;
		  border: 1px solid #888;
		  top: 50%;
          left: 50%;
          width: 60%;
          padding: 30px;
		  position: absolute;
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
		}

		.update:hover {
		  opacity: 0.8;
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
		.viewbtn{
		padding-top:10px;
		padding-bottom: 10px;
		padding-left: 25px;
		padding-right: 25px;
		background-color: #FFD100;
		color:black;
		border-radius: 10px;
		text-decoration: none;
		font-size: 14px;
		font-family: Arial;
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
		 .tr{
			 padding-bottom: 50px;
			 padding-top: 50px;
		 }
		 body{
			 margin: 0;
		 }
		.sinbus{
		color: #FFFFFF;
		font-family: Arvo;
		}
	  </style>

	</head>
	<body style="font-family:Arvo; margin:0;">
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
	           echo  '<a style="text-decoration: none;" href="history.php" ><b>Booking List</b></a>
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
			<br><br>
		<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'MyBooking')">Customer Booking</button>
			  <button class="tablinks" onclick="openCity(event, 'Deleted')">Cancelled</button>
		</div>
		<br><br><br>

		<div id="MyBooking" class="tabcontent" align="center">
								
			<section class="timetable">			 
<br><br>
						<h1 class="heading-section">Customer Booking's Ticket</h1>
						<br>
									<table border="0" width="95%" align="center">
									  <thead>
									      <tr><td colspan='11'><hr></td></tr>
										<tr class="tr" height="80px">
											<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone Num</th>
											<th>Company Name</th>
											<th>Departure<br>Date & Time</th>
											<th>Destination</th>
											<th>Seat Num</th>
											<th>Price (RM)</th>
											<th>Booking Date</th>
											<th>Action</th>
										</tr>
									  </thead>
									  <tbody>
										<tr class="alert" role="alert" align="center">
											<?php
											 $num=0; 
											  $query="SELECT * FROM `ticket` INNER JOIN  `schedule` on ticket.scheduleID = schedule.scheduleID
											          INNER JOIN `company` on schedule.companyID = company.companyID
											          && ticket.emailuser='$emailuser'";
											$result = $conn->query($query);
											if($result->num_rows > 0){
											     $Time = array();
											     $Destination = array();
												 $Seat = array();
												 $price = array();
												 $date = array();
												 $id = array(); 
												 $Name = array(); 
												 $Phone = array(); 
												 $Email = array();
												 $company = array();
												 $sdate = array();
												
												
											  while ($row = $result ->fetch_assoc()){
											      $NameH[$num] = $row['Name'];
												  $PhoneH[$num] = $row['Phone'];
												  $EmailH[$num] = $row['Email'];
												  $companyH[$num]= $row['companyName'];
											      $TimeH[$num] = $row['scheduleTime'];
												  $DestinationH[$num] = $row['scheduleDestination'];
												  $SeatH[$num] = $row['Seat'];
												  $priceH[$num] = $row['price'];
												  $dateH[$num] = $row['date'];
												  $idH[$num] = $row['id'];
												  $sdateH[$num] = $row['scheduleDate'];
												  
												  $num =$num+1;
											  }
											  for($x=0;$x<$num;$x++)
											  {
												   $encryption = openssl_encrypt($idH[$x], $ciphering,
														$encryption_key, $options, $encryption_iv);
													$encrptID = base64_encode($encryption);
													$temptablenumber=$x+1;
													echo"
													<tr><td colspan='11'><hr></td></tr>
													<tr>
													<td align='center'>$temptablenumber</td>
                                                    <td align='center'>$NameH[$x]</td>
                                                    <td align='center'>$EmailH[$x]</td>
                                                    <td align='center'>$PhoneH[$x]</td>
                                                    <td align='center'>$companyH[$x]</td>
													<td align='center'>$sdateH[$x] $TimeH[$x]</td>
													<td align='center'>$DestinationH[$x]</td>
													<td align='center'>$SeatH[$x]</td>
													<td align='center'>$priceH[$x]</td>
													<td align='center'>$dateH[$x]</td>
													<td align='center'>
													<br>
													<a class='viewbtn' href='view.php?id=$encrptID'>View</a>
													<br><br>
													<button class='upbtn'onclick='modal($x)'>Update</button>
													<br><br>
													<a class='delbtn' href='deleteTicket.php?id=$encrptID'>Delete</a>
													<br><br>
													</td>
													
													</tr>
													";
											  }
												
											}
											// Use openssl_encrypt() function to encrypt the data
											
											 
											
											?>

										</tbody>
									  
									</table>
									
						
					
				</section>
				<br><br>
		</div>

		<div id="Deleted" class="tabcontent">
			  <section class="timetable">
						 <br><br>
						<h2 class="heading-section" align="center">Cancelled Ticket</h2>
						<br>

									<table border="0" width="95%" align="center">
									  <thead>
									    <tr><td colspan='10'><hr></td></tr>
										<tr class="tr" height="80px">
											<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone Num</th>
											<th>Company Name</th>
											<th>Departure<br>Date & Time</th>
											<th>Destination</th>
											<th width="50px">Seat Num</th>
											<th width="80px">Price (RM)</th>
											<th width="90px">Booking Date</th>
											
										</tr>
									  </thead>
									  <tbody>
										<tr class="alert" role="alert">
											<?php
											 $num2=0; 
											 $query="SELECT * FROM `ticket_delete` INNER JOIN  `schedule` on ticket_delete.scheduleID = schedule.scheduleID 
											 INNER JOIN `company` on schedule.companyID = company.companyID
											 && ticket_delete.emailuser='$emailuser'
											 ORDER BY ticket_delete.date DESC";
											$result = $conn->query($query);
											if($result->num_rows > 0){
												
											  while ($row = $result ->fetch_assoc()){
											      $num2++;
											      extract($row);
											        echo"
											        <tr><td colspan='10'><hr></td></tr>
											        <tr height='80px'>
													<td align='center'>$num2</td>
													<td align='center'>$Name</td>
                                                    <td align='center'>$Email</td>
                                                    <td align='center'>$Phone</td>
                                                    <td align='center'>$companyName</td>
													<td align='center'>$scheduleDate <br> $scheduleTime</td>
													<td align='center'>$scheduleDestination</td>
													<td align='center'>$Seat</td>
													<td align='center'>$price</td>
													<td align='center'>$date</td>
													
													</tr>";
											  }
										
												
											}
											// Use openssl_encrypt() function to encrypt the data
											
											 
											
											?>


									  </tbody>
									</table>
				  					<br><br>

						
					
				</section>
				<br><br>
		</div>




		<div id="myModal" class="modal"><div class="modal-content"><span class="close" id="close">&times;</span>
	      <form  method="post">
			  <div class="imgcontainer" align="center">
				<h2>Update Form</h2>
			  </div>

			  <div class="container">
			      <table align="center" border="0"><tr>
			     <td>
				<label for="ComapanyName" style="font-size:24px;"><b>Company Name </b></label>
				<input type="text" id="CompanyName" name="CompanyName"  style="font-size:16px;" disabled></td></tr>
			    <tr><td>
				 <label for="Time"  style="font-size:24px;"><b>Departure Time </b></label>
				<input type="text"name="Time" id="Time"  style="font-size:16px;" disabled></td>
				
                <td>
				<label for="Destination" style="font-size:24px;"><b>Destination</b></label>
				<input type="text" id="Destination" name="Destination"  style="font-size:16px;" disabled></td></tr>
				  <tr>
				<td>  
				<label for="Seat" style="font-size:24px;"><b>Seat Num </b></label>
				<input type="text" id="Seat" name="Seat"  style="font-size:16px;" disabled></td>
                <td>
				<label for="Price"  style="font-size:24px;"><b>Price (RM)</b></label>
				<input type="text" id="Price" name="Price"  style="font-size:16px;" disabled></td></tr>
				<tr><td>
				<label for="Name"  style="font-size:24px;;"><b>Name </b></label>
				<input type="text" id="Name" name="Name"  style="font-size:16px;" required></td></tr>
                <tr><td>
				<label for="Phone"  style="font-size:24px;"><b>Phone</b></label>
				<input type="number" id="Phone" name="Phone"  style="font-size:16px;" required></td>
				<td>  
				<label for="Email"  style="font-size:24px;"><b>Email</b></label>
				<input type="email" id="Email" name="Email"  style="font-size:16px;" required></td></tr>
				<tr ><td colspan="3">
                <input type="hidden" id="ID" name="ID"  style="font-size:24px;" required>
				<button name="update" type="submit" class="update"  style="font-size:16px;">Update</button></td></tr>
                </table>
			  </div>

			</form> </div>
           </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    
	</body>
</html>
<script>

	function logout(){
		window.location.assign('logout.php');
	}
$(document).ready(function() {
    
    var table = $('#example').DataTable( {
        select: true
    } );
 
    table
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
          
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
         
        } );
	var table2 = $('#example2').DataTable( {
        select: true
    } );
 
    table2
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
          
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
         
        } );

} );
	function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
function modal(id){
   
		// Get the modal
		var modal = document.getElementById("myModal");
        var number = '<?php echo $num ?>'; 
	    var time =[],seat=[],price=[],name=[],phone=[],email=[],Destination=[],IDphp=[],CompanyName=[];
	    <?php
	        for($i=0;$i<$num;$i++){
	    ?>
	    
			time[<?php echo $i ?>]='<?php echo $TimeH[$i] ?>';
	        seat[<?php echo $i ?>]='<?php echo $SeatH[$i] ?>';
	        price[<?php echo $i ?>]='<?php echo $priceH[$i] ?>';
	        name[<?php echo $i ?>]='<?php echo $NameH[$i] ?>';
	        phone[<?php echo $i ?>]='<?php echo $PhoneH[$i] ?>';
	        email[<?php echo $i ?>]='<?php echo $EmailH[$i] ?>';
	        CompanyName[<?php echo $i ?>]='<?php echo $companyH[$i] ?>';
	        Destination[<?php echo $i ?>]='<?php echo $DestinationH[$i] ?>';
	        IDphp[<?php echo $i ?>]='<?php echo $idH[$i] ?>';
	    <?php
		}
	    ?>
	    var TimeHTML = document.getElementById("Time").value=time[id];
	    var DestinationHTML = document.getElementById("Destination").value=Destination[id];
		var SeatHTML = document.getElementById("Seat").value=seat[id];
		var PriceHTML = document.getElementById("Price").value=price[id];
		var NameHTML = document.getElementById("Name").value=name[id];
	    var PhoneHTML = document.getElementById("Phone").value=phone[id];
	    var EmailHTML = document.getElementById("Email").value=email[id];
	    var CompanyNameHTML = document.getElementById("CompanyName").value=CompanyName[id];
	    var IDHTML = document.getElementById("ID").value=IDphp[id];
	    
    
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

