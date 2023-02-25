<?php

/**
 * This an autoload plugin that been created in Easy Upload plugin
 * 
 * Author: RasyidMF
*/

define("PATH", __DIR__);

$folderToLoad = ['Utils', 'Controllers'];
foreach($folderToLoad as $f) {
    foreach(glob("$f/*.php") as $fl) {
        require_once($fl);
    }
}