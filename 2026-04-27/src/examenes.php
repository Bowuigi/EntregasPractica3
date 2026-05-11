<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Examen.php';

// Call template
$param_class = Examen::class;
$param_title = 'Exámenes';
$param_names = [
    $param_class::$id_column => 'ID',
    'id_alumno' => 'Alumno',
    'id_materia' => 'Materia',
    'nota' => 'Nota',
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'id_alumno' => 'id_fk',
    'id_materia' => 'id_fk',
    'nota' => 'id_fk',
];
$param_parsers = [
    $param_class::$id_column => 'intval',
    'id_alumno' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El ID del alumno está vacío');
        }
        return intval($val, 10);
    },
    'id_materia' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El ID de la materia está vacío');
        }
        return intval($val, 10);
    },
    'nota' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('La nota está vacía');
        }
        return intval($val, 10);
    },
];
require __DIR__ . '/picoweb/crud.php';
