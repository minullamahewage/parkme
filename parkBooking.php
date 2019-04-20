<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Car Park Booking</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="assets/img/app-icon-transparent.png">

	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="user.js"></script>

	<?php
	require 'class.booking.php';
	$Booking = new Booking();
	if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
		if ( isset( $_REQUEST[ 'book' ] ) ) {
			extract( $_REQUEST );
			//echo "afsdfasgag";
			
				//echo "You have selected :" . $_REQUEST['udob']; //  Displaying Selected Value
			
			$bookSlot = $Booking->book_carPark($parkName);
			if ($bookSlot ) {
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

<body id="ParkBooking">
	<script type="text/javascript" language="javascript">
		function submitBooking() {
			var form = document.bookSlot;
			if ( form.parkName.value == "" ) {
				alert( "Enter a car park name" );
				return false;
			}
		}
	</script>

	<div class="container">
		<form class="" action="" method="post" name="bookSlot">
			<div class="row">
				<h4>Car Park Details</h4>
				<div class="input-group input-group-icon">
					<input type="text" placeholder="Car Park Name" id="nameID" name='parkName'/>
					<div class="input-icon"><i class="fa fa-car"></i>
					</div>
				</div>
				
				<div class="row">
					<div class="input-group">
						<input type="submit" name="book" value="Book Slot" id="btn_book" onclick="return(submitBooking());"/>
						<label for="btn_book"></label>

					</div>
				</div>
				<div class="row">
					<div class="input-group">
						<input type="submit" name="navigate" value="Navigate to Car Park" id="btn_navigate" onclick="return(submitBooking());"/>
						<label for="btn_navigate"></label>

					</div>
				</div>
			</div>
			
		</form>
		</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



		<script src="js/index.js"></script>




</body>

</html>