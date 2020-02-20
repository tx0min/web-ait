<?php

use App\Models\IconComponent;

if (! function_exists('icon')) {
	function icon($iconname,$attributes=[],$data=[]){
		$icon=new IconComponent($iconname,$attributes,$data);
		return $icon->render();
	}
}