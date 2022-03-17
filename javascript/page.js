// function affixDiv (affixElement, wrapper, scrollElement) {

//     var height = affixElement.outerHeight(),
//         top = wrapper.offset().top;

//     if (scrollElement.scrollTop() >= top){
//         wrapper.height(height);
//         affixElement.addClass("affix");
//     }
//     else {
//         affixElement.removeClass("affix");
//         wrapper.height('auto');
//     }

//   };

//   affixDiv();


var readMore = document.getElementById("rmore"),
    readLess = document.getElementById("rless"),
    shortStory = document.getElementById("short-st"),
    fullStory = document.getElementById("full-st");

    if(readMore) {
        readMore.onclick = function() {
            shortStory.style.display = 'none';
            fullStory.style.display = 'block';
            readMore.style.display = 'none';
            readLess.style.display = 'block';
        }
    }

    if(readLess) {
        readLess.onclick = function() {
            shortStory.style.display = 'block';
            fullStory.style.display = 'none';
            readMore.style.display = 'block';
            readLess.style.display = 'none';
        }
    }

    closeD = document.getElementById("closed");
    if(closeD) {
        closeD.onclick = function() {
            var overlay = document.getElementById("overlay");
            var ajaxD = document.getElementById("ajaxd");
            overlay.style.display = 'none';
            ajaxD.style.display = 'none';
        }
    }

    window.onclick = function() {
        var overlay = document.getElementById("overlay");
        var ajaxD = document.getElementById("ajaxd");
        overlay.style.display = 'none';
        ajaxD.style.display = 'none';
    }


    shN = document.getElementById("shareNow");
    dnN = document.getElementById("donateNow");
if(shN) {
    shN.onclick = function () {
        
            var overlay = document.getElementById("overlay");
            var ajaxD = document.getElementById("ajaxd");
            var conT = document.getElementById("adc");
            if(ajaxD !="" && ajaxD != null) {
                //   status2.innerHTML = '....checking';
                //   status2.style.color = 'orange';
                var hr = new XMLHttpRequest();
                hr.open("GET","share-with-family-and-friends.php",true);
                hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                hr.onreadystatechange = function () {
                    if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                        
                        conT.innerHTML = hr.response;
                        overlay.style.display = 'block';
                    }
                }
                hr.send("ajaxd="+ajaxD);
            }
      
        }
      };


      if(dnN) {
        dnN.onclick = function () {

            var overlay = document.getElementById("overlay");
            var status = document.getElementById("status");
            var btn = document.getElementById("previ");
            overlay.style.display = 'block';
            }
      };

    //   window.addEventListener("load",function(){
    //       document.getElementById('').style.display = 'none';
    //   }) 



    fuP = document.querySelectorAll(".img-tiny");
    if(fuP) {
        iframeDiv = document.querySelector(".image-thumb");
        
        for(let i = 0; i <= fuP.length; i++) {
            let fupC = fuP[i];
            fupC.onclick = function() {
                imgS = this.getAttribute("name");
                iframeDiv.innerHTML = "<img src='"+imgS+"' alt='' class='image-cover mt-4 pt-1 mb-3'>";
                
            }
        }
        
    }



function changeMe() {
    iframeF = document.querySelector("#iframeVd");
    iframeDiv = document.querySelector(".image-thumb");
    youTubeLink = document.querySelector(".iframeList").getAttribute("name");
    iframeDiv.innerHTML = "<iframe width='100%' height='100%' style='margin-top: 1.7rem' src='"+youTubeLink+"' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen id='iframeVd'></iframe>";
    
}
