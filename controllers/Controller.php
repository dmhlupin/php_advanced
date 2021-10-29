<?php

namespace app\controllers;

Class Controller {
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
    
    public function render($template, $params=[])
    {
        if($this->layout){
            
            return $this->renderTemplate('layouts/'.$this->layout, [
                'header' => $this->renderTemplate('header', $params),
                'menu' => $this->renderTemplate('menu', ['position'=>$this->action]),
                'content' => $this->renderTemplate($template, $params)
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