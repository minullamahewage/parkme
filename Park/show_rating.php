<?php
include "../Config/db_config.php";

$q=$_GET["q"];

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="userdatabse"; // Database name 

$cpid=0;
// Connect to server and select databse.

$link = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name",$link)or die("cannot select DB");


$sql="SELECT rating FROM carparks WHERE cpid = '".$q."'";

$result = mysql_query($sql);

$row = mysql_fetch_array($result);

$name =$row['name'];

if($name == '' || empty($name)) {
  echo "<b>ID not found.</b>";
} else {
  echo "<b>".$name."</b>";
}

mysql_close($link);

public function setId($id){

    $this->id = $id;
}
?>