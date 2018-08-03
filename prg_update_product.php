<?php session_start();

include("db_config.php");

//print_r($_POST);

$buy_price = $sell_price = $stock = $tax = 0;
$product_title = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$prd_id 		= filter_form_values($_POST['prd-id']);
	$uniq_code 		= filter_form_values($_POST["prd-unq-code"]);
	$product_title 	= filter_form_values($_POST["prd-title"]);
	$buy_price 		= filter_form_values($_POST["buy-price"]);
	$sell_price 	= filter_form_values($_POST["sell-price"]);
	$stock 			= filter_form_values($_POST["stock"]);
	$tax 			= filter_form_values($_POST["tax"]);


	$product_add_query = "UPDATE `products` SET `uniqueid` = '".$uniq_code."', `title` = '".$product_title."', `buy_price` = '".$buy_price."', `sell_price` = '".$sell_price."', `stock` = '".$stock."', `tax` = '".$tax."', `updated` = '".date("Y-m-d")."' WHERE `products`.`id` = ".$prd_id.";";
	$result = $conn->query($product_add_query);

	if ($result === TRUE) {
	    echo "1";
	} else {
	    echo "0";
	}

}


function filter_form_values($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

<?php $conn->close(); ?>