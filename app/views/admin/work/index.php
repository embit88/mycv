<section class="container">
    <h1 class="text-center">Работа</h1>
    <br>
    <div class="text-center">
        <a href="<?= \vfx\Router::getRouteName('admin.works.add', 'url') ?>">Добавить работу</a>
        <br>
        <br>
        <br>
        <?php if (isset($this->data['works']) && count($this->data['works']) > 0): ?>
            <?php foreach ($this->data['works'] as $work): ?>
                <p><a href="/<?= ADMIN_URL ?>/works/edit/<?= $work['id']  ?>"><?= $work['name'] ?></a></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>