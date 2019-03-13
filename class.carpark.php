<?php
include "db_config.php";

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

            //checking if the username is available in the table
            //getting latitude
        	$result1 = mysqli_query($this->db,$sql1);
            $user_datalat = mysqli_fetch_array($result1);
            //getting longitude
            $result2 = mysqli_query($this->db,$sql2);
        	$user_datalng = mysqli_fetch_array($result2);
        	//$count_row = $result->num_rows;
            $cplat=$user_datalat['cplat'];
            $cplng=$user_datalng['cplng'];

            echo $cplat;
            echo $cplng;
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

	}
?>