<?php
require_once __DIR__ . '/ProjectConfiguration.php';
require_once __DIR__ . '/patterns.php';

abstract class DatabaseTemplate {
    use Singleton;

    // Provided by the extension class
    protected static string $database_name;
    protected static int $latest_version;
    abstract protected function getVersion(): int;

    private ?PDO $pdo = null;

    private function __construct() {
        try {
            // NOTE: Hide the password behind an environment variable / secret file in production
            $this->pdo = new PDO(
                'mysql:host='
                    . Config::get('db.host')
                    . ':'
                    . Config::get('db.port')
                    . ';charset=utf8mb4',
                Config::get('db.user'),
                Config::get('db.password')
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->performMigrations();
        } catch (PDOException $exn) {
            http_response_code(500);
            error_log('Database error: ' . $exn->getMessage()); // To debug log
            die('Internal server error');
        }
    }

    protected function tableExists(string $table): bool {
        $this->pdo->query("call sys.table_exists('" . static::$database_name . "', '{$table}', @result)")->closeCursor();

        $sth = $this->pdo->query('select @result;');
        $result = $sth->fetch(PDO::FETCH_ASSOC)['@result'];
        $sth->closeCursor();

        return $result !== '';
    }

    private function performMigrations(): void {
        try {
            $this->pdo->query('create database if not exists ' . static::$database_name . '; use ' . static::$database_name . ';')->closeCursor();
            for ($current_version = $this->getVersion(); $current_version < static::$latest_version; $current_version++) {
                $sql = file_get_contents("/app/sql/{$current_version}.sql");
                $this->pdo->query($sql)->closeCursor();
            }
        } catch (PDOException $exn) {
            http_response_code(500);
            error_log('Database error: ' . $exn->getMessage()); // To debug log
            die('Internal server error');
        }
    }

    public function statement(string $sql, array $values): array {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exn) {
            http_response_code(500);
            error_log('Database error: ' . $exn->getMessage()); // To debug log
            die('Internal server error');
        }
    }
}
