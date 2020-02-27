<?php


function wp_image_url($image ,$size=null){
    try{
        if(!$size) $size='thumbnail';
        if($tmp=$image->size($size)) $url=$tmp->url;
        else $url=$image->url;
        
        return $url;
    }catch(Exception $e){
        return $image->url;
    }
}
