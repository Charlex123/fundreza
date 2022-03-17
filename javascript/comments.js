$(document).ready(function()
{


    $("body").on('click',".fa-angle-down",function(){
        
        this.parentElement.parentElement.nextElementSibling.style.display = 'block';
        $(this).toggleClass("active");
        
        return false;
        });
   

    


    $("body").on('click',".fa-angle-up",function(){
        
        this.parentElement.parentElement.nextElementSibling.style.display = 'none';
        $(this).toggleClass("active");
        
        return false;
        });
    
        // $(".child-comments").hide();
   
    $("body").on('click',".comment_button",function(){
    
    $(".panel").slideToggle(300);
    $(this).toggleClass("active");
    
    return false;
    });

    // $(".child-comments").hide();
});

function _(e) {
    return document.getElementById(e);
}


var editComment = document.querySelectorAll(".edit_comment");
for(var v = 0; v < editComment.length; v++) {
    editComment[v].onclick = function() {
        this.parentElement.nextElementSibling.style.display = 'block';
        this.parentElement.nextElementSibling.classList.toggle('epanel');
        this.parentElement.nextElementSibling.nextElementSibling.style.display = 'none';
        this.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'none';
        // $(this).toggleClass("active");
        
        return false;
    }
}


var delComment = document.querySelectorAll(".delete_comment");
for(var d = 0; d < delComment.length; d++) {
    delComment[d].onclick = function() {
        this.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'block';
        this.parentElement.nextElementSibling.nextElementSibling.classList.toggle('epanel');
        this.parentElement.nextElementSibling.nextElementSibling.style.display = 'none';
        this.parentElement.nextElementSibling.style.display = 'none';

        // $(this).toggleClass("active");
        
        return false;
    }
}



var delCom = document.querySelectorAll(".del_comment");
    for(var x = 0; x < delCom.length; x++) {
        delCom[x].onclick = function() {
            var pCode = $(this).attr('name');
            var postId = $("#postId").attr('value');
            var Dname = this.parentElement.previousElementSibling.getAttribute("value");
            var Demail = this.parentElement.previousElementSibling.previousElementSibling.getAttribute("value");
            this
            console.log(pCode)
            console.log(postId)
            console.log(Dname)
            console.log(Demail)

            var ajax = new XMLHttpRequest();
            ajax.open("POST","delete_parent_comment.php",true);
            ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            ajax.onreadystatechange = function () {
                if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                    $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                    $(".comment-error").fadeIn(5000);
                    $(".comment-error").fadeOut(5000);
                    return false;
                }
            }
            ajax.send("pCode="+pCode+"&Dname="+Dname+"&Demail="+Demail+"&postId="+postId);
            
            
        return false;
    }

}



var submitEdit = document.querySelectorAll(".submit_edit");
    for(var s = 0; s < submitEdit.length; s++) {
        submitEdit[s].onclick = function() {
            _("ecomments-form").onsubmit = function(event) {
                event.preventDefault();
            }
            var namer = this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value;
            var emailr = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild.value;
            var commentedit = this.parentElement.previousElementSibling.firstElementChild.value;
            var pCode = this.getAttribute('name');
            var postId = document.getElementById("postId").value;

            if(commentedit == "" || commentedit == null) {
                $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i> Enter Comment First</span>');
                $(".comment-error").fadeIn(5000);
                $(".comment-error").fadeOut(5000);
                return false;
            }else{
            
                var ajax = new XMLHttpRequest();
                ajax.open("POST","edit_parent_comments.php",true);
                ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                ajax.onreadystatechange = function () {
                    if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                        $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                        $(".comment-error").fadeIn(5000);
                        $(".comment-error").fadeOut(5000);
                        return false;
                    }
                }
                ajax.send("editComment="+commentedit+"&pCode="+pCode+"&Rname="+namer+"&Remail="+emailr+"&postId="+postId);
            return false;
        }
    }

}


var submitCEdit = document.querySelectorAll(".submit_child_commentedit");
    for(var s = 0; s < submitCEdit.length; s++) {
        submitCEdit[s].onclick = function() {
            _("echildcomments-form").onsubmit = function(event) {
                event.preventDefault();
            }
            var namer = this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value;
            var emailr = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild.value;
            var commentedit = this.parentElement.previousElementSibling.firstElementChild.value;
            var pCode = this.getAttribute('name');
            var postId = document.getElementById("postId").value;

            if(commentedit == "" || commentedit == null) {
                $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i> Enter Comment First</span>');
                $(".comment-error").fadeIn(5000);
                $(".comment-error").fadeOut(5000);
                return false;
            }else{
            
                var ajax = new XMLHttpRequest();
                ajax.open("POST","edit_child_comments.php",true);
                ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                ajax.onreadystatechange = function () {
                    if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                        $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                        $(".comment-error").fadeIn(5000);
                        $(".comment-error").fadeOut(5000);
                        return false;
                    }
                }
                ajax.send("editComment="+commentedit+"&pCode="+pCode+"&Rname="+namer+"&Remail="+emailr+"&postId="+postId);
            return false;
        }
    }

}



var sendReply = document.querySelectorAll(".reply_comment");
for(var r = 0; r < sendReply.length; r++) {
    sendReply[r].onclick = function() {
        this.parentElement.nextElementSibling.style.display = 'none';
        this.parentElement.nextElementSibling.nextElementSibling.classList.toggle('rpanel');
        this.parentElement.nextElementSibling.nextElementSibling.style.display = 'block';
        this.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'none';
        
        return false;
    }
}


var sendcReply = document.querySelectorAll(".reply_ccomment");
for(var c = 0; c < sendcReply.length; c++) {
    sendcReply[c].onclick = function() {
        // this.parentElement.nextElementSibling.style.display = 'block';
        this.parentElement.nextElementSibling.classList.toggle('crpanel');
        this.parentElement.nextElementSibling.nextElementSibling.style.display = 'none';
        // $(this).toggleClass("active");
        
        return false;
    }
}



var submitReply = document.querySelectorAll(".submit_reply");

    for(var t = 0; t < submitReply.length; t++) {
        submitReply[t].onclick = function() {
            _("rcomments-form").onsubmit = function(event) {
                event.preventDefault();
            }
            var namer = this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value;
            var emailr = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild.value;
            var commentr = this.parentElement.previousElementSibling.firstElementChild.value;
            var pCode = this.getAttribute('name');
            var postId = document.getElementById("postId").value;

            if(commentr == "" || commentr == null) {
                $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i> Enter Comment First</span>');
                $(".comment-error").fadeIn(5000);
                $(".comment-error").fadeOut(5000);
                return false;
            }else{
            
                var ajax = new XMLHttpRequest();
                ajax.open("POST","insert_comment_reply.php",true);
                ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                ajax.onreadystatechange = function () {
                    if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                        $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                        $(".comment-error").fadeIn(5000);
                        $(".comment-error").fadeOut(5000);
                        // window.location.reload();
                        return false;
                    }
                }
                ajax.send("replyComment="+commentr+"&pCode="+pCode+"&Rname="+namer+"&Remail="+emailr+"&postId="+postId);
            return false;
        }
    }
}



var submitcReply = document.querySelectorAll(".submit_creply");

    for(var t = 0; t < submitcReply.length; t++) {
        submitcReply[t].onclick = function() {
            _("rccomments-form").onsubmit = function(event) {
                event.preventDefault();
            }
            var cnamer = this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value;
            var cemailr = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild.value;
            var ccommentr = this.parentElement.previousElementSibling.firstElementChild.value;
            var cCode = this.getAttribute('name');
            var postId = document.getElementById("postId").value;

            if(ccommentr == "" || ccommentr == null) {
                $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i> Enter Comment First</span>');
                $(".comment-error").fadeIn(5000);
                $(".comment-error").fadeOut(5000);
                return false;
            }else{
            
                var ajax = new XMLHttpRequest();
                ajax.open("POST","insert_child_commentreply.php",true);
                ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                ajax.onreadystatechange = function () {
                    if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                        $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                        $(".comment-error").fadeIn(5000);
                        $(".comment-error").fadeOut(5000);
                        // window.location.reload();
                        return false;
                    }
                }
                ajax.send("replyComment="+ccommentr+"&cCode="+cCode+"&Rname="+cnamer+"&Remail="+cemailr+"&postId="+postId);
            return false;
        }
    }
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
                url: 'insertparentcomments.php',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                    $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + response + '</span>');
                    $(".comment-error").fadeIn(5000);
                    $(".comment-error").fadeOut(5000);
                }
            });
        }
    }

    function progressHandler(event) {
        $(".comment-error").html(' <img src="images/svg-spin3.svg" style="width: 2rem;height: 2rem;"> ');
        $(".comment-error").fadeIn(5000);
        return false;
    }
    
    function completeHandler(event) {
        $(".comment-error").fadeOut(5000);
        return false;
        
    }
    function errorHandler(event) {
        $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + response + '</span>');
        $(".comment-error").fadeIn(5000);
        $(".comment-error").fadeOut(5000);
        return false; 
    }
    function abortHandler(event) {
        $(".comment-error").html('<span class="comments-error"><i class="far fa-surprise"></i>' + 'Upload Cancelled' + '</span>');
        $(".comment-error").fadeIn(5000);
        $(".comment-error").fadeOut(5000);
        return false; 
    }


function prevSubmit() {
    _("comments-form").onsubmit = function(event) {
        event.preventDefault();
    }

        var Comments = document.getElementById("comments").value;
        var name = document.getElementById("Ename").value;
            var emaild = document.getElementById("emaild").value;
            var postId = document.getElementById("postId").value;
              
          if(Comments == "" || Comments == null) {
            $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i> Enter Comment First</span>');
            $(".comment-error").fadeIn(5000);
            $(".comment-error").fadeOut(5000);
            return false;
        }else{
            
            var ajax = new XMLHttpRequest();
            ajax.open("POST","insertparentcomments.php",true);
            ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            ajax.onreadystatechange = function () {
                if((ajax.readyState == 4) && (ajax.status == 200 || ajax.status == 304) ) {
                    $(".comment-error").html('<span class="comments-error"><i class="far fa-smile-beam"></i>' + ajax.response + '</span>');
                    $(".comment-error").fadeIn(5000);
                    $(".comment-error").fadeOut(5000);
                    return false;
                }
            }
            ajax.send("message="+Comments+"&Ename="+name+"&Email="+emaild+"&postId="+postId);

    }   

}



var formInput = document.getElementById("prevent-default-form");
var submitButton = document.getElementById("search-result");
var search_query = document.getElementById("search-input").value;

var start = 0;
var limit = 10;
var start2 = 0;
var limit2 = 3;
var reachedMax = false;

    
  
function loadnextComments() {
    $("#circular-progress-bar10").show();
    getnextComments();
    return false;
}



function getnextComments() {

if (reachedMax){
    
return false;
}
$.ajax({
    url: "get-next-comments.php",
    method: "POST",
    dataType: "text",
    data:{
        getnextComments:1,
        start:start,
        limit:limit
    },
    success: function (response) {
        if(response == reachedMax) {
            reachedMax == true;
            $("#circular-progress-bar10").remove();
            return false;
            }else {
            start += limit;
            $(".all-comments").append(response);
            $("#circular-progress-bar10").hide();
            return false;
            }
        }
    })
}



$("a#children").click(function() {
    var section = $(this).attr("name");
    $("#C-" + section).toggle();
    
});


    $(".form-submit").click(function() {
        var commentBox = $("#comment");
        var commentCheck = commentBox.val();
        if(commentCheck == '') {
            commentBox.addClass("form-text-error");
            return false;
        }
    })

    $(".form-reply").click(function() {
    var replyBox = $("#new-reply");
    var replyCheck = replyBox.val();
    if(replyCheck == '') {
        replyBox.addClass("form-text-error");
        return false;
    }
})



var sendReply = document.querySelectorAll(".aya");
for(var v = 0; v < sendReply.length; v++) {
    sendReply[v].onclick = function() {
        
    this.nextElementSibling.nextElementSibling.style.display = 'none';
    this.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'none';
    this.previousElementSibling.style.display = 'block';
    this.style.display = 'none';
    }

var Code, submitReply = document.querySelectorAll(".form-submite");

for(var a = 0; a < submitReply.length; a++) {
        submitReply[a].onclick = function(event) {
        event.preventDefault();
        
        Code = this.previousElementSibling.previousElementSibling.getAttribute("value");
        reply = this.previousElementSibling.previousElementSibling.previousElementSibling.value;
        
        if(reply == "") {
            this.parentElement.parentElement.previousElementSibling.style.display = 'block';
            return false;
        }else if(reply !="" && reply != null && Code != "" && Code != null) {
            
            var n = this.parentElement.parentElement.parentElement.nextElementSibling;    
            
            var hr = new XMLHttpRequest();
            hr.open("POST","insertpostcomment-reply.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                    n.innerHTML = hr.response;
                    
                    return false;
                }
            }
            hr.send("code="+Code+"&new_reply="+reply);


            var bg = new XMLHttpRequest();
            bg.open("POST","get-children-postcomments.php",true);
            bg.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            bg.onreadystatechange = function () {
                if((bg.readyState == 4) && (bg.status == 200 || bg.status == 304) ) {
                    n.innerHTML = bg.response;
                    
                    return false;
                }
            }
            bg.send("code="+Code+"&new_reply="+reply);
        }
    }
    
}

}


var tery = document.querySelectorAll(".lorda");
for(var q = 0; q < tery.length; q++) {
    tery[q].onclick = function() {
        
    this.nextElementSibling.style.display = 'none';
    this.previousElementSibling.previousElementSibling.style.display = 'none';
    this.previousElementSibling.style.display = 'block';
    this.style.display = 'none';
}
}

var submitEdit = document.querySelectorAll(".form-submit");
for(var az = 0; az < submitEdit.length; az++) {
    submitEdit[az].onclick = function(event) {
    event.preventDefault();

    dCode = this.previousElementSibling.previousElementSibling.getAttribute("value");
    edited = this.previousElementSibling.previousElementSibling.previousElementSibling.value;
    
    if(edited =="") {
    this.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.style.display = 'block';
    return false;
    }else if(edited !="" && dCode != "" && edited != null && dCode != null){
        var c = this.parentElement.parentElement.parentElement.parentElement.parentElement;
        var hr = new XMLHttpRequest();
        hr.open("POST","editpost-comments.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                c.innerHTML = hr.response;
                return false;
                }
        }
        hr.send("code="+dCode+"&edited="+edited);
        
    }
    }
}


var k = document.querySelectorAll(".close");
for(var o = 0; o < k.length; o++) {
    k[o].onclick = function() {
        this.parentElement.parentElement.style.display= 'none';
    }
}


    
var cancelDelete = document.querySelectorAll(".conter");

        for(var t = 0; t < cancelDelete.length; t++) {
    cancelDelete[t].onclick = function() {
        this.parentElement.parentElement.remove();
    }
}


var showdeleteBox = document.querySelectorAll(".delete");
function commentBox() {

for(var p = 0; p < showdeleteBox.length; p++) {
showdeleteBox[p].onclick = function() {
    var c_de = this.getAttribute("name");
    console.log(c_de);
    this.nextElementSibling.style.display = 'block';
    
    }
}

}


$("body").on('click',".comment_likes",function() {
    var like = true;
    var postId = $("#postId").attr("value"); 
    var heartIcon = $(this).attr("class");
    var pCode = this.parentElement.getAttribute("name");
    var y = $(this).parent().children(".commentlikes");
    heartIcon.replaceWith("<i class='fas fa-heart comment_likes'></i>");
    // heartIcon.replaceWith("<i class='fas fa-heart comment_likes'></i>");
    // sending video likes to php to insert into database using ajax return............
    console.log(heartIcon)
    
    if(like == true && pCode != "") {
        
        var hr = new XMLHttpRequest();
             hr.open("POST","comment-likes.php",true);
             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             hr.onreadystatechange = function () {
                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                     console.log(heartIcon)
                     
                    y.html(hr.response);
                 }
             }
             hr.send("pcomment_likes="+like+"&postId="+postId+"&pCode="+pCode);
           }
           
            
    });


$("body").on('click','.dislikes-mama',function() {
    var p_comment_dislikes = true;
    var gCode = $(this).attr("name");
    var tu = $(this).parent().children(".dislikes-mama-updates").toggle();
    var w = $(this).parent().children(".postcommentdislikes");

    if(gCode != "" && p_comment_dislikes == true) {
        
        var hr = new XMLHttpRequest();
        hr.open("POST","postcomment-likes-dislikes.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                tu.html(hr.response);
                }
        }
        hr.send("code="+gCode+"&p_comment_dislikes="+p_comment_dislikes);
        
    }

    if(gCode != "" && w != "") {
        
        var zx = new XMLHttpRequest();
        zx.open("POST","postcomment-likes-dislikes.php",true);
        zx.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        zx.onreadystatechange = function () {
            if((zx.readyState == 4) && (zx.status == 200 || zx.status == 304) ) {
                w.html(zx.response);
                console.log(zx.response);
                }
        }
        zx.send("code="+gCode+"&w="+w);
        
    }
        
});



$("body").on('click','.c-likes', function() {
    var c_comment_likes = true;
    var gCode = $(this).attr("name");
    var c_comment = $(this).attr("value");
    var ax = $(this).parent().children(".drop-c-likes");
    var x = $(this).parent().children(".c-likes-updates").toggle();

    if(gCode != "" && c_comment_likes ==true && c_comment != "") {
        
        var hr = new XMLHttpRequest();
        hr.open("POST","c-postcomment-likes-dislikes.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                x.html(hr.response);
                
            }
        }
        hr.send("code="+gCode+"&c_comment_likes="+c_comment_likes+"&c_comment="+c_comment);
    }

    if(gCode != "" && ax != "") {
        
        var fd = new XMLHttpRequest();
        fd.open("POST","c-postcomment-likes-dislikes.php",true);
        fd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        fd.onreadystatechange = function () {
            if((fd.readyState == 4) && (fd.status == 200 || fd.status == 304) ) {
                ax.html(fd.response);
            }
        }
        fd.send("code="+gCode+"&ax="+ax);
    }
});


$("body").on('click','.c-dislikes', function() {
    var c_comment_dislikes = true;
    var gCode = $(this).attr("name");
    var c_comment = $(this).attr("value");
    var ant = $(this).parent().children(".drop-c-dislikes");
    var as = $(this).parent().children(".c-dislikes-updates").toggle();

    if(gCode != "" && c_comment_dislikes == true && c_comment != "") {
        
        var hr = new XMLHttpRequest();
        hr.open("POST","c-postcomment-likes-dislikes.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                as.html(hr.response);
                
            }
        }
        hr.send("code="+gCode+"&c_comment_dislikes="+c_comment_dislikes+"&c_comment="+c_comment);
    }

    if(gCode != "" && ant != "") {
        
        var h = new XMLHttpRequest();
        h.open("POST","c-postcomment-likes-dislikes.php",true);
        h.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        h.onreadystatechange = function () {
            if((h.readyState == 4) && (h.status == 200 || h.status == 304) ) {
                ant.html(h.response);
            }
        }
        h.send("code="+gCode+"&ant="+ant);
    }
});

