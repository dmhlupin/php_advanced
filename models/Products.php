<?php

namespace app\models;

class Products extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getTableName() {
        return 'products';        
    }
}