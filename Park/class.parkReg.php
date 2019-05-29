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
			 
			if (is_numeric($longitude)==False or is_numeric($latitude)==False or floor((float)$latitude)==(float)$latitude or floor((float)$longitude)==(float)$longitude){
				echo '<script language="javascript">';
				echo 'alert("Latitude & Longitude can only be Floating Point Numbers!!")';
				echo '</script>';
				
			}else if(is_numeric($totalSlots)==False or filter_var($totalSlots,FILTER_VALIDATE_INT)==False){
				echo '<script language="javascript">';
				echo 'alert("The Number of Slots must be an Integer Number!!")';
				echo '</script>';
				
			}else{
				$sql="SELECT * FROM carparks WHERE cpname='$parkName'";
				$check =  $this->db->query($sql) ;
				$count_row = $check->num_rows;
				
				if ($count_row == 0){
					$sql1="INSERT INTO carparks SET cpname='$parkName', cplat='$latitude', cplng='$longitude',cpavailable='$totalSlots',cptotal='$totalSlots'";
					$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted");
					return $result;
				
				}else { 
					echo '<script language="javascript">';
					echo 'alert("The Name of the Car Park Already Exists..Please Choose a Different Name!!")';
					echo '</script>';
					return false;
				}
			}
		}
	}
?>