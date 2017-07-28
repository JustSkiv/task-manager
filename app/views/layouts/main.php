<?php
/**
 * Created by Nikolay Tuzov
 */

/**
 * @var string $content
 * @var string $pageTitle
 * */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($pageTitle) ? $pageTitle : 'Main title' ?></title>

    <?php if (isset($meta['keywords'])): ?>
        <meta name="keywords" content="<?= $meta['keywords'] ?>">
    <?php endif; ?>
    <?php if (isset($meta['description'])): ?>
        <meta name="description" content="<?= $meta['description'] ?>">
    <?php endif; ?>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="page-header">
    <h1>Simple Task Manager
        <small>Список задач</small>
    </h1>
</div>

<div class="container">
    <?php if (!empty($menu)): ?>
        <ul class="nav nav-tabs">
            <?php foreach ($menu as $item): ?>
                <li><a href="category/<?= $item->id ?>"><?= $item->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?= $content ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>