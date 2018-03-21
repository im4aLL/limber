<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/system/functions.php';

define('APP', true);

$app = new \Limber\System();
$app->route([
    ['type' => 'GET', 'url' => '/', 'action' => '\App\Action\Example\ExampleIndexAction', 'name' => 'home'],
    ['type' => 'GET', 'url' => '/about', 'action' => '\App\Action\Example\ExampleAnotherAction', 'name' => 'about']
])->run();