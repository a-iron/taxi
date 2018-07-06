<?php

/**
 * Конфигурационный файл
 */

return [
    'driver' => [
        'types'                 => [
            'default' => [
                'numberTripsPerDay' => 1, //Количество поездок в день (коэффициент)
                'fuelConsumption'   => 1, //Расход топлива (коэффициент)
            ],
            'pro'     => [
                'numberTripsPerDay' => 1.3, //Количество поездок в день (коэффициент)
                'fuelConsumption'   => 0.8, //Расход топлива (коэффициент)
            ]
        ],
        'averageTravelDistance' => 7, //Расстояние поездки в среднем (км)
        'averageNumberTripsPerDay' => 10 //Количество поездок(заказов) в день в среднем
    ],
    'car'    => [
        'rentalPeriod'                    => 24, //Длительность выдачи авто водителю (часов)
        'durationRepair'                  => 3, //Длительность ремонта авто после аварии (дней)
        'averageFuelConsumption'          => 10, //Средний расход топлива (литров на 100км)
        'probabilityBreakdown'            => 0.5, //Вероятность поломки (процентов)
        'probabilityBreakdownPerDistance' => 1, //Вероятность поломки на 1000км (процентов)
        'brands'                          => [
            'Luda'   => [
                'probabilityBreakdown' => 3, //Вероятность поломки (коэффициент)
                'fuelConsumption'      => 1 //Расход топлива (коэффициент)
            ],
            'Homba'  => [
                'probabilityBreakdown' => 1, //Вероятность поломки (коэффициент)
                'fuelConsumption'      => 0.7 //Расход топлива (коэффициент)
            ],
            'Hendai' => [
                'probabilityBreakdown' => 1, //Вероятность поломки (коэффициент)
                'fuelConsumption'      => 1 //Расход топлива (коэффициент)
            ],
        ]
    ]
];