<?php
use Carbon\Carbon;
use App\Http\Controllers\BlogController;

if (! function_exists('post_thumbnail_url')) {

    function post_thumbnail_url($post, $size=null){
        $imagesrc=null;
        $featured=$post->thumbnail;

        if($featured){
            $image=$featured->size($size);
            if(is_array($image)) $imagesrc=$image["url"];
            elseif(is_string($image)) $imagesrc=$image;

        }
        return $imagesrc;
    }
}

if (! function_exists('post_importance')) {

    function post_importance($post){
        $importance=$post->acf->select('importance');
        if(!$importance) $importance='normal';
        return $importance;
    }
}


if (! function_exists('post_categories')) {

    function post_categories($post){
        $excluded=BlogController::$excluded_categories;
        if(isset($post->terms["category"]))
            return collect($post->terms["category"])->except($excluded)->toArray();
    }
}


if (! function_exists('post_date')) {

    function post_date($post, $ellapsed=false){
        if($ellapsed) return $post->post_date->diffForHumans();
        else return $post->post_date->format("j F Y");


        // return $post->post_date;
    }
}
