<?php
require_once __DIR__ . '/patterns.php';
require_once __DIR__ . '/ProjectConfiguration.php';

class Session {
    use Singleton;

    private function __construct() {
        session_name('APP_SESSION');

        session_set_cookie_params([
            'lifetime' => Config::get('session.duration'),
            'domain' => $_SERVER['HTTP_HOST'] ?? '',
            'secure' => Config::get('session.https'),
            'httponly' => true,
            'samesite' => 'Strict',
            'path' => '/',
        ]);

        session_start();

        if (!isset($_SESSION['LAST_REGENERATED'])) {
            $this->regenerateSession();
        } else {
            $time_since_regen = time() - intval($_SESSION['LAST_REGENERATED']);
            if ($time_since_regen > 300) { // 5 minutes
                $this->regenerateSession();
            }
        }
    }

    private function regenerateSession(): void {
        session_regenerate_id(true);
        $_SESSION['LAST_REGENERATED'] = time();
    }

    public function destroySession(): void {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly'],
            );
        }

        session_destroy();
    }

    public function set(string $key, mixed $value = true): void {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): mixed {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool {
        return array_key_exists($key, $_SESSION);
    }

    public function is(string $key): bool {
        return $this->has($key) && $this->get($key, false);
    }

    public function delete(string $key): void {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }
}
?>
