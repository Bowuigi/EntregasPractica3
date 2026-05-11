<?php

require_once __DIR__ . '/../picoweb/Model.php';

class Nota extends Model
{
    public static array $fillable = [];
    public static string $sql_table = 'notas';
    public static string $id_column = 'id_nota';
    public static string $representative = 'id_nota';
    public static array $pointers = [];

    public function onConstruct(): void {}
}
