<?php
include "../Config/db_config.php";

	class Mail{

		public $db;

		public function __construct(){
			$this->db = DBConnection::getDBConnection();

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/
		public function save_mail($ename,$eemail,$ephone,$emessage){

			//$upass = md5($upass);
			//$sql="SELECT * FROM users WHERE ufname='$ufname' OR uemail='$uemail'";

			//checking if the username or email is available in db
			//$check =  $this->db->query($sql) ;
			//$count_row = $check->num_rows;

			//if the username is not in db then insert to the table
			
				$sql1="INSERT INTO contactform SET ename='$ename', eemail='$eemail', ephone='$ephone', emessage='$emessage'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        		return $result;
			
		}

		/*** for login process ***/
		/**public function check_login($uemail, $upass){
			//echo $upass;
			//echo $uemail;
        	$upass = md5($upass);
			
			$sql2="SELECT uemail from users WHERE uemail='$uemail' and upass='$upass'";

			//checking if the username is available in the table
        	$result = mysqli_query($this->db,$sql2);
        	$user_data = mysqli_fetch_array($result);
        	$count_row = $result->num_rows;

	        if ($count_row == 1) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true;
	            $_SESSION['uemail'] = $user_data['uemail'];
	            return true;
	        }
	        else{
			    return false;
			}
    	}

    	/*** for showing the username or fullname ***/
    	public function get_fullname($uemail){
    		$sql3="SELECT ufname FROM users WHERE uemail = '$uemail'";
	        $result = mysqli_query($this->db,$sql3);
	        $user_data = mysqli_fetch_array($result);
	        return $user_data['ufname'];
        }

    	/*** starting the session ***/
	    public function get_session(){
	        return $_SESSION['login'];
	    }

	    public function user_logout() {
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }

	}
?>