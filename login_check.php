<?php session_start();

	include("db_config.php");

	//print_r($_POST);

	if($_POST["pwd"])
	{

		$password = $_POST["pwd"];

		$login_query = 'SELECT * FROM `company` WHERE `password`= "'.$password.'";';
		$result = $conn->query($login_query);

		echo $result->num_rows;

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$_SESSION['user'] = $row["id"];
		    }
			//echo "1";
		}
		else {
			//echo "2";
		}

	}
	else {
		//echo "3";
	}

?>
<?php $conn->close(); ?>
