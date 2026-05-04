<?php
trait Singleton {
    private static ?object $instance = null;

    public static function getInstance(): static {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}

// Service container pattern to import, manage and swap singletons automatically
// Generalized to store a globally accessible key-value map
trait GlobalStore {
    private static array $globals = [];

    public static function getOne(string $name): mixed {
        if (array_key_exists($name, static::$globals)) {
            return static::$globals[$name];
        } else {
            throw new Exception("Attempted to operate without required service '{$name}'");
        }
    }

    public static function setMany(array $globals): void {
        foreach ($globals as $name => $instance) {
            if (array_key_exists($name, static::$globals)) {
                throw new Exception("Attempted to override service '{$name}'");
            } else {
                static::$globals[$name] = $instance;
            }
        }
    }
}

?>
