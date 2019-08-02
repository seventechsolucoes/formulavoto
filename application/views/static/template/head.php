<!DOCTYPE html>
<html>
    <head data-info="<?= base_url() ?>">
        <title><?= !empty($title) ? $title : "Fórmula do voto" ?></title>
        <link href="<?= base_url("public/app/img/sistema/favicon.png") ?>" rel="shortcut icon">
        <link href="<?= ROOT . "/node_modules/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
        <link href="<?= ROOT . "/node_modules/sweetalert2/dist/sweetalert2.min.css" ?>" rel="stylesheet">
        <link href="<?= ROOT . "/node_modules/@fortawesome/fontawesome-free/css/all.min.css" ?>" rel="stylesheet">
        <link href="<?= ROOT . "/node_modules/izitoast/dist/css/iziToast.min.css" ?>" rel="stylesheet">
        <link href="<?= base_url("public/app/css/style.css") ?>" rel="stylesheet">

        <?php if (!empty($styles)): ?>
            <?php foreach ($styles as $style) : ?>
                <link href="<?= $style ?>" rel="stylesheet">
            <?php endforeach; ?>
        <?php endif; ?>

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">

        <script src="<?= ROOT . "/node_modules/jquery/dist/jquery.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/axios/dist/axios.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/jquery-validation/dist/jquery.validate.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/jquery-validation/dist/additional-methods.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/sweetalert2/dist/sweetalert2.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/jquery-mask-plugin/dist/jquery.mask.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/izitoast/dist/js/iziToast.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/moment/min/moment.min.js" ?>"></script>
        <script src="<?= ROOT . "/node_modules/jquery-countdown/dist/jquery.countdown.min.js" ?>"></script>

        <?php if (!empty($scripts)): ?>
            <?php foreach ($scripts as $script) : ?>
                <script src="<?= $script ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>