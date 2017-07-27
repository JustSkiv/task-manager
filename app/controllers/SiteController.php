<?php

namespace app\controllers;

use app\models\Task;
use vendor\libs\helpers\DebugHelper;

/**
 * Created by Nikolay Tuzov
 */
class SiteController extends AppController
{
    public function actionIndex()
    {
        $model = new Task();
        $windows = \R::findAll('window');

        $menu = $this->menu;
        $this->setMeta([
            'keywords' => 'Meta main keywords',
            'description' => 'Meta main description'
        ]);
        $meta = $this->meta;

        $this->setData(
            compact('windows', 'menu', 'meta')
        );
    }

    public function actionTest()
    {

    }

}