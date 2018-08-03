<?php include("header.php");?>

<?php

$fetch_report_query = "SELECT * FROM `bill` WHERE `created`!=0 ORDER BY `id` DESC;";
$result = $conn->query($fetch_report_query);

$bill_row = '';

if($result->num_rows>0){
	while($rows = $result->fetch_assoc()){

		$id	 			= $rows["id"];
		$bill_num	 	= sprintf('%04u', ($rows["bill_no"]));
		$cust_name	 	= $rows["cust_name"];
		$cust_state 	= $rows['cust_state'];
		$cust_gst 		= $rows['cust_gst'];
		$type 			= $rows["type"];
		$amount 		= $rows["amount"];
		$paid 			= $rows["paid"];
		$created 		= $rows["created"];
		$bill_url 		= $rows["file_url"];
		$creditbill 	= $rows["creditbill"];
		$due_date 		= $rows["duedate"];

		$remaining 		=  $amount - $paid;

		if($due_date == ''){$due_date = date('d-m-Y');}

		if($type == 1){$bill_type = "B2B"; $bill_no_prefix = 'S';}
		else if($type == 2){$bill_type = "B2C"; $bill_no_prefix = 'SE';}
		else{$bill_type = "";}

		if($creditbill == 1){
			$credit_color = 'warning'; $show_credit_edit = ""; $credit_debit = 0;
		}
		else{
			$credit_color = 'info'; $show_credit_edit = "visibility: hidden;"; $credit_debit = 1;
			$due_date = '--';
		}



		$bill_row .= '
			<tr>
		        <td style="text-align: center;">'.$bill_no_prefix.' '.$bill_num.'</td>
		        <td style="text-align: center;">'.$created.'</td>
		        <td style="text-align: left;">'.$cust_name.'</td>
		        <td style="text-align: left;">'.$cust_gst.'</td>
		        <td style="text-align: center;">'.$bill_type.'</td>
		        <td style="text-align: right;">'.$amount.'</td>
		        <td style="text-align: right;">'.$remaining.'</td>
		        <td style="text-align: right;" class="paid-row-'.$id.'">
		        	'.$paid.' <button style="'.$show_credit_edit.'" onclick="editPaid('.$id.','.$paid.')" class="btn btn-default btn-xs"><i class="fa fa-pencil text-primary"></i></button>
		        </td>
		        <td style="text-align: center;" class="due-date-row-'.$id.'">
		        	'.$due_date.'			 
			        <button style="'.$show_credit_edit.'" onclick="editDueDate('.$id.',\''.$due_date.'\')" class="btn btn-default btn-xs"><i class="fa fa-pencil text-primary"></i></button>
		        </td>
		        <td style="text-align: center;">
		        	<button onclick="creditBill('.$id.','.$credit_debit.')" class="btn btn-'.$credit_color.' btn-xs"><i class="fa">Cr</i></button>
		        	<a title="View Bill" href="edit_bill.php?id='.$id.'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a> 
		        	<button title="Delete Bill" class="btn btn-danger btn-xs" onclick="deletBill('.$id.')"><i class="fa fa-times"></i></button>
		        </td>
	        </tr>
        ';
	}
}
else{

	$bill_row = '
		<tr>
	        <td colspan="8" style="text-align: center;">There are no bills to show. </td>
	    </tr>';
}

?>

<div class="container-fluid">
	<div class="container bill-cont">


		<div class="row">
			<div class="col-md-12">
				<h2 class="section-title">Bills</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="filter-container bg-white pad-20 light-border">
					<form action="prg_search_bills.php" class="form-inline" id="searchReportsForm" method="post">
						<div class="row">
							<div class="col-md-12">
								<h4>Search by:</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 pad-v10 text-center">
								<select class="form-control" name="search-by">
									<option value="cust_name">Customer Name</option>
									<option value="bill_no">Invoice No.</option>
									<option value="cust_gst">Customer GST</option>
									<option value="cust_state">Customer State</option>
								</select>
								<input type="text" class="form-control" name="search-string" placeholder="Enter search value" />

							</div>
							<div class="col-md-4 pad-v10 text-center">

								<select class="form-control" name="search-month">
									<?php
										for($m=1; $m<=12; ++$m){
											if($m == date('n')){$selected_month = "selected";}
											else{$selected_month = "";}
										    echo '<option '.$selected_month.' value="'.$m.'"> '.date('F', mktime(0, 0, 0, $m, 1)).'</option>';
										}
									?>

								</select>								
								<select class="form-control" name="search-year">
									<?php
										for($y=date('Y'); $y>=2017; $y--){
											echo '<option value="'.$y.'">'.$y.'</option>';
										}
									?>
								</select>

							</div>

							<div class="col-md-1 pad-v10 text-center">

								<select class="form-control" name="search-billtype">
									<option value="2">B2C</option>
									<option value="1">B2B</option>
								</select>		

							</div>

							<div class="col-md-2 pad-v10 text-center">

								<button type="submit" class="btn btn-success">Search</button>		

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
				                <th style="width: 10%">Invoice No:</th>
				                <th style="text-align: center;">Date</th>
				                <th style="text-align: left; ">Customer Name</th>
				                <th style="text-align: left; ">GST No.</th>
				                <th style="text-align: center;">Bill type</th>
				                <th style="text-align: right;">Amount</th>
				                <th style="text-align: right;">Balance</th>
				                <th style="text-align: center;">Paid</th>
				                <th style="text-align: center;">Due Date</th>
				                <th style="text-align: center;">Action</th>
				            </tr>
				        </thead>
				        <tbody id="productList" style="max-height: 400px; overflow: auto;">
				        	<?php echo $bill_row;?>
				        </tbody>
				        <tfoot>
				            <tr>
				                <th>Invoice No:</th>
				                <th style="text-align: center;">Date</th>
				                <th style="text-align: left; ">Customer Name</th>
				                <th style="text-align: left; ">GST No.</th>
				                <th style="text-align: center;">Bill type</th>
				                <th style="text-align: right;">Amount</th>
				                <th style="text-align: right;">Balance</th>
				                <th style="text-align: center;">Paid</th>
				                <th style="text-align: center;">Due Date</th>
				                <th style="text-align: center;">Action</th>
				            </tr>
				        </tfoot>
				    </table>
			</div>
		</div>


	</div>
</div>

<?php include("footer_scripts.php");?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
	

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

	$('[name=search-month]').change(function () {
    	$('#searchReportsForm').submit();
	});

	$('[name=search-year]').change(function () {
    	$('#searchReportsForm').submit();
	});
	
	$('[name=search-billtype]').change(function () {
    	$('#searchReportsForm').submit();
	});


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



	function updatePaid(x){

		var paidAmt = $('[data-paid-id='+x+']').val()
		//alert(paidAmt);
		$.post(
			'prg_update_paid.php',
			{
				id: x,
				paid: paidAmt
			},
			function(data){
				if(data == 1){
					location.reload();
				}
				else{
					alert('Oops! Something went wrong.');
				}
			}
		)

	}


	function updateDueDate(x){

		var dueDate = $('[data-due-date-id='+x+']').val()
		//alert(dueDate);
		$.post(
			'prg_update_due_date.php',
			{
				id: x,
				duedate: dueDate
			},
			function(data){
				if(data == 1){
					location.reload();
				}
				else{
					alert('Oops! Something went wrong.');
				}
			}
		)
	}



function editPaid(x,y){
	$('.paid-row-'+x).html('<input data-paid-id="'+x+'" class="credited-amt" type="text" value="'+y+'" style="max-width: 70px;"> <button onclick="updatePaid('+x+')" class="btn btn-default btn-xs"><i class="fa fa-check text-success"></i></button>')
}

function editDueDate(x,y) {
	$('.due-date-row-'+x).html('<input data-due-date-id="'+x+'" type="text" class="date-picker" value="'+y+'"/> <button onclick="updateDueDate('+x+')" class="btn btn-default btn-xs"><i class="fa fa-check text-success"></i></button>')
}

function creditBill(x,y){

	if(y==1){

	    var promptBox2 = confirm("You are going to change this bill from credit to cash. Are you sure?");
	    if (promptBox2 == true) {

			$.post(
				'prg_make_credit_bill.php',
				{
					id:x,
					creditbill: y
				},
				function(data){
					if(data == 1){
						location.reload();
					}
					else{
						alert('Something went wrong.')
					}
				}
			);

	    } 
	}
	else{

	    var promptBox2 = confirm("You are going to change this bill from cash to credit. Are you sure?");
	    if (promptBox2 == true) {

			$.post(
				'prg_make_credit_bill.php',
				{
					id:x,
					creditbill: y
				},
				function(data){
					if(data == 1){
						location.reload();
					}
					else{
						alert('Something went wrong.')
					}
				}
			);

	    } 

	}

}



$('body').on('focus',".date-picker", function(){
    $(this).datepicker({ dateFormat: 'dd-mm-yy' })
});

</script>


<?php include("footer.php");?>