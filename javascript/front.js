/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */

var overlayy = document.getElementById("overlayy");
	 	 overlayy.style.display = 'none';
    document.getElementById("sendf_mail").style.display = 'none';
    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    var pbar = document.querySelectorAll(".progress-bar");
    if(pbar){
        for(i=0; i<=pbar.length; i++){
             var pbarMax = pbar[i];
             pCurrent = pbar[i].parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.getAttribute("name");
             ptotalWidth = pbar[i].parentElement.parentElement.firstElementChild.lastElementChild.firstElementChild.getAttribute("name");
             var ptotalWidthPercent = Math.round(ptotalWidth/ptotalWidth * 100);
             var pwidthPercent = Math.round(pCurrent/ptotalWidth * 100);
             pbar[i].style.width = pwidthPercent+'%';
             pbar[i].style.backgroundColor = 'green';
        }
    }
 
         
         
    function removecontactForm() {
     document.getElementById("head-contact-c").style.display = 'none';
 }
 
 var fCon = document.querySelector(".mfrs");
 
 fCon.onmouseenter = function() {
     var db = document.querySelector(".hover-d");
     if(db.style.display == 'none') {
         db.style.display = 'block';
     }
     else {
         db.style.display ='none';
     }
     // console.log(fCon)
 }
 
 
 
 
 
 function toggleNav() {
     var NavTog = document.getElementById("navbarSupportedContent");
    //  divTog.style.display = 'none' ? 'block' : 'none';
     if (NavTog.style.display === 'none' ) {
        NavTog.style.display = 'block';
      } else {
        NavTog.style.display = 'none';
      }
 }
 
     
 
 function contactFundraiser() {
     var divTog = document.getElementById("sendf_mail");
    //  divTog.style.display = 'none' ? 'block' : 'none';
     if (divTog.style.display === 'none' ) {
        divTog.style.display = 'block';
      } else {
        divTog.style.display = 'none';
      }
  }
 
 
 function showtopDonors() {
    if(overlayy.style.display == 'none') {
        document.getElementById("overlayy").style.display = 'block';
        var u = document.getElementById("topdonors");
        u.style.display = 'block';
        var ux = document.getElementById("alldonors");
        ux.style.display = 'none';
    }else {
        overlayy.style.display = 'block';
    }
    
 }
 
 
 function showallDonors() {
        if(overlayy.style.display == 'none') {
            overlayy.style.display = 'block';
            var u = document.getElementById("alldonors");
            u.style.display = 'block';
            var ux = document.getElementById("topdonors");
            ux.style.display = 'none';
        }else {
            overlayy.style.display = 'block';
        }
        
 }
 
 
 function topdonSearch() {
     var topdonsearch = document.getElementById("topdonorsearch").value;
     var fffBy = document.getElementById("topdonorsearch").getAttribute("name");
     var fiiid = document.getElementById("topidbutton").getAttribute("name");
     var fffT = document.getElementById("topidbutton").getAttribute("value");
     overlayy.style.display = 'block';
         var u = document.getElementById("topdon-search-wrap");
          if(topdonsearch != "") {
              var hr = new XMLHttpRequest();
                  hr.open("POST","https://fundreza.com/donationsearch.php",true);
                  hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                  hr.onreadystatechange = function () { 
                      if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                         u.innerHTML = hr.responseText;
                         return false;
                     }
                  }
                  hr.send("donorSearch="+topdonsearch+"&fid="+fiiid+"&fBy="+fffBy+"&fTitle="+fffT);
                }else {
                    u.innerHTML = 'enter search';
                    return false;
            }
 }
 
 
 
 function donSearch() {
        var donsearch = document.getElementById("donorsearch").value;
        var fffBy = document.getElementById("donorsearch").getAttribute("name");
        var fiiid = document.getElementById("searchidbutton").getAttribute("name");
        var fffT = document.getElementById("searchidbutton").getAttribute("value");
        overlayy.style.display = 'block';
        var u = document.getElementById("don-search-wrap");      
          if(donsearch != "") {
              var hr = new XMLHttpRequest();
                  hr.open("POST","donationsearch.php",true);
                  hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                  hr.onreadystatechange = function () {
                      if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                         u.innerHTML = hr.responseText;
                         return false;
                     }
                  }
                  hr.send("donorSearch="+donsearch+"&fid="+fiiid+"&fBy="+fffBy+"&fTitle="+fffT);
                }else {
                    u.innerHTML = 'enter search';
                    return false;
                }
 }
 
 
 function checkSearch(eve) {
     var keyPressed = document.getElementById("search-input").value;
         var keep = document.getElementById("search-input");
         var u = document.getElementById("kkkk");
         
             u.style.display = 'block';
             
          if(keyPressed != "") {
               
              var hr = new XMLHttpRequest();
                  hr.open("POST","quicksearch.php",true);
                  hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                  hr.onreadystatechange = function () {
                      if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                         u.innerHTML = hr.responseText;
                         return false;
                     }
                  }
                  hr.send("keyPressed="+keyPressed);
                }else {
                    u.innerHTML = 'enter search';
                    return false;
                }
 }
 
 function displaySearch() {
     var NavTog = document.getElementById("navbarSupportedContent");
     NavTog.style.display = 'none';
     document.getElementById("overlayy").style.display = 'block';
     const formInput = document.querySelector("#search");
     formInput.style.display ='block';
 }
 
 function remove() {
     document.getElementById("overlayy").style.display = 'none';
     document.getElementById("search").style.display = "none";
     document.getElementById("topdonors").style.display = "none";
     document.getElementById("alldonors").style.display = "none";
     document.getElementById("searchtopdonors").style.display = "none";
     document.getElementById("searchalldonors").style.display = "none";
    //  window.location.reload(false);
 }
 
 window.load = function (){
         document.getElementById("closeSidebar").style.display = 'none';
        //  document.getElementById("overlay").style.display = 'none';
         document.getElementById("loader").style.display = 'none';
     }
     
     function openNav() {
         document.getElementById("mySidebar").style.display = "block";
         document.getElementById("mySidebar").style.width = "250px";
         document.getElementById("main").style.marginLeft = "250px";
         document.getElementById("toggleSideBar").style.marginLeft = '25px';
         document.getElementById("toggleSideBar").style.display = 'none';
         document.getElementById("closeSideBar").style.display = 'block';
         
     }
     function closeNav() {
         document.getElementById("mySidebar").style.width = "0";
         document.getElementById("main").style.marginLeft = "0";
         document.getElementById("closeSideBar").style.display = 'none';
         document.getElementById("toggleSideBar").style.display = 'block';
     }
 
     var exitPopup = document.getElementById("exitPopup");  
     var coverd = document.getElementById("layer");
 
     
 
       var closeexitPopoup = document.getElementById("closeexitPopup");
       closeexitPopoup.onclick = function() {
           if(exitPopup.style.display == 'block') {
               exitPopup.style.display = 'none';
               coverd.style.display = 'none';
           }else {
               exitPopup.style.display = 'none';
               coverd.style.display = 'none';
           }
           
           document.getElementById("exitPopup").style.display = 'none';
           document.getElementById("layer").style.display = 'none';
       }
   
       function closeExitPopup(){
           document.getElementById("exitPopup").style.display = 'none';
           document.getElementById("layer").style.display = 'none';
       }
   
   
                 
     
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
         
     
     }
     
     
     function _(e) {
         return document.getElementById(e);
     }
     
     function send_message() {
         _("support_form").onsubmit = function(event) {
             event.preventDefault();
         }
     
        var status4 = document.getElementById("support_status");
        var dname = document.getElementById("donname").value;
        var demail = document.getElementById("donemail").value;
        var dmessage = document.getElementById("donmessage").value;
     
         
         if(dname != "" && demail != "" &&  dmessage != "") {
     
             var hr = new XMLHttpRequest();
             hr.open("POST","enquiry.php",true);
             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             hr.onreadystatechange = function () {
                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                     status4.style.color = 'blue';
                     status4.style.fontSize = "14"+"px";
                     status4.innerHTML = hr.response;
                     }
             }
             hr.send("clientName="+name+"&clientEmail="+email+"&clientSubject="+sub+"&clientMessage="+message);
     
         }   
     
     }
     
     
     
     function ContactMessage() {
         _("Contact_form").onsubmit = function(event) {
             event.preventDefault();
         }
     
         var status = document.getElementById("status");
         var sub = _("subject").value;
         var message = _("message").value;
         var email = _("email").value;
         
         if(sub != "" &&  message != "" && email != "") {
     
             var hr = new XMLHttpRequest();
             hr.open("POST","email_messages.php",true);
             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             hr.onreadystatechange = function () {
                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                     status.style.display = 'block';
                     status.style.color = 'blue';
                     status.style.fontSize = "14"+"px";
                     status.innerHTML = hr.response;
                     }
             }
             hr.send("clientSubject="+sub+"&clientEmail="+email+"&clientMessage="+message);
     
         }   
     
     }
     
     
     
     function sendFMessage() {
         _("sendf_mail").onsubmit = function(event) {
             event.preventDefault();
         }
     
         var status = document.getElementById("donstatus");
         var dname = _("donname").value;
         var dmessage = _("donmessage").value;
         var demail = _("donemail").value;
         
         if(dname != "" &&  dmessage != "" && demail != "") {
     
             var hr = new XMLHttpRequest();
             hr.open("POST","messagefundraiser.php",true);
             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             hr.onreadystatechange = function () {
                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                     status.style.display = 'block';
                     status.style.color = '#22a349';
                     status.style.fontSize = "14"+"px";
                     status.innerHTML = hr.response;
                     }
             }
             hr.send("senderName="+dname+"&senderEmail="+demail+"&fMessage="+dmessage);
     
         }   
     
     }
     
     
     
     
     
     
      $('.navbar-toggler').on('click', function (e) {
          //this.parent().next().parent
          alert('in')
          var navDrpDown = document.getElementById("navbarSupportedContent");
          if(navDrpDown.style.display === 'none') {
              navDrpDown.style.display = 'block';
          }else {
              navDrpDown.style.display = 'none';
          }
     
      });