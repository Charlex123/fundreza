$(document).ready(function(){
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
    
})


    var selectThumbnail = document.querySelectorAll(".empower-thumbnail");
    
    if(selectThumbnail) {
        
        for(var i = 0; i <= selectThumbnail.length; i++) {
            var sTh = selectThumbnail[i];
            if(sTh) {
                sTh.onclick = function() {
                var imgDOc = this.getAttribute("src");
                // sToneMonthDaterepresents current date
                
                if(imgDOc != ""){
             
                    var hr = new XMLHttpRequest();
                    hr.open("POST","empowertalent.php",true);
                    hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    hr.onreadystatechange = function () {
                        if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                            status.style.color = 'red';
                            status.style.fontSize = "14"+"px";
                            status.innerHTML = hr.response;
                            $("#svg-down-arrow").show();
                            document.getElementById("upload-form").style.display = 'block';
                            }
                    }
                    hr.send("empowerThumbnail="+imgDOc);
                }
            }
        }
            
    }
        
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
  


var closeAlert = document.querySelector(".close-alert");
    closeAlert.onclick = function() {
    this.parentElement.style.display = 'none';
}

var closeNow = document.querySelector(".close-now");
    closeNow.onclick = function() {
    this.parentElement.style.display = 'none';
}


function _(e) {
    return document.getElementById(e);
}

var fileobj;
    function upload_file(e) {
        e.preventDefault();
        fileobj = e.dataTransfer.files[0];
        ajax_file_upload(fileobj);
    }
    
    function file_explorer() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function() {
            fileobj = document.getElementById('selectfile').files[0];
            ajax_file_upload(fileobj);
        };
    }
    
    function ajax_file_upload(file_obj) {
        if(file_obj != undefined) {
            var form_data = new FormData();                  
            form_data.append('file', file_obj);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", progressHandler, false);
                    xhr.addEventListener("load", completeHandler, false);
                    xhr.addEventListener("error", errorHandler, false);
                    xhr.addEventListener("abort", abortHandler,false);
                    return xhr;
                },
                type: 'POST',
                url: 'posted.php',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                    // alert(response);
                    $('#selectfile').val('');
                }
            });
        }
    }

    function progressHandler(event) {
        _("loaded-n-total").innerHTML = "Uploaded "+Math.round(event.loaded/1000)+"KB of "+Math.round(event.total/1000)+"KB";
        var percent2 = (event.loaded / event.total) * 100;
        _("upload-progress-bar").style.display = 'block';
        _("upload-progress-bar").value = Math.round(percent2);
        _("status").innerHTML = Math.round(percent2)+" % uploaded..... please wait"; 
    }
    
    function completeHandler(event) {
        _("status").innerHTML = event.target.responseText; 
        _("upload-progress-bar").style.display = 'block';
        _("upload-progress-bar").value = 0;
        _("upload-progress-bar").style.backgroundColor = 'green';
        _("upload-progress-bar").style.color = 'green';
        
    }
    function errorHandler(event) {
        _("status").innerHTML = "upload failed"; 
    }
    function abortHandler(event) {
        _("status").innerHTML = "upload cancelled"; 
    }

// function InvestComut() {
//     var inv_Amt = document.getElementById("auctionAmount").value,
//     selectAuctionValue = $(".bidType :selected").val(),
//     formClass = document.getElementById('deposit_form'),
//     trxfee = inv_Amt * 0.03;
//     transFee = parseInt(Math.round(trxfee));
//     $("#trx-fee").val(transFee);

//     coinAmt = $(".coinAmt");

//     formClassValue = formClass.getAttribute('class');
//     if(formClassValue == 'upgrade-form') {
//         packageType = 'Upgrade';
//     }else if (formClassValue == 'stake-form') {
//         packageType = 'Stake';
//     }
//     var amntotal = parseInt(inv_Amt) + parseInt(transFee);
//     var amnTotal = "<span style='color: red'>"+ amntotal +"<span>";
//     coinAmt.innerHTML = amnTotal + 'Worth Of ';


//     if(selectAuctionValue === 'Starter' && (inv_Amt < 50 || inv_Amt > 500)) {
//         document.getElementById("amtminAlert").innerHTML = 'Starter ' + packageType + "<span style='color: red'>Amount Must Be Between $50 - $500</span>";
//     }else if(selectAuctionValue === 'Starter' && (inv_Amt >= 50 || inv_Amt <= 500)) {
//         document.getElementById("amtminAlert").innerHTML = 'Your Starter' + packageType + 'Amount is '+'$'+ amnTotal;
//     }
    
//     if(selectAuctionValue === 'Elite' && (inv_Amt < 500 || inv_Amt > 1000)) {
//         document.getElementById("amtminAlert").innerHTML = 'Elite ' + packageType + "<span style='color: red'> Amount Must Be Between $500 - $1,000</span>";
//     }else if(selectAuctionValue === 'Elite' && (inv_Amt >= 500 || inv_Amt <= 1000)) {
//         document.getElementById("amtminAlert").innerHTML = 'Your Elite ' + packageType + ' Amount is '+'$'+ amnTotal;
//     }
    
//     if(selectAuctionValue === 'Prime' && (inv_Amt < 1000 || inv_Amt > 10000)) {
//         document.getElementById("amtminAlert").innerHTML = 'Prime ' + packageType + "<span style='color: red'> Amount Must Be Between $1,000 - $10,000</span>";
//     }else if(selectAuctionValue === 'Prime' && (inv_Amt >= 50 || inv_Amt <= 500)) {
//         document.getElementById("amtminAlert").innerHTML = 'Your ' + packageType + ' Amount is '+'$'+ amnTotal;
//     }
    
//     if(selectAuctionValue === 'Pro' && (inv_Amt < 10000 || inv_Amt > 100000)) {
//         document.getElementById("amtminAlert").innerHTML = 'Pro ' + packageType + "<span style='color: red'> Amount Must Be Between $10,000 - $100,000</span>";
//     }else if(selectAuctionValue === 'Pro' && (inv_Amt >= 10000 || inv_Amt <= 100000)) {
//         document.getElementById("amtminAlert").innerHTML = 'Your Pro ' + packageType + ' Amount is '+'$'+ amnTotal;
//     }

    
    
//     // else if(noInvest === 'no-invest' || noInvest == null) {
//     //     document.getElementById("amtminAlert").innerHTML = 'You Must Select Your Investment Type First';
//     // }
//     else if(inv_Amt === '') {
//         document.getElementById("withAlert").innerHTML = 'Bid Amount Cannot be Empty';
//     }
// }



    // const customBtn = document.getElementById('custom-upload-btn');

    // const fileChosen = document.getElementById('selectedfile2');
    
    // customBtn.addEventListener('change', function(){
    //   fileChosen.textContent = this.files[0].name
    // })

   
function empowerTalent(e) {

    selectTag = document.getElementById(e);
    selectedTagactualId = selectTag.getAttribute("id");

    if(selectedTagactualId === 'empowerType') {
        if(selectTag.value === 'Talent') {
            document.getElementById("talent").style.display = 'block';
            document.getElementById("business").style.display = 'none';
            document.getElementById("change").innerHTML = 'Talent';
            document.getElementById("idea").style.display = 'none';
            document.getElementById("sub-form").style.display = 'block';
            document.getElementById("idea").style.display = 'none';
            document.getElementById("text-area").style.display = 'block';

        }else if(selectTag.value === ''){
            document.getElementById("talent").style.display = 'none';
            document.getElementById("business").style.display = 'none';
            document.getElementById("change").innerHTML = '';
            document.getElementById("upload-form").style.display = 'none';
            document.getElementById("sub-form").style.display = 'none';
            document.getElementById("business-plan").style.display = 'none';
            document.getElementById("sub-form").style.display = 'none';
            document.getElementById("idea").style.display = 'none';
            document.getElementById("text-area").style.display = 'none';
            
        }else if(selectTag.value === 'Business'){
            document.getElementById("talent").style.display = 'none';
            document.getElementById("business").style.display = 'block';
            document.getElementById("change").innerHTML = 'Business';
            document.getElementById("sub-form").style.display = 'block';
            document.getElementById("business-plan").style.display = 'block';
            document.getElementById("idea").style.display = 'none';
            document.getElementById("text-area").style.display = 'block';
           
        }else if(selectTag.value === 'Idea'){
            document.getElementById("talent").style.display = 'none';
            document.getElementById("business").style.display = 'none';
            document.getElementById("change").innerHTML = 'Idea';
            document.getElementById("sub-form").style.display = 'block';
            document.getElementById("business-plan").style.display = 'none';
            document.getElementById("idea").style.display = 'block';
            document.getElementById("text-area").style.display = 'block';
           
        }
        
    }else {
       
    }

}


function prevSubmit() {
    _("post-submit-form").onsubmit = function(event) {
        event.preventDefault();
    }
        var postTitle = $("#postTitle").val();
         
        var postContent = $("#postContent").val();
        var postCategory = $("#postCategory").val();
        var postedBy = $("#postedBy").val();
        var status = document.getElementById("status2");
        
        if(postTitle != "" && postContent != ""){
        var hr = new XMLHttpRequest();
        hr.open("POST","posted.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                status.style.color = 'red';
                status.style.fontSize = "14"+"px";
                status.innerHTML = hr.response;
                $("#svg-down-arrow").show();
                document.getElementById("upload-form").style.display = 'block';
                }
        }
        hr.send("postTitle="+postTitle+"&postContent="+postContent+"&postedBy="+postedBy+"&postCategory="+postCategory);
        }
     
}

//  function progressHandler2(event) {
//      _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
//      var percent2 = (event.loaded / event.total) * 100;
//      _("upload-progress-bar2").value = Math.round(percent2);
//      _("status2").innerHTML = Math.round(percent2)+"% uploaded..... please wait"; 
//  }
 
//  function completeHandler2(event) {
//      _("status2").innerHTML = event.target.responseText; 
//      _("upload-progress-bar2").value = 0;
     
//  }
//  function errorHandler2(event) {
//      _("status2").innerHTML = "upload failed"; 
//  }
//  function abortHandler2(event) {
//      _("status2").innerHTML = "upload cancelled"; 
//  }


// var copyButton = $('.fa-question-circle');

//   copyButton.addEventListener('click', function(event) {
//       alert('in')
//   });



function selectbidCycle(e) {
    selectTag = document.getElementById(e);
    selectedTagactualId = selectTag.getAttribute("id");
    
    // $('.bidType').each(function () {
        if ($('.bidType').val() !== '') {
            // If you find any, bail immediately.
            document.getElementById("selectpackageAlert").innerHTML = '';
            if(selectedTagactualId === 'bidCycle') {
                
                if(selectTag.value === '6 Months') {
                    document.getElementById("selectbidcycleAlert").innerHTML = '6 Months Cycle Selected';
        
                }else if(selectTag.value === '1 Year'){
                    document.getElementById("selectbidcycleAlert").innerHTML = '1 Year Cycle Selected';
                }
                
            }else {
                document.getElementById("selectbidcycleAlert").innerHTML = 'Select Cycle First';
            }
            return false;
        }else {
            document.getElementById("selectpackageAlert").innerHTML = 'You Must Select Package To Continue';
        }
    // });

        // $('.bidType option').each(function() {
        //     if (this.selected) {

        //         // alert('this option is selected');
        //         if(selectedTagactualId === 'bidCycle') {
        //             document.getElementById("selectpackageAlert").innerHTML = '';
        //             if(selectTag.value === '6 Months') {
        //                 document.getElementById("selectbidcycleAlert").innerHTML = '6 Months Cycle Selected';
            
        //             }else if(selectTag.value === '1 Year'){
        //                 document.getElementById("selectbidcycleAlert").innerHTML = '1 Year Cycle Selected';
        //             }
                    
        //         }else {
        //             document.getElementById("selectbidcycleAlert").innerHTML = 'Select Cycle First';
        //         }
        //     }
        //     else {
        //         document.getElementById("selectpackageAlert").innerHTML = 'You Must Select Package To Continue';
        //     }
       
// });


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



function post() {
    _("deposit_form").onsubmit = function(event) {
        event.preventDefault();
    }

    var selectAuctionCycle = document.getElementById("bidCycle");
    var selectAuctioncycleValue = selectAuctionCycle.value;
    var selectAuctionType = document.getElementById("auction-type");
    var selectAuctionValue = selectAuctionType.value;
    var aC = _("auctionChannel").value;
    var trx = _("trx-fee").value;

    if(aC === 'Bitcoin') {
        wA = 'bc1q8ceqxqwdhl784y4rq4g9ejcx72w8r38hgszygh';
    }
    if(aC === 'Ethereum') {
        wA = '0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67';
    }
    if(aC === 'Tron') {
        wA = 'TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2';
    }
    if(aC === 'Ripples') {
        wA = '0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67';
    }
    var status4 = document.getElementById("amtAlert");
    var aa = document.getElementById("auctionAmount").value;
    
    
    if(selectAuctionValue != "" && aa != "" &&  aC != "" && wA != "" && selectAuctioncycleValue) {
      
        var hr = new XMLHttpRequest();
        hr.open("POST","bid.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                status4.style.color = 'red';
                status4.style.fontSize = "14"+"px";
                status4.innerHTML = hr.response;
                return false;
                }
        }
        hr.send("auctionAmount="+aa+"&auctionChannel="+aC+"&auction_type="+selectAuctionValue+"&wallet_address="+wA+"&biddingCycle="+selectAuctioncycleValue+"&transFee="+trx);

    }   

}




function upgradeForm() {
    _("deposit_form").onsubmit = function(event) {
        event.preventDefault();
    }

    var selectAuctionCycle = document.getElementById("bidCycle");
    var selectAuctioncycleValue = selectAuctionCycle.value;
    var selectAuctionType = document.getElementById("auction-type");
    var selectAuctionValue = selectAuctionType.value;
    var aC = _("auctionChannel").value;
    var trx = _("trx-fee").value;

    if(aC === 'Bitcoin') {
        wA = 'bc1q8ceqxqwdhl784y4rq4g9ejcx72w8r38hgszygh';
    }
    if(aC === 'Ethereum') {
        wA = '0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67';
    }
    if(aC === 'Tron') {
        wA = 'TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2';
    }
    if(aC === 'Ripples') {
        wA = '0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67';
    }
    var status4 = document.getElementById("amtAlert");
    var aa = document.getElementById("auctionAmount").value;
    
    
    if(selectAuctionValue != "" && aa != "" &&  aC != "" && wA != "" && selectAuctioncycleValue) {
      
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
        hr.send("auctionAmount="+aa+"&auctionChannel="+aC+"&auction_type="+selectAuctionValue+"&wallet_address="+wA+"&biddingCycle="+selectAuctioncycleValue+"&transFee="+trx);

    }   

};



function selectpaymentChannel(e) {
    selectTag = document.getElementById(e);
    selectedTagactualId = selectTag.getAttribute("id");

    if(selectedTagactualId === 'paymentChannel') {
        if(selectTag.value === 'Bitcoin') {
            document.getElementById("bitcoin-payment").style.display = 'block';
            document.getElementById("ethereum-payment").style.display = 'none';
            document.getElementById("Tron-payment").style.display = 'none';
            document.getElementById("Ripples-payment").style.display = 'none';
            
        }else if(selectTag.value === ''){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("ethereum-payment").style.display = 'none';
            document.getElementById("Tron-payment").style.display = 'none';
            document.getElementById("Ripples-payment").style.display = 'none';
            
        }else if(selectTag.value === 'Ethereum'){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("ethereum-payment").style.display = 'block';
            document.getElementById("Tron-payment").style.display = 'none';
            document.getElementById("Ripples-payment").style.display = 'none';
           
        }else if(selectTag.value === 'Tron'){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("ethereum-payment").style.display = 'none';
            document.getElementById("Tron-payment").style.display = 'block';
            document.getElementById("Ripples-payment").style.display = 'none';
           
        }
        else if(selectTag.value === 'Ripples'){
            document.getElementById("bitcoin-payment").style.display = 'none';
            document.getElementById("ethereum-payment").style.display = 'none';
            document.getElementById("Tron-payment").style.display = 'none';
            document.getElementById("Ripples-payment").style.display = 'block';
           
        }
        
    }
}


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
