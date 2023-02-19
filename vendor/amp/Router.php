<?php


namespace amp;


class Router
{
    protected static array $routes = [];
    protected static array $route = []; /* admin_prefix, controller, action */

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['admin_prefix']
                            . self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action(); // call method
                } else {
                    throw new \Exception("Method $action in controller $controller not found", 404);
                }
            } else {
                throw new \Exception("Controller $controller not found", 404);
            }
        } else {
            throw new \Exception("Page not found", 404);
        }

    }

    protected static function matchRoute($url): bool
    {
        foreach(self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#i", $url, $matches )) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }

                $route['action'] = $route['action'] ?? 'index';
                $route['admin_prefix'] = isset($route['admin_prefix'])
                                            ? $route['admin_prefix'] . '\\'
                                            : '';

                if (isset($route['controller'])) {
                    $route['controller'] = self::upperCamelCase($route['controller'], false);
                }

                if (isset($route['action'])) {
                    $route['action'] = self::upperCamelCase($route['action'], true);
                }

                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name, bool $skipFirst = false): string
    {
        $arStr = explode('-', $name);
        $arCap = array_map('ucfirst', $arStr);
        $newStr = implode($arCap);
        return $skipFirst ? lcfirst($newStr) : $newStr;
    }


}