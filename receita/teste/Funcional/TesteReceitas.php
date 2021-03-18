<?php

namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;
use Modelo\Receita;

class TesteReceitas extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'home');
        $this->verificarContem($resposta, 'Receitas');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuario->getId()))->salvar();
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Receitas');
        $this->verificarContem($resposta, 'pao');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'receitas/criar', [
            'nome' => 'pao',
            'tempo' => '2 horas',
            'ingrediente' => 'agua, trigo',
            'preparo' => 'mistura tudo',
            'data_receita' => '2021-05-01',
            'usuario_id' =>  $this->usuario->getId(),
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

    public function testeDestruir()
    {
        $this->logar();
        $mensagem = new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuario->getId());
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'receitas/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao === false);
    }

    public function testeEditar()
    {
        $this->logar();
        $receita = new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuario->getId());
        $receita->salvar();
        $resposta = $this->get(URL_RAIZ . 'receitas/' . $receita->getId() . '/editar');
        $this->verificarContem($resposta, 'Editar Receita');
        $this->verificarContem($resposta, $receita->getNomeReceita());
        $this->verificarContem($resposta, $receita->getTempo());
        $this->verificarContem($resposta, $receita->getIngrediente());
        $this->verificarContem($resposta, $receita->getPreparo());
        $this->verificarContem($resposta, $receita->getDataFormatada());
    }


    public function testeAtualizar()
    {
        $this->logar();
        $receita = new Receita('pao', '2 horas', 'agua, trigo', 'mistura tudo', '2021-05-01', $this->usuario->getId());
        $receita->salvar();
        $resposta = $this->patch(URL_RAIZ . 'receitas/' . $receita->getId(), [
            'nome' => 'pao doce',
            'tempo' => '2 horas',
            'ingrediente' => 'agua, trigo, acucar',
            'preparo' => 'mistura tudo',
            'data_receita' => '2021-05-02',

        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'pao doce');
        $this->verificarContem($resposta, '2 horas');
        $this->verificarContem($resposta, 'agua, trigo, acucar');
        $this->verificarContem($resposta, 'mistura tudo');
    }
}
