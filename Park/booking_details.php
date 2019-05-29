<html>
<head>
<title>Booking Details</title>
<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="icon" href="../assets/graphics/app-icon-transparent.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/messages-style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/overlay.css">
    <!-- CSS -->

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
 
<!-- Script -->
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>

</head>
<body>
<?php 
session_start();
include 'class.carpark.php';

$park = new CarPark();
$id = $_SESSION['id'];
$name = $_SESSION['ufname'];
echo $id;
echo "Welcome $name";





$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
}

                $sql4="SELECT cpid FROM navigations WHERE id='$id'";
				$result4 = $mysqli->query($sql4);
				$row = $result4->fetch_assoc();
                $cpid = $row["cpid"];
                echo $cpid;


if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    if ( isset( $_REQUEST[ 'submit' ] ) ) {
        extract( $_REQUEST );
        $cancelling = $park->cancel_booking( $id );
        if ( $cancelling ) {
            // Registration Success
            
            $message = "Cancelled Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
            }else {
                // Registration Failed
                $message = "Cancelation Fail.\\nTry again or contact admin.";
                echo "<script type='text/javascript'>alert('$message');</script>";
        
        } 
        }
    if ( isset( $_REQUEST[ 'rating' ] ) ) {
        extract( $_REQUEST );
        $val = $_POST['rates'];
        //echo "<script type='text/javascript'>alert('$val');</script>";
        $rating = $park->update_rating( $cpid ,$val);
        if ( $rating ) {
            // Registration Success
            
            $message = "Rating Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
            }else {
                // Registration Failed
                $message = "RAating Fail.\\nTry again";
                echo "<script type='text/javascript'>alert('$message');</script>";
        
        } 
        
    }
}


$query = "SELECT * FROM navigations WHERE id = $id";
 
 
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
    <button onclick="window.open('../Contact/contact-us.php')">Contact us</button>
    <button onclick="window.open('../Interface/home_afterlogin.php')">Home</button>
    <button onclick="on();">Rate the Park</button>
    <form class="" method="post" action="" name="carParks">
			
            <div class="input-group input-group-submit">
                <input type="submit" name="submit" value="Cancel Booking" id="btn_submit" onclick=""/>
                <label for="btn_submit"></label>
            </div>

        </form>


<div id = "overlay" >     
<form class="" method="post" action="" name="rating">   
<select name="rates">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="3">4</option>
  <option value="3">5</option>
</select>
<input type="submit" name="rating" value="Rate" id="btn_submit" onclick=""/>
<button onclick = "off();">Cancel</Button>
</form>

        </div>
 

            <script>
            

            function off() {
  document.getElementById("overlay").style.display = "none";
  //alert('s');
}
function on() {
  document.getElementById("overlay").style.display = "block";
}
            
            </script>
</body>
</html>