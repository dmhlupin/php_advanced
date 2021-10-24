<?php

// псевдонимы для пространств имен

use app\engine\Db;
use app\models\{Basket, Feedback, Orders, Products, Users};
use app\models\figures\{Circle, Rectangle, Triangle};


// Подключаем конфиг-файл

include "../config/config.php";

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

$product = new Products("Часы", "Наручные", 150);
$product->insert();
var_dump($product);
$product->delete();
die();

//$user = new Users();

var_dump($product->getOne(1));
var_dump($product->getAll());

