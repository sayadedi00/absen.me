<?php
		
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';

	$conn = db();
	$sql = "SELECT * FROM `users` WHERE nama = '' and fingerprint_id=0";

	$check = $conn->query($sql);

	$count = 0;
	while($row = $check->fetch_array()){
		if($count == 1){
			break;
		}

		$id = $row['id'];

		$sql = "UPDATE `users` SET `fingerprint_id`='$id', `date`=NOW() WHERE id='$id'";
		$data = $conn->query($sql);

		echo $id;

		$count++;
	}

	if($check->num_rows == 0){
		echo "NONE";
	}
?>