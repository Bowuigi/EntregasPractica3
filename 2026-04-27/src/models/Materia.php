<?php

require_once __DIR__ . '/../picoweb/Model.php';
require_once __DIR__ . '/Profesor.php';
require_once __DIR__ . '/Carrera.php';
require_once __DIR__ . '/Nota.php';

class Materia extends Model
{
    public static array $fillable = ['nombre', 'curso', 'id_profesor', 'id_carrera', 'nota_aprobacion'];
    public static string $sql_table = 'materias';
    public static string $id_column = 'id_materia';
    public static string $representative = 'nombre';
    public static array $pointers = [
        'id_profesor' => Profesor::class,
        'id_carrera' => Carrera::class,
        'nota_aprobacion' => Nota::class,
    ];

    public function onConstruct(): void {}
}
