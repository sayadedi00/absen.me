<?php

function VisitorIP()
{ 
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else 
		$ip = $_SERVER['REMOTE_ADDR'];
		
 	return trim($ip);
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);
}

function generateRandomStrings($length = 10) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklomnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil($length/strlen($x)) )),1,$length);
}

function escapeString($strings)
{
	htmlspecialchars($strings, ENT_QUOTES, 'UTF-8');
	$strings = filter_var($strings, FILTER_SANITIZE_STRING);
	$strings = str_replace("<", "", $strings);
	$strings = str_replace("'", "", $strings);
	return $strings;
}

function route($string)
{
	header("Location: /$string");
	die();
}

function CheckLogin()
{
	if($_SESSION['login']){
		route("dashboard");
	}
	else{
		route("auth");
	}
}

?>