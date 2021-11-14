<?php

namespace app\controllers;

use app\engine\Request;
use app\models\repositories\UserRepository;


class AuthController extends Controller
{
    public function actionLogin() 
    {
        $request = new Request();
        
        $login = $request->getParams()['login'];
        $password = $request->getParams()['password'];
        $save = $request->getParams()['save'];
        if ((new UserRepository())->auth($login,$password)) {
            if($save){
                (new UserRepository())->updateHash();
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die('Неверный логин или пароль!');
        }
    }

    public function actionLogout()
    {
        session_regenerate_id();
        session_destroy();
        setcookie("hash", "", time() - 36000, '/');
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }
}