<?php

include("db_config.php");

$type = $_POST['type'];

$fetch_billno_query = "SELECT `bill_no` FROM `bill` WHERE `type` = ".$type." ORDER BY `id` DESC LIMIT 1;";
$result_billno = $conn->query($fetch_billno_query);

if($result_billno->num_rows>0){
	while($rows_billno = $result_billno->fetch_assoc()){
		$bill_number = sprintf('%04u', ($rows_billno['bill_no'] + 1));
	}
}
else{ 
	$bill_number = "0001";
}


echo $bill_number;

?>