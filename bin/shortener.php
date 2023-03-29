<?php

use GuzzleHttp\Client;
use Slim\PhpPro\shortener\FileRepository;
use Slim\PhpPro\shortener\helpers\UrlValidator;
use Slim\PhpPro\shortener\UrlConverter;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'dbFile' => __DIR__ . '/../storage/db.json',
    'urlConverter.codeLength' => 8
];

$fileRepository = new FileRepository($config['dbFile']);
$urlValidator = new UrlValidator(new Client());
$converter = new UrlConverter(
    $fileRepository,
    $urlValidator,
    $config['urlConverter.codeLength']
);

$url = 'https://google.com';
//$converter->encode($url);
echo $converter->decode('SQ70LD0p');

echo PHP_EOL;
