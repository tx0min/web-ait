<?php


if (! function_exists('to_object')) {
	function to_object($array, $firstlevel=true) {
        if($firstlevel){
            $tmp=json_decode(json_encode($array), FALSE);
            foreach($array as $key=>$value){
                $tmp->{$key} =  $value;
            }
            return $tmp;

        }else{
            return json_decode(json_encode($array), FALSE);
        }
		
	}
}



if (! function_exists('to_array')) {
	function to_array($object) {
	 	return json_decode(json_encode($object), true);
	}
}

if (! function_exists('fullquery')) {

	function fullquery($query){
		return vsprintf(str_replace(array('?'), array('\'%s\''), $query->toSql()), $query->getBindings());
	}
}
