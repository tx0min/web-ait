/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('isotope-layout/dist/isotope.pkgd.min.js');

window.paceOptions = {
    ajax: {
          trackMethods: ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']
    }
 };

require('./bootstrap');
require('./functions');
require('bootstrap-select');
require('./vendor/pace.min');
require('./responsiveTabs');
require('./back');
require('./socis');
require('./home');

$(document).ready(function(e){

   //responsive TAbs
   $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
   });



    //NAV

    $('header .nav-toggle').on('click',function(e){
        e.preventDefault();
        $('html').toggleClass('nav-opened');
    })



   $(document).on('keyup', function(e) {
        if (e.keyCode === 27 && $('html').is('.nav-opened')){
            // esc
            $('html').removeClass('nav-opened');
        }
    });

    $(document).on('click',function(e){
        // al(e.target);
        if($('html').is('.nav-opened')){
            if(!$(e.target).is('.nav-toggle') && $(e.target).closest('.nav-toggle').length==0  && !$(e.target).is('nav')  && $(e.target).closest('nav').length==0){
                e.preventDefault();
                $('html').removeClass('nav-opened');
            }
        }
    });
});

//infiniscroll






//var Isotope = require('isotope-layout');
var Masonry = require('masonry-layout');
var InfiniteScroll=require('infinite-scroll');
var imagesLoaded=require('imagesloaded');
InfiniteScroll.imagesLoaded = imagesLoaded;
//require('jscroll');
// require('isotope-fit-columns')



onWindowLoad(function() {

    //GRIDS
    if($('.grid').length>0){
        var grid = document.querySelector('.grid');

        /* var ul=$(this).find('ul.pagination');
        ul.hide(); */
    // al('grid', grid);


        var msnry = new Masonry( grid, {
            itemSelector: 'none', // select none at first
            columnWidth: '.grid__col-sizer',
            gutter: '.grid__gutter-sizer',
            //gutter: '.grid__gutter-sizer',
            percentPosition: true,
            stagger: 30,
            // nicer reveal transition
            visibleStyle: { transform: 'translateY(0)', opacity: 1 },
            hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
        });

        // initial items reveal
        imagesLoaded( grid, function() {
        grid.classList.remove('are-images-unloaded');
        msnry.options.itemSelector = '.grid__item';
        var items = grid.querySelectorAll('.grid__item');
        //al('imagesLoaded', items);
        msnry.appended( items );
        msnry.layout();

        });


        var infScroll = new InfiniteScroll( grid, {
            path: '.page-link[rel=next]',
            append: '.grid__item',
            outlayer: msnry,
            status: '.page-load-status',
        });
    }
});

