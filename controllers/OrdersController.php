<?php

namespace app\controllers;

use app\models\Orders;

class OrdersController extends Controller 
{
    public function actionOrders()
    {
        $orders = Orders::getAll();
        
        echo $this->render('orders/orders', ['orders' => $orders]);
    }
     public function actionOrder()
    {
        $id = $_GET['id'];
        $order = Orders::getOneObject($id);
        echo $this->render('orders/order', ['order' => $order]);
    }
}   