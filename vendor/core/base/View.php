<?php
/**
 * Created by Nikolay Tuzov
 */

namespace vendor\core\base;

class View
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
     * View constructor.
     * @param array $route
     * @param string $view
     * @param string $layout
     */
    public function __construct(array $route, $view = '', $layout = '')
    {
        $this->route = $route;
        $this->view = $view;

        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) extract($data);
        $fileView = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($fileView)) {
            require $fileView;
        } else {
            echo "<p>View <strong>$fileView</strong> not found </p>";
        }
        $content = ob_get_clean();

        if ($this->layout !== false) {
            $fileLayout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($fileLayout)) {
                require $fileLayout;
            } else {
                echo "<p>Layout <strong>$fileLayout</strong> not found </p>";
            }
        }
    }


}