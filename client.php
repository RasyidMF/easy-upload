<?php
use Utils\Config;
use Utils\Http;

/**
 * DONT UPLOAD THIS FILE IN YOUR SERVER!
 * 
 * Before running the client side, you need to configure the server by editing the config at
 * config.json
 * 
*/
require_once('autoload.php');

$version = Config::get('version');
$key = Config::get('key');
$host = Config::get('host');

$header = [
    "X-KEY: $key"
];

print("Easy Upload V$version - RasyidMF\n");
print("---------------------------------------\n\n");

if (count($argv) > 1) {
    
    $command = @$argv[1];
    $params = @$argv[2];
    $parent = dirname($params);

    // Upload File
    if ($command == '--upload') {
        print("Uploading ($params) in ($parent)\n");
        return print(new Http($host . "/upload-file"))
            ->data([
                'parent_folder' => $parent
            ])
            ->header($header)
            ->file($params, 'file')
            ->execute();
    }

} else {
    return print("
        List commands:
        --upload        Upload the specific path file (ex: --upload /path/file.php)
    ");
}