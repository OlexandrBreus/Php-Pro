<?php

namespace Slim\PhpPro\shortener\exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}