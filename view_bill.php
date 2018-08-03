<?php include("header.php");?>

<?php

$bill_no = $_GET['id']; 

$fetch_bill_query = "SELECT * FROM `bill` WHERE `id`=".$bill_no.";";
$result = $conn->query($fetch_bill_query);

$bill_row = '';

if($result->num_rows>0){
	while($rows = $result->fetch_assoc()){

		$cust_name	 	= $rows["cust_name"];
		$cust_state 	= $rows['cust_state'];
		$type 			= $rows["type"];
		$amount 		= $rows["amount"];
		$created 		= $rows["created"];
		$bill_url 		= $rows["file_url"];

		if($type == 1){$bill_type = "Tax Bill";}
	}
}

?>


<div class="container-fluid">
	<div class="container bill-cont bg-white mar-v50">

		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Bill No: <?php echo $bill_no;?></h2>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<?php include('bills/'.$bill_no.'.txt');?>
			</div>
		</div>
	</div>
</div>


<?php include("footer_scripts.php");?>


<script type="text/javascript">
	
	function deletBill(x){

		var promptBox = confirm("Are you sure, you want to delete this bill?");

		if (promptBox == true) {
			$.post(
				'prg_delete_bill.php',
				{
					id: x
				},
				function(data){
					if(data == 1){
						location.reload();
					}
					else{
						alert('Oops! Something went wrong. Please try again.')
					}
				}
			);
		} 

	}

</script>


<?php include("footer.php");?>