<?php
/**
 * Created by Nikolay Tuzov
 */

namespace app\controllers;


use app\models\Task;
use vendor\core\Db;
use vendor\libs\SimpleImage;

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

        if (isset($_GET['page']) && !empty($_GET['page']) && $tasksCount > 0) {
            $page = $_GET['page'] > $pagesCount ? $pagesCount : $_GET['page'];
        }

        $sort = 'id';
        $order = 'ASC';
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            $sort = $_GET['sort'];

            if ($sort[0] == '-') {
                $order = 'DESC';
            }
        }

        $tasks = Task::getPageElements($page, $limit, ltrim($sort, '-'), $order);


        $previous = false;
        $next = false;

        if ($page > 1 && $tasksCount > 3)
            $previous = true;

        if ($page < $pagesCount)
            $next = $page + 1;

        $this->setData(compact('tasks', 'page', 'pagesCount', 'next', 'previous', 'sort'));
    }

    /**
     * Добавление задачи
     */
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
                $file = $_FILES['image'];
                $this->saveImage($file, $task);
            }

            \R::store($task);
            $this->redirect('/');
        }
    }

    /**
     * Редактирование задачи
     */
    public function actionUpdate()
    {
        // Если пользователь не админ, доступ на эту страницу закрыт
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
            $this->redirect('/');
        }

        Db::instance();

        $id = $_GET['id'];
        $task = \R::load('task', $id);

        if (isset($_POST) && !empty($_POST)) {
            $task->title = $_POST['title'];
            $task->user_name = $_POST['user_name'];
            $task->user_email = $_POST['user_email'];
            $task->text = $_POST['text'];


            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                $this->saveImage($file, $task);
            }

            \R::store($task);
            $this->redirect('/');
        }

        $this->setData(compact('task'));
    }

    /**
     * Сохранение изображения
     * @param $file
     * @param $task
     */
    protected function saveImage($file, $task)
    {
        $errors = array();
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];

        $file_path = "images/task/" . $file_name;


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
            $image = new SimpleImage();
            $image->load($file_tmp);

            if ($image->getWidth() > Task::MAX_WIDTH)
                $image->resizeToWidth(Task::MAX_WIDTH);
            if ($image->getHeight() > Task::MAX_HEIGHT)
                $image->resizeToHeight(Task::MAX_HEIGHT);

            $image->save($file_path);

            $task->image = $file_name;
        } else {
            print_r($errors);
        }
    }
}