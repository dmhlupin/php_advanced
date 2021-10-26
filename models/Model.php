<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

// абстрактный класс-родитель для классов-моделей. Определяет общие для всех методы и свойства.

abstract class Model implements IModel
{

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
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return Db::getInstanse()->queryOne($sql, ['id' => $id]);
    }

    public function getOneObject($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return Db::getInstanse()->queryOneObject($sql, ['id' => $id], static::class);
    }


    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return Db::getInstanse()->queryAll($sql);
    }

    // ДЗ

    public function insert() 
    {
        foreach($this as $key => $value) {
            if($key == 'id') continue;    // На каждом этапе заполняем три массива
            $params[$key] = $value;       // ассоциативный массив params для передачи в execute
            $fields[] = "`{$key}`";       // массив полей таблицы
            $values[] = ":{$key}";        // массив плейсхолдеров 
        }

        $fieldStr = implode(',', $fields);      // implode формирует строку с разделителем-запятой. Так по-моему проще всего
        $paramsStr = implode(',', $values);

        $tableName = $this->getTableName();
        $sql = "INSERT INTO `{$tableName}` ({$fieldStr}) VALUES ({$paramsStr})";
        Db::getInstanse()->execute($sql, $params);
        $this->id = Db::getInstanse()->lastInsertId();
        return $this;
    }
    public function delete() 
    {
        $tableName = $this->getTableName();
        $id = $this->id;
        $sql = "DELETE FROM `{$tableName}` WHERE `{$tableName}`.`id` = :id";
        Db::getInstanse()->execute($sql, ['id' => $id]);
        return true;
    }

    public function update()
    {
        //UPDATE `products` SET `name` = 'Coffee', `description` = 'Колумбийский' WHERE `products`.`id` = 4;
        foreach($this as $key => $value) {
            $params[$key] = $value;
            if($key == 'id') continue;           
            $fields[] = "`{$key}` = :{$key}";       
        }
        $fieldStr = implode(',', $fields);  
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$fieldStr} WHERE `{$tableName}`.`id` = :id";
        Db::getInstanse()->execute($sql, $params);
        return $this;
    }

}