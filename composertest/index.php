<?php
 
require_once __DIR__ . '/vendor/autoload.php';
 
use App\Models\TestModel;
$app = new TestModel;
$app->getHello();


