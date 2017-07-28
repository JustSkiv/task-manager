<?php
/**
 * Created by Nikolay Tuzov
 */

namespace app\controllers;


use app\models\Task;
use vendor\core\Db;

class TaskController extends AppController
{
    public function actionIndex()
    {
        Db::instance();

        $page = 1;
        $limit = 3;

        // Посчитаем общее количество страниц
        $tasksCount = \R::count('task');
        $pagesCount = ceil($tasksCount / $limit);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'] > $pagesCount ? $pagesCount : $_GET['page'];
        }

        $previous = $page == 1 ? false : $page - 1;
        $next = $page == $pagesCount ? false : $page + 1;

        $tasks = Task::getPageElements($page, $limit);
        $this->setData(compact('tasks', 'page', 'pagesCount', 'next', 'previous'));
    }

    public function actionCreate()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->db = Db::instance();
            $task = \R::dispense('task');
            $task->title = $_POST['title'];
            $task->user_name = $_POST['user_name'];
            $task->user_email = $_POST['user_email'];
            $task->text = $_POST['text'];


            if (isset($_FILES['image'])) {
                $errors = array();
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];

                $tmp = explode('.', $file_name);
                $file_ext = strtolower(end($tmp));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 5000 * 1024) {
                    $errors[] = 'Максимальный размер файла: 5000 KB';
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "images/task/" . $file_name);

                    $task->image = $file_name;
//                    echo "Success";
                } else {
                    print_r($errors);
                }

            }


            \R::store($task);
            $this->redirect('/');
        }

    }
}