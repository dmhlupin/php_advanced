<?php

namespace app\controllers;

use app\models\Products;

class ProductController extends Controller 
{
    public function actionCatalog()
    {
        $catalog = Products::getAll();

        echo $this->render('product/catalog', ['catalog' => $catalog]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Products::getOneObject($id);
        echo $this->render('product/card', ['product' => $product]);
    }

}