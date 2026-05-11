<?php

require_once __DIR__ . '/../picoweb/Model.php';

class Carrera extends Model
{
    public static array $fillable = ['nombre'];
    public static string $sql_table = 'carreras';
    public static string $id_column = 'id_carrera';
    public static string $representative = 'nombre';
    public static array $pointers = [];

    public function onConstruct(): void {}
}
