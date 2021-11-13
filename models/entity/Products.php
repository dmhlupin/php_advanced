<?php

namespace app\models\entity;

use app\models\Entity;

class Products extends Entity
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $brand_id;
    protected $category_id;
    protected $image;
    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'brand_id' => false,
        'category_id' => false,
        'image' => false
    ];

    public function __construct(
        $name = null, 
        $description = null, 
        $price = null, 
        $brand_id = null, 
        $category_id = null,
        $image = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->brand_id = $brand_id;
        $this->category_id = $category_id;
        $this->image = $image;
    }


}