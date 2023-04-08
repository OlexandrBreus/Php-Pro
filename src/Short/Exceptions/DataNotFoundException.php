<?php

namespace Slim\PhpPro\Short\Exceptions;

use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';

    public function __construct()
    {
        $log = new Logger('exceptions');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/log.txt', Level::Warning));
        $log->warning('Data not found');
    }

}