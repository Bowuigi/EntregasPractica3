<?php

require_once __DIR__ . '/../picoweb/Model.php';

class Profesor extends Model
{
    public static array $fillable = ['nombre', 'email'];
    public static string $sql_table = 'profesores';
    public static string $id_column = 'id_profesor';
    public static string $representative = 'nombre';
    public static array $pointers = [];

    public function onConstruct(): void {}
}
