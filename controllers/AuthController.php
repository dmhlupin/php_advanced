<?php

namespace app\controllers;

use app\engine\App;


class AuthController extends Controller
{
    public function actionLogin() 
    {   
        $login = App::call()->request->getParams()['login'];
        $password = App::call()->request->getParams()['password'];
        $save = App::call()->request->getParams()['save'];
        if (App::call()->userRepository->auth($login,$password)) {
            if($save){
                App::call()->userRepository->updateHash();
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