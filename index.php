<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("core/DbConnection.php");
include_once("config/dbConfig.php");
$db = new DbConnection($dbConfig['DB_HOST'], $dbConfig['DB_USERNAME'], $dbConfig['DB_PASSWORD'], $dbConfig['DB_DATABASE'], $dbConfig['DB_CHARSET']);
var_dump($db);