/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('isotope-layout/dist/isotope.pkgd.min.js');
require('./bootstrap');
require('./responsiveTabs');
require('./back');
require('./socis');
require('./home');

$(document).ready(function(e){
    $('#main-nav .nav-toggle').on('click',function(){
        $('html').toggleClass('nav-opened');
    })

    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
   });
});

