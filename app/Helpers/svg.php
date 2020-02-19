
<?php

use App\Modules\ActionProvider;
use Illuminate\Support\Str;


if (! function_exists('svg')) {

	function svg($path, $attributes=[]){
        $defaults=[
            'class'=>'',
            'style'=>'',
        ];
        if($attributes && is_array($attributes)) $defaults=array_merge($defaults,$attributes);

        $svg = new \DOMDocument();
        // dd(public_path($path));
        $svg->load(public_path($path));
        foreach($defaults  as $key=>$attribute){
            $svg->documentElement->setAttribute($key, $attribute);
        }
        $output = $svg->saveXML($svg->documentElement);
        return $output;
	}
}