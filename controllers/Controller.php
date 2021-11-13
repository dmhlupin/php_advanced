<?php

namespace app\controllers;


use app\interfaces\IRenderer;
use app\models\repositories\BasketRepository;
use app\models\repositories\UserRepository;


abstract class Controller {
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    private $render;

    public function __construct(IRenderer $render)
    {
        $this->render = $render;
    }
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
        
    public function render($template, $params=[])
    {
        if($this->useLayout){

            $userRepository = new UserRepository();
            $basketRepository = new BasketRepository();

            return $this->renderTemplate('layouts/'.$this->layout, [
                'header' => $this->renderTemplate('header', [
                    'isAuth' => $userRepository->isAuth(),
                    'userName' => $userRepository->getName(),
                    'count' => $basketRepository->getCountWhere('session_id', session_id()),
                ]),
                'menu' => $this->renderTemplate('menu', ['position'=>$this->action]),
                'content' => $this->renderTemplate($template, $params),

            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }  
    }
    private function renderTemplate($template, $params=[])
    {
        return $this->render->renderTemplate($template,$params);
    }  
}