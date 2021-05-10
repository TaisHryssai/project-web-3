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

<?php if ($mensagemFlash) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alerts">
        <?= $mensagemFlash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </div>
<?php endif ?>

<div class="mt-3">
    <h1 class="text-uppercase font-weight-bold text-muted">Minhas Receitas</h1>
</div>

<?php foreach ($receitas as $receita) : ?>

    <div class="card mt-3 div-color-recipe" style="margin: 0 18%">
        <div class="card-header card-color-recipe">
            <?= $receita->getNomeReceita() ?>
        </div>
        <div class="card-body">
            <div class="row">
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

        <div class="d-flex justify-content-center">
            <div class="mr-3">
                <a href="<?= URL_RAIZ . 'receitas/' . $receita->getId() . '/editar' ?>" class="card-link btn btn-outline-warning mb-2">Editar</a>
            </div>
            <div>
                <form action="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" method="post" class="inline">
                    <input type="hidden" name="_metodo" value="DELETE">
                    <a href="" class="card-link btn btn-outline-danger" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit();">
                        Deletar </a>
                </form>
            </div>
        </div>
        <div class="card-footer text-muted footer-color">
            Postada: <?= $receita->getDataFormatada() ?> - Usúario <?= $receita->getUsuario()->getEmail() ?>
        </div>
    </div>

<?php endforeach ?>

<ul class="pagination justify-content-end mt-3">
    <li class="page-item">
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'receitas/minhas-receitas?p=' . ($pagina - 1) ?>" class="page-link">Página anterior</a>
        <?php endif ?>
    </li>
    <li class="page-item">
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'receitas/minhas-receitas?p=' . ($pagina + 1) ?>" class="page-link">Próxima página</a>
        <?php endif ?>
    </li>
</ul>