<?php
		
	include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dates.php';

	$user = new User();
	
	if(!isset($_GET['id'])){
		echo "id tidak valid";
		die();
	}
	$id = escapeString($_GET['id']);
	if($user->checkAvail("fingerprint_id='$id' AND nama=''") > 0){
		echo "id tidak ditemukan";
		die();
	}

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
			echo $data['nama']." sudah absen masuk";
			die();
		}
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Hadir', 0, '0')";
		echo $data['nama'];
	}
	else if($date['now_timestamp'] >= $date['morning_late'] && $date['now_timestamp'] <= $date['afternoon_timestamp']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=0 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen masuk";
			die();
		}
		$late = $date['now_timestamp'] - $date['morning_late'];
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Terlambat', '$late', '0')";

		$input = $conn->query($sql);
		echo $data['nama']." anda telat";
	}
	else if($date['now_timestamp'] <= $date['afternoon_late'] && $date['now_timestamp'] >= $date['afternoon_timestamp']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=1 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen pulang";
			die();
		}
		$sql = "INSERT INTO `absent`(`user_id`, `tanggal`, `type`, `late`, `day`) VALUES ('$id', '".$date['now']."', 'Hadir', 0, '1')";
		echo $data['nama'];
	}
	else if($date['now_timestamp'] >= $date['afternoon_late'] && $date['now_timestamp'] <= $date['center_night']){
		$check = "SELECT * FROM absent WHERE `tanggal` > now() - INTERVAL 12 HOUR AND day=1 AND user_id='$id'";
		$check = $conn->query($check);

		if($check->num_rows > 0){
			echo $data['nama']." sudah absen pulang";
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
		echo "gatau gaada";
	}

?>