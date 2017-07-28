<?php
/**
 * Created by Nikolay Tuzov
 */ ?>

<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-5">
                <label for="ex3">Заголовок</label>
                <input name="title" class="form-control" id="ex3" placeholder="Заголовок задачи" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-2">
                <label for="ex1">Имя</label>
                <input name="user_name" class="form-control" id="ex1" placeholder="Имя пользователя" required>
            </div>
            <div class="col-xs-3">
                <label for="ex2">E-mail</label>
                <input name="user_email" type="email" class="form-control" id="ex2" placeholder="E-mail пользователя"
                       required>
            </div>
        </div>

        <div class="form-group">
            <label for="comment">Текст:</label>
            <textarea name="text" class="form-control" rows="5" id="comment" placeholder="Текст задачи"></textarea>
        </div>

        <div id="image-preview-div" style="display: none;">
            <label for="exampleInputFile">Selected image:</label>
            <br>
            <img id="preview-img" src="noimage" style="max-width: 320px;max-height: 240px;">
        </div>
        <div class="form-group">
            <input type="file" name="image" id="file" required>
        </div>
        <button class="btn btn-default">Создать</button>
    </form>
</div>