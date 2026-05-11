<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Usuario.php';

// Call template
$param_class = Usuario::class;
$param_title = 'Mateo Crimella - Práctica 3';
$param_parsers = [
    $param_class::$id_column => 'intval',
    'nombre' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El nombre está vacío');
        }
        return $val;
    },
    'contrasena' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('La contraseña está vacía');
        }

        $hash = password_hash($val, PASSWORD_DEFAULT);
        if (!is_string($hash)) {
            throw new Exception('Fallo al realizar el hash a la contraseña');
        }
        return $hash;
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
