<?php include("header.php");?>

<div class="container-fluid">
	<div class="container bill-cont">

		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Add Tax</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<form id="addTax" action="prg_add_tax.php" enctype="multipart/form-data" method="post">
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="taxName">Tax Name</label>
								<input type="text" required="true" class="form-control" id="taxName" placeholder="Tax Name" name="tax-title">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="taxValue">Value in Percentage</label>
								<input type="number" required="true" class="form-control" id="taxValue" placeholder="Tax Value" name="tax-value" min="0">
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-warning pull-right">Submit</button>
				</form>
			</div>
		</div>



		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Tax List</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="taxTable" class="display commonTable" width="400" cellspacing="50" cellpadding="50" border="0">
				        <thead>
				            <tr>
				                <th>Tax Name</th>
				                <th>Value</th>
				            </tr>
				        </thead>
				        <tbody id="taxTableBody">
				        	
				        </tbody>
				        <tfoot>
				            <tr>
				                <th>Tax Name</th>
				                <th>Value</th>
				            </tr>
				        </tfoot>
				    </table>
			</div>
		</div>



	</div>
</div>

<?php include("footer_scripts.php");?>

<script type="text/javascript">

	$(document).ready(function(){
		$.post("prg_list_tax.php",{page: "tax"},function(data){
			//alert(data);
			$('#taxTableBody').html(data);
		});
	});

</script>


<script type="text/javascript">

	function refreshTable(){
		location.reload();
	}

    var frm = $('#addTax');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                //alert(data);
                if(data == 1){
                	refreshTable();
                }
            },
            error: function (data) {
                alert("Something went wrong.  " + data);
            },
        });
    });
</script>



<?php include("footer.php");?>