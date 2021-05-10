<?php

namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Curtir;

class CurtirControlador extends Controlador
{
    public function armazenar()
    {
        $this->verificarLogado();

        $receita = new Curtir(
            DW3Sessao::get('usuario'),
            $_POST['receita_id'],
        );
        $id = $_POST['receita_id'];
        $usuario = DW3Sessao::get('usuario');

        if ($receita->isValido()) {
            $receita->salvar();
            $this->redirecionar(URL_RAIZ . 'receitas');
        } else {
            $this->visao('receitas/index.php');
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        Curtir::destruir($id);

        $this->redirecionar(URL_RAIZ . 'receitas');
    }
}
