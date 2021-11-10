<?php

use app\models\entity\Users;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUser() //проверяем работу конструктора и верность полей объекта user
    {
        $name = "Ivan Smirnov";
        $login = "ismirnov";
        $pass = "23423fsdsdfsvccxcvxv";
        $user = new Users($login, $name, $pass);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($login, $user->login);
        $this->assertEquals($pass, $user->pass);
        
        

    }
    public function testUserSetter() // проверяем изменение params на true при вызове сеттера
    {
        $name = "Alexandr Pushkin";
        $user = new Users($name);
        $user->name = "Nikolay Gogol";
        $this->assertTrue($user->props['name']);
    }
}