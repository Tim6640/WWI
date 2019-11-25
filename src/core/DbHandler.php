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

    private $database;

    public function __construct($database)
    {
        $config = parse_ini_file("../config/dbConfig.ini", true);
        $this->database = $database;
        $host = $config[$database]['host'];
        $databaseName = $config[$database]['database'];
        $charset = $config[$database]['charset'];
        $username = $config[$database]['username'];
        $password = $config[$database]['password'];
        $dns = "mysql:host=$host;dbname=$databaseName;charset=$charset";
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
            self::$instance = new DbHandler($this->database);
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