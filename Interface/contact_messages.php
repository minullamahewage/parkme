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

$query = "SELECT * FROM contactform ORDER BY eid DESC";
 
 
echo '<table class="gridtable" border="0" cellspacing="2" cellpadding="2"> 
    
      <tr> 
          
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">email</font> </td> 
          <td> <font face="Arial">Phone</font> </td> 
          <td> <font face="Arial">Message</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        
        $field2name = $row["ename"];
        $field3name = $row["eemail"];
        $field4name = $row["ephone"];
        $field5name = $row["emessage"]; 
 
        echo '
            <
            <tr> 
                  
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
              </tr>';
    }
    $result->free();
} 

?>
<div class="btn-group">
    <button onclick="window.open('../Interface/home_afterlogin.php')">Go to Home</button>   
</div>