<footer class="container">
    <div class="float-left text-block">2024 - &copy; <a href="<?= \vfx\App::$request->site_url() . '/' . \vfx\App::$app->getProperty('language_slug') ?>"><?= SITE_NAME ?></a></div>
    <?php if (!empty(\vfx\App::$app->getProperty('languages')) && count(\vfx\App::$app->getProperty('languages')) > 0): ?>
        <div class="float-right language-block">
           <?php foreach (\vfx\App::$app->getProperty('languages') as $language): ?>
               <?php if (!empty(\vfx\App::$app->getProperty('locale')) && \vfx\App::$app->getProperty('locale') === $language['locale']): ?>
                   <span class="language-link <?= \vfx\App::$app->getProperty('locale') === $language['locale'] ? 'language-active' : '' ?>">
                       <span class="language-text"><?= $language['code'] ?></span>
                   </span>
               <?php else: ?>
                   <?php if(!empty(\vfx\App::$request->segment(1)) && !empty(\vfx\App::$app->getProperty('route')['slug'])): ?>
                       <a class="language-link" href="<?= \vfx\App::$request->site_url() ?><?= !empty($language['slug']) ? '/' . $language['slug'] . '/' . (strlen(\vfx\App::$request->segment(0)) !== 2 ? \vfx\App::$request->segment(0) : \vfx\App::$request->segment(1)) . '/' . \vfx\App::$app->getProperty('route')['slug'] : '/' . \vfx\App::$request->segment(1) . '/' . \vfx\App::$app->getProperty('route')['slug'] ?>">
                           <span class="language-text"><?= $language['code'] ?></span>
                       </a>
                   <?php else: ?>
                       <a class="language-link" href="<?= \vfx\App::$request->site_url() ?><?= !empty($language['slug']) ? '/' . $language['slug'] : '' ?><?= strlen(\vfx\App::$request->segment(0)) !== 2 ? '/' . \vfx\App::$request->segment(0) : '/' . \vfx\App::$request->segment(1) ?>">
                           <span class="language-text"><?= $language['code'] ?></span>
                       </a>
                   <?php endif; ?>
               <?php endif; ?>
           <?php endforeach; ?>
        </div>
    <?php endif;  ?>
</footer>