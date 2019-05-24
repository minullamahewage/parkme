<html>
<head>
<title>Control Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/overlay.css">
</head>
<body>
<?php 
session_start();

require 'class.carpark.php';
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
}



$park = new CarPark();
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    if ( isset( $_REQUEST[ 'submit' ] ) ) {
        extract( $_REQUEST );
        $updating = $park->updating( $cpid, $cpavailable, $cpbooked );
        if ( $updating ) {
            // Registration Success
            
            $message = "Updated Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
            }
        
        } else {
            // Registration Failed
            $message = "Update Fail.\\nTry again.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
$query = "SELECT * FROM contactform";
 
 
echo '<table border="0" cellspacing="2" cellpadding="2"> 
    
      <tr> 
          <td> <font face="Arial">ID</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">email</font> </td> 
          <td> <font face="Arial">Phone</font> </td> 
          <td> <font face="Arial">Message</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["eid"];
        $field2name = $row["ename"];
        $field3name = $row["eemail"];
        $field4name = $row["ephone"];
        $field5name = $row["emessage"]; 
 
        echo '
            <
            <tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
              </tr>';
    }
    $result->free();
} 


$query = "SELECT * FROM carparks";
 


echo '<table border="0" cellspacing="2" cellpadding="2"> 
    
      <tr> 
          <td> <font face="Arial">Car Park ID</font> </td> 
          <td> <font face="Arial">Car Park Name</font> </td> 
          <td> <font face="Arial">Latitude</font> </td> 
          <td> <font face="Arial">Longitude</font> </td> 
          <td> <font face="Arial">Available slots</font> </td> 
          <td> <font face="Arial">Total slots</font> </td> 
          <td> <font face="Arial">Booked slots</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["cpid"];
        $field2name = $row["cpname"];
        $field3name = $row["cplat"];
        $field4name = $row["cplng"];
        $field5name = $row["cpavailable"]; 
        $field6name = $row["cptotal"]; 
        $field7name = $row["cpbooked"]; 
 
        echo '
            <
            <tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
                  <td>'.$field6name.'</td> 
                  <td>'.$field7name.'</td> 
              </tr>';
    }
    $result->free();
} 
?>

<a href = "home_afterlogin.php">Go to Home</a>


<div>
<button name="update" value="Update database"  onclick = "on() ">Update database</button></div>
 
<div id = "overlay">
				<form class="" method="post" action="" name="carParks">
				

					<div class="input-group input-group-icon">
						<input type="number" placeholder="Car Park ID" id="cpid" name="cpid"/>
						<div class="input-icon"><i class="fa fa-envelope"></i>
						</div>
					</div>
					<div class="input-group input-group-icon">
						<input type="number" placeholder="Available Slots" id="cpavailable" name="cpavailable"/>
						<div class="input-icon"><i class="fa fa-lock"></i>
						</div>
                    </div>
                    <div class="input-group input-group-icon">
						<input type="number" placeholder="Booked Slots" id="cpbooked" name="cpbooked"/>
						<div class="input-icon"><i class="fa fa-lock"></i>
						</div>
                    </div>
                    

					<div class="input-group">
						<input type="submit" name="submit" value="Submit" id="btn_submit" onclick="off();"/>
						<label for="btn_submit"></label>
					</div>

					
					</div>
				</form>
			</div>



            <script>
            
            function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
  //alert('s');
}
            
            
            </script>
</body>
</html>