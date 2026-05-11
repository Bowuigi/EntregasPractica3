<?php

require_once __DIR__ . '/../picoweb/Model.php';
require_once __DIR__ . '/Alumno.php';
require_once __DIR__ . '/Materia.php';
require_once __DIR__ . '/Nota.php';

class Examen extends Model
{
    public static array $fillable = ['id_alumno', 'id_materia', 'nota'];
    public static string $sql_table = 'examenes';
    public static string $id_column = 'id_examen';
    public static string $representative = 'nota';
    public static array $pointers = [
        'id_alumno' => Alumno::class,
        'id_materia' => Materia::class,
        'nota' => Nota::class,
    ];

    public function onConstruct(): void {}
}
