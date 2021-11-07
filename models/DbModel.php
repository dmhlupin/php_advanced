<?php

namespace app\models;

use app\engine\Db;


// Класс содержит CRUD блок для работы с БД
abstract class DbModel extends Model {
    
    
    // абстрактный метод. Не содержит тела и обязателен для реализации в наследнике
    abstract public static function getTableName();

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return Db::getInstanse()->queryOne($sql, ['id' => $id]);
    }

    public static function getOneObject($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return Db::getInstanse()->queryOneObject($sql, ['id' => $id], static::class);
    }

    public static function getWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$name}` = :value";
        return Db::getInstanse()->queryOneObject($sql, ['value' => $value], static::class);
    }

    public static function getOneWhere($name, $value) // повторяет getWhere написанный ранее. Пока оставлю.
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$name}` = :value";
        return Db::getInstanse()->queryOneObject($sql, ['value' => $value], static::class);
    }

    public static function getCountWhere($name, $value) 
    {
        $tableName = static::getTableName();
        $sql = "SELECT COUNT(*) as count FROM `{$tableName}` WHERE `{$name}` = :value";
        return Db::getInstanse()->queryOne($sql, ['value' => $value])['count'];
    }


    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` LIMIT ?";
        return Db::getInstanse()->queryLimit($sql, $limit);
    }


    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return Db::getInstanse()->queryAll($sql);
    }

    // ДЗ

    public function insert() 
    {

        foreach($this->props as $key => $value) {
            $params[$key] = $this->$key;
            $fields[] = "`{$key}`";
            $values[] = ":{$key}";     
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
        foreach($this->props as $key => $value) {
            if($value == true) {
                $params[$key] = $this->$key;
                $fields[] = "`{$key}` = :{$key}";      
            }
        }
        $params['id'] = $this->id;
        $fieldStr = implode(',', $fields);  
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$fieldStr} WHERE `{$tableName}`.`id` = :id";
        Db::getInstanse()->execute($sql, $params);
        return $this;
    }
    public function save()
    {
        if(is_null($this->id)) {
            return $this->insert();

        } else {
            return $this->update();
        }
        // Должен и апдейтить и создавать
        // if id is_null - insert иначе update
    }

}