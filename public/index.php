<?php
/**
 * Created by Nikolay Tuzov
 */

use vendor\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'main');

require '../vendor/libs/helpers/DebugHelper.php';

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

//Добавляемые маршруты
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)?$', ['controller' => 'page']);
Router::add('^page/(?P<alias>[a-z-]+)?$', ['controller' => 'page', 'action' => 'view']);
//Router::add('^articles/?(?P<action>[a-z-]+)?$');

// Общие маршруты
Router::add('^$', ['controller' => 'main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);