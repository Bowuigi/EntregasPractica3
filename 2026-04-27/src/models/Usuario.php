<?php

require_once __DIR__ . '/../picoweb/Model.php';

class Usuario extends Model
{
    public static array $fillable = ['nombre', 'email', 'contrasena'];
    public static string $sql_table = 'usuarios';
    public static string $id_column = 'id_usuario';
    public static string $representative = 'nombre';
    public static array $pointers = [];

    public function onConstruct(): void {}
}
