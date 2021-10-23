<?php

class Autoload 
{
    // Приватный метод для подготовки имени файла из переменной className
    // Вынес в отдельный метод для того чтобы функция loadClass занималась своей работой
    private function prepareFilename($className, $sbstr, $replace)
    {
        // Однократная замена $sbstr в начале строки на $replace
        $pos = strpos($className, $sbstr);
        $className = ($pos === 0) ? substr_replace($className, $replace, $pos, strlen($sbstr)) : $className;    

        // Переворачивание слэшей во всей строке
        $className = str_replace('\\', '/', $className);

        return "{$className}.php";
    }

    public function loadClass($className)
    {
        // вызываем метод prepareFilename над строкой $className и строкой однократной замены 'app\'
        $fileName = $this->prepareFilename($className, 'app\\', '../');

        if(file_exists($fileName)) {
            include $fileName;
        } else {
            echo "Файл для указанного класса не существует.";
        }
    }
}