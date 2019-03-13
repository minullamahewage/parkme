<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="Content-Language" content="en">
      <link rel="stylesheet" href="assets/css/style.css">
  <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
  <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>

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
				header("location:login.php");;
			} else {
			// Registration Failed
			echo 'Registration failed. Email or Username already exits please try again';
			}
		}
	}
  ?>
  
  </head>
  <body>
  <div style="width: 640px; height: 480px" id="mapContainer"></div>
  <script src="map.js" type="text/javascript"></script>
      <div class="map-text-box">
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="getLocation()">Get Location </a> 
                <a class="btn btn-ghost"  href="#" id="carkpark-info" onclick="getDistance()">Carpark Info</a>
            </div>
  
  </body>
</html>