<?php //session_start();

include("db_config.php");

//print_r($_POST);

$table_data = "";


$fetch_ttl_count = "SELECT * FROM `products`;";
$result_ttl_count = $conn->query($fetch_ttl_count);
$ttl_count = $result_ttl_count->num_rows;


$fetch_prd_query = "SELECT * FROM `products` ORDER By `title` ASC;";
$result = $conn->query($fetch_prd_query);

$recordsFiltered = $result->num_rows;

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {


    $tax_id   = $row["tax"];

    if($tax_id != 0){
      $fetch_tax_query = "SELECT * FROM `tax` WHERE `id`= ".$tax_id.";";
      $result_tax = $conn->query($fetch_tax_query);

      if ($result_tax->num_rows > 0) {

          while($row_tax = $result_tax->fetch_assoc()) {

            $tax_title  = $row_tax["title"];
            $tax_value  = $row_tax["value"];

          }
      }
      else{
        $tax_title  = 'NA';
        $tax_value  = 0;
      }
    }
    else{
      $tax_title  = 'NA';
      $tax_value  = 0;
    }

      $table_data .= '<tr>
                        <td>'.str_pad($row["uniqueid"], 4, '0', STR_PAD_LEFT).'</td>
                        <td>'.$row["title"].'</td>
                        <td align="right">'.$row["buy_price"].'</td>
                        <td align="right">'.$row["sell_price"].'</td>
                        <td align="right" id="prdTd'.$row["id"].'">'.$row["stock"].' &nbsp;<input type="text" size="1" value="0" class="new-stock-in" id="newStock'.$row["id"].'"> &nbsp;<button data-prd-id="'.$row["id"].'" class="btn btn-default btn-xs stock-add-btn"><i class="fa fa-plus text-primary"></i></button></td>
                        <td align="center">'.$tax_value.'%</td>
                        <td align="center">
                          <a href="edit_stock.php?id='.$row["id"].'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-warning btn-xs" onclick="removeStock('.$row["id"].')"><i class="fa fa-remove"></i></button>
                        </td>
                      </tr>';

    }

    echo $table_data;
}

else {
    echo  '<tr>
            <td colspan="7" align="center">There are no products available. Please add products. <a href="add_stock.php">Add products</a></td>
          </tr>';
}


$conn->close();

?>