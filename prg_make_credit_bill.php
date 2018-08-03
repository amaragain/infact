<?php

	include("db_config.php");

	//print_r($_POST);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$bill_no 		= filter_form_values($_POST['id']);
		$creditbill 		= filter_form_values($_POST['creditbill']);

		if($creditbill == 0){ $more_fields =  ', `duedate`=""'; }
		else{$more_fields = '';}

		$save_query = "UPDATE `bill` SET `creditbill` = ".$creditbill." ".$more_fields." WHERE `bill`.`id` = ".$bill_no.";";
		$result = $conn->query($save_query);

		if($result === TRUE){
			echo 1;
		}
		else{
			echo 0;
		}
	}


function filter_form_values($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>