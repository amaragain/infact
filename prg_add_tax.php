<?php session_start();

include("db_config.php");

//print_r($_POST);

$tax_value = 0;
$tax_title = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$tax_title 	= filter_form_values($_POST["tax-title"]);
	$tax_value	= filter_form_values($_POST["tax-value"]);


	$tax_add_query = "INSERT INTO `tax` (`title`, `value`,`created`, `updated`) VALUES ('".$tax_title."', ".$tax_value.", '".date("Y-m-d")."', '".date("Y-m-d")."');";
	$result = $conn->query($tax_add_query);

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