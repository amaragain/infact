<?php 
	session_start();
	if(isset($_SESSION['user'])) {
		header("location: billing.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Billing Software</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<?php include("db_config.php");?>

<body class="body-bg">
	<div class="container-fluid login-page">
		<div class="container login-box">
			<div class="row">

				<div class="col-md-7">
					<div class="row">
						<div class="col-md-12 login-top-box">
							<img src="img/logo.JPG">
							<p>
								A complete billing solution for medium-scale wholesale/retail business.
							</p>
						</div>
					</div>
				</div>

				<div class="col-md-5">
					<div class="row">
						<div class="col-md-12 login-form-box">
					
							<h4>Enter Password to Login</h4>
							<form action="login_check.php" enctype="multipart/form-data" method="post" id="loginForm">
							    <div class="form-group">
							      	<input type="password" required="true" class="form-control" id="pwd" placeholder="Enter password" name="pwd" minlength="6">
							    </div>
							    <button type="submit" class="btn btn-warning form-control">Submit</button>
							</form>
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.col-md-6 -->

			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.container-fluid -->




	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>


	<script type="text/javascript">
	    var frm = $('#loginForm');

	    frm.submit(function (e) {

	        e.preventDefault();

	        $.ajax({
	            type: frm.attr('method'),
	            url: frm.attr('action'),
	            data: frm.serialize(),
	            success: function (data) {
	                //alert(data);
	                if(data == 1){
	                	window.location = "billing.php";
	                }
	                else if(data == 2){
	                	alert("Incorrect Password!. Please try again.");
	                }
	                else if(data == 3){
	                	alert("Please enter a password.");
	                }
	                else {
	                	alert("Something went wrong!.");
	                }
	            },
	            error: function (data) {
	                alert("Something went wrong.  " + data);
	            },
	        });
	    });
	</script>

</body>
</html>