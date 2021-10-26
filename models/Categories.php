<?php

namespace app\models;

class Categories extends Model
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

    public function getTableName() {
        return 'categories';        
    }

}