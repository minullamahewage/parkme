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

    //retreive data from the database into an array
    $cparray= array();
    for ($i=0; $i<7; $i++){
        ${"carpark".$i}=new CarPark();
        ${"carpark".$i}->return_location($i);
        //echo $i;
        $cparray[$i]= array($i,${"carpark".$i}->cplat,${"carpark".$i}->cplng, ${"carpark".$i}->cpavailable, ${"carpark".$i}->cptotal, ${"carpark".$i}->cpbooked );
        
    }
    //encoding php array for use with js
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
        var cparray;
        //pass car park data to calculate distance and travel time
        function updateCarParks(){
            if(lat!=0 & lng!=0){
                cparray = <?php echo $js_cparray ?>;
                //getDistancesList(cparray[1]);
                //console.log(cparray[0][1]);
                //console.log("cpid: "+ cparray[0][0]+ "cplat: "+ cparray[0][1]+ "cplng: "+ cparray[0][2]);
                console.log("cpid: "+ cparray[1][0]+ ", cplat: "+ cparray[1][1]+ ", cplng: "+ cparray[1][2]+ ", cpavailable: "+ cparray[1][3]);
                console.log("cpid: "+ cparray[2][0]+ ", cplat: "+ cparray[2][1]+ ", cplng: "+ cparray[2][2]);
                console.log("cpid: "+ cparray[3][0]+ ", cplat: "+ cparray[3][1]+ ", cplng: "+ cparray[3][2]);
                console.log("cpid: "+ cparray[4][0]+ ", cplat: "+ cparray[4][1]+ ", cplng: "+ cparray[4][2]);
                console.log("cpid: "+ cparray[5][0]+ ", cplat: "+ cparray[5][1]+ ", cplng: "+ cparray[5][2]);
                console.log("cpid: "+ cparray[6][0]+ ", cplat: "+ cparray[6][1]+ ", cplng: "+ cparray[6][2]);
                getDistancesList(cparray);
                
            }
            else{
                document.getElementById("carpark-info").onclick=locationNotLoaded();
            }                
        }
        //error message for when location isn't loaded
        function locationNotLoaded(){
            alert("Location not loaded. Please try requesting for location again")
        }
        //error message when car park info not loaded
        function carParkInfoNotLoaded(){
            alert("Please select Carpark Info button to load information");
        }
    </script>
  </head>
  <body>
  <div style="width: 640px; height: 700px" id="mapContainer"></div>
  <script src="map.js" type="text/javascript"></script>
      <div class="map-text-box">
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="getLocation()">Get Location </a> 
                <a class="btn btn-ghost disabled"  href="#" id="carkpark-info" onclick="updateCarParks()">Carpark Info</a>
                
            </div>
            <div style="position: absolute; top:20px; left:800px; width:600px; height:600px">
            <button class="btn-carpark disabled" id="carpark1-btn" onclick="navigate(cpAvailableArray[1][1], cpAvailableArray[1][2])"><span>Car Park 1<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark2-btn" onclick="navigate(cpAvailableArray[2][1], cpAvailableArray[2][2])"><span>Car Park 2<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark3-btn" onclick="navigate(cpAvailableArray[3][1], cpAvailableArray[3][2])"><span>Car Park 3<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark4-btn" onclick="navigate(cpAvailableArray[4][1], cpAvailableArray[4][2])"><span>Car Park 4<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark5-btn" onclick="navigate(cpAvailableArray[5][1], cpAvailableArray[5][2])"><span>Car Park 5<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark6-btn" onclick="navigate(cpAvailableArray[6][1], cpAvailableArray[6][2])"><span>Car Park 6<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA</p></span></button>
            </div>
  </body>
</html>