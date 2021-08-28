<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';

	if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['gender'])){
		route("dashboard/register-user?failed-post");
	}

	$id = escapeString($_POST['id']);
	$nama = escapeString($_POST['name']);
	$email = escapeString($_POST['email']);
	$password = md5(escapeString($_POST['password']));
	$gender = escapeString($_POST['gender']);

	if(empty($nama) || empty($email) || empty($password)){
		route("dashboard/register-user?failed-empty");
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  	route("dashboard/register-user?failed-email");
	}

	if(strlen($password) < 8){
		route("dashboard/register-user?failed-password");
	}

	$conn = db();

	$query = "SELECT * FROM users WHERE email='$email'";
	$datas = $conn->query($query);

	if($datas->num_rows > 0){
		route("dashboard/register-user?failed-same");
	}

	$query = "UPDATE `users` SET `nama`='$nama',`email`='$email',`jabatan`='Karyawan',`password`='$password',`date`=NOW(),`gender`='$gender' WHERE `fingerprint_id` = '$id'";
	$conn->query($query);

	route("dashboard/register-user?success");

?>