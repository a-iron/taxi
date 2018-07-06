<?php

require_once "vendor/autoload.php";

// load json data
$str = file_get_contents(__DIR__ . "/data/test.json");
$json = json_decode($str, true);

App\Application::start($json);
