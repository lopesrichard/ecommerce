<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="vendor/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="vendor/bootstrap-icons-1.6.1/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/<?= $style ?>.css" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <title>Sua Loja | <?= $title ?></title>
</head>

<body>
    <?php require_once 'header.php' ?>
    <?= $content ?>
    <?php require_once 'footer.php' ?>
    <script src="/vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.js"></script>
    <script src="/js/<?= $script ?>.js"></script>
</body>

</html>