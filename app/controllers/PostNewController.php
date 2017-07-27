<?php

namespace app\controllers;

/**
 * Created by Nikolay Tuzov
 */
class PostNewController  extends AppController
{
    public $layout = 'main';

    public function before()
    {
        echo 'Post New - before!';
    }

    public function actionIndex()
    {
//        echo 'Post New - index!';
    }

    public function actionTest()
    {
        $this->layout = 'default';
        $this->view = 'test';

        $name = 'Skiv';
        $test = 'testval';
        $cars = ['bmw', 'ferrari'];
        $this->setData([
            'name' => $name,
            'test' => $test,
            'cars' => $cars,
            'pageTitle' => 'title test'
        ]);
    }

    public function actionTestNew()
    {
//        echo 'Post New - test new!';
    }
}