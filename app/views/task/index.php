<?php
/**
 * Created by Nikolay Tuzov
 */

/** @var array $tasks */
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Panel heading</div>

    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Last Name</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <th scope="row">1</th>
                <td><?= $task->user_name ?></td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>