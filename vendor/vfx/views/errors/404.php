<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Error 404 | <?= SITE_NAME ?></title>
</head>
<body>

<main>
    <p><a href="<?= \vfx\App::$request->site_url() . '/' . \vfx\App::$app->getProperty('language_slug') ?>"><?= SITE_NAME ?></a></p>
</main>

</body>
</html>

