<?php
session_start();  // создаем сессию

// псевдонимы для пространств имен

use app\engine\App;

// Подключаем конфиг-файл

$config = include "../config/config.php";

// и автозагрузчик

require_once '../vendor/autoload.php';

try {
     App::call()->run($config);


} catch (PDOException $e){
     var_dump($e);
} catch (Exception $e){
     var_dump($e);
}

