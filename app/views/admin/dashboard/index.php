<?php

use vfx\Router;

?>
<section class="container">
    <h2 class="text-center">Админ-панель</h2>
    <br>
    <div class="text-center">
        <p><a href="<?= Router::getRouteName('admin.information.index', 'url') ?>">Обо мне</a></p>
        <p><a href="<?= Router::getRouteName('admin.skills.index', 'url') ?>">Навыки</a></p>
        <p><a href="<?= Router::getRouteName('admin.works.index', 'url') ?>">Работа</a></p>
        <p><a href="<?= Router::getRouteName('admin.projects.index', 'url') ?>">Проекты</a></p>
        <p><a href="<?= Router::getRouteName('admin.contacts.index', 'url') ?>">Контакты</a></p>
    </div>
</section>