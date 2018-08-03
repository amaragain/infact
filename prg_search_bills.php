<?php include("db_config.php");?>

<?php


//print_r($_POST);


$search_by 			= "";
$search_string 		= "";
$search_month 		= "";
$search_year 		= "";
$search_billtype 	= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$search_by 			= filter_form_values($_POST['search-by']);
	$search_string 		= filter_form_values($_POST['search-string']);
	$search_month 		= filter_form_values($_POST['search-month']);
	$search_year 		= filter_form_values($_POST['search-year']);
	$search_billtype 	= filter_form_values($_POST['search-billtype']);


	$fetch_report_query = "SELECT * FROM `bill` WHERE `created`!=0 AND `".$search_by."` LIKE '%".$search_string."%' AND MONTH(created) = ".$search_month." AND YEAR(created) = ".$search_year." AND `type`=".$search_billtype." ORDER BY `id` DESC;";
	$result = $conn->query($fetch_report_query);

	$bill_row = '';

	if($result->num_rows>0){
		while($rows = $result->fetch_assoc()){

			$id	 			= $rows["id"];
			$bill_num	 	= $rows["bill_no"];
			$cust_name	 	= $rows["cust_name"];
			$cust_state 	= $rows['cust_state'];
			$cust_gst 		= $rows['cust_gst'];
			$type 			= $rows["type"];
			$amount 		= $rows["amount"];
			$paid 			= $rows["paid"];
			$created 		= $rows["created"];
			$bill_url 		= $rows["file_url"];
			$creditbill 	= $rows["creditbill"];
			$due_date 		= $rows["duedate"];

			$remaining 		=  $amount - $paid;

			if($due_date == ''){$due_date = date('d-m-Y');}

			if($type == 1){$bill_type = "B2B"; $bill_no_prefix = 'S';}
			else if($type == 2){$bill_type = "B2C"; $bill_no_prefix = 'SE';}
			else{$bill_type = "";}

			if($creditbill == 1){
				$credit_color = 'warning'; $show_credit_edit = ""; $credit_debit = 0;
			}
			else{
				$credit_color = 'info'; $show_credit_edit = "visibility: hidden;"; $credit_debit = 1;
				$due_date = '--';
			}

			$bill_row .= '
			<tr>
		        <td style="text-align: center;">'.$bill_no_prefix.' '.$bill_num.'</td>
		        <td style="text-align: center;">'.$created.'</td>
		        <td style="text-align: left;">'.$cust_name.'</td>
		        <td style="text-align: left;">'.$cust_gst.'</td>
		        <td style="text-align: center;">'.$bill_type.'</td>
		        <td style="text-align: right;">'.$amount.'</td>
		        <td style="text-align: right;">'.$remaining.'</td>
		        <td style="text-align: right;" class="paid-row-'.$id.'">
		        	'.$paid.' <button style="'.$show_credit_edit.'" onclick="editPaid('.$id.','.$paid.')" class="btn btn-default btn-xs"><i class="fa fa-pencil text-primary"></i></button>
		        </td>
		        <td style="text-align: center;" class="due-date-row-'.$id.'">
		        	'.$due_date.'			 
			        <button style="'.$show_credit_edit.'" onclick="editDueDate('.$id.',\''.$due_date.'\')" class="btn btn-default btn-xs"><i class="fa fa-pencil text-primary"></i></button>
		        </td>
		        <td style="text-align: center;">
		        	<button onclick="creditBill('.$id.','.$credit_debit.')" class="btn btn-'.$credit_color.' btn-xs"><i class="fa">Cr</i></button>
		        	<a title="View Bill" href="edit_bill.php?id='.$id.'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a> 
		        	<button title="Delete Bill" class="btn btn-danger btn-xs" onclick="deletBill('.$id.')"><i class="fa fa-times"></i></button>
		        </td>
	        </tr>
	        ';
		}
		echo $bill_row;
	}
	else{
		echo '<tr><th colspan="10" class="text-center"> No Result </th></tr>';
	}


}





function filter_form_values($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
