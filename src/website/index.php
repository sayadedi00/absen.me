<?php
	include 'settings.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Absensi online berbasis arduino yang disebarkan secara opensource.">
    <meta property="og:title" content="Abesent.me">
    <meta property="og:description" content="Absensi online berbasis arduino yang disebarkan secara opensource.">
    <meta property="og:site_name" content="Absensi">
    <title><?php echo $site['name']; ?> - Absensi Online/title>
  </head>
  <body>
  	Absensi online berbasis arduino yang disebarkan secara opensource.
  </body>
</html>
<?php
	if($_SESSION['login']){
		route("dashboard");
	}
	else{
		route("auth");
	}

?>