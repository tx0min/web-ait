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
    $('header .nav-toggle').on('click',function(e){
        e.preventDefault();
        $('html').toggleClass('nav-opened');
    })

    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
   });

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

