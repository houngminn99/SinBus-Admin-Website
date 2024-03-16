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
    
if(isset($_POST['Add'])){
   $Logo = $_FILES["logo"]["name"];
   $CompanyName = $_POST['CompanyName'];
   $CompanyDetails = $_POST['CompanyDetails'];
   $audio = $_FILES["audio"]["name"];
   $video = $_FILES["videoName"]["name"];
   $ID = $_POST['ID'];
   $companyURL = $_POST['CompanyURL'];
   $imgContent = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
   
   //video
   $cname=str_replace(" ","_",$video);
   $target_path="asset/video/";
   $target_path=$target_path.basename($cname);
   
   //audio
   $Aname=str_replace(" ","_",$audio);
   $target_path_audio="asset/audio/";
   $target_path_audio=$target_path_audio.basename($Aname);
   
   if(file_exists($target_path_audio)){
       echo '<script type="text/javascript">alert("Audio File Exist");window.location.assign("admin_companylist.php");</script>';
   }
   
  if(file_exists($target_path)){
       echo '<script type="text/javascript">alert("Video File Exist");window.location.assign("admin_companylist.php");</script>';
   }
   
   
    if(move_uploaded_file($_FILES['videoName']['tmp_name'],$target_path) && move_uploaded_file($_FILES['audio']['tmp_name'],$target_path_audio))
       {
           $query = "INSERT INTO `company`(`companyName`, `companyPicture`, `companyDetail`, `video`, `audio`,`URL`) VALUES('$CompanyName','$imgContent','$CompanyDetails','$cname','$Aname','$companyURL')";
           if(mysqli_query($conn, $query))
        		{
        			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_companylist.php');</script>'";
        		}else{
        			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_companylist.php');</script>'";
        		}
               }else{
                   	echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_companylist.php');</script>'";
               }
}

 if(isset($_POST['update'])){
   $Logo = $_FILES["logo"]["name"];
   $CompanyName = $_POST['CompanyName2'];
   $CompanyDetails = $_POST['CompanyDetails2'];
   $audio = $_FILES["audio"]["name"];
   $video = $_FILES["videoName"]["name"];
   $ID = $_POST['ID2'];
   $imgContent = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
   $companyURL = $_POST['CompanyURL'];
   
   //video
   $cname=str_replace(" ","_",$video);
   $target_path="asset/video/";
   $target_path=$target_path.basename($cname);
   
   //audio
   $Aname=str_replace(" ","_",$audio);
   $target_path_audio="asset/audio/";
   $target_path_audio=$target_path_audio.basename($Aname);
  
   if(file_exists($target_path_audio) && $audio!=''){
       echo '<script type="text/javascript">alert("Audio File Exist");window.location.assign("admin_companylist.php");</script>';
   }
   
  if(file_exists($target_path) && $video!=''){
       echo '<script type="text/javascript">alert("Video File Exist");window.location.assign("admin_companylist.php");</script>';
   }
   if($_FILES['videoName']['error']>0  && $video!=''){
        errorVideoMessage();
   }
   if($_FILES['audio']['error']>0  && $audio!=''){
        errorAudio();
   }
   if(!empty($Logo) && !empty($audio)  && !empty($video) ){
       if(move_uploaded_file($_FILES['videoName']['tmp_name'],$target_path) && move_uploaded_file($_FILES['audio']['tmp_name'],$target_path_audio))
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyPicture`='$imgContent',`companyDetail`='$CompanyDetails',`video`='$cname',`audio`='$Aname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(!empty($Logo) && !empty($audio)  && empty($video)){
        if(move_uploaded_file($_FILES['audio']['tmp_name'],$target_path_audio))
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyPicture`='$imgContent',`companyDetail`='$CompanyDetails',audio`='$Aname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(!empty($Logo) && empty($audio)  && !empty($video)){
        if(move_uploaded_file($_FILES['videoName']['tmp_name'],$target_path) && move_uploaded_file($_FILES['audio']['tmp_name'],$target_path_audio))
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyPicture`='$imgContent',`companyDetail`='$CompanyDetails',`video`='$cname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(empty($Logo) && !empty($audio)  && !empty($video)){
        if(move_uploaded_file($_FILES['videoName']['tmp_name'],$target_path) && move_uploaded_file($_FILES['audio']['tmp_name'],$target_path_audio))
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyDetail`='$CompanyDetails',`video`='$cname',`audio`='$Aname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(!empty($Logo) && empty($audio)  && empty($video)){
        $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyPicture`='$imgContent',`companyDetail`='$CompanyDetails' ,`URL`='$companyURL'WHERE `companyID`='$ID'";
   }else if(empty($Logo) && !empty($audio)  && empty($video)){
       if( move_uploaded_file($_FILES['audio']['tmp_name'] , $target_path_audio))
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyDetail`='$CompanyDetails',`audio`='$Aname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(empty($Logo) && empty($audio)  && !empty($video)){
       if(move_uploaded_file($_FILES['videoName']['tmp_name'],$target_path) )
       {
          $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyDetail`='$CompanyDetails',`video`='$cname',`URL`='$companyURL' WHERE `companyID`='$ID'";
       }
   }else if(empty($Logo) && empty($audio)  && empty($video)){
        $query = "UPDATE `company` SET `companyName`='$CompanyName',`companyDetail`='$CompanyDetails',`URL`='$companyURL' WHERE `companyID`='$ID'";
   }
   
    if(mysqli_query($conn, $query))
        		{
        			echo "<script type='text/javascript'>alert('Success');window.location.assign('admin_companylist.php');</script>'";
        		}else{
        			echo "<script type='text/javascript'>alert('Fail');window.location.assign('admin_companylist.php');</script>'";
        		}
   

}

function errorAudio(){
    switch ($_FILES['audio']['error']) {
        case 0:
            break;
       case 1:
          echo '<script type="text/javascript">alert("The uploaded Audio file exceeds the upload_max_filesize directive in php.ini");window.location.assign("admin_companylist.php");</script>';
          break;
       case 2:
           echo '<script type="text/javascript">alert("The uploaded Audio file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form");window.location.assign("admin_companylist.php");</script>';
          break;
       case 3:
           echo '<script type="text/javascript">alert("The uploaded Audio file was only partially uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 4:
           echo '<script type="text/javascript">alert("No Audio file was uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 5:
           echo '<script type="text/javascript">alert("Missing a temporary folder");window.location.assign("admin_companylist.php");</script>';
          break;
       case 6:
           echo '<script type="text/javascript">alert("No Audio file was uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 7:
           echo '<script type="text/javascript">alert("Failed to write file to disk.");window.location.assign("admin_companylist.php");</script>';
          break;
       case 8:
           echo '<script type="text/javascript">alert("A PHP extension stopped the file upload.");window.location.assign("admin_companylist.php");</script>';
          break;
       default:
          $html_body .= 'unknown errror';
       }
}
function errorVideoMessage(){
    switch ($_FILES['videoName']['error']) {
        case 0:
            break;
       case 1:
          echo '<script type="text/javascript">alert("The uploaded Video file exceeds the upload_max_filesize directive in php.ini");window.location.assign("admin_companylist.php");</script>';
          break;
       case 2:
           echo '<script type="text/javascript">alert("The uploaded Video file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form");window.location.assign("admin_companylist.php");</script>';
          break;
       case 3:
           echo '<script type="text/javascript">alert("The uploaded Video file was only partially uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 4:
           echo '<script type="text/javascript">alert("No Video file was uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 5:
           echo '<script type="text/javascript">alert("Missing a temporary folder");window.location.assign("admin_companylist.php");</script>';
          break;
       case 6:
           echo '<script type="text/javascript">alert("No Video file was uploaded");window.location.assign("admin_companylist.php");</script>';
          break;
       case 7:
           echo '<script type="text/javascript">alert("Failed to write file to disk.");window.location.assign("admin_companylist.php");</script>';
          break;
       case 8:
           echo '<script type="text/javascript">alert("A PHP extension stopped the file upload.");window.location.assign("admin_companylist.php");</script>';
          break;
       default:
          $html_body .= 'unknown errror';
       }
}
?>
<html>
<head>
<meta charset="utf-8">
<title>Company List</title>
	<style>
	input[type="search"] {
	    height: 30px;
	    border-radius: 10px;
	    font-size:16px;
	    margin-bottom:20px;
	}
	.file{
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  font-size: 15pt;
	}
	#CompanyName{
	    height:30px;
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
		width: 100px;
	    height: 50px;
	}
	.video{
	    box-shadow: 0px 1px 10px #000000;
	}
	.audio{
	    border-radius: 0px;
	    box-shadow: 0px 1px 10px #000000;
	    height:50px;
	    width:250;
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
		  height:650px;
		}
		.close {
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
		.filer{
		   height:50px;
		   font-size:16px;
		   padding-top:10px;
		}
		.dataTables_filter {
           text-indent: 1px;
        }
        .dataTables_length {
               float: left !important;
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
		    margin-left:150px;
		    margin-right:150px;
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
		#audio{
		    width:300px;
		}
		.linkbtn{
		    padding-top:5px;
    			padding-bottom: 5px;
    			padding-left: 10px;
    			padding-right: 10px;
			background-color: #ADD8E6;
		    color : black;
			border-radius: 5px;
			text-decoration: none;
			font-size: 14px;
			border:0px;
			font-family: Arial;
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
	  	
		<br>
		<br>
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
	
	</div>
	<br><br><br>
	<h2 style="text-align:center; color:white"><b>Company List</b></h2>
	<br><br><br>
	
	<div align="center" style="margin-left:10%; margin-right:10%">
	    <button class="add" onclick='addModal()' style='float:right'>+&nbsp;&nbsp;&nbsp;&nbsp;Add</button>
	    
		<table style="test-align:center; background-color: #ffffff" id="company" border="0">
		    
			<thead>
			<tr>
			<th  height="80px">#</th>
			<th  height="80px">Logo</th>
			<th  height="80px">Company Name</th>
			<th  height="80px">Company Details</th>
			<th  height="80px">Video</th>
			<th  height="80px">Audio</th>
			<th  height="80px">Action</th>
			</tr>
			 </thead>
		<?php
		    $query = "SELECT * FROM `company`";
			$result = $conn->query($query);
			$number=0;
			if ($result->num_rows >0) {
			    $Logo = array();
			    $IDPHP = array();
			    $CompanyName = array();
			    $CompanyURL = array();
			    $CompanyDetails = array();
			    $Video = array();
			    $Audio = array();
			    
				 while ($row = $result ->fetch_assoc()){ 
					  extract($row);
					    $number=$number+1;
					    $Logo[$number] = base64_encode($companyPicture);
					    $CompanyName[$number] = $companyName;
					    $CompanyURL[$number] = $URL;
					    $CompanyDetails[$number] = $companyDetail;
					    $Video[$number] = $video;
					    $Audio[$number] = $audio;
					    $IDPHP[$number] = $companyID;
					    $encryption = openssl_encrypt($companyID, $ciphering,$encryption_key,$options, $encryption_iv);
						$encrptID = base64_encode($encryption);
						echo"
						
						<tr height='200px'>
						<td height='200px' width='30px' style='text-align: center;'>$number</td>
						<td>
						<img class='img' style='text-align: center;' src='data:image/jpeg;base64,".base64_encode($companyPicture)."'/></td>
						    <td height='200px' width='200px' style='text-align: center;'>$companyName</td>
							<td height='200px' width='350px'>$companyDetail <br><p align='center'><a class='linkbtn' align='center' href='$URL' target='_blank'>Read more</a></p><br></td>
							<td height='200px'width='260px' style='text-align: center;'><video width='250' height='150' controls>
                                          <source src='asset/video/$video' type='video/mp4'>
                                        Your browser does not support the video tag.
                                        </video></td>
							<td height='200px' width='260px' style='text-align: center;'><audio width='500' controls class='audio'>
                                          <source src='asset/audio/$audio' type='audio/mpeg'>
                                        Your browser does not support the audio element.
                                        </audio></td>
							 <td style='text-align: center;width:130px;'><button class='upbtn'onclick='modal($number)'><b>Update</b></button>
								<br><br>
							    <a class='delbtn' href='deleteCompany.php?id=$encrptID'><b>Delete</b></a>
							    <br>
							  
							    
							   
							</td></tr>"
							
							;}
					  
							
				   
			}
		
		?>
		</table>
		
	</div>
	
	<div id="myModal" class="modal">
	    <div class="modal-content"><span class="close" id="close">&times;</span>
	      <form  method="post" enctype="multipart/form-data">
			  <div class="imgcontainer" align="center">
				<h1>Update Form</h1>
			  </div>

			  <div class="container">
			      <table align="center" border="0" width="100%">
			          <tr><td rowspan="12" width="20px"></td>
			      <tr height="50px"><td>
			      	<p for="logo" style="font-size:20px;"><b>Company Image:</b></p></td>
				 <td ><input class="file" type='file' name='logo' accept="image/*"/>
				 </td><td rowspan="12" width="20px"></td></tr>
				 <tr height="50px">
                <td>
				<p for="CompanyName" style="font-size:20px;"><b>Company Name:</b></p></td>
				<td><input type="text" id="CompanyName" name="CompanyName2"  style="font-size:16px; border:solid 1px;" required><br><br></td></tr>
				 <tr height="50px"><td colspan="1">
				<p for="CompanyDetails" style="font-size:20px;"><b>Company Details:</b></p></td>
				<td colspan="1"><textarea id="CompanyDetails" name="CompanyDetails2"  style="font-size:16px; width:500px; height:150px; border:solid 1px;" required></textarea>
                <br><br></td>
			    
			    <tr height="50px"><td colspan="1">
				<p for="CompanyDetails" style="font-size:20px;"><b>Company URL:</b></p></td>
				<td colspan="1"><input type="url" id="companyURLUpdate" name="CompanyURL" style="font-size:16px; border:solid 1px;"   required />
                <br><br></td>
			    
                <tr height="50px"><td colspan="1">
				<p for="video" style="font-size:20px;"><b>Video:</b></p></td>
				<td colspan="2"><input  type='file' class="file" onChange="Filesizet()" name='videoName'id='videoName' accept="video/mp4,video/x-m4v,video/*"/>
				<p id='video' style='color:red'></p>
                </td>
                
                <tr height="50px"><td colspan="1">
				<p for="audio" style="font-size:20px;"><b>Audio:</b></p></td>
				<td colspan="1"><input class="file" type='file' onChange="Filesizet2()"  name='audio' id='audio' accept="audio/*"/>
				<p id='audioMessageUpdate' style='color:red'></p>
                </td>
            
				<tr ><td colspan="2"><br>
                <input type="hidden" id="ID" name="ID2"  style="font-size:24px;" required>
				<button name="update" type="submit" class="update"  style="font-size:16px;">Update</button></td></tr>
                </table>
			  </div>

			</form> </div>
           </div>
           
           <div id="addModal" class="modal">
	    <div class="modal-content"><span class="close" id="close2">&times;</span>
	      <form  method="post" enctype="multipart/form-data">
			  <div class="imgcontainer" align="center">
				<h1>Add Company Form</h1>
			  </div>

			  <div class="container">
			      <br><br>
			      <table align="center" border="0" width="100%">
			         <tr><td rowspan="12" width="20px"></td> 
			      <tr height="50px"><td>
			      	<p for="logo" style="font-size:20px;"><b>Company Image:</b></p></td>
				 <td><input class="file" type='file' name='logo' accept="image/*" required/>
				 </td><td rowspan="12" width="20px"></td></tr>
				 
				 <tr height="50px">
                <td height="50px">
				<p for="CompanyName" style="font-size:20px;"><b>Company Name:</b></p></td>
				<td><input type="text" id="CompanyName" name="CompanyName" style="font-size:16px; border:solid 1px;" required><br><br></td></tr>
				 <tr height="50px"><td colspan="1">
				<p for="CompanyDetails" style="font-size:20px;"><b>Company Details:</b></p></td>
				<td colspan="1"><textarea id="CompanyDetails" name="CompanyDetails"  style="font-size:16px; width:500px; height:150px; border:solid 1px;" required></textarea>
                <br><br></td>
                
                <tr height="50px"><td colspan="1">
				<p for="CompanyDetails" style="font-size:20px;"><b>Company URL:</b></p></td>
				<td colspan="1"><input type="url" id="CompanyURL" name="CompanyURL" style="font-size:16px; border:solid 1px;"   required />
                <br><br></td>
			    
                <tr height="50px"><td colspan="1">
				<p for="video" style="font-size:20px;"><b>Video:</b></p></td>
				<td colspan="2"><input type='file' class="file" onChange="Filesizet4()" name='videoName'id='videoName2' accept="video/mp4,video/x-m4v,video/*" required/>
                </td>
                
			    <tr height="50px"><td colspan="1">
				<p for="audio" style="font-size:20px;"><b>Audio:</b></p></td>
				<td colspan="1"><input class="file" type='file' onChange="Filesizet3()"  name='audio' id='audio2' accept="audio/*" required/>
                </td>
                <tr ><td colspan="2"><br></td></tr>
                
				<tr ><td colspan="2">

				<button name="Add" type="submit" class="update"  style="font-size:18px;">Add</button></td></tr>
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
function Filesizet() {
var tFile = document.getElementById("videoName").files[0]; 

            if (tFile.size > 50000000) // 2 kb for bytes.
            {
                alert("File size must under 5mb!");
                document.getElementById("videoName").value='';
                return;
            }
}
function logout(){
		window.location.assign('logout.php');
	}
function Filesizet2() {
var tFile = document.getElementById("audio").files[0]; 

            if (tFile.size > 5000000) // 2 kb for bytes.
            {
                alert("File size must under 5mb!");
                document.getElementById("audio").value='';
                return;
            }
}
function Filesizet3() {
var tFile = document.getElementById("audio2").files[0]; 

            if (tFile.size > 5000000) // 2 kb for bytes.
            {
                alert("File size must under 50mb!");
                document.getElementById("audio2").value='';
                return;
            }
}
function Filesizet4() {
var tFile = document.getElementById("videoName2").files[0]; 

            if (tFile.size > 5000000) // 2 kb for bytes.
            {
                alert("File size must under 50mb!");
                document.getElementById("videoName2").value='';
                return;
            }
}
$(document).ready(function() {
    
    var table = $('#company').DataTable( {
        select: true
    } );
 
    table
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
          
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
         
        } );

} );
	function login(){
		window.location.assign('login.php');
	}
	function logout(){
		window.location.assign('logout.php');
	}
	
	function modal(id){
   
		// Get the modal
		var modal = document.getElementById("myModal");
        var number = '<?php echo $number ?>'; 
	    var Logo =[],CompanyName=[],CompanyDetails=[],Video=[],Audio=[],IDphp=[],URL=[];
	    <?php
	        for($i=1;$i<=$number;$i++){
	    ?>
	    
			Logo[<?php echo $i ?>]='<?php echo $Logo[$i] ?>';
	        CompanyName[<?php echo $i ?>]='<?php echo $CompanyName[$i] ?>';
	        CompanyDetails[<?php echo $i ?>]='<?php echo $CompanyDetails[$i] ?>';
	        Video[<?php echo $i ?>]='<?php echo $Video[$i] ?>';
	        Audio[<?php echo $i ?>]='<?php echo $Audio[$i] ?>';
	        IDphp[<?php echo $i ?>]='<?php echo $IDPHP[$i] ?>';
	        URL[<?php echo $i ?>]='<?php echo $CompanyURL[$i] ?>';
	    <?php
		}
	    ?>
	    document.getElementById("CompanyName").value=CompanyName[id];
	    document.getElementById("CompanyDetails").value=CompanyDetails[id];
	    document.getElementById("video").innerHTML="The Original Video File was "+Video[id];
	    document.getElementById("audioMessageUpdate").innerHTML="The Original Audio File was "+Audio[id];
		document.getElementById("ID").value=IDphp[id];
		document.getElementById("companyURLUpdate").value=URL[id];
	    
    
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

function addModal(){
   
		// Get the modal
		var modal = document.getElementById("addModal");

		// Get the <span> element that closes the modal
		var span = document.getElementById("close2");

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