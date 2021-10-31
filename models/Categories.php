<?php

namespace app\models;

class Categories extends dbModel
{
    protected $id;
    protected $name;

    public function __construct(
        $id = null,
        $name = null,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getTableName() {
        return 'categories';        
    }

}