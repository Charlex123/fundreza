$(document).ready(function() {

    $(".body").on('click','.close-err',function() {
        $(this).parent().hide();
        this.parentElement.style.display = 'none';
    })

    $(".body").on('click','.close-now',function() {
        $(this).parent().hide();
        this.parentElement.style.display = 'none';
    })

    $(".body").on('click','.close',function() {
        $(this).parent().hide();
        this.parentElement.style.display = 'none';
    })
    
    $(".count").hide();
    $(".filter-panel").hide();

    $('.filter').on('click',function(){
        $(".filter-panel").toggle();
    })

    
    //share video links function...............
    function load_unseen_notifications(view = '') {

        var hr = new XMLHttpRequest();
        hr.open("POST","fetch_notifications.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                $('.list-notifications').html(hr.response);
                }
        }
        hr.send("view="+view);
    }
        
    
    function load_notification_count(view = '') {
            var hr = new XMLHttpRequest();
            hr.open("POST","notification_count.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                    $(".count").show();
                    $('.count').html(hr.response);
                    }
            }
            hr.send("view="+view);
        }
        window.load = load_notification_count();
        window.load = load_unseen_notifications();
    
        setInterval(function() {
        load_unseen_notifications();
        load_notification_count();
        },60000);        
})    


    $("body").on('click',".dropdown",function() {
        var upvote = true;
        var emp_code = $(this).attr("name");
        var y = $(this).parent().children(".dropdown-menu");
        // sending video likes to php to insert into database using ajax return............
        
        });


        $("body").on('click',".shares",function() {
        
        var shares = true;
        var emp_code = $(this).attr("name");
        var f = $(this).parent().children(".tripple-share");
        
        $(".cancelnow").on('click',function() {
            $(".modala").hide();
        })
        //send video shares to php
    
          
            if(shares != false && emp_code != "") {
              
             var v = new XMLHttpRequest();
                 v.open("POST","shares.php",true);
                 v.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 v.onreadystatechange = function () {
                     if((v.readyState == 4) && (v.status == 200 || v.status == 304) ) {
                        f.html(v.responseText);
                        $(".modala").show();
                        $(this).parent().children(".modala").toggle();
                        }
                 }
                 v.send("shares="+shares+"&emp_code="+emp_code);
               }
        });
    
    
    // get upvotes .................
    
    $("body").on('click',".upvote",function() {
        var upvote = true;
        var emp_code = $(this).attr("name");
        var y = $(this).parent().children(".upv");
        // sending video likes to php to insert into database using ajax return............
        
        if(upvote == true && emp_code != "") {
            var hr = new XMLHttpRequest();
                 hr.open("POST","upvotes.php",true);
                 hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 hr.onreadystatechange = function () {
                     if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                        y.html(hr.response);
                        if(hr.response === 'Login') {
                            $(".login-alert").show();
                        }
                     }
                 }
                 hr.send("upvotes="+upvote+"&emp_code="+emp_code);
               }
    
        });


        // get followers .................
    
    $("body").on('click',".follow-now",function() {
        var replaceSpan = true;
        var follow = true;
        var emp_code = $(this).attr("name");
        // sending video likes to php to insert into database using ajax return............
        
        if(follow == true && emp_code != "") {
            
            var hr = new XMLHttpRequest();
                 hr.open("POST","follow.php",true);
                 hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 hr.onreadystatechange = function () {
                     if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                        $(".followed").html(hr.response)
                        if(hr.response === 'Login') {
                            $(".login-alert").show();
                        }
                     }
                 }
                 hr.send("follow="+follow+"&emp_code="+emp_code);
               }
    

        if(follow == true && replaceSpan == true) {
    
        var r = new XMLHttpRequest();
                r.open("POST","follow.php",true);
                r.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                r.onreadystatechange = function () {
                    if((r.readyState == 4) && (r.status == 200 || r.status == 304) ) {
                    $(".following").html(r.response)
                    }
                }
                r.send("follow="+follow+"&replaceSpan="+replaceSpan);
            }
        
        });
    
    
    
    
    
    
    $(".get-views").one('click',function() {
        
        // var getFor = document.getElementById("ddl-d");
        //     getFor.onsubmit = function(event) {
        //     event.preventDefault();
    
        var pr = $(this).parent().children(".tripple-view"); 
        var views = true;
        var emp_code = $(".call").attr("name");
       
        if(views != false && emp_code != "") {
           
            var hr = new XMLHttpRequest();
                 hr.open("POST","video_views.php",true);
                 hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 hr.onreadystatechange = function () {
                     if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                         
                     }
                 }
                 hr.send("views="+views+"&emp_code="+emp_code);
               
        }
            
    })
        
    $(".search-input-form").keypress(function(event) {
        var keypressed = String.fromCharCode(event.which);
        
        
        var l = document.getElementById("kkkk");
        
            l.style.display = 'block';
            
         if(keypressed != "") {
             var hr = new XMLHttpRequest();
                 hr.open("POST","quicksearch.php",true);
                 hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 hr.onreadystatechange = function () {
                     if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                        l.innerHTML = hr.responseText;
                        return false;
                        }
                 }
                 hr.send("keyPressed="+keypressed);
               }else {
                l.style.display = 'none';
               }
        
    });
    
    //put keypress search result in search input bar
    var j = document.getElementById("kkkk");
    $("body").on("click", ".result",function() {
    var searchResult = $(this).attr("value");
    $("#search-input").val(searchResult);
    if($("#search-input").val(searchResult)) {
        j.style.display = 'none';
    }
    
    });
    
    // clear kkkk when input val is empty

    
    
    
    // $(".search-input-form").on('click', function (){
    
    // formInput.onsubmit = function(event) {
    //     event.preventDefault();
    //     }
    //     var dropClass = document.getElementById("select-me");
    //     var searchQuery = document.getElementById("search-input-form").value;
        
    //     if(dropClass != "" && searchQuery != "") {
            
    //         var hr = new XMLHttpRequest();
    //             hr.open("POST","get-search.php",true);
    //             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //             hr.onreadystatechange = function () {
    //                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
    //                 dropClass.innerHTML = hr.responseText;
                    
    //             }
    //             }
    //             hr.send("search_query="+searchQuery);
    //         }
    
    // })
    
    
    
    function openNew() {
            opennewUrl = window.open("artistsupdate.php","new","menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes,titlebar=yes,tab=yes","width=1000;hwight=1000");
            opennewUrl.focus();
    }
    
    function opennewNow() {
            opennewUrl = window.open("index.php","new","menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes,titlebar=yes,tab=yes","width=1000;hwight=1000");
            opennewUrl.focus();
    }   
