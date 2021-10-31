<?php

namespace app\controllers;

use app\models\Products;

class ProductController extends Controller 
{
    public function actionIndex()
    {
       echo $this->render('index');
    }
    public function actionCatalog()
    {
        // $catalog = Products::getAll();

        $page = $_GET['page'] ?? 0;

        $catalog = Products::getLimit(($page + 1) * 3);

        echo $this->render('product/catalog', ['catalog' => $catalog, 'page' => ++$page]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Products::getOneObject($id);
        echo $this->render('product/card', ['product' => $product]);
    }

}