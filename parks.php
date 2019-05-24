<html>
<head>
<title>Control Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/overlay.css">
</head>
<body>
<?php 
require 'db_config.php';
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
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
				<form class="" method="post" action="" name="carParks">
				

					<div class="input-group input-group-icon">
						<input type="email" placeholder="Email" id="emailID" name="uemail"/>
						<div class="input-icon"><i class="fa fa-envelope"></i>
						</div>
					</div>
					<div class="input-group input-group-icon">
						<input type="password" placeholder="Password" id="password" name="upass"/>
						<div>
							<span onmousedown = "showpass()" onmouseup = "hidepass()"toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
						</div>
						<div class="input-icon"><i class="fa fa-lock"></i>
						</div>

					</div>

					<div class="input-group">
						<input type="submit" name="submit" value="Login" id="btn_submit" onclick="return(submitlogin());"/>
						<label for="btn_submit"></label>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>
					

						<a class="txt2" href="registration.php">
							Sign Up
						</a>
					
					</div>
				</form>
			</div>

</body>
</html>