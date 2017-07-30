<?php
/**
 * Created by Nikolay Tuzov
 */

/** @var array $tasks */
/** @var integer $pagesCount */
/** @var boolean $previous */
/** @var boolean $next */
/** @var string $sort */
?>

<div class="panel panel-default">
    <div class="panel-heading">Задачи</div>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th><a href="/?sort=<?= $sort == 'status' ? '-status' : 'status' ?>">Статус</a></th>
            <th>Заголовок</th>
            <th>Текст</th>
            <th><a href="/?sort=<?= $sort == 'user_name' ? '-user_name' : 'user_name' ?>">Имя пользователя</a></th>
            <th><a href="/?sort=<?= $sort == 'user_email' ? '-user_email' : 'user_email' ?>">E-mail</a></th>
            <th>Изображение</th>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                <th>Действия</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <th scope="row"><?= $task->id ?></th>
                <td><?= $task->status ? 'Выполнена' : 'Не выполнена' ?></td>
                <td><?= $task->title ?></td>
                <td><?= $task->text ?></td>
                <td><?= $task->user_name ?></td>
                <td><?= $task->user_email ?></td>
                <td>
                    <?php if ($task->image): ?>
                        <img src="/images/task/<?= $task->image ?>"/>
                    <?php endif; ?>
                </td>
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                    <th><a href="/task/update?id=<?= $task->id ?>">Редактировать</a></th>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($previous): ?>
            <li>
                <a href="/?page=<?= $previous; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pagesCount; $i++): ?>
            <li><a href="/?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>

        <?php if ($next): ?>
            <li>
                <a href="/?page=<?= $next; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>