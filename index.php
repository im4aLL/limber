<?php
require_once __DIR__ . '/vendor/autoload.php';

define('VIEW_DIR', __DIR__.'/views');

$a = new \App\Action\Example\ExampleIndexAction();
echo $a();