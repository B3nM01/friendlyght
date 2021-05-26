var autoClean;
var addrType;

function setOption(option, value){
    window[option] = value;
}

function slide(elem, option){
    elemclass=elem.className;
    if(elemclass=="sliderLeft"){
    window[option] = "off"
    elem.className="sliderRight";
    }
    else{
        window[option] = "on"
        elem.className="sliderLeft";
    }
}
function saveOptions(){
    setAutoCleanInvoice();
    
}