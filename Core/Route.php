<?php
namespace Core;

class Route {
    private static $routes = [];

    public static function add($method, $path, $callback) {
        $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $path);
        self::$routes[] = [
            'method' => strtoupper($method),
            'path' => '#^' . $path . '$#',
            'callback' => $callback
        ];
    }

    public static function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        foreach (self::$routes as $route) {
            if ($route['method'] === $method && preg_match($route['path'], $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func_array($route['callback'], $params);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}