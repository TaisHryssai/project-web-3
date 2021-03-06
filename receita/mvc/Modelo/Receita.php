<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Receita extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM receitas WHERE id = ?';
    const INSERIR = 'INSERT INTO receitas(nome, tempo, ingrediente, preparo, data_receita, usuario_id) VALUES (?, ?, ?, ?, ?, ?)';
    const DELETAR = 'DELETE FROM receitas WHERE id = ?';
    const BUSCAR_TODOS = 'SELECT r.nome, r.tempo, r.ingrediente, r.preparo, r.data_receita, r.id r_id, u.email, u.id u_id FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) ORDER BY r.data_receita DESC LIMIT ? OFFSET ?';
    const ATUALIZAR = 'UPDATE receitas SET nome = ?, tempo = ?, ingrediente = ?, preparo = ?, data_receita = ? WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM receitas';
    const BUSCAR = 'SELECT * FROM receitas ORDER BY nome';
    const BUSCA = 'SELECT r.nome, r.tempo, r.ingrediente, r.preparo, r.data_receita, r.id r_id, u.id u_id, u.email FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE TRUE';

    private $id;
    private $nome;
    private $tempo;
    private $ingrediente;
    private $preparo;
    private $dataReceita;
    private $usuarioId;
    private $usuario;

    public function __construct(
        $nome,
        $tempo,
        $ingrediente,
        $preparo,
        $dataReceita,
        $usuarioId,
        $usuario = null,
        $receita = null,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tempo = $tempo;
        $this->ingrediente = $ingrediente;
        $this->preparo = $preparo;
        $this->dataReceita = $dataReceita;
        $this->usuarioId = $usuarioId;
        $this->usuario = $usuario;
        $this->receita = $receita;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReceita()
    {
        return $this->receita;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getNomeReceita()
    {
        return $this->nome;
    }

    public function getTempo()
    {
        return $this->tempo;
    }

    public function getIngrediente()
    {
        return $this->ingrediente;
    }

    public function getPreparo()
    {
        return $this->preparo;
    }

    public function getDataReceita()
    {
        return $this->dataReceita;
    }

    public function getDataFormatada()
    {
        $data = date_create($this->dataReceita);
        return date_format($data, 'd/m/Y');
    }

    public function setDataReceita()
    {
        $this->dataReceita = date('Y-m-d h:i:s');
    }

    public function setNomeReceita($nome)
    {
        return $this->nome = $nome;
    }

    public function setTempo($tempo)
    {
        return $this->tempo = $tempo;
    }

    public function setIngrediente($ingrediente)
    {
        return $this->ingrediente = $ingrediente;
    }

    public function setPreparo($preparo)
    {
        return $this->preparo = $preparo;
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->tempo, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingrediente, PDO::PARAM_STR);
        $comando->bindValue(4, $this->preparo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->dataReceita, PDO::PARAM_STR);
        $comando->bindValue(6, $this->usuarioId, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->tempo, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingrediente, PDO::PARAM_STR);
        $comando->bindValue(4, $this->preparo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->dataReceita, PDO::PARAM_STR);
        $comando->bindValue(6, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Receita(
            $registro['nome'],
            $registro['tempo'],
            $registro['ingrediente'],
            $registro['preparo'],
            $registro['data_receita'],
            $registro['usuario_id'],
            null,
            null,
            $registro['id']
        );
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
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
        }
        return $objetos;
    }

    public static function buscar()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR);
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
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
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    protected function verificarErros()
    {
        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('nome', 'M??nimo 3 caracteres.');
        }
        if (strlen($this->nome) == null) {
            $this->setErroMensagem('nome', 'Campo n??o pode ser vazio');
        }
        if (strlen($this->ingrediente) < 3) {
            $this->setErroMensagem('ingrediente', 'M??nimo 3 caracteres.');
        }
        if (strlen($this->ingrediente) == null) {
            $this->setErroMensagem('ingrediente', 'Campo n??o pode ser vazio');
        }
        if (strlen($this->preparo) < 3) {
            $this->setErroMensagem('preparo', 'M??nimo 3 caracteres.');
        }
        if (strlen($this->preparo) == null) {
            $this->setErroMensagem('preparo', 'Campo n??o pode ser vazio');
        }
        if (strlen($this->tempo) == null) {
            $this->setErroMensagem('tempo', 'Campo n??o pode ser vazio');
        }
        if (strlen($this->tempo) == null) {
            $this->setErroMensagem('tempo', 'Campo n??o pode ser vazio');
        }
    }

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('receitaId', $filtro) && $filtro['receitaId'] != '') {
            $parametros[] = $filtro['receitaId'];
            $sqlWhere .= ' AND r.id = ?';
        }
        if (array_key_exists('ingrediente', $filtro) && $filtro['ingrediente'] != '') {
            $parametros[] = $filtro['ingrediente'];
            $sqlWhere .= ' AND r.ingrediente = ?';
        }

        if (array_key_exists('tempo', $filtro) && $filtro['tempo'] != '') {
            $parametros[] = $filtro['tempo'];
            $sqlWhere .= ' AND r.tempo = ?';
        }

        $sql = self::BUSCA . $sqlWhere . ' ORDER BY r.nome';
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i + 1, $parametro, PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        return $registros;
    }
}
