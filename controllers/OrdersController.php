<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entity\Orders;
use app\models\repositories\OrdersRepository;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;

class OrdersController extends Controller 
{
    public function actionIndex()
    {

        echo $this->render('index');
    }
    public function actionOrders()
    {
        $userRepository = new UserRepository();
        $isAdmin = $userRepository->isAdmin();
        $isAuth = $userRepository->isAuth();
        $userId = $userRepository->getId('login', $_SESSION['login']);

        if($isAuth){
            if($isAdmin) {
                $orders = (new OrdersRepository())->getAll();
            } else {
                $orders = (new OrdersRepository())->getWhere('user_id', $userId);
            }
            echo $this->render('orders/orders', ['orders' => $orders, 'isAdmin' => $isAdmin]);
        } else {// else здесь можно направить на страницу авторизации/регистрации
            echo $this->render('/index', ['message' => 'Вы не авторизованы!']);
        }
    }
     public function actionOrder()
    {
        $id = $_GET['id'];
        $order = (new OrdersRepository())->getOneObject($id);
        echo $this->render('orders/order', ['order' => $order]);
    }

    public function actionAddOrder()
    {
        $request = new Request();                   // создаем экземпляр запроса
        $id=$request->getParams()['id'];            // вытаскиваем из запроса id
        $userAuth = (new UserRepository())->isAuth(); // проверяем авторизован ли пользователь
        $basket = (new BasketRepository())->getOne($id); //Получаем текущую запись в корзине
        $product = (new ProductRepository())->getOne($basket['product_id']);  // и информацию о заказываемом продукте
        
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
        $request = new Request();
        $basket_id = $request->getParams()['id'];
        $basket = (new BasketRepository())->getOneObject($basket_id);

        $product = (new ProductRepository())->getOne($basket->product_id);
        $user = (new UserRepository())->getName();
        $user_id = (new UserRepository())->getOneWhere('login', $user)->id;

        $phone = $request->getParams()['phone']; 
        $name = $product['name'];
        $session = session_id();
        $sum = $basket->price;
        $order = new Orders($name, $phone, $user_id, $session, $sum, "Оформлен");


        (new OrdersRepository())->save($order);
        (new BasketRepository())->delete($basket);
        $response = [
            'status' => 'ok',
            'accepted' => true,
            'count' => (new BasketRepository())->getCountWhere('session_id', $session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionChange()
    {
        $request = new Request();
        $orderId = $request->getParams()['id'];
        $changeType = $request->getParams()['changeType'];
        $order = (new OrdersRepository())->getOneWhere('id', $orderId);
        if($changeType == 'confirm'){
            $order->status = 'Подтвержден';
        } else if($changeType == 'cancel'){
            $order->status = 'Отменен';
        }
        $response = [
            'status' => $order->status
        ];
        (new OrdersRepository())->save($order);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}   