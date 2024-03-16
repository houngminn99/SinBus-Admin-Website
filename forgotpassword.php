<?php
  session_start();
  error_reporting(0);
  include("dbconnect.php");


  
if (isset($_POST['registerbtn'])) {
         $email =  $_POST['email'];
         $name =  $_POST['name'];
         
        $query = "SELECT * FROM users WHERE email = '$email'  AND `name` = '$name'";
	    $result = $conn->query($query);
             
        if ($result->num_rows >0) {
            // Store the cipher method
        	$ciphering = "AES-128-CTR";
        
        	// Use OpenSSl Encryption method
        	$iv_length = openssl_cipher_iv_length($ciphering);
        	$options = 0;
        
        	// Non-NULL Initialization Vector for encryption
        	$encryption_iv = '1234567891011121';
        
        	// Store the encryption key
        	$encryption_key = "travel123"; 
	        
	        $encryption = openssl_encrypt($email, $ciphering,$encryption_key, $options, $encryption_iv);
			$emailencryption = base64_encode($encryption);
			
            $from = "sinbus@lancedevelop.com";
            $to = $email;
             $url = "http://localhost/stiv3033assign2/resetpassword.php?email=".$emailencryption."";
            $fromName = 'SenderName'; 
            $subject = "From SinBus. Reset your password"; 
             
            $htmlContent = ' 
               <html> 
                <head> 
                    <title>Reset Password</title> 
                <style>
                .button {
                  background-color: #4CAF50;
                  border: none;
                  color: white;
                  padding: 15px 32px;
                  text-align: center;
                  text-decoration: none;
                  display: inline-block;
                  font-size: 16px;
                  margin: 4px 2px;
                  cursor: pointer;
                }
                </style>
                </head> 
                <body>
                    <center>
                      <table border="1" cellpadding="0" cellspacing="0" align="center" class="c-v84rpm" style="border: 0 none; border-collapse: separate; width: 720px;" width="720">
                        <tbody>
                          <tr class="c-1syf3pb" style="border: 0 none; border-collapse: separate; height: 114px;">
                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                              <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate;">
                                <tbody>
                                  <tr align="center" class="c-1p7a68j" style="border: 0 none; border-collapse: separate; padding: 16px 0 15px;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><img alt="" src="https://lancedevelop.com/travel/asset/images/sinbuslogo.png" class="c-1shuxio" style="border: 0 none; line-height: 100%; outline: none; text-decoration: none; height: 300px; width: 400px;" ></td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr class="c-7bgiy1" style="border: 0 none; border-collapse: separate; -webkit-box-shadow: 0 3px 5px rgba(0,0,0,0.04); -moz-box-shadow: 0 3px 5px rgba(0,0,0,0.04); box-shadow: 0 3px 5px rgba(0,0,0,0.04);">
                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                              <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate; width: 100%;" width="100%">
                                <tbody>
                                  <tr class="c-pekv9n" style="border: 0 none; border-collapse: separate; text-align: center;" align="center">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; border-width: 1px 1px 0; background: #FBFCFC; padding: 40px 54px 42px;">
                                        <tbody>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td class="c-1m9emfx c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; color: #1D2531; font-size: 25.45455px;"
                                              valign="middle">Sin Bus System - Reset Password</td>
                                          </tr>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td class="c-46vhq4 c-4w6eli" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Roman&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Regular&quot;,&quot;HelveticaNeueRegular&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 400; color: #7F8FA4; font-size: 15.45455px; padding-top: 20px;"
                                              valign="middle">Looks like you lost your password?</td>
                                          </tr>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td class="c-eitm3s c-16v5f34" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; padding-top: 12px;"
                                              valign="middle">We’re here to help. Click on the button below to change your password.</td>
                                          </tr>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td class="c-rdekwa" style="border: 0 none; border-collapse: separate; vertical-align: middle; padding-top: 38px;" valign="middle"><a href="'.$url.'" target="_blank"
                                                class="c-1eb43lc c-1sypu9p c-16v5f34" style="color: #000000; -webkit-border-radius: 4px; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; line-height: 15px; display: inline-block; letter-spacing: .7px; text-decoration: none; -moz-border-radius: 4px; -ms-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; background-color: #288BD5; background-image: url(&quot;https://mail.crisp.chat/images/linear-gradient(-1deg,#137ECE2%,#288BD598%)&quot; );color: #ffffff; padding: 12px 24px;">Recover my password</a></td>
                                          </tr>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td class="c-ryskht c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-size: 12.72727px; font-style: italic; padding-top: 52px;"
                                              valign="middle">If you didn’t ask to recover your password, please ignore this email.</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr class="c-1c9o9ex c-1c86scm" style="border: 0 none; border-collapse: separate;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      
                                            </td>
                               
                                  
                                    </tr>
                                    </tbody>
                                    </table>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                    
                                </tbody>
                              </table>
                    
                    
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </center>
                </body> 
                </html>'; 
             
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
             
            // Additional headers 
            $headers .= 'From: '.$name.'<'.$from.'>'."\r\n"; 
            $headers .= 'Cc:'.$email. "\r\n"; 
            $headers .= 'Bcc: '.$email . "\r\n"; 
             
            // Send email 
            if(mail($to, $subject, $htmlContent, $headers)){ 
                echo "<script type='text/javascript'>alert('Success and please check your email!!');window.location.assign('login.php');</script>'";
            }else{ 
                echo "<script type='text/javascript'>alert('Fail in send the email!!');window.location.assign('login.php');</script>'";
            }
           
        }else{
             echo "<script type='text/javascript'>alert('Faill, the email or name was wrong');</script>'";
        }
}
?>
<html>
<head>
<meta charset="utf-8">
<title>Forgot Password</title>
	
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
	<table align="center" style="font-size:45px"><tr><th><img src="asset/images/sinbuslogo.png" class="imgservice" width="100px" height="100px"/></th><th width="30px"></th><th>SinBus</th></tr></table>
	<br>
	<div id="form_wrapper" align="center">
		<form method="post">
 		<br><br>
      <h1 align="center">Reset Password</h1><br>
      <div class="input_container" align="center">
		  <input
          placeholder=" &nbsp; username"
          type="text"
          name="name"
          id="name"
          class="input_field" required
        />
		<br><br>
        <input
          placeholder=" &nbsp; Email"
          type="email"
          name="email"
          id="email"
          class="input_field" required
        />
		
        
      
		<br><br>
      <button class="loginbtn"  name="registerbtn" type="submit">Reset</button>	
      <br><br>
        <a href="login.php" style="text-decoration:none; font-size:14px">Login</a>
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