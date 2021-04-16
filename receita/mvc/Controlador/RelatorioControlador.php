<?php

namespace Controlador;

use Modelo\Receita;
use Modelo\RelatorioReceita;
use Modelo\Usuario;

class RelatorioControlador extends Controlador
{
    // public function index()
    // {
    //     $this->visao('relatorios/receita.php', [
    //         'receitas' => Receita::buscarTodos(),
    //         'registros' => RelatorioReceita::buscarRegistros($_GET)
    //     ]);
    // }

    public function index()
    {
        $this->visao('relatorios/receita.php', [
            'receitas' => Receita::contarTodos(),
            'usuarios' => Usuario::contarTodos(),
            'receita' => Receita::buscar(),
            // 'receita' => Receita::buscarTodos(),
            'usuario' => Usuario::buscarTodos(),
            'registros' => RelatorioReceita::buscarRegistros($_GET)
        ]);
    }
}
