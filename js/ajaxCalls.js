function restartD(){
    
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./restartD.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
         location.reload();
     }
 }
 
 xmlhttp.send(JSON.stringify({restart: "yes" }));
}


function newConnection(elem){
   var address = document.getElementById("newConn").value;
   var xmlhttp = new XMLHttpRequest();    
   xmlhttp.open("POST", "./newConnection.php");
   xmlhttp.setRequestHeader("Content-Type", "application/json");
   xmlhttp.onreadystatechange = function(){
    if(this.readyState ==4 & this.status == 200){
        elem.parentNode.getElementsByTagName("p")[0].innerText=this.responseText;
    }
}

xmlhttp.send(JSON.stringify({addr: address }));

}

function newChannel(){
    var id = document.getElementById("newChnId").value;
    var amount = document.getElementById("newChnAmn").value;
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./newChannel.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
         location.reload();
         
     }
 }
 
 xmlhttp.send(JSON.stringify({amnt: amount, ch_id: id}));
 
 }

 function getNotifications(){
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./checkNotification.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
        if(this.responseText != "no"){
        var node = document.createElement("LI");                 
        var textnode = document.createTextNode(this.responseText);     
        node.appendChild(textnode);                              
        document.getElementById("notUl").getElementsByTagName("li")[0].before(node);
        if( document.getElementById("notNum").style.display==""){
        document.getElementById("notNum").innerText=String(Number(document.getElementById("notNum").innerText)+1);
        }else{
            document.getElementById("notNum").innerText=1;
        }
        document.getElementById("notNum").style.display="";
     }}
 }
 
 xmlhttp.send(JSON.stringify({get: "yaes"}));
 
 }


 function deleteNotifications(){
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./deleteNotifications.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
        document.getElementById("notNum").style.display="none";
         
     }
 }
 
 xmlhttp.send(JSON.stringify({get: "yaes"}));
 
 }
 function deleteInvoice(label, status){
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./deleteInvoice.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
         location.reload();
         
     }
 }
 
 xmlhttp.send(JSON.stringify({lbl: label, sts: status }));

}
function deletePay(phash, status){
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./deletePay.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
         location.reload();
         
     }
 }
 
 xmlhttp.send(JSON.stringify({payment_hash: phash, sts: status }));

}
function setAutoCleanInvoice() {
    xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("POST", "./setAutoCleanInvoice.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
         generateAddr();
         
     }
 }
 if(autoClean=="on"){
 xmlhttp.send(JSON.stringify({sec: 0, expd: null  }));
 }
 else if(autoClean=="off"){
    xmlhttp.send(JSON.stringify({sec: null, expd: null }));
    }
}

function generateAddr(){
    xmlhttp1 = new XMLHttpRequest();    
    xmlhttp1.open("POST", "./newAddr.php");
    xmlhttp1.setRequestHeader("Content-Type", "application/json");
    xmlhttp1.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
        location.reload();
         
     }
 }
 xmlhttp1.send(JSON.stringify({type: addrType  }));

}

function genQr(bolt11){
    xmlhttp1 = new XMLHttpRequest();    
    xmlhttp1.open("POST", "./genQr.php");
    xmlhttp1.setRequestHeader("Content-Type", "application/json");
    xmlhttp1.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
     
         
     }
 }
 xmlhttp1.send(JSON.stringify({bolt: bolt11,number: num  }));
}

function closeChn(id,elem){
    addr = elem.parentNode.getElementsByTagName("input")[0].value;
    tmt = elem.parentNode.getElementsByTagName("input")[1].value;
    xmlhttp1 = new XMLHttpRequest();    
    xmlhttp1.open("POST", "./closeChn.php");
    xmlhttp1.setRequestHeader("Content-Type", "application/json");
    xmlhttp1.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
        location.reload();
         
     }
 }
 xmlhttp1.send(JSON.stringify({peer_id: id, address: addr, timeout: tmt }));

}


function disconnect(id,type){
    xmlhttp1 = new XMLHttpRequest();    
    xmlhttp1.open("POST", "./disconnect.php");
    xmlhttp1.setRequestHeader("Content-Type", "application/json");
    xmlhttp1.onreadystatechange = function(){
     if(this.readyState ==4 & this.status == 200){
        location.reload();
         
     }
 }
 if(type=="force"){
 xmlhttp1.send(JSON.stringify({peer_id: id, force: "yes" }));
 }
 else{
    xmlhttp1.send(JSON.stringify({peer_id: id, force: "no" })); 
 }
}