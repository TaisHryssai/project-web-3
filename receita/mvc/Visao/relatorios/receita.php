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

<div>
    <h2 class="text-uppercase font-weight-bold mb-5 mt-4">
        Relatorio de Receitas
    </h2>
</div>

<form method="get" class="margin-bottom">
    <div class="form-group">
        <label class="control-label" for="usuarioId">Pesquisar receitas pelo usuário</label>
        <select id="usuarioId" name="usuarioId" class="form-control" autofocus>
            <option value="">---</option>
            <?php foreach ($usuario as $usuario) : ?>
                <?php $selected = $this->getGet('usuarioId') == $usuario->getId() ? 'selected' : '' ?>
                <option value="<?= $usuario->getId() ?>" <?= $selected ?>><?= $usuario->getEmail() ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>
</form>

<hr>

<div>
    <h4 class="text-uppercase"> O sistema tem no Total:
        <span class="font-weight-bold"> <?= $receitas ?> </span> receitas cadastradas e <span class="font-weight-bold"> <?= $usuarios ?> </span> usuários
    </h4>
    <span>Receitas cadastradas:</span>
</div>

<table class="table table-condensed table-bordered">
    <tr class="active">
        <th>Nome da Receita</th>
    </tr>
    <?php for ($i = 0; $i < count($registros) - 1; $i++) : ?>
        <tr>
            <td class="text-center font-italic"><?= $registros[$i]['nome'] ?></td>
        </tr>
    <?php endfor ?>

</table>