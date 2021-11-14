<?php

namespace app\controllers;

use app\engine\App;

class ProductController extends Controller 
{
    public function actionIndex()
    {
       echo $this->render('index');
    }
    public function actionCatalog()
    {
        // $catalog = Products::getAll();

        $page = App::call()->request->getParams()['page'] ?? 0;

        // $catalog = (new ProductRepository())->getLimit(($page + 1) * 3);
        $catalog = App::call()->productRepository->getLimit(($page + 1) * 3);

        echo $this->render('product/catalog', ['catalog' => $catalog, 'page' => ++$page]);
    }

    public function actionCard()
    {
        //$id = $_GET['id'];

        // $id = (new Request())->getParams()['id'];
        $id = App::call()->request->getParams()['id'];

        $product = App::call()->productRepository->getOneObject($id);
        echo $this->render('product/card', ['product' => $product]);
    }

}