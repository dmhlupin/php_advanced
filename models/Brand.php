<?php

namespace app\models;

class Brand extends Model
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
        return 'brand';        
    }

}