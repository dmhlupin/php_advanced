<?php

use app\models\entity\Products;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct()
    {
        $name = "Часы Casio";
        $product = new Products($name);
        $this->assertEquals($name, $product->name);
    }
}