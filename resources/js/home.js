$( window ).on('load',function() {
    $('.home-slide').each(function(i){
        var color=$(this).data('color');
        console.log(color);
        $('body').css('color', color);
        $('a').css('color', color);
        // $('#main-logo').css('fill',color);
        $("#main-logo").css({fill:color}).attr("fill",color);   

    });
});