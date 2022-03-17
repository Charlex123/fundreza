let cTip = document.querySelector(".ctip");
if(cTip) {
    var ctipContainer = document.getElementById("ctipf");
    cTip.onclick = function() {
        if(ctipContainer.style.display === "block") {
            ctipContainer.style.display = "none";
        }else {
            ctipContainer.style.display = 'block'; 
        }
        
    }
}



function _(e) {
    return document.getElementById(e);
}


function commaSeparateNumber() {
    var don_Amt = document.getElementById("amount").value;
    document.getElementById("amount").value = don_Amt.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    var ddAmt = don_Amt.replace(/,/g, '');
    var tpAmt = document.getElementById("tipamt").value;
        if(tpAmt) {
            document.getElementById("tipamt").value = tpAmt.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            var tppA = tpAmt.replace(/,/g, '');
            var dTot = parseInt(ddAmt) - parseInt(tppA);
            document.getElementById("amount").value = dTot.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }
    }


function donateFunds() {
    var don_Amt = document.getElementById("amount").value;
    var tpAmt = document.getElementById("tipamt").value,
    selectAuctionValue = $("#setTip :selected").val(),
    formClass = document.getElementById('deposit_form'),
    trxfee = inv_Amt * 0.03;
    transFee = parseInt(Math.round(trxfee));
    $("#trx-fee").val(transFee);

    coinAmt = $(".coinAmt");

    formClassValue = formClass.getAttribute('class');
    if(formClassValue == 'upgrade-form') {
        packageType = 'Upgrade';
    }else if (formClassValue == 'stake-form') {
        packageType = 'Stake';
    }
    var amntotal = parseInt(inv_Amt) + parseInt(transFee);
    var amnTotal = "<span style='color: red'>"+ amntotal +"<span>";
    coinAmt.innerHTML = amnTotal + 'Worth Of ';


    if(selectAuctionValue === 'Starter' && (inv_Amt < 50 || inv_Amt > 500)) {
        document.getElementById("amtminAlert").innerHTML = 'Starter ' + packageType + "<span style='color: red'>Amount Must Be Between $50 - $500</span>";
    }else if(selectAuctionValue === 'Starter' && (inv_Amt >= 50 || inv_Amt <= 500)) {
        document.getElementById("amtminAlert").innerHTML = 'Your Starter' + packageType + 'Amount is '+'$'+ amnTotal;
    }
    
    if(selectAuctionValue === 'Elite' && (inv_Amt < 500 || inv_Amt > 1000)) {
        document.getElementById("amtminAlert").innerHTML = 'Elite ' + packageType + "<span style='color: red'> Amount Must Be Between $500 - $1,000</span>";
    }else if(selectAuctionValue === 'Elite' && (inv_Amt >= 500 || inv_Amt <= 1000)) {
        document.getElementById("amtminAlert").innerHTML = 'Your Elite ' + packageType + ' Amount is '+'$'+ amnTotal;
    }
    
    if(selectAuctionValue === 'Prime' && (inv_Amt < 1000 || inv_Amt > 10000)) {
        document.getElementById("amtminAlert").innerHTML = 'Prime ' + packageType + "<span style='color: red'> Amount Must Be Between $1,000 - $10,000</span>";
    }else if(selectAuctionValue === 'Prime' && (inv_Amt >= 50 || inv_Amt <= 500)) {
        document.getElementById("amtminAlert").innerHTML = 'Your ' + packageType + ' Amount is '+'$'+ amnTotal;
    }
    
    if(selectAuctionValue === 'Pro' && (inv_Amt < 10000 || inv_Amt > 100000)) {
        document.getElementById("amtminAlert").innerHTML = 'Pro ' + packageType + "<span style='color: red'> Amount Must Be Between $10,000 - $100,000</span>";
    }else if(selectAuctionValue === 'Pro' && (inv_Amt >= 10000 || inv_Amt <= 100000)) {
        document.getElementById("amtminAlert").innerHTML = 'Your Pro ' + packageType + ' Amount is '+'$'+ amnTotal;
    }

    
    
    // else if(noInvest === 'no-invest' || noInvest == null) {
    //     document.getElementById("amtminAlert").innerHTML = 'You Must Select Your Investment Type First';
    // }
    else if(inv_Amt === '') {
        document.getElementById("withAlert").innerHTML = 'Bid Amount Cannot be Empty';
    }
}





function selectTip(e) {
    
    var selectTag = document.getElementById(e);
    var selectedTagactualId = selectTag.getAttribute("id");
    var donAmt = document.getElementById("amount").value;
    var ddamt = donAmt.replace(/,/g, '');
    var spanCur = document.getElementById("spanCur").innerHTML;
    
    if(selectedTagactualId === 'setTip' && donAmt != "") {
        document.getElementById("terror").innerHTML = '';
        document.getElementById("tiperr").innerHTML = '';
        var tipp = document.getElementById("sput");
        var setTipVal = document.querySelector(".val");
// alert(setTipVal)
// console.log(setTipVal)
        if(selectTag.value === 'other') {
            
            if(tipp.style.display === "block") {
                tipp.style.display = "none";
            }else {
                tipp.style.display = 'block';
            }
        }else if(selectTag.value === '5'){
            tipA = ddamt * 0.05;
            tpa = Math.round(tipA);
            tpamt = tpa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            document.getElementById("p5").innerHTML = '5% '+ '('+spanCur + tpamt + ')';
            document.getElementById("p10").innerHTML = '10%';
            document.getElementById("p15").innerHTML = '15%';
            document.getElementById("p20").innerHTML = '20%';
            document.getElementById("p25").innerHTML = '25%';
            var tpF = ddamt - Math.round(tipA);
            document.getElementById("amount").value = tpF.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }else if(selectTag.value === '10'){
            tipA = ddamt * 0.1;
            tpa = Math.round(tipA);
            tpamt = tpa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            document.getElementById("p10").innerHTML = '10% '+ '($' + tpamt + ')';
            document.getElementById("p5").innerHTML = '5%';
            document.getElementById("p15").innerHTML = '15%';
            document.getElementById("p20").innerHTML = '20%';
            document.getElementById("p25").innerHTML = '25%';
            var tpF = parseInt(ddamt) - parseInt(Math.round(tipA));
            document.getElementById("amount").value = tpF.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }else if(selectTag.value === '15'){
            tipA = ddamt * 0.15;
            tpa = Math.round(tipA);
            tpamt = tpa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            document.getElementById("p15").innerHTML = '15% '+ '($' + tpamt + ')';
            document.getElementById("p5").innerHTML = '5%';
            document.getElementById("p10").innerHTML = '10%';
            document.getElementById("p20").innerHTML = '20%';
            document.getElementById("p25").innerHTML = '25%';
            var tpF = parseInt(ddamt) - parseInt(Math.round(tipA));
            document.getElementById("amount").value = tpF.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }else if(selectTag.value === '20'){
            tipA = ddamt * 0.2;
            tpa = Math.round(tipA);
            tpamt = tpa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            document.getElementById("p20").innerHTML = '20% '+ '($' + tpamt + ')';
            document.getElementById("p5").innerHTML = '5%';
            document.getElementById("p10").innerHTML = '10%';
            document.getElementById("p15").innerHTML = '15%';
            document.getElementById("p25").innerHTML = '25%';
            var tpF = parseInt(ddamt) - parseInt(Math.round(tipA));
            document.getElementById("amount").value = tpF.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }else if(selectTag.value === '25'){
            tipA = ddamt * 0.25;
            tpa = Math.round(tipA);
            tpamt = tpa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            document.getElementById("p25").innerHTML = '25% '+ '($' + tpamt + ')';
            document.getElementById("p5").innerHTML = '5%';
            document.getElementById("p10").innerHTML = '10%';
            document.getElementById("p15").innerHTML = '15%';
            document.getElementById("p20").innerHTML = '20%';
            var tpF = parseInt(ddamt) - parseInt(Math.round(tipA));
            document.getElementById("amount").value = tpF.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }else {
            tipp.style.display = 'none';
        }

        
    }else {
        document.getElementById("terror").innerHTML = 'Enter Amount First';
    }

}




function pBar() {
    var pbBr = document.getElementById("label");
    var label = document.getElementById("label")
    var initialWidth = 100;
    var dragging = false;
    pbBr.onmousedown = function(e) {
        dragging = true;
        var parentOffset = this.parentElement.offset;
        e.preventDefault();

        window.onmousemove(function(e) {
            if(dragging == true) {
                pbBr.style.width = e.pageX - parentOffset.left;
                var percentageChange = e.pageX - parentOffset.left / initialWidth * 100;
                label.percentageChange + '%';
            }
        });

        window.onmouseup = function(e) {
            if(dragging) {
                dragging = false;
            }
        }
    }
}


function btcPay() {
    var ccPay = document.getElementById("cc-pay"),
    btcPay = document.getElementById("btc-pay"),
    ccForm = document.getElementById("cc-det"),
    btcForm = document.getElementById("btc-det");
    if(btcPay) {
        if(btcPay.checked) {
            btcForm.style.display = 'block';
            ccForm.style.display = 'none';
        }else if(document.getElementById("btc-pay").checked == false) {
            btcForm.style.display = 'none';
        }
    }
   
}


function hideDet() {
    var donorDet = document.getElementById("donor-det");
    var hidedonorDet = document.getElementById("hide-det");
    if(hidedonorDet) {
        if(hidedonorDet.checked) {
            donorDet.style.display = 'none';
        }else if(document.getElementById("hide-det").checked == false){
            donorDet.style.display = 'block';
        }
    }
   
}


function ccPay() {
    var ccPay = document.getElementById("cc-pay"),
    btcPay = document.getElementById("btc-pay"),
    ccForm = document.getElementById("cc-det"),
    btcForm = document.getElementById("btc-det");
    if(ccPay) {
        if(ccPay.checked) {
            ccForm.style.display = 'block';
            btcForm.style.display = 'none';
        }else if(document.getElementById("cc-pay").checked == false) {
            ccForm.style.display = 'none';
        }
    }
   
}


function donate() {
    _("currency-form").onsubmit = function(event) {
             event.preventDefault();
         }
     
        //  var status = document.getElementById("status");
        var currencySymbol = _("to_currency").value;
        if(currencySymbol == "NGN") {
            curSymbol = "NGN";
        }
        else if(currencySymbol == "GBP") {
            curSymbol = "GBP";
        }
        else if(currencySymbol == "CAD") {
            curSymbol = "CAD";
        }
        else if(currencySymbol == "USD") {
            curSymbol = "USD";
        }
        else if(currencySymbol == "CVE") {
            curSymbol = "CVE";
        }
        else if(currencySymbol == "CLP") {
            curSymbol = "CLP";
        }
        else if(currencySymbol == "COP") {
            curSymbol = "COP";
        }
        else if(currencySymbol == "CDF") {
            curSymbol = "CDF";
        }
        else if(currencySymbol == "EUR") {
            curSymbol = "EUR";
        }
        else if(currencySymbol == "EGP") {
            curSymbol = "EGP";
        }
        else if(currencySymbol == "GMD") {
            curSymbol = "GMD";
        }
        else if(currencySymbol == "GHS") {
            curSymbol = "GHS";
        }
        else if(currencySymbol == "GNF") {
            curSymbol = "GNF";
        }
        else if(currencySymbol == "KES") {
            curSymbol = "KES";
        }
        else if(currencySymbol == "LRD") {
            curSymbol = "LRD";
        }
        else if(currencySymbol == "MWK") {
            curSymbol = "MWK";
        }
        else if(currencySymbol == "MAD") {
            curSymbol = "MAD";
        }
        else if(currencySymbol == "MZN") {
            curSymbol = "MZN";
        }
        else if(currencySymbol == "SOL") {
            curSymbol = "SOL";
        }
        else if(currencySymbol == "RWF") {
            curSymbol = "RWF";
        }
        else if(currencySymbol == "SLL") {
            curSymbol = "SLL";
        }
        else if(currencySymbol == "STD") {
            curSymbol = "STD";
        }
        else if(currencySymbol == "TZS") {
            curSymbol = "TZS";
        }
        else if(currencySymbol == "ZAR") {
            curSymbol = "ZAR";
        }
        else if(currencySymbol == "UGX") {
            curSymbol = "UGX";
        }
        else if(currencySymbol == "XAF") {
            curSymbol = "XAF";
        }
        else if(currencySymbol == "XOF") {
            curSymbol = "XOF";
        }
        else if(currencySymbol == "ZMK") {
            curSymbol = "ZMK";
        }
        else if(currencySymbol == "ZMW") {
            curSymbol = "ZMW";
        }
        else if(currencySymbol == "BRL") {
            curSymbol = "BRL";
        }
        else if(currencySymbol == "ARS") {
            curSymbol = "ARS";
        }
        else if(currencySymbol == "MXN") {
            curSymbol = "MXN";
        }else {
            curSymbol = "USD";
        }
        
         var donorfname = _("f-name").value;
         var donorlname = _("l-name").value;
         var donoremail = _("donoremail").value;
         var setTip = _("setTip").value;
         var tipamt = _("tipamt").value;
         var fundrezaBy = _("fundrezaBy").value;
         var fundrezaFor = _("fundrezaFor").value;
         var fundrezaId = fundrezaBy.getAttribute("name");
         var donoramount = _("amount").value;
         var amount = donoramount.replace(/,/g, '');
         const API_publicKey = "FLWPUBK_TEST-d66a1984deeccca26ef65212c5784464-X";
         
         if(donoremail != "" && donorfname != "" && donorlname != "" && amount != "") {
             var x = getpaidSetup({
        		PBFPubKey: API_publicKey,
        		customer_email: donoremail,
        		amount: amount,
        		customer_firstname: donorfname,
        		customer_lastname: donorlname,
        		currency: curSymbol,
        		txref: "rave-123456",
        		meta: [{
        			metaname: "flightID",
        			metavalue: "AP1234"
        		}],
        		onclose: function() {},
        		callback: function(response) {
        			var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
        			console.log("This is the response returned after a charge", response);
        			if (
        				response.data.chargeResponseCode == "00" ||
        				response.data.chargeResponseCode == "0"
        			) {
        				// redirect to a success page
        			} else {
        				// redirect to a failure page.
        			}
        
        			x.close(); // use this to close the modal immediately after payment.
        		}
        	});
         }else if(donoremail == "" && donorfname == "" && donorlname == "" && amount != "") {
             var x = getpaidSetup({
        		PBFPubKey: API_publicKey,
        		customer_email: "fundrezahelp@gmail.com",
        		amount: amount,
        		currency: curSymbol,
        		txref: "rave-123456",
        		meta: [{
        			metaname: "flightID",
        			metavalue: "AP1234"
        		}],
        		onclose: function() {},
        		callback: function(response) {
        			var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
        			console.log("This is the response returned after a charge", response);
        			if (
        				response.data.chargeResponseCode == "00" ||
        				response.data.chargeResponseCode == "0"
        			) {
        				// redirect to a success page
        			} else {
        				// redirect to a failure page.
        			}
        
        			x.close(); // use this to close the modal immediately after payment.
        		}
        	});
         }
         
        
}


var dbpBtn = document.getElementById("dpb");
if(dbpBtn) {
    dbpBtn.onclick = function() {
        var spb = document.getElementById("spb");
        if(spb.style.display === "block") {
            spb.style.display = 'none';
        }else {
            spb.style.display ='block';
        }
    }
}

