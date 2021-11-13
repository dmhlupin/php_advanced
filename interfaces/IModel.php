<?php

namespace app\interfaces;

// интерфейс для класса. Не содержит свойств, только заготовки публичных методов, обязательных к реализации в классе
interface IModel
{
    public static function getOne($id);
    public static function getAll();
    public static function getTableName();
}