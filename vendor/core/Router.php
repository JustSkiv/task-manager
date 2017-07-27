<?php

namespace vendor\core;

use vendor\libs\helpers\UrlHelper;


/**
 * Created by Nikolay Tuzov
 */
class Router
{
    /**
     * Список маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     * Текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     * Добавление маршрута в список маршрутов
     * @param string $rule
     * @param array $route
     */
    public static function add($rule, $route = [])
    {
        self::$routes[$rule] = $route;
    }

    /**
     * Получение таблицы маршрутов
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Получение текущего маршрута
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Сопоставление URL маршрутом из списка маршрутов
     * @param string $url
     * @return bool
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $rule => $route) {
            if (preg_match("#$rule#i", $url, $parameters)) {
                foreach ($parameters as $key => $value) {
                    if (is_string($key)) $route[$key] = $value;
                }
                if (!isset($route['action'])) $route['action'] = 'index';
                self::$route = $route;
                return true;
            }
        }

        return false;
    }

    /**
     * Перенаправление URL на соответствующий маршрут
     * @param $url
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);

        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . UrlHelper::dashesToCamelCase(self::$route['controller']) . 'Controller';

            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = 'action' . UrlHelper::dashesToCamelCase(self::$route['action']);
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->renderView();
                } else {
                    echo "Action <strong>$action</strong> does not exist!";
                }
            } else {
                echo "BaseController <strong>$controller</strong> does not exist!";
            }
        } else {
            http_response_code(404);
            include 'error.php';
        }
    }

    /**
     * Отсекает явные GET-парамтеры
     * Пример: /p1/p2/?var3=p3&var4=p4 => /p1/p2
     *
     * @param $url
     * @return mixed
     */
    public static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (!strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }

        return '';

    }
}