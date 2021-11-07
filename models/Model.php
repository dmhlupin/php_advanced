<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

// абстрактный класс-родитель для классов-моделей. Определяет общие для всех методы и свойства.

abstract class Model implements IModel
{
    protected $props = [];
    // сеттер - для установки значений protected свойств
    // public function __set($name, $value)
    // {
    //     $this->props[$name] = true;
    //     $this->$name = $value;
    //     var_dump($this->$name);
    // }

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

    public function __isset($name)
    {
        // ДЗ 5
        return isset($this->name);
    }

}