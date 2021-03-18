<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/home' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],

    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],

    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],

    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],

    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],

    '/receitas' => [
        'GET' => '\Controlador\ReceitaControlador#index',
    ],

    '/receitas/criar' => [
        'GET' => '\Controlador\ReceitaControlador#criar',
        'POST' => '\Controlador\ReceitaControlador#armazenar',
    ],

    '/receitas/?' => [
        'PATCH' => '\Controlador\ReceitaControlador#atualizar',
        'DELETE' => '\Controlador\ReceitaControlador#destruir',
    ],

    '/receitas/minhas-receitas' => [
        'GET' => '\Controlador\ReceitaControlador#minhasReceitas',
    ],

    '/receitas/?/editar' => [
        'GET' => '\Controlador\ReceitaControlador#editar',
    ],

    '/relatorios/receita' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],

    '/curtir' => [
        'POST' => '\Controlador\CurtirControlador#armazenar',
        // 'DELETE' => '\Controlador\CurtirControlador#destruir',
    ],

    '/curtir/?' => [
        'DELETE' => '\Controlador\CurtirControlador#destruir',
    ],
];
