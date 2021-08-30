<?php
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
	$date['center_night'] = strtotime($date['center_no_2']);
?>