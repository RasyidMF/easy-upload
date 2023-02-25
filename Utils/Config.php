<?php
namespace Utils;

class Config 
{
    public static function get($key = null) {
        $__config = json_decode(file_get_contents(PATH . '/config.json'));
        return empty($key) ? $__config : $__config->{$key};
    }

    public static function getUploaderPath($append = '/') {
        return PATH . self::get('path') . $append;
    }
}