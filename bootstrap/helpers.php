<?php
if (! function_exists('request')) {
    /**
     * Return request.
     *
     * @return mixed
     */
    function request()
    {
        return app('request');
    }
}

function getOldInput($inputName, $default = '')
{
    return request()->session()->getOldInput($inputName, $default);
}

function oldInputHasError($inputName)
{
    return (Session::get('errors')) ? Session::get('errors')->has($inputName) : false;
}