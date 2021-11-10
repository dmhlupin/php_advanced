<?php

namespace app\models\entity;

use app\models\Entity;

class Brand extends Entity
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