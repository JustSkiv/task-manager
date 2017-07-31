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
    /**
     * Список задач
     */
    public function actionIndex()
    {
        $this->setTitle('Список задач');

        // Устанавливаем соединение с БД
        Db::instance();

        $page = 1;
        $limit = 3;

        // Посчитаем общее количество страниц
        $tasksCount = \R::count('task');
        $pagesCount = ceil($tasksCount / $limit);

        // Если есть параметр с номером страницы, используем его
        if (isset($_GET['page']) && !empty($_GET['page']) && $tasksCount > 0) {
            // Проверяем корректность указанной страницы
            $page = $_GET['page'] > $pagesCount ? $pagesCount : $_GET['page'];
        }

        // Сортировка списка задач
        $sort = 'id';
        $order = 'ASC';
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if (in_array($_GET['sort'], Task::$sortFieldsArray)) {
                $sort = $_GET['sort'];
            }

            if ($sort[0] == '-') {
                $order = 'DESC';
            }
        }

        // Получаем список задач с учетом нужной страницы и сортировки
        $tasks = Task::getPageElements($page, $limit, ltrim($sort, '-'), $order);

        // Проверяем, нужны ли кнопки "следующая/предыдущая страница"
        $previous = false;
        $next = false;
        if ($page > 1 && $tasksCount > 3)
            $previous = true;
        if ($page < $pagesCount)
            $next = $page + 1;

        // Передаём данные в представление
        $this->setData(compact('tasks', 'page', 'pagesCount', 'next', 'previous', 'sort'));
    }

    /**
     * Добавление задачи
     */
    public function actionCreate()
    {
        $this->setTitle('Добавление задачи');

        if (isset($_POST) && !empty($_POST)) {
            // Устанавливаем соединение с БД
            $this->db = Db::instance();
            $task = \R::dispense('task');

            // Загружаем данные в модель
            Task::loadData($task, $_POST);

            // Обраотка изображения, если оно есть
            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                $this->saveImage($file, $task);
            }

            // Сохраняем модель в БД
            \R::store($task);
            $this->redirect('/');
        }
    }

    /**
     * Редактирование задачи
     * TODO: Часть функционала дублирует actionCreate, можно обобщить эти методы
     */
    public function actionUpdate()
    {
        $this->setTitle('Редактирование задачи');
        // Если пользователь не админ, доступ на эту страницу закрыт
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
            $this->redirect('/');
        }

        // Устанавливаем соединение с БД
        Db::instance();
        $task = \R::load('task', $_GET['id']);

        if (isset($_POST) && !empty($_POST)) {
            // Загружаем данные в модель
            Task::loadData($task, $_POST);

            // Обраотка изображения, если оно есть
            if (isset($_FILES['image']) && !empty($_FILES['image'])) {
                $file = $_FILES['image'];
                $this->saveImage($file, $task);
            }

            // Сохраняем модель в БД
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

            // Если размеры слишком большие, изменяем их
            if ($image->getWidth() > Task::MAX_WIDTH)
                $image->resizeToWidth(Task::MAX_WIDTH);
            if ($image->getHeight() > Task::MAX_HEIGHT)
                $image->resizeToHeight(Task::MAX_HEIGHT);

            $image->save($file_path);

            $task->image = $file_name;
        }
    }
}