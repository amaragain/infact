<?php

	include("db_config.php");

	//print_r($_POST);

	$bill_no 	= $_POST['id'];
	$duedate 	= $_POST['duedate'];

	$update_query = "UPDATE `bill` SET `duedate` = '".$duedate."' WHERE `bill`.`id` = ".$bill_no.";";
	$result = $conn->query($update_query);

	if($result === TRUE){
		echo 1;
	}
	else{
		echo 0;
	}



?>