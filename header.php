<?php
include_once("./database/constants.php");
include_once("./includes/DBOperation.php");
//echo basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION["userid"]) && basename($_SERVER['PHP_SELF'])!="index.php" && basename($_SERVER['PHP_SELF'])!="register.php") {
	header("location:".DOMAIN."/");
	//header("location:".DOMAIN."/dashboard.php");
}

if (isset($_SESSION["userid"]) && basename($_SERVER['PHP_SELF'])=="index.php") {
	header("location:".DOMAIN."/dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo COMPANY_NAME;?></title>
	<link rel="shortcut icon" href="./fav.ico">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="./assets/fontawesome-free-5.9.0-web/css/font-awesome.css">
 	<link rel="stylesheet" type="text/css" href="./includes/style.css">
	<script type="text/javascript">var _sitebaseurl = "<?= DOMAIN ?>";</script>
 	<script type="text/javascript" rel="stylesheet" src="./js_layer/main.js"></script>
	<script type="text/javascript" src="./js_layer/manage.js"></script>


 </head>
<body>
	<!-- Navbar -->
	<?php include_once("./templates/header.php"); ?>