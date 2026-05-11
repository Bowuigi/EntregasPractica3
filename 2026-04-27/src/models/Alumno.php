<?php

require_once __DIR__ . '/../picoweb/Model.php';
require_once __DIR__ . '/Carrera.php';

class Alumno extends Model
{
    public static array $fillable = ['nombre', 'fecha_nacimiento', 'dni', 'email', 'id_carrera'];
    public static string $sql_table = 'alumnos';
    public static string $id_column = 'id_alumno';
    public static string $representative = 'nombre';
    public static array $pointers = [
        'id_carrera' => Carrera::class,
    ];

    public function onConstruct(): void {}
}
