<?php

namespace app\models\repositories;

use app\models\entity\Users;
use app\models\Repository;

class UserRepository extends Repository
{
    public function updateHash()
    {
        $hash = uniqid(rand(), true);
        $id = (int)$_SESSION['id'];
        $user = $this->getOneWhere('id', $id);
        $user->hash = $hash;
        $this->update($user);
        setcookie("hash", $hash, time() + 36000, '/');
    }
    public function isAuth()
    {
        if(isset($_COOKIE["hash"]) && !isset($_SESSION['login'])){
            $hash = $_COOKIE["hash"];
            $user = $this->getOneWhere('hash', $hash);
            if(!empty($user->login)) {
                $_SESSION['login'] = $user->login;
            }
        }
        // var_dump($_COOKIE);
        // die();
        return isset($_SESSION['login']);
    }

    public function getName()
    {
        return $_SESSION['login'];
    }

    protected function getTableName() {
        return 'users';        
    }
    protected function getEntityClass()
    {
        return Users::class;
    }

    public function auth($login, $password)
    {
        $user = $this->getOneWhere('login', $login);
        
        // проверить пароль только если user есть
        if($user) {
            if(password_verify($password, $user->pass)) {
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $user->id;
                return true;
            }
            else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function isAdmin()
    {
        return ($_SESSION['login'] == 'admin');
    }
}

