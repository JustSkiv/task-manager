<?php
/**
 * created by: Nikolay Tuzov
 */

namespace vendor\core\base;


abstract class BaseController
{
    /**
     * Текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * Текущий вид
     * @var string
     */
    public $view;

    /**
     * Текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * Пользовательские данные
     * @var array
     */
    public $data = [];

    /**
     * BaseController constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = $this->route['action'];
    }

    /**
     * Генерация представления
     */
    public function renderView()
    {
        $viewObject = new View($this->route, $this->view, $this->layout);
        $viewObject->render($this->data);
    }

    /**
     * Передача переменных в представление
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;

    }

}