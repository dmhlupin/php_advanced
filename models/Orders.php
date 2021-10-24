<?php

namespace app\models;

class Orders extends Model
{
    protected $id;
    protected $name;
    protected $phone;
    protected $user_id;
    protected $session_id;
    protected $sum;
    protected $status;

    public function getTableName() {
        return 'orders';        
    }
}