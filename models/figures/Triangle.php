<?php

namespace app\models\figures;

class Triangle extends Figure
{
    protected $ab;
    protected $bc;
    protected $ca;

    public function __construct($ab, $bc, $ca)
    {
        $this->ab = $ab;
        $this->bc = $bc;
        $this->ca = $ca;
    }

    public function getFigureName()
    {
        return "Треугольник";
    }

    // Площадь вычисляем по формуле Герона через 3 известные стороны и полупериметр p
    public function getSquare()
    {
        $p = $this->getPerimeter()/2;
        return sqrt($p*($p-$this->ab)*($p-$this->bc)*(($p-$this->ca)));
    }
    public function getPerimeter()
    {
        return $this->ab + $this->bc + $this->ca;
    }
}