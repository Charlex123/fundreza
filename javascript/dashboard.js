$(document).ready(function(){

})



var closeErr = document.querySelector(".close-err");
// alert(drpDown)
if(closeErr) {
    // alert(drpDown)
    closeErr.onclick = function() {
        this.parentElement.style.display = 'none';
        
    };
}



function _(e) {
    return document.getElementById("e");
}


function closeM() {
    closem = document.getElementById("close");
    closem.parentElement.parentElement.parentElement.style.display ='none';
    closem.parentElement.parentElement.style.display ='none';
    $('.modal-backdrop').remove();
    window.location.reload(false);
}



var drpDown = document.querySelector(".nav-item.dropdown");
// alert(drpDown)
if(drpDown) {
    // alert(drpDown)
    drpDown.onclick = function() {
        var drD = this.firstElementChild.nextElementSibling;
        console.log(this)
        console.log(drD)
        drD.style.display = "none";
        if(drD.style.display == "block") {
            drD.style.display = "none";
            drpDown.firstElementChild.lastElementChild.classList.add('fa-angle-down');
            drpDown.firstElementChild.lastElementChild.classList.remove('fa-angle-up');
        }else if(drD.style.display == "none") {
            drD.style.display = "block";
            drpDown.firstElementChild.lastElementChild.classList.add('fa-angle-up');
            drpDown.firstElementChild.lastElementChild.classList.remove('fa-angle-down');
        }
    };

    drpDown.onmouseenter = function() {
        drpDown.firstElementChild.lastElementChild.classList.add('fa-angle-up');
        drpDown.firstElementChild.lastElementChild.classList.remove('fa-angle-down');
    };
    drpDown.onmouseout = function () {
        drpDown.firstElementChild.lastElementChild.classList.add('fa-angle-down');
        drpDown.firstElementChild.lastElementChild.classList.remove('fa-angle-up');
    };
}


fuP = document.querySelectorAll(".fupp");
if(fuP) {
    for(var i = 0; i <= fuP.length; i++) {
        var fupC = fuP[i];
        fupC.onclick = function() {
            drpnC = document.getElementById("drpn");
            var fupId = this.getAttribute("name");

        var ajax = new XMLHttpRequest();
        ajax.open("POST","fupdate.php",true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.onreadystatechange = function () {
            if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                drpnC.innerHTML = ajax.responseText;
                return false;
            }
        }
        ajax.send("fup="+fupId);

        }
    }
    
}



function getId() {
    let ffiid = document.getElementById("fup").getAttribute("name");
    
    let preS = document.getElementById("preSub");
    preS.onclick = function() {
        document.getElementById("prvsub").onsubmit = function(event) {
            event.preventDefault();
        }
        var update = document.getElementById("textarea").value
        var fupcId = ffiid;
        var res = document.getElementById("err");
        var v = new XMLHttpRequest();
        v.open("POST","updatebid.php",true);
        v.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        v.onreadystatechange = function () {
            if((v.readyState == 4) && (v.status == 200 || v.status == 304) ) {
                res.innerHTML = v.responseText;
                alert(v.response)
                window.location.reload(true);
                return false;
            }
        }
        v.send("fUpdate="+update+"&fid="+fupcId);

    }
}




function shareNow() {
    let ffiis = document.getElementById("fuS").getAttribute("name");
    
    let preS = document.getElementById("preSub");
    preS.onclick = function() {
        document.getElementById("pvsub").onsubmit = function(event) {
            event.preventDefault();
        }
        var update = document.getElementById("textarea").value
        var fupcId = ffiis;
        var res = document.getElementById("err");
        var v = new XMLHttpRequest();
        v.open("POST","updatebid.php",true);
        v.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        v.onreadystatechange = function () {
            if((v.readyState == 4) && (v.status == 200 || v.status == 304) ) {
                res.innerHTML = v.responseText;
                alert(v.response)
                window.location.reload(true);
                return false;
            }
        }
        v.send("fUpdate="+update+"&fid="+fupcId);

    }
}




("textarea").addEventListener("input", function (event) {
    var target = event.currentTarget;
    var maxLength = target.getAttribute("maxlength");
    var currentLength = target.value.length;
    if(currentLength >= maxLength) {
      _("count1").innerHTML = maxLength - currentLength;
      _("count2").innerHTML = maxLength - currentLength;
    }else {
      _("count1").innerHTML = maxLength - currentLength;
      _("count2").innerHTML = maxLength - currentLength;
    }
  })
