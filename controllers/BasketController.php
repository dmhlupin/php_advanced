<?php

namespace app\controllers;


use app\models\entity\Basket;
use app\engine\App;

class BasketController extends Controller 
{
    public function actionIndex()
    {
        $session_id = session_id();

        $basket = App::call()->basketRepository->getBasket($session_id);

        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
    public function actionAdd() 
    {        
        $id=App::call()->request->getParams()['id'];

        //берем цену продукта из БД
        $price = App::call()->productRepository->getOne($id)['price']; 
        
        $session_id = session_id();
       
        $basket = new Basket($session_id, $id, $price);
        
        App::call()->basketRepository->save($basket);

        $response = [
            'status' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //header("Location: /product/catalog");
        die();
    }
    public function actionDelete()
    {
            // 01:15
        $session_id = session_id(); 
        
        $id = App::call()->request->getParams()['id'];
        
        $basket = App::call()->basketRepository->getOneObject($id);// ПОЧЕМУ ЗДЕСЬ МАССИВ а не объект??? Потому что статические методы надо было убрать!!! 4 часа потратил!!!!

        if($session_id == $basket->session_id){
            
            App::call()->basketRepository->delete($basket);
        }
        $response = [
            'status' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }
}