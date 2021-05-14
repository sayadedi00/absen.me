<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';

	$user = new User();
	$user->logout();

	route("index");
?>