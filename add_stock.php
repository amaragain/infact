<?php include("header.php");?>

<div class="container-fluid">
	<div class="container bill-cont">

		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Add Product</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<form id="addProduct" action="prg_add_product.php" enctype="multipart/form-data" method="post">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="prdUnqId"><?php echo $GLOBALS['prd_code_title']; ?></label>
								<input type="text" required="true" class="form-control" id="prdUnqId" placeholder="<?php echo $GLOBALS['prd_code_title']; ?>" name="prd-unq-code">
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label for="prdTitle">Product Title</label>
								<input type="text" required="true" class="form-control" id="prdTitle" placeholder="Product Title" name="prd-title">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="buyPrice">Buying Price</label>
								<input type="text" class="form-control" id="buyPrice" placeholder="Buying Pice" name="buy-price" min="0" value="0.00">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sellPrice">Selling Price</label>
								<input type="text" required="true" class="form-control" id="sellPrice" placeholder="Selling Price" name="sell-price">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="prdStock">Stock</label>
								<input type="number" required="true" class="form-control" id="prdStock" placeholder="Stock" name="stock" min="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="taxSelect">Tax</label>
							<select id="taxSelect" class="form-control" name="tax">

							</select>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-warning pull-right">Submit</button>
				</form>
			</div>
		</div>



		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Products List</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="productsTable" class="display commonTable" width="100%" cellspacing="0">
				        <thead>
				            <tr>
				                <th><?php echo $GLOBALS['prd_code_title']; ?></th>
				                <th>Product Name</th>
				                <th style="text-align: right; width: 15%;">Buying Price</th>
				                <th style="text-align: right; width: 15%;">Selling Price</th>
				                <th style="text-align: right; width: 15%;">Stock</th>
				                <th style="text-align: center; width: 15%;">Tax</th>
				                <th style="text-align: center; width: 15%;">Action</th>
				            </tr>
				        </thead>
				        <tbody id="productList">
				        	
				        </tbody>
				        <tfoot>
				            <tr>
				                <th><?php echo $GLOBALS['prd_code_title']; ?></th>
				                <th>Product Name</th>
				                <th style="text-align: right; width: 15%;">Buying Price</th>
				                <th style="text-align: right; width: 15%;">Selling Price</th>
				                <th style="text-align: right; width: 15%;">Stock</th>
				                <th style="text-align: center; width: 15%;">Tax</th>
				                <th style="text-align: center; width: 15%;">Action</th>
				            </tr>
				        </tfoot>
				    </table>
			</div>
		</div>


	</div>
</div>

<?php include("footer_scripts.php");?>

<script type="text/javascript">

	$(document).ready(function() {
		loadProductList();
	});
</script>


<script type="text/javascript">


	function loadProductList(){
		$('#productList').load('prg_list_products_latest.php');
	}


	function refreshPage(){
		location.reload();
	}


    var frm = $('#addProduct');

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
                /*else if(data == 2){
                	alert("There is another product with same HSN code.")
                }*/
                else{
                	alert("Oops!. Something went wrong. Please try again.")
                }
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });
</script>

<script type="text/javascript">

	$('#taxSelect').load('prg_tax_dd.php');

</script>

<script type="text/javascript">
	function removeStock(x){

		var connfirmDelete = confirm("Confirm Delete!");
		if (connfirmDelete == true) {
			$.post('prg_remove_product.php',{id:x},function(data){
				//alert(data);
				if(data==1){
					refreshPage();
				}
				else{
					alert("Oops! Something went wrong. Please try again.")
				}
			});
		} 



	}
</script>



<?php include("footer.php");?>