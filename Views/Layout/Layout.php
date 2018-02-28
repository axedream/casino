<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Рулетка</title>
    </head>
    <body>
    <style type="text/css">
        .basic {
            margin: 20px 20px;
        }
    </style>

    <div class="basic">
        <a href="<?= App::$params['basic_url'] ?>/home/index">Главная</a>
    </div>

    <div class="basic">
        <?= $content ?>
    </div>
    </body>
</html>