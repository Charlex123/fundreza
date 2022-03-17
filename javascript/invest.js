var toggleFaq = document.querySelectorAll(".toggle-faq");
    if(toggleFaq) {
        for(i = 0; i <= toggleFaq.length; i++) {
            var togBtn = toggleFaq[i];
                togBtn.addEventListener("click",function() {
                    var panelBlock = this.parentElement.parentElement.nextElementSibling;
                if(panelBlock.style.display === 'block') {
                    panelBlock.style.display = 'none';
                    this.innerHTML = "<i class='fas fa-angle-down'></i>";
                }else {
                    panelBlock.style.display = 'block';
                    this.innerHTML = "<i class='fas fa-angle-up'></i>";
                }
            })
        }
    }


    var closeerr = document.querySelector(".close-err");
    closeerr.onclick = function (){
        this.parentElement.style.display = 'none';
    }


var payoutInvests = document.getElementById("payouts");

if(payoutInvests) {
    var a = 100000;
var b = 108995;

// document.getElementsByClassName("counter").innerHTML = commaSeparateNumber(a);

document.getElementById("payouts").innerHTML = commaSeparateNumber(a);

function animate(opts) {

    var start = new Date;

    var id = setInterval(function () {
        var timePassed = new Date - start
        var progress = timePassed / opts.duration

        if (progress > 1) progress = 1

        var delta = progress;
        opts.step(delta)

        if (progress == 1) {
            clearInterval(id)
        }
    }, opts.delay || 10)

}

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}

payouts = function () {
    animate({
        delay: 1000,
        duration: 10000,
        step: function (progress) {
            var difference = b - a;
            document.getElementById("payouts").innerHTML = commaSeparateNumber(a + Math.round(progress * difference));
        }
    });
}

}



var ppayout = document.getElementById("pending-payouts");

if(ppayout) {
    var x = 42300;
var y = 51995;

// document.getElementsByClassName("counter").innerHTML = commaSeparateNumber(a);

document.getElementById("pending-payouts").innerHTML = commaSeparateNumber(x);

function animate(opts) {

    var start = new Date;

    var id = setInterval(function () {
        var timePassed = new Date - start
        var progress = timePassed / opts.duration

        if (progress > 1) progress = 1

        var delta = progress;
        opts.step(delta)

        if (progress == 1) {
            clearInterval(id)
        }
    }, opts.delay || 10)

}

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}

ppayouted = function () {
    animate({
        delay: 1000,
        duration: 10000,
        step: function (progress) {
            var difference = y - x;
            document.getElementById("pending-payouts").innerHTML = commaSeparateNumber(x + Math.round(progress * difference));
        }
    });
}

}

var investorCountsD = document.getElementById("investorcount");

if(investorCountsD) {
    
var c = 140;
var d = 216;

// document.getElementsByClassName("counter").innerHTML = commaSeparateNumber(a);

document.getElementById("investorcount").innerHTML = commaSeparateNumber(c);

function animate(opts) {

    var start = new Date;

    var id = setInterval(function () {
        var timePassed = new Date - start
        var progress = timePassed / opts.duration

        if (progress > 1) progress = 1

        var delta = progress;
        opts.step(delta)

        if (progress == 1) {
            clearInterval(id)
        }
    }, opts.delay || 10)

}

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}

investorsCount = function () {
    animate({
        delay: 1000,
        duration: 10000,
        step: function (progress) {
            var difference = d - c;
            document.getElementById("investorcount").innerHTML = commaSeparateNumber(c + Math.round(progress * difference));
        }
    });
}

}


var totalinvest = document.getElementById("totalinvest");

if(totalinvest) {
    var e = 200000;
var f = 204785;

// document.getElementsByClassName("counter").innerHTML = commaSeparateNumber(a);

document.getElementById("totalinvest").innerHTML = commaSeparateNumber(e);

function animate(opts) {

    var start = new Date;

    var id = setInterval(function () {
        var timePassed = new Date - start
        var progress = timePassed / opts.duration

        if (progress > 1) progress = 1

        var delta = progress;
        opts.step(delta)

        if (progress == 1) {
            clearInterval(id)
        }
    }, opts.delay || 10)

}

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}

totalInvestors = function () {
    animate({
        delay: 1000,
        duration: 10000,
        step: function (progress) {
            var difference = f - e;
            document.getElementById("totalinvest").innerHTML = commaSeparateNumber(e + Math.round(progress * difference));
        }
    });
}

}



function isInView(elem){
    return $(elem).offset().top - $(window).scrollTop() < $(elem).height() ;
 }
 $(window).scroll(function(){
    if (isInView($('.investors-counter')))
        //fire whatever you what 
        payouts();
        ppayouted();
        investorsCount();
        totalInvestors();
 });

    var coinAmt = document.getElementById("coinAmt");
    var invAmnt = document.getElementById("inv-amount");
    invAmnt.style.display = 'none'; 
    // In your Javascript (external .js resource or <script> tag)
    var withdrawCont =  document.getElementById("withdraw-container");
    
    if(withdrawCont) {
        withdrawCont.style.display= 'none';   
    }
    
    var selectedforWithdraw = document.querySelectorAll(".form-checkbox");
    
    if(selectedforWithdraw) {
        
        for(var i = 0; i <= selectedforWithdraw.length; i++) {
            var sT = selectedforWithdraw[i];
            if(sT) {
                sT.onclick = function() {
                var sToneMonthDate = this.previousElementSibling.getAttribute("value");
                // sToneMonthDaterepresents current date
                
                var sTTotalEarning = this.previousElementSibling.getAttribute("name");
                var sTinvtAmt = this.previousElementSibling.previousElementSibling.getAttribute("id");
                var sTDate = this.previousElementSibling.getAttribute("id");
                
                if(sTTotalEarning === sTinvtAmt ) {
                    withdrawCont.style.display= 'none';
            document.getElementById("no-earnings-found").innerHTML = "<div style='font-weight:bold' class='alert-success'> No Earnings Found <br><span style='color:gray'>You can only withdraw when you have earnings</span></div>";
                }else if(sToneMonthDate > sTDate) {
                    withdrawCont.style.display= 'none';
            document.getElementById("no-earnings-found").innerHTML = "<div style='font-weight:bold' class='alert-success'> You Must Complete Investment Window Of At Least 30 Days To Be Able To Withdraw</div>";
                }else if(sTDate >= sToneMonthDate && sTTotalEarning === sTinvtAmt){
                    withdrawCont.style.display= 'block';
                }
            }
        }
            
    }
        
    }
     
    
    var reqLoanForm = document.getElementById("request-loan-fm");
    if(reqLoanForm) {
        reqLoanForm.style.display = 'none';
    }
    

function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
  
    //
    // *** This styling is an extra step which is likely not required. ***
    //
    // Why is it here? To ensure:
    // 1. the element is able to have focus and selection.
    // 2. if element was to flash render it has minimal visual impact.
    // 3. less flakyness with selection and copying which **might** occur if
    //    the textarea element is not visible.
    //
    // The likelihood is the element won't even render, not even a
    // flash, so some of these are just precautions. However in
    // Internet Explorer the element is visible whilst the popup
    // box asking the user for permission for the web page to
    // copy to the clipboard.
    //
  
    // Place in top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
  
    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';
  
    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;
  
    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
  
    // Avoid flash of white box if rendered for any reason.
    textArea.style.background = 'transparent';
  
  
    textArea.value = text;
  
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
  
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'successful' : 'unsuccessful';
      console.log('Copying text command was ' + msg);
    } catch (err) {
      console.log('Oops, unable to copy');
    }
  
    document.body.removeChild(textArea);
  }
  
  
  var copyWalletAddress = $(".wallet-address").val();
  var copyButton = $('.copied');

  copyButton.addEventListener('click', function(event) {
      var textToCopy = copyWalletAddress;
      copyButton.innerHTML = 'Copied';
      alert(textToCopy);
    copyTextToClipboard(textToCopy);
  });
  
  


// var closeAlert = document.querySelector(".close-alert");
//     closeAlert.onclick = function() {
//     this.parentElement.style.display = 'none';
// }

// var closeNow = document.querySelector(".close-now");
//     closeNow.onclick = function() {
//     this.parentElement.style.display = 'none';
// }


function _(e) {
    return document.getElementById(e);
}


function InvestComut() {
    var inv_Amt = document.getElementById("auctionAmount").value,
    selectAuctionValue = $(".bidType :selected").val(),
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





function selectInvestmentPackage(e) {
    
    selectTag = document.getElementById(e);
    selectedTagactualId = selectTag.getAttribute("id");
    

    if(selectedTagactualId === 'investmentPackage') {
        document.getElementById("amtAlert").innerHTML = '';
        if(selectTag.value === 'Basic') {
            amnTotal = '$295';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","295");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'block';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');

        }else if(selectTag.value === ''){
            amnTotal = '$295';
            document.getElementById("inv-amount").style.display = 'none';
            document.getElementById("auth-amount").innerHTML = '';
            document.getElementById("bitcoin-invest").style.display = 'none';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = '';
            $(".coinAmt").val('');
            
        }else if(selectTag.value === 'Carbon'){
            amnTotal = '$590';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","590");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'block';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'Fibre'){
            amnTotal = '$1,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","1000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'block';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'Steel'){
            amnTotal = '$2,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","2000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'block';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'Bronze'){
            amnTotal = '$5,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","5000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'block';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'Silver'){
            amnTotal = '$20,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","20000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'block';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'Gold'){
            amnTotal = '$50,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","50000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'block';
            document.getElementById("vip-p").style.display = 'none';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }else if(selectTag.value === 'VIP'){
            amnTotal = '$100,000';
            document.getElementById("inv-amount").style.display = 'block';
            document.getElementById("auth-amount").setAttribute("value","100000");
            document.getElementById("bitcoin-invest").style.display = 'block';
            document.getElementById("basic-p").style.display = 'none';
            document.getElementById("carbon-p").style.display = 'none';
            document.getElementById("fibre-p").style.display = 'none';
            document.getElementById("steel-p").style.display = 'none';
            document.getElementById("bronze-p").style.display = 'none';
            document.getElementById("silver-p").style.display = 'none';
            document.getElementById("gold-p").style.display = 'none';
            document.getElementById("vip-p").style.display = 'block';
            coinAmt.innerHTML = amnTotal + ' Worth Of ';
            $(".coinAmt").val(amnTotal + ' Worth Of ');
           
        }

        
    }else {
        document.getElementById("amtAlert").innerHTML = 'Enter Amount First';
    }

}



function withdrawComut() {
    var inv_Amt = document.getElementById("withdrawalAmount").value;
    var invType = $("input[type='radio'][name='investment_type']:checked").val();
    var noInvest = document.getElementById("no-invest");

    var totalEarnings =  document.getElementById("earnings");
    if(totalEarnings) {
        var totEarnVal = totalEarnings.getAttribute("value");
        if(totEarnVal === '0') {
            document.getElementById("no-earnings-found").innerHTML = 'No Earnings Found';
        }else if(totEarnVal > '0'){
            
            if(inv_Amt > totEarnVal) {
                totEarnValue = totEarnVal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("amtminAlert").innerHTML = 'You Cannot Withdraw More Than ' + totEarnValue.split(',');
                return false;
            }else if(inv_Amt < totEarnVal){
                inv_AMT = inv_Amt.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("amtminAlert").innerHTML = 'You Are Withdrawing ' + inv_AMT;
                return false;
            }
            if(inv_Amt === '') {
                document.getElementById("amtminAlert").innerHTML = 'Withdrawal Amount Cannot be Empty';
            }
            else {
                document.getElementById("amtminAlert").innerHTML = '';
            }
        }
    }

    if(invType === '' || invType == null) {
        document.getElementById("withAlert").innerHTML = 'You Must Select Your Investment Type First';
    }else {
        document.getElementById("withAlert").innerHTML = invType+ ' Selected';
    }
    // if(noInvest != null || noInvest.getAttribute("name") === 'no-invest') {
    //     document.getElementById("amtminAlert").innerHTML = 'You Must Select Your Investment Type First';
    // }
    
}


function selectWithdrawalChannel() {
    selectTag = document.getElementById("withdrawalChannel");
    selectedTagactualId = document.getElementById("withdrawalChannel");
    var cl = selectTag;
    var invAmt = document.getElementById("withdrawalAmount").value;
    
    if(invAmt !== "") {
        document.getElementById("amtAlert").innerHTML = '';
        if(selectTag.value === 'Bitcoin') {
            document.getElementById("bitcoin-withdrawal").style.display = 'block';
            document.getElementById("ethereum-withdrawal").style.display = 'none';
            document.getElementById("Tron-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'none';
            
        }else if(selectTag.value === ''){
            document.getElementById("bitcoin-withdrawal").style.display = 'none';
            document.getElementById("ethereum-withdrawal").style.display = 'none';
            document.getElementById("Tron-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'none';
            document.getElementById("bank-wire-withdrawal").style.display = 'none';
            
        }else if(selectTag.value === 'Ethereum'){
            document.getElementById("bitcoin-withdrawal").style.display = 'none';
            document.getElementById("ethereum-withdrawal").style.display = 'block';
            document.getElementById("Tron-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'none';
            document.getElementById("bank-wire-withdrawal").style.display = 'none';
           
        }else if(selectTag.value === 'Tron'){
            document.getElementById("bitcoin-withdrawal").style.display = 'none';
            document.getElementById("ethereum-withdrawal").style.display = 'none';
            document.getElementById("Tron-withdrawal").style.display = 'block';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'none';
            document.getElementById("bank-wire-withdrawal").style.display = 'none';
           
        }else if(selectTag.value === 'Bank Wire' && invAmt < 50000){
            document.getElementById("bitcoin-withdrawal").style.display = 'none';
            document.getElementById("ethereum-withdrawal").style.display = 'none';
            document.getElementById("Tron-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'none';
            document.getElementById("bank-wire-withdrawal").style.display = 'block';

        }else if(selectTag.value === 'Bank Wire' && invAmt >= 50000) {
            document.getElementById("bitcoin-withdrawal").style.display = 'none';
            document.getElementById("ethereum-withdrawal").style.display = 'none';
            document.getElementById("Tron-withdrawal").style.display = 'none';
            document.getElementById("bank-wire-withdrawal-50000plus").style.display = 'block';
            document.getElementById("bank-wire-withdrawal").style.display = 'none';
        }

        
    }else {
        document.getElementById("amtAlert").innerHTML = 'Enter Amount First';
    }
}



function preventSubmit() {
    _("withdrawal_form").onsubmit = function(event) {
        event.preventDefault();
    }

    var status4 = document.getElementById("amtAlert");
    var invType = $("input[type='radio'][name='investment_type']:checked").val();
    var wa = _("withdrawalAmount").value;
    var wc = _("withdrawalChannel").value;
    var totalEarnings =  document.getElementById("earnings");
    var earnings = totalEarnings.getAttribute("value");
    var invCur =  document.getElementById("investment_currency");
    var ic = invCur.getAttribute("value");
    var wA = _("wallet-address").value;
    var wr = _("withdrawalReason").value;

    
    if(invType != "" && wa != "" &&  wc != "" && earnings != "" && wA != "" && wr !="") {
       
        var hr = new XMLHttpRequest();
        hr.open("POST","withdraw.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                status4.style.color = 'red';
                status4.style.fontSize = "14"+"px";
                status4.innerHTML = hr.response;
                }
        }
        hr.send("withdrawalAmount="+wa+"&withdrawalChannel="+wc+"&investment_type="+invType+"&withdrawalReason="+wr+"&wallet-address="+wA+"&totalEarnings="+earnings+"&investment_currency="+ic);

    }   

};





function InvestmentForm() {
    _("deposit_form").onsubmit = function(event) {
        event.preventDefault();
    }

    var selectInvestmentPack = document.getElementById("investmentPackage").value;
    var wA = _("btc-address").value;
    
    var status4 = document.getElementById("amtAlert");
    var aa = document.getElementById("auth-amount").value;
    
    
    if(selectInvestmentPack != "" && aa != "" && wA != "") {
        var hr = new XMLHttpRequest();
        hr.open("POST","upgrade.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                status4.style.color = 'red';
                status4.style.fontSize = "14"+"px";
                status4.innerHTML = hr.response;
                return false;
                }
        }
        hr.send("investmentPackage="+selectInvestmentPack+"&investmentAmount="+aa+"&wallet_address="+wA);

    }   

};



function selectpaymentChannel(e) {
    selectTag = document.getElementById(e);
    selectedTagactualId = selectTag.getAttribute("id");

    if(selectedTagactualId === 'paymentChannel') {
        if(selectTag.value === 'Bitcoin') {
            document.getElementById("bitcoin-payment").style.display = 'block';
            document.getElementById("bank-wire-invest").style.display = 'none';
            
        }else if(selectTag.value === ''){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("bank-wire-invest").style.display = 'none';
            
        }else if(selectTag.value === 'Ethereum'){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("bank-wire-invest").style.display = 'none';
           
        }else if(selectTag.value === 'Bank-Wire'){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("bank-wire-invest").style.display = 'block';
            
           
        }
        
    }
}


function paymentDetails() {
    _("payment_det_form").onsubmit = function(event) {
        event.preventDefault();
    }

    var status4 = document.getElementById("amtAlert"),
    selectpaymentmethodValue = $("#paymentChannel :selected").val(),
    wc = _("paymentChannel").value;
    
    wA = _('wallet-address').value;

    if (wc != "" && wA != "") {
       
        var hr = new XMLHttpRequest();
        hr.open("POST","addpayment.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                status4.style.color = 'red';
                status4.style.fontSize = "14"+"px";
                status4.innerHTML = hr.response;
                // window.location.reload(false);
                return false;
                }
        }
        hr.send("paymentChannel="+wc+"&wallet-address="+wA);

    }   

};




    function uploadTestimony(e) {
        
        customtarget = document.getElementById(e),
        actualid = customtarget.getAttribute("id"),
        selectedFile = _("selected-file");
        
        
        customtarget.click();
        var file = customtarget.files;
        
        customtarget.addEventListener("change",function(event) {
            
            event.handled = false;
            if(actualid === "testimony-upload-btn") {
                if(file.length === 1) {
                    event.handled = true;
                    var file1 = _("testimony-upload-btn").files[0];
                    
                    selectedFile.innerHTML = file1.name;
                    
                }                     
            }
    
            })
    
        }


//         import 'package:flutter/material.dart';

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   // This widget is the root of your application.
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Flutter Demo',
//       theme: ThemeData(
//         // This is the theme of your application.
//         //
//         // Try running your application with "flutter run". You'll see the
//         // application has a blue toolbar. Then, without quitting the app, try
//         // changing the primarySwatch below to Colors.green and then invoke
//         // "hot reload" (press "r" in the console where you ran "flutter run",
//         // or simply save your changes to "hot reload" in a Flutter IDE).
//         // Notice that the counter didn't reset back to zero; the application
//         // is not restarted.
//         primarySwatch: Colors.blue,
//       ),
//       home: MyHomePage(title: 'Flutter Demo Home Page'),
//     );
//   }
// }

// class MyHomePage extends StatefulWidget {
//   MyHomePage({Key key, this.title}) : super(key: key);

//   // This widget is the home page of your application. It is stateful, meaning
//   // that it has a State object (defined below) that contains fields that affect
//   // how it looks.

//   // This class is the configuration for the state. It holds the values (in this
//   // case the title) provided by the parent (in this case the App widget) and
//   // used by the build method of the State. Fields in a Widget subclass are
//   // always marked "final".

//   final String title;

//   @override
//   _MyHomePageState createState() => _MyHomePageState();
// }

// class _MyHomePageState extends State<MyHomePage> {
//   int _counter = 0;

//   void _incrementCounter() {
//     setState(() {
//       // This call to setState tells the Flutter framework that something has
//       // changed in this State, which causes it to rerun the build method below
//       // so that the display can reflect the updated values. If we changed
//       // _counter without calling setState(), then the build method would not be
//       // called again, and so nothing would appear to happen.
//       _counter++;
//     });
//   }

//   @override
//   Widget build(BuildContext context) {
//     // This method is rerun every time setState is called, for instance as done
//     // by the _incrementCounter method above.
//     //
//     // The Flutter framework has been optimized to make rerunning build methods
//     // fast, so that you can just rebuild anything that needs updating rather
//     // than having to individually change instances of widgets.
//     return Scaffold(
//       appBar: AppBar(
//         // Here we take the value from the MyHomePage object that was created by
//         // the App.build method, and use it to set our appbar title.
//         title: Text(widget.title),
//       ),
//       body: Center(
//         // Center is a layout widget. It takes a single child and positions it
//         // in the middle of the parent.
//         child: Column(
//           // Column is also a layout widget. It takes a list of children and
//           // arranges them vertically. By default, it sizes itself to fit its
//           // children horizontally, and tries to be as tall as its parent.
//           //
//           // Invoke "debug painting" (press "p" in the console, choose the
//           // "Toggle Debug Paint" action from the Flutter Inspector in Android
//           // Studio, or the "Toggle Debug Paint" command in Visual Studio Code)
//           // to see the wireframe for each widget.
//           //
//           // Column has various properties to control how it sizes itself and
//           // how it positions its children. Here we use mainAxisAlignment to
//           // center the children vertically; the main axis here is the vertical
//           // axis because Columns are vertical (the cross axis would be
//           // horizontal).
//           mainAxisAlignment: MainAxisAlignment.center,
//           children: <Widget>[
//             Text(
//               'You have pushed the button this many times:',
//             ),
//             Text(
//               '$_counter',
//               style: Theme.of(context).textTheme.headline4,
//             ),
//           ],
//         ),
//       ),
//       floatingActionButton: FloatingActionButton(
//         onPressed: _incrementCounter,
//         tooltip: 'Increment',
//         child: Icon(Icons.add),
//       ), // This trailing comma makes auto-formatting nicer for build methods.
//     );
//   }
// }
