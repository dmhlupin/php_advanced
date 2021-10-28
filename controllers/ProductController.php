<?php

namespace app\controllers;

use app\models\Products;

class ProductController 
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction; // Опять сахарок, в случае если пустой action
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method))
        {
            $this->$method();
        } else {
            die("Метода не существует");
        }
    }
    public function actionIndex()
    {
       echo $this->render('index');
    }

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
    public function render($template, $params=[])
    {
        if($this->layout){
            $menu = $this->renderTemplate('menu', $params);
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate('layouts/'.$this->layout, [
                'menu' => $menu,
                'content' => $content
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
        
    }
    public function renderTemplate($template, $params=[])
    {
        ob_start();
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        include $templatePath;
        return ob_get_clean();
    }
}