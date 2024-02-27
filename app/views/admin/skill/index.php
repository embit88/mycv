<section class="container">
    <h1 class="text-center">Навыки</h1>
    <br>
    <div class="text-center">
        <form action="<?= \vfx\Router::getRouteName('admin.skills.index', 'url') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Дата начала:</p>
                <input type="datetime-local" name="date_start" required value="<?= !empty($this->data['skills']['date_start']) ? $this->data['skills']['date_start'] : '' ?>">
            </div>
            <div class="form-group">
                <br>
                <h3>Блок 1:</h3>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="content-first-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][content_first]" required><?= !empty($this->data['skills'][$language['id']]['content_first']) ? $this->data['skills'][$language['id']]['content_first'] : '' ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <br>
                <h3>Блок 2:</h3>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="content-second-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][content_second]" required><?= !empty($this->data['skills'][$language['id']]['content_second']) ? $this->data['skills'][$language['id']]['content_second'] : '' ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <br>
                <h3>Блок 3:</h3>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="content-third-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][content_third]" required><?= !empty($this->data['skills'][$language['id']]['content_third']) ? $this->data['skills'][$language['id']]['content_third'] : '' ?></textarea>
                    </div>
                    <?php include (VIEW_PATH . '/admin/components/ckeditor.php') ?>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</section>