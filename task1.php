<?php
// Идея: описать классы ролей юзер и админ (а может и более - может advancedUser ) для многопользовательской системы. 
// Данные класса хранятся в таблицах БД, на них и ориентируемся.

class User {                // Класс пользователь (актуально для любой многопользовательской системы)
    public $id;             // - свойство id пользователя
    public $userName;       // - свойство Имя пользователя
    public $hash;           // - хэш пароля или сессии пользователя
    public $email;          // - email пользователя
    public $phone;          // - телефон
    public $age;            // - возраст
    public $gender;         // - пол
    public $regDate;        // - Дата регистрации
    public $blocked;         // - Заблокирован ли пользователь


    // Конструктор класса. Допустим, пользователь регистрируется в системе. Данные из базы обрабатываются и приходят 
    // в виде ассоциативного массива. Массив и добавим в переменную коструктора
    public function __construct(array $array)
    {
        $this->id = $array['id'];
        $this->userName = $array['userName'];
        $this->hash = $array['hash'];
        $this->email = $array['email'];
        $this->phone = $array['phone'];
        $this->age = $array['age'];
        $this->gender = $array['gender'];
        $this->regDate = $array['regDate'];
        $this->blocked = $array['blocked'];
    }

    // методы, доступные пользователю - опишу парочку
    public function getUserInf() 
    {
        echo "Я {$this->userName}, мне {$this->age} лет. Моя почта {$this->email}. Состояние моей учетки: {$this->blocked}<br>";
    }
    
    public function changeEmail($email) {
        $this->email = $email;
        echo "Новая почта {$this->userName} теперь {$this->email}<br>";
    } 

    public function makeOrder()
    {
        echo $this->userName ." оформляет заказ<br>";
    }
    public function cleanCart()
    {
        echo $this->userName . " очистил корзину<br>";
    }

}

// Теперь создадим класс наследник Юзера - Админ. У него будет больше свойств и методов.

class Admin extends User {
    public $role;  //Добавим свойство role - админ чего-то там (например администратор учетных данных, или администратор склада)
    
    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->role = $array['role'];
    }
    
    public function getUserInf() 
    {
        echo "Я {$this->userName}, мне {$this->age} лет. Моя почта {$this->email}. Я админ с ролью {$this->role}<br>";
    }

    public function blockUser(User $user) 
    {
        $user->blocked = 'Заблокирована';
        echo "Администратор {$this->userName} заблокировал пользователя {$user->userName}<br>";
    }
}



// ====== проверки =======

$user1 = [
    'id' => '1',
    'userName' => 'Irina',
    'hash' => 'adkdolju543098ifsfis90u23',
    'email' => 'irina@mail.ru',
    'phone' => '79112332323',
    'age' => '25',
    'gender' => 'female',
    'regDate' => '2020-10-03',
    'blocked' => 'Работает'
];
$user1 = new User($user1);
$user1->getUserInf();
$user1->changeEmail('i.ivanova@mail.ru');
$user1->makeOrder();
$user1->cleanCart();

$admin1 = [
    'id' => '2',
    'userName' => 'Dmitry',
    'hash' => 'zfsdfsdfakalgfkagf',
    'email' => 'dmitry@mail.ru',
    'phone' => '79112334444',
    'age' => '26',
    'gender' => 'male',
    'regDate' => '2020-10-01',
    'blocked' => 'Работает',
    'role' => 'userAdmin'
];

$admin1 = new Admin($admin1);
$admin1->getUserInf();
$admin1->blockUser($user1);
$user1->getUserInf();