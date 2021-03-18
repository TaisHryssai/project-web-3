<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-white text-uppercase font-weight-bold" href="<?= URL_RAIZ . 'receitas' ?>"><?= APLICACAO_NOME ?></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        </ul>
        <div class="dropdown mr-2">
            <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Minhas Receitas
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

<?php

use Modelo\Curtir;

if ($mensagemFlash) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $mensagemFlash ?>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
<?php endif ?>

<div class="mt-3">
    <h1 class="text-uppercase font-weight-bold text-muted">Receitas</h1>
</div>

<form method="get" class="margin-bottom">
    <div class="container">
        <div class="row mt-5">
            <br>
            <div class="input-group col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Ingrediente</span>
                </div>
                <input type="text" class="form-control " name="ingrediente" value="<?= $this->getGet('ingrediente') ?>" placeholder="ingrediente" style="margin-right: 15%;">
            </div>
            <div class="input-group col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Tempo</span>
                </div>
                <input type="text" class="form-control " name="tempo" value="<?= $this->getGet('tempo') ?>" placeholder="tempo" style="margin-right: 15%;">
            </div>
            <div class="input-group col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Ordenar</span>
                </div>
                <select id="receitaId" name="receitaId" class="form-control">
                    <option value="">---</option>
                    <?php foreach ($receitas as $produto) : ?>
                        <?php $selected = $this->getGet('receitaId') == $produto->getId() ? 'selected' : '' ?>
                        <option value="<?= $produto->getId() ?>" <?= $selected ?>><?= $produto->getTempo() ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn center-block btn-filter largura100">Filtrar</button>
        </div>
    </div>
</form>

<?php foreach ($receitas as $receita) : ?>
    <div class="card mt-3 div-color-recipe" style="margin: 0 18%">
        <div class="card-header card-color-recipe">
            <?= $receita->getNomeReceita() ?> - <?= Curtir::contarCurtidas($receita->getId()) ?> Curtidas

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-2">
                    <img src="<?= URL_IMG . $receita->getImagem() ?>" alt="foto receita" class="imagem-receita pull-center">
                </div>
                <div class="col col-4">
                    <p class="fw-bolder text-uppercase text-muted">Ingredientes:</p>
                    <?= $receita->getIngrediente() ?>
                </div>
                <div class="col col-4">
                    <p class="fw-bolder text-uppercase text-muted">Modo de Preparo:</p>
                    <?= $receita->getPreparo() ?>
                </div>
                <div class="col col-2">
                    <p class="fw-bolder text-uppercase text-muted">Tempo de Preparo:</p>
                    <?= $receita->getTempo() ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted footer-color">
            Postada: <?= $receita->getDataFormatada() ?>
        </div>
        <div class="card-footer row footer-color">
            <?php if (Curtir::contarCurtidas($receita->getId()) == null) : ?>

                <div class="col col-5">
                    <form action="<?= URL_RAIZ . 'curtir' ?>" method="post" class="form-curtir">
                        <input type="hidden" name="receita_id" value="<?= $receita->getId() ?>">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-thumbs-up"></i> </button>
                    </form>
                </div>
            <?php endif ?>

            <?php if (Curtir::contarCurtidas($receita->getId())) : ?>

                <div class="col col-6">
                    <form action="<?= URL_RAIZ . 'curtir/' . $receita->getId() ?>" method="post">
                        <input type="hidden" name="_metodo" value="DELETE">
                        <button class="btn btn-danger" type="submit"><i class="fa fa-thumbs-down"></i></button>
                    </form>
                </div>
            <?php endif ?>

        </div>
    </div>

<?php endforeach ?>






<ul class="pagination justify-content-end mt-2" style="margin-bottom: 5%;">
    <li class="page-item">
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'receitas?p=' . ($pagina - 1) ?>" class="page-link">Página anterior</a>
        <?php endif ?>
    </li>
    <li class="page-item">
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'receitas?p=' . ($pagina + 1) ?>" class="page-link">Próxima página</a>
        <?php endif ?>
    </li>
</ul>