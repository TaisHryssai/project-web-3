<?php

namespace Controlador;

use Modelo\Receita;
use Modelo\RelatorioReceita;
use Modelo\Usuario;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorios/receita.php', [
            'receitas' => Receita::contarTodos(),
            'usuarios' => Usuario::contarTodos(),
            'usuario' => Usuario::buscarTodos(),
            'registros' => RelatorioReceita::buscarRegistros($_GET)
        ]);
    }
}
