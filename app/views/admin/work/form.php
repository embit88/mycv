<section class="container">
    <h1 class="text-center"><?= isset($this->data['works']['id']) ? "Редактировать работу: id={$this->data['works']['id']}" : 'Добавить работу' ?></h1>
    <br>
    <div class="text-center">
        <form action="<?= isset($this->data['works']['id']) ? "" : \vfx\Router::getRouteName('admin.works.add', 'url') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Начал работать:</p>
                <input required type="text" name="date_start" value="<?= !empty($this->data['works']['date_start']) ? $this->data['works']['date_start'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Закончил работать:</p>
                <input type="text" name="date_end" value="<?= !empty($this->data['works']['date_end']) ? $this->data['works']['date_end'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Сайт:</p>
                <input type="text" name="site_url" value="<?= !empty($this->data['works']['site_url']) ? $this->data['works']['site_url'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Название:</p>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <input type="text" name="description[<?= $language['id'] ?>][name]" required value="<?= !empty($this->data['works'][$language['id']]['name']) ? $this->data['works'][$language['id']]['name'] : '' ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <p>Описание:</p>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" name="description[<?= $language['id'] ?>][content]" required><?= !empty($this->data['works'][$language['id']]['content']) ? $this->data['works'][$language['id']]['content'] : '' ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</section>