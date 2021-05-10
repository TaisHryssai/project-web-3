<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Curtir extends Modelo
{
    const INSERIR = 'INSERT INTO curtidas(usuario_id,receita_id) VALUES (?, ?)';

    const BUSCAR_TODOS = 'SELECT c.id c_id, u.email, u.id u_id, r.nome, r.tempo, r.ingrediente, r.preparo, r.data_receita, r.id r_id FROM curtidas c JOIN usuarios u ON (c.usuario_id = u.id) JOIN receitas r ON (c.receita_id = r.id) LIMIT 1';

    const BUSCAR_ID = 'SELECT * FROM curtidas WHERE id = ?';

    const DELETAR = 'DELETE FROM curtidas WHERE id = ?';

    const CONTAR_TODOS = 'SELECT count(id) FROM curtidas';

    const CONTAR_CURTIDAS = 'SELECT count(id) FROM curtidas WHERE receita_id = ?';

    const BUSCAR = 'SELECT c.id c_id, r.nome, r.tempo, r.ingrediente, r.preparo, r.data_receita, r.id r_id FROM curtidas c JOIN receitas r ON (c.receita_id = r.id) ';

    private $id;
    private $usuarioId;
    private $receitaId;
    private $usuario;
    private $receita;

    public function __construct(
        $usuarioId,
        $receitaId,
        $usuario = null,
        $receita = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->receitaId = $receitaId;
        $this->usuario = $usuario;
        $this->receita = $receita;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getReceita()
    {
        return $this->receita;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getReceitaId()
    {
        return $this->receitaId;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_STR);
        $comando->bindValue(2, $this->receitaId, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                $registro['u_id']
            );
            $receita = new Receita(
                $registro['nome'],
                $registro['tempo'],
                $registro['ingrediente'],
                $registro['preparo'],
                $registro['data_receita'],
                $registro['u_id'],
                $usuario,
                null,
                $registro['r_id']
            );

            $objetos[] = new Curtir(
                $registro['usuario_id'],
                $registro['receita_id'],
                $usuario,
                $receita,
                $registro['c_id']
            );
        }
        return $objetos;
    }


    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Curtir(
            $registro['usuario_id'],
            $registro['receita_id'],
            null,
            $registro['id']
        );
    }

    public static function contarCurtidas($receitaId)
    {
        $comando = DW3BancoDeDados::prepare(self::CONTAR_CURTIDAS);
        $comando->bindValue(1, $receitaId, PDO::PARAM_INT);
        $comando->execute();
        $total = $comando->fetch();
        return intval($total[0]);
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }
}
