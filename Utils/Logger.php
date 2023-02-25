<?php

namespace Utils;

class Logger
{
    public static function upload($files, $target) {
        $file = fopen(PATH . Config::get('path_log'), "a");

        fwrite($file, "[" . date("Y-m-d H:i:s") . "] ");
        fwrite($file, "Uploaded an file $files[name] in $target");
        fwrite($file, "\n");
        fclose($file);
    }
}