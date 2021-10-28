<?php

namespace app\models;

class Products extends DbModel
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $brand_id;
    protected $category_id;
    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'brand_id' => false,
        'category_id' => false
    ];

    public function __construct(
        $name = null, 
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

    public static function getTableName() {
        return 'products';        
    }
}