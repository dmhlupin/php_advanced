<?php

namespace app\models\entity;

use app\models\Entity;

class UsersOrders extends Entity
{
    protected $user_id;
    protected $order_id;

    public function __construct(
        $user_id = null,
        $order_id = null
    )
    {
        $this->user_id = $user_id;
        $this->order_id = $order_id;
    }

    public static function getTableName() {
        return 'users_orders';        
    }

}