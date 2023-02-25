<?php

/**
 * Load all utility
*/
require_once('autoload.php');

use Utils\App;
use Utils\Request;
use Utils\Response;
use Utils\Route;

/**
 * Running the easy upload instance 
*/
App::check(function() {
    Route::execute(function() {

        /**
         * Get all files in path you already provided in config.json
        */
        Route::post('get-file', "FilesController@getFile");

    });
});