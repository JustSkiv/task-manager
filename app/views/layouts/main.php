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

    <script src="/js/vue.min.js"

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Simple Task Manager</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/task/create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Создать
                        задачу</a></li>
                <li><a href="/"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Список задач</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                        <a href="/site/signout">Выйти (администратор)</a>
                    <?php else: ?>
                        <a href="/site/signin">Войти</a>

                    <?php endif; ?>

                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <?= $content ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>