<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      $loader->addCSS("../images/loading.gif");

      $conn = db();
      $sql = "SELECT * FROM users WHERE fingerprint_id!=0 AND nama=''";

      $count = $conn->query($sql);
      $count = $count->num_rows;
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php
      echo $site['name']." - ";
      if(isset($title)){
        echo $title;
      }
      else{
        echo 'Arduino based attendance system';
      }
    ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../images/favicon.ico" />
  </head>
  <body class="sidebar-icon-only">
    <?php $loader->addBody(); ?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="/"><img src="../images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="/"><img src="../images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../images/faces/tenor.png.gif" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $user->get_fullname($_SESSION['uid']); ?></p>
                </div>
              </a>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="logout">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="/dashboard/" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../images/faces/tenor.png.gif" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $user->get_fullname($_SESSION['uid']); ?></span>
                  <span class="text-secondary text-small"><?php echo $user->get_jabatan($_SESSION['uid']); ?></span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dashboard/">
                <span class="menu-title">Halaman utama</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <?php if($user->get_admin($_SESSION['uid']) == 1){ ?>
            <li class="nav-item">
              <a class="nav-link" href="register-user">
                <span class="menu-title">Daftarkan (<?php echo $count; ?>)</span>
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users">
                <span class="menu-title">List user</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="https://github.com/sayadedi00/absen.me">
                <span class="menu-title">Github</span>
                <i class="mdi mdi-github-circle menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-logout menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>