<?php

namespace app\models;

use app\engine\Db;

class Basket extends DbModel
{
    protected $id;
    protected $session_id;
    protected $product_id;
    protected $price;
    protected $props = [
        'session_id' => false,
        'product_id' => false,
        'price' => false
    ];

    public function __construct($session_id = null, $product_id = null, $price = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->price = $price;
    }

    public static function getBasket($session_id) {
        $sql = "SELECT 
            basket.id basket_id, 
            products.id prod_id, 
            products.name, 
            products.description,
            products.image,
            products.price 
        FROM `basket`,`products` WHERE `session_id` = :session_id AND basket.product_id = products.id";
        return Db::getInstanse()->queryAll($sql, ['session_id' => $session_id]);
    }

    public static function getTableName() {
        return 'basket';        
    }

}