<?php

namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Curtir;
use Modelo\Receita;

class RaizControlador extends Controlador
{
    public function index()
    {
        $this->redirecionar(URL_RAIZ . 'home');
        $this->visao('home/index.php');
    }
}
