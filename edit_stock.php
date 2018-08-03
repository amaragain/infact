<?php include("header.php");?>

<?php

$prd_id = $_GET['id'];

$title =  "";
$buy_price = $sell_price = $stock = $tax = 0;


$fetch_product_query = "SELECT * FROM `products` WHERE `id`=".$prd_id.";";
$result = $conn->query($fetch_product_query);

if($result->num_rows>0){
	while($rows = $result->fetch_assoc()){

		$prd_code 	= $rows["uniqueid"];
		$title 		= $rows['title'];
		$buy_price 	= $rows["buy_price"];
		$sell_price = $rows["sell_price"];
		$stock 		= $rows["stock"];
		$tax_id		= $rows["tax"];



		if($tax_id != 0){
			$fetch_tax_query = "SELECT * FROM `tax` WHERE `id`= ".$tax_id.";";
			$result_tax = $conn->query($fetch_tax_query);

			if ($result_tax->num_rows > 0) {

			    while($row = $result_tax->fetch_assoc()) {

			    	$tax_title 	= $row["title"];
			    	$tax_value 	= $row["value"];

			    }
			}
			else{
				$tax_title 	= 'NA';
				$tax_value 	= 0;
			}
		}
		else{
			$tax_title 	= 'NA';
			$tax_value 	= 0;
		}


		$tbody = '';
		$fetch_tax_dd_query = "SELECT * FROM `tax` ORDER By `value` ASC;";
		$result_tax_dd = $conn->query($fetch_tax_dd_query);

		if ($result_tax_dd->num_rows > 0) {

		    while($row = $result_tax_dd->fetch_assoc()) {

		    	if($row["id"] == $tax_id){$tx_dd_sel = 'selected="selected"';}
		    	else{$tx_dd_sel = "";}

		    	$tbody .= '<option '.$tx_dd_sel.' value="'.$row["id"].'">'.$row["value"].'%</option>';

		    }
		}

		//echo $tbody;


	}
}

?>
<?php $conn->close(); ?>

<div class="container-fluid">
	<div class="container bill-cont">

		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Edit Product</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<form id="editProduct" action="prg_update_product.php" enctype="multipart/form-data" method="post">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="prdUnqId"><?php echo $GLOBALS['prd_code_title']; ?></label>
								<input type="hidden" name="prd-id" value="<?php echo $prd_id;?>">
								<input type="text" required="true" class="form-control" id="prdUnqId" placeholder="<?php echo $GLOBALS['prd_code_title']; ?>" name="prd-unq-code" value="<?php echo $prd_code;?>">
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label for="prdTitle">Product Title</label>
								<input type="text" required="true" class="form-control" id="prdTitle" placeholder="Product Title" name="prd-title" value="<?php echo $title;?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="buyPrice">Buying Price</label>
								<input type="text" class="form-control" id="buyPrice" placeholder="Buying Pice" name="buy-price" min="0" value="<?php echo $buy_price;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sellPrice">Selling Price</label>
								<input type="text" required="true" class="form-control" id="sellPrice" placeholder="Selling Price" name="sell-price" min="0" value="<?php echo $sell_price;?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="prdStock">Stock</label>
								<input type="number" required="true" class="form-control" id="prdStock" placeholder="Stock" name="stock" min="1" value="<?php echo $stock;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="taxSelect">Tax (<?php echo $tax_value;?>%)</label>
							<select id="taxSelect" class="form-control" name="tax">
								<?php echo $tbody;?>
							</select>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-success pull-right">Update</button>
					<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
					<button type="button" onclick="removeStock(<?php echo $prd_id;?>)" class="btn btn-danger pull-right">Delete</button>
				</form>
			</div>
		</div>





	</div>
</div>

<?php include("footer_scripts.php");?>




<script type="text/javascript">


	function refreshPage(){
		location.reload();
	}

    var frm = $('#editProduct');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                //alert(data);
                if(data == 1){
                	refreshPage();
                }
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });
</script>

<script type="text/javascript">

	//$('#taxSelect').load('prg_tax_dd.php');
	//$("#taxSelect option[value='4']").attr("selected","selected");

</script>

<script type="text/javascript">

	function redirectPage(x){
		window.location.href = x;
	}

	function removeStock(x){

		var connfirmDelete = confirm("Confirm Delete!");
		if (connfirmDelete == true) {
			$.post('prg_remove_product.php',{id:x},function(data){
				//alert(data);
				if(data==1){
					redirectPage('product_list.php');
				}
				else{
					alert("Oops! Something went wrong. Please try again.")
				}
			});
		} 



	}
</script>



<?php include("footer.php");?>