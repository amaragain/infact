<?php

	include("db_config.php");

	//print_r($_POST);

	$custname = $custstate = "";
	$billtype = $billamount	= 0;


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$bill_no 		= filter_form_values($_POST['billno']);
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

		$save_query = "UPDATE `bill` SET 
						`cust_name` = '".$custname."', 
						`bill_no` = '".$bill_number."',
						`cust_state` = '".$custstate."', 
						`state_code`='".$state_code."', 
						`cust_gst` = '".$custgst."', 
						`cust_address`='".$custaddress."',
						`cust_phone`='".$custphone."',
						`type` = '".$billtype."', 
						`amount` = '".$billamount."', 
						`items`='".$items."', 
						`created` = '".date('Y-m-d')."', 
						`file_url` = '".$billname."'
						 WHERE `bill`.`id` = ".$bill_no.";";
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