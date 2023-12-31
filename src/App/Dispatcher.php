<?php

namespace number\gen\App;

use number\gen\Config\Config;

class Dispatcher
{

    public static function Dispatch()
    {
        $c = false;
        $m = false;
        if (isset($_GET['controller']) && isset($_GET['method'])) {
            if (class_exists(Config::CONTROLLER . $_GET['controller'])) {
                $c = Config::CONTROLLER . $_GET['controller'];
                $controller = new $c();
                if (method_exists($controller, $_GET['method'])) {
                    $m = $_GET['method'];
                    $controller->$m();
                    return;
                }
            }
        }
        $c = Config::CONTROLLER . Config::DEFAULT_CONTROLLER;
        $m = Config::DEFAULT_METHOD;
        $controller = new $c();
        $controller->$m();
    }

    /**
     * Génère une URL avec le nom du controlleur et sa méthode
     */
    public static function generateUrl(string $controllerName = "", string $method = "", ?array $query = null): string
    {
        if (empty($controllerName) && empty($method)) {
            return 'index.php';
        }
        $url = 'index.php?controller=' . $controllerName . '&method=' . $method;
        if (is_array($query) && count($query) > 0) {
            foreach ($query as $key => $value) {
                $url = $url . '&' . $key . '=' . $value;
            }
        }
        return $url;
    }

    /**
     * Redirige sur la page indiquée
     */
    public static function redirect($controllerName = "", $method = "", ?array $query = null)
    {
        header('location: ' . self::generateUrl($controllerName, $method, $query));
    }
}
