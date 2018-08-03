<?php

	include("db_config.php");

	//print_r($_POST);

	$bill_no 	= $_POST['id'];
	$paid 		= $_POST['paid'];

	$update_query = "UPDATE `bill` SET `paid` = '".$paid."' WHERE `bill`.`id` = ".$bill_no.";";
	$result = $conn->query($update_query);

	if($result === TRUE){
		echo 1;
	}
	else{
		echo 0;
	}



?>