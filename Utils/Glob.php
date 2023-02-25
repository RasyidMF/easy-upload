<?php

namespace Utils;

class Glob
{
    private static function recursionDir(string $dirPath, $firstDirAppendAsWell = false) {
        $result = [];
        if ($firstDirAppendAsWell) $result[] = $dirPath;

        foreach(glob("$dirPath/*", GLOB_ONLYDIR) as $dir) {
            foreach(self::recursionDir($dir, true) as $res) {
                $result[] = $res;
            }
        }

        return $result;
    }

    /**
     * Simple getting all files with sub-dir
    */
    public static function get(string $dir, $match = "*") {
        $result = [];
        $recursionDir = self::recursionDir($dir);

        foreach(glob($dir . "/$match") as $f) {
            if (is_file($f)) $result[] = $f;
        }

        foreach($recursionDir as $rc) {
            foreach(glob($rc . "/$match") as $f) {
                if (is_file($f)) $result[] = $f;
            }
        }

        return $result;
    }

    /**
     * Getting all files with some details
    */
    public static function getDetail(string $dir, $match = "*") {
        $files = self::get($dir, $match);
        $result = [];

        foreach($files as $f) {
            $result[] = [
                'path' => $f,
                'parent_dir' => dirname($f),
                'file_name' => basename($f),
                'last_modified' => Date::format(filemtime($f)),
                'created_on' => Date::format(filectime($f)),
                'last_accessed' => Date::format(fileatime($f)),
                'size' => filesize($f),
                'ext' => pathinfo($f),
                'hash' => hash_file('crc32b', $f)
            ];
        }

        return $result;
    }
}