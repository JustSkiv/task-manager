<?php
/**
 * Created by Nikolay Tuzov
 */

/** @var array $tasks */
/** @var integer $pagesCount */
/** @var boolean $previous */
/** @var boolean $next */
?>

<div class="panel panel-default">
    <div class="panel-heading">Задачи</div>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя пользователя</th>
            <th>E-mail</th>
            <th>Заголовок</th>
            <th>Изображение</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <th scope="row"><?= $task->id ?></th>
                <td><?= $task->user_name ?></td>
                <td><?= $task->user_email ?></td>
                <td><?= $task->title ?></td>
                <td>
                    <?php if ($task->image): ?>
                        <img src="/images/task/<?= $task->image ?>"/>
                    <?php endif; ?>
                </td>
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