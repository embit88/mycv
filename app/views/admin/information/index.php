<section class="container">
    <h1 class="text-center">Обо мне</h1>
    <br>
    <div class="text-center">
        <form action="<?= \vfx\Router::getRouteName('admin.information.index', 'url') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Изображение:</p>
                <img width="300" alt="No Image" src="<?= !empty($this->data['information']['image']) ? image($this->data['information']['image']) : '' ?>">
                <br>
                <br>
                <input type="text" name="image" required value="<?= !empty($this->data['information']['image']) ? $this->data['information']['image'] : '' ?>">
            </div>
            <div class="form-group">
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="content-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][content]" required><?= !empty($this->data['information'][$language['id']]['content']) ? $this->data['information'][$language['id']]['content'] : '' ?></textarea>
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