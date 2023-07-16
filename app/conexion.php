<?php 
namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class conexion extends \PDO {
        

        public $conexion;

     public   function __construct() {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

        try {
            parent::__construct($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: Database failed.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        }

        }
    }