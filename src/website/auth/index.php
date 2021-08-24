<?php
	//Start a session
	session_start();

	//Includes
	include $_SERVER['DOCUMENT_ROOT'].'/includes/class.loading.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';

	//Check if login or not
	if(isset($_SESSION['login'])){
		route("dashboard");
	}

	$loader = new Loading();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Abesent.me - Masuk</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
	<?php $loader->addCSS("../images/loading.gif"); ?>
</head>
<body>
	<?php $loader->addBody(); ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="login" method="POST" action="login" onsubmit="return do_login();">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Email tidak valid: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email" placeholder="Email" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Kata sandi dibutuhkan">
						<input id="password" class="input100" type="password" name="password" placeholder="Kata sandi" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Masuk
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Report to us
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<?php $loader->addJS(700); ?>
	<script type="text/javascript">
		// Wait for window load
		function do_login()
		{
		 	var email=$("#email").val();
		 	var pass=$("#password").val();

		 	if(email!="" && pass!="")
		 	{
				  $("#loading_spinner").css({"display":"block"});
				  $.ajax
				  ({
				  	type:'post',
				  	url:'login.php',
				  	data:{
				   		do_login:"do_login",
				   		email:email,
				   		password:pass
				  	},
				  	success:function(response) {
		  				if(response=="success")
						{
						   window.location.href="/dashboard/";
						}
						else
						{
						    Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  text: 'Invalid email or password!'
							})
						}
		  			}
		  		  });
		 	}
		 	return false;
		}
	</script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>