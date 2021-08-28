<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';

	if(!isset($_GET['id'])){
		route("dashboard");
	}

	$id = escapeString($_GET['id']);

	if($user->checkAvail("fingerprint_id='$id' AND nama!=''") > 0){
		$user->delete($id);
		route("dashboard/users?success");
	}
	else{
		route("dashboard/users?failed-id");
	}
?>