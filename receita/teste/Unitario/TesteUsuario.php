<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    public function testeInserir()
    {
        $usuario = new Usuario('teste@example.com', 'senha');
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE email = 'teste@example.com'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
    }

    public function testeBuscarEmail()
    {
        $usuario = new Usuario('teste@example.com', 'senha');
        $usuario->salvar();
        $usuario = Usuario::buscarEmail('teste@example.com');
        $this->verificar($usuario !== false);
    }
}
