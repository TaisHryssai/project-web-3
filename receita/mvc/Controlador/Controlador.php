<?php

namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Curtir;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;

    protected $usuario;

    protected function verificarLogado()
    {
        $usuario = $this->getUsuario();
        if ($usuario == null) {
            $this->redirecionar(URL_RAIZ . 'home');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
            $usuario = DW3Sessao::get('usuario');
        }
        return $usuario;
    }
}
