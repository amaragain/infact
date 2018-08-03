<?php

	include("db_config.php");

	//print_r($_POST);

	$id 	= $_POST['prdid'];
	$stock 		= $_POST['stock'];

	$update_query = "UPDATE `products` SET `stock` = `stock`+'".$stock."' WHERE `products`.`id` = ".$id.";";
	$result = $conn->query($update_query);

	if($result === TRUE){
		//echo 1;
		$get_query = "SELECT `stock` FROM `products` WHERE `products`.`id` = ".$id.";";
		$get_result = $conn->query($get_query);
		if($get_result->num_rows > 0){
			while($get_rows = $get_result->fetch_assoc()){
				echo $get_rows['stock'];
			}
		}
		else{
			echo 'ERR';
		}

	}
	else{
		echo 'ERR';
	}



?>