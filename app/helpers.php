<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function category_nav_active($route)
{
    if(request()->url() === $route) {
        return "active";
    }
    return null;
}
