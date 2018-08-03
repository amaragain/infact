<?php

	include("db_config.php");

	//print_r($_POST);

	$custname = $custstate = "";
	$billtype = $billamount	= 0;


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//$bill_no 		= filter_form_values($_POST['billno']);
		$bill_number 	= filter_form_values($_POST['billnumber']);
		$custname 		= filter_form_values($_POST['custname']);
		$custstate 		= filter_form_values($_POST['custstate']);
		$state_code 	= filter_form_values($_POST['statecode']);
		$custaddress    = filter_form_values($_POST['custaddress']);
		$custphone 		= filter_form_values($_POST['custphone']);
		$billtype 		= filter_form_values($_POST['billtype']);
		$billamount 	= filter_form_values($_POST['billamount']);
		$billname 		= filter_form_values($_POST['billname']);
		$custgst		= filter_form_values($_POST['custgst']);
		$items			= $_POST['items'];

		$bill_id_qry = "SELECT `id` FROM `bill` ORDER BY `id` DESC LIMIT 1;";
		$bill_id_res = $conn->query($bill_id_qry);
		if($bill_id_res->num_rows>0){
			while($Bill_id_rows = $bill_id_res->fetch_assoc()){
				$bill_id = $Bill_id_rows['id'];
			}

			$save_query = "UPDATE `bill` SET 
							`bill_no` = '".$bill_number."',
							`cust_name` = '".$custname."', 
							`cust_state` = '".$custstate."', 
							`state_code`='".$state_code."', 
							`cust_gst` = '".$custgst."',
							`cust_address`='".$custaddress."',
							`cust_phone`='".$custphone."',
							`type` = '".$billtype."', 
							`amount` = '".$billamount."', 
							`paid` = '".$billamount."', 
							`items`='".$items."', 
							`created` = '".date('Y-m-d')."', 
							`file_url` = '".$billname."' 
							WHERE `bill`.`id` = ".$bill_id.";";
			$result = $conn->query($save_query);


			if($result === TRUE){
				$next_row_query = "INSERT INTO `bill` (`id`, `cust_name`, `cust_state`, `type`, `amount`, `created`, `file_url`, `remarks`) VALUES (NULL, '', '', '', '', '', '', '');";
				$conn->query($next_row_query);
				echo 1;
			}
			else{
				echo 0;
			}

		}
		else{

			$next_row_query = "INSERT INTO `bill` (`id`, `cust_name`, `cust_state`, `type`, `amount`, `created`, `file_url`, `remarks`) VALUES (NULL, '', '', '', '', '', '', '');";
			$conn->query($next_row_query);
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