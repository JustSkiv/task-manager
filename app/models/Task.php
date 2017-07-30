<?php

namespace app\models;

use vendor\core\base\BaseModel;

/**
 * created by: Nikolay Tuzov
 */
class Task extends BaseModel
{
    const MAX_WIDTH = 320;
    const MAX_HEIGHT = 240;
    public static $table = 'task';
}