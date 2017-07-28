<?php
/**
 * Created by Nikolay Tuzov
 */
?>

<div class="container">
    <?php foreach ($windows as $window): ?>

        <div class="panel panel-default">
            <div class="panel-heading"><?= $window['title']; ?></div>
            <div class="panel-body">
                <?= $window['id']; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>