import 'jquery-ui/ui/widgets/sortable.js';




var UserForm  = {
	
	settings: { 
        
    },

	gridID : function(){
		return ++this.gridscounter;
    },

    init : function(){
        var o=this;
        this.$form=$('#user-form');
        this.uploaders = this.$form.find('.image-uploader');

        if(this.uploaders.length>0){

            this.uploaders.imageUploader();
    
            
            $("html").on("dragover", function(e) {
                e.preventDefault();
                e.stopPropagation();
                o.activateDropzones();
            });
        
            $("html").on("drop", function(e) { 
                e.preventDefault(); 
                e.stopPropagation(); 
                o.deactivateDropzones();
            });

            $("html").on("mouseenter", function(e) { 
                e.preventDefault(); 
                e.stopPropagation(); 
                o.deactivateDropzones();
            });
    
        }
    },

    
    deactivateDropzones : function(){
        this.uploaders.each(function(i){
            $(this).imageUploader('deactivate');
        });
    },

    activateDropzones :  function(){
        this.uploaders.each(function(i){
            // console.log('activate',$(this));
            $(this).imageUploader('activate');
        });
    }
};
    


$(document).ready(function() {
    UserForm.init();
});




$.widget( "ait.imageUploader", {

    options: {

    },

    activate: function() {
        // console.log('activate',this);
        this.dropzone.addClass('active');
    },
    
    deactivate: function() {
        // console.log('deactivate',this);
        this.dropzone.removeClass('active').removeClass('hover');
    },

    hovering: function() {
        this.dropzone.addClass('hover');
    },
    
    nothovering: function() {
        this.dropzone.removeClass('hover');
    },

    _create: function() {
        var o=this;
        this.options = $.extend({}, this.options, this.element.data()); 
        
        console.log('imageUploader',this);

        this.dropzone = this.element.find('.dropzone');
        this.button = this.element.find('.browse-button');
        this.fileinput = this.element.find('input[type=file]');
        this.options.multiple =  this.fileinput.is('[multiple]');
        
        // console.log('fileinput',this.fileinput);
        // console.log('multiple', this.options.multiple);
        // Drag enter
        this.dropzone.on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            o.hovering();
        });

        // Drag leave
        this.dropzone.on('dragleave', function (e) {
            e.stopPropagation();
            e.preventDefault();
            o.nothovering();
        });
        

        // Drop
        this.dropzone.on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();
            console.log("DROP IN");
            
            UserForm.deactivateDropzones();
            var files = e.originalEvent.dataTransfer.files;
            
            o._uploadFiles(files);
            
        });


        // Open file selector on div click
        this.button.click(function(){
            o.fileinput.click();
        });


        // file selected
        this.fileinput.change(function(){
            var files = $(this)[0].files;
            o._uploadFiles(files);
        });
    },

    
    _uploadFiles: function( files ) {
        var o=this;
        var formdata = new FormData();
            
        if(!o.options.multiple){
            formdata.append('file', files[0]);
        }else{
           
            for (var x = 0; x < files.length; x++) {
                formdata.append("file[]", files[x]);
            }
        }
        
        formdata.append('_token', csrfToken());
                        
        console.log('_uploadFiles', formdata);

        
        $.ajax({
            url: o.options.url,
            type: o.options.method,
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                console.log(response);
                o._refreshThumbnail(response.imageurl);
                // addThumbnail(response);
            }
        });
    },
    
    _refreshThumbnail: function( imageurl ) {
        var o=this;

        if(!o.options.multiple){
            o.element.find('.image-thumbnail').attr('src',imageurl);
        }else{

        }
    }
});







// $(function() {
    // var restoreAll=function(){
    //     // $('html').children().css('pointer-events','auto');
    //     $(".dropzone").removeClass('active').removeClass('hover');
    // }
    // // preventing page from redirecting
    // $("html").on("dragover", function(e) {
    //     e.preventDefault();
    //     e.stopPropagation();
    //     // $(this).children().css('pointer-events','none');
    //     $(".dropzone").addClass('active');
        
    // });

    // // $("html").on("dragleave", function(e) {
    // //     e.preventDefault();
    // //     e.stopPropagation();
    // //     restoreAll();
        
    // // });

    // $("html").on("drop", function(e) { 
    //     // console.log("DROP OUT");
    //     e.preventDefault(); e.stopPropagation(); 
    //     restoreAll();

    // });

    // Drag enter
    // $('.dropzone').on('dragenter', function (e) {
    //     console.log("dragenter");
    //     e.stopPropagation();
    //     e.preventDefault();
    //     $(this).addClass('hover');
    // });

    // // Drag leave
    // $('.dropzone').on('dragleave', function (e) {
    //     console.log("dragleave");
    //     e.stopPropagation();
    //     e.preventDefault();
    //     $(this).removeClass('hover');
    // });
    
    // // Drop
    // $('.dropzone').on('drop', function (e) {
    //     e.stopPropagation();
    //     e.preventDefault();
    //     console.log("DROP IN");
        
    //     restoreAll();
        
    //     var file = e.originalEvent.dataTransfer.files;
    //     console.log(file);
    //     var fd = new FormData();

    //     fd.append('file', file[0]);
    //     console.log(fd);

    //     // uploadData(fd);
    // });


    // // Open file selector on div click
    // $(".browse-button").click(function(){
    //     $('#'+$(this).attr('for')).click();
    // });


    // // file selected
    // $("#f_profile_picture").change(function(){
    //     var fd = new FormData();
    //     var files = $(this)[0].files[0];
    //     fd.append('file',files);
    //     console.log(files);
    //     // uploadData(fd);
    // });
// });

// Sending AJAX request and upload file
function uploadData(formdata){

    $.ajax({
        url: 'upload.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            console.log(response);
            addThumbnail(response);
        }
    });
}

// Added thumbnail
function addThumbnail(data){
    $("#uploadfile h1").remove(); 
    var len = $("#uploadfile div.thumbnail").length;

    var num = Number(len);
    num = num + 1;

    var name = data.name;
    var size = convertSize(data.size);
    var src = data.src;

    // Creating an thumbnail
    $("#uploadfile").append('<div id="thumbnail_'+num+'" class="thumbnail"></div>');
    $("#thumbnail_"+num).append('<img src="'+src+'" width="100%" height="78%">');
    $("#thumbnail_"+num).append('<span class="size">'+size+'<span>');

}

// Bytes conversion
function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}




// $( document ).ready(function() {
//     // preventing page from redirecting
//     $("html").on("dragover", function(e) {
//         e.preventDefault();
//         e.stopPropagation();
//         $("#profile_picture_container").addClass("dragactive");
//     });

//     $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

//     $("#profile_picture_container").on('drop',function(e){
//         console.log("DROPPED");
//     });
// });