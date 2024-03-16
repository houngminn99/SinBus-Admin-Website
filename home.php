<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
  


?>
<html>
<head>
<meta charset="utf-8">
<title>SinBus</title>
	
<style>
body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url("bg1.jpg");
		position: relative;
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
	.bg{
		
		padding-top: 50px;
		padding-botton: 50px;
		color: white;
		
	}
	
	.transbox {
  		background-color: #000000;
		padding: 5px;
	}
	
	input[type=text], select {
  		width: 100%;
  		padding: 12px 20px;
  		margin: 8px 0;
  		border-radius: 4px;
 		box-sizing: border-box;
	}
	
	input[type=date], select {
  		width: 100%;
  		padding: 12px 10px;
  		margin: 8px 0;
  		border-radius: 4px;
 		box-sizing: border-box;
	}
	
	.searchbtn{
		color:Black;
		font-size: 16px;
		transition:0.3s;
		border-radius: 5px;
		border: 5px;
		border-color: aliceblue;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-left: 30px;
		padding-right: 30px;
	}
	
	.searchbtn:hover{
		background:#FFD100;
	}
	
	.searchbtn span {
		  cursor: pointer;
		  display: inline-block;
		  position: relative;
		  transition: 0.5s;
	}

	.searchbtn span:after {
		  content: '\00bb';
		  position: absolute;
		  opacity: 0;
		  top: 0;
		  right: -20px;
		  transition: 0.3s;
	}

	.searchbtn:hover span {
	  	padding-right: 25px;
	}

	.searchbtn:hover span:after {
	  	opacity: 1;
	  	right: 0;
	}
	.middle {
  		transition: 0.5s ease;
  		opacity: 0;
 		position: absolute;
  		top: 50%;
  		left: 100%;
  		transform: translate(-50%, -50%);
  		-ms-transform: translate(-50%, -50%);
  		text-align: center;
	}
	.container {
  		position: relative;
  		width: 50%;
		
	}
	.image{
		border-radius: 20px;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
	}
	.container:hover .image {
 	 	opacity: 0.3;
	}

	.container:hover .middle {
  		opacity: 1;
	}
	.text {
  		font-size: 16px;
	}
	.imgservice{
		border-radius: 50%;
		width: 100px;
		height: 100px;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
	}
	.service{
		font-size:15px;
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
</style>
</head>

<body style="font-family:Arvo; margin:0;">
	
		
	<div class="nav" style="background-color:#141850; text-align:center;" >
		<table style="margin-left: 20px;"><tr style="color: #FFFFFF;">
      <th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="20px"></th><th  style="font-size:35px;">SinBus</th>
		<td width="90px">
			</td>
		<td width="850px" align='center'>
			<br>
	    <a style="text-decoration: none;" href="home.php"><b>Home</b></a>
		
		&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
		
        <a style="text-decoration: none;" href="schedule.php"><b>Book Ticket</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="text-decoration: none;" href="admin_schedule.php"><b>Manage Schedule</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="text-decoration: none;" href="admin_companylist.php"><b>Manage Company</b></a>
	                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
	   <a style="text-decoration: none;" href="history.php"><b>Booking List</b></a>
		               
			    
			    
		
		
        </br></br>
		</td>
			<td width="100px"></td>
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
	<div class="bg">
	
		<br><br><br><br>
		<p style="padding-left: 50px; font-size: 35px;text-align: center;"><b>Welcome to SinBus Admin Website</b></p>
		<p style="text-align: center; font-size:20px;">Want to Book a Bus Ticket?</p>
		<br>
		<div align="center">
		<button class="searchbtn" onclick="window.location.href='schedule.php'"><span>Book Now</span></button>
		</div>		
		
	</div>
	<!--div><br><br><br>
		<p align="center" style="font-size: 24px; font-weight: bold">Why Book with Us?</p><br>
		<table align="center" width="60%">
			<tr align="center">
				<td width="100px">
					<img src="asset/images/bus1.jpg" class="imgservice">
				</td>
				<td width="100px">
					<img src="asset/images/easy booking.jpg" class="imgservice">
				</td>
				<td width="100px">
					<img src="asset/images/customer service.png" class="imgservice">
				</td>
				<td width="100px">
					<img src="asset/images/company1.jpg" class="imgservice">
				</td>
				<td width="100px">
					<img src="asset/images/FREE CANCELLATION.png" class="imgservice">
				</td>
			</tr>
			<tr>
				<td width="100px">
					<p class="service" align="center">Good Bus Services</p>
				</td>
				<td width="100px">
					<p class="service" align="center">Easy Booking</p>
				</td>
				<td width="100px">
					<p class="service" align="center">Good Customer Services</p>
				</td>
				<td width="100px">
					<p class="service" align="center">Trustworthy Bus Company</p>
				</td>
				<td width="100px">
					<p class="service" align="center">Free Cancellation</p>
				</td>
			</tr>
		</table>
		<br><br><br>
	</div>
		
	<div style="background-color:#FFD100"><br><br>
		<p align="center" style="font-size: 24px; font-weight: bold">Top Destinations</p><br>
		</div>
		<br><br>
		<table align="center" style="border=1">
			<tr>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/kl.jpg" class="image" width="250px" height="250px">
					
				<div class="middle">
    				<div class="text">Kuala Lumpur</div>
  				</div>
				</div>
				</th>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/melacca.jpg" class="image" width="250px" height="250px">
	
				<div class="middle">
    				<div class="text">Malacca</div>
  				</div>
				</div>
				</th>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/home5.jpg" class="image" width="250px" height="250px">
				
				<div class="middle">
    				<div class="text">Batu Cave</div>
  				</div>
				</div>
				</th>
			</tr>
			<tr><td height="50px"></td></tr>
			<tr>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/penang1.jpg" class="image" width="250px" height="250px">
					
				<div class="middle">
    				<div class="text">Penang</div>
  				</div>
				</div>
				</th>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/ipho.jpg" class="image" width="250px" height="250px">
	
				<div class="middle">
    				<div class="text">Ipoh</div>
  				</div>
				</div>
				</th>
				<th style="padding-left:30px; padding-right: 30px;">
				<div class="container">
					<img src="asset/images/kelantan.jpg" class="image" width="250px" height="250px">
				
				<div class="middle">
    				<div class="text">Kelantan</div>
  				</div>
				</div>
				</th>
			</tr>
		</table>
		<br><br><br><br><br-->
	

</body>
</html>
<script>
	function login(){
		window.location.assign('login.php');
	}
	function logout(){
		window.location.assign('logout.php');
	}
</script>