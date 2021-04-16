<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-white text-uppercase font-weight-bold" href="#"><?= APLICACAO_NOME ?></a>

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


<div class="container mt-5" style="height: 100%;">
    <h1 class="text-uppercase font-weight-bold text-muted">Editar Receita</h1>
    <form action="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_metodo" value="PATCH">
        <div class="form-group row mt-3 ">
            <label for="tempo" class="col-sm-1 col-form-label text-muted text-uppercase">Data</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" name="data_receita" value="<?= $receita->getDataFormatada() ?>" disabled>
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="nome" class="col-sm-2 col-form-label text-muted text-uppercase">Nome da Receita</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $receita->getNomeReceita() ?>">
            </div>

            <label for="tempo" class="col-sm-2 col-form-label text-muted text-uppercase">Tempo de preparo</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="tempo" name="tempo" value="<?= $receita->getTempo() ?>">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="ingrediente" class="col-sm-12 col-form-label text-muted text-uppercase">Ingredientes:</label>
            <textarea class="form-control" id="ingrediente" name="ingrediente"> <?= $receita->getIngrediente() ?></textarea>
        </div>
        <div class="form-group row mt-3">
            <label for="preparo" class="text-muted text-uppercase">Modo de Preparo:</label>
            <textarea class="form-control" id="preparo" name="preparo"> <?= $receita->getPreparo() ?></textarea>
        </div>
        <div class="form-group <?= $this->getErroCss('foto') ?>">
            <label class="control-label" for="foto">Foto (somente PNG)</label>
            <input id="foto" name="foto" class="form-control" type="file" value="<?= $receita->getImagem() ?>">
        </div>
        <div class="form-group row mt-3 mb-3">
            <div class="col-1">
                <a href="<?= URL_RAIZ . 'receitas/minhas-receitas' ?>" class="btn btn-outline-danger">Voltar </a>
            </div>
            <div class="col-10">
                <button type="submit" class="btn btn-outline-success">Atualizar Receita</button>
            </div>
        </div>
    </form>
</div>