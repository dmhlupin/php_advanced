<?php

namespace app\models\figures;

class Rectangle extends Figure
{
    protected $ab;
    protected $bc;

    public function __construct($ab, $bc)
    {
        $this->ab = $ab;
        $this->bc = $bc;
    }

    public function getFigureName()
    {
        return "Прямоугольник";
    }
    public function getSquare()
    {
        return $this->ab*$this->bc;
    }
    public function getPerimeter()
    {
        return ($this->ab + $this->bc)*2;
    }
}