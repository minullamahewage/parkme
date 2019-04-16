<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Sign Up Form</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="assets/img/app-icon-transparent.png">

	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="user.js"></script>

	<?php
	require 'class.user.php';
	$user = new User(); // Checking for user logged in or not
	if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
		if ( isset( $_REQUEST[ 'submit' ] ) ) {
			extract( $_REQUEST );
			//echo "afsdfasgag";
			
				//echo "You have selected :" . $_REQUEST['udob']; //  Displaying Selected Value
			
			$register = $user->reg_user($ufname, $uemail,$upass, $udob, $ugender);
			if ($register) {
			// Registration Success
			//echo 'Registration successful <a href="login.php">Click here</a> to login';
				header("location:login.php");
			} else {
			// Registration Failed
				$message = "Registration failed. Email or Username already exist please try again.\\nTry again.";
				echo "<script type='text/javascript'>alert('$message');</script>";

			}
		}
	}
	?>
</head>

<body id="registration">
	<script type="text/javascript" language="javascript">
		function submitreg() {
			//alert("hi");
			var form = document.register;
			if ( form.ufname.value == "" ) {
				alert("Enter first name");
				return false;
			} else if ( form.uemail.value == "" ) {
				alert( "Enter email" );
				return false;
			} else if ( form.upass.value == "" ) {
				alert( "Enter password." );
				return false;

			}else if(form.upass.value!=form.upassconfirm.value){
				alert("Password does not match.");
				return false;
			}else if(form.terms.checked==false){
				alert("Please accept terms and conditions to continue");
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

	<div class="container">
		<form class="" action="" method="post" name="register">
			<div class="row">
				<h4>Personal Details</h4>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="First Name" id="nameID" name='ufname'/>
					<div class="input-icon"><i class="fa fa-user"></i>
						<div id="fnamevalid" style="color:Red;display:none">
						</div>
					</div>
					
				</div>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Last Name" id="nameID" name='ulname'/>
					<div class="input-icon"><i class="fa fa-user"></i>
						<div id="fnamevalid" style="color:Red;display:none">
						</div>
					</div>
					
				</div>
				<div class="input-group input-group-icon">
					<input type="email" placeholder="Email Adress" id="emailID" name='uemail'/>
					<div class="input-icon"><i class="fa fa-envelope"></i>
					</div>
				</div>
				<div class="input-group input-group-icon">
					<input type="password" placeholder="Password" id="password" name='upass'/>
					<div>
							<span onmousedown = "showpass()" onmouseup = "hidepass()"toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
						</div>
					<div class="input-icon"><i class="fa fa-key"></i>
					</div>
				</div>
				<div class="input-group input-group-icon">
					<input type="password" placeholder="Confirm Password" id="password" name='upassconfirm'/>
					<div>
							<span onmousedown = "showpass()" onmouseup = "hidepass()"toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
						</div>
					<div class="input-icon"><i class="fa fa-key"></i>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-half">
					<h4>Date of Birth</h4>
					<div class="input-group">

						<div class="col-third">
							<input type="date"  name="udob" id = "date"/>
						</div>
					</div>
				</div>
				<div class="col-half">
					<h4>Gender</h4>
					<div class="input-group">
						<input type="radio" name="ugender" value="male" id="gender-male"/>
						<label for="gender-male">Male</label>
						<input type="radio" name="ugender" value="female" id="gender-female"/>
						<label for="gender-female">Female</label>
					</div>
				</div>
			</div>

			<div class="row">
				<h4>Terms and Conditions</h4>
				<div class="input-group">
					<input type="checkbox" id="terms" name="terms"/>
					<label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
				</div>
				<div class="row">
					<h4></h4>
					<div class="input-group">
						<input type="submit" name="submit" value="Submit" id="btn_submit" onclick="return(submitreg());"/>
						<label for="btn_submit"></label>

					</div>
					<a href="login.php">Already registered! Click Here!</a>
					</td>
					<div class="row">
						<a href="privacy.html" target="_blank">
							<p id="privacy">Terms and Conditions/Privacy Policies</p>


					</div>
				</div>
		</form>
		</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



		<script src="js/index.js"></script>




</body>

</html>