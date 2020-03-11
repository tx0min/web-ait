al = function (msg, params){
    if(params)
            console.log(msg,params);
    else
        console.log(msg);
}

csrfToken = function( ){
    return $('meta[name="csrf-token"]').attr('content');
}


baseUrl = function( url){
    var ret= $('meta[name="base-url"]').attr('content');

    if(url) ret+="/"+url;

    return ret;
}

_icon = function( text , style){
    return "<i class='fa fa-"+text+"' "+ (style?('style="'+style+'"'):'') +"></i>";
  }


onWindowLoad = function(callback){
    if(window.addEventListener){
        window.addEventListener('load',callback,false);
    }else{
        window.attachEvent('onload',callback);
    }
}

onWindowError = function(callback){
    if(window.addEventListener){
        window.addEventListener('error',callback,false);
    }else{
        window.attachEvent('onerror',callback);
    }
}

onDocumentReady = function (callback){
    document.addEventListener('DOMContentLoaded', callback );
}

setDocHeight = function () {
    var h=`${window.innerHeight/100}px`;
    // al('height',h);
    document.documentElement.style.setProperty('--vh', h);
};


goToTop = function(){
    // al("isOntop");
    $("html, body").animate({ scrollTop: 0 }, 200);

    // al("TOP", top);
}
isOnTop = function(){
    // al("isOntop");
    var offset=80;
    var top=$(window).scrollTop();
    if(top<=offset) $('html').addClass('onTop');
    else $('html').removeClass('onTop');
    // al("TOP", top);
}