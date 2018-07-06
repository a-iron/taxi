<?php

namespace Models;

/**
 * Модель Эвакуатор
 * (предпологаем, что данный эвакуатор является собственностью данной компании и всего один)
 *
 * Class TowTruck
 * @package Models
 */
class TowTruck {
    /**
     * ID
     *
     * @var int
     */
    public $id;

    /**
     * История работы эвакуатора
     *
     * @var TowTruckHistory
     */
    public $list;

    /**
     * Добавляет запись вызова эвакуатора
     */
    public function add()
    {
        
    }
}