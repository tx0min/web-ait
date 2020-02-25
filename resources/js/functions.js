al = function (msg, params){
    if(params)
            console.log(msg,params);
    else
        console.log(msg);
}

csrfToken = function( ){
    return $('meta[name="csrf-token"]').attr('content');
}