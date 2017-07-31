<?php

namespace app\controllers;

use app\models\Task;

/**
 * Created by Nikolay Tuzov
 */
class SiteController extends AppController
{
    public function actionSignin()
    {
        $this->setTitle('Авторизация');
        if (isset($_POST['login']) && isset($_POST['password'])) {
            if ($_POST['login'] == 'admin' && $_POST['password'] == '123') {
                $_SESSION['admin'] = true;

                $this->redirect('/');
            }
        }

        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
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