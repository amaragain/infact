<?php 
	session_start();
	if(!isset($_SESSION['user'])) {
		header("location: login.php");
	}
	else {
		header("location: billing.php");
	}
?>

<?php include("header.php");?>

<?php include("footer.php");?>