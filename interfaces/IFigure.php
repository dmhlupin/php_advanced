<?php

namespace app\interfaces;

// интерфейс для класса. Не содержит свойств, только заготовки публичных методов, обязательных к реализации в классе
interface IFigure
{
    public function getSquare();
    public function getPerimeter();
    public function showFigureInfo();
}