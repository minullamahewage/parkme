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
	require 'class.carpark.php';
    $carpark = new CarPark(); 
    $carpark->return_location(1);
    $cplat=$carpark->cplat;
    $cplng=$carpark->cplng;
    echo $cplat;
    $cparray= array();
    for ($i=1; $i<6; $i++){
        ${"carpark".$i}=new CarPark();
        ${"carpark".$i}->return_location($i);
        echo $i;
        $cparray[$i]= array($i,${"carpark".$i}->cplat,${"carpark".$i}->cplng);
        
    }
    $js_cparray1 = json_encode($cparray[1]);
    $js_cparray2 = json_encode($cparray[2]);
    $js_cparray3 = json_encode($cparray[3]);
    $js_cparray4 = json_encode($cparray[4]);
    $js_cparray5 = json_encode($cparray[5]);
    echo json_encode($cparray[1]);
    echo $js_cparray1;
    //echo "<script type='text/javascript'>alert('$cplat');</script>";
	/*if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
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
	}*/
  ?>
  
  </head>
  <body>
  <div style="width: 640px; height: 480px" id="mapContainer"></div>
  <script src="map.js" type="text/javascript"></script>
      <div class="map-text-box">
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="getLocation()">Get Location </a> 
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="navigate(<?php echo $cplat; ?>,<?php echo $cplng; ?>)">Navigate </a>
                <a class="btn btn-ghost"  href="#" id="carkpark-info" onclick="updateCarParks(<?php echo $js_cparray1; ?>,<?php echo $js_cparray2 ?>,<?php echo $js_cparray3 ?>,<?php echo $js_cparray4 ?>,<?php echo $js_cparray5 ?>)">Carpark Info</a>
            </div>
  
  </body>
</html>