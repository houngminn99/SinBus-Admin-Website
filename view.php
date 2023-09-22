<?php 
  session_start();
  error_reporting(0);
  include("dbconnect.php");
    if(!isset($_SESSION['Admin'])){
         echo '<script type="text/javascript">alert("Please login first!!");window.location.assign("login.php");</script>';
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
    $ticket=array();
    if ($result->num_rows >0) {
		 while ($row = $result ->fetch_assoc()){ 
				  $ticket['Email'] = $row["Email"];
			      $ticket['Seat'] = $row["Seat"];
			      $ticket['Name'] = $row["Name"];
			      $ticket['Phone'] = $row["Phone"];
			      $ticket['scheduleDestination'] = $row["scheduleDestination"];
			      $ticket['scheduleDate'] = $row["scheduleDate"];
			      $ticket['scheduleTime'] = $row["scheduleTime"];
		   }
	}
   if($ticket['Email']==''||$id ==''){
	     echo '<script type="text/javascript">window.location.assign("receipt.php");</script>';
   }


?>

<html>
<head>
    <title>View Ticket</title>
<style type="text/css">@import url('https://fonts.googleapis.com/css?family=Oswald');
*
{
  margin: 0;
  padding: 0;
  border: 0;
  box-sizing: border-box
}

body
{
  background-color: #dadde6;
  font-family: arial;
}

.fl-left{float: left}

.fl-right{float: right}

.container
{
  width: 90%;
  margin: 100px auto
}

h1
{
  text-transform: uppercase;
  font-weight: 900;
  border-left: 10px solid #fec500;
  padding-left: 10px;
  margin-bottom: 30px
}

.row{overflow: hidden}

.card
{
  display: table-row;
  width: 60%;
  background-color: #fff;
  color: #989898;
  margin-bottom: 10px;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  border-radius: 4px;
  position: relative;
 margin-left: 15%;
}

.card + .card{margin-left: 2%}

.date
{
  display: table-cell;
  width: 25%;
  position: relative;
  text-align: center;
  border-right: 2px dashed #dadde6
}

.date:before,
.date:after
{
  content: "";
  display: block;
  width: 30px;
  height: 30px;
  background-color: #DADDE6;
  position: absolute;
  top: -15px ;
  right: -15px;
  z-index: 1;
  border-radius: 50%
}

.date:after
{
  top: auto;
  bottom: -15px
}

.date time
{
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.date time span{display: block}

.date time span:first-child
{
  color: #2b2b2b;
  font-weight: 600;
  font-size: 250%
}

.date time span:last-child
{
  text-transform: uppercase;
  font-weight: 600;
  margin-top: -10px
}

.card-cont
{
  display: table-cell;
  width: 75%;
  font-size: 85%;
  padding: 10px 10px 30px 50px
}

.card-cont h3
{
  color: #3C3C3C;
  font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3
{
  text-decoration: line-through
}

.card-cont > div
{
  display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p
{
  display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i
{
  padding: 5% 5% 0 0
}

.card-cont .even-info p
{
  padding: 30px 50px 0 0
}

.card-cont .even-date time span
{
  display: block
}

.card-cont a
{
  display: block;
  text-decoration: none;
  width: 80px;
  height: 30px;
  background-color: #D8DDE0;
  color: #fff;
  text-align: center;
  line-height: 30px;
  border-radius: 2px;
  position: absolute;
  right: 10px;
  bottom: 10px
}
.
.row:last-child .card:first-child .card-cont a
{
  background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a
{
  background-color: #F8504C
}

@media screen and (max-width: 860px)
{
  .card
  {
    display: block;
    float: none;
    width: 100%;
    margin-bottom: 10px
  }
  
  .card + .card{margin-left: 0}
  
  .card-cont .even-date,
  .card-cont .even-info
  {
    font-size: 75%
  }
}
.nav a{
		padding: 10px;
		font-size: 18px;
		color:white;
	}
	.nav a:hover{
		background:#E88687;
		box-shadow: 0px 1px 10px;
		color:white;
		transition:0.3s;
		border-radius: 10px;
	}
	@media print {
  .no-print {
    visibility: hidden;
  }
}
	.btn {
  appearance: none;
    -webkit-appearance: none;
  font-family: sans-serif;
  cursor: pointer;
  padding: 12px;
  min-width: 100px;
  border: 0px;
    -webkit-transition: background-color 100ms linear;
    -ms-transition: background-color 100ms linear;
     transition: background-color 100ms linear;
}

.btn:focus, .btn.focus {
  outline: 0;
}

.btn-round-1 {
  border-radius: 8px;
}

.btn-round-2 {
  border-radius: 20px;
}

.btn-dark {
  background: #000;
  color: #ffffff;
}

.btn-dark:hover {
  background: #212121;
  color: #ffffff;
}

.btn-light {
  background: #ededed;
  color: #000;
}

.btn-light:hover {
  background: #dbdbdb;
  color: #000;
}

.btn-primary {
  background: #3498db;
  color: #ffffff;
}

.btn-primary:hover {
  background: #2980b9;
  color: #ffffff;
}

.btn-success {
  background: #2ecc71;
  color: #ffffff;
}

.btn-success:hover {
  background: #27ae60;
  color: #ffffff;
}

.btn-warning {
  background: #f1c40f;
  color: #ffffff;
}

.btn-warning:hover {
  background: #f39c12;
  color: #ffffff;
}

.btn-danger {
  background: #e74c3c;
  color: #ffffff;
}

.btn-danger:hover {
  background: #c0392b;
  color: #ffffff;
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
	</style>
</head>
<body style="font-family:Arvo; margin:0;">
	<div class="no-print">
	<div class="nav" style="background-color:#141850; text-align:center;" >
		<table style="margin-left: 20px;"><tr style="color: #FFFFFF;">
      <th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="20px"></th><th  style="font-size:35px;">SinBus</th>
		<td width="100px">
			</td>
		<td width="800px" align='center'>
			<br>
	  <a style="text-decoration: none;" onclick="window.location.assign('home.php');"><b>Home</b></a>	&nbsp;|&nbsp;
		 <!--a style="text-decoration: none;" onclick="window.location.assign('companylist.php');" target="_blank" ><b>Company List</b></a>&nbsp;|&nbsp;-->
		 <!--a style="text-decoration: none;" onclick="window.location.assign('contactus.php');" target="_blank" ><b>Contact Us</b></a>&nbsp;|&nbsp;-->
		<?php
			if(isset($_SESSION['Admin'])){
				echo '<a style="text-decoration: none;" href="schedule.php"><b>Book Ticket</b></a>
	                  &nbsp;|&nbsp;';
	            echo '<a style="text-decoration: none;" href="admin_schedule.php"><b>Manage Schedule</b></a>
	                  &nbsp;|&nbsp;';
			    echo '<a style="text-decoration: none;" href="admin_companylist.php"><b>Manage Company</b></a>
	                  &nbsp;|&nbsp;';
			    echo  '<a style="text-decoration: none;" href="history.php"><b>Booking List</b></a>
		               ';
			    
			}
	
		?>
        </br></br>
		</td>
		<td width="220px"></td>
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
	
	</div></div>
<section class="container">
<h1></h1>
  <div class="row">
    <article class="card fl-left">
      <section class="date">
        <time datetime="23th feb">
		 <?php
		  $str =  (explode("-",$ticket['scheduleDate']));
          echo "<span>$str[2]</span><span>-$str[1]-$str[0]</span>";
			  ?>
        </time>
      </section>
      <section class="card-cont">
        <small><?php echo $ticket['Name'] ?></small>
        <h3><?php echo $ticket['scheduleDestination']." - ".$ticket['scheduleTime'] ?></h3>
        <div class="even-date">
         <i class="fa fa-calendar"></i>
         <time>
           <span>Seat NO : <?php echo $ticket['Seat']?></span>
           <span>Email : <?php echo $ticket['Email']?></span>
			<span>Phone : <?php echo $ticket['Phone']?></span>
         </time>
        </div>
        <div class="even-info">
          <i class="fa fa-map-marker"></i>
          <p>
            Please bring this ticket when depature
          </p>
        </div>
		 
        <a>SinBus.com</a>
      </section>
    
  </div>
	  <div class="row">
	 <div class="no-print" style="text-align: right; margin-right: 25%">
	        <button onclick="window.print()" class="btn btn-success btn-round-2">Print</button>   
        </div>
		  </div>
</div> <script type="text/javascript"></script> </div></body></html><script>
	function login(){
		window.location.assign('login.php');
	}
	function logout(){
		window.location.assign('logout.php');
	}
</script>