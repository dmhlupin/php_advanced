<?php

namespace app\models;

class Basket extends Model
{
    protected $id;
    protected $goods_id;
    protected $session_id;

    public function getTableName() {
        return 'basket';        
    }
}