<?php
		
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';

	$user = new User();

	$date = array();
	$date['now_timestamp'] = strtotime(date("Y-m-d H:i:s"));
	$date['subuh'] = strtotime(date("Y-m-d 00:00:00"));
	$date['now'] = date("Y-m-d H:i:s");
	$date['morning'] = date("Y-m-d 07:00:00");
	$date['morning_timestamp'] = strtotime($date['morning']);
	$date['morning_late'] = strtotime("+20 minutes", strtotime($date['morning']));
	$date['center_no_1'] = date("Y-m-d 12:00:00");
	$date['center'] = strtotime($date['center_no_1']);
	$date['afternoon'] = date("Y-m-d 17:00:00");
	$date['afternoon_timestamp'] = strtotime($date['afternoon']);
	$date['afternoon_late'] = strtotime("+20 minutes", strtotime($date['afternoon']));
	$date['center_no_2'] = date("Y-m-d 23:00:00");
	$date['center_night'] = date("-1 day", strtotime($date['center_no_2']));

	$conn = db();

	$select = $conn->query("SELECT * FROM users WHERE fingerprint_id!=0 AND nama!=''");

	while($row = $select->fetch_array()){
		$id = $row['fingerprint_id'];

		$absent = $conn->query("SELECT * FROM absent WHERE `tanggal` >= '".$date['morning']."' AND user_id='$id' AND `day`='0'");
		if($absent->num_rows == 0 && $date['now_timestamp'] >= $date['center']){
			$conn->query("INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['morning']."', 'Tidak Hadir', 0, 0)");
		}

		$absent = $conn->query("SELECT * FROM absent WHERE tanggal >= '".$date['afternoon']."' AND user_id='$id' AND `day`='1'");
		if($absent->num_rows == 0 && $date['now_timestamp'] >= strtotime($date['center_no_2'])){
			$conn->query("INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['afternoon']."', 'Tidak Hadir', 0, 1)");
		}
	}
?>