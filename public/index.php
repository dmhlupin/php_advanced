<?php
session_start();  // создаем сессию

// псевдонимы для пространств имен
use app\engine\Db;
use app\engine\Render;
use app\engine\Request;
use app\engine\TwigRender;
use app\models\{Basket, Feedback, Orders, Products, Users};
use app\models\figures\{Circle, Rectangle, Triangle};


// Подключаем конфиг-файл

include "../config/config.php";

// нужна автозагрузка

//include "../engine/Autoload.php";


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

//spl_autoload_register([new Autoload(), 'loadClass']);

require_once '../vendor/autoload.php';

try {
     $request = new Request();

     $controllerName = $request->getControllerName() ?: 'product';
     $actionName = $request->getActionName();
     
     $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
     
     if(class_exists($controllerClass)) {
          $controller = new $controllerClass(new TwigRender);
          $controller->runAction($actionName);
     } else {
          Die(' ERROR 404');
     }

} catch (PDOException $e){
     var_dump($e);
} catch (Exception $e){
     var_dump($e);
}

