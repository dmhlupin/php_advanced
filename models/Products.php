<?php

namespace app\models;

class Products extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    public function getTableName() {
        return 'products';        
    }
}