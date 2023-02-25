<?php

namespace Utils;

class Request
{
    public static function get($key, $default = null) {
        return empty(@$_GET[$key]) ? $default : htmlspecialchars($_GET[$key]);
    }
    public static function post($key, $default = null) {
        return empty(@$_POST[$key]) ? $default : htmlspecialchars($_POST[$key]);
    }
    public static function files($key, $default = null) {
        return empty(@$_FILES[$key]) ? $default : $_FILES[$key];
    }
    public static function input($key, $default = null) {
        if (self::get($key, $default)) return self::get($key, $default);
        if (self::post($key, $default)) return self::post($key, $default);
        if (self::files($key, $default)) return self::files($key, $default);

        return $default;
    }
}