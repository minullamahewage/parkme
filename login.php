<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="assets/img/app-icon-transparent.png">
	<?php
	session_start();
	require 'class.user.php';
	$user = new User();
	if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
		if ( isset( $_REQUEST[ 'submit' ] ) ) {
			extract( $_REQUEST );
			$login = $user->check_login( $uemail, $upass );
			if ( $login ) {
				// Registration Success
				header( "location:map.html" );;
			} else {
				// Registration Failed
				$message = "Username and/or Password incorrect.\\nTry again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}
	?>

</head>

<body id="login">
	<script type="text/javascript" language="javascript">
		function submitlogin() {
			var form = document.login;
			if ( form.uemail.value == "" ) {
				alert( "Enter email or username." );
				return false;
			} else if ( form.upass.value == "" ) {
				alert( "Enter password." );
				return false;
			}
		}


function showpass(obj){

  var obj = document.getElementById('password');
  obj.type = "text";
	

}
		function hidepass(obj){

  var obj = document.getElementById('password');
  obj.type = "password";
	

}
	
	
	</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="" method="post" action="" name="login">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
				
					<img src="assets/img/app-icon-transparent.png" alt="login-logo" class="app-logo">
					<div class="input-group input-group-icon">
						<input type="email" placeholder="Email" id="emailID" name="uemail"/>
						<div class="input-icon"><i class="fa fa-envelope"></i>
						</div>
					</div>
					<div class="input-group input-group-icon">
						<input type="password" placeholder="Password" id="password" name="upass"/>
						<div>
							<span onmousedown = "showpass()" onmouseup = "hidepass()"toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
						</div>
						<div class="input-icon"><i class="fa fa-lock"></i>
						</div>

					</div>

					<div class="input-group">
						<input type="submit" name="submit" value="Login" id="btn_submit" onclick="return(submitlogin());"/>
						<label for="btn_submit"></label>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>
					

						<a class="txt2" href="registration.html">
							Sign Up
						</a>
					
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<script src="js/main.js"></script>

</body>
</html>