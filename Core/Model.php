<?php

namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    protected static $table;
    protected static $primaryKey = 'id';

    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }

    public static function getTable() {
        return self::$table;
    }

    public static function instanize($rows) {
        $class = static::class;
        $class_instances = array_map(function($row) use ($class){
            return new $class($row);
        }, $rows);
        return $class_instances;
    }

    // return an array of instances
    public static function all()
    {
        $db = static::getDB();
        $query = "SELECT * FROM " . static::$table;
        $stmt = $db->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return static::instanize($rows);
    }

    // return an instance
    public static function getById($id){
        $db = static::getDB();
        $query = "SELECT * FROM " . static::$table . " ";
        $query = $query . "WHERE " . static::$primaryKey . " like '{$id}'";
        $stmt = $db->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $instances = static::instanize($rows);
        if (count($instances))
            return $instances[0];
        return null;
    }

    // return an array of instances
    public static function where($column, $value)
    {
        $db = static::getDB();
        $query = "SELECT * FROM " . static::$table . " ";
        $query = $query . "WHERE {$column} like '{$value}'";
        $stmt = $db->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return static::instanize($rows);
    }

    // // # create 
    // public static function create($email, $name, $phone_number, $role){
    //     $db = static::getDB();
    //     // $stmt = $db->query('SELECT * FROM user WHERE user_id =' . $id);
    //     $query = "INSERT INTO user (email, name, phone_number, role) VALUES ('{$email}', '{$name}', '{$phone_number}', '{$role}');";
    //     var_dump($query);
    //     $stmt = $db->prepare($query);
    //     return $stmt->execute();
    // }

    function __construct($array)
    {
        foreach($array as $key=>$value){
            $this->$key = $value;
        }
    }
}
