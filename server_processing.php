<?php //session_start();

include("db_config.php");

//print_r($_POST);

$table_data = "";


$fetch_ttl_count = "SELECT * FROM `products`;";
$result_ttl_count = $conn->query($fetch_ttl_count);
$ttl_count = $result_ttl_count->num_rows;


$fetch_prd_query = "SELECT * FROM `products` ORDER By `id` DESC LIMIT 10;";
$result = $conn->query($fetch_prd_query);

$recordsFiltered = $result->num_rows;
$count_row = 0;

if ($result->num_rows > 0) {

    $table_data .= '{  "draw": 1,  "recordsTotal": '.$ttl_count.',  "recordsFiltered": '.$recordsFiltered.',  "data": [';

    while($row = $result->fetch_assoc()) {

      $count_row = $count_row + 1;
      $table_data .= ' ["'.str_pad($row["id"], 4, '0', STR_PAD_LEFT).'","'.$row["title"].'","'.$row["buy_price"].'","'.$row["sell_price"].'","'.$row["stock"].'","'.$row["tax"].'"]';
      if($count_row < $recordsFiltered)
      {
        $table_data .= ",";
      }

    }

    $table_data .= ']}';


}

echo $table_data;

/*else {

}
*/
?>







