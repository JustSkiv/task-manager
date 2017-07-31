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
    public static $sortFieldsArray = ['id', 'user_name','user_email','status'];

    /**
     * Загружает данные в модель (с предварительной обработкой)
     * @param $task
     * @param $data
     */
    public static function loadData($task, $data)
    {
        $task->title = htmlspecialchars(addslashes($data['title']));
        $task->user_name = htmlspecialchars(addslashes($data['user_name']));
        $task->user_email = htmlspecialchars(addslashes($data['user_email']));
        $task->text = htmlspecialchars(addslashes($data['text']));
        $task->status = $data['status'] == 1 ? 1 : 0;
    }
}