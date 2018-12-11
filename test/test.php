<?php

require __DIR__ . "/../vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$client = new \AGSystems\Baselinker\API\Client(
    getenv('API_TOKEN')
);


var_export(
    $client->getStoragesList()
);

var_export(
    $client->getCategories([
        'storage_id' => 1
    ])
);

