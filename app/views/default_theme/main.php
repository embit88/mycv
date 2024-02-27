<!doctype html>
<html lang="<?= \vfx\App::$app->getProperty('locale') ?>">
<head>
    <title><?= $this->getMeta('title') ?></title>
    <meta name="description" content="<?= $this->getMeta('description') ?>">

    <base href="<?= \vfx\App::$request->site_url() ?>">
    <meta charset="UTF-8">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="<?= image('favicon.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= image('favicon.png') ?>" type="image/x-icon">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= vite('../app/resources/assets/client/default_theme/css/app.css') ?>">
</head>
<body>
<?php require_once (VIEW_PATH . '/default_theme/layouts/header.php') ?>

<main><?= $this->content ?></main>

<?php require_once (VIEW_PATH . '/default_theme/layouts/footer.php') ?>
<script type="module" src="<?= vite('../app/resources/assets/client/default_theme/js/app.js') ?>"></script>
</body>
</html>