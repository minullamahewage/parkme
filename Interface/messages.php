<html>
<head>
<title>Control Panel</title>
<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="icon" href="../assets/graphics/app-icon-transparent.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/messages-style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/overlay.css">
    <link rel="icon" href="../assets/graphics/app-icon-transparent.png">
</head>
<body>
<?php 
session_start();

require_once '../Park/class.carpark.php';
$park = new CarPark();

$uemail = $_SESSION['uemail'];
echo $uemail;

if($uemail != "admin@parkme.lk"){
    //echo "<script type='text/javascript'>alert('Login as a admin to complete this step.');</script>";
    header("location:../User/login.php");
}





$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
}



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
$query = "SELECT * FROM contactform ORDER BY eid DESC LIMIT 5";
 
 
echo '<table class="gridtable" border="0" cellspacing="2" cellpadding="2"> 
    
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
 


echo '<table class= "gridtable" border="0" cellspacing="2" cellpadding="2"> 
    
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

$query = "SELECT * FROM navigations ORDER BY id DESC";
 
 
echo '<table class="gridtable" border="0" cellspacing="2" cellpadding="2"> 
    
      <tr> 
          <td> <font face="Arial">Id</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">email</font> </td> 
          <td> <font face="Arial">Date and Time</font> </td> 
          <td> <font face="Arial">Car Park Name</font> </td> 
          <td> <font face="Arial">Car Park Id</font> </td> 
          <td> <font face="Arial">Booked</font> </td> 
          <td> <font face="Arial">Cancelled</font> </td> 

      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["id"];
        $field2name = $row["ufname"];
        $field3name = $row["uemail"];
        $field4name = $row["date_time"];
        $field5name = $row["cpname"]; 
        $field6name = $row["cpid"]; 
        $field7name = $row["booked"]; 
        $field8name = $row["cancelled"]; 
 
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
                  <td>'.$field8name.'</td> 
              </tr>';
    }
    $result->free();
} 
?>

<div class="btn-group">
    <button onclick="window.open('../Interface/home_afterlogin.php')">Go to Home</button>
    <button class="btn-group btn-register" onclick="window.open('../Park/ParkRegistration.php')">Register a new Car Park</button>
    <button  name="update" value="Update database"  onclick = "on() ">Update database</button>
</div>
 
<div id = "overlay" >
    <div class="limiter">
				<form class="" method="post" action="" name="carParks">
					<div class="input-group input-group-icon">
						<input type="number" placeholder="Car Park ID" id="cpid" name="cpid" min = "0" />	
					</div>
					<div class="input-group input-group-icon">
						<input type="number" placeholder="Available Slots" id="cpavailable" name="cpavailable" min="0"/>	
                    </div>
                    <div class="input-group input-group-icon">
						<input type="number" placeholder="Booked Slots" id="cpbooked" name="cpbooked" min="0"/>	
                    </div>
					<div class="input-group input-group-submit">
						<input type="submit" name="submit" value="Submit" id="btn_submit" onclick="off();"/>
						<label for="btn_submit"></label>
					</div>
					</div>
                </form>
            </div>
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