<?php

namespace Slim\PhpPro\Short\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}