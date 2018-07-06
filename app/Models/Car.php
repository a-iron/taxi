<?php

namespace App\Models;

use App\Config;

/**
 * Модель Автомобиль
 *
 * Class Car
 * @package Models
 */
class Car
{
    /**
     * ID
     *
     * @var int
     */
    public $id;

    /**
     * Марка авто
     * Luda, Homba, Hendai
     *
     * @var string
     */
    public $brand;

    /**
     * Пройденное расстояние (км)
     *
     * @var float
     */
    public $distance;

    /**
     * Расход топлива
     * 10л - 100км
     *
     * @var int
     */
    public $fuelConsumption;

    /**
     * Вероятность поломки
     * новое авто - 0,5%
     * 1000км - 1%
     *
     * @var int
     */
    public $probabilityBreakdown;

    /**
     * Автомобиль на ремонте
     *
     * @var bool
     */
    public $onRepair = false;

    public function __construct($data)
    {
        $this->brand = isset($data['brand']) ? $data['brand'] : "";
        $this->distance = isset($data['km']) ? $data['km'] : 0;

        $this->setFuelConsumption();
        $this->setProbabilityBreakdown();
    }

    public function setFuelConsumption()
    {
        $this->fuelConsumption = $this->distance * Config::getInstance()->get('car.averageFuelConsumption') / 100;

        $additionalFuelConsumption = Config::getInstance()->get('car.brands.' . $this->brand . '.fuelConsumption', 1);

        $this->fuelConsumption *= $additionalFuelConsumption;
    }

    public function setProbabilityBreakdown()
    {
        if ($this->distance <= 1000) {
            $this->probabilityBreakdown = Config::getInstance()->get('car.probabilityBreakdown');
        } else {
            $this->probabilityBreakdown = $this->distance * Config::getInstance()->get('car.probabilityBreakdownPerDistance') / 1000;
        }

        $additionalProbabilityBreakdown = Config::getInstance()->get('car.brands.' . $this->brand . '.probabilityBreakdown', 1);

        $this->probabilityBreakdown *= $additionalProbabilityBreakdown;
    }
}