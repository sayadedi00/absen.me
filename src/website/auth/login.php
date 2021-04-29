<?php 
	session_start(); 
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';

	if (isset($_POST['email'])) {

		$email = escapeString($_POST['email']);
		$password = escapeString($_POST['password']);
		$user = new User();
		
		$login = $user->login($email, $password);

		if ($login) {
			echo "success";
		}
	}
?>