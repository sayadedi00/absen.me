<?php  
	include $_SERVER['DOCUMENT_ROOT'].'/settings.php';

	class User{
		public $db;

		/* Registration*/
		public function register($id, $name, $password, $email, $admin){
			$conn = db();
			$password = md5($password);
			$sql = "SELECT * FROM users WHERE nama='$name' OR email='$email'";

			//Check user available in DB
			$check = $conn->query($sql);
			$count_row = $check->num_rows;

			if ($check->num_rows == 0){
				$sql = "UPDATE `users` SET `nama`=$name,`email`=$email,`password`='$password',`admin`='$admin' WHERE id=$id";
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

		public function get_admin($uid)
		{
			$conn = db();
			$sql="SELECT admin FROM users WHERE id = $uid";
			$result = $conn->query($sql);
			$user_data = $result->fetch_assoc();
			return $user_data['admin'];
		}


		public function get_jabatan($uid)
		{
			$conn = db();
			$sql="SELECT jabatan FROM users WHERE id = $uid";
			$result = $conn->query($sql);
			$user_data = $result->fetch_assoc();
			echo $user_data['jabatan'];
		}
		
		/* Get session */
		public function get_session()
		{
			return $_SESSION['login'];
		}

		public function delete($id)
		{
			$conn = db();
			$sql = "UPDATE `users` SET `nama`='',`email`='',`password`='',`admin`=0,`jabatan`='Karyawan',`fingerprint_id`='0',`date`='',`gender`=0, `delete_id`='$id' WHERE id='$id'";
			$conn->query($sql);
			$sql = "DELETE FROM `absent` WHERE user_id='$id'";
			$conn->query($sql);
		}

		public function checkAvail($query)
		{
			$conn = db();
			$sql = "SELECT * FROM users WHERE $query";

			$data = $conn->query($sql);

			return $data->num_rows;
		}

		public function logout()
		{
			$_SESSION['login'] = false;
			session_destroy();
		}
	}
?>