<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

try {
    // Start dotEnv instance.
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    // Configuration for Database
    define("DB_HOST", $_ENV['DB_HOST']);
    define("ROOT", $_ENV['ROOT']);
    define("DB_USER", $_ENV['DB_USER']);
    define("DB_PASS", $_ENV['DB_PASSWORD']);
    define("DB_NAME", $_ENV['DB_NAME']);
    define("APP_URL", $_ENV['APP_URL']);
    define("NAME_APP", $_ENV['NAME_APP']);
} catch (\Throwable $th) {
    if ($_ENV['ENVIRONMENT'] != "production") {
        die($th->getMessage());
    } else {
        $log = new Logger('App');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/errors.log', Logger::ERROR));

        $log->error($th->getMessage(), $th->getTrace());
    }
}
