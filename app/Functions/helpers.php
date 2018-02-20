<?php

if(!function_exists('on_page')) {
    /**
     * is the user on route name page
     * Useful when using the active class on a bootstrap list
     *
     * @param $path
     * @return bool
     */
    function on_page($path)
    {
        return request()->is($path);
    }
}

if(!function_exists('return_if')) {
    /**
     * if the condition is true then it will return the value
     *
     * @param $condition
     * @param $value
     * @return mixed
     */
    function return_if($condition, $value)
    {
        if($condition) {
            return $value;
        }
    }
}