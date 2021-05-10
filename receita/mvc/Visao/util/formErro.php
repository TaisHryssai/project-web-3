<?php if ($this->temErro($campo)) : ?>
    <span class="help-block text-danger" style=""><small><?= $this->getErro($campo) ?></small></span>
<?php endif ?>