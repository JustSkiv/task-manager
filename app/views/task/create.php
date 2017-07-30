<?php
/**
 * Created by Nikolay Tuzov
 */ ?>

<div class="container" id="form" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-5">
                <label for="ex3">Заголовок</label>
                <input name="title" class="form-control" id="title" placeholder="Заголовок задачи" v-model="title"
                       required>
                <div id="errorTitle"></div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-2">
                <label for="ex1">Имя</label>
                <input name="user_name" class="form-control" id="userName" placeholder="Имя пользователя"
                       v-model="userName"
                       required>
                <div id="errorName"></div>
            </div>
            <div class="col-xs-3">
                <label for="ex2">E-mail</label>
                <input name="user_email" type="email" class="form-control" id="userEmail"
                       placeholder="E-mail пользователя"
                       v-model="userEmail" required>
                <div id="errorEmail"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="comment">Текст:</label>
            <textarea name="text" class="form-control" rows="5" id="text" placeholder="Текст задачи"
                      v-model="text"></textarea>
        </div>

        <div id="image-preview-div" style="display: none;">
            <label for="exampleInputFile">Selected image:</label>
        </div>
        <div class="form-group">
            <input type="file" name="image" id="file">
        </div>
        <button class="btn btn-success">Создать</button>

        <button class="btn btn-primary" v-on:click.prevent="tooglePreview">{{ buttonText }}</button>
    </form>

    <br/>

    <div class="panel panel-default" v-show="showPreview">
            <div class="panel-heading">{{ buttonText }}</div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя пользователя</th>
                <th>E-mail</th>
                <th>Заголовок</th>
                <th>Текст</th>
                <th>Изображение</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"></th>
                <td>{{ userName }}</td>
                <td>{{ userEmail }}</td>
                <td>{{ title }}</td>
                <td>{{ text }}</td>
                <td>
                    <img id="preview-img" v-bind:src="imageLink" style="max-width: 320px;max-height: 240px;"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<script>

    formApp = new Vue({
        el: '#form',
        data: {
            title: '',
            userName: '',
            userEmail: '',
            text: '',
            imageLink: '',
            showPreview: false,
            buttonText: 'Предварительный просмотр'
        },
        methods: {
            tooglePreview: function () {
                if ((this.title && this.userName && this.userEmail) || this.showPreview) {
                    this.showPreview = !this.showPreview;

                    this.buttonText = this.showPreview ? 'Скрыть предварительный просмотр' : 'Предварительный просмотр';
                } else {
                    if (!this.title) {
                        title.className = 'form-control error';
                        errorTitle.innerHTML = 'Вы не указали заголовок';
                        title.focus();
                    }

                    if (!this.userName) {
                        userName.className = 'form-control error';
                        errorName.innerHTML = 'Вы не указали имя';
                        userName.focus();
                    }

                    if (!this.userEmail) {
                        userEmail.className = 'form-control error';
                        errorEmail.innerHTML = 'Вы не указали E-mail';
                        userEmail.focus();
                    }
                }
            }
        }
    });


    title.oninput = function() {
        if (title.className == 'form-control error') {
            title.className = "form-control";
            errorTitle.innerHTML = "";
        }
    };

    userName.oninput = function() {
        if (userName.className == 'form-control error') {
            userName.className = "form-control";
            errorName.innerHTML = "";
        }
    };

    userEmail.oninput = function() {
        if (userEmail.className == 'form-control error') {
            userEmail.className = "form-control";
            errorEmail.innerHTML = "";
        }
    };
</script>