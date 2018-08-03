<?php

	include("db_config.php");

	$first_bill_no = $_POST['billNo'];

	$bill_truncate_query = "TRUNCATE TABLE `bill`";

	$result = $conn->query($bill_truncate_query);

	if ($result === TRUE) {

			$next_row_query = "INSERT INTO `bill` (`id`, `bill_no`, `cust_name`, `cust_state`, `type`, `amount`, `created`, `file_url`, `remarks`) VALUES (NULL, ".$first_bill_no.", '', '', '', '', '', '', '');";
			$next_result = $conn->query($next_row_query);
			
			if($next_result === TRUE){
				echo "1";
			}
			else{
				echo "0";
			}


	} else {
	    echo "0";
	}

?>