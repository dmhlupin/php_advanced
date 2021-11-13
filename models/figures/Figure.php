<?php

namespace app\models\figures;

use app\interfaces\IFigure;

abstract class Figure implements IFigure
{
    public function __get($name)
    {
        return $this->name;
    }
    public function __set($name, $value)
    {
        $this->name = $value;
    }

    abstract public function getSquare();
    abstract public function getPerimeter();
    abstract public function getFigureName();

    public function showFigureInfo()
    {
        $figureName = $this->getFigureName();
        echo "<hr>";
        echo $figureName . "<br>";
        $arr = get_object_vars($this);
        foreach ($arr as $key => $value) {
            echo "{$key}: {$value} <br>";
        }
        echo "Площадь: ".$this->getSquare()."<br>";
        echo "Периметр: ".$this->getPerimeter()."<br>";

    }
}