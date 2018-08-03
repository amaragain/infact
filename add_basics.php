<?php include("header.php");?>

<?php

$name = $phone1 = $phone2 = $email = $website = $street = $city = $district = $state = $country = "";
$pin = 0;


$fetch_basics_query = "SELECT * FROM `company`;";
$result = $conn->query($fetch_basics_query);

if($result->num_rows>0){
	while($rows = $result->fetch_assoc()){

		$name 		= $rows['name'];
		$gst 		= $rows['gst'];
		$pan 		= $rows['pan'];
		$phone1 	= $rows["phone1"];
		$phone2 	= $rows["phone2"];
		$email 		= $rows["email"];
		$website 	= $rows["website"];
		$street 	= $rows["street"];
		$city 		= $rows["city"];
		$district 	= $rows["district"];
		$state 		= $rows["state"];
		$statecode 	= $rows['statecode'];
		$country 	= $rows["country"];
		$pin 		= $rows["pin"];
		$logo 		= $rows["logo"];
		$password 	= $rows["password"];
		$bankname 	= $rows["bankname"];
		$bankaccno 	= $rows["bankaccno"];
		$bankifsc 	= $rows["bankifsc"];
	}
}

?>
<?php $conn->close(); ?>

<div class="container-fluid">
	<div class="container bill-cont">

		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Add / Edit Basic Details</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="addBasicDetails" action="prg_update_basics.php" enctype="multipart/form-data" method="post">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Company Name</label>
								<input type="text" required="true" class="form-control" id="taxName" placeholder="Enter Company Name" name="comp_name" value="<?php echo $name;?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="gstNo">GST No</label>
								<input type="text" required="true" class="form-control" id="gstNo" placeholder="Enter GST Number" name="comp_gst" value="<?php echo $gst;?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="panNo">PAN No</label>
								<input type="text" required="true" class="form-control" id="panNo" placeholder="Enter PAN Number" name="comp_pan" value="<?php echo $pan;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Phone 1</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Phone Number" name="comp_ph1" value="<?php echo $phone1;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Phone 2</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Phone Number" name="comp_ph2" value="<?php echo $phone2;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Email</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Email Address" name="comp_mail" value="<?php echo $email;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Website</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Website URL" name="comp_url" value="<?php echo $website;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Street Address</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Street Address" name="comp_addr_strt" value="<?php echo $street;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">City</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter City" name="comp_addr_cty" value="<?php echo $city;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">District</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter District" name="comp_addr_dist" value="<?php echo $district;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">State</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter State" name="comp_addr_st" value="<?php echo $state;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="stateCode">State Code</label>
								<input type="number" required="true" class="form-control" id="stateCode" placeholder="Enter State Code" name="state_code" value="<?php echo $statecode;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">Country</label>
								<input type="text" class="form-control" id="taxName" placeholder="Enter Country" name="comp_addr_nat" value="<?php echo $country;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="taxName">PIN </label>
								<input type="number" class="form-control" id="taxName" placeholder="Enter PIN" name="comp_addr_pin" value="<?php echo $pin;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="bankname">Bank Name </label>
								<input type="text" class="form-control" id="bankname" placeholder="Enter Bank Name" name="comp_bank_name" value="<?php echo $bankname;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="bankaccno">Bank Account Number </label>
								<input type="text" class="form-control" id="bankaccno" placeholder="Enter Bank Account Number" name="comp_bank_accno" value="<?php echo $bankaccno;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="bankifsc">Bank Branch IFSC Code </label>
								<input type="text" class="form-control" id="bankifsc" placeholder="Enter Bank Branch IFSC Code" name="comp_bank_ifsc" value="<?php echo $bankifsc;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="Password">Password </label>
								<input type="Password" class="form-control" id="Password" placeholder="Enter New Password" name="comp_password" value="<?php echo $password;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-warning pull-right">Submit</button>
						</div>
						<div class="col-md-5">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<form id="logoImgForm">
							<h4>Add or Change Logo </h4>
							<img id="companyLogoImg" src="<?php echo $logo;?>" class="img-responsive"><br>
							<input id="logoUpload" type="File" name="imgtoadd[]" />
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>
							Fill these options. This will be shown in the bill generated.
						</p>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-md-12">
						<label for="billStartCount">First Bill Number</label>
						<input type="number" min="1" id="billStartCount" placeholder="First Bill No." value="1">
						<button class="btn btn-danger" onclick="resetBills()">
							Reset Bills
						</button>
					</div>
				</div>

			</div>
		</div>




	</div>
</div>

<?php include("footer_scripts.php");?>



<script type="text/javascript">

	function refreshPage(){
		location.reload();
	}

    var frm = $('#addBasicDetails');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                //alert(data);
                if(data == 1){
                	//alert('Success.')
                	refreshPage();
                }
                else if(data == 2){
                	//alert('Success.')
                	refreshPage();
                }
                else{
                	alert("Oops! Something went wrong.")
                }
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });
</script>

<script type="text/javascript">
	

$('input[id=logoUpload]').on('change',function(event)
{
   $('form#logoImgForm').submit();
})



$("form#logoImgForm").submit(function(){

    $(".loading-overlay").fadeIn();

    var formData = new FormData($(this)[0]);
    //$('#bannerImg').css('backgroundImage','url(images/misc/loader.gif)')
    $.ajax({
        url: 'prg_update_logo.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          //alert(data);
            if(data!=0){
            	$('#companyLogoImg').attr("src",data)
            }
            else{
            	alert("Oops!. Something went wrong.");
            }
        },
        cache: false,
        contentType: false,
        processData: false

    });
    return false;
});




function resetBills(){

	var connfirmDelete = confirm("Are you sure? This will remove all the bills from the software.");
	if (connfirmDelete == true) {
		//alert(1)
		var billStartCount = $('#billStartCount').val() - 1;
		$.post('prg_reset_bills.php',{billNo:billStartCount},function(data){
			if(data==1){
				alert('The Bills are reset');
				refreshPage();
			}
			else{
				alert('Sorry! Somethiung went wrong. Please try again.');
			}
		});
	}
}


/*function resetStock(){

	var connfirmDelete = confirm("Are you sure? This will remove all products and other settings from the software.");
	if (connfirmDelete == true) {
		$.post('prg_reset_stock.php',{id:x},function(data){
			//alert(data);
			if(data==1){
				refreshPage();
			}
}*/

</script>

<?php include("footer.php");?>