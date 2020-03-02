
$(document).ready(function(){


    // $('#socis-form').on('submit',function(e){
    //     e.preventDefault();
    //     e.stopPropagation();
    //     var params=$(this).serialize();
    //     var url= $(this).attr('action')+"?"+params;
    //     var params={};
        
    //     al('search',url);

    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function(response){
    //             console.log(response);
    //             // o._removeThumbnail(response.removed);
    //         },
    //         error: function( jqXHR, textStatus, errorThrown ){
    //             // o._showError(jqXHR.responseJSON);
    //         }
    //     });
    // })

    $('.selectpicker').selectpicker({
        width: '100%'
    });

    $('.form-submitter').on('change',function(e){
        $(this).closest('form').submit();
        
    });
});


