<?php include("header.php");?>

<?php

$bill_id = $_GET['id'];

$title = $datalist_options = "";

$fetch_product_query = "SELECT * FROM `products`;";
$result = $conn->query($fetch_product_query);

if($result->num_rows>0){
	while($rows = $result->fetch_assoc()){

		$id 			= $rows['id'];
		$product_code 	= $rows['uniqueid'];
		$title 			= $rows['title'];

		$datalist_options .= '<option value="'.$title.'['.$product_code.']--'.$id.'">';

	}
}
else{
	$datalist_options .= '<option value="No Products Available [0000]">';
}


$fetch_company_query = "SELECT * FROM `company`;";
$result_company = $conn->query($fetch_company_query);

if($result_company->num_rows>0){
	while($rows_company = $result_company->fetch_assoc()){

		$name 		= $rows_company['name'];
		$logo_url	= $rows_company['logo'];
		$gst 		= $rows_company['gst'];
		$pan 		= $rows_company['pan'];
		$state 		= $rows_company["state"];
		$statecode 	= $rows_company['statecode'];

		$phone1 	= $rows_company["phone1"];
		$phone2 	= $rows_company["phone2"];
		$email 		= $rows_company["email"];
		$website 	= $rows_company["website"];
		$street 	= $rows_company["street"];
		$city 		= $rows_company["city"];
		$district 	= $rows_company["district"];
		$state 		= $rows_company["state"];
		$country 	= $rows_company["country"];
		$pin 		= $rows_company["pin"];
		$bankname 	= $rows_company["bankname"];
		$bankaccno 	= $rows_company["bankaccno"];
		$bankifsc 	= $rows_company["bankifsc"];

	}
}


$fetch_cust_query = "SELECT * FROM `bill` WHERE `id`=".$bill_id.";";
$result_cust = $conn->query($fetch_cust_query);


if($result_cust->num_rows>0){
	while($rows_cust = $result_cust->fetch_assoc()){

		$cust_id	 		= $rows_cust["id"];
		$bill_number 		= sprintf('%04u', ($rows_cust['bill_no']));
		$cust_name	 		= $rows_cust["cust_name"];
		$cust_state 		= $rows_cust['cust_state'];
		$cust_gst 			= $rows_cust['cust_gst'];
		$cust_state_code 	= $rows_cust['state_code'];
		$cust_address 		= $rows_cust['cust_address'];
		$cust_phone 		= $rows_cust['cust_phone'];
		$type 				= $rows_cust["type"];
		$items 				= json_decode($rows_cust["items"]);
/*		$amount 		= $rows_cust["amount"];
		$paid 			= $rows_cust["paid"];
		$created 		= $rows_cust["created"];
		$bill_url 		= $rows_cust["file_url"];*/

		if($type == 1){$bill_type = "B2B"; $_checked_box = 'checked="true"'; $bill_prefix = 'S ';}
		else if($type == 2){$bill_type = "B2C"; $_checked_box = ''; $bill_prefix = 'SE ';}
		else{$bill_type = ""; $_checked_box = '';}

	}
}

$item_count = 1;
$item_rows = '';

foreach($items as $key){

	//echo $key->tax;
	if($key->tax == ''){$key->tax = 0;}
	if($key->price == ''){$key->price = 0;}
	if($key->id == ''){$key->id = '';}

	$prd_id 		= $key->id;
	$net_amount 	= $key->price * $key->qty;
	$gst_amoount 	= $net_amount / 100 * $key->tax;
	$total_amount 	= $net_amount + $gst_amoount;


	$fetch_added_product_query = "SELECT `stock` FROM `products` WHERE `id`=".$prd_id.";";
	$result_prd_added = $conn->query($fetch_added_product_query);

	if($result_prd_added->num_rows>0){
		while($rows_prd_added = $result_prd_added->fetch_assoc()){
			$prd_remaining	= $rows_prd_added['stock'];
		}
	}
	else{
		$prd_remaining = 999999;
	}




	$item_rows .= '
		<tr class="billing-rows" data-row-count="'.$item_count.'">
			<td class="text-center billcol-slno" data-row-count-slno="'.$item_count.'">'.$item_count.'</td>
			<td class="text-center billcol-code" data-row-count-code="'.$item_count.'" >'.$key->uniqueid.'</td>
			<td class="text-center billcol-name">
				<input id="productInputField" class="form-control product-input-field" list="productsDdList" type="text" data-search-by="name" data-row-count-prdname="'.$item_count.'" value="'.$key->title.'"/>
				<datalist id="productsDdList">
				  '.$datalist_options.'
				</datalist>
			</td>
			<td class="text-center billcol-tax" data-row-count-prdtax="'.$item_count.'">'.$key->tax.'</td>
			<td class="text-center billcol-qty">
				<input class="form-control form-pad-6 qty-input-field" data-row-count-prdqty="'.$item_count.'" data-row-prd-rem="'.$prd_remaining.'" type="number" min="1" value="'.$key->qty.'" />
			</td>
			<td class="text-center billcol-price">
				<input type="text" class="form-control form-pad-6 price-input-field" data-row-count-prdprice="'.$item_count.'" min="0" value="'.$key->price.'" />
			</td>
			<td class="text-center billcol-netamt" data-this-tax-val="'.$key->tax.'" data-row-count-netamt="'.$item_count.'">'.number_format($net_amount, 2).'</td>
			<td class="text-center billcol-taxamt" data-row-count-taxamt="'.$item_count.'">'.number_format($gst_amoount, 2).'</td>
			<td class="text-center billcol-total" data-row-count-prdttl="'.$item_count.'">'.number_format($total_amount, 2).'</td>
		</tr><input type="hidden" class="hidden-id-input" value="'.$prd_id.'" data-row-count-id="'.$item_count.'" />';

	$item_count++;

}


?>


<input type="hidden" class="bill-id-hidden" value="<?php echo $_GET['id'];?>">
<div class="container-fluid">
	<br><br>

	<div class="container pad-v10" style="visibility: hidden;">
		<div class="row">
			<div class="col-md-12 text-right">
				<b>B2B</b> &nbsp; <input type="checkbox" name="" <?php echo $_checked_box;?> class="type-change-field">
			</div>
		</div>
	</div>

	<div id="sectionToPrint" class="container bill-cont bill-table-container mar-b50">

		<div class="row">
			<div class="col-md-12">
				<div class="billing-table-container">
					<table class="bill-page-table" id="billHeader" width="100%" border="0">
						<tr>
							<th width="20%">
								<img alt="<?php echo $name;?>" class="bill-company-logo" src="<?php echo $logo_url;?>"/>
							</th>
							<th class="text-center">
								<h1 class="comp-name"><?php echo $name;?></h1>
							</th>
							<th width="20%" class="text-right">
								<p>
									<?php echo $street;?><br>
									<?php echo $city;?>, <?php echo $district;?><br>
									<?php echo $state;?>, <?php echo $pin;?><br>
									<?php echo $phone1;?><br>
									<?php echo $email;?><br>
								</p>
							</th>
						</tr>
					</table>
					<table class="bill-page-table" id="billHeaderSubInfo" width="100%" border="1">
						<tr>
							<th class="text-center">
								<select class="pull-right" style="border:none;">
									<option>Duplicate Copy</option>
									<option>Original Copy</option>
								</select>
								<p class="bill-type-info">Tax Invoice [<?php echo $bill_type;?>]</p>
							</th>
						</tr>
					</table>
					<table class="bill-page-table" id="billHeaderInfo" width="100%" border="0">
						<tr>
							<th width="65%">
								<p>Billed To: <span class="customer-name-field" contentEditable><?php echo $cust_name;?></span></p>
								<p>Address: <span contentEditable class="customer-address-field"><?php echo $cust_address;?></span></p>
								<p>Phone No: <span class="customer-phone-field" contentEditable><?php echo $cust_phone;?></span></p>
								<p class="cust-gst-box">GST No: <span class="customer-gst-field" contentEditable><?php echo $cust_gst;?></span></p>
								<p>State Code &amp; State: <span class="state-code-field" contentEditable><?php echo $cust_state_code;?></span>, <span class="customer-state-field" contentEditable><?php echo $cust_state;?></span></p>
							</th>
							<th>
								<table>
									<tr>
										<th width="45%">GST No.</th>
										<td><?php echo $gst;?></td>
									</tr>
									<tr>
										<th>PAN</th>
										<td><?php echo $pan;?></td>
									</tr>
									<tr>
										<th>State</th>
										<td><?php echo $state;?></td>
									</tr>
									<tr>
										<th>State Code</th>
										<td><?php echo $statecode;?></td>
									</tr>
									<tr>
										<th>Invoice No.</th>
										<td><?php echo $bill_prefix;?> <span id="billNo"><?php echo $bill_number;?></span></td>
									</tr>
									<tr>
										<th>Date</th>
										<td><?php echo date("d-m-Y h:i:sa") ?></td>
									</tr>
								</table>
							</th>
						</tr>
					</table>
	<br>
					<table class="bill-page-table" id="billgeneratingTable" width="100%" border="1">
						<thead>
							<tr>
								<th width="4.42%" class="text-center">
									SL. <br>No.
								</th>
								<th width="8.84%" class="text-center">
									HSN<br>Code
								</th>
								<th class="text-left pad-h20">
									Name of Product
								</th>
								<th width="4.42%" class="text-center">
									GST <br>[%]
								</th>
								<th width="7%" class="text-center">
									Qty
								</th>
								<th width="8.84%" class="text-center">
									Unit <br>Price
								</th>
								<th width="8.84%" class="text-center">
									Net <br>Amount
								</th>
								<th width="8.84%" class="text-center">
									GST <br>Amount
								</th>
								<th width="8.84%" class="text-center">
									Total
								</th>
							</tr>
						</thead>
						<tbody id="billgeneratingTableBody">
							<?php echo $item_rows;?>
						</tbody>
						<tfoot>
							<tr class="billing-table-foot">
								<th colspan="6" class="pad-h10 pad-v10">
									Total
								</th>
								<th id="netTotal" class="text-center pad-r10">
									0.00
								</th>
								<th id="gstTotal" class="text-center pad-r10">
									0.00
								</th>
								<th id="grandTotal" class="text-center pad-r10">
									0.00
								</th>
							</tr>
							<tr class="billing-table-foot-1">
								<th colspan="2" class="pad-h10 pad-v10 font-s11">
									In Words: 
								</th>
								<th colspan="3" id="wordTotal" class="text-left pad-h10 capitalize font-s11">
									Zero Only
								</th>
								<th colspan="2" class="text-center pad-h10 font-s11">
									Grand Total
								</th>
								<th colspan="2" id="finalTotal" class="text-right pad-h10 font-s11">
									0.00
								</th>
							</tr>
						</tfoot>
					</table>					
					<table class="bill-page-table" id="billFootertax" border="1" style="border: 1px solid #ddd; margin: 4px 30px;">
						<tr>
							<th class="text-center pad-h10">GST[%]</th>
							<th class="text-center pad-h10">Taxable Amt.</th>
							<th class="text-center pad-h10">CGST Amt</th>
							<th class="text-center pad-h10">SGST Amt</th>
							<th class="text-center pad-h10">Total Tax</th>
						</tr>
<?php 

	$sql_tax_table_query = 'SELECT * FROM `tax` ORDER BY `value` ASC;';
	$result_tax_table = $conn->query($sql_tax_table_query);
	
	if($result_tax_table->num_rows>0){
		while($rows = $result_tax_table->fetch_assoc()){
			echo '
				<tr class="tax-table-row" data-tax-row="'.$rows['value'].'">
					<th class="text-center">'.$rows['value'].'%</th>
					<th class="text-center" data-tax-row-taxable="'.$rows['value'].'"></th>
					<th class="text-center" data-tax-row-cgst="'.$rows['value'].'"></th>
					<th class="text-center" data-tax-row-sgst="'.$rows['value'].'"></th>
					<th class="text-center" data-tax-row-total="'.$rows['value'].'"></th>
				</tr>
			';
		}
		echo '
			<th class="text-center">Total</th>
			<th class="text-center taxable-amt-total"></th>
			<th class="text-center taxable-sgst-total"></th>
			<th class="text-center taxable-sgst-total"></th>
			<th class="text-center taxable-tax-total"></th>
		';
	}

?>
					</table><!-- billFootertax -->
					<table class="bill-page-table" id="billFooterBank" width="100%" border="1" style="border: none;">
						<tr>
							<th class="text-left pad-h10" width="20%">Bank Details</th>
							<td class="text-left pad-h10"><?php echo $bankname; ?></td>
						</tr>
						<tr>
							<th class="text-left pad-h10">Bank Account Number</th>
							<td class="text-left pad-h10"><?php echo $bankaccno; ?></td>
						</tr>
						<tr>
							<th class="text-left pad-h10">Bank Branch IFSC</th>
							<td class="text-left pad-h10"><?php echo $bankifsc; ?></td>
						</tr>
					</table><!-- billFooterBank -->
					<table class="bill-page-table" id="billFooterDeclaration" width="100%" border="1">
						<tr>
							<th class="text-center">
								<h5 class="text-left pad-h10 mar-4">Declaration:</h5>
								<p class="text-left mar-b4" style="text-indent: 60px;">We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct. </p>
							</th>
						</tr>
					</table><!-- billFooterDeclaration -->
					<table class="bill-page-table" id="billFooterTerms" width="100%" border="1">
						<tr>
							<th class="text-center">
								<h5> <span class="pull-left pad-h10"> Terms &amp; Conditions:</span> <span class="pull-right pad-r60 for-company-label">For, <?php echo $name; ?><</span></h5>
								<br><br><br><br>
								<h5 class="footer-signature"><span class="pull-left">E &amp; O.E</span><span>Reciever Signature</span><span class="pull-right">Authorised Signatory</span></h5>
							</th>
						</tr>
					</table><!-- billFooterTerms -->
				</div>
			</div>
		</div>


	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table id="printButtons" width="100%" border="0">
					<tr>
						<th class="pad-h10 pad-v10 text-left">
							<button id="billPrintOnly" class="btn btn-sm btn-warning">Print Only</button>
							<button id="billSaveOnly" class="btn btn-sm btn-warning">Save Only </button>
						</th>
						<th class="pad-h10 pad-v10 text-right">
							<button id="billPrintSave" class="btn btn-sm btn-warning">Save &amp; Print </button>
						</th>
					</tr>
				</table>
			</div>
		</div>
	</div>

</div>

<?php $conn->close(); ?>

<?php include("footer_scripts.php");?>

<script src="js/edit_billing_scripts.js" type="text/javascript"></script>

<?php include("footer.php");?>