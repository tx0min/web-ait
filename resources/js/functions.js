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