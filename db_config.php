<?php

$host 	= "localhost";
$user 	= "root";
$pass 	= "";
$db 	= "infact_billing";

$conn = new mySqli($host,$user,$pass,$db);
if($conn->connect_error)die($conn->connect_error." Error in connection");



//Defining Global Variables:
$GLOBALS['prd_code_title'] = 'HSN Code';
$GLOBALS['b2c_bill_no_prefix'] = 'SE';
$GLOBALS['b2b_bill_no_prefix'] = 'S';


?>