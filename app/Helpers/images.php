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


function human_filesize($size, $precision = 2) {
    for($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {}
    return round($size, $precision).['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
}
