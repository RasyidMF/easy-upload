<?php
namespace Utils;

class Response
{
    public static function json($data = null, $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);

        return print(json_encode($data));
    }
    public static function text($data = null, $code = 200)
    {
        http_response_code($code);
        return print($data);
    }
}