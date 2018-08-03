<?php

include("db_config.php");

$prd_id 	= $_POST['prdId'];
$prd_code 	= $_POST['prdCode'];
$prd_title 	= $_POST['prdTitle'];

$title =  "";
$buy_price = $sell_price = $stock = $tax = 0;


$fetch_product_query = "SELECT * FROM `products` WHERE `id`=".$prd_id.";";
$result_prd = $conn->query($fetch_product_query);

if($result_prd->num_rows>0){
	while($rows = $result_prd->fetch_assoc()){

		$title 		= $rows['title'];
		$buy_price 	= $rows["buy_price"];
		$sell_price = $rows["sell_price"];
		$stock 		= $rows["stock"];
		$tax_id		= $rows["tax"];

		if($tax_id != 0){
			$fetch_tax_query = "SELECT * FROM `tax` WHERE `id`= ".$tax_id.";";
			$result_tax = $conn->query($fetch_tax_query);

			if ($result_tax->num_rows > 0) {

			    while($row = $result_tax->fetch_assoc()) {

			    	$tax_title 	= $row["title"];
			    	$tax_value 	= $row["value"];

			    }
			}
			else{
				$tax_title 	= 'NA';
				$tax_value 	= 0;
			}
		}
		else{
			$tax_title 	= 'NA';
			$tax_value 	= 0;
		}


	}
}



$prd_dtl_array = array("prdTitle"=>$title, "prdPrice"=>$sell_price, "stock"=>$stock, "taxTitle"=>$tax_title, "taxValue"=>$tax_value);

$prdJSON = json_encode($prd_dtl_array);

echo $prdJSON;

?>

<?php $conn->close(); ?>