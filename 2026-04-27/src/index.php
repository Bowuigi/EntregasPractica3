<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Usuario.php';

// Call template
$param_class = Usuario::class;
$param_title = 'Mateo Crimella - Práctica 3';
$param_names = [
    $param_class::$id_column => 'ID',
    'nombre' => 'Nombre',
    'contrasena' => 'Contraseña',
    'email' => 'E-mail',
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'nombre' => 'text',
    'contrasena' => 'password',
    'email' => 'email',
];
$param_parsers = [
    $param_class::$id_column => 'intval',
    'nombre' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El nombre está vacío');
        }
        return $val;
    },
    // This would obviously be hashed
    'contrasena' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('La contraseña está vacía');
        }
        return $val;
    },
    'email' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El email está vacío');
        }

        $filtered = filter_var($val, FILTER_VALIDATE_EMAIL);
        if (!is_string($filtered)) {
            throw new Exception('Fallo al filtrar email');
        }
        return $filtered;
    }
];
require __DIR__ . '/picoweb/crud.php';
