<?php

namespace App\Models;

use App\Config;

/**
 * Модель Водитель
 *
 * Class Driver
 * @package Models
 */
class Driver
{
    /**
     * Тип водителя
     *
     * @var string
     */
    public $type;

    /**
     * Срок аренды авто
     *
     * @var int
     */
    public $rentalPeriod;

    /**
     * Занят ли водитель
     *
     * @var bool
     */
    public $busy = false;

    public function __construct($data)
    {
        $this->type = isset($data['type']) ? $data['type'] : "";
        $this->rentalPeriod = Config::getInstance()->get('car.rentalPeriod');
    }
}