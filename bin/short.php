<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = ['filePath' => __DIR__ . '/../storage/db.json'];

$repository = new \Slim\PhpPro\Short\Repository($config['filePath']);
$encoder = new \Slim\PhpPro\Short\UrlEncoder($repository);
$decoder = new \Slim\PhpPro\Short\UrlDecoder($repository);

$url = 'https://google.com';

//$encoder->encode($url);
echo $decoder->decode('1FBb69Dc');
