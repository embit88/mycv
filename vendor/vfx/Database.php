<?php

namespace vfx;

use vfx\traits\Singleton;

class Database
{

    use Singleton;
    public object|null $connect = null;

    private function __construct()
    {
        require_once CONFIG_PATH . '/database.php';

        $driver = DB_DRIVER;
        $host = DB_HOST;
        $name = DB_NAME;
        $charset = DB_CHARSET;
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $dsn = "{$driver}:host={$host};dbname={$name};charset={$charset}";
        $option = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        try {
            $this->connect = new \PDO($dsn, $user, $pass, $option);
        } catch (\PDOException $e) {
            throw new \Exception("Ошибка при подклбчении к БД {$e->getMessage()}", 500);
        }
    }

    public function getConnect(): object
    {
        return $this->connect;
    }

}