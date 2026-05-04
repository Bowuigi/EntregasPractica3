<?php
// This file MUST be included by every entrypoint

require_once __DIR__ . '/../picoweb/ProjectConfiguration.php';
require_once __DIR__ . '/../picoweb/Session.php';
require_once __DIR__ . '/Database.php';

Config::set([
    'db.host' => 'database',
    'db.port' => 3306,
    'db.user' => 'root',
    // Can be moved to another (uncommited) file if secrecy is required
    'db.password' => 'password',

    'session.duration' => 3600 * 2, // 2 hours
    'session.https' => false,
]);

Services::configure([
    'db' => Database::getInstance(),
    'session' => Session::getInstance(),
]);
?>
