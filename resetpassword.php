<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");
    $temp = $_GET['email'];
    $email = base64_decode($temp);

	// Non-NULL Initialization Vector for decryption
	$decryption_iv = '1234567891011121';

	// Store the decryption key
	$decryption_key = "travel123";
    $ciphering = "AES-128-CTR";

	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	// Use openssl_decrypt() function to decrypt the data
    $decryption= openssl_decrypt ($email, $ciphering,$decryption_key, $options, $decryption_iv);
   
    $query = "SELECT * FROM `users`WHERE email= '$decryption'";
	$result = $conn->query($query);
    if ($result->num_rows >0) {
		
	}else{
	     echo '<script type="text/javascript">alert("the url was wrong!");window.location.assign("login.php");</script>';
	}
	
	if (isset($_POST['resetpassword'])) {
         $password =  $_POST['password'];
        $query ="UPDATE `users` SET `password`='$password' where `email`='$decryption'";

		if(mysqli_query($conn, $query))
		{
			echo "<script type='text/javascript'>alert('Success');window.location.assign('login.php');</script>'";
		}else{
			echo "<script type='text/javascript'>alert('Fail');window.location.assign('register.php');</script>'";
		}
	}
?>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
	
<style>
	body{
		background-color: #08ACC6;
		
	}
	#form_wrapper{
		background: white;
		border-radius: 20px;
		box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.5);
		width:35%;
		height: 400px;
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
	</style>
</head>

<body style="font-family:Arvo; margin:0;">
		
<br><br>
	<table align="center" style="font-size:45px"><tr><th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="30px"></th><th>SinBus</th></tr></table>
	<br>
	<div id="form_wrapper" align="center">
		<form method="post">
 		<br><br>
      <h1 align="center">Reset Password</h1><br>
      <div class="input_container" align="center">
        <input
          placeholder=" &nbsp; Email"
          type="email"
          name="email"
          id="email"
          class="input_field" value="<?php echo $decryption ?>" disabled
        />
		  <br><br>
		  <input
          placeholder=" &nbsp; New Password"
          type="password"
          name="password"
          id="password"
          class="input_field" required
        />
		
        
      
		<br><br>
      <button class="loginbtn" type="submit" name="resetpassword">Confirm</button>	
      <br><br>
        <a href="register.php" style="text-decoration:none; font-size:14px">Login</a>
	</div>
		</form>
    </div>
 <br><br><br>
	
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