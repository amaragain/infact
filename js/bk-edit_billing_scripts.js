
$(document).ready(function(){

	var rowCountIncrement = $('.billing-rows').length;
	var productRemaining = 0;

	getTotal();
	//levelRows();


/*	$("#billgeneratingTableBody").on('focus','.product-input-field', function () {
		$(this).select();
	});

	$("#billgeneratingTableBody").on('focus','.qty-input-field', function () {
		$(this).select();
	});

	$("#billgeneratingTableBody").on('focus','.price-input-field', function () {
		$(this).select();
	});*/



	function addBillingRow(){

	    rowCountIncrement++;

	    var newRow;

		newRow +='	<tr class="billing-rows" style="border: none;" data-row-count="'+rowCountIncrement+'">';
		newRow +='		<td class="text-center billcol-slno" data-row-count-slno="'+rowCountIncrement+'"> '+rowCountIncrement+' </td>';
		newRow +='		<td class="text-center billcol-code" data-row-count-code="'+rowCountIncrement+'"></td>';
		newRow +='		<td class="text-center billcol-name"><input class="form-control product-input-field" list="productsDdList" type="text" data-search-by="name" data-row-count-prdname="'+rowCountIncrement+'"/><datalist id="productsDdList"><?php echo $datalist_options;?></datalist></td>';
		newRow +='		<td class="text-center billcol-tax" data-row-count-prdtax="'+rowCountIncrement+'">0</td>';
		newRow +='		<td class="text-center billcol-qty"><input class="form-control form-pad-6 qty-input-field" data-row-count-prdqty="'+rowCountIncrement+'" type="number" min="1" value="1" onkeyup="qtyValue(this)" /></td>';
		newRow +='		<td class="text-center billcol-price"><input type="text" class="form-control form-pad-6 price-input-field" data-row-count-prdprice="'+rowCountIncrement+'"/></td>';
		newRow +='		<td class="text-center billcol-netamt" data-this-tax-val="0" data-row-count-netamt="'+rowCountIncrement+'">0.00</td>';
		newRow +='		<td class="text-center billcol-taxamt" data-row-count-taxamt="'+rowCountIncrement+'">0.00</td>';
		newRow +='		<td class="text-center billcol-total" data-row-count-prdttl="'+rowCountIncrement+'">0.00</td>';
		newRow +='	</tr><input type="hidden" class="hidden-id-input" data-row-count-id="'+rowCountIncrement+'" />';

		$('#billgeneratingTableBody').append(newRow);
		$("[data-row-count-prdname="+rowCountIncrement+"]").focus();
	}


	function updateThisRow(dataRowCount){

		var unitPrice 	= $("[data-row-count-prdprice="+dataRowCount+"]").val();
		var taxValue 	= $("[data-row-count-prdtax="+dataRowCount+"]").text();
		var prdQty 		= $("[data-row-count-prdqty="+dataRowCount+"]").val();

		if(parseInt(productRemaining) < parseInt(prdQty)){alert("Insufficiernt stock. Only "+productRemaining+" remaining.");}

		var productNetAmount 	= unitPrice * prdQty;
		var productTaxAmount 	= productNetAmount / 100 * taxValue;
		var productTotalAmount 	= productNetAmount + productTaxAmount;

		$("[data-row-count-netamt="+dataRowCount+"]").html(productNetAmount.toFixed(2));
		$("[data-row-count-taxamt="+dataRowCount+"]").html(productTaxAmount.toFixed(2));
		$("[data-row-count-prdttl="+dataRowCount+"]").html(productTotalAmount.toFixed(2));

		$("[data-row-count-netamt="+dataRowCount+"]").attr('data-this-tax-val',taxValue); //===================================================
	}



	$("[data-row-count-prdname=1]").focus();


	$("#billgeneratingTableBody").on('input','.product-input-field', function () {

	    var val = this.value;
	    if($('#productsDdList option').filter(function(){
	        return this.value === val;        
	    }).length) {
	        var product = this.value
	        var dataRowCount = $(this).attr("data-row-count-prdname");
	        //alert(dataRowCount);
	        var productCode 	= product.substring(product.lastIndexOf("[")+1,product.lastIndexOf("]"));
	        var productTitle 	= product.substring(product.indexOf(""),product.lastIndexOf("["));
	        var productId 		= product.substring(product.lastIndexOf("-")+1);
	        //alert(productId);


	        if($(":input.hidden-id-input[value='"+productId+"']").length > 0){
		        $("[data-row-count-prdname="+dataRowCount+"]").val("");
		        $("[data-row-count="+dataRowCount+"]").remove();
		        var existingRowCount = $(":input.hidden-id-input[value='"+productId+"']").attr("data-row-count-id");
		        $("[data-row-count-prdqty="+existingRowCount+"]").focus();
	        	alert("The item already added in the bill.")
	        }
	        else{
		        $("[data-row-count-code="+dataRowCount+"]").text(productCode);
		        $("[data-row-count-prdname="+dataRowCount+"]").val(productTitle);
		        $("[data-row-count-prdqty="+dataRowCount+"]").focus().val("").val(1);

		        var prdQty = $("[data-row-count-prdqty="+dataRowCount+"]").val();
		        //alert(prdQty);
		        //send ajax request
		        $.post(
		        	'prg_fetch_product_details_for_billing.php',
		        	{
		        		prdId: productId,
		        		prdCode: productCode,
		        		prdTitle: productTitle
		        	},
		        	function(data){
		        		jsonData = JSON.parse(data);
		        		//alert(jsonData.prdPrice);
		        		var productPrice 		= jsonData.prdPrice;
		        		var productTaxTitle 	= jsonData.taxTitle;
		        		var productTaxValue 	= jsonData.taxValue;
		        		productRemaining 		= jsonData.stock;
		        		var productNetAmount 	= productPrice * prdQty;
		        		var productTaxAmount	= productNetAmount / 100 * productTaxValue;
		        		var productTotalAmount	= productNetAmount + productTaxAmount;

		        		if((productRemaining - prdQty) < 1){
		        			alert("Oops! Out of stock. Only " + productRemaining + " remaining.");
		        		}
		        		else if((productRemaining - prdQty) < 11){
		        			alert("Warning! There is only " + productRemaining + " remaining.");
		        		}
		        		/*array("prdTitle"=>$title, "prdPrice"=>$buy_price, "stock"=>$stock, "tax"=>$tax, "avl"=>$avl);*/
		        		$("[data-row-count-prdprice="+dataRowCount+"]").val(parseFloat(productPrice).toFixed(2));
		        		$("[data-row-count-prdtax="+dataRowCount+"]").text(productTaxValue);
		        		$("[data-row-count-id="+dataRowCount+"]").val(productId);
		        		$("[data-row-count-netamt="+dataRowCount+"]").text(productNetAmount.toFixed(2));
		        		$("[data-row-count-taxamt="+dataRowCount+"]").text(productTaxAmount.toFixed(2));
		        		$("[data-row-count-prdttl="+dataRowCount+"]").text(productTotalAmount.toFixed(2));

						$("[data-row-count-netamt="+dataRowCount+"]").attr('data-this-tax-val',productTaxValue);

		        		getTotal();
		        		resetSlNo()

		        	}
		        );
	        }

	    }
	});



	$('#billgeneratingTableBody').on('keyup','.qty-input-field',function(e){

	    var dataRowCount = $(this).attr("data-row-count-prdqty");
	    updateThisRow(dataRowCount);
	    getTotal();
	    resetSlNo();
		//alert(dataRowCount);

	});


	$('#billgeneratingTableBody').on('keydown','.price-input-field',function(e){

		var dataRowCount = $(this).attr("data-row-count-prdprice");

		if($('.billcol-slno').length == $('[data-row-count-slno="'+dataRowCount+'"]').text()){

			var keyCode = e.keyCode || e.which; 
			if (keyCode == 9) { 

				e.preventDefault(); 

				// call custom function here
				//alert("ok")
				var unitPrice = $(this).val();
				$(this).val(Number(unitPrice).toFixed(2));

				updateThisRow(dataRowCount);
				addBillingRow();
				getTotal();
				resetSlNo();
			}

		} 

	})


	$('#billgeneratingTableBody').on('keyup','.price-input-field',function(e){

	    var dataRowCount = $(this).attr("data-row-count-prdprice");
	    updateThisRow(dataRowCount);
	    getTotal();
	    resetSlNo();
		//alert(dataRowCount);
	});




	$('#billgeneratingTableBody').on('mouseup','.qty-input-field',function(){

	    var dataRowCount = $(this).attr("data-row-count-prdqty");

		updateThisRow(dataRowCount);
	    getTotal();
	    resetSlNo()
		//alert(dataRowCount);
	});




	$('#billgeneratingTableBody').on('keyup','.product-input-field',function(e){
	    if(e.keyCode == 46) {
	        //alert($('.billing-rows').length);
	        var thisRowNumber = $(this).attr('data-row-count-prdname')
	        if($('.billing-rows').length != 1){
	        	$('[data-row-count="'+thisRowNumber+'"]').remove();
	        }
	    }
	    getTotal();
	    resetSlNo()
	});




	function getTotal() {

		var sumNetAmt = 0;
		$("[data-row-count-netamt]").each(function(){
		    sumNetAmt += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
		});
		$('#netTotal').text(sumNetAmt.toFixed(2));


		var sumTaxAmt = 0;
		$("[data-row-count-taxamt]").each(function(){
		    sumTaxAmt += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
		});
		$('#gstTotal').text(sumTaxAmt.toFixed(2));


		var sumTtlAmt = 0;
		$("[data-row-count-prdttl]").each(function(){
		    sumTtlAmt += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
		});
		$('#grandTotal').text(sumTtlAmt.toFixed(2));
		$('#finalTotal').html('<i class="fa fa-inr"></i> ' + sumTtlAmt.toFixed() + '.00');
		$('#wordTotal').text(inWords(sumTtlAmt.toFixed()));

		taxTable();
	}


	function resetSlNo(){
		var slNoIncr = 1;
		$('.billcol-slno').each(function(i, obj) {
		    //test
		    //alert(i + ' -- ' + obj)
		    $(this).text(slNoIncr++)
		});

	}




	function levelRows(){
		var currRowLength = $('.billing-rows').length;
		if(currRowLength < 20){
			for(var i = currRowLength; i<20; i++){
				$('#billgeneratingTableBody').append('<tr class="billing-rows" style="border: none;"><td>&nbsp;</td><td><input class="form-control" type="text"/></td><td></td><td></td><td></td><td></td><td></td><td></td><td>  </td></tr>');
			}
		}		
	}


	// ================  PRINT BILL
	$('#printButtons').on('click','#billPrintOnly',function(){
		//alert($('.billing-rows').length)
		levelRows();
		window.print();
		location.reload();
	});


	// ================  SAVE BILL
	$('#printButtons').on('click','#billSaveOnly',function(){
		saveBill();
	});



	// ================  SAVE & PRINT THE BILL
	$('#printButtons').on('click','#billPrintSave',function(){
		saveBill();
		levelRows();
		window.print();
		location.reload();
	});


	

	function saveBill(){
		alert('ok')
		var custName 	 	= $('.customer-name-field').text();
		var custState 	 	= $('.customer-state-field').text();
		var stateCode 	 	= $('.state-code-field').text();
		var custAddress	 	= $('.customer-address-field').text();
		var custPhone 	 	= $('.customer-phone-field').text();
		var billAmount 	 	= $('#finalTotal').text();
		var billSection 	= $('#sectionToPrint').html();
		var billNo 			= $('#billNo').text();
		var custGst 		= $('.customer-gst-field').text();
		var billFileName 	= 'bills/' + billNo + '.txt';

        if($('.type-change-field').prop("checked") == true){
            //alert("Checkbox is checked.");
			var billType 	 	= '1'; //  1 is for B2B bill and 0 is for B2C bill
        }
        else if($('.type-change-field').prop("checked") == false){
            //alert("Checkbox is unchecked.");
			var billType 	 	= '0'; //   0 is for B2C bill
        }


        //Get Billed Product Details
        var totalProducts = $('.billing-rows').length;

        var z = 1;
        var billItems = {};

		$(".billing-rows").each(function(){
		    var thisRowCount = $(this).attr('data-row-count'); 
		    prdId 		= $('[data-row-count-id='+thisRowCount+']').val();
		    prdUniqueId = $('[data-row-count-code='+thisRowCount+']').text();
		    prdName 	= $('[data-row-count-prdname='+thisRowCount+']').val();
		    prdTax 		= $('[data-row-count-prdtax='+thisRowCount+']').text();
		    prdQuantity = $('[data-row-count-prdqty='+thisRowCount+']').val();
		    prdPrice 	= $('[data-row-count-prdprice='+thisRowCount+']').val();

		    billItems[z] = {id:prdId, uniqueid:prdUniqueId, title:prdName, tax:prdTax, qty:prdQuantity, price:prdPrice}

		    z++;
		    //alert(thisRowCount);
		});

		alert(billItems);

		// Update product Quantity

		$.post(
			'prg_update_remaining_stock.php',
			{
				items: JSON.stringify(billItems)
			},
			function(data){
				alert(data);
			}
		);


		//alert(JSON.stringify(billItems));

		// Save Bill Details To Database
		$.post(
			'prg_update_bill.php',
			{
				custname: custName,
				custstate: custState,
				statecode: stateCode,
				custaddress: custAddress,
				custphone: custPhone,
				billtype: billType,
				billamount: billAmount,
				billname: billFileName,
				billno: billNo,
				custgst: custGst,
				items: JSON.stringify(billItems)
			},
			function(data){
				//alert(data);
				if(data == 1){
					//window.print();
					// Generate Bill File
					$.post(
						'prg_save_bill_as_file.php',
						{
							bill: billSection,
							billno: billNo,

						},
						function(data1){
							//alert(data);
						}
					);
					//alert('Bill Saved.');
					location.reload();
				}
				else{
					//alert(data)
					alert("Oops! Bill not saved.")
				}
			}
		)
	}


	$(document).on('change', '.type-change-field', function() {
	    if(this.checked) {
	        //Do stuff
	        $('.bill-type-info').text('Tax Invoice [B2B]');
	        $('.cust-gst-box').slideDown();
	    }
	    else {
	        //Do stuff
	        $('.bill-type-info').text('Tax Invoice [B2C]');
	        $('.cust-gst-box').slideUp();
	    }
	});


	if ($('.type-change-field').is(':checked')){
	    $('.bill-type-info').text('Tax Invoice [B2B]');
	    $('.cust-gst-box').slideDown();
	}
	else {
	    $('.bill-type-info').text('Tax Invoice [B2C]');
	    $('.cust-gst-box').slideUp();
	}






	function taxTable(){
		var taxableSumTotal = 0;
		var totalTaxAmtTotal = 0;
		$('.tax-table-row').each(function(){
			var taxRowNumber = $(this).attr("data-tax-row");
			//alert(taxRowNumber);
			var taxableSum = 0;
			$('[data-this-tax-val="'+taxRowNumber+'"]').each(function(){
			    taxableSum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
			});
			$('[data-tax-row-taxable='+taxRowNumber+']').text(taxableSum.toFixed(2));

			var totalTaxAmt = taxableSum * taxRowNumber / 100;
			$('[data-tax-row-total='+taxRowNumber+']').text(totalTaxAmt.toFixed(2));

			var partTaxAmt = totalTaxAmt / 2;
			$('[data-tax-row-sgst='+taxRowNumber+']').text(partTaxAmt.toFixed(2));
			$('[data-tax-row-cgst='+taxRowNumber+']').text(partTaxAmt.toFixed(2));

			//alert(taxRowNumber+'=='+taxableSum);
			//alert(taxRowNumber)
			taxableSumTotal += taxableSum;
			totalTaxAmtTotal += totalTaxAmt;
		});
			$('.taxable-amt-total').text(taxableSumTotal.toFixed(2));
			$('.taxable-tax-total').text(totalTaxAmtTotal.toFixed(2));
			$('.taxable-sgst-total').text((totalTaxAmtTotal/2).toFixed(2));
	}




})





/*=================   Convert to words. ========================*/
var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {

    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
    return str;
    //return str.charAt(0).toUpperCase() + str.slice(1);

}
