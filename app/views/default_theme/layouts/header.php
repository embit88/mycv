<header class="container">
    <nav class="menu">
        <div class="wrapper-logo">
            <h1><a href="<?= \vfx\App::$request->site_url() . '/' . \vfx\App::$app->getProperty('language_slug') ?>"><?= SITE_NAME ?></a></h1>
        </div>
        <?php if(isset($this->data['categories'])): ?>
            <ul>
                <?php foreach($this->data['categories'] as $category): ?>
                    <li><a href="<?= $category['slug'] ?>"><?= $category['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </nav>
</header>