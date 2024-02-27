<?php

namespace vfx;

class Router
{

    protected static array $routes = [];
    protected static array $route = [];

    public static function add(string $regexp, array $route = []): void
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

    public static function getRouteName(string $name, string $key = null): mixed
    {
        foreach (self::$routes as $pattern => $route) {
            if (isset($route['name']) && $route['name'] == $name) {
                $route['url'] = '/' . trim($pattern);
                return !empty($key) && isset($route[$key]) ? $route[$key] : $route;
            }
        }
        return null;
    }

    public static function dispatch(string $url): void
    {

        if(self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';

            if(class_exists($controller)) {
                App::$app->setProperty('route', self::$route);
                $controller_object = new $controller(self::$route);

                $controller_object->getModel();

                $action = self::$route['action'] . 'Action';
                if(method_exists($controller_object, $action)) {
                     $controller_object->$action();
                     $controller_object->getView();
                } else {
                    throw new \Exception("Метод {$action} в контроллере {$controller} не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }

    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            preg_match_all('#<~(.*?)~>#', $pattern, $name_slugs);

            if(isset($name_slugs[1]) && count($name_slugs[1]) > 0) {
                foreach ($name_slugs[1] as $name_slug) {
                    $pattern = str_replace("<~{$name_slug}~>", "(?P<{$name_slug}>[a-z0-9-]+)", $pattern);
                }
            }

            if(preg_match("#^(?P<lang>[a-z]{2})?/?{$pattern}$#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = !empty($route['action']) ? self::lowerCamelCase($route['action']) : 'index';

                $route['admin_prefix'] = !isset($route['admin_prefix']) ? '' : $route['admin_prefix'] . '\\';

                self::$route = $route;
                return true;
            }
        }

        return false;
    }

    protected static function upperCamelCase(string $name): string
    {
        $name = str_replace('-', ' ', $name);

        $name = ucwords($name);

        return str_replace(' ', '', $name);
    }

    protected static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }

}