<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Materia.php';

// Call template
$param_class = Materia::class;
$param_title = 'Materias';
$param_names = [
    $param_class::$id_column => 'ID',
    'nombre' => 'Nombre',
    'curso' => 'Curso',
    'id_profesor' => 'Profesor',
    'id_carrera' => 'Carrera',
    'nota_aprobacion' => 'Nota de aprobación'
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'nombre' => 'text',
    'curso' => 'number',
    'id_profesor' => 'id_fk',
    'id_carrera' => 'id_fk',
    'nota_aprobacion' => 'id_fk',
];
$param_parsers = [
    $param_class::$id_column => 'intval',
    'nombre' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El nombre está vacío');
        }
        return $val;
    },
    'curso' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El curso está vacío');
        }
        return intval($val, 10);
    },
    'id_profesor' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El ID del profesor está vacío');
        }
        return intval($val, 10);
    },
    'id_carrera' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El ID de la carrera está vacío');
        }
        return intval($val, 10);
    },
    'nota_aprobacion' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('La nota de aprobación está vacía');
        }
        return intval($val, 10);
    },
];
require __DIR__ . '/picoweb/crud.php';
