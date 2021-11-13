<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entity\Basket;
use app\models\entity\Products;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;

class BasketController extends Controller 
{
    public function actionIndex()
    {
        $basketRepository = new BasketRepository();
        $session_id = session_id();

        $basket = $basketRepository->getBasket($session_id);

        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
    public function actionAdd() 
    {
        $request = new Request();
        
        $id=$request->getParams()['id'];

        //берем цену продукта из БД
        $price = (new ProductRepository())->getOne($id)['price']; 
        

        $session_id = session_id();
       
        $basket = new Basket($session_id, $id, $price);
        
        (new BasketRepository())->save($basket);

        $response = [
            'status' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //header("Location: /product/catalog");
        die();
    }
    public function actionDelete()
    {
            // 01:15
        $session_id = session_id(); 
        $request = new Request();
        $id = $request->getParams()['id'];
        
        $basket = (new BasketRepository())->getOneObject($id);// ПОЧЕМУ ЗДЕСЬ МАССИВ а не объект??? Потому что статические методы надо было убрать!!! 4 часа потратил!!!!

        if($session_id == $basket->session_id){
            
            (new BasketRepository())->delete($basket);
        }
        $response = [
            'status' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }
}