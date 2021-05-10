<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand text-white text-uppercase font-weight-bold" href="<?= URL_RAIZ . '' ?>"><?= APLICACAO_NOME ?></a>
</nav>

<div class="container" style="position: absolute;margin-top: -25px;left: 25%;margin-left: -90px;top: 18%;">
    <div class="col-sm-6 col-sm-offset-3" style="margin-left: auto; margin-right: auto;">
        <h1 class="text-center text-uppercase font-weight-bold">Acessar</h1>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="margin-bottom">
            <div class="form-group">
                <label class="control-label" for="email">E-mail</label>
                <input id="email" name="email" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label" for="senha">Senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>

            <button type="submit" class="btn btn-outline-success center-block mb-4">Entrar</button>
        </form>
        <p class="text-center">
            <a class="btn btn-outline-info" href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
        </p>
        <p class="text-center">
            <a class="btn-outline-warning" href="<?= URL_RAIZ . '' ?>">Voltar</a>
        </p>
    </div>
</div>