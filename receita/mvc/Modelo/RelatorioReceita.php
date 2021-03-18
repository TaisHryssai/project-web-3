<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class RelatorioReceita
{
    const BUSCAR_TODOS = 'SELECT u.email as usuario, r.nome, r.tempo, r.ingrediente, r.preparo, r.data_receita FROM receitas r JOIN usuarios u ON (u.id = r.usuario_id) WHERE TRUE';

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('usuarioId', $filtro) && $filtro['usuarioId'] != '') {
            $parametros[] = $filtro['usuarioId'];
            $sqlWhere .= ' AND u.id = ?';
        }
        if (array_key_exists('nome', $filtro) && $filtro['nome'] != '') {
            $parametros[] = $filtro['nome'];
            $sqlWhere .= ' AND r.nome = ?';
        }

        $sql = self::BUSCAR_TODOS . $sqlWhere . ' ORDER BY r.nome';
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i + 1, $parametro, PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        $totalPreco = 0;
        $totalQuantidade = 0;
        foreach ($registros as $registro) {
            $totalQuantidade += $registro['nome'];
            $totalPreco += $registro['usuarioId'];
        }
        $registros[] = [
            'nome' => $totalQuantidade,
            'usuarioId' => $totalPreco
        ];
        return $registros;
    }
}
