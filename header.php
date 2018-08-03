<?php 
	session_start();
	if(!isset($_SESSION['user'])) {
		header("location: login.php");
	}


?>
<?php include("db_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>Billing Software</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap-3.3.7.css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" media="screen" type="text/css" href="css/datepicker-ui.css" />
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="body-bg">

<header class="hdr-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="img/logo.jpg" class="logo-img img-responsive"/>
			</div>
			<div class="col-md-8">
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <ul class="nav navbar-nav pull-right">

						<li><a href="billing.php" class="btn btn-xs btn-warning text-white">Billing</a></li>
						<li><a href="add_stock.php" class="btn btn-xs btn-warning text-white">Add Stock</a></li>
						<li><a href="product_list.php" class="btn btn-xs btn-warning text-white">All Products</a></li>
						<li><a href="bill_reports.php" class="btn btn-xs btn-warning text-white">All Bills</a></li>
						<li><a href="add_tax.php" class="btn btn-xs btn-warning text-white">Add Tax</a></li>
						<li><a href="add_basics.php" class="btn btn-xs btn-warning text-white">Customization</a></li>
						<li><a href="logout.php" class="btn btn-xs btn-warning text-white">Logout</a></li>

				    </ul>
				  </div>
				</nav>
			</div>
		</div>
	</div>
</header>	

