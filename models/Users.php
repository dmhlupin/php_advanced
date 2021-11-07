<?php

namespace app\models;

class Users extends dbModel
{
    protected $id;
    protected $login;
    protected $name;
    protected $pass;
    protected $hash;
    protected $props = [
        'login' => false,
        'name' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct(
        
        $login = null,
        $name = null,
        $pass = null,
        $hash = null
    )
    {
        
        $this->login = $login;
        $this->name = $name;
        $this->pass = $pass;
        $this->hash = $hash;
    }
    
    public static function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public static function getName()
    {
        return $_SESSION['login'];
    }

    public static function getTableName() {
        return 'users';        
    }

    public static function auth($login, $password)
    {
        $user = Users::getOneWhere('login', $login);
        // проверить пароль только если user есть
        if($user) {
            if(password_verify($password, $user->pass)) {
                $_SESSION['login'] = $login;
                return true;
            }
            else {
                return false;
            }
        } else {
            return false;
        }
    }

}