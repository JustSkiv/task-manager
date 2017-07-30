<?php
/**
 * created by: Nikolay Tuzov
 */ ?>

<link href="/css/signin.css" rel="stylesheet">

<div class="container">
    <form method="post" action="" class="form-signin">
        <h2 class="form-signin-heading">Авторизация</h2>
        <label for="inputEmail" class="sr-only">Логин</label>
        <input name="login" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
</div>