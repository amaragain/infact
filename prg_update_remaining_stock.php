<?php

	include("db_config.php");

	//print_r($_POST);

	//print_r($_POST['items']);

/*
	foreach ($_POST as $value) {
		# code...
		print_r($value->id);
		foreach ($value as $key1 => $value1) {
			# code...
			print_r($key1 . '===' . $value1);
		}
	}*/

	/*$update_qty_query = "UPDATE `products` SET `stock`=`stock`-".$item_qty." WHERE `id`=".$item_id.";";
	$result_update_qty = $conn->query($update_qty_query);
	*/


foreach(json_decode($_POST['items']) as $key){
	

		$item_id 	= $key->id;
		$item_qty 	= $key->qty;

		$update_qty_query = "UPDATE `products` SET `stock`=`stock`-".$item_qty." WHERE `id`=".$item_id.";";
		$result_update_qty = $conn->query($update_qty_query);
		if($result_update_qty === TRUE){
			echo 1;
		}
		else{
			echo 0;
		}


}


?>