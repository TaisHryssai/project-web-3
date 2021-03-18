<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APLICACAO_NOME ?></title>

    <link rel="shortcut icon" href="<?= URL_IMG . 'icon.png' ?>" type="image/x-icon">
    <!-- <script src="https://kit.fontawesome.com/826671e166.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">

    <!-- Estilo Página -->
    <link rel="stylesheet" href="<?= URL_CSS . 'style.css' ?>">

    <!-- JS Bootstrap -->
    <script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>

    <!-- JS Página -->
    <script src="<?= URL_JS . 'index.js' ?>"></script>
</head>

<body class="text-center">

    <?php $this->imprimirConteudo() ?>

    <!--footer -->
    <div class="card py-2 cardFooter">
        <blockquote class="blockquote text-center">
            <p class="mb-0 text-white">Tem Tudo .</p>
            <footer class="blockquote-footer text-white">© 2021 Desenvolvimento em Web 3
                <a class="indigo-text text-white" href="http://portal.utfpr.edu.br/">UTFPR</a>
            </footer>
        </blockquote>
    </div>
</body>

</html>