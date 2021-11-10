<?php

namespace app\models\repositories;

use app\models\entity\Users;
use app\models\Repository;

class UserRepository extends Repository
{
    public function isAuth()
    {
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

