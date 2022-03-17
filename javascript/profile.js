$(document).ready(function(){
    var showform = document.getElementById("container");
    showform.style.display = 'none';
    var postreitem = document.getElementById("postitem");
    postreitem.style.display = 'none';
    document.getElementById("item_img_upload").style.display = 'none';
    var subaccdet = document.getElementById("submitaccdet");
    subaccdet.style.display = 'none';
    var popimg = document.getElementById("pop_imageuploads");
    popimg.style.display = 'none';
    var webad = document.getElementById("website-ad");
    webad.style.display = 'none';
    var otherad = document.getElementById("other-ad");
    otherad.style.display = 'none';
})



function editProfile() {
    
    var showform = document.getElementById("container");
    var coverdep = document.getElementById("layer");
    showform.style.display = 'block';
    coverdep.style.display = 'block';

    var clearreg = document.getElementById("closereg");
    clearreg.onclick = function () {
    this.parentElement.style.display = 'none';
    coverdep.style.display = 'none';
    }
}

function postAd() {
    var postreitem = document.getElementById("postitem");
    var cover = document.getElementById("layer");
    postreitem.style.display = 'block';
    cover.style.display = 'block';
    
    var clearreg = document.getElementById("closereg1");
    clearreg.onclick = function () {
    
    this.parentElement.style.display = 'none';
    cover.style.display = 'none';
    }
}


//call namecheck function on register.php
function namecheck() {
    
    var status1 = document.getElementById("nameStatus");
    
    var u = document.getElementById("namechk").value;
    
    if(u !="" && u != null) {
        status1.innerHTML = '....checking';
        status1.style.color = 'red';
        var hr = new XMLHttpRequest();
        hr.open("POST","check.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status1.style.color = 'red';
                status1.innerHTML = hr.response;
            }
        }
        hr.send("name="+u);
    }else {
        status1.style.color = 'red';
        status1.innerHTML = 'name cannot be empty!!';
    }

};

function phcheck() {
   
    var status4 = document.getElementById("phStatus");
    status4.style.display = 'block';
    var ph = document.getElementById("phonechk").value;
    
    if(ph !="" ) {
        status4.innerHTML = '....processing';
        status4.style.color = 'red';
        var hr = new XMLHttpRequest();
        hr.open("POST","check.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status4.style.color = 'red';
                status4.innerHTML = hr.responseText;
                
            }
        }
        hr.send("phonenumber="+ph);
    }

};

function _(e) {
    return document.getElementById(e);
}

function customSelect(e) {
    
    var customtarget = document.getElementById(e);
    var actualid = customtarget.getAttribute("id");
    var picxs = document.getElementById("pics-x");


    customtarget.click();
    var file = customtarget.files;
    
    customtarget.addEventListener("change",function() {
        if(actualid === "profile_pix") {
            if(file.length === 1) {
                var file1 = _("profile_pix").files[0];
                
                var formdata1 = new FormData();

                    formdata1.append("profile_pix", file1);
                    
                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler0, false);
                ajax.addEventListener("load", completeHandler0, false);
                ajax.addEventListener("error", errorHandler0, false);
                ajax.addEventListener("abort", abortHandler0, false);
                ajax.open("POST","upload_pics.php",true);
                ajax.send(formdata1);

                if(picxs != "" && picxs != null) {
                    
                    var hr = new XMLHttpRequest();
                    hr.open("POST","update-profile-pics.php",true);
                    hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    hr.onreadystatechange = function () {
                        if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                            picxs.innerHTML = hr.response;
                            }
                    }
                    hr.send("p-pics-update="+picxs);
                    
                }

                function progressHandler0(event) {
    
                }
                
                function completeHandler0(event) {
                    _("status1").innerHTML = event.target.responseText; 
                    //_("upload-progress-bar1").value = 0;
                    
                }
                function errorHandler0(event) {
                    _("status1").innerHTML = "upload failed"; 
                }
                function abortHandler0(event) {
                    _("status1").innerHTML = "upload cancelled"; 
                }
                
                     
            }
            
        }


            
            if(actualid === 'item_images_upload') {
            
            var file2 = _("item_images_upload").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage");

                function progressHandler(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                function completeHandler(event) {
                    _("status2").innerHTML = event.target.responseText; 
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler(event) {
                
                }
                function abortHandler(event) {
                    
                }
        }




        if(actualid === 'item_images_upload1') {
            
            var file2 = _("item_images_upload1").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler1, false);
                ajax.addEventListener("load", completeHandler1, false);
                ajax.addEventListener("error", errorHandler1, false);
                ajax.addEventListener("abort", abortHandler1, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage1");
                
                function progressHandler1(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                
                function completeHandler1(event) {
                    _("status2").innerHTML = event.target.responseText;
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler1(event) {
                
                }
                function abortHandler1(event) {
                    
                }

        }


        if(actualid === 'item_images_upload2') {
            
            var file2 = _("item_images_upload2").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler2, false);
                ajax.addEventListener("load", completeHandler2, false);
                ajax.addEventListener("error", errorHandler2, false);
                ajax.addEventListener("abort", abortHandler2, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage2");
                
                function progressHandler2(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                
                function completeHandler2(event) {
                    _("status2").innerHTML = event.target.responseText;
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler2(event) {
                
                }
                function abortHandler2(event) {
                    
                }

        }


        if(actualid === 'item_images_upload3') {
            
            var file2 = _("item_images_upload3").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler3, false);
                ajax.addEventListener("load", completeHandler3, false);
                ajax.addEventListener("error", errorHandler3, false);
                ajax.addEventListener("abort", abortHandler3, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage3");
                
                function progressHandler3(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                
                function completeHandler3(event) {
                    _("status2").innerHTML = event.target.responseText;
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler3(event) {
                
                }
                function abortHandler3(event) {
                    
                }

        }


        if(actualid === 'item_images_upload4') {
            
            var file2 = _("item_images_upload4").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler4, false);
                ajax.addEventListener("load", completeHandler4, false);
                ajax.addEventListener("error", errorHandler4, false);
                ajax.addEventListener("abort", abortHandler4, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage4");
                
                function progressHandler4(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                
                function completeHandler4(event) {
                    _("status2").innerHTML = event.target.responseText;
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler4(event) {
                
                }
                function abortHandler4(event) {
                    
                }

        }


        if(actualid === 'item_images_upload5') {
            
            var file2 = _("item_images_upload5").files[0];
                
            var formdata2 = new FormData();

                formdata2.append("item_images_upload", file2);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler5, false);
                ajax.addEventListener("load", completeHandler5, false);
                ajax.addEventListener("error", errorHandler5, false);
                ajax.addEventListener("abort", abortHandler5, false);
                ajax.open("POST","post_item.php",true);
        
                ajax.send(formdata2);
                
                
                document.getElementById("hid_submit").style.display = 'block';
                document.getElementById("hide_submt").style.display = 'none';
                var bgi = document.getElementById("bgimage5");
                
                function progressHandler5(event) {
                    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                    var percent = (event.loaded / event.total) * 100;
                }
                
                function completeHandler5(event) {
                    _("status2").innerHTML = event.target.responseText;
                    bgi.src = 'images/items_images_thumbnails/'+file2.name;
                }
                function errorHandler5(event) {
                
                }
                function abortHandler5(event) {
                    
                }
        }



        if(actualid === 'pop_images_upload') {
             
            var file3 = _("pop_images_upload").files[0];
                
            var formdata3 = new FormData();

                formdata3.append("pop_images_upload", file3);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler6, false);
                ajax.addEventListener("load", completeHandler6, false);
                ajax.addEventListener("error", errorHandler6, false);
                ajax.addEventListener("abort", abortHandler6, false);
                ajax.open("POST","submitaccountdetails.php",true);
        
                ajax.send(formdata3);
                
                this.parentElement.parentElement.innerHTML = '<img src="images/pop_images_thumbnails/'+file3.name+'" style="width:8em;height:6em;z-index:-90000;">'; 
                document.getElementById("hid_sub").style.display = 'block';
                var bgd = document.getElementById("bgimage6");
                
                function progressHandler6(event) {
                    _("loaded").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                }
                
                function completeHandler6(event) {
                    _("stat").innerHTML = event.target.responseText; 
                    bgd.src = 'images/items_images_thumbnails/'+file3.name;
                    
                }
                function errorHandler6(event) {
                   
                }
                function abortHandler6(event) {
                    
                }
        }


        if(actualid === 'pop_images_upload1') {
             
            var file3 = _("pop_images_upload1").files[0];
                
            var formdata3 = new FormData();

                formdata3.append("pop_images_upload", file3);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler7, false);
                ajax.addEventListener("load", completeHandler7, false);
                ajax.addEventListener("error", errorHandler7, false);
                ajax.addEventListener("abort", abortHandler7, false);
                ajax.open("POST","submitaccountdetails.php",true);
        
                ajax.send(formdata3);
                
                this.parentElement.parentElement.innerHTML = '<img src="images/pop_images_thumbnails/'+file3.name+'" style="width:8em;height:6em;z-index:-90000;">'; 
                document.getElementById("hid_sub").style.display = 'block';
                var bgd = document.getElementById("bgimage7");
                
                function progressHandler7(event) {
                    _("loaded").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                }
                
                function completeHandler7(event) {
                    _("stat").innerHTML = event.target.responseText; 
                    bgd.src = 'images/items_images_thumbnails/'+file3.name;
                    
                }
                function errorHandler7(event) {
                   
                }
                function abortHandler7(event) {
                    
                }
        }


        if(actualid === 'pop_images_upload2') {
             
            var file3 = _("pop_images_upload2").files[0];
                
            var formdata3 = new FormData();

                formdata3.append("pop_images_upload", file3);
                
            var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler8, false);
                ajax.addEventListener("load", completeHandler8, false);
                ajax.addEventListener("error", errorHandler8, false);
                ajax.addEventListener("abort", abortHandler8, false);
                ajax.open("POST","submitaccountdetails.php",true);
        
                ajax.send(formdata3);
                
                this.parentElement.parentElement.innerHTML = '<img src="images/pop_images_thumbnails/'+file3.name+'" style="width:8em;height:6em;z-index:-90000;">'; 
                document.getElementById("hid_sub").style.display = 'block';
                var bgd = document.getElementById("bgimage8");
                
                function progressHandler8(event) {
                    _("loaded").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
                }
                
                function completeHandler8(event) {
                    _("stat").innerHTML = event.target.responseText; 
                    bgd.src = 'images/items_images_thumbnails/'+file3.name;
                    
                }
                function errorHandler8(event) {
                   
                }
                function abortHandler8(event) {
                    
                }
        }


    },false)
    return false;
}



//users submit acc details

function submitaccdetNow() {
    _("accdetform").onsubmit = function(ev) {
        ev.preventDefault();

        var title = _("item-title").value;
        var weblink = _("item_url").value;
        var p = _("item-price").value;
        var an = _("accname").value;
        var bn = _("bankname").value;
        var ano = _("accno").value;
        
        if(title != "" && weblink != "" &&  p != "" && an != "" && bn != "" && ano != "" &&  title != null && weblink != "" &&  p != null && an != null && bn != null && ano != null) {
            
            var hr = new XMLHttpRequest();
            hr.open("POST","submitaccountdetails.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                    console.log(hr.response);
                }
            }
            hr.send("title="+title+"&item_url="+weblink+"&price="+p+"&accname="+an+"&bankname="+bn+"&accno="+ano);

        }
        document.getElementById("pop_imageuploads").style.display = 'block';
        document.getElementById("hide_sub").style.display = 'none';
        // if(document.getElementById("item_img_upload").style.display == 'block') {
            
        // }
    }
    
}



function titlecheck() {
    
    var status = document.getElementById("titleStatus");
    
    var u = document.getElementById("item_title").value;
    
    
    if(u !="" && u != null) {
        var hr = new XMLHttpRequest();
        hr.open("POST","postitemcheck.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status.style.color = 'red';
                status.innerHTML = hr.response;
                
            }
        }
        hr.send("title="+u);
    }else {
        status.style.color = 'red';
        status.innerHTML = 'title cannot be empty!!';
    }

};



function desccheck() {
    
    var status2 = document.getElementById("descStatus");
    
    var desc= document.getElementById("item_desc").value;
    
    
    if(desc !="" && desc != null) {
        var hr = new XMLHttpRequest();
        hr.open("POST","postitemcheck.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status2.style.color = 'red';
                status2.innerHTML = hr.response;
                
            }
        }
        hr.send("item_desc="+desc);
    }else {
        status2.style.color = 'red';
        status2.innerHTML = 'item description cannot be empty!!';
    }

};


function urlcheck() {
    
    var status3 = document.getElementById("urlStatus");
    
    var ul = document.getElementById("item-url").value;
    
    
    if(ul !="" && ul != null) {
        var hr = new XMLHttpRequest();
        hr.open("POST","postitemcheck.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status3.style.color = 'red';
                status3.innerHTML = hr.response;
                
            }
        }
        hr.send("item_url="+ul);
    }else {
        status3.style.color = 'red';
        status3.innerHTML = 'item url cannot be empty!!';
    }

};


function iacknowledge() {
    _("acknowledge-form").onsubmit = function(ev) {
        ev.preventDefault();

        var ap = _("paid-amount").value;
        
        if(ap != "" && ap != null ) {
            
            var hr = new XMLHttpRequest();
            hr.open("POST","acknowledge.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                    console.log(hr.response);
                }
            }
            hr.send("amount_received="+ap);

        }
        
    }
}

function submitaccDet() {
    var subaccdet = document.getElementById("submitaccdet");
    var coverdept = document.getElementById("layer");
    subaccdet.style.display = 'block';
    coverdept.style.display = 'block';

    var clearreg = document.getElementById("closereg2");
    clearreg.onclick = function () {
    this.parentElement.style.display = 'none';
    coverdept.style.display = 'none';
    }

}


