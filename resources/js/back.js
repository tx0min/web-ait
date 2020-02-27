import 'jquery-ui/ui/widgets/sortable.js';




var UserForm  = {
    placeholder_image : baseUrl('img/pencil-placeholder.png'),
    
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
        this.remover = this.element.find('.remover');
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
            // console.log("DROP IN");
            
            UserForm.deactivateDropzones();
            var files = e.originalEvent.dataTransfer.files;
            
            o._uploadFiles(files);
            
        });

        this.element.find('.thumbnails-container').sortable({
        //    placeholder: "ui-state-highlight",
           update: function( event, ui ) {
                var items=ui.item.closest('.thumbnails-container').find('.thumb-image');
                var ids=[];
                $.each(items, function(i,item){
                    ids.push($(item).data('id'));
                })
                
                o._saveSorting(ids)
           }
        });

        // Open file selector on div click
        this.button.click(function(e){
            e.preventDefault();
            o.fileinput.click();
        });
        
        // remove image
        this.element.on('click','.remover', function(e){
            e.preventDefault();
            
            o._remove($(this).closest('.thumb-image').data('id'));
        });


        // file selected
        this.fileinput.change(function(e){
            var files = $(this)[0].files;
            o._uploadFiles(files);
        });
    },

    
    _saveSorting: function( ids ) {
        var o=this;
        var url=baseUrl()+"/backend/sort/"+this.options.pictureType;
        
        al('_saveSorting', url);
        // var params={
        //     ids : ids,
        // };
        // al(params);
        var formdata = new FormData();
        for(var i=0;i<ids.length;i++){
            formdata.append('ids[]', ids[i]);
        }
        // formdata.append('_token', csrfToken());
        // al(formdata);
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': csrfToken()
            },
            success: function(response){
                console.log(response);
                // o._removeThumbnail(response.removed);
            },
            error: function( jqXHR, textStatus, errorThrown ){
                o._showError(jqXHR.responseJSON);
            }
        });
    },
    _remove: function( id ) {
        var o=this;
        var url=this.options.url;
        if(id) url+="/"+id;

        al('_remove', url);
        var params={
            // _token : csrfToken()
        };
        // al(params); 

        $.ajax({
            url: url,
            type: 'delete',
            data: params,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': csrfToken()
            },
            success: function(response){
                // console.log(response);
                o._removeThumbnail(response.removed);
            },
            error: function( jqXHR, textStatus, errorThrown ){
                o._showError(jqXHR.responseJSON);
            }
        });
    },

    _uploadMultipleFiles: function( files ) {
        var o=this;

        var formdata = new FormData();
        formdata.append('_token', csrfToken());
        formdata.append('multiple', true);

        for (var x = 0; x < files.length; x++) {
            formdata.append('file[]', files[x]);
        }
         
        $.ajax({
            url: o.options.url,
            type: o.options.method,
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                // al(response);
                if(response.errors.length>0){
                    $.each(response.errors, function(i,item){
                        o._showError(item);
                    });
                }
                o._addThumbnails(response);
            },
            error: function( jqXHR, textStatus, errorThrown ){
                al("Error",jqXHR);
                o._showError(jqXHR.responseJSON);
            }
        });
        
    },

    _uploadSingleFile: function( file ) {
        var o=this;
        var formdata = new FormData();
        formdata.append('file', file);
        formdata.append('_token', csrfToken());
        
        $.ajax({
            url: o.options.url,
            type: o.options.method,
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                // console.log(response);
                o._refreshThumbnail(response.imageurl);
                o._showSuccess("Imatge canviada!");
            },
            error: function( jqXHR, textStatus, errorThrown ){
                // al("Error single",jqXHR);
                o._showError(jqXHR.responseJSON);
            }
        });
    },

    _uploadFiles: function( files ) {
        var o=this;
        var formdata = new FormData();
            
        if(!o.options.multiple){
            o._uploadSingleFile(files[0]);

        }else{
            o._uploadMultipleFiles(files);
            
        }
        
                        
        
        
    },
    
    _showError: function( response ) {
        var msg="";
        al(response);
        if(typeof response === 'string') msg=response;
        if(typeof response === 'object' && response.hasOwnProperty('message')) msg=response.message;
        if(msg)
            $('#messages').append($('<div class="alert alert-danger alert-dismissible"><div>'+msg+'<div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><small aria-hidden="true">'+_icon('times')+'</small></button></div>'));
    },

    _showSuccess: function( msg ) {
        $('#messages').append($('<div class="alert alert-success alert-dismissible"><div>'+msg+'<div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><small aria-hidden="true">'+_icon('times')+'</small></button></div>'));
    },

    _removeThumbnail: function( id ) {
        var o=this;
        if(id){
            o.element.find('.thumbnails-container [data-id='+id+']').remove();
        }else{
            o.element.addClass('empty');
            o.element.find('.image-thumbnail').attr('src', UserForm.placeholder_image );
        }
    },
        
    _addThumbnails: function( response ) {
        // al('_addThumbnail',imageurl);
        var o=this;
        // for(var i=0;i<response.images.length;i++){
        var i=0;
        o._showSuccess(response.images.length+ " imatges afegides");
        
        var intr = setInterval(function(){
            if(i<response.images.length){
                
                
                var image=response.images[i];
                var thumb='<div class="col-sm-4 col-md-3 col-6 p-2 thumb-image" data-id="'+image.id+'" >'+
                '<figure>'+
                    '<img src="'+image.url+'" class="img-fluid w-100 " />'+
                    '<a href="#" class="remover">'+_icon('times')+'</a>'+
                '</figure>'+
                '</div>';
                // al(thumb);
                o.element.find('.thumbnails-container').append($(thumb));
                i++;
            }else{
                clearInterval(intr);
            }
        },100);
        // }
        

    },

    _refreshThumbnail: function( imageurl ) {
        var o=this;

        o.element.removeClass('empty');
        if(!o.options.multiple){
            o.element.find('.image-thumbnail').attr('src',imageurl);
        }else{

        }
    }
});





