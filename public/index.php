<?php

// псевдонимы для пространств имен

use app\engine\Db;
use app\models\{Basket, Feedback, Orders, Products, Users};
use app\models\figures\{Circle, Rectangle, Triangle};


// нужна автозагрузка

include "../engine/Autoload.php";


// ***** Один из вариантов реализации загрузчика - с помощью зарегистрированной как загрузчик функции ****
// функция регистрации загрузчиков. Если их несколько - регистрирует имена функций этих загрузчиков

// spl_autoload_register('loader');

// function loader($className) 
// {
     // Чтобы не создавать промежуточную переменную - внутри круглых скобок создаем 
     // экземпляр и сразу вызываем его метод

//     (new Autoload())->loadClass($className);
// }

// ***** Другой вариант использования spl_autoload_register - на вход подается массив: 
// Первый элемент массива - экземпляр класса загрузчика, 
// второй - имя метода этого класса, отвечающего за загрузку:

spl_autoload_register([new Autoload(), 'loadClass']);

// создаем один экземпляр Db для передачи его во все конструкторы
$db = new Db();

$product = new Products($db);
$user = new Users($db);
$order = new Orders($db);
$feedback = new Feedback($db);
$basket = new Basket($db);

echo $product->getOne(3)."<br>";
echo $product->getAll()."<br>";
echo $user->getOne(2)."<br>";

// Проверка моделей из ДЗ
echo $order->getAll()."<br>";
echo $basket->getOne(1)."<br>";
echo $feedback->getAll()."<br>";

// Проверка работы __call
echo $user->getUser(3,25)."<br>";


// Прямоугольник
$rectangle = new Rectangle(3, 4);
$rectangle->showFigureInfo();

// Круг
$circle = new Circle(4);
$circle->showFigureInfo();

// Треугольник
$triangle = new Triangle(3, 4, 5);
$triangle->showFigureInfo();