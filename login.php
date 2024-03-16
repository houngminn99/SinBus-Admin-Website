<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");

  if(isset($_SESSION['Admin'])){
    echo '<script type="text/javascript">window.location.assign("schedule.php");</script>';
  }

if (isset($_POST['loginbtn'])) {
	
	    $email=$_POST['email'];
	    $password = $_POST['password'];
	   
	     
        $query = "SELECT * FROM users WHERE email = '$email'  AND `password` = '$password'";
	    $result = $conn->query($query);

        if ($result->num_rows >0) {
		 
		      $_SESSION['Admin'] = $email;
              echo "<script type='text/javascript'>alert('Success! Admin Mode');window.location.assign('home.php');</script>'"; 
	    }
	    else {
	      echo "<script type='text/javascript'>alert('Email or Password was wrong!');window.location.assign('login.php');</script>'";
	    }
}

?>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
	
<style>
	body{
		background-color: #08ACC6;
		
	}
	#form_wrapper{
		background: white;
		border-radius: 20px;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
		width:35%;
		height: 500px;
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
	.sinbus{
		color: #FFFFFF;
		font-family: Arvo;
	}
	</style>
</head>

<body style="font-family:Arvo; margin:0;">
	
	
<br><br>
	<table align="center" style="font-size:45px"><tr><th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="30px"></th><th>SinBus</th></tr></table>
	<br>
	<div id="form_wrapper" align="center">
		<form method="post">
 		<br><br>
      <h1 align="center">Login</h1><br>
      <div class="input_container" align="center">
        <input
          placeholder=" &nbsp; sinbuswebsite@gamil.com"
          type="email"
          name="email"
          id="email"
          class="input_field" required
        />
		<br><br>
        <input
          placeholder=" &nbsp; sinbus123"
          type="password"
          name="password"
          id="password"
          class="input_field" required
        />
      
		<br><br>
      <button class="loginbtn" type="submit" name="loginbtn">Login</button>
      <br><br>
		<p style="font-size:14px">Forgot <a href=forgotpassword.php style="text-decoration:none; font-size:14px"> Password ?</a></p>
      <br>
        <a href="register.php" style="text-decoration:none; font-size:14px">Dont Have Account? </a>
	</div>
		</form>
    </div>
 <br><br><br>
	
</body>
</html>
