<?php //session_start();

include("db_config.php");

$prd_id = $_POST['id'];

$delete_query = "DELETE FROM `products` WHERE `id`=".$prd_id.";";
$result_delete_query = $conn->query($delete_query);

if($result_delete_query === TRUE){
	echo 1;
}
else{
	echo 0;
}

$conn->close(); 

?>