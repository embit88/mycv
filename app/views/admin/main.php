<!doctype html>
<html lang="<?= \vfx\App::$app->getProperty('locale') ?>">
<head>
    <title><?= $this->getMeta('title') ?></title>
    <meta name="description" content="<?= $this->getMeta('description') ?>">

    <base href="<?= \vfx\App::$request->site_url() ?>">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= vite('../app/resources/assets/admin/css/app.css') ?>">
</head>
<body>

<main><?= $this->content ?></main>

<script type="module" src="<?= vite('../app/resources/assets/admin/js/app.js') ?>"></script>
</body>
</html>