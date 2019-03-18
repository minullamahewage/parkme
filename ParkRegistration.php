<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Car Park Registration</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="assets/img/app-icon-transparent.png">

	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="user.js"></script>

	<?php
	require 'class.parkReg.php';
	$carPark = new CarPark(); // Checking for user logged in or not
	if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
		if ( isset( $_REQUEST[ 'submit' ] ) ) {
			extract( $_REQUEST );
			//echo "afsdfasgag";
			
				//echo "You have selected :" . $_REQUEST['udob']; //  Displaying Selected Value
			
			$register = $carPark->reg_carPark($parkName, $longitude, $latitude, $totalSlots);
			if ($register) {
			// Registration Success
			//echo 'Registration successful <a href="login.php">Click here</a> to login';
				echo "Registration Successful";
			} else {
			// Registration Failed
			echo 'Registration failed.Please try again';
			}
		}
	}
	?>
</head>

<body id="ParkRegistration">
	<script type="text/javascript" language="javascript">
		function submitreg() {
			var form = document.register;
			if ( form.parkName.value == "" ) {
				alert( "Enter a car park name" );
				return false;
			} else if ( form.parkID.value == "" ) {
				alert( "Enter car park ID" );
				return false;
			} else if ( form.totalSlots.value == "" ) {
				alert( "Enter car park slots" );
				return false;

			}
		}
	</script>

	<div class="container">
		<form class="" action="" method="post" name="register">
			<div class="row">
				<h4>Car Park Details</h4>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Car Park Name" id="nameID" name='parkName'/>
					<div class="input-icon"><i class="fa fa-car"></i>
					</div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Longitude" id="longitudeID" name='longitude'/>
					<div class="input-icon"><i class="fa fa-location-arrow"></i>
					</div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Latitude" id="latitudeID" name='latitude'/>
					<div class="input-icon"><i class="fa fa-location-arrow"></i>
					</div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Total Car Park Slots" id="totalSlotsID" name='totalSlots'/>
					<div class="input-icon"><i class="fa fa-th"></i>
					</div>
				</div>
				
				<div class="row">
					<h4></h4>
					<div class="input-group">
						<input type="submit" name="submit" value="Submit" id="btn_submit" onclick="return(submitreg());"/>
						<label for="btn_submit"></label>

					</div>
				</div>
			</div>
			
		</form>
		</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



		<script src="js/index.js"></script>




</body>

</html>