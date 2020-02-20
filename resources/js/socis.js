var Isotope = require('isotope-layout');
require('isotope-fit-columns')

$( window ).on('load',function() {
    if($('.grid').length>0){
        var pckry = new Isotope( '.grid', {
            // options
            itemSelector: '.grid-item',
            // layoutMode: 'fitColumns'
        });
    }
});


