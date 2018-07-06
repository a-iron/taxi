<?php

namespace App;

use App\Models\Park;

class Application
{
    public static function start($data)
    {
        $park = new Park($data);

        print_r($park->exportReport());
        print_r($park->emulate());
    }
}