<?php

namespace app\core;

require_once "core/HttpMethod.php";

class Router
{
    private static $routes = [];

    public static function add($method, $path, $callback)
    {
        self::$routes[] = [
            'method' => $method,
            'path' => "#^" . $path . "$#siD",
            'callback' => $callback
        ];
    }

    public static function post($path, $callback)
    {
        self::add(HttpMethod::POST, $path, $callback);
    }

    public static function get($path, $callback)
    {
        self::add(HttpMethod::GET, $path, $callback);
    }

    public static function put($path, $callback)
    {
        self::add(HttpMethod::UPDATE, $path, $callback);
    }

    public static function delete($path, $callback)
    {
        self::add(HttpMethod::DELETE, $path, $callback);
    }

    public static function run()
    {
        $current_method = $_SERVER["REQUEST_METHOD"];
        $base_path = dirname($_SERVER["SCRIPT_NAME"]);
        $current_uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // Hapus base path dari URI
        if ($base_path !== '/') $current_uri = substr($current_uri, strlen($base_path));

        // Pastikan URI dimulai dengan '/'
        $current_uri = '/' . ltrim($current_uri, '/');

        // Cek apakah ada route yang terdaftar dan cocok dengan permintaan
        foreach (self::$routes as $route) {
            if ($route['method'] === $current_method && preg_match($route['path'], $current_uri)) {
                echo call_user_func($route['callback']);
                return true;
            }
        }

        // Jika tidak ada yang cocok, tampilkan 404
        http_response_code(404);
        require_once __DIR__ . "/../views/errors/404.php";
        return false;
    }

    public static function view($path, $data = [])
    {
        $full_path = __DIR__ . "/../views/" . ltrim($path) . '.php';
        if (file_exists($full_path)) {
            extract($data);
            ob_start();
            require $full_path;
            return ob_get_clean();
        }
    }
}