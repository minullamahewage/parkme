<?php
include "db_config.php";

	class Booking{

		public $db;

		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/
		public function book_carPark($parkName){
				$sql1="SELECT cpavailable FROM carparks WHERE cpname='$parkName'";
				//$result1=mysqli_query($this->db,$sql1);
				$dbValues=$this->db->query($sql1);
				$rowCount=$dbValues->num_rows;
				if($rowCount!=0){
					while($row = $dbValues->fetch_assoc()) {
						$available=$row["cpavailable"];
						if($available==0){
								echo '<script language="javascript">';
								echo 'alert("No Slots Available!!")';
								echo '</script>';
						}else{
								$sql2="UPDATE carparks SET cpavailable=cpavailable-1,cpbooked=cpbooked+1 WHERE cpname='$parkName'";
								$result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."Data cannot be inserted");
								return $result2;
						}
					}
				}
				
			}
		}
?>