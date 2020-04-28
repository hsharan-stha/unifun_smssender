<?php
session_start();

if (isset($_POST['loginbtn'])) {

    include 'config.php';
    $email = $_POST['email'];
    $pword = md5($_POST['pword']);
    $query = mysqli_query($connect, "select * from users where email='$email' and password='$pword'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        $_SESSION['sess_user_id'] = $data['id'];
        header("Location:dashboard.php");

    } else {
        header("Location:index.php?msg=login fail:Please sign up");
    }

}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>UNIFUN SMS</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/nice-select.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
		
		<style>
		.login-div{
			
			width:400px;
			min-height:400px;
			margin:10% auto;
			box-shadow:10px 10px 25px 1px #888888;
			
		}
		.login-div .header{
			padding:23px 30px;
			height:15%;
			border-bottom:1px solid grey;
			
				 
			  background-image: -moz-linear-gradient(0deg, #5F5FAF 0%, #B0B0D7 100%);
			  background-image: -webkit-linear-gradient(0deg, #5F5FAF 0%, #B0B0D7 100%);
			  background-image: -ms-linear-gradient(0deg, #5F5FAF 0%, #B0B0D7 100%);
			 
		}
		.login-div .header p {
			font-size:20px;
			color:white;
			font-weight:bold;
			
		}
		.login-div .footer{
			border-top:1px solid grey;
			padding:23px 30px;
			height:15%;
			background: rgba(0, 0, 0, 0.25);
			color:white;
			 
		}
		.login-div .content{
			padding:18px 30px;
			height:70%;
			background:white;
		}
		</style>
	</head>
	<body>
	
		 <div class='login-div'>
			 <div class='header'>
				<p>
					LOGIN
				</p>
			 </div>
			  <div class='content'>
					
					<?php if(!empty($_GET)){
					if(isset($_GET['msg'])){
						?>
					<div class='row' >
						<div onclick='$(this).hide()' class='col-sm-12 alert alert-danger '>
								 
							  <?= $_GET['msg']; ?>
						</div>
					 </div>
					<?php }
						else if(isset($_GET['msgsuccess'])){
							?>
							<div class='row' >
								<div onclick='$(this).hide()' class='col-sm-12 alert alert-success '>
										 
									  <?= $_GET['msgsuccess']; ?>
								</div>
							 </div>
							<?php
							
						}
					}
					
					?> 
				  <form method="post" action="index.php">
				 
					 <div class='row' style='margin-bottom:20px'>
						<div class='col-sm-12'>
							<label class='label' for='Email'>Email</label>
							<input name="email" type="email" placeholder="please enter email" class="form-control" required="required"/> 
						</div>
					 </div>
					 
					 <div class='row' style='margin-bottom:20px'>
						<div class='col-sm-12'>
						<label class='label' for='Password'>Password</label>
							<input name="pword" type="password" placeholder="please enter password" class="form-control"  required="required"/> 
						</div>
					 </div>
					 
					 <div class='row' style='margin-bottom:20px'>
						<div class='col-sm-12'>
						
							<input type="submit" value="Login" class='form-control btn btn-primary' name="loginbtn"/> 
						</div>
					 </div>
			  
					 <div class='row'>
						<div class='col-sm-12'>
						
							 New Users? <a href='signup.php' style='color:#5F5FAF'>Sign Up</a>
						</div>
					 </div>
				</form>
			  
			  </div>
			 <div class='footer'>
				<div class="copy-right-text">Copyright &copy; 2017  |  All rights reserved </div>
			 </div>
			
		 </div>
 
 
		<script src="js/vendor/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.nice-select.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
