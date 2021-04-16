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

    protected function verificarCurtida($usuarioId, $receitaId)
    {
        $curtir = Curtir::curtiu($usuarioId, $receitaId);

        if (Curtir::curtiu($usuarioId, $receitaId) == null) {
            $this->redirecionar(URL_RAIZ . 'receitas');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'ja curtiu');
            $this->redirecionar(URL_RAIZ . 'receitas');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
            $usuario = DW3Sessao::get('usuario');
            // if ($usuarioId == null) {
            //     return null;
            // }
            // $this->usuario = Usuario::buscarId($usuarioId);
        }
        return $usuario;
    }
}
