<?php

namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Curtir;
use Modelo\Receita;

class HomeControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 2;
        $offset = ($pagina - 1) * $limit;
        $receitas = Receita::buscarTodos($limit, $offset);

        $registros = Receita::buscarRegistros($_GET);

        $ultimaPagina = ceil(Receita::contarTodos() / $limit);
        return compact('pagina', 'receitas', 'ultimaPagina', 'registros');
    }

    public function index()
    {
        $paginacao = $this->calcularPaginacao();
        $this->visao('home/index.php', [
            'registros' => $paginacao['registros'],
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
        ]);
    }
}
