import 'owl.carousel';

$( window ).on('load',function() {

    var setPageColors = function(event){
        //al("changed",event.target);
        var slide=$(event.target).find('.owl-item.active').find('.home-slide');

        //al(slide);
        $('body').css({'--text-color': slide.data('color'), '--bg-color': slide.data('bg-color')} );
    }

    var slider=$("#home-slider");

    // if(!slider.data('single')){
        var single=slider.data('single');

        slider.on('initialized.owl.carousel', function(event) {
            setPageColors(event);
        });

        slider.owlCarousel({
            items:1,
            lazyLoad:true,
            margin:0,
            loop:true,
            autoHeight: false,
            autoplay:true,
            autoplayTimeout:10000,
            mouseDrag: !single,
            touchDrag:!single,
            pullDrag:!single,
            animateOut: 'fadeOut'

        });


        slider.on('changed.owl.carousel', function(event) {
            slider.trigger('stop.owl.autoplay');
            slider.trigger('play.owl.autoplay');
            setTimeout(function(){
                setPageColors(event);
            },100);
        });
    // }

    // $('.home-slide').each(function(i){
    //     var color=$(this).data('color');
    //     // console.log(color);
    //     // $('body').css('color', color);
    //     // $('a').css('color', color);
    //     // // $('#main-logo').css('fill',color);
    //     // $("#main-logo").css({fill:color}).attr("fill",color);

    // });
});
