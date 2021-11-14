<?php

namespace app\controllers;


use app\models\entity\Orders;

use app\engine\App;

class OrdersController extends Controller 
{
    public function actionIndex()
    {

        echo $this->render('index');
    }
    public function actionOrders()
    {
        
        $isAdmin = App::call()->userRepository->isAdmin();
        $isAuth = App::call()->userRepository->isAuth();
        $userId = App::call()->userRepository->getId('login', $_SESSION['login']);

        if($isAuth){
            if($isAdmin) {
                $orders = App::call()->ordersRepository->getAll();
            } else {
                $orders = App::call()->ordersRepository->getWhere('user_id', $userId);
            }
            echo $this->render('orders/orders', ['orders' => $orders, 'isAdmin' => $isAdmin]);
        } else {// else здесь можно направить на страницу авторизации/регистрации
            echo $this->render('/index', ['message' => 'Вы не авторизованы!']);
        }
    }
     public function actionOrder()
    {
        $id = $_GET['id'];
        $order = App::call()->ordersRepository->getOneObject($id);
        echo $this->render('orders/order', ['order' => $order]);
    }

    public function actionAddOrder()
    {
        
        $id=App::call()->request->getParams()['id'];            // вытаскиваем из запроса id
        $userAuth = App::call()->userRepository->isAuth(); // проверяем авторизован ли пользователь
        $basket = App::call()->basketRepository->getOne($id); //Получаем текущую запись в корзине
        $product = App::call()->productRepository->getOne($basket['product_id']);  // и информацию о заказываемом продукте
        
        if($userAuth) {   // Проверяем, авторизован ли пользователь. Если нет, то доступа к заказу не будет 
            $response = [
                'auth' => true,
                'orderName' => $product['name'],
                'price' => $basket['price'],
                'basketId' => $basket['id']
            ];
        } else {
            $response = [
                'auth' => false
            ];
        }
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAcceptOrder()
    {
        
        $basket_id = App::call()->request->getParams()['id'];
        $basket = App::call()->basketRepository->getOneObject($basket_id);

        $product = App::call()->productRepository->getOne($basket->product_id);
        $user = App::call()->userRepository->getName();
        $user_id = App::call()->userRepository->getOneWhere('login', $user)->id;

        $phone = App::call()->request->getParams()['phone']; 
        $name = $product['name'];
        $session = session_id();
        $sum = $basket->price;
        $order = new Orders($name, $phone, $user_id, $session, $sum, "Оформлен");


        App::call()->ordersRepository->save($order);
        App::call()->basketRepository->delete($basket);
        $response = [
            'status' => 'ok',
            'accepted' => true,
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionChange()
    {
        
        $orderId = App::call()->request->getParams()['id'];
        $changeType = App::call()->request->getParams()['changeType'];
        $order = App::call()->ordersRepository->getOneWhere('id', $orderId);
        if($changeType == 'confirm'){
            $order->status = 'Подтвержден';
        } else if($changeType == 'cancel'){
            $order->status = 'Отменен';
        }
        $response = [
            'status' => $order->status
        ];
        App::call()->ordersRepository->save($order);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}   