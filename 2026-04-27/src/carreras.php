<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Carrera.php';

// Call template
$param_class = Carrera::class;
$param_title = 'Carrera';
$param_names = [
    $param_class::$id_column => 'ID',
    'nombre' => 'Nombre',
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'nombre' => 'text',
];
$param_parsers = [
    $param_class::$id_column => 'intval',
    'nombre' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El nombre está vacío');
        }
        return $val;
    },
];
require __DIR__ . '/picoweb/crud.php';
