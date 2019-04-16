<html>
<head>
<title>Control Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">-->
</head>
<body>
<?php 
require 'db_config.php';
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
if(mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
        exit;
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
?>

<a href = "home_afterlogin.php">Go to Home</a>
</body>
</html>