<?php
include "../Config/db_config.php";

	class CarPark{

		public $db;

		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/
		public function reg_carPark($parkName,$longitude,$latitude,$totalSlots){

			//$upass = md5($upass);
			$sql="SELECT * FROM carparks WHERE cpname='$parkName'";

			//checking if the username or email is available in db
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;
			//echo $parkName;
			//echo $longitude;
			//echo $latitude;
			//echo $availableSlots;
			//echo $totalSlots;
			//$int
			
			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$sql1="INSERT INTO carparks SET cpname='$parkName', cplat='$latitude', cplng='$longitude',cpavailable='$totalSlots',cptotal='$totalSlots'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted");
        		return $result;
			}
			else { return false;}
		}
	}
?>