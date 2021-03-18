<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteReceita extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('teste@example.com', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $receita = new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', 1);
        $receita->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM receitas WHERE id = " . $receita->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['nome'] === $receita->getNomeReceita());
    }

    public function testeBuscarTodos()
    {
        (new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuarioId))->salvar();
        (new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuarioId))->salvar();
        $mensagens = Receita::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeContarTodos()
    {
        (new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuarioId))->salvar();
        (new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuarioId))->salvar();
        $total = Receita::contarTodos();
        $this->verificar($total == 2);
    }

    public function testeDestruir()
    {
        $mensagem = new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuarioId);
        $mensagem->salvar();
        Receita::destruir($mensagem->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
