<?php

namespace Maris\Symfony\Geo\Entity;

use Maris\Symfony\Geo\Interfaces\DistanceCalculatorInterface;
use Maris\Symfony\Geo\Service\Haversine;

/***
 * Круг на карте определенный центральной точкой и радиусом в метрах.
 * Определяет круговую границу в которую входит фигура.
 * Радиус указан в метрах.
 */
class Circle
{
    /**
     * Координаты центра круга.
     * @var Location
     */
    protected Location $center;

    /**
     * Радиус круга в метрах.
     * @var float
     */
    protected float $radius;


    /**
     * @param Location $center
     * @param float $radius
     */
    public function __construct( Location $center, float $radius )
    {
        $this->center = $center;
        $this->radius = $radius;
    }

    /***
     * Создает объект круга описанного вокруг фигуры.
     * @param Geometry $geometry
     * @param DistanceCalculatorInterface $calculator
     * @return Circle
     */
    public static function create( Geometry $geometry ,DistanceCalculatorInterface $calculator = new Haversine()):Circle
    {
        $center = $geometry->getBounds()->getCenter();
        return new static(
            $center,
            $calculator->getDistance( $center, $geometry->getBounds()->getNorthWest() )
        );
    }


    /**
     * @return Location
     */
    public function getCenter(): Location
    {
        return $this->center;
    }

    /**
     * @param Location $center
     * @return $this
     */
    public function setCenter(Location $center): self
    {
        $this->center = $center;
        return $this;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     * @return $this
     */
    public function setRadius(float $radius): self
    {
        $this->radius = $radius;
        return $this;
    }


}