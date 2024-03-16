<?php 
  session_start();
  error_reporting(0);
  include("dbconnect.php");
     if(isset($_SESSION['User'])){
    echo '<script type="text/javascript">window.location.assign("schedule.php");</script>';
  }
	if (isset($_POST['registerbtn'])) {

		$email = $_POST['email'];
	    $password = $_POST['password'];
		$name = $_POST['name'];
		//$phone = $_POST['phone'];


		$query ="INSERT INTO `users`(`email`, `name`, `password`) VALUES ('$email','$name','$password')";

		if(mysqli_query($conn, $query))
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('login.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Email has been used! pls try another email!');window.location.assign('register.php');</script>'";
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registrasion</title>
	<style>
	body{
		background-color: #08ACC6;
		
	}
	#form_wrapper{
		background: white;
		border-radius: 20px;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
		width:35%;
		height:500px;
		margin-left: 500px;
		margin-right: 500px;
	}
	.input_field{
		width: 350px;
		height: 40px;
		border-radius: 15px;
		border: 0px;
		background-color: #E0E0E0;
		font-size: 16px;
	}
	.loginbtn{
		width: 350px;
		height: 40px;
		border-radius: 15px;
		background-color: #1AEB1D;
		color: #FFFFFF;
		font-weight: bold;
		border:0;
		font-size: 18px;
	}
	.loginbtn:hover {
		background-color: #00AB0F;
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
		.login{
		font-family: Arvo;
		border-radius: 15px;
		height: 30px;
		width: 70px;
		border:0px;
			
	}
	.login:hover{
		background:#FFD100;
		box-shadow: 0px 1px 10px #fff;
		color: black;
		transition:0.3s;
		border-radius: 15px;
	}
	</style>
</head>
<body style="font-family:Arvo; margin:0;">
		
	<br><br>
	<table align="center" style="font-size:45px; margin-bottom: 10px"><tr><th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="30px"></th><th>SinBus</th></tr></table>
	
	<form method="post">
	<div id="form_wrapper" align="center">
		
 		<br><br>
      <h1 align="center">Registration</h1><br>
      <div class="input_container" align="center"> 
      
		<input placeholder=" &nbsp; Email" type="email" name="email" id="email" class="input_field" required />
		  <br><br>
		   <input
          placeholder=" &nbsp; Username"
          type="text"
          name="name"
          id="name"
          class="input_field" required
        />
		<br><br>
		
        <input
          placeholder=" &nbsp; Password"
          type="password"
          name="password"
          id="password"
          class="input_field" required
        />
      
		<br><br>
      <button class="loginbtn" type="submit" name="registerbtn">Register</button>
      <br><br>
		<a href="login.php" style="text-decoration:none; font-size:14px"> Have Account Already?</a>
		  <br>
	</div>
		<br>
    </div></form>
 <br><br>
</body>
</html>