<?php

namespace app\models;

use app\interfaces\IModel;

// абстрактный класс-родитель для классов-моделей. Определяет общие для всех методы и свойства.

abstract class Model implements IModel
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    // сеттер - для установки значений protected свойств
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    // геттер - для получения значений protected свойств

    public function __get($name)
    {
        return $this->$name;
    }
    
    // метод call для обработки вызова несуществующих методов
    public function __call($name, $arguments)
    {
        echo "Вызов неопределенного метода {$name} с параметрами: ".implode(', ', $arguments);
    }

    // абстрактный метод. Не содержит тела и обязателен для реализации в наследнике
    abstract public function getTableName();

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return $this->db->queryAll($sql);
    }
}