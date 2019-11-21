<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:00
 */

class DbHandler
{
    public static $instance = null;

    private $connection;

    public function __construct()
    {
        $config = parse_ini_file("../config/dbConfig.ini");
        $host = $config['host'];
        $database = $config['database'];
        $charset = $config['charset'];
        $username = $config['username'];
        $password = $config['password'];
        $dns = "mysql:host=$host;dbname=$database;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dns, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DbHandler();
        }
        return self::$instance;
    }

    public function connect()
    {
        return $this->connection;
    }

    public function disconnect()
    {
        unset($this->connection);
    }
}