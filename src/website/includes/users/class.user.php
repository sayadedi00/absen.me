<?php  
	include $_SERVER['DOCUMENT_ROOT'].'/settings.php';

	class User{
		public $db;

		/* Registration*/
		public function register($name, $password, $email){
			$conn = db();
			$password = md5($password);
			$sql = "SELECT * FROM users WHERE nama='$name' OR email='$email'";

			//Check user available in DB
			$check = $conn->query($sql);
			$count_row = $check->num_rows;

			if ($check->num_rows == 0){
				$sql = "INSERT INTO users SET nama='$name', password='$password', email='$email'";
				$result = $conn->query($sql);
				return $result;
			}
			else {
				return false;
		 	}
		}

		/* Login */
		public function login($email, $password){
			$conn = db();
			$password = md5($password);
			$sql = "SELECT id from users WHERE (email='$email' or nama='$email') and password='$password'";

			//checking if the username is available in the table
			$result    = $conn->query($sql) or die($conn->error);
			$user_data = $result->fetch_array();
			$count_row = $result->num_rows;

			if ($count_row == 1) {
				// this login variable will use for the session thing
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $user_data['id'];
				return true;
			}
			else{
				return false;
			}
		}

		/* Showing full name */
		public function get_fullname($uid)
		{
			$conn = db();
			$sql="SELECT nama FROM users WHERE id = $uid";
			$result = $conn->query($sql);
			$user_data = $result->fetch_assoc();
			echo $user_data['nama'];
		}

		/* Get session */
		public function get_session()
		{
			return $_SESSION['login'];
		}

		public function logout()
		{
			$_SESSION['login'] = false;
			session_destroy();
		}
	}
?>