<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white text-uppercase font-weight-bold" href="#"><?= APLICACAO_NOME ?></a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>
    <!-- retirar esse botao -->
    <a class="btn btn btn-light my-2 my-sm-0" href="<?= URL_RAIZ . 'login' ?>">Login</a>
  </div>
</nav>

<div class="container" style="position: absolute;margin-top: -25px;left: 25%;margin-left: -90px;top: 18%;">
  <div class="col-sm-6 col-sm-offset-3" style="margin-left: auto; margin-right: auto;">

    <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom mt-5">

      <h1 class="text-center text-uppercase font-weight-bold">Registre-se</h1>

      <label for="email" class="mb-2 mt-2 control-label">Email *</label>
      <div class="form-group <?= $this->getErroCss('senha') ?>">
        <input id="email" name="email" type="email" class="form-control" require>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
      </div>
      <label for="senha" class="mb-2 mt-2 control-label">Senha *</label>
      <div class="form-group <?= $this->getErroCss('senha') ?>">
        <input type="password" id="senha" name="senha" class="form-control" require>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
      </div>

      <button class="btn btn-outline-success mt-3 mb-3" type="submit">Cadastrar</button>
    </form>
    <span class=""><a href="<?= URL_RAIZ . 'login' ?>">Voltar para a tela de Login</a></span>

  </div>
</div>