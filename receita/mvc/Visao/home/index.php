<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand text-white text-uppercase font-weight-bold" href="<?= URL_RAIZ . 'home' ?>"><?= APLICACAO_NOME ?></a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

    </ul>
    <a class="btn btn btn-light my-2 my-sm-0" href="<?= URL_RAIZ . 'login' ?>">Login</a>
  </div>
</nav>

<div class="mt-3">
  <img src="<?= URL_IMG . 'teste.png' ?>" alt="">

</div>
<form method="get" class="margin-bottom">
  <div class="container mt-3">
    <div class="row">
      <br>
      <div class="input-group col-5">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Ingrediente</span>
        </div>
        <input type="text" class="form-control " name="ingrediente" value="<?= $this->getGet('ingrediente') ?>" placeholder="ingrediente" style="margin-right: 15%;">
      </div>
      <div class="input-group col-5">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Tempo</span>
        </div>
        <input type="text" class="form-control " name="tempo" value="<?= $this->getGet('tempo') ?>" placeholder="tempo" style="margin-right: 15%;">
      </div>
      <button type="submit" class="btn center-block btn-filter largura100">Filtrar</button>
    </div>
  </div>
</form>

<?php foreach ($registros as $registro) : ?>

  <div class="card text-center mt-3 div-color-recipe" style="margin: 0 18%">
    <div class="card-header card-color-recipe">
      <h5 class="text-uppercase"><?= $registro['nome'] ?></h5>
    </div>
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <p class="fw-bolder text-uppercase text-muted">Ingredientes:</p>
            <?= $registro['ingrediente'] ?>
          </div>
          <div class="col-4">
            <p class="fw-bolder text-uppercase text-muted">Modo de Preparo:</p>
            <?= $registro['preparo'] ?>
          </div>
          <div class="col-3">
            <p class="fw-bolder text-uppercase text-muted">Tempo de Preparo:</p>
            <?= $registro['tempo'] ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-muted footer-color">
      Postada: <?= $registro['data_receita'] ?>
    </div>
  </div>

<?php endforeach ?>



<ul class="pagination justify-content-end mt-2" style="margin-bottom: 5%;">
  <li class="page-item">
    <?php if ($pagina > 1) : ?>
      <a href="<?= URL_RAIZ . 'home?p=' . ($pagina - 1) ?>" class="page-link">P??gina anterior</a>
    <?php endif ?>
  </li>
  <li class="page-item">
    <?php if ($pagina < $ultimaPagina) : ?>
      <a href="<?= URL_RAIZ . 'home?p=' . ($pagina + 1) ?>" class="page-link">Pr??xima p??gina</a>
    <?php endif ?>
  </li>
</ul>