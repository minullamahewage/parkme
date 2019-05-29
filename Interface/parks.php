<html>
<head>
<title>Control Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/table.css">
    <link rel="icon" href="../assets/graphics/app-icon-transparent.png">
    <link rel="stylesheet" href="../assets/css/parks-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/overlay.css">
</head>
<body>
<?php 
require '../Park/class.carpark.php';
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
}
$query = "SELECT * FROM carparks";
 


echo '<table class="gridtable" border="0" cellspacing="2" cellpadding="2"> 
    
      <tr > 
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
<div class="btn-group">
<button class="btn-group"  onclick="window.open('../Interface/home_afterlogin.php')"">Go to Home</button>
</div>
</body>
</html>