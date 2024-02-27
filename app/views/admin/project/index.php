<section class="container">
    <h1 class="text-center">Проекты</h1>
    <br>
    <div class="text-center">
        <a href="<?= \vfx\Router::getRouteName('admin.projects.add', 'url') ?>">Добавить новый проект</a>
        <br>
        <br>
        <br>
        <?php if (isset($this->data['projects']) && count($this->data['projects']) > 0): ?>
            <?php foreach ($this->data['projects'] as $project): ?>
                <p><a href="/<?= ADMIN_URL ?>/projects/edit/<?= $project['id']  ?>"><?= $project['name'] ?></a></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>