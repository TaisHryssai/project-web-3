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

<form method="get" class="margin-bottom">
    <div class="mt-4 mb-5">
        <h1 class="text-uppercase font-weight-bold" for="nome"> Relatorio de Receitas</h1>
    </div>
</form>

<hr>

<table class="table table-condensed table-bordered">
    <tr class="active">
        <th></th>
        <th>Receitas</th>
        <th>Usuarios</th>
    </tr>
    <?php for ($i = 0; $i < count($registros) - 1; $i++) : ?>
        <tr>
            <td></td>
            <td class="text-center"><?= $registros[$i]['nome'] ?></td>
            <td><?= $registros[$i]['usuario'] ?></td>
        </tr>
    <?php endfor ?>
    <tr class="active negrito">
        <td>TOTAL</td>
        <td class="text-center"><?= $receitas ?></td>
        <td class="text-center"><?= $usuarios ?></td>
    </tr>
</table>