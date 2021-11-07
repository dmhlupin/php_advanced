<?php

namespace app\models\figures;

class Circle extends Figure
{
    protected $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function getFigureName()
    {
        return "Круг";
    }
    
    public function getSquare()
    {
        return pow($this->radius, 2)*pi();
    }
    public function getPerimeter()
    {
        return 2*pi()*$this->radius;
    }
}