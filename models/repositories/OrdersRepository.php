<?php

namespace app\models\repositories;

use app\models\entity\Orders;
use app\models\Repository;

class OrdersRepository extends Repository
{
    protected function getTableName() {
        return 'orders';        
    }
    protected function getEntityClass()
    {
        return Orders::class;
    }
}