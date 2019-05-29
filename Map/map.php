<!DOCTYPE html>
<html>
  <head>
  <title>Find Car Parks</title>
  <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="icon" href="../assets/graphics/app-icon-transparent.png">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="Content-Language" content="en">
  <link rel="stylesheet" href="../assets/css/maps-style.css">
      <link rel="stylesheet" href="../assets/css/style.css">
      <link rel="stylesheet" href="../assets/css/overlay.css">
  <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
  <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>

  <?php
  session_start();
    require '../Park/class.carpark.php';
    
    $park = new CarPark();
    $uemail = $_SESSION['uemail'];
    
    echo "$uemail";
    if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {
      if ( isset( $_REQUEST[ 'submit' ] ) ) {
        extract( $_REQUEST );
        if($booked == "yes"){
          $booking = $park->book_carPark($id,$uemail);
          header('Location: ../Park/booking_details.php');
          
        }else{
          $booking = $park->navigate_carPark($id,$uemail);;
          header('Location: ../Interface/home_afterlogin .php');
        }
        
        
        if($booking){
          echo "<script type='text/javascript'>alert('Booking Successful and Navigating');</script>";

        }else{
          echo "<script type='text/javascript'>alert('Booking Error. Try Again or Just Navigate.');</script>";
        }


         
      }
    }

    
    //retreive data from the database into an array
    $cparray= array();
    for ($i=0; $i<7; $i++){
        ${"carpark".$i}=new CarPark();
        ${"carpark".$i}->return_location($i);
        //echo $i;
        $cparray[$i]= array($i,${"carpark".$i}->cplat,${"carpark".$i}->cplng, ${"carpark".$i}->cpavailable, ${"carpark".$i}->cptotal, ${"carpark".$i}->cpbooked, ${"carpark".$i}->rating );
        
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

   
   

  
    
    //$park->cancel_booking();
  
      
      
                        
    
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
                console.log("cpid: "+ cparray[1][0]+ ", cplat: "+ cparray[1][1]+ ", cplng: "+ cparray[1][2]+ ", cpavailable: "+ cparray[1][3]+ ", rating: "+ cparray[1][5]);
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
  <div style="width: 640px; height: 780px" id="mapContainer"></div>
  <script src="map.js" type="text/javascript"></script>
      <div class="map-text-box">
                <a class="btn btn-full" href="#" id="get-location-btn" onclick="getLocation()">Get Location </a> 
                <a class="btn btn-ghost disabled"  href="#" id="carkpark-info" onclick="updateCarParks()">Carpark Info</a>
                
            </div>
            <div style="position: absolute; top:40px; left:800px; width:600px; height:600px">
            <button class="btn-carpark disabled" id="carpark1-btn" onclick="navigateData(cpAvailableArray[1][0], cpAvailableArray[1][1], cpAvailableArray[1][2])"><span>Car Park 1<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark2-btn" onclick="navigateData(cpAvailableArray[2][0], cpAvailableArray[2][1], cpAvailableArray[2][2])"><span>Car Park 2<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark3-btn" onclick="navigateData(cpAvailableArray[3][0], cpAvailableArray[3][1], cpAvailableArray[3][2])"><span>Car Park 3<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark4-btn" onclick="navigateData(cpAvailableArray[4][0], cpAvailableArray[4][1], cpAvailableArray[4][2])"><span>Car Park 4<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark5-btn" onclick="navigateData(cpAvailableArray[5][0], cpAvailableArray[5][1], cpAvailableArray[5][2])"><span>Car Park 5<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            <button class="btn-carpark disabled" id="carpark6-btn" onclick="navigateData(cpAvailableArray[6][0], cpAvailableArray[6][1], cpAvailableArray[6][2])"><span>Car Park 6<br/><p> Distance: NA<br/>   Travel Time: NA<br/>   Available Slots: NA<br/>   Booked: NA<br/>   Rating: NA</p></span></button>
            </div>

            <div id = "parkDetails">


            <form class="" method="get" action="" name="parks" novalidate>

				
			
				
            <input type="number" placeholder="id" id="form_id" name="id"/>
            <input type="text" placeholder="id" id="form_booked" name="booked" value = "no"/>
           
            
		
				

				

            </div>

            <div id="overlay" onclick = "off()">
 <button  id = "navbtn" class="btn-carpark" onclick="navigateFuncB()" type = "submit" name = "submit">Reserve and Start Navigation</button>
  
  <button id = "navbtn" class="btn-carpark" onclick="navigateFunc()" type = "submit" name = "submit">Start Navigation</button>
</div>
      </form>


<div id = "overlayButton">
        <button id = "navbtn" class = "btn-carpark" onclick = "offButton()">Cancel Booking</button>

</div>
<script>
var cp = {};

function on() {
  document.getElementById("overlay").style.display = "block";
}

function navigateData(cpid,cplat,cplng){
  cp.id = cpid;  
  cp.lat = cplat;
    cp.lng = cplng;

    document.getElementById("form_id").value = cpid;
    
    on();
    
}




function navigateFunc(){


    navigate(cp.lat,cp.lng);
    off();
    
    

}

function navigateFuncB(){

  document.getElementById("form_booked").value = "yes";
navigate(cp.lat,cp.lng);
off();
onbutton();



}

function off() {
  document.getElementById("overlay").style.display = "none";
  //alert('s');
}
function navigateFuncRe(){

navigate(cp.lat,cp.lng);
off();


}
function onbutton() {
  document.getElementById("overlayButton").style.display = "block";
  //alert('s');
}

function offbutton() {
  document.getElementById("overlayButton").style.display = "block";
  //alert('s');
}


function cancel(){
  var phpCancel= phpCancel(); 
}

</script>
   

  </body>
</html>