<?php
		
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dates.php';

	$user = new User();
	$conn = db();

	$select = $conn->query("SELECT * FROM users WHERE fingerprint_id!=0 AND nama!=''");

	while($row = $select->fetch_array()){
		$id = $row['fingerprint_id'];

		$absent = $conn->query("SELECT * FROM absent WHERE `tanggal` >= '".$date['morning']."' AND user_id='$id' AND `day`='0'");
		if($absent->num_rows == 0 && $date['now_timestamp'] >= $date['center']){
			$late = $date['afternoon_timestamp'] - $date['morning_timestamp'];
			$conn->query("INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['morning']."', 'Tidak Hadir', '$late', 0)");
		}

		$absent = $conn->query("SELECT * FROM absent WHERE tanggal >= '".$date['afternoon']."' AND user_id='$id' AND `day`='1'");
		if($absent->num_rows == 0 && $date['now_timestamp'] >= strtotime($date['center_no_2'])){
			$late = $date['center_night'] - $date['afternoon_timestamp'];
			$conn->query("INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['afternoon']."', 'Tidak Hadir', '$late', 1)");
		}
	}
?>