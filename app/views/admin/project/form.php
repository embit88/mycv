<section class="container">
    <h1 class="text-center"><?= isset($this->data['projects']['id']) ? "Редактировать проект: id={$this->data['projects']['id']}" : 'Добавить проект' ?></h1>
    <br>
    <div class="text-center">
        <form action="<?= isset($this->data['projects']['id']) ? "" : \vfx\Router::getRouteName('admin.projects.add', 'url') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Изображение:</p>
                <img width="300" alt="No Image" src="<?= !empty($this->data['projects']['image']) ? image($this->data['projects']['image']) : image('no_image.png') ?>">
                <br>
                <br>
                <input type="text" name="image" required value="<?= !empty($this->data['projects']['image']) ? $this->data['projects']['image'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Ссылка:</p>
                <input type="text" name="slug" required value="<?= !empty($this->data['projects']['slug']) ? $this->data['projects']['slug'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Ссылка на проект:</p>
                <input type="text" name="site_url" value="<?= !empty($this->data['projects']['site_url']) ? $this->data['projects']['site_url'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Порядок сортировки:</p>
                <input type="number" name="sort_order" min="0" max="999999" value="<?= !empty($this->data['projects']['sort_order']) ? $this->data['projects']['sort_order'] : 0 ?>">
            </div>
            <div class="form-group">
                <p>Название:</p>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <input type="text" name="description[<?= $language['id'] ?>][name]" required value="<?= !empty($this->data['projects'][$language['id']]['name']) ? $this->data['projects'][$language['id']]['name'] : '' ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <p>Короткое описание:</p>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="short-content-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][short_content]"><?= !empty($this->data['projects'][$language['id']]['short_content']) ? $this->data['projects'][$language['id']]['short_content'] : '' ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <p>Описание:</p>
                <?php foreach (\vfx\App::$app->getProperty('languages') as $index => $language): ?>
                    <div class="input-group">
                        <p><?= $language['title'] ?>:</p>
                        <textarea rows="15" cols="100" id="content-<?= $language['id'] ?>" name="description[<?= $language['id'] ?>][content]" required><?= !empty($this->data['projects'][$language['id']]['content']) ? $this->data['projects'][$language['id']]['content'] : '' ?></textarea>
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