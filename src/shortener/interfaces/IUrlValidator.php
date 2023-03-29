<?php

namespace Slim\PhpPro\shortener\interfaces;

use GuzzleHttp\Exception\InvalidArgumentException;

interface IUrlValidator
{
    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function validateUrl(string $url): bool;

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function checkRealUrl(string $url): bool;

}
