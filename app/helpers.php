<?php
use Illuminate\Support\Str;

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

/**
 * 生成摘要存入数据库，在存入数据库之前执行
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', '', strip_tags($value)));
    return Str::limit($excerpt, $length);
}
