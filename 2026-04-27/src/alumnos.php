<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/models/Alumno.php';

// Call template
$param_class = Alumno::class;
$param_title = 'Alumnos';
$param_names = [
    $param_class::$id_column => 'ID',
    'nombre' => 'Nombre',
    'fecha_nacimiento' => 'Fecha de nacimiento',
    'dni' => 'DNI',
    'email' => 'E-mail',
    'id_carrera' => 'Carrera',
];
$param_types = [
    $param_class::$id_column => 'id_pk',
    'nombre' => 'text',
    'fecha_nacimiento' => 'date',
    'dni' => 'text',
    'email' => 'email',
    'id_carrera' => 'id_fk',
];
$param_parsers = [
    $param_class::$id_column => 'intval',
    'id_carrera' => function (mixed $val) {
        if (!is_numeric($val) || $val === '') {
            throw new Exception('El ID de la carrera está vacío');
        }
        return intval($val, 10);
    },
    'nombre' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El nombre está vacío');
        }
        return $val;
    },
    'fecha_nacimiento' => function (mixed $val) {
        return $val;
    },
    'dni' => function (mixed $val) {
        if (!is_string($val) || $val === '') {
            throw new Exception('El DNI está vacío');
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
