<?php

namespace App\Http\Helpers;

class CommonHelper 
{
    public function getRouteActionName(){
        $route = \Route::getCurrentRoute()->getActionName();
        $startPosition = (strpos($route,"@")) + 1;
        return substr($route , $startPosition);
    }
}
