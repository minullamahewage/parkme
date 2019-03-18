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
    /*$carpark = new CarPark(); 
    $carpark->return_location(1);
    $cplat=$carpark->cplat;
    $cplng=$carpark->cplng;
    //echo $cplat;*/

    //retreive data from the database into an array
    $cparray= array();
    for ($i=0; $i<7; $i++){
        ${"carpark".$i}=new CarPark();
        ${"carpark".$i}->return_location($i);
        //echo $i;
        $cparray[$i]= array($i,${"carpark".$i}->cplat,${"carpark".$i}->cplng);
        
    }
    /*$js_cparray1 = json_encode($cparray[1]);
    $js_cparray2 = json_encode($cparray[2]);
    $js_cparray3 = json_encode($cparray[3]);
    $js_cparray4 = json_encode($cparray[4]);
    $js_cparray5 = json_encode($cparray[5]);
    echo json_encode($cparray[1]);*/
    $js_cparray= json_encode($cparray);
    //$output=$cparray[1][1]
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
    <script>
        function updateCarParks(){
            var cparray = <?php echo $js_cparray ?>;
            //getDistancesList(cparray[1]);
            //console.log(cparray[0][1]);
            //console.log("cpid: "+ cparray[0][0]+ "cplat: "+ cparray[0][1]+ "cplng: "+ cparray[0][2]);
            console.log("cpid: "+ cparray[1][0]+ ", cplat: "+ cparray[1][1]+ ", cplng: "+ cparray[1][2]);
            console.log("cpid: "+ cparray[2][0]+ ", cplat: "+ cparray[2][1]+ ", cplng: "+ cparray[2][2]);
            console.log("cpid: "+ cparray[3][0]+ ", cplat: "+ cparray[3][1]+ ", cplng: "+ cparray[3][2]);
            console.log("cpid: "+ cparray[4][0]+ ", cplat: "+ cparray[4][1]+ ", cplng: "+ cparray[4][2]);
            console.log("cpid: "+ cparray[5][0]+ ", cplat: "+ cparray[5][1]+ ", cplng: "+ cparray[5][2]);
            console.log("cpid: "+ cparray[6][0]+ ", cplat: "+ cparray[6][1]+ ", cplng: "+ cparray[6][2]);
            getDistancesList(cparray);

            setTimeout(function() {
            //console.log(distance);
            //console.log(cpDistanceArray[1][1]);
            //console.log(cpDistanceArray[1][1]);
            cpInfoArray.sort(function(a, b) {
                var valueA, valueB;

                valueA = a[2]; // Where 1 is your index, from your example
                valueB = b[2];
                if (valueA < valueB) {
                    return -1;
                }
                else if (valueA > valueB) {
                    return 1;
                }
                return 0;
            });
            //cpDistanceArray.sort(function(a, b){return a[1] - b[1]});
            //console.log(cpInfoArray[0][0]+"- Distance: "+ cpInfoArray[0][1]+"Travel Time: "+cpInfoArray[0][2]);
            //console.log(cpInfoArray[1][0]+"- Distance: "+ cpInfoArray[1][1]+"Travel Time: "+cpInfoArray[1][2]);
            console.log(cpInfoArray[2][0]+"- Distance: "+ cpInfoArray[2][1]+", Travel Time: "+cpInfoArray[2][2]);
            console.log(cpInfoArray[3][0]+"- Distance: "+ cpInfoArray[3][1]+", Travel Time: "+cpInfoArray[3][2]);
            console.log(cpInfoArray[4][0]+"- Distance: "+ cpInfoArray[4][1]+", Travel Time: "+cpInfoArray[4][2]);
            console.log(cpInfoArray[5][0]+"- Distance: "+ cpInfoArray[5][1]+", Travel Time: "+cpInfoArray[5][2]);
            console.log(cpInfoArray[6][0]+"- Distance: "+ cpInfoArray[6][1]+", Travel Time: "+cpInfoArray[6][2]);

            
            }, 10000);


            
    }
    </script>
  </head>
  <body>
  <div style="width: 640px; height: 480px" id="mapContainer"></div>
  <script src="map.js" type="text/javascript"></script>
      <div class="map-text-box">
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="getLocation()">Get Location </a> 
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="navigate(<?php echo $cplat; ?>,<?php echo $cplng; ?>)">Navigate </a>
                <a class="btn btn-ghost"  href="#" id="carkpark-info" onclick="updateCarParks()">Carpark Info</a>
                
            </div>
            <div style="position: absolute; top:40px; left:800px; width:600px; height:600px">
            <button style="width: 400px; height: 40px"class="btn btn-full" href="#" id="carpark0-btn" >Car Park 0</button>
            </div>
  </body>
</html>