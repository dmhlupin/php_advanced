<?php

namespace app\controllers;

use app\engine\Request;
use app\models\Basket;

class BasketController extends Controller 
{
    public function actionIndex()
    {
        $session_id = session_id();

        $basket = Basket::getBasket($session_id);

        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
    public function actionAdd() 
    {
        $request = new Request();
        $id=$request->getParams()['id'];
        $price=$request->getParams()['price'];
        $session_id = session_id();
        (new Basket($session_id, $id, $price))->save();
        header("Location: /product/catalog");
        die();
    }
    public function actionDelete()
    {
            // 01:15
        $session_id = session_id(); 
        $request = new Request();
        $id = $request->getParams()['id'];

        $basket = (Basket::getOneObject($id));

        if($session_id == $basket->session_id){
            $basket->delete();
        }
        header("Location: /basket");
        die();

    }
}