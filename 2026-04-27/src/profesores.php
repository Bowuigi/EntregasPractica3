<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Profesor.php';

// Call template
$param_class = Profesor::class;
$param_title = 'Profesores';
$param_names = [
    $param_class::$id_column => 'ID',
    'nombre' => 'Nombre',
    'email' => 'E-mail',
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'nombre' => 'text',
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
    'email' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El email está vacío');
        }

        $filtered = filter_var($val, FILTER_VALIDATE_EMAIL);
        if (!is_string($filtered)) {
            throw new Exception('Fallo al filtrar email');
        }
        return $filtered;
    },
];
require __DIR__ . '/picoweb/crud.php';
