<?php

namespace App\Models;

use App\Config;

/**
 * Модель Таксопарк
 *
 * Class Park
 * @package Models
 */
class Park
{
    /**
     * Управляющий
     *
     * @var Manager
     */
    public $manager;

    /**
     * Количество машиномест
     *
     * @var int
     */
    public $places;

    /**
     * Список автомобилей в таксопарке
     *
     * @var Car[]
     */
    public $cars = [];

    /**
     * Список водителей в таксопарке
     *
     * @var Driver[]
     */
    public $drivers = [];

    /**
     * Эвакуатор
     *
     * @var TowTruck
     */
    public $towTruck;

    public function __construct($data)
    {
        $this->places = isset($data['park']['places']) ? $data['park']['places'] : 0;
        $this->manager = new Manager();

        if (isset($data['cars'])) {
            foreach ($data['cars'] as $car) {
                $item = new Car($car);

                array_push($this->cars, $item);
            }
        }

        if (isset($data['drivers'])) {
            foreach ($data['drivers'] as $driver) {
                $item = new Driver($driver);

                array_push($this->drivers, $item);
            }
        }
    }

    /**
     * Создает отчет
     * @return array
     */
    public function exportReport()
    {
        $data = [];
        $data[] = sprintf('Количество машиномест: %d', $this->places);
        $data[] = sprintf('Количество автомобилей в таксопарке: %d', count($this->cars));
        $data[] = sprintf('Количество водителей в таксопарке: %d', count($this->drivers));
        $data[] = sprintf('Количество дней на ремонте: %d', Config::getInstance()->get('car.durationRepair'));
        $data[] = sprintf('Расход бензина на 100км: %dл', Config::getInstance()->get('car.averageFuelConsumption'));

        $data['cars'] = [];
        foreach ($this->cars as $car) {
            $item = [];
            $item[] = sprintf('Марка машины: %s', $car->brand);
            $item[] = sprintf('Пройденное расстояние: %sкм', $car->distance);
            $item[] = sprintf('Расход топлива: %sл', $car->fuelConsumption);
            $item[] = sprintf('Вероятность поломки: %s%%', $car->probabilityBreakdown);
            $item[] = sprintf('Автомобиль на ремонте: %s', $car->onRepair === true ? "Да" : "Нет");

            array_push($data['cars'], $item);
        }

        $data['drivers'] = [];
        foreach ($this->drivers as $driver) {
            $averageNumberTripsPerDay = Config::getInstance()->get('driver.averageNumberTripsPerDay');
            $averageFuelConsumption = Config::getInstance()->get('car.averageFuelConsumption');

            $additionalNumberTripsPerDay = Config::getInstance()->get('driver.types.' . $driver->type . '.numberTripsPerDay', 1);
            $additionalFuelConsumption = Config::getInstance()->get('driver.types.' . $driver->type . '.fuelConsumption', 1);

            $averageNumberTripsPerDay *= $additionalNumberTripsPerDay;
            $averageFuelConsumption *= $additionalFuelConsumption;

            $item = [];
            $item[] = sprintf('Тип водителя: %s', $driver->type === "default" ? "Обычный" : "Бывалый");
            $item[] = sprintf('Срок аренды авто: %d (дней)', $driver->rentalPeriod / 24);
            $item[] = sprintf('Количество поездок в день: %d', $averageNumberTripsPerDay);
            $item[] = sprintf('Расход топлива на 100км: %d', $averageFuelConsumption);

            array_push($data['drivers'], $item);
        }

        return $data;
    }

    /**
     * Эмулирует работу таксопарка
     * TODO
     */
    public function emulate()
    {
    }
}