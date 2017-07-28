<?php
/**
 * Created by Nikolay Tuzov
 */

namespace app\controllers;


use app\models\Task;

class TaskController extends AppController
{
    public function actionIndex()
    {
        $tasks = Task::findAll();

        $this->setData(compact('tasks'));
    }
}