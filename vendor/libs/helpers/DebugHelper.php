<?php

namespace vendor\libs\helpers;
/**
 * Created by Nikolay Tuzov
 *
 * Вспомогательный класс
 */
class DebugHelper
{
    /**
     * Вывод отладочной информации в удобном виде
     * @param $arr
     */
    public static function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }
}