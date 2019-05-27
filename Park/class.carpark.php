<?php
include "../Config/db_config.php";

	class CarPark{

		public $db;
        public $cplat;
        public $cplng;
        public $cpavailable;
		public $cptotal;
		public $cpbooked;
		public $cpid;

		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/
		/*public function reg_user($ufname,$uemail,$upass,$udob,$ugender){

			$upass = md5($upass);
			$sql="SELECT * FROM users WHERE ufname='$ufname' OR uemail='$uemail'";

			//checking if the username or email is available in db
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;

			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$sql1="INSERT INTO users SET ufname='$ufname', upass='$upass', uemail='$uemail', udob='$udob'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        		return $result;
			}
			else { return false;}
		}*/

		/*** for login process ***/
		public function return_location($cpid){
			//echo $upass;
			//echo $uemail;
        	//$upass = md5($upass);
			
            $sql1="SELECT cplat from carparks WHERE cpid='$cpid'";
			$sql2="SELECT cplng from carparks WHERE cpid='$cpid'";
			$sql3="SELECT cpavailable from carparks WHERE cpid='$cpid'";
			$sql4="SELECT cptotal from carparks WHERE cpid='$cpid'";
			$sql5="SELECT cpbooked from carparks WHERE cpid='$cpid'";

            //checking if the username is available in the table
            //getting latitude
        	$result1 = mysqli_query($this->db,$sql1);
            $user_datalat = mysqli_fetch_array($result1);
            //getting longitude
            $result2 = mysqli_query($this->db,$sql2);
			$user_datalng = mysqli_fetch_array($result2);
			//getting available slots
			$result3 = mysqli_query($this->db,$sql3);
			$user_dataavailable = mysqli_fetch_array($result3);
			//getting total slots
			$result4 = mysqli_query($this->db,$sql4);
			$user_datatotal = mysqli_fetch_array($result4);
			//getting booked slots
			$result5 = mysqli_query($this->db,$sql5);
        	$user_databooked = mysqli_fetch_array($result5);
			//$count_row = $result->num_rows;
			
            $this->cplat=$user_datalat['cplat'];
			$this->cplng=$user_datalng['cplng'];
			$this->cpavailable =$user_dataavailable['cpavailable'];
			$this->cptotal=$user_datatotal['cptotal'];
			$this->cpbooked=$user_databooked['cpbooked'];
			

            //echo $this->cplat;
            //echo $this->cplng;
            //echo "<script type='text/javascript'>alert('$this->$cplat');</script>";
            
            /*if ($count_row == 1) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true;
	            $_SESSION['uemail'] = $user_data['uemail'];
	            return true;
	        }
	        else{
			    return false;
            }*/
            
    	}

    	/*** for showing the username or fullname ***/
    	/*public function get_fullname($uemail){
    		$sql3="SELECT ufname FROM users WHERE uemail = '$uemail'";
	        $result = mysqli_query($this->db,$sql3);
	        $user_data = mysqli_fetch_array($result);
	        return $user_data['ufname'];
    	}

    	/*** starting the session ***/
	    /*public function get_session(){
	        return $_SESSION['login'];
	    }

	    public function user_logout() {
	        $_SESSION['login'] = FALSE;
	        session_destroy();
        }*/

	
		public function book_carPark($id,$uemail){
			//$message = $lat;
		 //echo "<script type='text/javascript'>alert('Request Successful and Navigating');</script>";
		 
				$sql2="UPDATE carparks SET cpavailable=cpavailable-1,cpbooked=cpbooked+1 WHERE cpid='$id'";
				$result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."Data cannot be inserted");

				$this->$cpid = $id;
				$booked = "yes";


				$this-> add_navigations($id,$uemail,$booked);
				//echo mysqli_errno($this->db);
				return true;
				
			//$sql2="SELECT cpname from carparks WHERE cpid='$id'";

			//checking if the username is available in the table
        	//$result = mysqli_query($this->db,$sql2);
        	//$user_data = mysqli_fetch_array($result);
        	//$count_row = $result->num_rows;
			//echo $count_row;
	        //if ($count_row == 1) {
	            // this login var will use for the session thing
	            //echo "<script type='text/javascript'>alert('yeahhhhs');</script>";
	            //return true;

			//}else{
				
			//	echo mysqli_errno($this->db);
			///}

		}

		public function book_carPark1($parkName){
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

		public function updating($id, $available, $booked){
	
			$sql2="UPDATE carparks SET cpavailable='$available',cpbooked='$booked' WHERE cpid='$id'";
			$result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."Data cannot be inserted");


		}

		public function navigate_carPark($id,$uemail){
			$booked = "no";
			$this->add_navigations($id,$uemail,$booked);
			return true;
			//echo "<script type='text/javascript'>alert('navigatefunctiodone');</script>";
		}


		public function add_navigations($id,$uemail,$booked){
			$cancelled = "No";
			
				$sql3="SELECT cpname FROM carparks WHERE cpid='$id'";
				$result3 = mysqli_query($this->db,$sql3);
				$row = $result3->fetch_assoc();
				$park_name = $row["cpname"];

				$sql4="SELECT ufname FROM users WHERE uemail='$uemail'";
				$result4 = mysqli_query($this->db,$sql4);
				$row = $result4->fetch_assoc();
				$user_name = $row["ufname"];

				
				

				$date_time = date('Y-m-d H:i:s');

				$sql5 = "INSERT INTO navigations (ufname, uemail, date_time, cpname, cpid, booked, cancelled) VALUES ('$user_name', '$uemail', '$date_time', '$park_name', '$id', '$booked', '$cancelled')";
				$result5 = mysqli_query($this->db,$sql5);



		}

		public function cancel_booking(){
				echo "<script type='text/javascript'>alert('Doon');</script>";
			
			$sql6="SELECT cpid FROM navigations WHERE id='$id'";
				$result6 = mysqli_query($this->db,$sql6);
				$row = $result6->fetch_assoc();
				$park_id = $row["cpid"];

				$sql7="UPDATE carparks SET cpavailable=cpavailable+1,cpbooked=cpbooked-1 WHERE cpid='$par_id'";
				$result7 = mysqli_query($this->db,$sql7);
				return true;
		}
	}

?>