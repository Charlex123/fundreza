$('document').ready(function() { 
	/* handling Currency Conversion Form validation */
	$("#currency-form").validate({
		rules: {
			amount: {
				required: true,
			},
		},
		messages: {
			amount:{
			  required: ""
			 },			
		},
		submitHandler: handleCurrencyConvert	
	});	   
	/* Handling Currency Convert functionality */
	function handleCurrencyConvert() {		
		var data = $("#currency-form").serialize();				
		$.ajax({				
			type : 'POST',
			url  : 'convert.php',
			dataType:'json',
			data : data,
			beforeSend: function(){	
				$("#convert").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; converting ...');
			},
			success : function(response){				
				if(response.error == 1){	
					$("#converted_rate").html('<span class="form-group has-error">Error: Please select different currency</span>'); 
					$("#converted_amount").html("");
					$("#convert").html('Convert');
					$("#converted_rate").show();	 
				} else if(response.exhangeRate){							
				    var fromCur = document.getElementById("from_currency").value;
				    var amt = document.getElementById("amount").value;
				    var curSymb = document.getElementById("currency_symbol").value;
				    var amount = amt.replace(/,/g, '');
					$("#converted_rate").html("Exchange Rate: "+curSymb+Math.round(response.exhangeRate)+"/£");
					var bbG = Math.round(response.exhangeRate);
					var GBPAmt = parseInt(amount/bbG); 
					var GBPAmtt = GBPAmt.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
					$("#converted_rate").show();
					$("#converted_amount").html("Amount: £"+GBPAmtt);
					$("#converted_amount").show();
					$("#convert").html('Convert');
				} else {	
					$("#converted_rate").html("No Result");	
					$("#converted_rate").show();	
					$("#converted_amount").html("");
				}
			}
		});
		return false;
	}   
});