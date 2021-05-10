<?php

namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Curtir;
use \Modelo\Receita;

class ReceitaControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $receitas = Receita::buscarTodos($limit, $offset);
        $curtidas = Curtir::buscarTodos();

        $ultimaPagina = ceil(Receita::contarTodos() / $limit);
        return compact('pagina', 'receitas', 'curtidas', 'ultimaPagina');
    }

    public function minhasReceitas()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();

        $this->visao('receitas/minhasReceitas.php', [
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();

        $this->visao('receitas/index.php', [
            'receitas' => $paginacao['receitas'],
            'registros' => Receita::buscarRegistros($_GET),
            'curtidas' => $paginacao['curtidas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('receitas/criar.php', [
            'receitas' => Receita::buscarTodos(),
            'sucesso' =>  DW3Sessao::setFlash('mensagemFlash', 'Receita Adicionada com sucesso.')

        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();

        $receita = new Receita(
            $_POST['nome'],
            $_POST['tempo'],
            $_POST['ingrediente'],
            $_POST['preparo'],
            $_POST['data_receita'],
            DW3Sessao::get('usuario'),
        );

        if ($receita->isValido()) {
            $receita->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Receita cadastrada com sucesso');
            $this->redirecionar(URL_RAIZ . 'receitas');
        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($receita->getValidacaoErros());
            $this->visao('receitas/criar.php', [
                'receitas' => $paginacao['receitas'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);

        if ($receita->getUsuarioId() == $this->getUsuario()) {
            $this->visao('receitas/editar.php', [
                'receita' => $receita
            ]);
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode editar as receitas dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'receitas');
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        $receita->setNomeReceita($_POST['nome']);
        $receita->setTempo($_POST['tempo']);
        $receita->setIngrediente($_POST['ingrediente']);
        $receita->setPreparo($_POST['preparo']);
        $receita->salvar();
        DW3Sessao::setFlash('mensagemFlash', 'Receita Atualizada com sucesso.');
        $this->redirecionar(URL_RAIZ . 'receitas');
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);

        if ($receita->getUsuarioId() == $this->getUsuario()) {
            Receita::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Receita destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as receitas dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'receitas');
    }
}
