<?php include("header.php");?>

<style type="text/css">
	.form-control {
	    min-width: 49% !important;
	}
	.new-stock-in{
		display: none;
	}
</style>


<div class="container-fluid">
	<div class="container bill-cont">


		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Products List</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="filter-container bg-white pad-20 light-border">
					<form action="prg_search_products.php" class="form-inline" id="searchReportsForm" method="post">
						<div class="row">
							<div class="col-md-12">
								<h4>Search by:</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 pad-v10 text-center">
								<select class="form-control" name="search-by">
									<option value="title">Product Name</option>
									<option value="uniqueid"><?php echo $GLOBALS['prd_code_title']; ?></option>
									<option value="stock">Stock less than </option>
									<option value="buy_price">Buying price less than </option>
									<option value="sell_price">Selling price less than </option>
									<!-- <option value="tax">Tax</option> -->
								</select>
								<input type="text" class="form-control" name="search-string" placeholder="Enter search value">

							</div>

							<div class="col-md-4 pad-v10 text-center">

								<button type="submit" class="btn btn-success form-control">Search</button>		

							</div>

						</div>

					</form>
				</div>
			</div>
		</div>
<br>
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
				        <tbody id="productList" style="max-height: 400px; overflow: auto;">
				        	
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
		$('#productList').load('prg_list_products.php');
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
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });




	

    var frm = $('#searchReportsForm');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                //alert(data);
                $('#productList').html(data);
/*                if(data == 1){
                	//alert('Success.')
                	refreshPage();
                }
                else if(data == 2){
                	//alert('Success.')
                	refreshPage();
                }
                else{
                	alert("Oops! Something went wrong.")
                }*/
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });


    $('[name=search-string]').on('keyup',function(){
    	$('#searchReportsForm').submit();
    })


    $(document).on('click','.stock-add-btn',function(){
    	var prdId = $(this).attr('data-prd-id');
    	//alert(prdId);
    	$('#newStock'+prdId).show();
    	$('#newStock'+prdId).select();
    	$(this).addClass('stock-add-sbmt');
    	$(this).removeClass('stock-add-btn');
    	$(this).html('<i class="fa fa-check text-success"></i>');
    });


    $(document).on('click','.stock-add-sbmt',function(){
    	var prdId = $(this).attr('data-prd-id');
    	var newStockCount = $('#newStock'+prdId).val();
    	//alert(newStockCount);
        $.post(
            'prg_add_stock.php',
            {
            	prdid: prdId,
            	stock: newStockCount
            },
            function(data){
            	//alert(data);
            	if(data != 'ERR'){
            		//loadProductList();
            		$('#prdTd'+prdId).html(' ' + data + ' &nbsp;<input type="text" size="1" value="0" class="new-stock-in" id="newStock'+prdId+'"> &nbsp;<button data-prd-id="'+prdId+'" class="btn btn-default btn-xs stock-add-btn"><i class="fa fa-plus text-primary"></i></button>');

            	}
            	else{
            		//alert("Sorry! Something went wrong. Please try again.")
            	}
            }
        );

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