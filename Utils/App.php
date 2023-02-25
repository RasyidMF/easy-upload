<?php
namespace Utils;

class App {

    /**
     * Check application key before running the code
    */
    public static function check(callable $callback) {
        if (Config::get('key') === @$_SERVER['HTTP_X_KEY']) {
            $callback();
        } else {
            return Response::json([
                'status' => false,
                'message' => 'Required key for authenticate'
            ], 403);
        }
    }
}