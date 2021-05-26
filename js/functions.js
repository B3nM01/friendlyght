function showPeerDetails(elem){
    disp=elem.getElementsByClassName("details")[0].style.display;
    if(disp=="none"){
        elem.getElementsByClassName("details")[0].style.display="";
    }
    else{elem.getElementsByClassName("details")[0].style.display="none";};

     
}

function showPopUp(elem){
    elem.getElementsByClassName("popUpCont")[0].id="showPop";
}

function showNotifications(elem){
    
    elem.style.display="none";
    document.getElementById("notUl").style.display="";
     
    
}
function hideNotifications(elem){
    elem.style.display="none";
    document.getElementById("notNum").style.display="";    
    deleteNotifications();
}

function show(elem){
    if( elem.getElementsByClassName("toShow")[0].style.display=="none"){
        elem.getElementsByClassName("toShow")[0].style.display="";
    }
    else{elem.getElementsByClassName("toShow")[0].style.display="none"}
}
function showChnDet(elem){
    elem.parentNode.parentNode.getElementsByClassName("toShow")[0].style.display="";
    elem.parentNode.parentNode.getElementsByTagName("button")[0].style.display="";
}
function hideChnDet(elem){
    elem.parentNode.parentNode.getElementsByClassName("toShow")[0].style.display="none";
    elem.style.display="none";
}

function getDate(elem,seconds){
date = new Date(seconds*1000);
elem.innerText= date;
}


y=Date.now();
x=0;

document.onmousemove = function(){
    x=Date.now();
  }

const interval = setInterval(function() {

    if(document.activeElement.tagName=="INPUT" ){
           console.log("eskere");
    }
    else{
     if(x>y){
     getNotifications();
     }
    }; y=Date.now();
  }, 5000);
 

function showSettings(){
    document.getElementById("settingsContainer").style.display="block";
}
function hideSettings(){
    document.getElementById("settingsContainer").style.display="";
}
num=0;
function showInvDet(elem,bolt11){
    if( elem.getElementsByClassName("toShow")[0].style.display=="none"){
       
            if(elem.getElementsByClassName("toShow")[0].getElementsByTagName("img")[0].src=="none" || elem.getElementsByClassName("toShow")[0].getElementsByTagName("img")[0].src=="https://friendlyght.me/src/none"){
            genQr(bolt11);
            setTimeout(function(){ elem.getElementsByClassName("toShow")[0].getElementsByTagName("img")[0].src="https://friendlyght.me/src/qr"+num; num=num+1;   }, 500);
            
            }

            elem.getElementsByClassName("toShow")[0].style.display="";
    }
    
    else{
        elem.getElementsByClassName("toShow")[0].style.display="none"
    }
    
}


function hidePopUp(elem){

    elem.parentElement.parentElement.id="hidePop";
}
function copyText(elem){
    navigator.clipboard.writeText(elem.parentNode.getElementsByTagName("input")[0].value)
}

function randomColor(){
    return Math.floor(Math.random()*16777215).toString(16);
}
function setDimensions(){
    document.getElementsByClassName("chart")[0].style.height="220px";
    document.getElementsByClassName("chart")[0].style.width="200px";
}
function shadows(elem){
    for(i = 0; i <  document.getElementsByClassName("principalContainer").length; i++ ){
        document.getElementsByClassName("principalContainer")[i].style.boxShadow="";
        document.getElementsByClassName("principalContainer")[i].style.backgroundImage="";
    }
    elem.style.boxShadow="0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.6)";
    elem.style.backgroundImage="linear-gradient(to right top, rgb(51, 51, 51), rgb(68, 68, 68))";
}