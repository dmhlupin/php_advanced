<?php

namespace app\models;

use app\engine\Db;
use app\engine\App;


// Класс содержит CRUD блок для работы с БД
abstract class Repository  
{   
    
    // абстрактный метод. Не содержит тела и обязателен для реализации в наследнике
    abstract protected function getTableName();

    abstract protected function getEntityClass();

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return App::call()->db->queryOne($sql, ['id' => $id]);
    }
    public function getId($name, $value){
        $tableName = $this->getTableName();
        $sql = "SELECT id FROM `{$tableName}` WHERE `{$name}` = :value";
        $result = App::call()->db->queryOne($sql, ['value' => $value]);
        return $result['id'];
    }

    public function getOneObject($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id"; //:id - плэйсхолдер для id в целях безопасности
        return App::call()->db->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
        
    }



    public function getOneWhere($name, $value) // повторяет getWhere написанный ранее. Пока оставлю.
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$name}` = :value";
        return App::call()->db->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value) 
    {
        $tableName = $this->getTableName();
        $sql = "SELECT COUNT(*) as count FROM `{$tableName}` WHERE `{$name}` = :value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }


    public function getLimit($limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` LIMIT ?";
        return App::call()->db->queryLimit($sql, $limit);
    }


    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return App::call()->db->queryAll($sql);
    }

    public function getWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$name}` = :value";
        return App::call()->db->queryAll($sql, ['value' => $value]);
    }

    // ДЗ

    public function insert(Entity $entity) 
    {

        foreach($entity->props as $key => $value) {
            $params[$key] = $entity->$key;
            $fields[] = "`{$key}`";
            $values[] = ":{$key}";     
        }

        $fieldStr = implode(',', $fields);      // implode формирует строку с разделителем-запятой. Так по-моему проще всего
        $paramsStr = implode(',', $values);

        $tableName = $this->getTableName();
        $sql = "INSERT INTO `{$tableName}` ({$fieldStr}) VALUES ({$paramsStr})";

        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->lastInsertId();
    }

    public function delete(Entity $entity) 
    {
        $tableName = $this->getTableName();
        $id = $entity->id;
        $sql = "DELETE FROM `{$tableName}` WHERE `{$tableName}`.`id` = :id";
        App::call()->db->execute($sql, ['id' => $id]);
        return true;
    }


    public function update(Entity $entity)
    {
        //UPDATE `products` SET `name` = 'Coffee', `description` = 'Колумбийский' WHERE `products`.`id` = 4;
        foreach($entity->props as $key => $value) {
            if($value == true) {
                $params[$key] = $entity->$key;
                $fields[] = "`{$key}` = :{$key}";
                $this->props[$key] = false;
            }
        }
        $params['id'] = $entity->id;
        $fieldStr = implode(',', $fields);  
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$fieldStr} WHERE `{$tableName}`.`id` = :id";
        App::call()->db->execute($sql, $params);
        return $this;
    }
    public function save(Entity $entity)
    {
        if(is_null($entity->id)) {
            return $this->insert($entity);

        } else {
            return $this->update($entity);
        }
        // Должен и апдейтить и создавать
        // if id is_null - insert иначе update
    }

}