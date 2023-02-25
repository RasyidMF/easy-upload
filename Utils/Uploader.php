<?php

namespace Utils;

class Uploader
{
    public static function isDirExists(string $dir) {
        return file_exists($dir);
    }
    public static function createDirectory(string $dirName, $recursive = true) {
        return mkdir($dirName, 0777, $recursive);
    }

    public static function identify($files) {
        return [
            'imagesize' => getimagesize($files['tmp_name']),
            'type' => pathinfo($files['name'], PATHINFO_EXTENSION),
            'size' => $files['size'],
            'filename' => $files['name'],
        ];
    }

    public static function save($files, string $target) {
        return move_uploaded_file($files['tmp_name'], $target);
    }

    public static function delete(string $target) {
        return unlink($target);
    }
}