<?php session_start();

include("db_config.php");

$id = $_POST['id'];

$delete_bill_query = "DELETE FROM `bill` WHERE `id`=".$id.";";
$result = $conn->query($delete_bill_query);

if ($result===TRUE) {
	echo 1;
}
else{
	echo 0;
}



?>
<?php $conn->close(); ?>