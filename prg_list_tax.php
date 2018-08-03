<?php session_start();

include("db_config.php");

$tbody = "";

$fetch_tax_query = "SELECT * FROM `tax` ORDER By `id` DESC;";
$result = $conn->query($fetch_tax_query);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

    	$tbody .= "<tr>";
    		$tbody .= "<td>" . $row["title"] . "</td>";
    		$tbody .= "<td>" . $row["value"] . "</td>";
    	$tbody .= "</tr>";

    }
}
else{

	$tbody = '<tr><th colspan="2" style="text-align: center;">No taxes created. Please add some tax values.</th></tr>';
}

echo $tbody;

$conn->close(); 

?>