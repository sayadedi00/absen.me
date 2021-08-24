<?php
    //Start a session
    session_start();

    //Includes
    include $_SERVER['DOCUMENT_ROOT'].'/includes/users/class.user.php';
    include $_SERVER['DOCUMENT_ROOT'].'/includes/class.loading.php';

    //Check if login or not
    if(!isset($_SESSION['login'])){
      route("auth");
    }

    $loader = new Loading();
    $user = new User();
?>