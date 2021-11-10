<?php

namespace app\controllers;

use app\models\repositories\OrdersRepository;

class OrdersController extends Controller 
{
    public function actionIndex()
    {
       echo $this->render('index');
    }
    public function actionOrders()
    {
        $orders = (new OrdersRepository())->getAll();
        
        echo $this->render('orders/orders', ['orders' => $orders]);
    }
     public function actionOrder()
    {
        $id = $_GET['id'];
        $order = (new OrdersRepository())->getOneObject($id);
        echo $this->render('orders/order', ['order' => $order]);
    }
}   