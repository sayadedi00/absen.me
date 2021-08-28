<?php
		
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';

	$user = new User();

	if(!isset($_GET['id'])){
		echo "0";
		die();
	}
	$id = escapeString($_GET['id']);
	if($user->checkAvail("fingerprint_id='$id' AND nama=''") > 0){
		echo "0";
		die();
	}

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
	$date['center_no_2'] = date("Y-m-d 23:59:59");
	$date['center_night'] = strtotime($date['center_no_2']);

	$conn = db();

	$sql = "SELECT * FROM users WHERE id='$id'";
	$input = $conn->query($sql);
	$data = $input->fetch_array();

	if($date['now_timestamp'] >= $date['subuh'] && $date['now_timestamp'] < $date['morning']) {
		echo "Sedang tidak bekerja";
		die();
	}
	else if($date['now_timestamp'] <= $date['morning_late'] && $date['now_timestamp'] >= $date['morning_timestamp']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=0 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen";
			die();
		}
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Hadir', 0, '0')";
		echo $data['nama'];
	}
	else if($date['now_timestamp'] >= $date['morning_late'] && $date['now_timestamp'] <= $date['center']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=0 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen";
			die();
		}
		$late = $date['now_timestamp'] - $date['morning_late'];
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Terlambat', 0, '0')";

		$input = $conn->query($sql);
		echo $data['nama']." anda telat";
	}
	else if($date['now_timestamp'] <= $date['afternoon_late'] && $date['now_timestamp'] >= $date['afternoon_timestamp']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=1 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen";
			die();
		}
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Hadir', 0, '1')";
		echo $data['nama'];
	}
	else if($date['now_timestamp'] >= $date['afternoon_late'] && $date['now_timestamp'] <= $date['center_night']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=1 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen";
			die();
		}

		//Telat Sore
		$late = $date['now_timestamp'] - $date['afternoon_late'];
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Terlambat', $late, '1')";

		$input = $conn->query($sql);
		echo $data['nama']." anda telat";
		//echo gmdate("h:i:s", $date['center_night'] - $date['afternoon_late']);
	}	
	else{
		echo "0";
	}

?>