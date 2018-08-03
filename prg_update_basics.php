<?php session_start();

include("db_config.php");



function filter_form_values($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$buy_price = $sell_price = $stock = $tax = 0;
$product_title = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name 		= filter_form_values($_POST["comp_name"]);
	$gst 		= filter_form_values($_POST["comp_gst"]);
	$pan 		= filter_form_values($_POST["comp_pan"]);
	$phone1 	= filter_form_values($_POST["comp_ph1"]);
	$phone2 	= filter_form_values($_POST["comp_ph2"]);
	$email 		= filter_form_values($_POST["comp_mail"]);
	$website 	= filter_form_values($_POST["comp_url"]);
	$street 	= filter_form_values($_POST["comp_addr_strt"]);
	$city 		= filter_form_values($_POST["comp_addr_cty"]);
	$district 	= filter_form_values($_POST["comp_addr_dist"]);
	$state 		= filter_form_values($_POST["comp_addr_st"]);
	$statecode 	= filter_form_values($_POST["state_code"]);
	$country 	= filter_form_values($_POST["comp_addr_nat"]);
	$pin 		= filter_form_values($_POST["comp_addr_pin"]);
	$password   = filter_form_values($_POST["comp_password"]);
	$bankname 	= filter_form_values($_POST["comp_bank_name"]);
	$bankaccno 	= filter_form_values($_POST["comp_bank_accno"]);
	$bankifsc   = filter_form_values($_POST["comp_bank_ifsc"]);


	$add_basics_bfor_query = "SELECT * FROM `company`;";
	$result = $conn->query($add_basics_bfor_query);

	if($result->num_rows>0){

		$update_basics_url_query = "UPDATE `company` SET `name` = '".$name."', `gst` = '".$gst."', `pan` = '".$pan."', `phone1` = '".$phone1."', `phone2` = '".$phone2."', `email` = '".$email."', `website` = '".$website."', `street` = '".$street."', `city` = '".$city."', `district` = '".$district."', `state` = '".$state."', `statecode` = '".$statecode."', `country` = '".$country."', `pin` = '".$pin."', `bankname` = '".$bankname."', `bankaccno` = '".$bankaccno."', `bankifsc` = '".$bankifsc."', `password` = '".$password."', `updated` = '".date("Y-m-d")."' WHERE `company`.`id` = 1;";
		$update_result = $conn->query($update_basics_url_query);
		if($update_result === TRUE){
			echo 2;
		}

	}
	else{

		$add_basics_url_query = "INSERT INTO `company` (`name`, `gst`, `pan`, `phone1`, `phone2`, `email`, `website`, `street`, `city`, `district`, `state`, `statecode`, `country`, `pin`, `bankname`, `bankaccno`, `bankifsc`, `password`, `created`, `updated`) VALUES ('".$name."', '".$gst."', '".$pan."', '".$phone1."', '".$phone2."', '".$email."', '".$website."', '".$street."', '".$city."', '".$district."', '".$state."', '".$statecode."', '".$country."', '".$pin."', '".$bankname."', '".$bankaccno."', '".$bankifsc."', '".$password."', '".date("Y-m-d")."', '".date("Y-m-d")."');";
		$add_result = $conn->query($add_basics_url_query);
		if($add_result === TRUE){
			echo 1;
		}

	}
}


$conn->close(); 

?>