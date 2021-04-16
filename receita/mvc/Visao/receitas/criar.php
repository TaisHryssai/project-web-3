<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-white text-uppercase font-weight-bold" href="<?= URL_RAIZ . 'receitas' ?>"><?= APLICACAO_NOME ?></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        </ul>
        <div class="dropdown mr-3">
            <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opções
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?= URL_RAIZ . 'receitas/minhas-receitas' ?>">Minhas Receitas</a>
                <a class="dropdown-item" href="<?= URL_RAIZ . 'receitas/criar' ?>">Adicionar Receita</a>
                <a class="dropdown-item" href="<?= URL_RAIZ  . 'relatorios/receita' ?>">Relatorio</a>
            </div>
        </div>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post">
            <input type="hidden" name="_metodo" value="DELETE">
            <button type="submit" class="btn btn-outline-light">Sair</button>
        </form>
    </div>
</nav>
<!--fim navbar -->

<div class="container mt-5" style="position: absolute;margin-top: -20px;left: 25%;margin-left: -90px;top: 10%;">
    <div class="col-sm-10 col-sm-offset-3" style="margin-left: auto; margin-right: auto;">
        <h1 class="text-uppercase font-weight-bold">Cadastrar Receitas</h1>
        <form action="<?= URL_RAIZ . 'receitas/criar' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <input type="hidden" class="form-control" id="nome" name="data_receita" value="<?= date_create()->format('Y-m-d H:i:s') ?>">
            </div>
            <div class="form-group row mt-3">
                <label for="nome" class="col-form-label text-muted text-uppercase">Nome da Receita</label>
                <div class="col-sm-5 <?= $this->getErroCss('nome') ?>">
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $this->getPost('nome') ?>">
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                </div>

                <label for="tempo" class="col-form-label text-muted text-uppercase">Tempo de preparo</label>
                <div class="col-sm-2 <?= $this->getErroCss('tempo') ?>">
                    <input type="text" class="form-control" id="tempo" name="tempo" value="<?= $this->getPost('tempo') ?>">
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'tempo']) ?>
                </div>
            </div>

            <div class="form-group row mt-3 <?= $this->getErroCss('ingrediente') ?>">
                <label for="ingrediente" class="col-sm-12 col-form-label text-muted text-uppercase">Ingredientes:</label>
                <textarea class="form-control" id="ingrediente" name="ingrediente"><?= $this->getPost('ingrediente') ?></textarea>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'ingrediente']) ?>
            </div>
            <div class="form-group row mt-3 <?= $this->getErroCss('preparo') ?>">
                <label for="preparo" class="text-muted text-uppercase">Modo de Preparo:</label>
                <textarea class="form-control" id="preparo" name="preparo"><?= $this->getPost('preparo') ?></textarea>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'preparo']) ?>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2">
                    <a href="<?= URL_RAIZ . 'receitas' ?>" class="btn btn-outline-warning">Voltar </a>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-outline-success">Enviar Receita</button>
                </div>
            </div>
        </form>
    </div>
</div>