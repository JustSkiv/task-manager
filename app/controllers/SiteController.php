<?php

namespace app\controllers;

use app\models\Task;

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

    public function actionSignin()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            if ($_POST['login'] == 'admin' && $_POST['password'] == '123') {
                $_SESSION['admin'] = true;

                $this->redirect('/');
            }
        }

        if ($_SESSION['admin'] === true) {
            $this->redirect('/');
        }
    }

    public function actionSignout()
    {
        if ($_SESSION['admin'] === true) {
            $_SESSION['admin'] = false;
        }

        $this->redirect('/');
    }

}