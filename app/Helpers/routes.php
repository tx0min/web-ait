
<?php

if (! function_exists('isActiveRoute')) {

    function isActiveRoute($route, $class='active'){
        if(request()->route()->getName()==$route) return $class;
        return false;
    }
}