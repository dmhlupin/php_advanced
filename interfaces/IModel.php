<?php

namespace app\interfaces;

// интерфейс для класса. Не содержит свойств, только заготовки публичных методов, обязательных к реализации в классе
interface IModel
{
    public function getOne($id);
    public function getAll();
    public function getTableName();
}