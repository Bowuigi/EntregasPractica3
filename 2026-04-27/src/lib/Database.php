<?php
require_once __DIR__ . '/../picoweb/DatabaseTemplate.php';

class Database extends DatabaseTemplate {
    protected static string $database_name = 'practica';
    protected static int $latest_version = 5;

    protected function getVersion(): int {
        try {
            if (!$this->tableExists('usuarios')) {
                return 0;
            }
            if (!$this->tableExists('carreras')) {
                return 1;
            }
            if (!$this->tableExists('notas')) {
                return 2;
            }
            if (!$this->tableExists('examenes')) {
                return 3;
            }
            if (count($this->statement('select id_usuario from usuarios', [])) === 0) {
                return 4;
            }
            return 5;
        } catch (PDOException $exn) {
            http_response_code(500);
            error_log("Database error: " . $exn->getMessage()); // To debug log
            die("Internal server error");
        }
    }
}
?>
