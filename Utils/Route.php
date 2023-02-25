<?php

namespace Utils;

class Route
{
    private static $_ROUTE_LIST = [];

    /**
     * Execute the route has been listed
    */
    public static function execute(callable $routes) {
        $routes();

        foreach(self::$_ROUTE_LIST as $ROUTE) {
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];
            $callback = $ROUTE['callback'];

            $routeUrl = $ROUTE['url'];
            if ($routeUrl[0] != '/') {
                $routeUrl = '/' . $routeUrl;
            }

            if ($method == $ROUTE['method'] && $uri == $routeUrl) {
                if (is_callable($callback)) {
                    return $ROUTE['callback'](new Request);
                } else if (is_string($callback)) {
                    $offset = explode("@", $callback);
                    
                    $controllerNamespace = "\Controllers\\$offset[0]";
                    $controller = new $controllerNamespace();

                    if (is_callable([$controller, $offset[1]])) {
                        return call_user_func([$controller, $offset[1]], new Request);
                    } else {
                        return Response::json([
                            'status' => false,
                            'message' => 'Unknown controller that called ' . $callback,
                        ], 404);
                    }
                }
            }
        }

        return Response::json([
            'status' => false,
            'message' => 'Unknown path that accessed',
        ], 404);
    }
    public static function post($url, callable | string $callback) {
        self::$_ROUTE_LIST[] = [
            'url' => $url,
            'callback' => $callback,
            'method' => 'POST'
        ];
    }
    public static function get($url, callable $callback) {
        self::$_ROUTE_LIST[] = [
            'url' => $url,
            'callback' => $callback,
            'method' => 'GET'
        ];
    }
}