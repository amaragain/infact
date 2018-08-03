<?php

	//print_r($_POST);

	$bill 		= $_POST['bill'];
	$bill_no 	= $_POST['billno'];

	$file_name = 'bills/'.$bill_no.'.txt';

	$myfile = fopen($file_name, "w") or die("Unable to open file!");

	fwrite($myfile, $bill);

	fclose($myfile);

?>