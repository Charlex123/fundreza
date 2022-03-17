$(document).ready(function(){

})


document.onreadystatechange = function () {
    if (document.readyState === "complete") {
        document.getElementById("circular-progress-bar").style.display = "none";
        document.getElementById("layer").style.display = "none";
    }
}


function _(e) {
    return document.getElementById(e);
}



var start = 12;
var limit = 1;
var start1 = 24;
var limit1 = 1;
var start2 = 2;
var limit2 = 1;
var start3 = 1;
var limit3 = 1;
var reachedMax = false;



function loadmoreAds() {
   
    if (reachedMax){
        
    return false;
    }
    $.ajax({
        url: "loadmoreads.php",
        method: "POST",
        dataType: "text",
        data:{
            loadmoreAds:1,
            start:start,
            limit:limit
        },
        success: function (response) {
            if(response == reachedMax) {
                reachedMax == true;
                return false;
               }else {
                start += limit;
                $(".show_all").append(response);
                return false;
                }
            }
    })
}


function loadmyAds() {
    loadmoreAds();

}


function loadmoreItems() {
   
    if (reachedMax){
        
    return false;
    }
    $.ajax({
        url: "loadmoreitems.php",
        method: "POST",
        dataType: "text",
        data:{
            loadmoreItems:1,
            start1:start1,
            limit1:limit1
        },
        success: function (response) {
            if(response == reachedMax) {
                console.log(reachedMax)
                console.log(response)
                reachedMax == true;
                return false;
               }else {
                start1 += limit1;
                $(".show._all").append(response);
                // console.log(response)
                return false;
                }
            }
        })
}



function loadmoreRec() {
   var coder = $("#load-more-rec").attr("name");
    if (reachedMax){
        
    return false;
    }
    $.ajax({
        url: "loadmorerecommendations.php",
        method: "POST",
        dataType: "text",
        data:{
            loadmoreRec:1,
            start3:start3,
            limit3:limit3,
            code:coder
        },
        success: function (response) {
            if(response == reachedMax) {
                reachedMax == true;
                $("#load-more-rec").html('No More Data');
                return false;
               }else {
                start3 += limit3;
                $(".rec.down").append(response);
                return false;
                }
            }
        })
}




function loadmoreitemsbyCategory() {
   var category = document.getElementById("showal").getAttribute("name");
    if (reachedMax){
        
    return false;
    }
    $.ajax({
        url: "loadmoreitembycategory.php",
        method: "POST",
        dataType: "text",
        data:{
            loadmoreitemsbyCategory:1,
            start2:start2,
            limit2:limit2,
            category:category
        },
        success: function (response) {
            if(response == reachedMax) {
                reachedMax == true;
                return false;
               }else {
                start2 += limit2;
                $(".show._al").append(response);
                return false;
                }
            }
        })
}




function linkmeTo() {
    document.getElementById("bbbx").onsubmit = function(ev) {
        ev.preventDefault();
    }
    
    var tit = _("btitle").value;
    var bsurl = _("bsurl").value;
    var bcode = _("bcode").value;
    var bmail = _("bemail").value;
    var bprice = _("bprice").value;
    var bcat = _("bcateg").value;

    if(tit !="" && tit != null && bsurl !="" && bsurl != null && bcode !="" && bcode != null && bmail !="" && bmail != null && bcat !="" && bcat != null) {
        var hr = new XMLHttpRequest();
        hr.open("POST","getbuyers.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                var win = window.open('http://'+bsurl,'_blank');
                win.focus();
            }
        }
        hr.send("surl="+bsurl+"&title="+tit+"&item_code="+bcode+"&email_of_ad_poster="+bmail+"&amount="+bprice+"&item_category="+bcat);
    }
}




Notification.requestPermission();
var eventnotification = new Notification("Check out these new items you will love",{
   image: "https://mysearch.ng/images/search9.jpg",
   icon: "https://mysearch.ng/images/M1.png",
   timeout:9000
});

eventnotification.onclick = function() {
    location.href = 'https://mysearch.ng';
}
