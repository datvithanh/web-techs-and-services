<?php

namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    protected static $table;
    protected static $primaryKey = 'id';
    protected static $columns;

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
        $class_instances = array_map(function($row) {
            return static::fromRow($row);
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

    function __construct()
    {
        // foreach($array as $key=>$value){
        //     $this->$key = $value;
        // }
    }

    public static function fromRow($row) {
        $class = static::class;

        $instance = new $class();
        foreach($row as $key=>$value){
            $instance->$key = $value;
        }
        return $instance;
    }

    public static function blankInstance() {
        $class = static::class;
        $instance = new $class();
        foreach(static::$columns as $column){
            $instance->$column = '';
        }
        return $instance;
    }

    public function save() {
        $attrs = [];
        $values = [];
        foreach(static::$columns as $column){
            if($this->$column){
                array_push($attrs, $column);
                array_push($values, $this->$column);
            }
        }

        if(property_exists($this, 'id')){
            $query = 'UPDATE ' . static::$table . " SET ";
            $updates = [];
            foreach(static::$columns as $column){
                if($this->$column)
                    array_push($updates, $column . "='" . $this->$column . "'");
            }
            $query .= implode(', ', $updates) . " WHERE id=" . $this->id;
        }
        else 
            $query = "INSERT INTO " . static::$table . " (" . implode(', ', $attrs) . ") VALUES " . "('" . implode("', '", $values) . "')";

        $db = static::getDB();

        $stmt = $db->prepare($query);
        $status = $stmt->execute();
        
        if (!property_exists($this, 'id')){
            $id = $db->lastInsertId();
            $this->id = $id;
        }
        return $status;
    }

    public function update() {
        // $attrs = [];
        // $values = [];
        // foreach(static::$columns as $column){
        //     if($this->$column){
        //         array_push($attrs, $column);
        //         array_push($values, $this->$column);
        //     }
        // }
        // $query = "INSERT INTO " . static::$table . " (" . implode(', ', $attrs) . ") VALUES " . "('" . implode("', '", $values) . "')";
        
        // $db = static::getDB();
        // $stmt = $db->prepare($query);
        // return $stmt->execute();   
    }

    public function delete() {
        $query = "DELETE from " . static::$table . " where id=" . $this->id;
        $db = static::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute();
    }
}
