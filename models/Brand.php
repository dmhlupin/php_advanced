<?php

namespace app\models;

class Brand extends dbModel
{
    protected $id;
    protected $name;

    public function __construct(
        $id = null,
        $name = null
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getTableName() {
        return 'brand';        
    }

}