<?php

namespace app\models\entity;

use app\models\Entity;

class Basket extends Entity
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
}