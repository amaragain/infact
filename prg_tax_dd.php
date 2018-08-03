<?php session_start();

include("db_config.php");

$fetch_tax_query = "SELECT * FROM `tax` ORDER By `value` ASC;";
$result = $conn->query($fetch_tax_query);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

    	if($row["value"]==0){$selected_dd = "selected";}
    	else{$selected_dd = "";}

    	$tbody .= '<option value="'.$row["id"].'" '.$selected_dd.'>'.$row["value"].'%</option>';

    }
}

echo $tbody;


$conn->close(); 

?>