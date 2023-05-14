<?php

use Illuminate\Database\Capsule\Manager;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ['filePath' => __DIR__ . '/../storage/db.json'];

$dbManager = new Manager();
$dbManager->addConnection([
    "driver" => 'mysql',
    "host" => 'db_mysql',
    "database" => 'php_pro',
    "username" => 'doctor',
    "password" => 'pass4doctor',
    "charset" => 'utf8',
    "collation" => 'utf8_unicode_ci',
    "prefix" => ''
]);

$dbManager->bootEloquent();

//$repository = new \Slim\PhpPro\Short\Repository($config['filePath']);
$repository = new \Slim\PhpPro\Short\DBRepository();
$encoder = new \Slim\PhpPro\Short\UrlEncoder($repository);
$decoder = new \Slim\PhpPro\Short\UrlDecoder($repository);

$url = 'https://google.com';

//echo $encoder->encode($url);
echo $decoder->decode('7JC5ck7A');

echo PHP_EOL;
