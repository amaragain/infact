<?php session_start();

include("db_config.php");


//print_r($_POST);

$buy_price = $sell_price = $stock = $tax = 0;
$product_title = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$uniq_code 		= filter_form_values($_POST["prd-unq-code"]);
	$product_title 	= filter_form_values($_POST["prd-title"]);
	$buy_price 		= filter_form_values($_POST["buy-price"]);
	$sell_price 	= filter_form_values($_POST["sell-price"]);
	$stock 			= filter_form_values($_POST["stock"]);
	$tax 			= filter_form_values($_POST["tax"]);

/*
	$check_uniqueid_query = "SELECT `uniqueid` FROM `products` WHERE `uniqueid`='".$uniq_code."';";
	$result_unique_query = $conn->query($check_uniqueid_query);
	if($result_unique_query->num_rows>0){
		echo 2;
	}
	else{*/
	$product_add_query = "INSERT INTO `products` (`uniqueid`, `title`, `buy_price`, `sell_price`, `stock`, `tax`, `created`, `updated`, `remarks`) VALUES ('".$uniq_code."', '".$product_title."', ".$buy_price.", ".$sell_price.", ".$stock.", ".$tax.", '".date("Y-m-d")."', '".date("Y-m-d")."', '');";
	$result = $conn->query($product_add_query);

	if ($result === TRUE) {
	    echo "1";
	} else {
	    echo "0";
	}
/*	}*/

}


function filter_form_values($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

<?php $conn->close(); ?>