<?php

namespace app\models;

class Products extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $brand_id;
    protected $category_id;

    public function __construct($name = null, 
                                $description = null, 
                                $price = null, 
                                $brand_id = null, 
                                $category_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->brand_id = $brand_id;
        $this->category_id = $category_id;
    }

    public function getTableName() {
        return 'products';        
    }
}