<?php

namespace App\Models;

/**
 * История вызовов эвакуатора
 *
 * Class TowTruckHistory
 * @package Models
 */
class TowTruckHistory {
    /**
     * ID
     *
     * @var int
     */
    public $id;

    /**
     * Автомобиль
     *
     * @var Car
     */
    public $car;

    /**
     * Время вызова эвакуатора
     *
     * @var Car
     */
    public $date;
}