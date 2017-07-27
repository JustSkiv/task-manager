<?php
namespace vendor\libs\helpers;
/**
 * Created by Nikolay Tuzov
 *
 * Класс для работы с URL
 */
class UrlHelper
{
    /**
     * Преобразование формата "через дефис" к формату CamelCase
     *
     * @param string $string
     * @param bool $capitalizeFirstCharacter
     * @return mixed|string
     */
    public static function dashesToCamelCase($string, $capitalizeFirstCharacter = true)
    {
        $str = str_replace('-', '', ucwords($string, '-'));
        if (!$capitalizeFirstCharacter) $str = lcfirst($str);

        return $str;
    }

}