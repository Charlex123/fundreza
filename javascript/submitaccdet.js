$(document).ready(function(){
    //var postreitem = document.getElementById("postitem");
    //postreitem.style.display = 'none';
    //document.getElementById("item_img_upload").style.display = 'none';
})



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
                ajax.upload.addEventListener("progress", progressHandler1, false);
                ajax.addEventListener("load", completeHandler1, false);
                ajax.addEventListener("error", errorHandler1, false);
                ajax.addEventListener("abort", abortHandler1, false);
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
                
                this.parentElement.parentElement.innerHTML = '<img src="images/items_images_thumbnails/'+file2.name+'" style="width:8em;height:6em;z-index:-90000;">'; 
                document.getElementById("hid_submit").style.display = 'block';
                //document.getElementById("selectfiles").style.zIndex = 900;
        }

    },false)
    return false;
}


function progressHandler1(event) {
    
}

function completeHandler1(event) {
    _("status1").innerHTML = event.target.responseText; 
    //_("upload-progress-bar1").value = 0;
    
}
function errorHandler1(event) {
    _("status1").innerHTML = "upload failed"; 
}
function abortHandler1(event) {
    _("status1").innerHTML = "upload cancelled"; 
}



function progressHandler(event) {
    _("loaded-n-total2").innerHTML = "Uploaded"+Math.round(event.loaded/1000)+"KB of"+Math.round(event.total/1000)+"KB";
    var percent = (event.loaded / event.total) * 100;
}

function completeHandler(event) {
    _("status2").innerHTML = event.target.responseText; 
    
}
function errorHandler(event) {

}
function abortHandler(event) {
    
}


function postrevitemNow() {
    _("psubmit").onsubmit = function(ev) {
        ev.preventDefault();

        var ha = _("item_category").value;
        var wa = _("item_sub_category").value;
        var qa = _("item_title").value;
        var da = _("item_desc").value;
        var ba = _("item-url").value;
        var za = _("price").value;

        if(ha != "" && qa != "" &&  da != "" && ba != "" &&  ha != null && qa != "" &&  da != null && ba != null) {
            
            var hr = new XMLHttpRequest();
            hr.open("POST","post_item.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                    console.log(hr.response);
                }
            }
            hr.send("category="+ha+"&sub_category="+wa+"&title="+qa+"&item_desc="+da+"&item_url="+ba+"&price="+za);

        }
        document.getElementById("item_img_upload").style.display = 'block';
        document.getElementById("hide_submt").style.display = 'none';
        // if(document.getElementById("item_img_upload").style.display == 'block') {
            
        // }
    }
    
}


function showitemimgUpload() {
    document.getElementById("hide_submt").style.display = 'block';
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